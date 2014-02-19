<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage WP_Starter
 * @since WP-Starter 1.0
 */

get_header(); ?>
<div id="content" class="internal-page small-12 columns" role="main">
  <div class="row internal-header hide-for-small">
      <div class="badass-banner-ad">
          <?php echo adrotate_group(1); ?>
      </div>
      
  </div>
  
  <div class="row row-no-max-width page-title">
      <div class="columns small-12 large-9">
          <h1 class="smaller-page-title"><?php single_post_title(); ?></h1>
      </div>
  </div>
    
			<?php while ( have_posts() ) : the_post(); ?>

      <?php the_content(); ?>

        <?php comments_template( '', true ); ?>

      <?php endwhile; // end of the loop. ?>

	</div><!-- #content -->
  
<?php get_footer(); ?>