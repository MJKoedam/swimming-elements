<?php
/*
Plugin Name: Swimming Elements for Elementor
Plugin URI: 
Description: Adds swimming animated elements to your posts/pages using Elementor widgets.
Version: 1.0
Author: Mart-Jan Koedam
Author URI: 
License: GPL v2 or later
*/

// Enqueue styles
function swimming_elements_enqueue_styles() {
    wp_enqueue_style('swimming-elements', plugins_url('css/swimming-elements.css', __FILE__), array(), '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'swimming_elements_enqueue_styles');

// Load Elementor Widgets
function swimming_elements_load_widget() {
    // Ensure Elementor is loaded before the plugin
    if( did_action('elementor/loaded') ) {
        // Include Widget File
        require_once(__DIR__ . '/widgets/swimming-element-widget.php');
        // Register Widget
        add_action('elementor/widgets/widgets_registered', function($widgets_manager) {
            $widgets_manager->register(new \Elementor_Swimming_Element_Widget());
        });
    }
}
add_action('init', 'swimming_elements_load_widget');
?>
