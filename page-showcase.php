<?php
/*
Template Name: Showcase Page
*/
?>
<?php
/*
 * Author: Hao Zhou
 * Date: 23/01/2013 
 * This php snippet is dedicated to implementing fastBREAK/Change Media Video Showcase.
 */
?>
<?php get_header(); ?>
	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php endwhile; // end of the loop. ?>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer(); ?>