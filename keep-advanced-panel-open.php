<?php
/*
Plugin Name: Keep Advanced Panel Open
Plugin URI: https://github.com/webdevdave/keep-advanced-panel-open
Description: Keeps the Advanced panel open by default in the WordPress block editor.
Version: 1.0
Author: Dave Williams
Author URI: https://webdevdave.com/
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
Text Domain: keep-advanced-panel-open
Domain Path: /languages
Requires at least: 5.0
Requires PHP: 7.2
*/
 
 // Ensure WordPress is running
 if (!defined('ABSPATH')) {
     exit;
 }
 
 function keep_advanced_panel_open_enqueue_script() {
     // Only enqueue the script in the block editor
     if (is_admin() && function_exists('get_current_screen')) {
         $screen = get_current_screen();
         if ($screen && $screen->is_block_editor()) {
             wp_enqueue_script(
                 'keep-advanced-panel-open',
                 plugin_dir_url(__FILE__) . 'js/keep-advanced-panel-open.js',
                 array('wp-blocks', 'wp-dom-ready', 'wp-edit-post'),
                 filemtime(plugin_dir_path(__FILE__) . 'js/keep-advanced-panel-open.js'),
                 true
             );
         }
     }
 }
 add_action('admin_enqueue_scripts', 'keep_advanced_panel_open_enqueue_script');
