<?php

/**
 * The template for displaying capabilities
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); 
$products = get_field('products', get_the_ID());
?>

<section class="cmn-inner-banner">    
    <?php if($products['banner_image']){ ?>
    <img src="<?php echo $products['banner_image']['url']; ?>" alt="<?php echo $products['banner_image']['alt']; ?>" height="800" width="1440" class="" fetchpriority="high" />
    <?php }else{ ?>
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/no-image.webp" alt="<?php the_title(); ?>" height="800" width="1440" class="" fetchpriority="high" />
    <?php } ?>
    <div class="container banner-data position-relative z-2">
        <div class="row align-items-end">
            <div class="col-xl-7 text-white text-18">
                <h1 class=""><?php echo get_the_title(); ?></h1>                
                <?php if($products['description']){ ?>
                    <?php echo $products['description']; ?>
                <?php } ?>
                <a href="<?php echo get_permalink(16); ?>" class="btn btn-secondary">Contact Us</a>
            </div>
        </div>
    </div>
</section>

<?php 
$prod_child = new WP_Query(array(
    'post_type'   => 'capabilities',
    'post_parent' => get_the_ID(),
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC' 
));

if($prod_child->have_posts()) : ?>
<section class="cmn-product-slider-section cmn-products">
    <div class="container">
        <div class="row" data-aos="custom-fade-up">
            <div class="col-lg-12 d-flex justify-content-between align-items-center mb-4">
                <h2 class="h6 mb-0">Products</h2>
                <div id="prod-details-arrows"></div>
            </div>
            <div class="col-12">
                <div class="product-slider cmn-product-listing">   
                <?php while($prod_child->have_posts()) : $prod_child->the_post();                 
                $products = get_field('products', get_the_ID());
                ?>
                    <div class="product-block">
                        <a href="<?php echo get_permalink(); ?>" class="stretched-link img-wrapper">                           
                            <?php if( $products['thumbnail_image']){ ?>
                                <img src="<?php echo $products['thumbnail_image']['url']; ?>" alt="<?php echo $products['thumbnail_image']['alt']; ?>" height="354" width="307" class="default-img" />
                            <?php } ?>
                            <?php if( $products['main_image']){ ?>
                                <img src="<?php echo $products['main_image']['url']; ?>" alt="<?php echo $products['main_image']['alt']; ?>" height="354" width="307" class="hover-img" />
                            <?php } ?>
                        </a>
                        <div class="bottom-text">
                            <strong class="d-block text-16 fw-bold mb-1"><?php echo get_the_title(); ?></strong>                            
                            <?php if($products['sub_title']){ ?>
                                <span class="d-block text-12 fw-normal"><?php echo $products['sub_title']; ?></span>
                            <?php } ?>
                        </div>
                        <span class="slideup-btn">Explore <?php if ( !is_mobile_phone_only() ) { echo get_the_title(); } ?></span>
                    </div>

                <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php wp_reset_postdata();
endif;
?>
<?php $product_gallery = get_field('product_gallery');
if( $product_gallery['title'] || $product_gallery['images'] || $product_gallery['description'] ){ ?>
<section class="transforming-spaces">
    <div class="container">
        <div class="row" data-aos="custom-fade-up">
            <div class="col-lg-5 pt mb-5 mb-lg-0">
                <?php if($product_gallery['title']){ ?>
                <h3 class="h4"><?php echo $product_gallery['title']; ?></h3>
                <?php } ?>
                <?php echo $product_gallery['description']; ?>
            </div>
            <?php if($product_gallery['images']){ ?>
            <div class="col-lg-7 col-xl-6 ms-auto">
                <div id="spaces-arrow"></div>
                <div class="transform-img-slider">
                    <?php foreach($product_gallery['images'] as $image){ ?>
                    <div class="item">
                        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" height="348" width="522" class="" />
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php } ?>
<?php  
$product_detail = get_field('product_detail');
$downloads = get_field('downloads');
if($product_detail || $downloads){ ?>
<section class="product-detail-accordion">
    <div class="container">
        <div class="row" data-aos="custom-fade-up">
            <div class="col-12">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <?php foreach($product_detail as $key=>$detail){ ?>
                    <div class="accordion-item">
                        <button class="accordion-button h6" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-<?php echo $key; ?>" aria-expanded="<?php echo $key == 0 ? 'true' : 'false'; ?>" aria-controls="flush-collapse-<?php echo $key; ?>"><?php echo $detail['title']; ?></button>
                        <div id="flush-collapse-<?php echo $key; ?>" class="accordion-collapse collapse <?php echo $key == 0 ? 'show' : ''; ?>" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <?php echo $detail['description']; ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if($downloads){ ?>
                    <div class="accordion-item">
                        <button class="accordion-button collapsed h6" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">Downloads</button>
                        <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body download-link">
                                <ul class="list-unstyled">
                                    <?php foreach($downloads as $key=>$download){ ?>
                                    <li><a href="<?php echo $download['product_pdf']['url']; ?>" target="_blank"><span><?php echo $download['title']; ?></span></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<?php if(get_field('related_projects')) { ?>
<section class="cmn-project-listing">
    <div class="container">
        <div class="row" data-aos="custom-fade-up">
            <div class="col-12 d-flex justify-content-between mb-4">
                <div class="title text-16">
                    <h2 class="h3">Related Projects</h2><a href="<?php echo get_permalink(10); ?>" class="text-16 fw-medium">View All Projects</a>
                </div>
                <div id="arrows"></div>
            </div>
            
            <div class="col-12">
                <div class="project-slider">
                    <?php foreach(get_field('related_projects') as $project){  ?>
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
