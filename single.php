<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>
<?php
if ( have_posts() ) {
?>
<div id="page">
			<div id="page-bgtop">
				<div id="page-bgbtm">
			<?php
			// Start the Loop.
			while ( have_posts() ) {gt_set_post_view(); 
				the_post();
                
		?>
					<div id="content">
						<div class="post">
							<h2 class="title"><a href="#"><?php the_title();?></a></h2>
							<p class="meta">Posted by <a href="#"><?php the_author(); ?></a> <?php the_time( 'F jS, Y' ); ?>
								&nbsp;&bull;&nbsp; <a href="#" class="comments"> <?php echo wp_list_comments();?></a> &nbsp;&bull;&nbsp; <a href="#" class="permalink">Full article</a> &nbsp;&bull;&nbsp; <?= gt_get_post_view(); ?></p>
							<div class="entry">
								<p><?php the_post_thumbnail('medium', array('class' => 'alignleft border'));?><?php the_content();?></p>
                                <p><?php echo get_post_meta(get_the_ID(), 'meta-box-text',true)?></p>
			
							</div>
						</div>
					</div>
					<!-- end #content -->
                    <?php

				
              get_sidebar();
			  // If comments are open or there is at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}	
			
			}
			}
			?>
		<div style="clear: both;">&nbsp;</div>
			</div>
		</div>
	</div>

<?php

get_footer();
