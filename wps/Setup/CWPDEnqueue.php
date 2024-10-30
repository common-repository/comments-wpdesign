<?php
/**
 * @package  CommentswpDesign
 * @developer  name : Abu Sayed Russell
 */
namespace CWPD\Setup;
if (!class_exists('CWPDEnqueue')) {
	class CWPDEnqueue
	{

	    public function cwpd_register()
	    {
	    	if ( ( is_admin() && isset($_GET['page'])  && ( $_GET["page"] == "cwpd" || $_GET['page'] == 'cwpd' ))) {
				add_action( 'admin_enqueue_scripts', array( $this, 'cpwd_enqueue_script_admin' ) );
			}
	      	add_action( 'wp_enqueue_scripts', [$this, 'cpwd_enqueue_script_front'] );	
	    }
	    /**
		 * Admin Script
		 * @return string
		 * Feature added by : Abu Sayed Russell <abusayedrussell@gmail.com>
		 * Date       : 19.04.2020
		*/
	    public function cpwd_enqueue_script_admin(){
			$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
			if ( ( isset($_GET['page']) && ( $_GET['page'] == 'cwpd' || $_GET['page'] == 'cwpd' ))) {
				wp_enqueue_script('jquery');
				wp_enqueue_style("cwpd-font",  cwpd_plugin_url('/assets/plugins/font-awesome/css/font-awesome.min.css'), null , CWPD_VERSION);
							wp_enqueue_style("cwpd-reset", cwpd_plugin_url('/assets/css/reset.css'), null , CWPD_VERSION);
				wp_enqueue_style("cwpd-robot", cwpd_plugin_url('/assets/plugins/roboto/roboto.css'), null , CWPD_VERSION);
				wp_enqueue_style("cwpd-vendor", cwpd_plugin_url('/assets/plugins/app-build/vendor.css'), null , CWPD_VERSION);
				wp_enqueue_style("cwpd-animate", cwpd_plugin_url('/assets/plugins/notify/animate.css'), null , CWPD_VERSION);
				wp_enqueue_style("cwpd-main", cwpd_plugin_url('/assets/plugins/app-build/main.css'), null , CWPD_VERSION);
				wp_enqueue_script("cwpd-boots", cwpd_plugin_url('/assets/plugins/bootstrap/js/bootstrap.min.js'),array( 'jquery' ), CWPD_VERSION, true);
				wp_enqueue_script("cwpd-notify", cwpd_plugin_url('/assets/plugins/notify/notify.min.js'), array( 'jquery' ), CWPD_VERSION, true);			
				wp_enqueue_script("cwpd-main", cwpd_plugin_url('/assets/plugins/app-build/main.js'), array( 'jquery' ), CWPD_VERSION, true);
			}
	    }
	    /**
		* Front Script
		* Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
		* Date       : 06.04.2020
		*/
	    public function cpwd_enqueue_script_front(){
	    	wp_enqueue_script('jquery');
			wp_enqueue_style("cwpd-css", cwpd_plugin_url('/assets/css/comments_style_front.css'), array(), CWPD_VERSION, false);
			wp_enqueue_script("ajax_comments_load", cwpd_plugin_url('/assets/js/comments_js_front.js'), array('jquery'), CWPD_VERSION, true);
			wp_localize_script( 'ajax_comments_load', 'cwpd_ajax_comment_params', array(
				'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php'
			) );
	    }
	}
}