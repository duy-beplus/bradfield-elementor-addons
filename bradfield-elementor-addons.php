<?php
/**
 * Plugin Name: Bradfield Elementor Addon
 * Description: Custom Elementor Widgets for Bradfield Village Hall Project
 * Plugin URI:  https://elementor.com/
 * Version:     1.0.0
 * Author:      Beplus
 * Author URI:  https://developers.elementor.com/
 * Text Domain: bradfield-elementor-addon
 *
 * Elementor tested up to:     3.5.0
 * Elementor Pro tested up to: 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function bradfield_elementor_addon() {

	// Load plugin file
	require_once( __DIR__ . '/includes/plugin.php' );

	// Run the plugin
	\Bradfield_Elementor_Addon\Plugin::instance();

}
add_action( 'plugins_loaded', 'bradfield_elementor_addon' );
