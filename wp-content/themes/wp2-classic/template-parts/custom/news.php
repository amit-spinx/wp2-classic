<?php  $image = get_field('image',get_the_ID()); ?>
<div class="col-md-6 col-xl-4">
    <div class="news-block text-20 position-relative">
        <span class="img-wrapper mb-3">            
            <?php if( $image ){ ?>
            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" height="208" width="379" class="" />
            <?php }else{ ?>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/noimage-thumb.webp" alt="<?php the_title(); ?>" height="800" width="1440" class="" fetchpriority="high" />
            <?php } ?>
        </span>
        <p><?php echo get_the_title(); ?> </p>
        <a href="<?php echo get_permalink(); ?>" class="stretched-link"></a>
    </div>
</div>