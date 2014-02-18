<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage WP_Starter
 * @since WP-Forge 1.0
 */

get_header(); ?>
<div id="content" class="internal-page large-12 columns" role="main">
    <div class="row internal-header hide-for-small">
        <div class="badass-banner-ad">
            <?php echo adrotate_group(1); ?>
        </div>
        
    </div>
    
    <div class="row row-no-max-width page-title">
      <div class="columns small-12 large-8">
      	<a href="/media">< Media</a>
      	<h1 class="smaller-page-title"><?php single_post_title(); ?></h1>
      </div>
      <div class="columns large-3 large-offset-1">
          <div class="social-media-hori-share">
              <div class="facebook">
                  <div class="fb-like" data-href="http://fasdfd.com" data-layout="box_count" data-action="like" data-show-faces="false" data-share="false"></div>
              </div>
              <div class="twitter">
                  <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo get_permalink( $post->ID ); ?>" data-via="thebadassdash" data-lang="en" data-related="anywhereTheJavascriptAPI" data-count="vertical">Tweet</a>
                  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
              </div>
              <div class="pinterest">
                  <a href="//www.pinterest.com/pin/create/button/?url=badassdash.com&media=http%3A%2F%2Fbadass.com%2Fimage.png&description=baddass%20description" data-pin-do="buttonPin" data-pin-config="above" data-pin-height="28"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_28.png" /></a>
              </div>
          </div>
        </div>
    </div>
    <div class="row">
        <div class="columns large-8 small-12">

           <?php while ( have_posts() ) : the_post(); ?>

           <?php the_content(); ?>

           	<?php comments_template( '', true ); ?>

           <?php endwhile; // end of the loop. ?>

        </div>
        <div class="columns large-offeset-1 large-3 hide-for-small">
          <?php get_sidebar(); ?>
          <div class="badass-banner-ad vertical">
              <?php // echo adrotate_group(2); ?>
          </div>
        </div>
		</div>
</div><!-- #content -->

<?php get_footer(); ?>