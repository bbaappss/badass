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
      <div class="columns small-12 large-4 sponsors">
        <?php 
          //get Pods object for current post
          $frontPagePod = pods( 'front_page_pod');
          //get the value for the relationship field
          $frontPagePod->find('name ASC');      
          $partners = $frontPagePod->field( 'front_page_partners' );
          $content_block = $frontPagePod->field( 'fp_content_block' );
        ?>
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
      
      <div class="columns large-8 small-12 secondary-container">
        <div class="columns small-12 divisions-container">
        <?php
          echo $content_block;
        ?> 
        </div>

        <div class="columns small-12 latest-post">
                      <!--$args = array( 'numberposts' => '3', 'orderby' => 'post_date', 'order' => 'DESC','post_status' => 'publish' );-->
 <?php $args = array(
    'numberposts' => '3',
    'category' => '3',
    'orderby' => 'post_date',
    'order' => 'DESC',
    'post_type' => 'post',
    'post_status' => 'publish');
           
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
                      echo '<a href="'.get_permalink($recent["ID"]).'" class="ba-btn read-more">READ MORE</a>';
                  echo '</div>';
              }
          ?>
        </div>
      </div>
  </div> <!-- end of homepage-container -->
<?php get_sidebar( 'front' ); ?>        
<?php get_footer(); ?>