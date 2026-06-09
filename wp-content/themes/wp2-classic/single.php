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

$image = get_field('image');
$content = get_field('content');
?>

<section class="cmn-inner-banner">
    <?php if( $image ){ ?>
    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" height="800" width="1440" class="" fetchpriority="high" />
    <?php }else{ ?>
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/noimage-main.webp" alt="<?php the_title(); ?>" height="800" width="1440" class="" fetchpriority="high" />
    <?php } ?>
    <div class="container banner-data position-relative z-2">
        <div class="row align-items-end">
            <div class="col-xl-9 text-white text-18">
                <h1 class=""><?php the_title(); ?></h1>
                <span class="text-16 d-block"><?php echo date('F d, Y'); ?></span>
            </div>
        </div>
    </div>
</section>

<?php if( get_field('content') ){  ?>
<section class="cms-pages">
    <div class="container">
        <div class="row">
            <div class="rich-text-content col-lg-10 col-xl-7 mx-auto">
                <?php echo get_field('content'); ?>
            </div>
        </div>
    </div>
</section>
<?php } ?>


<?php // Footer CTA
?>
<?php get_template_part('template-parts/custom/footer', 'cta'); ?>

<?php get_footer(); ?>
