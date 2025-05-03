<?php
add_shortcode('tcp_slider', function($atts) {
    $atts = shortcode_atts(['id' => ''], $atts);
    if (!$atts['id']) return '';

    // Slider Settings
    $slides_desktop = get_post_meta($atts['id'], '_tcp_slides_desktop', true) ?: 1;
    $slides_tablet = get_post_meta($atts['id'], '_tcp_slides_tablet', true) ?: 1;
    $slides_mobile = get_post_meta($atts['id'], '_tcp_slides_mobile', true) ?: 1;
    $slide_gap = get_post_meta($atts['id'], '_tcp_slide_gap', true) ?: 20;
    $arrow_style = get_post_meta($atts['id'], '_tcp_arrow_style', true) ?: 'default';

    // Get Slides
    $slides = get_posts([
        'post_type' => 'tcp_slide',
        'posts_per_page' => -1,
        'meta_query' => [[
            'key' => '_tcp_parent_slider',
            'value' => $atts['id'],
            'compare' => '='
        ]]
    ]);

    if (!$slides) return '';

    $output = '<div class="tcp-slider-wrapper" style="--tcp-gap: ' . intval($slide_gap) . 'px;" data-slides-desktop="' . esc_attr($slides_desktop) . '" data-slides-tablet="' . esc_attr($slides_tablet) . '" data-slides-mobile="' . esc_attr($slides_mobile) . '">';
    $output .= '<div class="tcp-slider-container" style="gap:' . intval($slide_gap) . 'px;">';

    foreach ($slides as $slide) {
        $bg_color = get_post_meta($slide->ID, '_tcp_background_color', true) ?: '#ffffff';
        $heading_color = get_post_meta($slide->ID, '_tcp_heading_color', true) ?: '#111111';
        $text_color = get_post_meta($slide->ID, '_tcp_text_color', true) ?: '#333333';
        $btn_text_color = get_post_meta($slide->ID, '_tcp_btn_text_color', true) ?: '#ffffff';
        $btn_bg_color = get_post_meta($slide->ID, '_tcp_btn_bg_color', true) ?: '#0073aa';
        $button_text = get_post_meta($slide->ID, '_tcp_button_text', true);
        $button_link = get_post_meta($slide->ID, '_tcp_button_link', true);

        $output .= '<div class="tcp-slide" style="background-color:' . esc_attr($bg_color) . ';">';
        $output .= get_the_post_thumbnail($slide->ID, 'medium');
        $output .= '<h5 style="color:' . esc_attr($heading_color) . ';">' . esc_html($slide->post_title) . '</h5>';
        $output .= '<p style="color:' . esc_attr($text_color) . ';">' . esc_html($slide->post_content) . '</p>';
        if (!empty($button_text) && !empty($button_link)) {
            $output .= '<a href="' . esc_url($button_link) . '" class="tcp-button" style="background:' . esc_attr($btn_bg_color) . '; color:' . esc_attr($btn_text_color) . ';">' . esc_html($button_text) . '</a>';
        }
        $output .= '</div>';

    }

    $output .= '</div>'; // Close tcp-slider-container

    $arrow_class = 'tcp-arrows-' . esc_attr($arrow_style);
    $output .= '<button class="tcp-prev ' . $arrow_class . '">&#8249;</button><button class="tcp-next ' . $arrow_class . '">&#8250;</button>';
    $output .= '</div>'; // Close tcp-slider-wrapper

    return $output;
});
?>
