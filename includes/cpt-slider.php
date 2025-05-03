<?php
add_action('init', function() {
    register_post_type('tcp_slider', [
        'labels' => [
            'name' => 'Text Carousels',
            'singular_name' => 'Text Carousel'
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title']
    ]);
});
// Add Meta Box for Slider Settings
add_action('add_meta_boxes', function() {
    add_meta_box('tcp_slider_settings', 'Slider Settings', function($post) {
        $desktop = get_post_meta($post->ID, '_tcp_slides_desktop', true) ?: 1;
        $tablet = get_post_meta($post->ID, '_tcp_slides_tablet', true) ?: 1;
        $mobile = get_post_meta($post->ID, '_tcp_slides_mobile', true) ?: 1;
        $gap = get_post_meta($post->ID, '_tcp_slide_gap', true) ?: 20;
        $arrow = get_post_meta($post->ID, '_tcp_arrow_style', true) ?: 'default';

        ?>
        <label>Slides to show (Desktop): </label><input type="number" name="tcp_slides_desktop" value="<?= esc_attr($desktop) ?>" /><br><br>
        <label>Slides to show (Tablet): </label><input type="number" name="tcp_slides_tablet" value="<?= esc_attr($tablet) ?>" /><br><br>
        <label>Slides to show (Mobile): </label><input type="number" name="tcp_slides_mobile" value="<?= esc_attr($mobile) ?>" /><br><br>
        <label>Gap between slides (px): </label><input type="number" name="tcp_slide_gap" value="<?= esc_attr($gap) ?>" /><br><br>
        <label>Arrow Style: </label>
        <select name="tcp_arrow_style">
            <option value="default" <?= selected($arrow, 'default') ?>>Default</option>
            <option value="circle" <?= selected($arrow, 'circle') ?>>Circle</option>
            <option value="minimal" <?= selected($arrow, 'minimal') ?>>Minimal</option>
        </select>
        <?php
    }, 'tcp_slider');
});

// Save Slider Settings
add_action('save_post', function($post_id) {
    if (isset($_POST['tcp_slides_desktop'])) {
        update_post_meta($post_id, '_tcp_slides_desktop', intval($_POST['tcp_slides_desktop']));
    }
    if (isset($_POST['tcp_slides_tablet'])) {
        update_post_meta($post_id, '_tcp_slides_tablet', intval($_POST['tcp_slides_tablet']));
    }
    if (isset($_POST['tcp_slides_mobile'])) {
        update_post_meta($post_id, '_tcp_slides_mobile', intval($_POST['tcp_slides_mobile']));
    }
    if (isset($_POST['tcp_slide_gap'])) {
        update_post_meta($post_id, '_tcp_slide_gap', intval($_POST['tcp_slide_gap']));
    }
    if (isset($_POST['tcp_arrow_style'])) {
        update_post_meta($post_id, '_tcp_arrow_style', sanitize_text_field($_POST['tcp_arrow_style']));
    }
});

// Add Shortcode column to admin table
add_filter('manage_tcp_slider_posts_columns', function($columns) {
    $columns['shortcode'] = 'Shortcode';
    return $columns;
});

add_action('manage_tcp_slider_posts_custom_column', function($column, $post_id) {
    if ($column === 'shortcode') {
        echo '<code>[tcp_slider id="' . $post_id . '"]</code>';
    }
}, 10, 2);

// Show shortcode column in admin
add_filter('manage_tcp_slider_posts_columns', function($columns) {
    $columns['shortcode'] = 'Shortcode';
    return $columns;
});

add_action('manage_tcp_slider_posts_custom_column', function($column, $post_id) {
    if ($column === 'shortcode') {
        echo '<code>[tcp_slider id="' . $post_id . '"]</code>';
    }
}, 10, 2);
