<?php
    /*
     *	@ Class OptVal will contain two variables to help implementing the structure
     *	1. option -> option slug will be saved
     *	2. value -> checked or null
     *
    */

    class OptVal {
        public $option;
        public $value;
        public $post_val;

        function __construct($o, $v, $pv = '') {
            $this->option = $o;
            $this->value = $v;
            $this->post_val = $pv;
        }
    }

    function wpetracker_save_option() {
        $post = $_POST;
        $all_categories = get_terms();
        //get index
        $i = 0;
        if (isset($_POST['key'])) {
            update_option('wpetracker-key', $_POST['key']);
        } else if (isset($_POST['cat'])) {
            update_option('wpetracker_cat', $_POST['cat']);
        } //If category options form is submited.

        else if (isset($_POST['category'])) {
            $category_option = array();
            foreach ($all_categories as $category) {
                if (isset($_POST[$category->slug])) {
                    $category_option[$i] = new OptVal($category->slug, 'on', $_POST[$category->slug]);
                } else {
                    $category_option[$i] = new OptVal($category->slug, '');
                }
                $i++;
            }
            update_option('wpetracker_opt_val_cat', json_encode($category_option));
            update_option('wpetracker_area_posts', $_POST['area_post']);

        } else if (isset($_POST['page_3'])) {
            $page_option = array();
            $i = 0;
            foreach ($post as $p) {

                $page_option[$i] = $p;
                $i++;
            }
            update_option('wpetracker_opt_val_page', $page_option);
            if (isset($_POST['page_area'])) {
                update_option('wpetracker_page_area', $_POST['page_area']);
            }
        } else {
            if (get_option('wpetracker_opt_val_cat') == false) {
                $category_option = array();
                foreach ($all_categories as $category) {
                    if (isset($_POST[$category->slug])) {
                        $category_option[$i] = new OptVal($category->slug, 'on', $_POST[$category->slug]);
                    } else {
                        $category_option[$i] = new OptVal($category->slug, '');
                    }
                    $i++;
                }
                update_option('wpetracker_opt_val_cat', json_encode($category_option));
            }
            if (get_option('wpetracker_opt_val_page') == false) {
                $page_option = array();
                $i = 0;
                foreach ($post as $p) {

                    $page_option[$i] = $p;
                    $i++;
                }
                update_option('wpetracker_opt_val_page', $page_option);
            }


        }
    }

    wpetracker_save_option();

    function wpetracker_update_posts_by_page() {
        $pots_cat = get_option('wpetracker_opt_val_page');
        foreach ($pots_cat as $key) {
            $p = get_page_by_title($key);
            if ($p != null) {
				//K. Meffert: Avoid duplicate entries for page areas
				if(get_post_meta($p->ID, "wpetracker-area", true)== get_option('wpetracker_page_area') || strpos(get_post_meta($p->ID, "wpetracker-area", true).",",get_option('wpetracker_page_area'))) {
				}
				else {
                  if (endsWith(get_post_meta($p->ID, "wpetracker-area", true), ',')) {
                    $data = get_post_meta($p->ID, "wpetracker-area", true) . ' ' . get_option('wpetracker_page_area');
                  } else {
                    $data = get_post_meta($p->ID, "wpetracker-area", true) . ', ' . get_option('wpetracker_page_area');
                  }
                  update_post_meta($p->ID, "wpetracker-area", $data);
				}

            }
        }
    }

    function wpetracker_update_posts_by_cat() {


        $pots_cat = json_decode(get_option('wpetracker_opt_val_cat'));
        foreach ($pots_cat as $key) {
            if ($key->value == 'on') {
                $args = array(
                    'public' => true,
                );
                $output = 'names'; // names or objects, note names is the default
                $operator = 'and'; // 'and' or 'or'
                $post_types = get_post_types($args, $output, $operator);

                foreach ($post_types as $post_type) {
                    $args = array(
                        'post_type' => $post_type,
                        'tax_query' => array(
                            array(
                                'taxonomy' => $key->post_val,
                                'field' => 'slug',
                                'terms' => $key->option,
                            ),
                        ),
                    );
                    $the_query = new WP_Query($args);
                    while ($the_query->have_posts()) {
                        $the_query->the_post();
                        $type = get_post();
						//K. Meffert: Avoid duplicate entries for area names
						$d = get_post_meta($type->ID, "wpetracker-area", true);
						if(isset($d) && $d != null){
							$d = trim($d);
						}
						if($d == get_option('wpetracker_area_posts') || strpos($d, get_option('wpetracker_area_posts').",") || strpos($d, get_option('wpetracker_area_posts')." ,")) {
							update_post_meta($type->ID, "wpetracker-area", $d);
						}
						else {
						  if($d == ","){
							  $d="";
						  }
                          if (endsWith($d, ',')) {
                              $data = $d . ' ' . get_option('wpetracker_area_posts');
                          } else {
                              $data = $d . ', ' . get_option('wpetracker_area_posts');
                          }
                          update_post_meta($type->ID, "wpetracker-area", $data);
						}


                    }
                }
            }
        }

    }

    function endsWith($haystack, $needle) {
        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }

        return (substr($haystack, -$length) === $needle);
    }

    if (isset($_POST['category'])) {
        wpetracker_update_posts_by_cat();
    } else if (isset($_POST['page_3'])) {
        wpetracker_update_posts_by_page();
    }