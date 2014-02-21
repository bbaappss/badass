<?php
/**
 * The template for displaying Category pages.
 *
 * Used to display archive-type pages for posts in a category.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 1.0
 */

get_header(); ?>
<div id="content" class="columns small-12 internal-page" role="main">
	
	<div class="row internal-header hide-for-small">
		<div class="badass-banner-ad">
			<?php echo adrotate_group(1); ?>
		</div>
	</div>

	<div class="row row-no-max-width page-title">
		<div class="columns small-12 large-12">
			<h1>MEDIA: <span class="sub-heading"><?php printf( __( '%s', 'wpstarter' ), single_cat_title( '', false ) ); ?></span></h1>
		</div>
	</div>

		<?php if ( have_posts() ) : ?>
		    <?php the_content(); ?>
		<?php endif; // end of the loop. ?>

		<div class="row media-module">
			<div class="columns large-9 latest-post ">
				<?php

					if (is_category( )) {
						$cat = get_query_var('cat');
						$getCatSlug = get_category($cat);
						$catSlug = $getCatSlug->slug;
					}

			    $args = array( 'numberposts' => '-1', 'orderby' => 'post_date', 'order' => 'DESC','post_status' => 'publish', 'category_name'=>$catSlug );
			    $recent_posts = wp_get_recent_posts( $args );
			    //Now lets do something with these posts
			    foreach( $recent_posts as $recent )
			    {
			        echo '<div class="post-preview-container">';
			            echo '<h2 class="post-preview-title font-messy">'.$recent["post_title"].'</h2>';
			            
			            $postDate = $recent["post_date"];
			            $postDate = new DateTime($postDate); 
			            $postDate = $postDate->format('F j, Y');

			            echo '<p>'.$postDate.'</p>';
			            $parsedContent = strip_tags($recent["post_content"]);
			            
			            if (strlen($parsedContent) > 500 ) {
			                $parsedContent = substr($parsedContent, 0 , 500);
			                $parsedContent = $parsedContent.'...';
			            }

			            echo '<div class="post-preview-content"><p>'.$parsedContent.'</p></div>';
			            echo '<a href="'.get_permalink($recent["ID"]).'" class="ba-btn read-more">Read more</a>';
			        echo '</div>';
			    }
				?>
			</div>
			<div class="columns large-3 sidebar">
				<div>
					<?php get_sidebar(); ?>
				</div>
				<div>
					<a href="/events" class="hide-text-indent" target="_blank">
						<!--<img src="<?php bloginfo('stylesheet_directory'); ?>/images/eventbrite-custombutton.png" width="264" height="44" alt="Register now"/>-->
					</a>
				</div>
				<div class="badass-banner-ad vertical">
					<?php // echo adrotate_group(2); ?>
				</div>
			</div>
		</div>
	</div>
</div><!-- #content -->

<?php get_footer(); ?>