<?php

class PCconfig {

    public $et_area;
    public $et_pagename = '';
    public $last_word;

    function __construct() {

        add_action("add_meta_boxes", array($this, 'wpetracker_add_meta_box'));
        add_action("save_post", array($this, 'wpetracker_save_meta_box'), 1, 3);
        $this->wpetracker_triger_tax_meta();
        add_action('template_redirect', array($this, 'wpetracker_nonpost_options'), 10, 1);

    }

    /**
     * @author Eno Hoxha
     * @email eno4hoxha@gmail.com
     * --------------------------------------------
     * Function wpetracker_save_meta_box
     * @param $post_id
     * @param $post
     * @param $update
     */
    function wpetracker_save_meta_box($post_id, $post, $update) {
        if (is_admin()) {
            $currentScreen = get_current_screen();
        }
        if (get_option('posts_type') == 'page') {
            $type = 'page';
        } else {
            $type = 'l';
        }
        if (isset($_POST['page'])) {
            update_option('usr_edit', 'no');
		}
        update_option('wpetracker_mod_id', -3);
        if (isset($_POST['area']) && $_POST['area'] != null && get_option('wpetracker_area_class') != $_POST['area']) {
            $area = $_POST["area"];
            update_option('usr_edit', 'yes');
            update_option('wpetracker_mod_id', get_the_ID());
        } else {
            if ($currentScreen->id == 'page' || is_page() || $type == 'page') {
                $area = $this->wpetracker_get_area_inpage(get_the_ID());
            } else {
                $area = $this->wpetracker_get_et_page(get_the_category());
            }
        }
        update_post_meta($post_id, "wpetracker-area", $area);
        if (isset($_POST["page"]) && $_POST['page'] != null && $_POST['page'] != get_option('wpetracker_page_class')) {
            $page = $_POST["page"];
        } else {
            $page = $this->wpetracker_get_area_page(get_the_category());
        }
        update_post_meta($post_id, "wpetracker-page", $page);
        update_option('posts_type', '');

    }

    /**
     * @author Eno Hoxha
     * @email eno4hoxha@gmail.com
     * --------------------------------------------
     * Function trc_add_meta_box
     */
    function wpetracker_add_meta_box() {
        foreach (get_post_types('', 'names') as $post_type) {
            if ($post_type != 'attachment' && $post_type != 'revision' && $post_type != 'nav_menu_item') {
                add_meta_box("meta-box", "WP etracker", array($this, 'wpetracker_metabox_html'), $post_type, "normal", "high", null);
            }

        }

    }

    /**
     * @author Eno Hoxha
     * @email eno4hoxha@gmail.com
     * --------------------------------------------
     * Function trc_metabox_html
     * @param $object
     */
    function wpetracker_metabox_html($object) {
        include plugin_dir_path(__DIR__) . 'views/meta_form.php';
    }

    /**
     * @author Eno Hoxha
     * @email eno4hoxha@gmail.com
     * --------------------------------------------
     * Function trc_meta_taxonomy_html
     * @param $term
     */
    function wpetracker_meta_taxonomy_html($term) {

        // put the term ID into a variable
        $term_id = $term->term_id;
        // retrieve the existing value(s) for this meta field. This returns an array
        $term_meta = get_option("taxonomy_$term_id");

        include plugin_dir_path(__FILE__) . 'views/meta_form_tax.php';

    }

    /**
     * @author Eno Hoxha
     * @email eno4hoxha@gmail.com
     * --------------------------------------------
     * Function wpetracker_save_taxonomy_custom_meta
     * @param $term_id
     */
    function wpetracker_save_taxonomy_custom_meta($term_id) {
        if (isset($_POST['term_meta']) && $_POST['term_meta'] != '') {
            $term_meta = get_option("taxonomy_$term_id");
            $cat_keys = array_keys($_POST['term_meta']);
            foreach ($cat_keys as $key) {
                if (isset ($_POST['term_meta'][$key])) {
                    $term_meta[$key] = $_POST['term_meta'][$key];
                    if ($_POST['term_meta'][$key] != '') {
                        update_option('tax_' . $key, 'true');
                        update_option('tax_' . $key . '_val', $_POST['term_meta'][$key]);
                    } else {
                        update_option('tax_' . $key, 'false');
                    }
                }
            }
            // Save the option array.
            update_option("taxonomy_$term_id", $term_meta);
        }

    }

    /**
     * @author Eno Hoxha
     * @email eno4hoxha@gmail.com
     * --------------------------------------------
     * Function wpetracker_triger_tax_meta
     */
    function wpetracker_triger_tax_meta() {
        $args = array(
            'public' => true,
        );
        $output = 'names'; // names or objects, note names is the default
        $operator = 'and'; // 'and' or 'or'
        $post_types = get_post_types($args, $output, $operator);
        $taxonomies = get_object_taxonomies('post', 'names');
        $search = get_option('wpetracker_cus');

		if(isset($search) && $search != null) {
          for ($i = 0; $i < sizeof($search); $i++) {
            add_action($search[$i] . '_edit_form_fields', array($this, 'wpetracker_meta_taxonomy_html'), 10, 2);
            add_action('edited_' . $search[$i], array($this, 'wpetracker_save_taxonomy_custom_meta'), 10, 2);
            add_action('create_' . $search[$i], array($this, 'wpetracker_save_taxonomy_custom_meta'), 10, 2);
          }
		}

    }


    /**
     * @author Eno Hoxha
     * @email eno4hoxha@gmail.com
     * --------------------------------------------
     * Function wpetracker_get_et_page
     * @param $id
     *
     * @return bool|string
    --------------------------------------------
     */
    function wpetracker_get_et_page($id) {

        $p_name = '';
        $taxonomies = null;
        $type = '';
        $paret_posts_id_array = array();
        if(!is_array(get_option('wpetracker_opt_val_cat')))
            $user_option = json_decode(get_option('wpetracker_opt_val_cat'));
        else
            $user_option = get_option('wpetracker_opt_val_cat');
        if (get_the_category() != null) {
            $taxonomies = get_the_category();

        } else {
            $taxonomies = get_post_taxonomies();
            $type = 'custom';
        }
        //helper index
        $j = 0;
        for ($i = 0; $i < sizeof($taxonomies); $i++) {
            if ($type == 'custom') {
                $terms = get_the_terms(get_the_ID(), $taxonomies[$i]);
            } else {
                $terms = get_terms($taxonomies[$i]);
            }


            foreach ($terms as $key) {
                $pid = $key->parent;
                while ($pid != 0) {
                    $ptax = get_term_by('id', $pid, $key->taxonomy);
                    $pid = $ptax->parent;
                    if (!in_array($ptax->term_id, $paret_posts_id_array)) {
                        $paret_posts_id_array[$j] = $ptax->term_id;
                        $j++;
                    }
                }
                if (!in_array($key->term_id, $paret_posts_id_array)) {
                    $paret_posts_id_array[$j] = $key->term_id;
                    $j++;
                }
            }
        }
        $separator = '';
        for ($so = 0; $so < sizeof($paret_posts_id_array); $so++) {
            for ($so1 = 0; $so1 < sizeof($paret_posts_id_array); $so1++) {
                if ($paret_posts_id_array[$so] < $paret_posts_id_array[$so1]) {
                    $temp = $paret_posts_id_array[$so];
                    $paret_posts_id_array[$so] = $paret_posts_id_array[$so1];
                    $paret_posts_id_array[$so1] = $temp;
                }
            }
        }
        for ($index = 0; $index < sizeof($paret_posts_id_array); $index++) {
            $child = get_category($paret_posts_id_array[$index]);
            $parent = $child->parent;
            $terms = get_terms($child);
            $find = 'false';
            if ($parent == 0) {
                if ($p_name == '') {

                    for ($e = 0; $e < sizeof($user_option); $e++) {
                        if ($user_option[$e]->option == $terms[0]->slug && $user_option[$e]->value == 'on') {
                            $find = 'true';
                            break;
                        }
                    }

                    if ($find == 'true') {

                        $p_name = $p_name . $separator . get_the_category_by_ID($paret_posts_id_array[$index]);

                    } else {

						//K. Meffert removed questionable condition
//                        if ($paret_posts_id_array[$index] != 16) {
                            $p_name = $p_name . $separator . get_the_category_by_ID($paret_posts_id_array[$index]);
//                        }
                    }
                }

            } else {

                if ($index > 0) {
                    $separator = '/';
                }
                for ($e = 0; $e < sizeof($user_option); $e++) {
                    if ($user_option[$e]->option == $terms[0]->slug && $user_option[$e]->value == 'on') {
                        $find = 'true';
                        break;
                    }
                }
                if ($find == 'true') {
                    $p_name = $p_name . $separator . get_the_category_by_ID($paret_posts_id_array[$index]);
                } else
                    $p_name = $p_name . $separator . get_the_category_by_ID($paret_posts_id_array[$index]);


            }
        }


        if (substr($p_name, 0, 1) == ',' || substr($p_name, 0, 1) == '/') {
            $p_name = substr($p_name, 1);
        }
        if ($p_name == '') {
			// K. Meffert: removed preset as per request
//            $p_name = 'Shop';
        }
        update_option('wpetracker_area_class', $p_name);

        return $p_name;
    }

    /**
     * @author Eno Hoxha
     * @email eno4hoxha@gmail.com
     * --------------------------------------------
     * Function wpetracker_get_area_page
     * @param $id
     *
     * @return string
    --------------------------------------------
     */
    function wpetracker_get_area_page($id) {
        $e_area = get_the_title();
        $e_area .= '*' . get_the_ID() . '*';
        update_option('wpetracker_page_class', $e_area);
        return $e_area;
    }

    /**
     * @author Eno Hoxha
     * @email eno4hoxha@gmail.com
     * --------------------------------------------
     * Function wpetracker_nonpost_options
     * @param $term_id
     */
    function wpetracker_nonpost_options($term_id) {

        $pagename = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $at_page = '';
        $at_url = rawurlencode($pagename);
        $at_area = 'page';


        // retrieve the existing value(s) for this meta field. This returns an array
        global $cat;
        if (is_category()) {
            $at_area = get_category_parents($cat, false, '/');
            $at_page = get_cat_name($cat) . '*' . $cat . '*';
        }


        if (get_option('wpetracker_tax_et_pagename') == 'true') {
            $at_page = get_option('wpetracker_tax_et_pagename_val');
        }
        if (get_option('wpetracker_tax_et_area') == 'true') {
            //$at_area=get_option( 'tax_et_area_val' );
        }
        if (get_option('wpetracker_tax_et_url') == 'true') {
            $at_url = get_option('wpetracker_tax_et_url_val');
        }
        update_option('wpetracker-page', $at_page);
        update_option('wpetracker-area', $at_area);
        update_option('wpetracker-url', $at_url);

    }

    ////////////////////////////////////////////////////////////////////////////

    function wpetracker_get_area_inpage($id) {

        $page_name = get_the_title($id);

        $page_parents = get_post_ancestors($id);

        //variable name helpers is used to reverse the array and add current page to end

        $name_helpers = '';

        $slash = '';

        $user_page_option = get_option('wpetracker_opt_val_page');

        $before = get_option('wpetracker_page_area');

        for ($i = sizeof($page_parents) - 1; $i >= 0; $i--) {

            $terms = get_post($page_parents[$i]);

            if ($i < sizeof($page_parents) - 1) {

                $slash = '/';

            }

            $find = 'false';
            for ($s = 0; $s < sizeof($user_page_option); $s++) {
                $find = 'false';

                if ($user_page_option[$s] == $terms->post_title) {
                    $find = 'true';
                    break;
                } else if ($user_page_option[$s] == $page_name) {
                    $page_name = $page_name;
                    break;
                }
            }

            if ($find == 'true') {
                $name_helpers .= $slash . get_the_title($page_parents[$i]);
            } else
                $name_helpers .= $slash . get_the_title($page_parents[$i]);

        }
        if ($name_helpers == '') {
            $page_name = $name_helpers . $page_name;
        } else {
            $page_name = $name_helpers . '/' . $page_name;
        }

        update_option('wpetracker_area_class', $page_name);
        return $page_name;

    }
}