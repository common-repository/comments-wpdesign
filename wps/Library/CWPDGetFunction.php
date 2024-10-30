<?php
/**
 * @package  CommentswpDesign
 * @developer  name : Abu Sayed Russell
 */
namespace CWPD\Library;

if (!class_exists('CWPDGetFunction')) {

	class CWPDGetFunction {
		/**
		 * Enable Load Comment Button
		 * @return string
		 * Feature added by : Abu Sayed Russell <abusayedrussell@gmail.com>
		 * Date       : 19.04.2020
		*/
		public static function cwpd_last_code_load_enable(){
			$cwpdloadEnableOption  = get_option( 'cwpd_setting_data' ) ? : array();
	      	$laodenable = isset($cwpdloadEnableOption[1]["cwpd_read_more_enable"]) ? $cwpdloadEnableOption[1]["cwpd_read_more_enable"]: 1;
	      	return $laodenable;
		}
		/**
		 * Enable Budget Icon
		 * @return string
		 * Feature added by : Abu Sayed Russell <abusayedrussell@gmail.com>
		 * Date       : 19.04.2020
		*/
		public static function cwpd_last_code_budget_icon(){
			$cwpdloadEnableOption  = get_option( 'cwpd_setting_data' ) ? : array();
	      	$enableBudget = isset($cwpdloadEnableOption[1]["cwpd_comment_budget_icon"]) ? $cwpdloadEnableOption[1]["cwpd_comment_budget_icon"]: 1;
	      	return $enableBudget;
		}
		/**
		 * Enable Load Comment Button
		 * @return string
		 * Feature added by : Abu Sayed Russell <abusayedrussell@gmail.com>
		 * Date       : 19.04.2020
		*/
		public static function cwpd_last_code_load_text(){
			$cwpdreadtextOption  = get_option( 'cwpd_setting_data' ) ? : array();
	      	$cwpd_read_text = isset($cwpdreadtextOption[1]["cwpd_read_text"]) ? $cwpdreadtextOption[1]["cwpd_read_text"]: "Load More";
	      	return $cwpd_read_text;
		}
		/**
		 * Enable Load Comment Button
		 * @return string
		 * Feature added by : Abu Sayed Russell <abusayedrussell@gmail.com>
		 * Date       : 19.04.2020
		*/
		public static function cwpd_last_code_loading_text(){
			$cwpdreadtextOption  = get_option( 'cwpd_setting_data' ) ? : array();
	      	$cwpd_read_text = isset($cwpdreadtextOption[1]["cwpd_loading"]) ? $cwpdreadtextOption[1]["cwpd_loading"]: "Loading...";
	      	return $cwpd_read_text;
		}
		/**
		 * Avater Size
		 * @return string
		 * Feature added by : Abu Sayed Russell <abusayedrussell@gmail.com>
		 * Date       : 19.04.2020
		*/
		public static function cwpd_last_code_avater_size(){
			$cwpdreadtextOption  = get_option( 'cwpd_setting_data' ) ? : array();
	      	$cwpd_av_size = isset($cwpdreadtextOption[1]["cwpd_comment_avater_size"]) ? $cwpdreadtextOption[1]["cwpd_comment_avater_size"]: "Load More";
	      	return $cwpd_av_size;
		}
		/**
		 * Avater Size
		 * @return string
		 * Feature added by : Abu Sayed Russell <abusayedrussell@gmail.com>
		 * Date       : 19.04.2020
		*/
		public static function cwpd_last_code_per_page(){
			$cwpdreadtextOption  = get_option( 'cwpd_setting_data' ) ? : array();
	      	$cwpd_perpage = isset($cwpdreadtextOption[1]["cwpd_comment_perpage"]) ? $cwpdreadtextOption[1]["cwpd_comment_perpage"]: 5;
	      	return $cwpd_perpage;
		}
		/**
		 * Scroll to loading
		 * @return string
		 * Feature added by : Abu Sayed Russell <abusayedrussell@gmail.com>
		 * Date       : 19.04.2020
		*/
		public static function cwpd_last_code_scroll(){
			$cwpdreadtextOption  = get_option( 'cwpd_setting_data' ) ? : array();
	      	$cwpd_scroll = isset($cwpdreadtextOption[1]["cwpd_enable_load_by_scroll"]) ? $cwpdreadtextOption[1]["cwpd_enable_load_by_scroll"]: '';
	      	return $cwpd_scroll;
		}
	}
}