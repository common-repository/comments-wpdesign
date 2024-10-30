<?php
/**
 * @package  CommentswpDesign
 * @developer  name : Abu Sayed Russell
 */
namespace CWPD\Setup;

if (!class_exists('CWPDDeactivate')) {
	/**
	 * Deactive Plugin
	 * @return string
	 * Feature added by : Abu Sayed Russell <abusayedrussell@gmail.com>
	 * Date       : 19.04.2020
	*/
	class CWPDDeactivate{
 		public static function cwpd_deactivatePluginFlash() {
			flush_rewrite_rules();
		}
	}
}