<?php

/**
 * SPINX Custom Functions Code.
 *
 * Twenty Seventeen: Customizer
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */

use function PHPSTORM_META\type;

/* Theme Options Menu */
add_action('init', function () {
if (function_exists('acf_add_options_page')) {
	acf_add_options_page(
		array(
			'page_title' => 'Theme General Settings',
			'menu_title' => 'Theme Settings',
			'menu_slug'  => 'theme-general-settings',
			'capability' => 'edit_posts',
			'redirect'   => true,
		)
	);
	acf_add_options_sub_page(
		array(
			'page_title'  => 'Header Settings',
			'menu_title'  => 'Header Settings',
			'parent_slug' => 'theme-general-settings',
		)
	);
	acf_add_options_sub_page(
		array(
			'page_title'  => 'Footer Settings',
			'menu_title'  => 'Footer Settings',
			'parent_slug' => 'theme-general-settings',
		)
	);
    acf_add_options_sub_page(
		array(
			'page_title'  => 'Testimonials Settings',
			'menu_title'  => 'Testimonials Settings',
			'parent_slug' => 'theme-general-settings',
		)
	);
	acf_add_options_sub_page(
		array(
			'page_title'  => 'Logo Slider Settings',
			'menu_title'  => 'Logo Slider Settings',
			'parent_slug' => 'theme-general-settings',
		)
	);
    acf_add_options_sub_page(
		array(
			'page_title'  => 'Footer CTA Settings',
			'menu_title'  => 'Footer CTA Settings',
			'parent_slug' => 'theme-general-settings',
		)
	);
	
}
});
/*custom Number pagination*/
function numeric_posts_nav($query, $paged)
{
	/** Stop execution if there's only 1 page */
	if ($query->max_num_pages <= 1) {
		return;
	}

	// $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max = intval($query->max_num_pages);

	$paginate = '';

	/** Add current page to the array */
	if ($paged >= 1) {
		$links[] = $paged;
	}

	/** Add the pages around the current page to the array */
	if ($paged >= 3) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if (($paged + 2) <= $max) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	$prev = (int) $paged - 1;
	$next = (int) $paged + 1;

	/** Previous Post Link */
	// if ( get_previous_posts_link() )
	if ($paged > 1) {
		$paginate .= sprintf('<a class="prev page-numbers" data-page="%d">%sPrevious</a>' . "\n", $prev, '');
	}

	/** Link to first page, plus ellipses if necessary */
	if (! in_array(1, $links)) {
		$class = 'class="page-numbers"';

		$paginate .= sprintf('<a href="javascript:;" %s data-page="%s">%s</a>' . "\n", $class, '1', '1');

		if (! in_array(2, $links)) {
			$paginate .= '<span class="page-numbers dots">…</span>';
		}
	}

	/** Link to current page, plus 2 pages in either direction if necessary */
	sort($links);
	foreach ((array) $links as $link) {
		$class     = $paged == $link ? 'current' : '';
		$paginate .= sprintf('<a href="javascript:;" class="page-numbers  %s" data-page="%s">%s</a>' . "\n", $class, $link, $link);
	}

	/** Link to last page, plus ellipses if necessary */
	if (! in_array($max, $links)) {
		if (! in_array($max - 1, $links)) {
			$paginate .= '<span class="page-numbers dots">…</span>' . "\n";
		}

		$class     = $paged == $max ? 'current' : '';
		$paginate .= sprintf('<a href="javascript:;" class="page-numbers %s" data-page="%s">%s</a>' . "\n", $class, $max, $max);
	}

	/** Next Post Link */
	// if ( get_next_posts_link() )
	if ($paged != $max) {
		$paginate .= sprintf('<a href="javascript:;" class="next page-numbers" data-page="%d">Next %s</a>' . "\n", $next, '');
	}

	return $paginate;
}


/*Disable Access Thank you page without form submission*/
add_action(
	'init',
	function () {
		if (! session_id()) {
			session_start();
		}
	}
);
add_action(
	'gform_after_submission_1',
	function ($entry, $form) {
		$_SESSION['form_submitted'] = true;
	},
	10,
	2
);

function change_default_post_labels()
{
	global $wp_post_types;

	// Check if the default 'post' post type exists
	if (isset($wp_post_types['post'])) {
		$labels = &$wp_post_types['post']->labels;

		$labels->name = 'News & Events';
		$labels->singular_name = 'News & Event';
		$labels->add_new = 'Add New';
		$labels->add_new_item = 'Add New News or Events';
		$labels->edit_item = 'Edit News or Events';
		$labels->new_item = 'New News or Events';
		$labels->view_item = 'View News or Events';
		$labels->search_items = 'Search News or Events';
		$labels->not_found = 'No News or Events found';
		$labels->not_found_in_trash = 'No News or Events found in Trash';
		$labels->all_items = 'All News & Events';
		$labels->menu_name = 'News & Events';
		$labels->name_admin_bar = 'News & Events';
	}
}
//add_action('init', 'change_default_post_labels');

/**
 * Automatically sets the title, alt text, and caption for uploaded images in WordPress.
 *
 * This function hooks into the `add_attachment` action and updates the metadata
 * for newly uploaded images by extracting the filename and formatting it.
 *
 * - **Title**: Sets the title based on the filename (replaces dashes with spaces and capitalizes words).
 * - **Alt Text**: Sets the alt text if not already set.
 * - **Caption**: Sets the caption if not already set.
 *
 * @param int $post_ID The ID of the uploaded attachment.
 */
function sc_set_image_auto_alt($post_ID)
{

	// Check if the post type is 'attachment'.
	if (get_post_type($post_ID) !== 'attachment') {
		return;
	}

	// Get attachment post object.
	$attachment = get_post($post_ID);

	// Ensure it's an image.
	if (strpos($attachment->post_mime_type, 'image') !== false) {
		// Get the filename (without extension).
		$filename        = pathinfo(get_attached_file($post_ID), PATHINFO_FILENAME);
		$formatted_title = ucwords(str_replace('-', ' ', $filename));

		if (class_exists('WebP_Converter')) {
			$words = explode(' ', trim($formatted_title));
			array_pop($words); // Remove the last word
			$formatted_title = implode(' ', $words);
		}

		// Update Title if not set.
		if (empty($attachment->post_title) || $attachment->post_title === $filename) {
			wp_update_post(
				array(
					'ID'         => $post_ID,
					'post_title' => $formatted_title,
					'post_name'  => sanitize_title($formatted_title),
				)
			);
		}

		// Update Alt Text.
		if (! get_post_meta($post_ID, '_wp_attachment_image_alt', true)) {
			update_post_meta($post_ID, '_wp_attachment_image_alt', $formatted_title);
		}
	}
}
add_action('add_attachment', 'sc_set_image_auto_alt');


// add_filter( 'gform_submit_button', 'custom_gf_submit_button', 10, 2 );
// function custom_gf_submit_button( $button, $form ) {
//     return '<button class="btn btn-primary" id="gform_submit_button_' . esc_attr( $form['id'] ) . '">
//                 <span>Get Free Consultation</span>
//             </button>';
// }



add_action('wp_ajax_news_pagination', 'news_pagination_callback');
add_action('wp_ajax_nopriv_news_pagination', 'news_pagination_callback');
function news_pagination_callback()
{
	$news_paged = (isset($_POST['page'])) ? sanitize_key($_POST['page']) : 1;
    //$exludeid = $_POST['exid'];
	$per_page = 15;

	$args = array (
        'post_type'=>'post',
        'posts_per_page'=> $per_page,
        'post_status' => 'publish',
        'orderby'=> 'date',
        'order' => 'DESC',
        'paged' => $news_paged,        
    );

	$query = new WP_Query($args);
	$pagination = numeric_posts_nav($query, $news_paged);
	$news = '';
	if ($query->have_posts()) :
		ob_start();
		while ($query->have_posts()) : $query->the_post();
			get_template_part('template-parts/custom/news', 'loop');
		endwhile;
		$news = ob_get_clean();
	else:
		$news .= "<p>No results found.</p>";
	endif;
	wp_reset_postdata();

	echo wp_json_encode(
		array(
			'success' => true,
			'news' => $news,
			'pagination' => $pagination
		)
	);

	wp_die();
}

/* Add Image in menu item */ 
add_filter('megamenu_nav_menu_link_attributes', 'mm_add_data_img_to_menu_link', 10, 3);
function mm_add_data_img_to_menu_link( $atts, $item, $args ) {   
	$thumbnail_id = get_post_meta( $item->ID, '_thumbnail_id', true );
	if($thumbnail_id){
		$image_url = wp_get_attachment_url( $thumbnail_id );
		$atts['swap-img'] = $image_url;
	}
    return $atts;
}


function get_project_related_products() {

    global $wpdb;

    $cache_key = 'project_related_products_v1';

    // Try to get cached data
    $products = get_transient($cache_key);

    if (false !== $products) {
        return $products;
    }

    // Single optimized query
    $sql = "
        SELECT DISTINCT pr.ID, pr.post_title
        FROM {$wpdb->posts} pr
        INNER JOIN {$wpdb->postmeta} pm 
            ON pm.meta_key = 'related_products'
        INNER JOIN {$wpdb->posts} p 
            ON p.ID = pm.post_id
            AND p.post_type = 'projects'
            AND p.post_status = 'publish'
        WHERE pr.post_type = 'products'
            AND pr.post_status = 'publish'
            AND pm.meta_value LIKE CONCAT('%\"', pr.ID, '\"%')
        ORDER BY pr.post_title ASC
    ";

    $products = $wpdb->get_results($sql);
	
    // Store for 12 hours (persistent)
    set_transient($cache_key, $products, 12 * HOUR_IN_SECONDS);

    return $products;
}

/**
 * Clear related products cache
 */
function clear_project_related_products_cache() {
    delete_transient('project_related_products_v1');
}

/* When Project or Product saved */
function clear_on_save($post_id) {

    $post_type = get_post_type($post_id);

    if ($post_type === 'projects' || $post_type === 'products') {
        clear_project_related_products_cache();
    }
}
add_action('save_post', 'clear_on_save');

/* When relationship field updated */
function clear_on_meta_update($meta_id, $post_id, $meta_key) {

    if ($meta_key === 'related_products') {
        clear_project_related_products_cache();
    }
}
add_action('updated_post_meta', 'clear_on_meta_update', 10, 3);

/* When post deleted */
add_action('deleted_post', 'clear_project_related_products_cache');



add_action('wp_ajax_projects_list', 'projects_list_callback');
add_action('wp_ajax_nopriv_projects_list', 'projects_list_callback');
function projects_list_callback()
{
	
	$projects_paged = (isset($_POST['page'])) ? sanitize_key($_POST['page']) : 1;
	$args = array(
		'post_type'      => 'projects',
		'post_status'    => 'publish',
		'posts_per_page' => 12,
		'paged'          => $projects_paged,
		'orderby'      => 'date',
		'order'          => 'DESC',
	);

	$filter = $_POST['filter'] ?? [];

	$tax_query  = array();
	$meta_query = array('relation' => 'OR');

	if (!empty($filter)) {

		/* --Industry-- */
		if (!empty($filter['select_industry'])) {
			$industry_id = $filter['select_industry'];
			$tax_query[] = array(
				'taxonomy' => 'project_industry',
				'field'    => 'term_id',
				'terms'    => $industry_id,
				 'operator' => 'IN',
			);

		}

		/* --Products-- */
		if (!empty($filter['select_product'])) {			

			foreach ($filter['select_product'] as $product_id) {
			$meta_query[] = array(
				'key'     => 'related_products',
				'value'   => '"' . intval($product_id) . '"',
				'compare' => 'LIKE',
			);
		}
		}
	

		
	}	

	if (!empty($tax_query)) {
		$args['tax_query'] = $tax_query;
	}

	if (!empty($meta_query)) {
		$args['meta_query'] = $meta_query;
	}

	$query = new WP_Query($args);
	//echo "<pre>";
	//print_r($query); exit;
	$pagination = numeric_posts_nav($query, $projects_paged);
	$projects = '';
	ob_start();
	if ($query->have_posts()) :
		while ($query->have_posts()) : $query->the_post();
			get_template_part('template-parts/custom/project', 'loop');
		endwhile;
		$projects = ob_get_clean();
	else:
		$projects .= "<p>No results found.</p>";
	endif;
	wp_reset_postdata();

	echo wp_json_encode(
		array(
			'success' => true,
			'projects' => $projects,
			'pagination' => $pagination,
			'count' => $query->found_posts,
		)
	);

	wp_die();
}

/* Search Page */ 
add_action('wp_ajax_search_pagination', 'search_pagination_callback');
add_action('wp_ajax_nopriv_search_pagination', 'search_pagination_callback');
function search_pagination_callback()
{
	$search_paged = (isset($_POST['page'])) ? sanitize_key($_POST['page']) : 1;
    $search = $_POST['s'];
	$per_page = 15;

	$args = array (        
        'posts_per_page'=> $per_page,
        'post_status' => 'publish',
        'orderby'=> 'date',
        'order' => 'DESC',
		's' =>  $search,
        'paged' => $search_paged, 
		'relevanssi'  => true       
    );

	$query = new WP_Query($args);
	$pagination = numeric_posts_nav($query, $search_paged);
	$search = '';
	if ($query->have_posts()) :
		ob_start();
		while ($query->have_posts()) : $query->the_post();
			get_template_part('template-parts/custom/search', 'loop');
		endwhile;
		$search = ob_get_clean();
	else:
		$search .= "<p>No results found.</p>";
	endif;
	wp_reset_postdata();

	echo wp_json_encode(
		array(
			'success' => true,
			'search' => $search,
			'pagination' => $pagination
		)
	);

	wp_die();
}

/***** Contact form Phone number validation */
add_filter('gform_validation_1', 'custom_phone_validation');
function custom_phone_validation($validation_result) {

    $form = $validation_result['form'];

    // Phone field ID
    $field_id = 4;

    // Get submitted value
    $phone = rgpost('input_' . $field_id);

    // Remove spaces, brackets, dashes
    $phone = preg_replace('/[\s\-\(\)]/', '', $phone);

    // Check numeric only
    if (!preg_match('/^[0-9]+$/', $phone)) {

        $validation_result['is_valid'] = false;

        foreach ($form['fields'] as &$field) {

            if ($field->id == $field_id) {
                $field->failed_validation = true;
                $field->validation_message = 'Only numeric values are allowed in the phone field.';
                break;
            }

        }

    }

    $validation_result['form'] = $form;
    return $validation_result;
}

add_filter( 'gform_required_legend', 'change_required_indicator', 10, 1 );
add_filter( 'gform_field_content', 'change_required_indicator', 10, 1 );

function change_required_indicator( $content ) {
    return str_replace( '(Required)', '*', $content );
}


/* Remove industry metabox from post page */ 

function remove_project_industry_metabox() {
    remove_meta_box(
        'project_industrydiv',
        'projects',
        'side'
    );

    remove_meta_box(
        'tagsdiv-project_industry',
        'projects',
        'side'
    );
}
add_action('add_meta_boxes', 'remove_project_industry_metabox', 100);



/********Is mobile device ******/

function is_mobile_phone_only() {

    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    if (
        wp_is_mobile() &&
        strpos($user_agent, 'iPad') === false &&
        !(strpos($user_agent, 'Android') !== false && strpos($user_agent, 'Mobile') === false)
    ) {
        return true; // Mobile phone
    }

    return false;
}


function my_acf_wysiwyg_editor_style( $mce_css ) {

    $style = get_stylesheet_directory_uri() . '/acf-editor-style.css';

    if ( ! empty( $mce_css ) ) {
        $mce_css .= ',' . $style;
    } else {
        $mce_css = $style;
    }

    return $mce_css;
}
add_filter( 'mce_css', 'my_acf_wysiwyg_editor_style' );