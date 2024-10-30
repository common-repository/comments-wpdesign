<?php
/**
 * @package  CommentryStyle
 */
/*
Plugin Name: Comments - wpDesign
Plugin URI: https://getwebinc.com
Description: Awesome Comment Style Plugin.
Version: 1.0.0
Author: M A  Monim
Author URI: https://facebook.com/with.rain79
License: GPLv2
Text Domain: wpdesign
*/

// If this file is called firectly, abort!!!
defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );

/**
* Constant
* Feature added by : Abu Sayed Russell <abusayedrussell@gmail.com>
* Date       : 18.04.2020
*/
if (!defined("CWPD_VERSION"))
    define("CWPD_VERSION", '1.0.0');

if (!defined("CWPD_WP_VERSION"))
    define("CWPD_WP_VERSION", '4.9');

if (!defined("CWPD_PHP_VERSION"))
    define("CWPD_PHP_VERSION", '5.6.0');

if (!defined("CWPD_FILE"))
    define("CWPD_FILE", __FILE__);

if (!defined("CWPD_PLUGIN_BASE"))
    define("CWPD_PLUGIN_BASE", plugin_basename(CWPD_FILE));

if (!defined("CWPD_PLUGIN_DIR_PATH"))
    define("CWPD_PLUGIN_DIR_PATH", plugin_dir_path(CWPD_FILE));

if (!defined("CWPD_PLUGIN_DIR_URL"))
    define("CWPD_PLUGIN_DIR_URL", plugin_dir_url(CWPD_FILE));

// Require once the Composer Autoload
if ( version_compare( PHP_VERSION, CWPD_PHP_VERSION, '>=' ) ) {
    require_once ( CWPD_PLUGIN_DIR_PATH . '/vendor/autoload.php' );
}else{
    add_action( 'admin_notices',  'cwpd_php_version_error_warning');
}

function cwpd_php_version_error_warning( ) {
        $php_version = phpversion();
         ?>
        <div class="notice notice-warning mmwps-warning">
         <p><?php echo sprintf( __("Your current PHP version is <strong> $php_version </strong>. You need to upgrade your PHP version to <strong> ".CWPD_PHP_VERSION." or later</strong> to run Comments - wpDesign.", "wpdesign" ) ); ?></p>
        </div>
    <?php
}

/**
 * The code that runs during plugin activation
 */
if ( version_compare( PHP_VERSION, CWPD_PHP_VERSION, '>=' ) ) {
    function cwpd_active_wpdesign() {
    	CWPD\Setup\CWPDActivate::cwpd_activatePluginFlush();
    }
    register_activation_hook( __FILE__, 'cwpd_active_wpdesign' );
}
/**
 * The code that runs during plugin deactivation
 */
if ( version_compare( PHP_VERSION, CWPD_PHP_VERSION, '>=' ) ) {
    function cwpd_deactivate_wpdesign() {
    	CWPD\Setup\CWPDDeactivate::cwpd_deactivatePluginFlash();
    }
    register_deactivation_hook( __FILE__, 'cwpd_deactivate_wpdesign' );
}
/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( 'CWPD\\CWPD' ) ) {
	CWPD\CWPD::cwpd_registerServices();
}