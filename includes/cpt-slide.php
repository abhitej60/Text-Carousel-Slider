<?php
add_action('init', function() {
    register_post_type('tcp_slide', [
        'labels' => [
            'name' => 'Slides',
            'singular_name' => 'Slide'
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor', 'thumbnail']
    ]);
});

// Register taxonomy to group slides under sliders
add_action('init', function() {
    register_taxonomy('slider_group', ['tcp_slide'], [
        'label' => 'Slider Group',
        'hierarchical' => false,
        'show_admin_column' => true,
        'rewrite' => ['slug' => 'slider-group'],
    ]);
});


// Add Meta Box for Slide Extra Settings
add_action('add_meta_boxes', function() {
    add_meta_box('tcp_slide_settings', 'Slide Extra Settings', function($post) {
        $button_text = get_post_meta($post->ID, '_tcp_button_text', true);
        $button_link = get_post_meta($post->ID, '_tcp_button_link', true);
        $background_color = get_post_meta($post->ID, '_tcp_background_color', true) ?: '#ffffff';

        ?>
        <label>Button Text:</label><br>
        <input type="text" name="tcp_button_text" value="<?= esc_attr($button_text) ?>" style="width:100%;" /><br><br>

        <label>Button Link URL:</label><br>
        <input type="text" name="tcp_button_link" value="<?= esc_attr($button_link) ?>" style="width:100%;" /><br><br>

        <label>Slide Background Color:</label><br>
        <input type="color" name="tcp_background_color" value="<?= esc_attr($background_color) ?>" /><br><br>
        <?php
    }, 'tcp_slide');

        // Add dropdown to assign this slide to a slider
    add_meta_box('tcp_slide_slider_selector', 'Assign to Slider', function ($post) {
        $selected_slider = get_post_meta($post->ID, '_tcp_parent_slider', true);
        $sliders = get_posts([
            'post_type' => 'tcp_slider',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC'
        ]);
        echo '<label>Select Slider:</label><br>';
        echo '<select name="tcp_parent_slider" style="width: 100%;">';
        echo '<option value="">— None —</option>';
        foreach ($sliders as $slider) {
            $selected = ($slider->ID == $selected_slider) ? 'selected' : '';
            echo '<option value="' . $slider->ID . '" ' . $selected . '>' . esc_html($slider->post_title) . '</option>';
        }
        echo '</select>';
    }, 'tcp_slide');

});

// Save Slide Settings
add_action('save_post', function($post_id) {
    if (isset($_POST['tcp_button_text'])) {
        update_post_meta($post_id, '_tcp_button_text', sanitize_text_field($_POST['tcp_button_text']));
    }
    if (isset($_POST['tcp_button_link'])) {
        update_post_meta($post_id, '_tcp_button_link', esc_url_raw($_POST['tcp_button_link']));
    }
    if (isset($_POST['tcp_background_color'])) {
        update_post_meta($post_id, '_tcp_background_color', sanitize_hex_color($_POST['tcp_background_color']));
    }
    if (isset($_POST['tcp_parent_slider'])) {
        update_post_meta($post_id, '_tcp_parent_slider', intval($_POST['tcp_parent_slider']));
    }
});

// Add dropdown to assign slide to a specific slider
// Enhanced Slide Meta Box: Color Controls
add_action('add_meta_boxes', function() {
    add_meta_box('tcp_slide_settings', 'Slide Style Settings', function($post) {
        $button_text = get_post_meta($post->ID, '_tcp_button_text', true);
        $button_link = get_post_meta($post->ID, '_tcp_button_link', true);
        $background_color = get_post_meta($post->ID, '_tcp_background_color', true) ?: '#ffffff';

        $heading_color = get_post_meta($post->ID, '_tcp_heading_color', true) ?: '#111111';
        $text_color = get_post_meta($post->ID, '_tcp_text_color', true) ?: '#333333';
        $btn_text_color = get_post_meta($post->ID, '_tcp_btn_text_color', true) ?: '#ffffff';
        $btn_bg_color = get_post_meta($post->ID, '_tcp_btn_bg_color', true) ?: '#0073aa';
        ?>
        <label>Button Text:</label><br>
        <input type="text" name="tcp_button_text" value="<?= esc_attr($button_text) ?>" style="width:100%;" /><br><br>

        <label>Button Link URL:</label><br>
        <input type="text" name="tcp_button_link" value="<?= esc_attr($button_link) ?>" style="width:100%;" /><br><br>

        <label>Slide Background Color:</label><br>
        <input type="color" name="tcp_background_color" value="<?= esc_attr($background_color) ?>" /><br><br>

        <label>Heading Color:</label><br>
        <input type="color" name="tcp_heading_color" value="<?= esc_attr($heading_color) ?>" /><br><br>

        <label>Text Color:</label><br>
        <input type="color" name="tcp_text_color" value="<?= esc_attr($text_color) ?>" /><br><br>

        <label>Button Text Color:</label><br>
        <input type="color" name="tcp_btn_text_color" value="<?= esc_attr($btn_text_color) ?>" /><br><br>

        <label>Button Background Color:</label><br>
        <input type="color" name="tcp_btn_bg_color" value="<?= esc_attr($btn_bg_color) ?>" /><br><br>
        <?php
    }, 'tcp_slide');
});




// Save the selected slider ID
add_action('save_post', function ($post_id) {
    if (isset($_POST['tcp_parent_slider'])) {
        update_post_meta($post_id, '_tcp_parent_slider', intval($_POST['tcp_parent_slider']));
    }
    if (isset($_POST['tcp_heading_color'])) {
        update_post_meta($post_id, '_tcp_heading_color', sanitize_hex_color($_POST['tcp_heading_color']));
    }
    if (isset($_POST['tcp_text_color'])) {
        update_post_meta($post_id, '_tcp_text_color', sanitize_hex_color($_POST['tcp_text_color']));
    }
    if (isset($_POST['tcp_btn_text_color'])) {
        update_post_meta($post_id, '_tcp_btn_text_color', sanitize_hex_color($_POST['tcp_btn_text_color']));
    }
    if (isset($_POST['tcp_btn_bg_color'])) {
        update_post_meta($post_id, '_tcp_btn_bg_color', sanitize_hex_color($_POST['tcp_btn_bg_color']));
    }    
});

