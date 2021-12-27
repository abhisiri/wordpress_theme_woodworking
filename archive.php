<?php
/* Template Name: Custom Template */

get_header();
?>

    <main id="main" class="content-wrapper">

        <?php
        // WP_Query arguments
        $args = array (
            'post_type'      => array( 'portfolio' ),
            'post_status'    => array( 'publish' ),
        );

        // The Query
        $post_query = new WP_Query( $args );

        if ( $post_query->have_posts() ) : ?>

            <header class="page-header">
                <?php
                the_archive_title( '<h1 class="page-title">', '</h1>' );
                ?>
            </header>

            <?php
            // Start the Loop.
            while ( $post_query->have_posts() ) :
                // You can list your posts here
                $post_query->the_post();
                ?>
                <div class="archive-item">
                    <div class="post-title">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </div>

                    <div class="post-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail(); ?>
                        </a>
                    </div>

                    <div class="post-content">
                        <?php the_content(); ?>
                    </div>
                </div>
            <?php
            endwhile;

            // Navigation
            the_post_navigation();
        else :
            // No Post Found
        endif;

        // Restore original Post Data
        wp_reset_postdata();
        ?>
    </main><!-- #main -->

<?php
get_footer();