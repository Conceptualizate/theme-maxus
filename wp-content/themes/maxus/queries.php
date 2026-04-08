<?php

if (!function_exists('maxus_get_hero_slides')) {
    function maxus_get_hero_slides()
    {
        // Consulting if the 'slider' is activated
        if (!post_type_exists('slider')) {
            return array();
        }

        // WordPress query to get all published 'slider' posts
        $args = array(
            'post_type'      => 'slider',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => array(
                'menu_order' => 'ASC',
                'date'       => 'DESC',
            )
        );

        $slides_query = new WP_Query($args);

        // If no slides found, return empty array
        if (!$slides_query->have_posts()) {
            return array();
        }

        $slides = array();

        // Loop through each slide and extract necessary data
        while ($slides_query->have_posts()) {
            $slides_query->the_post();

            $slide_id   = get_the_ID();
            $full_image = function_exists('get_field') ? get_field('full_image', $slide_id) : null;

            // full_image (ACF Array) tiene prioridad; si no, usa la imagen destacada
            if (! empty($full_image['url'])) {
                $image_url = $full_image['url'];
            } else {
                $image_url = get_the_post_thumbnail_url($slide_id, 'full') ?: '';
            }

            // Add slide data to the slides array
            $slides[] = array(
                'id'              => $slide_id,
                'title'           => get_the_title($slide_id),
                'subtitle'        => function_exists('get_field') ? get_field('subtitle', $slide_id) : '',
                'title_highlight' => function_exists('get_field') ? get_field('title_highlight', $slide_id) : '',
                'description'     => function_exists('get_field') ? get_field('description', $slide_id) : '',
                'image_url'       => $image_url,
                'cta_1_text'      => function_exists('get_field') ? get_field('cta_1_text', $slide_id) : '',
                'cta_1_url'       => function_exists('get_field') ? get_field('cta_1_url', $slide_id) : '',
                'cta_2_text'      => function_exists('get_field') ? get_field('cta_2_text', $slide_id) : '',
                'cta_2_url'       => function_exists('get_field') ? get_field('cta_2_url', $slide_id) : '',
            );
        }

        wp_reset_postdata();

        return $slides;
    }
}

if (!function_exists('maxus_get_model_categories')) {
    function maxus_get_model_categories()
    {
        if (!taxonomy_exists('categoria_modelo')) {
            return array();
        }

        $terms = get_terms(array(
            'taxonomy'   => 'categoria_modelo',
            'hide_empty' => false,
            'orderby'    => 'name',
            'order'      => 'ASC',
        ));

        if (is_wp_error($terms) || empty($terms)) {
            return array();
        }

        $categories = array();

        foreach ($terms as $term) {
            $cover = function_exists('get_field') ? get_field('cover_image', $term) : null;

            $categories[] = array(
                'id'          => $term->term_id,
                'name'        => $term->name,
                'slug'        => $term->slug,
                'description' => function_exists('get_field') ? get_field('short_description', $term) : '',
                'cover_url'   => !empty($cover['url']) ? $cover['url'] : '',
                'link'        => get_term_link($term),
            );
        }

        return $categories;
    }
}
