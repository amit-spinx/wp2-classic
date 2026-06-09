<?php
/**
 * Disable Comments Everywhere
 *
 * @package DisableComments
 */

/**
 * Disable support for comments and trackbacks in post types
 */
function disable_comments_post_types_support()
{
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}
add_action('admin_init', 'disable_comments_post_types_support');

/**
 * Close comments on the front-end
 */
function disable_comments_status()
{
    return false;
}
add_filter('comments_open', 'disable_comments_status', 20, 2);
add_filter('pings_open', 'disable_comments_status', 20, 2);

/**
 * Hide existing comments
 */
function disable_comments_hide_existing($comments)
{
    return [];
}
add_filter('comments_array', 'disable_comments_hide_existing', 10, 2);

/**
 * Remove comments page in menu
 */
function disable_comments_admin_menu()
{
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'disable_comments_admin_menu');

/**
 * Redirect any user trying to access comments page
 */
function disable_comments_admin_redirect()
{
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_safe_redirect(admin_url());
        exit;
    }
}
add_action('admin_init', 'disable_comments_admin_redirect');

/**
 * Remove comments metabox from dashboard
 */
function disable_comments_dashboard()
{
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'disable_comments_dashboard');

/**
 * Remove comments links from admin bar
 */
function disable_comments_admin_bar()
{
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
}
add_action('init', 'disable_comments_admin_bar');
