<?php
/**
 * Template Name: Full-width Page Template, No Sidebar
 *
 * Description: WP-Forge loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 *
 * @package WordPress
 * @subpackage WP_Starter
 * @since WP-Starter 1.0
 */

get_header(); ?>
<div id="content" class="large-12 columns" role="main">
  <div class="row internal-header hide-for-small">
      <div class="badass-banner-ad">
          <?php echo adrotate_group(1); ?>
      </div>
      
  </div>
  
  <div class="row row-no-max-width page-title">
      <div class="columns small-12 large-8">
          <h1><?php single_post_title(); ?></h1>
      </div>
  </div>

	<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<ul class="breadcrumbs">','</ul>'); } ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'content', 'page' ); ?>
		<?php comments_template( '', true ); ?>
	<?php endwhile; // end of the loop. ?>
</div><!-- #content -->

<?php get_footer(); ?>