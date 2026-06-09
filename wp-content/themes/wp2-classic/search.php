<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */


get_header(); ?>

<?php /*
<section class="search-results py-5">
    <div class="container">

        <?php if ( have_posts() ) : ?>

            <header class="page-header mb-4">
                <h1 class="page-title">
                    <?php printf( 'Search Results for: %s', '<span>' . get_search_query() . '</span>' ); ?>
                </h1>
            </header>

            <div class="row">
                <?php while ( have_posts() ) : the_post(); ?>
                    
                    <div class="col-md-4 mb-4">
                        <article id="post-<?php the_ID(); ?>" <?php post_class('card h-100'); ?>>
                            
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="card-img-top">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium', ['class' => 'img-fluid']); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <div class="card-body">
                                <h2 class="card-title h5">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>

                                <p class="card-text">
                                    <?php echo wp_trim_words( get_the_excerpt(), 20 ); ?>
                                </p>
                            </div>

                        </article>
                    </div>

                <?php endwhile; ?>
            </div>

            <div class="pagination mt-4">
                <?php the_posts_pagination(); ?>
            </div>

        <?php else : ?>

            <div class="no-results">
                <h2>No results found</h2>                
                <?php //get_search_form(); ?>
            </div>

        <?php endif; ?>

    </div>
</section>
*/ ?>
 
<section class="search-result-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <form role="search" method="get" class="search-form" action="">
                    <label for="">
                        <span class="screen-reader-text">Search for:</span>
                    </label>
                    <input type="search" id="search_val" class="form-control search-field" placeholder="Search…" value="<?php echo get_search_query(); ?>" name="s">
                    <button type="submit" class="search-submit btn btn-primary with-gradient"></button>
                </form>
                <?php global $wp_query;
                 $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $count = $wp_query->found_posts;
                if($count){
                ?>
                <h1 class="h4"> <?php $text  = ( $count == 1 ) ? 'Result for' : 'Results for'; 
                echo $count . ' ' . $text . ' “' . get_search_query() . '”'; ?> 
                </h1>
                <?php } ?>
            </div>
            <?php if ( have_posts() ) { ?>
            <div class="col-lg-10 mx-auto">
                <div class="results-list">
                    <ul id="search_listing">
                        <?php while ( have_posts() ) : the_post(); 
                        get_template_part('template-parts/custom/search', 'loop'); ?>                       
                        <?php endwhile; ?>                        
                    </ul>
                </div>
            </div>
            <?php }else{ ?>
                <div class="col-lg-4 mx-auto">
                    <div class="no-data-listing text-16 text-center">
                        <img class="mb-4" src="<?php echo get_template_directory_uri(); ?>/assets/images/upload//no-data.svg" alt="nodata" height="48" width="48">
                        <h2 class="h6 mb-3">No Matches Found</h2>
                        <p>Try modifying your search criteria or trying different keywords.</p>
                    </div>
                </div>
            <?php } ?>
        </div>

        <?php
        if ($wp_query->max_num_pages > 1) {
           $pagination = numeric_posts_nav($wp_query, $paged);
            ?>
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="pagination">
                        <div class="nav-links" id="search_listing_pagination">
                            <?php echo $pagination; ?>
                        </div>
                    </div>    
                </div>
            </div>
            <?php
        } ?>
        <!-- <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="pagination">
                    <div class="nav-links">
                        <ul>
                            <li class="inactive prev">Previous</li>
                            <li class="selected">1</li>
                            <li class="">2</li>
                            <li class="">3</li>
                            <li class="">4</li>
                            <li class="">5</li>
                            <li class="">6</li>
                            <li class="">7</li>
                            <li class=" next">Next</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</section>
 
<?php // Footer CTA
?>
<?php get_template_part('template-parts/custom/footer', 'cta'); ?>

<script>
    document.body.className += ' ' + 'dark-head';
</script>

<?php get_footer();
