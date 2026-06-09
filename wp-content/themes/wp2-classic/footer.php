<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.2
 */

?>
</main>

<footer>
    <div class="container">
        <div class="row">
            <?php if ( has_nav_menu( 'footer-menu1' ) ) {  ?>
            <div class="col-xl-10 ft-menu">
                <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer-menu1',
                            'menu_class'     => 'list-unstyled',
                            'container'      => '',
                        )
                    );
                ?>                
            </div>
            <?php } ?>
            <?php $social_links = get_field('social_links','options');
            if($social_links): ?>                        
            <div class="col-lg-2">
                <div class="social-icons">
                    <?php foreach($social_links as $link): ?>                
                    <a href="<?php echo $link['link']['url']; ?>" rel="noopener" target="<?php echo $link['link']['target']; ?>" aria-label="opens in a new window">
                        <img src="<?php echo $link['image']['url']; ?>" alt="<?php echo $link['link']['title']; ?>" height="24" width="24" class="style-svg" />
                    </a>
                    <?php endforeach;  ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="ft-copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ft-links">
                        <span>&copy; <?php echo esc_html(gmdate('Y')); ?> Glasswerks. All rights reserved. <br/><a href="https://www.spinxdigital.com/" title="Website Design Company in Los Angeles" rel="noopener" target="_blank" aria-label="opens in a new window">Design by SPINX Digital</a></span>
                        <?php $footer_link = get_field('footer_links','options');
                        if($footer_link): 
                        foreach($footer_link as $link): 
                        if( $link['link']){
                        ?>
                        <a href="<?php echo $link['link']['url']; ?>" target="<?php echo $link['link']['target']; ?>"><?php echo $link['link']['title']; ?></a>
                        <?php } endforeach; endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


</div> <?php // End: page-wrapper ?>

<div class="relative z-10">
    <div class="cursor"></div>
</div>
<?php wp_footer(); ?>
</body>

</html>