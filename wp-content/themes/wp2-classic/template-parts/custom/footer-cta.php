<!--Location Start: <?php echo __DIR__ . '/' . basename(__FILE__); ?>-->
<?php $footer_cta = get_field('footer_cta','options'); 
if($footer_cta){
?>
<section class="cmn-cta overflow-visible">
    <?php if($footer_cta['background_image']){ ?>
    <span class="img-wrapper">
        <img src="<?php echo $footer_cta['background_image']['url']; ?>" alt="<?php echo $footer_cta['background_image']['alt']; ?>" height="800" width="1440" class="" />
    </span>
    <?php } ?>
    <div class="bg-white-cta">
        <div class="container">
            <div class="row">
                <div class="col-12 position-relative">
                    <div class="cta-wrap">
                        <?php if($footer_cta['title']){ ?><h2><?php echo $footer_cta['title']; ?></h2> <?php } ?>
                        <?php if($footer_cta['link']){ ?>
                        <a href="<?php echo $footer_cta['link']['url']; ?>" target="<?php echo $footer_cta['link']['target']; ?>" class="btn btn-primary with-gradient"><?php echo $footer_cta['link']['title']; ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<!--Location End: <?php echo __DIR__ . '/' . basename(__FILE__); ?>-->
