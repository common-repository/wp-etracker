<?php
/*
Plugin Name: WP etracker
Plugin URI: https://developer.wordpress.org/plugins/wpetracker/
Description: Analysiere dein WordPress mit etracker.
Version: 1.0.2
Author: WP-etracker
Author URI: https://wp-etracker.com
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wpetracker
Domain Path: /languages

WP etracker is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
WP etracker is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with WP etracker. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

//K. Meffert: Added data-plugin-version parameter, which contains the WordPress version

// Disallow access if user opens this file directly
if (!defined('ABSPATH')) die();

require_once 'includes/helpers.php';
require_once 'includes/pconfig.php';
require_once 'includes/wpetracker_event_footer.php';
include_once dirname(__FILE__) . '/includes/actions/WpeTrackerActions.php';

// Define constants
define( 'WPETRACKER_PLUGIN_VER', '0.7.7' );

class Tracklet {

    function __construct() {

        $meta = new PCconfig();
        $onevent = new wpetracker_event_footer();

        load_plugin_textdomain( 'wpetracker', false, basename( dirname( __FILE__ ) ) . '/languages' );

        // Init Plugin Scripts
        add_action('admin_menu', array($this, 'wpetracker_add_admin_page'));
		// K. Meffert: Optionally add etracker tracking code to footer instead of header
        if(get_option('tracking_code_hf_option') == 'on') {
	        add_action('wp_footer', array($this, 'wpetracker_add_tracking_script'));
   	    }
		else {
            //add_action('wp_enqueue_scripts', array($this, 'wpetracker_add_tracking_script'));
            add_action('wp_head', array($this, 'wpetracker_add_tracking_script'));
		}
		
        add_action('wp_print_scripts', array($this, 'wpetracker_ajax_load_scripts'));

        // AJAX Handlers
        add_action('wp_ajax_category_search', array($this, 'wpetracker_category_search'));
        add_action('wp_ajax_pages_search', array($this, 'wpetracker_pages_search'));
        add_action('wp_ajax_auto_update', array($this, 'wpetracker_auto_update'));
        add_action('wp_ajax_youtube_tracking', array($this, 'wpetracker_youtube_tracking'));
        add_action('wp_ajax_tracking_code_hf', array($this, 'wpetracker_tracking_code_hf'));
        add_action('wp_ajax_wpetracker_accept_tos', array($this, 'wpetracker_accept_tos'));

        // Register Hooks
        register_activation_hook(__FILE__, array('WpeTrackerActions', 'wpetracker_on_activate'));
        register_deactivation_hook(__FILE__, array('WpeTrackerActions', 'wpetracker_on_deactivate'));
        register_uninstall_hook(__FILE__, array('WpeTrackerActions', 'wpetracker_on_unistall'));

    }
	
    /**
     * @author Eno Hoxha
     * @email eno4hoxha@gmail.com
     * --------------------------------------------
     * Function wpetracker_category_search
     *
     */
    function wpetracker_category_search() {
        //Get variables for processing
        $item = $_POST['item'];
        $terms = get_terms(array(
            'name__like' => $item
        ));
        $response = '';
        $j = 0;
        $categoryDatas = json_decode(get_option('wpetracker_opt_val_cat'));

        foreach ($terms as $term) {
            $response .= " <li class = 'list-categ'>
                          <input class='check-box' name=" . $term->slug . " value=" . $term->taxonomy . "
                          type='checkbox' id = '" . $term->slug . "'
                        ";
            foreach ($categoryDatas as $categoryData) {

                if ($term->slug == $categoryData->option && $categoryData->value == 'on') {
                    $response .= 'checked';
                    break;
                }
            }
            $j++;
            $response .= "><label for='" . $term->slug . "' >" . $term->name . "</label></li>";
        }
        echo $response;
        die();
    }

    /**
     * @author Eno Hoxha
     * @email eno4hoxha@gmail.com
     * --------------------------------------------
     * Function wpetracker_pages_search
     */
    function wpetracker_pages_search() {
        $pageTitle = $_POST['item'];
        global $wpdb;
        $response = "";

        $query = "
          SELECT      *
          FROM        $wpdb->posts
          WHERE       $wpdb->posts.post_title LIKE '$pageTitle%'
          AND         $wpdb->posts.post_type = 'page'
          ORDER BY    $wpdb->posts.post_title
          ";
        $wpdb->get_results($query);

        $pageOptions = get_option('wpetracker_opt_val_page');
        foreach ($wpdb->last_result as $term) {
            $response .= " <li class = 'list-categ'>
            <input class='check-box-2' name='" . $term->post_title . "' value='" . $term->post_title . "'
            type='checkbox' id = '" . $term->post_name . "'
            ";
            foreach ($pageOptions as $pageOption) {
                if (in_array($term->post_title, $pageOption)) {
                    $response .= "checked";
                    break;
                }
            }
            $response .= "><label for='" . $term->post_name . "' >" . $term->post_title . "</label></li>";
        }
        echo $response;
        die();
    }

    /**
     * @author Eno Hoxha
     * @email eno4hoxha@gmail.com
     * --------------------------------------------
     * Function wpetracker_auto_update
     */
    function wpetracker_auto_update() {
        update_option('auto_update_option', $_POST['item']);
    }


    /**
	 * Allow to disable YouTube tracking
     * @author Dr. Klaus Meffert
     * @email mail@doktor-meffert,de
     * --------------------------------------------
     * Function wpetracker_youtube_tracking
     */
    function wpetracker_youtube_tracking() {
        update_option('youtube_tracking_option', $_POST['item']);
    }

    /**
	 * Allow to add tracking code either to header or to footer of page
     * @author Dr. Klaus Meffert
     * @email mail@doktor-meffert,de
     * --------------------------------------------
     * Function wpetracker_tracking_code_hf
     */
    function wpetracker_tracking_code_hf() {
        update_option('tracking_code_hf_option', $_POST['item']);
    }
    function wpetracker_accept_tos() {
        $updateTos = update_option('wpetracker_accept_tos', $_POST['accept_tos_value']);
        if ($updateTos == 1 && $_POST['accept_tos_value'] == 'on') {
            echo 'enabled';
        } else if ($updateTos == 1 && $_POST['accept_tos_value'] == 'off') {
            echo 'disabled';
        } else {
        	_e('Error while updating option!', 'wpetracker');
        }
        die();
    }

    /**
     * @author Eno Hoxha
     * @email eno4hoxha@gmail.com
     * --------------------------------------------
     * Function wpetracker_add_admin_page
     */
    function wpetracker_add_admin_page() {
        add_menu_page('WP etracker', 'WP etracker', 'manage_options', 'wpetracker-admin', array( $this, 'wpetracker_options' ), plugin_dir_url(__FILE__) . '/assets/images/logo-menu.png');
    }

    /**
     * @author Eno Hoxha
     * @email eno4hoxha@gmail.com
     * --------------------------------------------
     * Function wpetracker_ajax_load_scripts
     */
    function wpetracker_ajax_load_scripts() {
        if (is_admin()) {
            wp_enqueue_script("wpetracker_ajax", plugin_dir_url(__FILE__) . 'assets/js/ajax.js', array('jquery'));
        }

        if (isset($_GET['page'])) {
            if ($_GET['page'] == 'wpetracker-admin' || $_GET['page'] == 'buy-account') {
                wp_enqueue_style('wpetracker_style', plugin_dir_url(__FILE__) . 'assets/css/main.css');
            }
        }
        // make the ajaxurl var available to the above script
        wp_localize_script('wpetracker_ajax', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
    }

    /**
     * @author Eno Hoxha
     * @email eno4hoxha@gmail.com
     * --------------------------------------------
     * Function wpetracker_options
     */
    function wpetracker_options() {
        include 'views/options.php';
    }

    /**
     * @author Eno Hoxha & Arber Braja
     * @email eno4hoxha@gmail.com
     * --------------------------------------------
     * Function wpetracker_get_main_tracking_script
     */
    function wpetracker_get_main_tracking_script() {
        $wpetrackerKey = get_option('wpetracker-key');
		//K. Meffert: Add own plugin version to etracker call (as requested by etracker)
		//Don't use get_plugin_data as this only works for logged in admins
		$plugin_data = get_file_data(__FILE__, array('Version' => 'Version'), false);
		$wp_version_plugin = $plugin_data['Version'];
        if ( is_singular() ) { // check if we are on a single post/page/attachment view

            $et_pagename = get_post_meta(get_the_ID(), "wpetracker-page", true);
            $et_areas = get_post_meta(get_the_ID(), "wpetracker-area", true);
            $et_url = get_option("wpetracker-url") . '' . $this->wpetracker_add_or_change_parameter(''); ?>

                <!-- Copyright (c) 2000-2019 etracker GmbH. All rights reserved. -->
                <!-- This material may not be reproduced, displayed, modified or distributed -->
                <!-- without the express prior written permission of the copyright holder. -->
                <!-- etracker tracklet 4.1 -->
                <script id="trcs" type="text/javascript">
                    var et_pagename = "<?php echo $et_pagename; ?>";
                    var et_areas = "<?php echo $et_areas; ?>";
                    var et_url = "<?php echo $et_url; ?>";
                    // var et_tval = "";
                    // var et_tonr = "";
                    // var et_tsale = 0;
                    // var et_basket = "";
                    // var et_cust = 0;
                </script>
                <script id="_etLoader" type="text/javascript" charset="UTF-8" data-respect-dnt="true" data-secure-code="<?php echo $wpetrackerKey; ?>" data-plugin-version="Wordpress_<?php echo $wp_version_plugin; ?>" src="//static.etracker.com/code/e.js"></script>
<?php if(get_option('youtube_tracking_option') == 'on') { ?>
<!-- YouTube Tracking -->
<?php } ?>

                <!-- etracker tracklet 4.1 end -->

            <?php	
        } elseif ( is_category() ) { // check if we are archive by category view
            $et_pagename = get_option("wpetracker-page");
            $et_areas = get_option("wpetracker-area");
            $et_url = get_option("wpetracker-url"); ?>

                <!-- Copyright (c) 2000-2017 etracker GmbH. All rights reserved. -->
                <!-- This material may not be reproduced, displayed, modified or distributed -->
                <!-- without the express prior written permission of the copyright holder. -->
                <!-- etracker tracklet 4.1 -->
                <script id="trcs" type="text/javascript">
                    var et_pagename = "<?php echo $et_pagename ?>";
                    var et_areas = "<?php echo $et_areas ?>";
                    var et_url = "<?php echo $et_url ?>";
                    // var et_tval = "";
                    // var et_tonr = "";
                    // var et_tsale = 0;
                    // var et_basket = "";
                    // var et_cust = 0;
                </script>
                <script id="_etLoader" type="text/javascript" charset="UTF-8" data-respect-dnt="true" data-secure-code="<?php echo $wpetrackerKey; ?>" data-plugin-version="Wordpress_<?php echo $wp_version_plugin; ?>" src="http://static.etracker.com/code/e.js"></script>
                <!-- etracker tracklet 4.1 end -->
            <?php	
        } else { // all other remaining views
            $wc_shop_page_page = get_post_meta(get_option('woocommerce_shop_page_id'), "wpetracker-page", true);
            $wc_shop_page_area = get_post_meta(get_option('woocommerce_shop_page_id'), "wpetracker-area", true);
            $et_url = get_option("wpetracker-url") . '' . $this->wpetracker_add_or_change_parameter('');
            
            if (empty ($wc_shop_page) && empty ($wc_shop_page_area)) {
                $set = __('Startseite', 'wpetracker');
                $set2 = __('Startseite', 'wpetracker');
            } else {
                $set = $wc_shop_page_page;
                $set2 = $wc_shop_page_area;
            } ?>

	            <!-- Copyright (c) 2000-2016 etracker GmbH. All rights reserved. -->
	            <!-- This material may not be reproduced, displayed, modified or distributed -->
	            <!-- without the express prior written permission of the copyright holder. -->
	            <!-- etracker tracklet 4.1 -->
	            <script id="trcs" type="text/javascript">
	                var et_pagename = "<?php echo $set; ?>";
	                var et_areas = "<?php echo $set2; ?>";
	                var et_url = "<?php echo $et_url; ?>";
	                // var et_tval = "";
	                // var et_tonr = "";
	                // var et_tsale = 0;
	                // var et_basket = "";
	                // var et_cust = 0;
	                <?php if ( is_search() ) : ?>
		                var cc_attributes = new Object();
		                cc_attributes["etcc_cu"] = "onsite";
						<?php
					// K. Meffert: Correction: Instead of the ordinary search call the internal search
					/*
		                cc_attributes["suchwort"] = "<?php echo esc_html(get_search_query()); ?>";
		                cc_attributes["etcc_cmp"] = "<?php echo $this->is_search_has_results(); ?>";   
		                cc_attributes["etcc_med"] = "<?php echo $this->wpetracker_has_search_param(); ?>";
					*/
					?>
						cc_attributes["etcc_st_onsite"] = "<?php echo esc_html(get_search_query()); ?>";
						<?php 
						  //if($this->is_search_has_results()) {
						  if($this->is_search_has_results2()) {
							  $resultText='mit Ergebnis';
						  }else {
							  $resultText='ohne Ergebnis';
						  }
						?>
		                cc_attributes["etcc_cmp_onsite"] = "<?php echo $resultText; ?>";
		                cc_attributes["etcc_med_onsite"] = "Interne Suche";//Onsite_Suche
			        <?php endif; ?>
	            </script>
	            <script id="_etLoader" type="text/javascript" charset="UTF-8" data-respect-dnt="true" data-secure-code="<?php echo $wpetrackerKey; ?>" data-plugin-version="Wordpress_<?php echo $wp_version_plugin; ?>" src="//static.etracker.com/code/e.js"></script>
<?php if(get_option('youtube_tracking_option') == 'on') { ?>
<!-- YouTube Tracking -->
<?php } ?>
	            <!-- etracker tracklet 4.1 end -->

            <?php	
        }

    }

    function wpetracker_add_tracking_script() {
    	if (get_option('wpetracker_accept_tos') == 'on') {
//			wp_enqueue_script('etracker-tracking',$code,);
    		Tracklet::wpetracker_get_main_tracking_script();
    	}
    }

    /**
     * @author Eno Hoxha
     * @email eno4hoxha@gmail.com
     * --------------------------------------------
     * Function is_search_has_results
     * @return string
    --------------------------------------------
     */
    function is_search_has_results() {
        global $wp_query;
        $result = (0 != $wp_query->found_posts) ? _e('With Results', 'wpetracker') : _e('Without Results', 'wpetracker');
        return $result;
    }

    /**
     * @author Klaus Meffert
     * --------------------------------------------
     * Function is_search_has_results2
     * @return boolean
    --------------------------------------------
     */
    function is_search_has_results2() {
        global $wp_query;
        if(0 != $wp_query->found_posts){
			return true;
		}
        return false;
    }
    /**
     * @author Eno Hoxha
     * @email eno4hoxha@gmail.com
     * --------------------------------------------
     * Function wpetracker_has_search_param
     * @return string
    --------------------------------------------
     */
    function wpetracker_has_search_param() {
        $response = ($_GET == null) ? _e('Search', 'wpetracker') : _e('Header Search', 'wpetracker');
        return $response;
    }

    /**
     * @author Eno Hoxha
     * @email eno4hoxha@gmail.com
     * --------------------------------------------
     * Function wpetracker_add_or_change_parameter
     *
     * @param $parameter
     *
     * @return string
    --------------------------------------------
     */
    function wpetracker_add_or_change_parameter($parameter) {
        $output = "?";
        $firstRun = true;
        foreach ($_GET as $key => $val) {
            if ($key != $parameter) {
                if (!$firstRun) {
                    $output .= "&";
                } else {
                    $firstRun = false;
                }
				//KM: maybe this would work, too, but seems unnecessary:
				//$filtered_val = filter_input(INPUT_GET, $key);
                $output .= rawurlencode($key) . "=" . rawurlencode($val);
            }
        }
        return ($output);
    }

}

new Tracklet();