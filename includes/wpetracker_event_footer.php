<?php

class wpetracker_event_footer {

	//K. Meffert: Added data-plugin-version parameter, which contains the WordPress version

	function __construct() {

        // Register Tracking Events
		add_action( 'wp_enqueue_scripts', array($this, 'wpetracker_set_video_event') );
		add_action( 'wp_enqueue_scripts', array($this, 'wpetracker_set_iframe_event') );
		add_action( 'wp_enqueue_scripts', array($this, 'wpetracker_set_galery_event') );

		add_action( 'wp_login', array($this, 'wpetracker_login_sucess'), 1, 2 );
		add_action( 'admin_enqueue_scripts', array($this, 'wpetracker_login_check_helper') );
		add_action( 'login_enqueue_scripts', array($this, 'wpetracker_login_failed'), 10, 2 );

	}

	function wpetracker_set_video_event() {

		if( !is_admin() && get_option('wpetracker_accept_tos') == 'on' ) :
			wp_register_script( 'wpetracker-video-events', plugin_dir_url(__DIR__) . 'assets/js/trc_event_footer_video.js', array( 'jquery' ), WPETRACKER_PLUGIN_VER, true );
			wp_enqueue_script( 'wpetracker-video-events' );
		endif;

	}

	function wpetracker_set_iframe_event() {

		if( !is_admin() && get_option('wpetracker_accept_tos') == 'on' && get_option('youtube_tracking_option') == 'on') :
			wp_enqueue_script( 'vimeo-api', 'https://player.vimeo.com/api/player.js' );
			wp_register_script( 'wpetracker-iframe', plugin_dir_url(__DIR__) . 'assets/js/trc_event_footer_iframe.js', array( 'jquery' ), WPETRACKER_PLUGIN_VER, true );
			wp_enqueue_script( 'wpetracker-iframe' );
		endif;

	}

	function wpetracker_set_galery_event() {

		if( !is_admin() && get_option('wpetracker_accept_tos') == 'on' ) :
			wp_register_script( 'wpetracker-gallery-events', plugin_dir_url(__DIR__) . 'assets/js/trc_event_footer_galery.js', array( 'jquery' ), WPETRACKER_PLUGIN_VER, true );
			wp_enqueue_script( 'wpetracker-gallery-events' );
		endif;

	}

	function wpetracker_login_failed($user) {

		if( !is_admin() && get_option('wpetracker_accept_tos') == 'on' ) {
			if ( is_admin() ) {
              $plugin_data = get_plugin_data( __FILE__ );
              $wp_version_plugin = $plugin_data['Version'];
			} else {
				$wp_version_plugin="1.0.11";//TODO Quick Fix, besser machen
			}
			$wpetracker_key = get_option('wpetracker-key'); ?>

			<script id="_etLoader" type="text/javascript" charset="UTF-8" data-secure-code="<?php echo $wpetracker_key; ?>" data-plugin-version="Wordpress_<?php echo $wp_version_plugin; ?>" src="//static.etracker.com/code/e.js"></script>
			<noscript>
				<link rel="stylesheet" media="all" href="//www.etracker.de/cnt_css.php?et=<?php echo $wpetracker_key; ?>&amp;v=4.0&amp;java=n&amp;et_easy=0&amp;et_pagename=&amp;et_areas=&amp;et_ilevel=0&amp;et_target=,0,0,0&amp;et_lpage=0&amp;et_trig=0&amp;et_se=0&amp;wpetracker_cust=0&amp;et_basket=&amp;et_url=&amp;et_tag=&amp;et_sub=&amp;et_organisation=&amp;et_demographic="/>
			</noscript>
			<!-- etracker tracklet 4.0 end -->

			<script type="text/javascript">
				ET_Event.loginFailure('faliture');
			</script>

			<?php

		}

	}

	function wpetracker_login_sucess($user_login) {
		set_transient($user_login, '1', 0);
	}

	function wpetracker_login_check_helper() {

		if( get_option('wpetracker_accept_tos') == 'on' ) {

			$current_user = wp_get_current_user();

			if (!is_user_logged_in()) return;
			if (!get_transient($current_user->user_login)) return;

			if ( is_admin() ) {
              $plugin_data = get_plugin_data( __FILE__ );
              $wp_version_plugin = $plugin_data['Version'];
			} else {
				$wp_version_plugin="1.0.11";//TODO Quick Fix, besser machen
			}
			$wp_version_plugin = $plugin_data['Version'];

			$wpetracker_key = get_option('wpetracker-key'); ?>

			<script id="_etLoader" type="text/javascript" charset="UTF-8" data-secure-code="<?php echo $wpetracker_key; ?>" data-plugin-version="Wordpress_<?php echo $wp_version_plugin; ?>" src="//static.etracker.com/code/e.js"></script>
			<script type="text/javascript">
				_etracker.sendEvent(new et_AuthenticationSuccessEvent("' . $current_user->user_login . '"))
				ET_Event.loginSuccess();
			</script>

			<?php
			delete_transient($current_user->user_login);

		}

	}

}