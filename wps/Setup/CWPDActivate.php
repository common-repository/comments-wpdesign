<?php
/**
 * @package  CommentswpDesign
 * @developer  name : Abu Sayed Russell
 */
namespace CWPD\Setup;
if (!class_exists('CWPDActivate')) {
	class CWPDActivate{
		/**
		 * Active Plugin
		 * @return string
		 * Feature added by : Abu Sayed Russell <abusayedrussell@gmail.com>
		 * Date       : 19.04.2020
		*/
	    public static function cwpd_activatePluginFlush() {
			flush_rewrite_rules();

			$default = array();
			if ( ! get_option( 'cwpd_version' ) ) {
				update_option( 'cwpd_version', CWPD_VERSION );
			}
			if ( ! get_option( 'cwpd_wp_design' ) ) {
				update_option( 'cwpd_wp_design', 'last_code_cwpd' );
			}
			if ( ! get_option( 'cwpd_setting_data' ) ) {
			update_option( 'cwpd_setting_data', $default );
		}
		}
	}
}