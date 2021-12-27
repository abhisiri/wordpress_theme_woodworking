

<?php

get_header(); ?>
<?php
if ( have_posts() ) {


?>
<div id="page">
			<div id="page-bgtop">
				<div id="page-bgbtm">
					<?php
				// Load posts loop.
				$loop = new WP_Query( array( 'post_type' => 'gym') ); 


				while ( $loop->have_posts() ) : $loop->the_post();
	
		?>
					<div id="content">
						<div class="post">
							<h2 class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
							<p class="meta">Posted by <a href="<?php the_permalink();?>"><?php the_author(); ?></a> <?php the_time( 'F jS, Y' ); ?>
								&nbsp;&bull;&nbsp; <a href="<?php the_permalink();?>" class="comments"> <?php wp_list_comments(); ?></a> &nbsp;&bull;&nbsp; <a href="<?php the_permalink();?>" class="permalink">Full article</a></p>
							<div class="entry">
								<p><?php the_post_thumbnail('medium', array('class' => 'alignleft border'));?><?php the_content(); ?></p>
							
							</div>
						</div>
					</div>
					<!-- end #content -->
						
					<?php get_sidebar();	
			
endwhile;
			}
			?>	<div style="clear: both;">&nbsp;</div>
			</div>
		</div>
	</div>
	<!-- end #page --><?php
			

get_footer();