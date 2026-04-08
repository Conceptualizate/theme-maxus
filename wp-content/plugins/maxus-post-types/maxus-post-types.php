<?php
/*
    Plugin Name: Maxus - Post Types
    Plugin URI: https://maxus-noack.local/
    Description: Registra los Custom Post Types y Taxonomías para el sitio Maxus Noack.
    Version: 1.0.0
    Author: CODE ATD
    Author URI: https://www.instagram.com/elconceptodigital/
    Text Domain: maxus-post-types
*/

if (! defined('ABSPATH')) exit;

/**
 * Register Custom Post Type: Slider.
 */
function maxus_slider_post_type()
{
    $labels = array(
        'name'                  => _x('Sliders', 'Post Type General Name', 'maxus-post-types'),
        'singular_name'         => _x('Slider', 'Post Type Singular Name', 'maxus-post-types'),
        'menu_name'             => __('Sliders', 'maxus-post-types'),
        'name_admin_bar'        => __('Slider', 'maxus-post-types'),
        'archives'              => __('Listado de Sliders', 'maxus-post-types'),
        'all_items'             => __('Todos los Sliders', 'maxus-post-types'),
        'add_new_item'          => __('Añadir nuevo Slider', 'maxus-post-types'),
        'add_new'               => __('Añadir nuevo', 'maxus-post-types'),
        'new_item'              => __('Nuevo Slider', 'maxus-post-types'),
        'edit_item'             => __('Editar Slider', 'maxus-post-types'),
        'update_item'           => __('Actualizar Slider', 'maxus-post-types'),
        'view_item'             => __('Ver Slider', 'maxus-post-types'),
        'search_items'          => __('Buscar Sliders', 'maxus-post-types'),
        'not_found'             => __('No se encontraron sliders', 'maxus-post-types'),
        'not_found_in_trash'    => __('No hay sliders en la papelera', 'maxus-post-types'),
        'featured_image'        => _x('Imagen de fondo', 'Overrides the "Featured Image" phrase.', 'maxus-post-types'),
        'set_featured_image'    => _x('Establecer imagen de fondo', 'Overrides the "Set featured image" phrase.', 'maxus-post-types'),
        'remove_featured_image' => _x('Eliminar imagen de fondo', 'Overrides the "Remove featured image" phrase.', 'maxus-post-types'),
        'use_featured_image'    => _x('Usar como imagen de fondo', 'Overrides the "Use as featured image" phrase.', 'maxus-post-types'),
    );
    $args = array(
        'label'               => __('Sliders', 'maxus-post-types'),
        'description'         => __('Slides del hero de la portada.', 'maxus-post-types'),
        'labels'              => $labels,
        'supports'            => array('title', 'thumbnail', 'page-attributes'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-images-alt2',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => false,
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => true,
        'publicly_queryable'  => false,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
    );
    register_post_type('slider', $args);
}
add_action('init', 'maxus_slider_post_type', 0);

/**
 * Register Custom Post Type: Modelo.
 */
function maxus_modelo_post_type()
{
    $labels = array(
        'name'                  => _x('Modelos', 'Post Type General Name', 'maxus-post-types'),
        'singular_name'         => _x('Modelo', 'Post Type Singular Name', 'maxus-post-types'),
        'menu_name'             => __('Modelos', 'maxus-post-types'),
        'name_admin_bar'        => __('Modelo', 'maxus-post-types'),
        'archives'              => __('Listado de Modelos', 'maxus-post-types'),
        'all_items'             => __('Todos los Modelos', 'maxus-post-types'),
        'add_new_item'          => __('Añadir nuevo Modelo', 'maxus-post-types'),
        'add_new'               => __('Añadir nuevo', 'maxus-post-types'),
        'new_item'              => __('Nuevo Modelo', 'maxus-post-types'),
        'edit_item'             => __('Editar Modelo', 'maxus-post-types'),
        'update_item'           => __('Actualizar Modelo', 'maxus-post-types'),
        'view_item'             => __('Ver Modelo', 'maxus-post-types'),
        'search_items'          => __('Buscar Modelos', 'maxus-post-types'),
        'not_found'             => __('No se encontraron modelos', 'maxus-post-types'),
        'not_found_in_trash'    => __('No hay modelos en la papelera', 'maxus-post-types'),
        'featured_image'        => _x('Imagen del modelo', 'Overrides the "Featured Image" phrase.', 'maxus-post-types'),
        'set_featured_image'    => _x('Establecer imagen del modelo', 'Overrides the "Set featured image" phrase.', 'maxus-post-types'),
        'remove_featured_image' => _x('Eliminar imagen del modelo', 'Overrides the "Remove featured image" phrase.', 'maxus-post-types'),
        'use_featured_image'    => _x('Usar como imagen del modelo', 'Overrides the "Use as featured image" phrase.', 'maxus-post-types'),
    );
    $args = array(
        'label'               => __('Modelos', 'maxus-post-types'),
        'description'         => __('Catálogo de vehículos Maxus.', 'maxus-post-types'),
        'labels'              => $labels,
        'supports'            => array('title', 'editor', 'thumbnail'),
        'taxonomies'          => array('categoria_modelo'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 6,
        'menu_icon'           => 'dashicons-car',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
    );
    register_post_type('modelo', $args);
}
add_action('init', 'maxus_modelo_post_type', 0);

/**
 * Register Taxonomy: Categoría de Modelo.
 */
function maxus_categoria_modelo_taxonomy()
{
    $labels = array(
        'name'                       => _x('Categorías de Modelos', 'Taxonomy General Name', 'maxus-post-types'),
        'singular_name'              => _x('Categoría de Modelo', 'Taxonomy Singular Name', 'maxus-post-types'),
        'menu_name'                  => __('Categorías', 'maxus-post-types'),
        'all_items'                  => __('Todas las categorías', 'maxus-post-types'),
        'parent_item'                => __('Categoría superior', 'maxus-post-types'),
        'parent_item_colon'          => __('Categoría superior:', 'maxus-post-types'),
        'new_item_name'              => __('Nueva categoría', 'maxus-post-types'),
        'add_new_item'               => __('Añadir nueva categoría', 'maxus-post-types'),
        'edit_item'                  => __('Editar categoría', 'maxus-post-types'),
        'update_item'                => __('Actualizar categoría', 'maxus-post-types'),
        'view_item'                  => __('Ver categoría', 'maxus-post-types'),
        'search_items'               => __('Buscar categorías', 'maxus-post-types'),
        'not_found'                  => __('No se encontraron categorías', 'maxus-post-types'),
    );
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => false,
        'show_in_rest'      => true,
    );
    register_taxonomy('categoria_modelo', array('modelo'), $args);
}
add_action('init', 'maxus_categoria_modelo_taxonomy', 0);

/**
 * Register Custom Post Type: Servicio.
 */
function maxus_servicio_post_type()
{
    $labels = array(
        'name'                  => _x('Servicios', 'Post Type General Name', 'maxus-post-types'),
        'singular_name'         => _x('Servicio', 'Post Type Singular Name', 'maxus-post-types'),
        'menu_name'             => __('Servicios', 'maxus-post-types'),
        'name_admin_bar'        => __('Servicio', 'maxus-post-types'),
        'archives'              => __('Listado de Servicios', 'maxus-post-types'),
        'all_items'             => __('Todos los Servicios', 'maxus-post-types'),
        'add_new_item'          => __('Añadir nuevo Servicio', 'maxus-post-types'),
        'add_new'               => __('Añadir nuevo', 'maxus-post-types'),
        'new_item'              => __('Nuevo Servicio', 'maxus-post-types'),
        'edit_item'             => __('Editar Servicio', 'maxus-post-types'),
        'update_item'           => __('Actualizar Servicio', 'maxus-post-types'),
        'view_item'             => __('Ver Servicio', 'maxus-post-types'),
        'search_items'          => __('Buscar Servicios', 'maxus-post-types'),
        'not_found'             => __('No se encontraron servicios', 'maxus-post-types'),
        'not_found_in_trash'    => __('No hay servicios en la papelera', 'maxus-post-types'),
    );
    $args = array(
        'label'               => __('Servicios', 'maxus-post-types'),
        'description'         => __('Servicios ofrecidos por Maxus Noack.', 'maxus-post-types'),
        'labels'              => $labels,
        'supports'            => array('title'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 7,
        'menu_icon'           => 'dashicons-shield',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => false,
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => true,
        'publicly_queryable'  => false,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
    );
    register_post_type('servicio', $args);
}
add_action('init', 'maxus_servicio_post_type', 0);
