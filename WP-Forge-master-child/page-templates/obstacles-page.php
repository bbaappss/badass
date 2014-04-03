<?php
/**
 * Template Name: Obstacles Page Template
 *
 * Description: This is the template for the obstacles page
 *
 * @package WordPress
 * @subpackage WP_Starter
 * @since BADASS Dash 1.0
 */

get_header(); ?>
<div id="content" class="internal-page columns small-12" role="main">
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

    <div class="row">
        <div class="columns small-12 ba-panel">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; // end of the loop. ?>
        </div>
    </div>
    
    <div class="obstacle-module">
        <div class="obstacle-details-container hide">
            <div class="loading-feedback-container hide">
                <div class="loading-feedback">
                    <div class="trans-bg"></div>
                    <div id="floatingBarsG">
                        <div class="blockG" id="rotateG_01">
                        </div>
                        <div class="blockG" id="rotateG_02">
                        </div>
                        <div class="blockG" id="rotateG_03">
                        </div>
                        <div class="blockG" id="rotateG_04">
                        </div>
                        <div class="blockG" id="rotateG_05">
                        </div>
                        <div class="blockG" id="rotateG_06">
                        </div>
                        <div class="blockG" id="rotateG_07">
                        </div>
                        <div class="blockG" id="rotateG_08">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php
            $params = array (
                'limit' => -1,
                'orderby' => 'name ASC'      
            );
            $obstaclePod = pods('obstacle', $params);
            $obstaclePodArray = array();
        ?>
        
        <?php while ( $obstaclePod->fetch() ) : ?> 
            <?php
                $id         = $obstaclePod->ID();
                $permalink  = get_permalink( $id );
                $name       = $obstaclePod->field('name');
                $image      = $obstaclePod->field('obstacle_featured_image');
                // $image      = pods_image($image, '300x210');
                $image      = pods_image($image, '300x300');
                $videoEmbed = $obstaclePod->field('video_embed_code');
                $k9Check    = $obstaclePod->field('k_9_obstacle');
                $obstacleString  = $k9Check . ',,' . $permalink . ',,' . $name . ',,' . $image . ',,' . $videoEmbed;
                $obstaclePodArray[] = $obstacleString;
            ?>
        <?php endwhile; ?>


        <div class="row obstacles-container">
            <?php 
                foreach($obstaclePodArray as $obstacleContent) {
                    $obstacleStringArray = explode(',,', $obstacleContent);
                    if ($obstacleStringArray[0] !== '1') {
                        echo '<div class="columns small-12 medium-6 large-4">';
                        echo '<div class="obstacle-selection">';
                        echo '<a href="#">';
                        echo '<span class="permalink hide">'.$obstacleStringArray[1].'</span>';
                        echo '<div class="background-image">';
                        echo $obstacleStringArray[3];
                        echo '</div>';
                        echo '<h1>'.$obstacleStringArray[2].'</h1>';
                        echo '</a>';
                        echo '</div>';                            
                        echo '</div>';                            
                    }
                }
            ?>

        </div><!-- end of obstacles-container -->
        
        <div class="row row-no-max-width page-title">
            <div class="columns small-12">
                <h1 class="font-messy">K9 COMPANION OBSTACLES</h1>
            </div>
        </div>

        <div class="row">
            <div class="columns small-12 ba-panel secondary-text">
                <?php the_field('secondary_text'); ?>
            </div>
        </div>

        <!--<div class="row obstacles-container">
            <?php 
                foreach($obstaclePodArray as $obstacleContent) {
                    $obstacleStringArray = explode(',,', $obstacleContent);
                    if ($obstacleStringArray[0] == '1') {
                        echo '<div class="columns small-12 medium-6 large-4">';
                        echo '<div class="obstacle-selection">';
                        echo '<a href="#">';
                        echo '<span class="permalink hide">'.$obstacleStringArray[1].'</span>';
                        echo '<div class="background-image">';
                        echo $obstacleStringArray[3];
                        echo '</div>';
                        echo '<h1>'.$obstacleStringArray[2].'</h1>';
                        echo '</a>';
                        echo '</div>';                            
                        echo '</div>';                            
                    }
                }
            ?>-->
        </div><!-- end of obstacles-container -->
        
    </div><!-- end of obstacle-module -->
</div><!-- #content -->

<?php get_footer(); ?>