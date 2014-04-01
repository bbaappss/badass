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
       <?php putRevSlider("test-slider") ?>
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
      
      <div class="large-8 small-12 push-4 columns secondary-container">
        
        <div class="featured-content-block-container">
          <?php
              function startsWithNumber($string) {
                  return preg_match('/^\d/', $string) === 1;
              }
          ?>
          <?php 
            $featuredContentBlockPod = pods( 'featured_content_blo');
            $featuredContentBlockPod->find('name ASC'); 
          ?>
          <?php while ( $featuredContentBlockPod->fetch() ) : ?> 
              <?php
                  $title      = $featuredContentBlockPod->field('name');
                  $content    = $featuredContentBlockPod->display('post_content');
                  $fCB_url    = $featuredContentBlockPod->field( 'featured_content_url' );
                  $fCB_image  = $featuredContentBlockPod->field( 'fcb_background_image' );
                  $fCB_image  = pods_image($fCB_image, '');
                  $hide_title = $featuredContentBlockPod->field('fcb_hide_title');
                  $no_background = $featuredContentBlockPod->field('no_background');
                  $no_border = $featuredContentBlockPod->field('no_border');

                  if (startsWithNumber($title) == true) {
                      $title = substr($title, 1);
                  }

                  echo '<div class="featured-content-block ';
                    // include conditional classes
                    if (!($fCB_url=='')) {
                      echo 'has-link ';
                    }
                    if (!($fCB_image=='')) {
                      echo 'has-bg-image ';
                    }
                    if ($no_background=='1') {
                      echo 'no-background ';
                    }
                    if ($no_border=='1') {
                      echo 'no-border ';
                    }
                  echo '">';

                    if (!($fCB_url=='')) {
                      echo '<a href="'.$fCB_url.'" class="link-this-block" target="_blank"></a>';
                    }

                    if (!($fCB_image=='')) {
                      echo'<div class="bg-image">'.$fCB_image.'</div>';
                    }

                    if (!($hide_title=='1')) {
                      echo '<h2 class="font-messy">'.$title.'</h2>';
                    }

                    echo $content;
                  echo '</div>';
              ?>
          <?php endwhile; ?> 

        </div> <!-- end of featured-content-block-container -->

        <?php 
          //get Pods object for current post
          $frontPagePod = pods( 'front_page_pod');
          //get the value for the relationship field
          $frontPagePod->find('name ASC');      
          $partners = $frontPagePod->field( 'front_page_partners' );
          $content_block = $frontPagePod->field( 'fp_content_block' );
        ?>

        <div class="columns small-12 divisions-container">
          <?php
            echo $content_block;
          ?> 
        </div>

        <div class="columns small-12 latest-post">
           <?php 
              $args = array(
                'numberposts' => '3',
                'category' => '3',
                'orderby' => 'post_date',
                'order' => 'DESC',
                'post_type' => 'post',
                'post_status' => 'publish'
              );
                       
              $recent_posts = wp_get_recent_posts( $args );
              //Now lets do something with these posts
              foreach( $recent_posts as $recent )
              {
                  echo '<div class="post-preview-container">';
                      echo '<h2 class="post-preview-title font-messy"><a href="'.get_permalink($recent["ID"]).'">'.$recent["post_title"].'</a></h2>';
                      
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
                      echo '<a href="'.get_permalink($recent["ID"]).'" class="ba-btn read-more">READ MORE</a>';
                  echo '</div>';
              }
          ?>
        </div> <!-- end of latest-post -->
      </div> <!-- end of secondary-container -->
      <div class="large-4 small-12 pull-8 columns sponsors">
        <h2>Partners</h2>
        <ul class="unstyled partners">
        <?php 
            //loop through related field, creating links to their own pages
            //only if there is anything to loop through
            if ( ! empty( $partners ) ) {
                foreach ( $partners as $partner ) { 
                    //get id for related post and put in ID
                    //for advanced content types use $id = $rel[ 'id' ];
                    $id = $partner[ 'ID' ];
                    $partnerLink = get_post_meta( $id, 'partner_link', true );
                    $partnerLogo = get_post_meta( $id, 'partner_logo', true );
                    $partnerLogo = ($partnerLogo['guid']);

                    //show the related post name as link
                    echo '<li><a href="'.$partnerLink.'"target="_blank" class="desaturate"><img src="'.$partnerLogo.'"/></a></li>';
                } //end of foreach
            } //endif ! empty ( $related )
        ?>
        </ul>
        <div class="facebook hide-for-small">
          <div class="fb-like-box" data-href="https://www.facebook.com/thebadassdash" data-height="510" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="true" data-show-border="true"></div>
        </div> <!-- end of facebook -->
        <div class="twitter hide-for-small">
          <a class="twitter-timeline" href="https://twitter.com/thebadassdash" data-widget-id="416651664850821121">Tweets by @thebadassdash</a>
          <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        </div> <!-- end of twitter -->
      </div>
  </div> <!-- end of homepage-container -->
<?php get_sidebar( 'front' ); ?>        
<?php get_footer(); ?>