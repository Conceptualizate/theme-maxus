<?php

// Load queries
require_once get_template_directory() . '/queries.php';

// Set up and support theme

function maxus_setup()
{
    // Translations
    load_textdomain('maxus', get_template_directory() . '/languages');
    // Title tags
    add_theme_support('title-tag');
    // Featured images
    add_theme_support('post-thumbnails');
    // Custom logo
    add_theme_support('custom-logo');
    // Register menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'maxus'),
        'secondary' => __('Secondary Menu', 'maxus'),
        'footer' => __('Footer Menu 1', 'maxus'),
        'footer-2' => __('Footer Menu 2', 'maxus'),
        'footer-3' => __('Footer Menu 3', 'maxus'),
        'footer-4' => __('Footer Menu 4', 'maxus'),
    ));
}
add_action('after_setup_theme', 'maxus_setup');

// Enqueue scripts and styles
function maxus_scripts()
{
    // --- Styles ---

    // Normalize: CSS reset
    wp_enqueue_style('normalize', 'https://necolas.github.io/normalize.css/8.0.1/normalize.css', array(), '8.0.1');

    // Theme styles (depends on normalize)
    $css_path = get_stylesheet_directory() . '/style.css';
    $css_version = file_exists($css_path) ? filemtime($css_path) : '1.0.0';
    wp_enqueue_style('maxus-styles', get_stylesheet_uri(), array('normalize'), $css_version);

    // Swiper: slider styles
    wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css', array(), '12.1.3');

    // --- Scripts ---

    // Swiper: slider engine
    wp_enqueue_script('swiperjs', 'https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js', array(), '12.1.3', true);

    // GSAP: animation core
    wp_enqueue_script('gsap', 'https://cdn.jsdelivr.net/npm/gsap@3.14.2/dist/gsap.min.js', array(), '3.14.2', true);

    // GSAP SplitText: text split animation (depends on GSAP)
    wp_enqueue_script('gsap-split-text', 'https://cdn.jsdelivr.net/npm/gsap@3.14.2/dist/SplitText.min.js', array('gsap'), '3.14.2', true);

    // Theme JS (depends on Swiper, GSAP, SplitText)
    $js_path = get_stylesheet_directory() . '/js/main.js';
    $js_version = file_exists($js_path) ? filemtime($js_path) : '1.0.0';
    wp_enqueue_script(
        'maxus-scripts',
        get_stylesheet_directory_uri() . '/js/main.js',
        array('swiperjs', 'gsap', 'gsap-split-text'),
        $js_version,
        true
    );
}
add_action('wp_enqueue_scripts', 'maxus_scripts');

// Allow SVG
function add_file_types_to_uploads($file_types)
{
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes);
    return $file_types;
}
add_filter('upload_mimes', 'add_file_types_to_uploads');

// Custom excerpt length
function custom_excerpt_length($length)
{
    return 20;
}
add_filter('excerpt_length', 'custom_excerpt_length');

// Custom excerpt more
function custom_excerpt_more($more)
{
    return '...';
}
add_filter('excerpt_more', 'custom_excerpt_more');
