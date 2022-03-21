<?php
/*
Plugin Name: RRdevs For Elementor
Plugin URI: https://github.com/masumskaib396/rrdevs-for-elementor
Description: The RRdevs is an Elementor helping plugin that will make your designing work easier.
Our specialities are custom CSS, Nested section, Creative Buttons.
Version: 1.0.3
Author: rrdevs
Author URI: https://profiles.wordpress.org/rrdevs
License: GPLv2 or later
Text Domain: rrdevs-addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//Set plugin version constant.
define( 'RRDEVS_VERSION', '1.0.3');

/* Set constant path to the plugin directory. */
define( 'RRDEVS_WIDGET', trailingslashit( plugin_dir_path( __FILE__ ) ) );
// Plugin Function Folder Path
define( 'RRDEVS_WIDGET_INC', plugin_dir_path( __FILE__ ) . 'inc/' );

// Plugin Extensions Folder Path
define( 'RRDEVS_WIDGET_EXTENSIONS', plugin_dir_path( __FILE__ ) . 'extensions/' );

// Plugin Widget Folder Path
define( 'RRDEVS_WIDGET_DIR', plugin_dir_path( __FILE__ ) . 'widgets/' );

// Assets Folder URL
define( 'RRDEVS_ASSETS_PUBLIC', plugins_url( 'assets', __FILE__ ) );

// Assets Folder URL
define( 'RRDEVS_ASSETS_VERDOR', plugins_url( 'assets/vendor', __FILE__ ) );


require_once( RRDEVS_WIDGET_INC . 'helper-function.php');
require_once( RRDEVS_WIDGET_INC . 'Classes/breadcrumb-class.php');
require_once( RRDEVS_WIDGET . 'base.php' );

?>
