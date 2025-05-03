<?php
/*
Plugin Name: Text Carousel MultiSlider
Description: Multiple sliders with responsive settings and shortcode.
Version: 1.0
Author: Abhitej Vissamsetty
*/

if (!defined('ABSPATH')) exit;

require_once plugin_dir_path(__FILE__) . 'includes/cpt-slider.php';
require_once plugin_dir_path(__FILE__) . 'includes/cpt-slide.php';
require_once plugin_dir_path(__FILE__) . 'shortcodes/slider-shortcode.php';

add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('tcp-slider-style', plugin_dir_url(__FILE__) . 'assets/css/slider.css');
    wp_enqueue_script('tcp-slider-script', plugin_dir_url(__FILE__) . 'assets/js/slider.js', [], false, true);
});
