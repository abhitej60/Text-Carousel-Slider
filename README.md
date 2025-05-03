**Description**
This is a custom WordPress plugin that provides a simple, lightweight, and responsive text/image slider designed to work with Elementor. It allows users to create multiple sliders, assign slides to each slider, and customize various design aspects including text and background colors. Built without any external slider libraries like Owl Carousel or Slick, this plugin uses pure HTML, CSS, and JavaScript, ensuring a clean and fast implementation.

**Features**
Elementor widget support for easy drag-and-drop usage.

Ability to create and manage multiple independent sliders.

**Each slide supports:**
Featured image

Custom heading

Description text

Optional button with custom label and link

Individual slide customization:

Background color

Heading color

Text color

Button text color

Button background color

Responsive configuration:

Set number of slides to display for mobile, tablet, and desktop views.

Control spacing (gap) between slides by specifying pixel value.

**Three pre-built arrow styles:**

    Default
    
    Circle
    
    Minimal

Infinite loop navigation.

**Shortcode support for non-Elementor usage:**
Example: [tcp_slider id="123"]

Limitations (in this version)
Does not support touch swipe or drag functionality.

No autoplay or auto-slide feature.

No transition animation settings (e.g., fade, slide duration).

No advanced layout effects or RTL support.

Limited button design controls.

**Usage**
Install the plugin as a ZIP or clone it into the WordPress plugins directory.

Navigate to Text Carousels > Add New in the WordPress admin to create a new slider.

Add new Slides via the Slides menu and assign them to a specific slider using the dropdown selector.

Customize each slide’s content and styling as needed.

Use the generated shortcode [tcp_slider id="123"] (replace 123 with your slider ID) anywhere in posts, pages, or widgets.

Alternatively, use the Elementor widget named "Text Carousel Slider" for drag-and-drop insertion.

**Requirements**
WordPress version 5.8 or higher

PHP version 7.4 or higher

Elementor (optional, for widget-based usage)

**Developer Notes**
This version is designed for basic functionality and customization. It is ideal for lightweight use-cases where minimal dependencies and high performance are preferred. Future improvements may include swipe support, autoplay, custom animations, and advanced design settings.
