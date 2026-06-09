<?php
function lyly_hotel_scripts() {
    // Google Fonts
    wp_enqueue_style('lyly-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:100,300,400,700', array(), null);

    // Bootstrap 5 CSS
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css', array(), '5.3.0');

    // Bootstrap Icons
    wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css', array(), '1.11.0');

    // Swiper CSS
    wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css', array(), '10.0.0');

    // Flatpickr CSS (Lịch)
    wp_enqueue_style('flatpickr-css', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css', array(), '4.6.13');

    // Theme main stylesheet
    wp_enqueue_style('lyly-hotel-style', get_stylesheet_uri(), array('bootstrap-css'), '1.0');

    // jQuery (WordPress already has it, but Malibu uses 3.5.1)
    wp_enqueue_script('jquery');

    // Bootstrap 5 JS
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.3.0', true);

    // Swiper JS
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js', array(), '10.0.0', true);

    // Flatpickr JS (Lịch)
    wp_enqueue_script('flatpickr-js', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.js', array(), '4.6.13', true);
    wp_enqueue_script('flatpickr-vn', 'https://npmcdn.com/flatpickr/dist/l10n/vn.js', array('flatpickr-js'), '4.6.13', true);

    // AOS (Animate On Scroll)
    wp_enqueue_style('aos-css', 'https://unpkg.com/aos@2.3.1/dist/aos.css', array(), '2.3.1');
    wp_enqueue_script('aos-js', 'https://unpkg.com/aos@2.3.1/dist/aos.js', array(), '2.3.1', true);
}
add_action('wp_enqueue_scripts', 'lyly_hotel_scripts');

function lyly_hotel_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'lyly-hotel'),
    ));
}
add_action('after_setup_theme', 'lyly_hotel_theme_setup');

// Automatically create the Stay page if it doesn't exist
function auto_create_stay_page() {
    $page_slug = 'stay';
    $page_check = get_page_by_path($page_slug);
    if (!isset($page_check->ID)) {
        $new_page = array(
            'post_type' => 'page',
            'post_title' => 'Stay',
            'post_content' => '',
            'post_status' => 'publish',
            'post_author' => 1,
            'post_name' => $page_slug
        );
        $page_id = wp_insert_post($new_page);
        if ($page_id && !is_wp_error($page_id)) {
            update_post_meta($page_id, '_wp_page_template', 'page-stay.php');
            flush_rewrite_rules(); // Ensure the new /stay URL is recognized immediately
        }
    }
}
add_action('init', 'auto_create_stay_page');
// Automatically create pages if they don't exist
function auto_create_missing_pages() {
    // Force permalink structure to postname if not set
    if (get_option('permalink_structure') !== '/%postname%/') {
        update_option('permalink_structure', '/%postname%/');
        global $wp_rewrite;
        $wp_rewrite->set_permalink_structure('/%postname%/');
        $wp_rewrite->flush_rules();
    }

    $pages = array('stay', 'dine', 'gather', 'offers', 'gallery', 'about', 'faqs', 'contact', 'malibu-group', 'checkrate');
    $flush_needed = false;
    foreach ($pages as $page_slug) {
        $page_check = get_page_by_path($page_slug);
        if (!isset($page_check->ID) || $page_check->post_status !== 'publish') {
            $new_page = array(
                'post_type' => 'page',
                'post_title' => ucfirst(str_replace('-', ' ', $page_slug)),
                'post_content' => '',
                'post_status' => 'publish',
                'post_author' => 1,
                'post_name' => $page_slug
            );
            
            // If it's in trash, let's restore it
            if (isset($page_check->ID) && $page_check->post_status === 'trash') {
                wp_untrash_post($page_check->ID);
                wp_update_post(array('ID' => $page_check->ID, 'post_status' => 'publish'));
            } else {
                wp_insert_post($new_page);
            }
            $flush_needed = true;
        }
    }
    if ($flush_needed) {
        flush_rewrite_rules(); 
    }
}
add_action('init', 'auto_create_missing_pages');

// Add LyLy Hotel Customizer Settings
function lyly_hotel_customize_register($wp_customize) {
    $wp_customize->add_section('lyly_hotel_settings', array(
        'title'    => __('Cài đặt LyLy Hotel', 'lyly-hotel'),
        'priority' => 30,
    ));

    // Hero Video Setting
    $wp_customize->add_setting('hero_video_id', array(
        'default'   => '',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'hero_video_id', array(
        'label'     => __('Video Nền Trang Chủ', 'lyly-hotel'),
        'section'   => 'lyly_hotel_settings',
        'mime_type' => 'video',
    )));
}
add_action('customize_register', 'lyly_hotel_customize_register');

// Include Custom Admin Gallery Page
require_once get_template_directory() . '/inc/admin-gallery.php';

// Include Custom Post Type cho Ưu đãi
require_once get_template_directory() . '/inc/cpt-offers.php';
?>
