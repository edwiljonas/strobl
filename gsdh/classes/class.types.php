<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/01/24
 * Time: 11:45 AM
 */

namespace GSDH;

class gsdh_types
{
    var $prefix = 'gsdh_',
        $text_domain = 'gsdh';

    function __construct()
    {

        add_action('init', [$this, 'awards'], 0);
        add_action('init', [$this, 'testimonials'], 0);
        add_action('init', [$this, 'listings'], 0);
        add_action('init', [$this, 'slides'], 0);
        add_action('init', [$this, 'bookings'], 0);
        add_action('init', [$this, 'request'], 0);

    }

    # REQUEST
    function request()
    {

        $labels = array(
            'name' => _x('Requests', 'Post Type General Name', $this->text_domain),
            'singular_name' => _x('Request', 'Post Type Singular Name', $this->text_domain),
            'menu_name' => __('Requests', $this->text_domain),
            'name_admin_bar' => __('Request', $this->text_domain),
            'archives' => __('Request Archives', $this->text_domain),
            'attributes' => __('Request Attributes', $this->text_domain),
            'parent_item_colon' => __('Parent Item:', $this->text_domain),
            'all_items' => __('All Requests', $this->text_domain),
            'add_new_item' => __('Add New Request', $this->text_domain),
            'add_new' => __('Add New', $this->text_domain),
            'new_item' => __('New Request', $this->text_domain),
            'edit_item' => __('Edit Request', $this->text_domain),
            'update_item' => __('Update Request', $this->text_domain),
            'view_item' => __('View Request', $this->text_domain),
            'view_items' => __('View Request', $this->text_domain),
            'search_items' => __('Search Request', $this->text_domain),
            'not_found' => __('Not found', $this->text_domain),
            'not_found_in_trash' => __('Not found in Trash', $this->text_domain),
            'featured_image' => __('Featured Image', $this->text_domain),
            'set_featured_image' => __('Set featured image', $this->text_domain),
            'remove_featured_image' => __('Remove featured image', $this->text_domain),
            'use_featured_image' => __('Use as featured image', $this->text_domain),
            'insert_into_item' => __('Insert ' . 'into item', $this->text_domain),
            'uploaded_to_this_item' => __('Uploaded to this item', $this->text_domain),
            'items_list' => __('Items list', $this->text_domain),
            'items_list_navigation' => __('Items list navigation', $this->text_domain),
            'filter_items_list' => __('Filter items list', $this->text_domain),
        );
        $args = array(
            'label' => __('Request', $this->text_domain),
            'description' => __('Header Requests', $this->text_domain),
            'labels' => $labels,
            'supports' => array('title'),
            'hierarchical' => false,
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 100,
            'menu_icon' => 'dashicons-forms',
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => false,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'capability_type' => 'page',
        );
        register_post_type('request', $args);

    }

    # BOOKINGS
    function bookings()
    {

        $labels = array(
            'name' => _x('Bookings', 'Post Type General Name', $this->text_domain),
            'singular_name' => _x('Booking', 'Post Type Singular Name', $this->text_domain),
            'menu_name' => __('Bookings', $this->text_domain),
            'name_admin_bar' => __('Booking', $this->text_domain),
            'archives' => __('Booking Archives', $this->text_domain),
            'attributes' => __('Booking Attributes', $this->text_domain),
            'parent_item_colon' => __('Parent Item:', $this->text_domain),
            'all_items' => __('All Bookings', $this->text_domain),
            'add_new_item' => __('Add New Booking', $this->text_domain),
            'add_new' => __('Add New', $this->text_domain),
            'new_item' => __('New Booking', $this->text_domain),
            'edit_item' => __('Edit Booking', $this->text_domain),
            'update_item' => __('Update Booking', $this->text_domain),
            'view_item' => __('View Booking', $this->text_domain),
            'view_items' => __('View Booking', $this->text_domain),
            'search_items' => __('Search Booking', $this->text_domain),
            'not_found' => __('Not found', $this->text_domain),
            'not_found_in_trash' => __('Not found in Trash', $this->text_domain),
            'featured_image' => __('Featured Image', $this->text_domain),
            'set_featured_image' => __('Set featured image', $this->text_domain),
            'remove_featured_image' => __('Remove featured image', $this->text_domain),
            'use_featured_image' => __('Use as featured image', $this->text_domain),
            'insert_into_item' => __('Insert ' . 'into item', $this->text_domain),
            'uploaded_to_this_item' => __('Uploaded to this item', $this->text_domain),
            'items_list' => __('Items list', $this->text_domain),
            'items_list_navigation' => __('Items list navigation', $this->text_domain),
            'filter_items_list' => __('Filter items list', $this->text_domain),
        );
        $args = array(
            'label' => __('Booking', $this->text_domain),
            'description' => __('Header Bookings', $this->text_domain),
            'labels' => $labels,
            'supports' => array('title'),
            'hierarchical' => false,
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 100,
            'menu_icon' => 'dashicons-forms',
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => false,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'capability_type' => 'page',
        );
        register_post_type('bookings', $args);

    }

    # SLIDES
    function slides()
    {

        $labels = array(
            'name' => _x('Slides', 'Post Type General Name', $this->text_domain),
            'singular_name' => _x('Slide', 'Post Type Singular Name', $this->text_domain),
            'menu_name' => __('Slides', $this->text_domain),
            'name_admin_bar' => __('Slide', $this->text_domain),
            'archives' => __('Slide Archives', $this->text_domain),
            'attributes' => __('Slide Attributes', $this->text_domain),
            'parent_item_colon' => __('Parent Item:', $this->text_domain),
            'all_items' => __('All Slides', $this->text_domain),
            'add_new_item' => __('Add New Slide', $this->text_domain),
            'add_new' => __('Add New', $this->text_domain),
            'new_item' => __('New Slide', $this->text_domain),
            'edit_item' => __('Edit Slide', $this->text_domain),
            'update_item' => __('Update Slide', $this->text_domain),
            'view_item' => __('View Slide', $this->text_domain),
            'view_items' => __('View Slide', $this->text_domain),
            'search_items' => __('Search Slide', $this->text_domain),
            'not_found' => __('Not found', $this->text_domain),
            'not_found_in_trash' => __('Not found in Trash', $this->text_domain),
            'featured_image' => __('Featured Image', $this->text_domain),
            'set_featured_image' => __('Set featured image', $this->text_domain),
            'remove_featured_image' => __('Remove featured image', $this->text_domain),
            'use_featured_image' => __('Use as featured image', $this->text_domain),
            'insert_into_item' => __('Insert ' . 'into item', $this->text_domain),
            'uploaded_to_this_item' => __('Uploaded to this item', $this->text_domain),
            'items_list' => __('Items list', $this->text_domain),
            'items_list_navigation' => __('Items list navigation', $this->text_domain),
            'filter_items_list' => __('Filter items list', $this->text_domain),
        );
        $args = array(
            'label' => __('Slide', $this->text_domain),
            'description' => __('Header Slides', $this->text_domain),
            'labels' => $labels,
            'supports' => array('title', /*'editor', 'thumbnail',*/ 'page-attributes'),
            'hierarchical' => false,
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 100,
            'menu_icon' => 'dashicons-slides',
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => false,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'capability_type' => 'page',
        );
        register_post_type('slides', $args);

    }

    # AWARDS
    function awards()
    {

        $labels = array(
            'name' => _x('Awards', 'Post Type General Name', $this->text_domain),
            'singular_name' => _x('Award', 'Post Type Singular Name', $this->text_domain),
            'menu_name' => __('Awards', $this->text_domain),
            'name_admin_bar' => __('Award', $this->text_domain),
            'archives' => __('Award Archives', $this->text_domain),
            'attributes' => __('Award Attributes', $this->text_domain),
            'parent_item_colon' => __('Parent Item:', $this->text_domain),
            'all_items' => __('All Awards', $this->text_domain),
            'add_new_item' => __('Add New Award', $this->text_domain),
            'add_new' => __('Add New', $this->text_domain),
            'new_item' => __('New Award', $this->text_domain),
            'edit_item' => __('Edit Award', $this->text_domain),
            'update_item' => __('Update Award', $this->text_domain),
            'view_item' => __('View Award', $this->text_domain),
            'view_items' => __('View Award', $this->text_domain),
            'search_items' => __('Search Award', $this->text_domain),
            'not_found' => __('Not found', $this->text_domain),
            'not_found_in_trash' => __('Not found in Trash', $this->text_domain),
            'featured_image' => __('Featured Image', $this->text_domain),
            'set_featured_image' => __('Set featured image', $this->text_domain),
            'remove_featured_image' => __('Remove featured image', $this->text_domain),
            'use_featured_image' => __('Use as featured image', $this->text_domain),
            'insert_into_item' => __('Insert ' . 'into item', $this->text_domain),
            'uploaded_to_this_item' => __('Uploaded to this item', $this->text_domain),
            'items_list' => __('Items list', $this->text_domain),
            'items_list_navigation' => __('Items list navigation', $this->text_domain),
            'filter_items_list' => __('Filter items list', $this->text_domain),
        );
        $args = array(
            'label' => __('Award', $this->text_domain),
            'description' => __('Header Awards', $this->text_domain),
            'labels' => $labels,
            'supports' => array('title', /*'editor', 'thumbnail',*/ 'page-attributes'),
            'hierarchical' => false,
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 100,
            'menu_icon' => 'dashicons-star-filled',
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => false,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'capability_type' => 'page',
        );
        register_post_type('awards', $args);

    }

    # TESTIMONIALS
    function testimonials()
    {

        $labels = array(
            'name' => _x('Testimonials', 'Post Type General Name', $this->text_domain),
            'singular_name' => _x('Testimonial', 'Post Type Singular Name', $this->text_domain),
            'menu_name' => __('Testimonials', $this->text_domain),
            'name_admin_bar' => __('Testimonial', $this->text_domain),
            'archives' => __('Testimonial Archives', $this->text_domain),
            'attributes' => __('Testimonial Attributes', $this->text_domain),
            'parent_item_colon' => __('Parent Item:', $this->text_domain),
            'all_items' => __('All Testimonials', $this->text_domain),
            'add_new_item' => __('Add New Testimonial', $this->text_domain),
            'add_new' => __('Add New', $this->text_domain),
            'new_item' => __('New Testimonial', $this->text_domain),
            'edit_item' => __('Edit Testimonial', $this->text_domain),
            'update_item' => __('Update Testimonial', $this->text_domain),
            'view_item' => __('View Testimonial', $this->text_domain),
            'view_items' => __('View Testimonial', $this->text_domain),
            'search_items' => __('Search Testimonial', $this->text_domain),
            'not_found' => __('Not found', $this->text_domain),
            'not_found_in_trash' => __('Not found in Trash', $this->text_domain),
            'featured_image' => __('Featured Image', $this->text_domain),
            'set_featured_image' => __('Set featured image', $this->text_domain),
            'remove_featured_image' => __('Remove featured image', $this->text_domain),
            'use_featured_image' => __('Use as featured image', $this->text_domain),
            'insert_into_item' => __('Insert ' . 'into item', $this->text_domain),
            'uploaded_to_this_item' => __('Uploaded to this item', $this->text_domain),
            'items_list' => __('Items list', $this->text_domain),
            'items_list_navigation' => __('Items list navigation', $this->text_domain),
            'filter_items_list' => __('Filter items list', $this->text_domain),
        );
        $args = array(
            'label' => __('Testimonial', $this->text_domain),
            'description' => __('Header Testimonials', $this->text_domain),
            'labels' => $labels,
            'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
            'hierarchical' => false,
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 100,
            'menu_icon' => 'dashicons-info',
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => false,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'capability_type' => 'page',
        );
        register_post_type('testimonials', $args);

    }

    # TESTIMONIALS
    function listings()
    {

        $labels = array(
            'name' => _x('Listings', 'Post Type General Name', $this->text_domain),
            'singular_name' => _x('Listing', 'Post Type Singular Name', $this->text_domain),
            'menu_name' => __('Listings', $this->text_domain),
            'name_admin_bar' => __('Listing', $this->text_domain),
            'archives' => __('Listing Archives', $this->text_domain),
            'attributes' => __('Listing Attributes', $this->text_domain),
            'parent_item_colon' => __('Parent Item:', $this->text_domain),
            'all_items' => __('All Listings', $this->text_domain),
            'add_new_item' => __('Add New Listing', $this->text_domain),
            'add_new' => __('Add New', $this->text_domain),
            'new_item' => __('New Listing', $this->text_domain),
            'edit_item' => __('Edit Listing', $this->text_domain),
            'update_item' => __('Update Listing', $this->text_domain),
            'view_item' => __('View Listing', $this->text_domain),
            'view_items' => __('View Listing', $this->text_domain),
            'search_items' => __('Search Listing', $this->text_domain),
            'not_found' => __('Not found', $this->text_domain),
            'not_found_in_trash' => __('Not found in Trash', $this->text_domain),
            'featured_image' => __('Featured Image', $this->text_domain),
            'set_featured_image' => __('Set featured image', $this->text_domain),
            'remove_featured_image' => __('Remove featured image', $this->text_domain),
            'use_featured_image' => __('Use as featured image', $this->text_domain),
            'insert_into_item' => __('Insert ' . 'into item', $this->text_domain),
            'uploaded_to_this_item' => __('Uploaded to this item', $this->text_domain),
            'items_list' => __('Items list', $this->text_domain),
            'items_list_navigation' => __('Items list navigation', $this->text_domain),
            'filter_items_list' => __('Filter items list', $this->text_domain),
        );
        $args = array(
            'label' => __('Listing', $this->text_domain),
            'description' => __('Header Listings', $this->text_domain),
            'labels' => $labels,
            'supports' => array('title', /*'editor', 'thumbnail',*/ 'page-attributes'),
            'hierarchical' => false,
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 100,
            'menu_icon' => 'dashicons-archive',
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => false,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'capability_type' => 'page',
        );
        register_post_type('listings', $args);

    }

    # SIGNUP
    function signups()
    {

        $labels = [
            'name' => _x('Enquiries', 'Post Type General Name', $this->text_domain),
            'singular_name' => _x('Enquiry', 'Post Type Singular Name', $this->text_domain),
            'menu_name' => __('Enquiries', $this->text_domain),
            'name_admin_bar' => __('Enquiry', $this->text_domain),
            'archives' => __('Item Archives', $this->text_domain),
            'attributes' => __('Item Attributes', $this->text_domain),
            'parent_item_colon' => __('Parent Item:', $this->text_domain),
            'all_items' => __('All Enquiries', $this->text_domain),
            'add_new_item' => __('Add New Enquiry', $this->text_domain),
            'add_new' => __('Add New', $this->text_domain),
            'new_item' => __('New Enquiry', $this->text_domain),
            'edit_item' => __('Edit Enquiry', $this->text_domain),
            'update_item' => __('Update Enquiry', $this->text_domain),
            'view_item' => __('View Enquiry', $this->text_domain),
            'view_items' => __('View Items', $this->text_domain),
            'search_items' => __('Search Item', $this->text_domain),
            'not_found' => __('Not found', $this->text_domain),
            'not_found_in_trash' => __('Not found in Trash', $this->text_domain),
            'featured_image' => __('Featured Image', $this->text_domain),
            'set_featured_image' => __('Set featured image', $this->text_domain),
            'remove_featured_image' => __('Remove featured image', $this->text_domain),
            'use_featured_image' => __('Use as featured image', $this->text_domain),
            'insert_into_item' => __('Insert' . ' into item', $this->text_domain),
            'uploaded_to_this_item' => __('Uploaded to this item', $this->text_domain),
            'items_list' => __('Items list', $this->text_domain),
            'items_list_navigation' => __('Items list navigation', $this->text_domain),
            'filter_items_list' => __('Filter items list', $this->text_domain),
        ];
        $args = [
            'label' => __('Enquiry', $this->text_domain),
            'description' => __('General Enquiries', $this->text_domain),
            'labels' => $labels,
            'supports' => ['title', /*'editor', 'excerpt', 'thumbnail',*/],
            'taxonomies' => [ /*'category', 'post_tag'*/],
            'hierarchical' => false,
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 20,
            'menu_icon' => 'dashicons-email-alt',
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => false,
            'exclude_from_search' => false,
            'publicly_queryable' => false,
            'capabilities' => [ 'create_posts' => 'do_not_allow', ],
            'map_meta_cap' => true, /* Default is true. Set to `false` if users are not allowed to edit/delete existing posts*/
            'capability_type' => 'page',
//            'rewrite' => ['slug' => 'speakers']
        ];
        register_post_type('enquiry', $args);

    }

}
