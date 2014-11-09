<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 */

get_header(); ?>

<?php get_template_part( 'navigation' ); ?>

<?php if ( have_posts() ) : ?>
    
    <div class="container">

	    <?php while ( have_posts() ) : the_post(); ?>
	    <div class="row">
	        <h3><?php echo the_title(); ?></h3>
	        <small><?php echo the_date(); ?></small>
	        <hr>

	        <?php echo the_content(); ?>
	    </div>
	    <?php endwhile; ?>

    </div>

<?php endif; ?>


<?php get_footer(); ?>