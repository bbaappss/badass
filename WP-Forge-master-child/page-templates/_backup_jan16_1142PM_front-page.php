<?php
/**
 * Template Name: Front Page Template
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in WP-Forge consists of a page content area for adding text, images, video --
 * anything you'd like.
 *
 * @package WordPress
 * @subpackage WP_Starter
 * @since WP-Starter 1.0
 */

get_header(); ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=418237828264441";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

  <div id="content" class="homepage-container front-page" role="main">
    <?php
        $frontPageCarouselPod = pods('front_page_carousel');
        $frontPageCarouselPod->find('name ASC');      
    ?>
    <div class="badass-orbit front-page-orbit">
      <ul data-orbit data-options="bullets: false; slide_number: false; swipe: false; timer: false;">
        <?php while ( $frontPageCarouselPod->fetch() ) : ?> 
        <?php
            $id                   = $frontPageCarouselPod->ID();
            $permalink            = get_permalink( $id );
            $name                 = $frontPageCarouselPod->field('name');
            $link                 = $frontPageCarouselPod->field('front_page_slide_link');
            $media                = $frontPageCarouselPod->field('front_page_slide_media');
            $headline             = $frontPageCarouselPod->field('front_page_slide_headline');
            $secondary_headline   = $frontPageCarouselPod->field('front_page_slide_secondary_headline');
            $paragraph            = $frontPageCarouselPod->field('front_page_slide_paragraph');
        ?>
        <li>
          <a href="<?php echo $link; ?>" class="clickable-slide">
            <div class="slide-image-bg">
                <?php echo pods_image($media, '598x264'); ?>
            </div>
            <div class="slide-container">
              <div class="slide-content-bg"></div>
              <div class="slide-content">
                
                <?php if (!empty($headline)): ?>
                  <h2 class="font-messy"><?php echo $headline; ?></h2>
                <?php endif; ?>
                
                <?php if (!empty($secondary_headline)): ?>
                  <h3><?php echo $secondary_headline; ?></h3>
                <?php endif; ?>

                <?php if (!empty($paragraph)): ?>
                  <p class="hide-for-small"><?php echo $paragraph; ?></p>
                <?php endif; ?>

              </div>
            </div>
          </a>
        </li>
        <?php endwhile; ?>
      </ul>
    </div>
    <?php
        $frontPageRowPod = pods('front_page_row');
        $frontPageRowPod->find('name ASC');      
    ?>

    <?php while ( $frontPageRowPod->fetch() ) : ?> 
      <?php
          $fPRow   = $frontPageRowPod->get_field('front_page_row_markup');
          $fPClass   = $frontPageRowPod->field('front_page_row_class');
          echo '<div class="row '.$fPClass.' ">'.$fPRow.'</div>';
          
      ?>

    <?php endwhile; ?>
    
    <?php
        $frontPageCarouselPod = pods('front_page_carousel');
        $frontPageCarouselPod->find('date DESC');      
    ?>

    <div class="row sponsors-social">
      <div class="columns small-12 large-4 sponsors">
        <h2>Sponsors & Partners</h2>
          <ul>
            <li><a href="#"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/as_blogo_horz_web1.jpg"/></a></li>
            <li><a href="#"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/274x73xotsff_logo-2917340b.jpg"/></a></li>
            <li><a href="#"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/274x54xcsra_logo-cf0c73d2.jpg"/></a></li>
          </ul>
      </div> <!-- end of sponsors -->
      <div class="columns small-12 large-4 facebook hide-for-small">
        <div class="fb-like-box" data-href="https://www.facebook.com/thebadassdash" data-height="510" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="true" data-show-border="true"></div>
      </div> <!-- end of facebook -->
      <div class="columns small-12 large-4 twitter hide-for-small">
        <a class="twitter-timeline" href="https://twitter.com/thebadassdash" data-widget-id="416651664850821121">Tweets by @thebadassdash</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
      </div> <!-- end of twitter -->
    </div>

  </div> <!-- end of homepage-container -->
<?php get_sidebar( 'front' ); ?>        
<?php get_footer(); ?>