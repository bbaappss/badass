<?php
/**
 * Template Name: Obstacle content template
 *
 * Description: This is the template for the obstacle content. Name, video, images, description, etc
 *
 * @package WordPress
 * @subpackage WP_Starter
 * @since BADASS Dash 1.0
 */

?>
<div class="obstacle-content hide">
    <?php while ( have_posts() ) : the_post(); ?>
        <?php
            $name = get_the_title($post->ID);
            $videoEmbed = get_post_meta($post->ID, 'video_embed_code', true);
            $slideImages = get_post_meta($post->ID, 'obstacle_slide');
            $k9Check = get_post_meta($post->ID, 'k_9_obstacle');
            $slider = get_post_meta($post->ID, 'slider', true)
        ?>
        <h2 class="font-messy">
            <?php echo $name; ?>
        </h2>
<?php putRevSlider( "$slider" ) ?>
        
        <div class="description">
            <?php the_content(); ?>
        </div>
    <?php endwhile; // end of the loop. ?>
</div><!-- #content -->
