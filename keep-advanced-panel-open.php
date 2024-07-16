<?php
/*
Plugin Name: Keep Advanced Panel Open
Description: Keeps the Advanced panel open by default in the WordPress block editor.
Version: 1.0
Author: WebDevDave
*/

// Ensure WordPress is running
if (!defined('ABSPATH')) {
    exit;
}

function keep_advanced_panel_open_enqueue_script() {
    // Only enqueue the script in the block editor
    if (function_exists('is_gutenberg_page') && is_gutenberg_page()) {
        wp_enqueue_script(
            'keep-advanced-panel-open',
            plugin_dir_url(__FILE__) . 'js/keep-advanced-panel-open.js',
            array('wp-blocks', 'wp-dom-ready', 'wp-edit-post'),
            filemtime(plugin_dir_path(__FILE__) . 'js/keep-advanced-panel-open.js'),
            true
        );
    }
}
add_action('enqueue_block_editor_assets', 'keep_advanced_panel_open_enqueue_script');