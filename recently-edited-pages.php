<?php
/**
 * recently-edited-pages.php
 * @author: Caspar Green <https://caspar.green/>
 * @package: ICaspar/FrequentlyEditedPages
 * @since: 1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:     iCaspar Recently Edited Pages Dashboard Widget
 * Plugin URI:      https://caspar.green/
 * Description:     A minimalist plugin to include Google Analytics.
 * Version:         0.1
 * Author:          Caspar Green
 * Author URI:      https://caspar.green/
 * Text Domain:     icaspar
 * Requires WP:     4.9
 * Requires PHP:    7.1
*/

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

if ( ! defined( 'ICASPAR_REP_PLUGIN_DIR' ) ) {
	define( 'ICASPAR_REP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'ICASPAR_REP_CONFIG_DIR' ) ) {
	define( 'ICASPAR_REP_CONFIG_DIR', ICASPAR_REP_PLUGIN_DIR . 'config/' );
}

if ( ! defined( 'ICASPAR_REP_PLUGIN_URL' ) ) {
	$plugin_url = plugin_dir_url( __FILE__ );
	if ( is_ssl() ) {
		$plugin_url = str_replace( 'http://', 'https://', $plugin_url );
	}
	define( 'ICASPAR_REP_PLUGIN_URL', $plugin_url );
}

if ( ! defined( 'ICASPAR_REP_ASSETS_URL' ) ) {
	define( 'ICASPAR_REP_ASSETS_URL', ICASPAR_REP_PLUGIN_URL . 'assets/' );
}

if ( ! defined( 'ICASPAR_REP_VERSION' ) ) {
	define( 'ICASPAR_REP_VERSION', '0.1' );
}

if ( version_compare( $GLOBALS['wp_version'], '4.9', '>=' ) ) {
	add_action( 'plugins_loaded', __NAMESPACE__ . '\launch' );
}

/**
 * Launch the plugin.
 *
 * @since 1.0.0
 *
 * @return void
 */
function launch() {
	require_once( __DIR__ . '/vendor/autoload.php' );
	$iC_REP = new \ICaspar\RecentlyEditedPages\RecentlyEditedPages();
	$iC_REP->hookWidgetToDashboard();
}