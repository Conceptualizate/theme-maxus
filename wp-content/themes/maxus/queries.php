<?php

if (!function_exists('maxus_get_site_options')) {
    function maxus_get_site_options()
    {
        static $options = null;

        if ($options !== null) {
            return $options;
        }

        $get = function_exists('get_field') ? 'get_field' : null;

        $options = array(
            'phone'         => $get ? $get('phone', 'option') : '',
            'email'         => $get ? $get('email', 'option') : '',
            'address'       => $get ? $get('address', 'option') : '',
            'facebook'      => $get ? $get('facebook_url', 'option') : '',
            'instagram'     => $get ? $get('instagram_url', 'option') : '',
            'whatsapp'      => $get ? $get('whatsapp_url', 'option') : '',
            'slogan'        => $get ? $get('slogan', 'option') : '',
            'schedule'      => $get ? $get('schedule', 'option') : '',
            'cta_eyebrow'   => $get ? $get('cta_eyebrow', 'option') : '',
            'cta_title'     => $get ? $get('cta_title', 'option') : '',
            'cta_highlight' => $get ? $get('cta_highlight', 'option') : '',
            'cta_description' => $get ? $get('cta_description', 'option') : '',
            'cta_1_text'    => $get ? $get('cta_1_text', 'option') : '',
            'cta_1_url'     => $get ? $get('cta_1_url', 'option') : '',
            'cta_2_text'    => $get ? $get('cta_2_text', 'option') : '',
            'cta_2_url'     => $get ? $get('cta_2_url', 'option') : '',
        );

        return $options;
    }
}

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
