<?php
get_header(); ?>
<section class="cmn-inner-banner">
    <?php if(get_field('hero_image')){ ?>
    <img src="<?php echo get_field('hero_image')['url']; ?>" alt="<?php echo get_field('hero_image')['alt']; ?>" height="800" width="1440" class="" fetchpriority="high" />
    <?php }else{ ?>
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/no-image.webp" alt="" height="800" width="1440" class="" fetchpriority="high" />
    <?php } ?>
    <div class="container banner-data position-relative z-2">
        <div class="row align-items-end">
            <div class="col-xl-7 text-white text-18">
                <h1 class=""><?php the_title(); ?></h1>
                <?php if(get_field('hero_description')){ ?>
                <span><?php echo get_field('hero_description'); ?></span>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<?php if(get_field('content')){ ?>
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
