<?php
/**
 * Template Name: Events Page Template
 *
 * Description: This is the template for the events page
 *
 * @package WordPress
 * @subpackage WP_Starter
 * @since BADASS Dash 1.0
 */

get_header(); ?>
<div id="content" class="columns small-12 internal-page" role="main">
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
    
    <?php
        $eventPod = pods('event');
        $eventPod->find('event_date ASC');      
    ?>
    <div class="columns small-12">
        <h2>Upcoming</h2>
        <div class="events-container">
            <div class="row event-headings hide-for-small">
                <span class="columns large-7 small-12 header-event-title">EVENT</span>
                <span class="columns large-2 small-12 header-date">DATE</span>
                <span class="columns large-3 small-12 header-register-now">REGISTER</span>
            </div>
            <?php while ( $eventPod->fetch() ) : ?> 
                <?php
                    $id                     = $eventPod->ID();
                    $permalink              = get_permalink( $id );
                    $name                   = $eventPod->field('name');
                    $date                   = $eventPod->field('event_date');
                    $eventbrightlink        = $eventPod->field('event_bright_registration_link');
                ?>
                <div class="row event">
                    <div class="columns large-7 small-12 event-title-container">
                        <a href="<?php echo $permalink ?>" class="event-title ba-btn font-messy">
                                <?php echo $name; ?>
                        </a>
                    </div>
                    <p class="columns large-2 small-12 date"><?php 
                        $formattedDate = new DateTime($date);
                        echo $formattedDate->format('F d, Y');
                        ?>
                    </p>
                    <a class="columns large-3 small-12 register-now" href="<?php echo $eventbrightlink; ?>" target="_blank">
                        <img src="<?php bloginfo('stylesheet_directory'); ?>/images/eventbrite-custombutton.png" width="184" alt="Register Now"/>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <!--
    <h2>Past events</h2>
    -->

</div><!-- #content -->

<?php get_footer(); ?>