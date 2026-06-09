<?php
get_header(); ?>

<section class="cms-page page-not-found">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/upload/glass-shatter.webp" alt="" height="781" width="1440" class="notfound" />
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="not-found-wrapper">
                    <h1>404</h1>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary with-gradient">Go To Home Page</a>
                </div>
            </div>
        </div>
    </div> 
</section>

<script>
    document.body.className += ' ' + 'dark-head';
</script>
<?php get_footer(); ?>
