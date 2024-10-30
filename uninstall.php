<?php

/**
 * Trigger this file on Plugin uninstall
 *
 * @package  CommentryStyle
 */

/** Exit if uninstall.php is not called by WordPress. */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}
function cwpd_remove_data() {
	delete_option('cwpd_version');
	delete_option('cwpd_wp_design');
	delete_option('cwpd_setting_data');
}
cwpd_remove_data();