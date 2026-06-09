<?php

/**
 * Register Custom Post Types.
 *
 * Twenty Seventeen: Customizer
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */


/* Register Products Custom Post */
add_action('init', 'register_products_post_type');
function register_products_post_type()
{
    $labels = array(
        'name'                  => 'Products',
        'singular_name'         => 'Product',
        'menu_name'             => 'Products',
        'name_admin_bar'        => 'Product',
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New Product',
        'new_item'              => 'New Product',
        'edit_item'             => 'Edit Product',
        'view_item'             => 'View Product',
        'all_items'             => 'All Products',
        'search_items'          => 'Search Products',
        'parent_item_colon'     => 'Parent Products',
        'not_found'             => 'No Products found.',
        'not_found_in_trash'    => 'No Products found in Trash.',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,  // Prevent this post type from being publicly accessible
        'publicly_queryable'  => true,  // Prevent queries for this post type
        'show_ui'             => true,   // Keep it visible in the admin panel
        'show_in_menu'        => true,   // Make it appear in the WordPress admin menu
        'query_var'           => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-products', // You can change the icon here
        'rewrite'             => array(
            'slug'       => '',
            'with_front' => false
        ),
        'supports'            => array('title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes'),
        'has_archive'         => false,  // Disable archive
        'hierarchical'        => true,
        'show_in_rest'        => false,  // Set to true if you want REST API access
    );
    register_post_type('products', $args);
}


/* Register Projects Custom Post */
add_action('init', 'register_projects_post_type');
function register_projects_post_type()
{
    $labels = array(
        'name'                  => 'Projects',
        'singular_name'         => 'Project',
        'menu_name'             => 'Projects',
        'name_admin_bar'        => 'Project',
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New Project',
        'new_item'              => 'New Project',
        'edit_item'             => 'Edit Project',
        'view_item'             => 'View Project',
        'all_items'             => 'All Projects',
        'search_items'          => 'Search Projects',
        'parent_item_colon'     => 'Parent Projects',
        'not_found'             => 'No Projects found.',
        'not_found_in_trash'    => 'No Projects found in Trash.',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'menu_position'       => 6,
        'menu_icon'           => 'dashicons-portfolio',
        'rewrite'             => array(
            'slug'       => '',
            'with_front' => false
        ),
        'supports'            => array(
            'title',
            'editor',
            'thumbnail',
            'custom-fields',
            'page-attributes'
        ),
        'has_archive'         => false,
        'hierarchical'        => false,
        'show_in_rest'        => false,
    );

    register_post_type('projects', $args);
}


/* Register Industry Taxonomy for Projects */
add_action('init', 'register_industry_taxonomy');
function register_industry_taxonomy()
{
    $labels = array(
        'name'              => 'Industries',
        'singular_name'     => 'Industry',
        'search_items'      => 'Search Industries',
        'all_items'         => 'All Industries',
        'edit_item'         => 'Edit Industry',
        'update_item'       => 'Update Industry',
        'add_new_item'      => 'Add New Industry',
        'new_item_name'     => 'New Industry',
        'menu_name'         => 'Industries',
    );

    $args = array(
        'hierarchical'      => true, // Like Categories
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array(
            'slug'       => 'industry',
            'with_front' => false,
        ),
    );

    register_taxonomy('project_industry', array('projects'), $args);
}


/* Register Capabilities Custom Post Type */
add_action('init', 'register_capabilities_post_type');

function register_capabilities_post_type() {

    $labels = array(
        'name'               => 'Capabilities',
        'singular_name'      => 'Capability',
        'menu_name'          => 'Capabilities',
        'name_admin_bar'     => 'Capability',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Capability',
        'new_item'           => 'New Capability',
        'edit_item'          => 'Edit Capability',
        'view_item'          => 'View Capability',
        'all_items'          => 'All Capabilities',
        'search_items'       => 'Search Capabilities',
        'parent_item_colon'  => 'Parent Capabilities',
        'not_found'          => 'No Capabilities found.',
        'not_found_in_trash' => 'No Capabilities found in Trash.',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'menu_position'       => 6,
        'menu_icon'           => 'dashicons-awards',
        'rewrite'             => array(
            'slug'       => 'capabilities',
            'with_front' => false
        ),
        'supports'            => array(
            'title',
            'editor',
            'thumbnail',
            'custom-fields',
            'page-attributes'
        ),
        'has_archive'         => false,
        'hierarchical'        => true,
        'show_in_rest'        => true,

        // Same permissions as pages
        'capability_type'     => 'page',
        'map_meta_cap'        => true,
    );

    register_post_type('capabilities', $args);
}