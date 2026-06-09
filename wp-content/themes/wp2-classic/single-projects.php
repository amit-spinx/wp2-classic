<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); 
$projects = get_field('projects');
$main_image = $projects['main_image'];
?>
<section class="cmn-inner-banner">
    <img src="<?php echo $main_image['url']; ?>" alt="<?php echo $main_image['alt']; ?>" height="800" width="1440" class="" fetchpriority="high" />
    <div class="container banner-data position-relative z-2">
        <div class="row align-items-end">
            <div class="col-xl-7 text-white text-18">
                <h1 class=""><?php echo get_the_title(); ?></h1>
                <a href="<?php echo get_permalink(16); ?>" class="btn btn-secondary">Contact Us</a>
            </div>
        </div>
    </div>
</section>
<?php 
 
$short_description = $projects['short_description'];
$content = $projects['content'];
$location = $projects['location'];
$team_members = $projects['team_members'];
$architect_label = $projects['architect_label'];
$architect = $projects['architect'];
$select_video = $projects['select_video'];
$select_video = $projects['select_video']; 
if($location || $team_members || $architect || $content || $short_description){ ?>
<section class="project-detail-intro">
    <div class="container">
        <div class="row">
            <?php if($short_description || $content || $select_video != 'none'){ ?>
            <div class="col-lg-7 mb-5 mb-lg-0">
                <div class="rich-text-content">
                    <h5><?php echo $short_description; ?></h5>
                    <?php if($content){ ?>
                    <div class="collapse" id="collapseExample">
                        <div class="">
                            <?php echo $content; ?>
                        </div>
                    </div>
                    <a id="toggleLink" class="text-14 fw-bold text-uppercase" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">read more</a>
                    <?php } ?>
                </div>
                <?php /*if($select_video != 'none'){ ?>
                <div class="ratio ratio-16x9 mt-4">                    
                    <!-- <iframe src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" title="video" allowfullscreen></iframe> -->
                    <?php if($select_video == 'iframe'){ 
                        $youtube_video_url = $projects['youtubevimeo'];
                        if($youtube_video_url){ ?>
                        <iframe src="<?php echo $youtube_video_url; ?>" title="video" allowfullscreen></iframe>
                    <?php } }elseif($select_video == 'mp4'){ 
                        $mp4_url = $projects['mp4']; ?>
                        <video controls>
                            <source type="video/mp4" src="<?php echo $mp4_url; ?>" />
                        </video>
                    <?php } ?>                    
                </div>
                <?php } */ ?>

                <?php if ( ! empty($select_video) && $select_video !== 'none' ) : ?>
                <div class="ratio ratio-16x9 mt-4">

                    <?php if ( $select_video === 'iframe' ) : 
                        
                        $video_url = ! empty($projects['youtubevimeo']) ? trim($projects['youtubevimeo']) : '';

                        if ( $video_url ) :

                            // Convert YouTube watch URL → embed URL
                            if ( strpos($video_url, 'youtube.com/watch') !== false ) {
                                parse_str(parse_url($video_url, PHP_URL_QUERY), $query);
                                if ( ! empty($query['v']) ) {
                                    $video_url = 'https://www.youtube.com/embed/' . esc_attr($query['v']);
                                }
                            }

                            // Convert youtu.be short URL → embed
                            if ( strpos($video_url, 'youtu.be/') !== false ) {
                                $video_id = basename(parse_url($video_url, PHP_URL_PATH));
                                $video_url = 'https://www.youtube.com/embed/' . esc_attr($video_id);
                            }

                            // Optional: Handle Vimeo
                            if ( strpos($video_url, 'vimeo.com') !== false ) {
                                $video_id = basename(parse_url($video_url, PHP_URL_PATH));
                                $video_url = 'https://player.vimeo.com/video/' . esc_attr($video_id);
                            }
                            ?>

                            <iframe 
                                src="<?php echo esc_url($video_url); ?>" 
                                title="Video"                                                              
                                allowfullscreen>
                            </iframe>

                        <?php endif; ?>

                    <?php elseif ( $select_video === 'mp4' ) : 

                        $mp4_url = ! empty($projects['mp4']) ? $projects['mp4'] : '';

                        if ( $mp4_url ) : ?>
                            <video controls>
                                <source src="<?php echo esc_url($mp4_url); ?>" type="video/mp4">                                
                            </video>
                        <?php endif; ?>

                    <?php endif; ?>

                </div>
            <?php endif; ?>
            </div>
            <?php } ?>
            <?php if($location || $team_members || $architect){ ?>
            <div class="col-lg-4 ms-auto prj-details">
                <ul class="list-unstyled">
                    <?php if($location){ ?>
                    <li>
                        <span class="d-block mb-2 fw-semibold text-14 text-uppercase">Location</span>
                        <span class="d-block text-18 fw-normal"><?php echo $location; ?></span>
                    </li>
                    <?php } if($team_members){ ?>
                    <li>
                        <span class="d-block mb-2 fw-semibold text-14 text-uppercase">Partners</span>
                        <span class="d-block text-18 fw-normal"><?php echo $team_members; ?></span>
                    </li>
                    <?php } if($architect || $architect_label){ ?>
                    <li>
                        <span class="d-block mb-2 fw-semibold text-14 text-uppercase"><?php if($architect_label){echo $architect_label; }else{ echo "Architect"; } ?></span>
                        <?php if($architect){ ?><span class="d-block text-18 fw-normal"><?php echo $architect; ?></span> <?php } ?>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php } ?>

<?php $related_products = get_field('related_products');
if($related_products){ ?>
<section class="cmn-product-slider-section cmn-products">
    <div class="container">
        <div class="row" data-aos="custom-fade-up">
            <div class="col-lg-12 d-block d-md-flex justify-content-between align-items-center mb-4">
                <h2 class="h6 mb-0">Related Products</h2>
                <div id="prod-details-arrows"></div>
            </div>
            <div class="col-12">
                <div class="product-slider cmn-product-listing">
                    <?php foreach($related_products as $productid){ 
                    $product = get_field('products', $productid); ?>
                    <div class="product-block">
                        <a href="<?php echo get_permalink($productid); ?>" class="stretched-link img-wrapper">                           
                            <?php if( $product['thumbnail_image']){ ?>
                                <img src="<?php echo $product['thumbnail_image']['url']; ?>" alt="<?php echo $product['thumbnail_image']['alt']; ?>" height="354" width="307" class="default-img" />
                            <?php } ?>
                            <?php if( $product['main_image']){ ?>
                                <img src="<?php echo $product['main_image']['url']; ?>" alt="<?php echo $product['main_image']['alt']; ?>" height="354" width="307" class="hover-img" />
                            <?php } ?>
                        </a>
                        <div class="bottom-text">
                            <strong class="d-block text-16 fw-bold mb-1"><?php echo get_the_title($productid); ?></strong>                            
                            <?php if($product['sub_title']){ ?>
                                <span class="d-block text-12 fw-normal"><?php echo $product['sub_title']; ?></span>
                            <?php } ?>
                        </div>
                        <span class="slideup-btn">Explore <?php if ( !is_mobile_phone_only() ) { echo get_the_title($productid); } ?></span> 
                    </div>
                    <?php } ?>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<?php $on_site_photo_gallery = get_field('on_site_photo_gallery');
if($on_site_photo_gallery){ ?>
<section class="prj-site-photos">
    <div class="container">
        <div class="row" data-aos="custom-fade-up">
            <div class="col-lg-12 d-block d-md-flex justify-content-between align-items-center mb-4">
                <h2 class="h6 mb-0">On-Site Photos</h2>
                <div id="photos-arrows"></div>
            </div>
            <div class="col-12">
                <div class="transform-img-slider">
                    <?php foreach($on_site_photo_gallery as $image){ ?>
                    <div class="item">
                        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" height="348" width="522" class="" />
                    </div>
                    <?php } ?>                    
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>

<?php // Testimonial Slider
?>
<?php get_template_part('template-parts/custom/testimonial', 'slider'); ?>

<?php // Footer CTA
?>
<?php get_template_part('template-parts/custom/footer', 'cta'); ?>

<?php get_footer(); ?>
