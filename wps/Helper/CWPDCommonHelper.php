<?php 
/**
 * @package  CommentswpDesign
 * @developer  name : Abu Sayed Russell
 */

/**
 * plugin url
 * @param  string  $path  file path
 * @return string
 * Feature added by : Abu Sayed Russell <abusayedrussell@gmail.com>
 * Date       : 18.04.2020
*/
if ( ! function_exists( 'cwpd_plugin_url' ) ) {
	function cwpd_plugin_url( $path = '' ) {
	  $url = plugins_url( $path, CWPD_FILE );

	  if ( is_ssl()
	  and 'http:' == substr( $url, 0, 5 ) ) {
	    $url = 'https:' . substr( $url, 5 );
	  }
	  return $url;
	}
}
/**
 * Setting Page Hook
 * @return string
 * Feature added by : Abu Sayed Russell <abusayedrussell@gmail.com>
 * Date       : 19.04.2020
*/
if ( ! function_exists( 'cwpd_admin_setting_form' ) ) {
    function cwpd_admin_setting_form() {
        ob_start();
        ?>
        <input type="hidden" id="security_setting" name="security" value="<?php echo wp_create_nonce( 'cwpd_setting_nonce' ); ?>"/>
        <form id="setting_form" method="post" action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>">
         <?php 
            settings_errors();
            settings_fields( 'cwpd_setting_field' );
            do_settings_sections( 'cwpd_setting_page' );
         ?>
         <button id="of_save_setting" type="button" class="btn btn-info save-and-add-setting save_button save_setting"> <?php esc_html_e( 'Save Changes', 'wpdesign' ); ?></button>
        </form>
        <?php
        $output = ob_get_clean();
        echo $output;
    }
}
add_action( 'cwpd_admin_email_setting', 'cwpd_admin_setting_form', 10 );