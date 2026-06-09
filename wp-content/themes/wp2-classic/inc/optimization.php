<?php

add_action('wp_enqueue_scripts', 'spinx_optimization_dequeue_scripts',100);
function spinx_optimization_dequeue_scripts(){
    /*remove from frontend while not login*/
    if ( ! is_user_logged_in() ) {
        wp_deregister_style( 'dashicons' );
    }
    if (!is_admin()) {
        /*disable on all page, enable only on single guid & blog*/
        /*if(!is_single() && !is_singular('guides')){
            // Check if the script is enqueued and dequeue it
            wp_dequeue_script('comment-form-validation-and-customization');
            wp_deregister_script('comment-form-validation-and-customization');
            // Check if the CSS is enqueued and dequeue it
            wp_dequeue_style('comment-form-validation-and-customization');
            wp_deregister_style('comment-form-validation-and-customization');
        }*/
        wp_dequeue_style('wp-block-library');

        /*polyfill - enables the usage of new programming language or web platform features in outdated browsers or environments that do not support them*/
        /*wp_deregister_script('wp-polyfill');
        wp_deregister_script('wp-polyfill-inert');*/
        
        /*package is a runtime module for Regenerator-compiled generator and async functions. It provides a polyfill for environments that do not natively support these features, allowing developers to use generators and async/await syntax in their JavaScript code.*/
        /*wp_deregister_script('wp-polyfill');
        wp_deregister_script('regenerator-runtime');*/
        
        /*hoverIntent - use for menu open on hover do not remove this*/
       // wp_deregister_script('hoverIntent');
       // wp_deregister_script('hoverintent-js');
    }
}
/* Disable the emoji's */
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );    
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );  
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    // Remove from TinyMCE
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );
/* Filter out the tinymce emoji plugin. */
function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}
