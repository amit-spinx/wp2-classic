<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="format-detection" content="telephone=no" />
	<meta name="language" content="en-us" />
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" type="image/x-icon" />
	<?php wp_head(); ?>
	<script>
		var wpAjaxUrl = '<?php echo admin_url('admin-ajax.php'); ?>';
		var wpEnv = "<?php echo WP_ENV; ?>";
	</script>

</head>

<body <?php body_class(); ?>>
	
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
	<symbol id="btn-white-arrow" width="24" height="23" viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M7 16.2943L17 6.71094M17 6.71094H7M17 6.71094V16.2943" stroke="#131841" stroke-linecap="round" stroke-linejoin="round"/>
	</symbol>
</svg>
<div class="page-wrapper">
	<header class="fixed-top" role="banner">
		<?php  $portal_link = get_field('portal_link','options');
		if($portal_link): ?>
		<div class="top-bar d-lg-block d-none">
			<div class="container">
				<div class="row">
					<div class="col-12 d-flex justify-content-end">
						<a href="<?php echo $portal_link['url']; ?>" target="<?php echo $portal_link['target']; ?>"><?php echo $portal_link['title']; ?> <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M4.66406 11.3307L11.3307 4.66406M11.3307 4.66406H4.66406M11.3307 4.66406V11.3307" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
						</svg></a>
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<div class="container">
			<nav class="navbar navbar-expand-lg">
				<?php  
				$header_logo_light = get_field('header_logo','options');
				$header_logo_dark = get_field('header_logo_dark','options');
				if( $header_logo_light || $header_logo_dark ): ?>
				<a aria-label="" class="navbar-brand p-0" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php if(  $header_logo_light ): ?>
					<img fetchpriority="high" src="<?php echo $header_logo_light['url']; ?>" alt="<?php echo $header_logo_light['alt']; ?>" class="img-fluid dark-header-logo " height="66" width="66" />
					<?php endif; ?>
					<?php if( $header_logo_dark  ): ?>
					<img fetchpriority="high" src="<?php echo $header_logo_dark['url']; ?>" alt="<?php echo $header_logo_dark['alt']; ?>" class="img-fluid light-header-logo" height="66" width="66" />
					<?php endif; ?>
				</a>
				<?php endif; ?>
				<div class="menu-wrapper">
					<form class="header-search" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
						<input type="text" name="s" placeholder="Search" value="<?php echo get_search_query(); ?>" />
						<a href="javascript:;" class="close-search">
							<svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M0.710938 0.710938L14.2109 14.2109" stroke="white" stroke-width="2"/>
								<path d="M14.2109 0.710938L0.710937 14.2109" stroke="white" stroke-width="2"/>
							</svg>
						</a>
					</form>
					<?php /* $contact_link = get_field('contact_link','options');
						if($contact_link): ?>
							<a href="<?php echo $contact_link['url']; ?>" target="<?php echo $contact_link['target']; ?>" class="btn btn-secondary d-lg-none d-block"><?php echo $contact_link['title']; ?></a>
						<?php endif; */ ?>
						<a href="javascript:;" class="search-icon"><span class="d-none">Searchbar</span></a>
						<div class="offcanvas offcanvas-top navbar-collapse" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
							<div class="nav-blur d-none d-lg-block"></div>
						<?php
							wp_nav_menu(
								array(
									'theme_location' => 'main-menu',
									'menu_class'     => 'navbar-nav list-unstyled',
									'container'      => '',
								)
							);
						?>
					</div>
					<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop" aria-label="Toggle navigation"></button>
				</div>
			</nav>
		</div>
	</header>




<main role="main">