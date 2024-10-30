<?php
/**
 * @package  CommentswpDesign
 * @developer  name : Abu Sayed Russell
 */
namespace CWPD\Common;
class CWPDAjaxController{
	
	public function cwpd_register()
    {
        add_action( 'wp_ajax_ajax_setting_action', array( $this, 'cwpd_ajax_handler' ) );
    }
    /**
	 * Setting Data option
	 * @return string
	 * Feature added by : Abu Sayed Russell <abusayedrussell@gmail.com>
	 * Date       : 19.04.2020
	*/
	private function cwpd_setting_options($data, $key = null) {
		global $settings_data;
		if (empty($data))
		return;

		if ($key != null) { 
			update_option('cwpd_setting_data',array($key, $data));
		} else { 
			foreach ( $data as $k=>$v ) {
				if (!isset($settings_data[$k]) || $settings_data[$k] != $v) {
					update_option('cwpd_setting_data',array($k, $v));
				} else if (is_array($v)) {
					foreach ($v as $key=>$val) {
						if ($key != $k && $v[$key] == $val) {
						update_option('cwpd_setting_data',array($k, $v));
						break;
						}
					}
				}
			}
		}
	}
	/**
	 * Setting Save Handler
	 * @return string
	 * Feature added by : Abu Sayed Russell <abusayedrussell@gmail.com>
	 * Date       : 19.04.2020
	*/
    public function cwpd_ajax_handler()
	{
		$nonce = sanitize_text_field($_POST['security']);
		if (! wp_verify_nonce($nonce, 'cwpd_setting_nonce') ) die('-1');
		$save_type = sanitize_text_field($_POST['type']);

		if ($save_type == 'save_cwpd_setting')
		{
			wp_parse_str($_POST['data'], $settings_data);
			unset($settings_data['security']);
			self::cwpd_setting_options($settings_data);
			die('1');
		}
		die();
	}
}
