<?php

/**
 * Template Name: Home
 *
 * @package Glasswerks
 */

get_header(); ?>
<?php $hero_section = get_field('hero_section'); 
if( $hero_section['image_slider'] || $hero_section['title'] || $hero_section['description'] || $hero_section['link']){ ?>
<section class="cmn-banner">
    <?php if( $hero_section['image_slider'] ){ ?>
    <div class="banner-slider">
        <?php foreach($hero_section['image_slider'] as $slider){ ?>
         <div class="item">
            <img src="<?php echo $slider['image']['url']; ?>" alt="<?php echo $slider['image']['alt']; ?>" height="800" width="1440" class="" fetchpriority="high" />     
        </div>
        <?php } ?>
    </div>
    <?php } ?>
    <div class="container banner-data">
        <div class="row align-items-end">
            <div class="col-lg-9">
                <?php if($hero_section['title'] || $hero_section['subtitle']){ ?>
                <div class="slide-up m-0">
                    <!-- <h1 data-aos="slide-up-custom" class="display"><?php echo $hero_section['title']; ?></h1> -->
                     <h1 class="display">
                        <?php if($hero_section['title']){ ?>
                            <span data-aos="slide-up-custom"><?php echo $hero_section['title']; ?></span>
                        <?php } if($hero_section['subtitle']){ ?>
                            <span class="later" data-aos="slide-up-custom"><?php echo $hero_section['subtitle']; ?> </span>
                        <?php } ?>
                     </h1>
                </div>
                <?php } ?>
                <?php if($hero_section['description']){ ?>
                 <div class="slide-up">
                    <span><?php echo $hero_section['description']; ?></span>     
                </div>
                <?php } ?>                
            </div>
            <div class="col-lg-3">
                <?php if($hero_section['link']){ ?>
                <div class="slide-up m-0 d-flex justify-content-lg-end">
                    <a href="<?php echo $hero_section['link']['url']; ?>" target="<?php echo $hero_section['link']['target']; ?>" class="btn btn-primary with-gradient outline-bg-dark"><?php echo $hero_section['link']['title']; ?></a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<?php } ?>

<?php $counter_section = get_field('counter_section'); 
if($counter_section['image'] || $counter_section['title'] || $counter_section['description'] || $counter_section['counter']){ ?>
<section class="counter-section">
    <div class="container">
        <div class="row align-items-center" data-aos="custom-fade-up">
            <?php if($counter_section['image'] ){ ?>
            <div class="col-lg-4 d-none d-lg-block">
                <img src="<?php echo $counter_section['image']['url']; ?>" alt="<?php echo $counter_section['image']['alt']; ?>" height="460" width="408" class="" fetchpriority="high" />
            </div>
            <?php } ?>
            <?php if($counter_section['title'] || $counter_section['description']){ ?>
            <div class="col-lg-5 col-xxl-4">
                <?php if($counter_section['title']){ ?>
                <h2 class="h4"><?php echo $counter_section['title']; ?></h2>
                <?php } ?>               
                <?php echo $counter_section['description']; ?>                
            </div>
            <?php } ?>
            <?php if($counter_section['counter'] ){ ?>
            <div class="col-lg-3 ms-auto">
                <ul class="list-unstyled">
                    <?php foreach($counter_section['counter'] as $counter){ ?>
                    <li class="text-14">
                        <?php if($counter['sign']){ ?>
                         <span class="d-block h3 m-0"><span data-count="<?php echo $counter['count']; ?>" class="counter d-inline-block">0</span><?php echo $counter['sign']; ?></span>
                        <?php } else { ?>
                        <span data-count="<?php echo $counter['count']; ?>" class="counter h3 m-0">0</span>
                        <?php } ?>
                        <?php if($counter['title']){ ?>
                        <small class="text-14"><?php echo $counter['title']; ?></small>
                        <?php } ?>
                    </li>
                    <?php } ?>                   
                </ul>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php } ?>

<?php $featured_products = get_field('featured_products'); 
if($featured_products['title'] || $featured_products['link'] || $featured_products['select_products']){ ?>
<section class="cmn-products">
    <div class="container" data-aos="custom-fade-up">
        <?php if($featured_products['title'] || $featured_products['link']){ ?>
        <div class="row align-items-center mb-4 pb-lg-0 pb-3">
            <div class="col-lg-8">
                <?php if($featured_products['title']) { ?>
                <h2 class="h3 m-lg-0 mb-3"><?php echo $featured_products['title']; ?></h2>
                <?php } ?>
            </div>
            <div class="col-lg-4 text-lg-end text-16">
                <?php if($featured_products['link']) { ?>
                <a href="<?php echo $featured_products['link']['url']; ?>" target="<?php echo $featured_products['link']['target']; ?>" class="view-all text-16 fw-medium"><?php echo $featured_products['link']['title']; ?></a>
                <?php } ?>                
            </div>
        </div>
        <?php } ?>
        <div class="row cmn-product-listing">
            <?php foreach($featured_products['select_products'] as $productid){  
                $products = get_field('products', $productid); ?>
            <div class="col-lg-4 col-xl-3">
                <div class="product-block">
                    <a href="<?php echo get_the_permalink($productid); ?>" class="stretched-link img-wrapper">
                        <img src="<?php echo $products['thumbnail_image']['url']; ?>" alt="<?php echo $products['thumbnail_image']['alt']; ?>" height="354" width="307" class="default-img" />
                        <img src="<?php echo $products['main_image']['url']; ?>" alt="<?php echo $products['main_image']['alt']; ?>" height="354" width="307" class="hover-img" />
                    </a>
                    <div class="bottom-text">
                        <strong class="d-block text-16 fw-bold mb-1"><?php echo get_the_title($productid); ?></strong>
                        <?php if( $products['sub_title'] ) { ?>
                        <span class="d-block text-12 fw-normal"><?php echo $products['sub_title']; ?></span>
                        <?php } ?>
                    </div>
                    <span class="slideup-btn">Explore <?php if ( !is_mobile_phone_only() ) { echo get_the_title($productid); }  ?></span> 
                </div>
            </div>
            <?php } ?>            
        </div>
    </div>
</section>
<?php } ?>
<?php // Accordion with Image 
    get_template_part('template-parts/custom/accordion', 'img');
?>    

<?php $projects_section = get_field('projects_section'); 
if($projects_section['title'] || $projects_section['link'] || $projects_section['select_projects']){ ?>
<section class="cmn-project-listing">
    <div class="container">
        <div class="row" data-aos="custom-fade-up">
            <div class="col-12 d-flex justify-content-between mb-4 pb-3">
                <?php if($projects_section['title'] || $projects_section['link']) { ?>
                <div class="title text-16">
                    <?php if($projects_section['title']) { ?>
                    <h2 class="h3"><?php echo $projects_section['title']; ?></h2>
                    <?php } ?>
                    <?php if($projects_section['link']) { ?>
                    <a href="<?php echo $projects_section['link']['url']; ?>" target="<?php echo $projects_section['link']['target']; ?>" class="view-all text-16 fw-medium">View All Projects</a>
                    <?php } ?>
                </div>
                <?php } ?>
                <div id="arrows"></div>
            </div>
            <?php if($projects_section['select_projects']) { ?>
            <div class="col-12">
                <div class="project-slider">
                    <?php foreach($projects_section['select_projects'] as $project){  ?>
                    <div class="project-block position-relative">
                        <?php 
                        $projects = get_field('projects', $project);
                        $thumbimage = $projects['project_image'];
                        if($thumbimage) { ?>
                        <span class="img-wrapper d-block">
                            <img src="<?php echo $thumbimage['url']; ?>" alt="<?php echo $thumbimage['alt']; ?>" height="285" width="380" />
                        </span>
                        <?php } ?>
                        <a href="<?php echo get_permalink($project); ?>" class="stretched-link text-18 fw-bold"><?php echo get_the_title($project); ?></a>
                        <?php if($projects['location'] ) { ?>
                        <span class="text-14 d-block desc"><?php echo $projects['location']; ?></span>
                        <?php } ?>
                    </div>
                    <?php } ?>                    
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php } ?>
<?php get_template_part('template-parts/custom/logo', 'slider'); ?>

<?php /*$logo_slider = get_field('logo_slider'); 
if($logo_slider){ ?>
<section class="cmn-logo-slider">
    <div class="slider-wrap" data-aos="custom-fade-up">
        <div class="slider w-100">
            <div class="slider-inner">
                <?php foreach($logo_slider as $logo){ ?>
                 <div class="item">
                    <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" height="80" width="116" class="img-fluid" />
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<?php }*/ ?>
<?php $about_section = get_field('about_section'); 
if($about_section['title'] || $about_section['link'] || $about_section['images']){ ?>
<section class="community-section">
    <div class="container">
        <div class="row align-items-end" data-aos="custom-fade-up">
            <div class="col-lg-4 text-white">
                <div class="wrapper">
                    <?php if($about_section['title']) { ?>
                    <h2 class="h4"><?php echo $about_section['title']; ?></h2>
                    <?php } ?>                    
                    <?php echo $about_section['description']; ?>
                    <?php if($about_section['link']) { ?>
                    <a href="<?php echo $about_section['link']['url']; ?>" target="<?php echo $about_section['link']['target']; ?>" class="text-16"><?php echo $about_section['link']['title']; ?></a>   
                    <?php } ?>
                    
                </div>
            </div>
            <div class="col-lg-8">
                <?php if( $about_section['images'] ){ ?>
                <div class="img-block">
                    <?php foreach($about_section['images'] as $images){ ?>
                    <span class="img-wrapper">
                        <img src="<?php echo $images['url']; ?>" alt="<?php echo $images['alt']; ?>" height="362" width="276" />
                    </span>
                    <?php } ?>                    
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<?php  } ?>
<?php // Testimonial Slider
?>
<?php get_template_part('template-parts/custom/testimonial', 'slider'); ?>

<?php // Footer CTA
?>
<?php get_template_part('template-parts/custom/footer', 'cta'); ?>

<?php get_footer(); ?>
