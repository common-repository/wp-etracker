<?php

/**
 * Class WpeTrackerActions
 */
class WpeTrackerActions {

    static function wpetracker_on_activate() {
        add_option('opt_val_cat', '');
    }

    function wpetracker_on_deactivate() {
        // nothing happens on deactivate
    }

    function wpetracker_on_unistall() {
        delete_option('wpetracker_area_class');
        delete_option('wpetracker_mod_id');
        delete_option('wpetracker-url');
        delete_option('wpetracker_page_class');
        delete_option('wpetracker_cus');
        delete_option('wpetracker_area_posts');
        delete_option('wpetracker_opt_val_cat');
        delete_option('wpetracker_page_area');
        delete_option('wpetracker_opt_val_page');
    }
}