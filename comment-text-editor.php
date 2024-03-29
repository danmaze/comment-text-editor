<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           Comment_Text_Editor
 *
 * @wordpress-plugin
 * Plugin Name:       Comment Text Editor
 * Plugin URI:        https://nigerianscholars.com/
 * Description:       This plugin adds additional functionality for editting comments such as making text bold, italicized and writing simple math
 * Version:           1.0.0
 * Author:            Nigerian Scholars
 * Author URI:        https://nigerianscholars.com/
 * License:           Not Available
 * License URI:       https://nigerianscholars.com/
 * Text Domain:       comment-text-editor
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.1.6' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-comment-text-editor-activator.php
 */
function activate_comment_text_editor() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-comment-text-editor-activator.php';
	Comment_Text_Editor_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-comment-text-editor-deactivator.php
 */
function deactivate_comment_text_editor() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-comment-text-editor-deactivator.php';
	Comment_Text_Editor_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_comment_text_editor' );
register_deactivation_hook( __FILE__, 'deactivate_comment_text_editor' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-comment-text-editor.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_comment_text_editor() {

	$plugin = new Comment_Text_Editor();
	$plugin->run();

}
run_comment_text_editor();
