<?php

/**
 * Enqueue scripts and styles.
 */
function spinxdigital_scripts() {
	// WP Default
	wp_enqueue_style( 'theme-style', get_stylesheet_directory_uri() . '/style.css', array(), filemtime( get_stylesheet_directory() . '/style.css' ), 'all' );
	wp_enqueue_script( 'jquery' );

	// Theme stylesheet.
	wp_enqueue_script( 'theme-global', get_template_directory_uri() . '/assets/js/app.js', array( 'jquery' ), null, true );

	if ( has_nav_menu( 'top-menu' ) ) {
		wp_enqueue_script( 'twentyseventeen-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array( 'jquery' ), '1.0', true );
		$twentyseventeen_l10n['expand']   = __( 'Expand child menu', 'twentyseventeen' );
		$twentyseventeen_l10n['collapse'] = __( 'Collapse child menu', 'twentyseventeen' );
		$twentyseventeen_l10n['icon']     = '';
	}
	wp_localize_script( 'twentyseventeen-skip-link-focus-fix', 'twentyseventeenScreenReaderText', array( @$twentyseventeen_l10n ) );

	// page.php: including pages(cms-pages, 404, style)
	if ( ( get_page_template_slug() === '' || is_page_template('templates/style.php') || is_404() ) && !is_search() && !is_single()) { 		
		wp_enqueue_style('cms-css', get_template_directory_uri() . '/assets/css/cms-page.css', array(), ''); 
	}

	// Home page:
	if ( is_page_template( 'templates/home.php' ) ) {
		wp_enqueue_style( 'home-css', get_template_directory_uri() . '/assets/css/home.css', array(), '' );
		wp_enqueue_script( 'home-js', get_template_directory_uri() . '/build/home.min.js', array( 'jquery' ), null, true );
	}


	// News Detail page: is_singular('post')
	// if (is_singular('post')) {		
	// 	wp_enqueue_style( 'news-detail-css', get_template_directory_uri() . '/assets/css/news-detail.css', array(), '' );
	// }

	// Search Page
	// if ( is_search() ) {
	// 	wp_enqueue_style( 'search-css', get_template_directory_uri() . '/assets/css/search.css', array(), '' );
	// 	wp_enqueue_script( 'search-js', get_template_directory_uri() . '/build/search.min.js', array( 'jquery' ), null, true );
	// }
}
add_action( 'wp_enqueue_scripts', 'spinxdigital_scripts' );

/*** Defer Script: ***/
function add_defer_attribute_to_script( $tag, $handle ) {
	// Check if it's the specific script handle.
	if ( 'theme-global' === $handle || 'home-js' === $handle || 'about-js' === $handle || 'contact-js' === $handle || 'careers-js' === $handle || 'product-list-js' === $handle || 'product-detail-js' === $handle || 'project-list-js' === $handle || 'project-detail-js' === $handle || 'news-list-js' === $handle  || 'svgs-inline-min' === $handle || 'bodhi_svg_inline' === $handle || 'bodhi-dompurify-library' === $handle || 'cookie-notice-front' === $handle) {
		// Add defer attribute.
		return str_replace( ' src', ' defer src', $tag );
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'add_defer_attribute_to_script', 10, 2 );


/***  Preload Style:  */
add_filter( 'style_loader_tag', 'preload_filter', 10, 2 );
function preload_filter( $html, $handle ) {
	if ( 'cookie-notice-front' === $handle || 'theme-style' === $handle || 'gravity_forms_theme_foundation' === $handle || 'gravity_forms_theme_reset' === $handle  || 'gravity_forms_orbital_theme' === $handle  || 'gravity_forms_theme_framework' === $handle || 'megamenu' === $handle  ) {
		$fallback = '<noscript>' . $html . '</noscript>';
		$preload  = str_replace( "rel='stylesheet'", "rel='preload' as='style' onload='this.rel=\"stylesheet\"'", $html );
		$html     = $preload . $fallback;
	}
	return $html;
}
