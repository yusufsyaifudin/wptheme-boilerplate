<?php
/**
 * The main template file
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 */

get_header(); ?>

<!-- Add your site or application content here -->
<?php get_template_part( 'navigation' ); ?>

<?php get_template_part( 'greetings' ); ?>


<div class="container">
<?php if ( have_posts() ) : ?>
    
    <?php while ( have_posts() ) : the_post(); ?>
    <div class="span12">
        <h3><?php echo the_title(); ?></h3>
        <?php echo the_excerpt(); ?>
        
        <br>
        <a href="<?php echo the_permalink(); ?>" class="btn btn-primary">baca selengkapnya</a>
    </div>

    <hr>
    <?php endwhile; ?>

<?php else : ?>

    <div class="span12">
        Sorry, no posts were found
    </div>

<?php endif; ?>
</div>

<?php get_footer(); ?>