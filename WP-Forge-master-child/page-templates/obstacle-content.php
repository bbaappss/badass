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
        ?>
        <h2 class="font-messy">
            <?php echo $name; ?>
        </h2>

        <?php $boolCheck = $slideImages['0']; ?>

        <?php if ( !empty($videoEmbed)  || !is_bool($boolCheck) )   : ?>
            <ul class="orbit-obstacle" data-orbit>
                <?php if ( !empty($videoEmbed) )  : ?>
                    <li>
                        <iframe style="width: 100%; height: 100%; z-index: 100" src="//www.youtube.com/embed/<?php echo $videoEmbed; ?>" frameborder="0" allowfullscreen></iframe>
                    </li>
                <?php endif; ?>
                <?php if (!is_bool($boolCheck))  : ?>
                    <?php foreach ( $slideImages as $attachment ): ?>
                    <li>
                        <div class="cropped-image-slide" 
                             style="background-image: url('<?php echo pods_image_url($attachment, 'large'); ?>');">
                            <img src="<?php echo pods_image_url($attachment, 'medium'); ?>" />
                        </div>
                    </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        <?php endif; ?>
        
        <div class="description">
            <?php the_content(); ?>
        </div>
    <?php endwhile; // end of the loop. ?>
</div><!-- #content -->
