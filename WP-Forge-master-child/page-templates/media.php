<?php
/**
 * Template Name: Media Page Template
 *
 * Description: This is the template for the media page
 *
 * @package WordPress
 * @subpackage WP_Starter
 * @since BADASS Dash 1.0
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
            <h1><?php single_post_title(); ?></h1>
        </div>
    </div>

    <?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; // end of the loop. ?>
    
    <div class="row media-module">
        <div class="columns large-9 latest-post">
            <?php
                $args = array( 'numberposts' => '5', 'orderby' => 'post_date', 'order' => 'DESC','post_status' => 'publish' );
                $recent_posts = wp_get_recent_posts( $args );
                //Now lets do something with these posts
                foreach( $recent_posts as $recent )
                {
                    echo '<div class="post-preview-container">';
                        echo '<h2 class="post-preview-title font-messy"><a href="'.get_permalink($recent["ID"]).'">'.$recent["post_title"].'</a></h2>';

                        $categories = get_the_category($recent["ID"]);
                        
                        echo '<p class="media-type">'. $categories[0]->cat_name . '</p>';
                        
                        $postDate = $recent["post_date"];
                        $postDate = new DateTime($postDate); 
                        $postDate = $postDate->format('F j, Y');

                        echo '<p class="date">'.$postDate.'</p>';
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
                <?php echo adrotate_group(2); ?>
            </div>
        </div>
    </div>
</div><!-- #content -->
<?php get_footer(); ?>