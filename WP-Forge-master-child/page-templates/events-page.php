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
        <table class="badass-table event-selection">
            <tr class="headers">
                <th>Event</th>
                <th>Date</th>
                <th class="hide-text">Register</th>
            </tr>
                <?php while ( $eventPod->fetch() ) : ?> 
                    
                    <?php
                        $id                     = $eventPod->ID();
                        $permalink              = get_permalink( $id );
                        $name                   = $eventPod->field('name');
                        $date                   = $eventPod->field('event_date');
                        $eventbrightlink        = $eventPod->field('event_bright_registration_link');
                    ?>
                    <tr>
                        <td class="event-title">
                            <a href="<?php echo $permalink ?>" class="ba-btn font-messy">
                                <?php echo $name; ?>
                            </a> 
                        </td>
                        <td class="date">
                            <p class="ba-btn font-messy">
                            <?php 
                                $formattedDate = new DateTime($date);
                                echo $formattedDate->format('m-d-Y');
                            ?>
                            </p>
                        </td>
                        <td>
                            <a href="<?php echo $eventbrightlink; ?>" target="_blank" class="hide-for-small">
                                <img src="<?php bloginfo('stylesheet_directory'); ?>/images/eventbrite-custombutton.png" width="184" alt="Register now"/>
                            </a>
                            <a href="<?php echo $eventbrightlink; ?>" target="_blank" class="hide-for-medium-up">
                                Register
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
        </table>
    </div>
    <!--
    <h2>Past events</h2>
    -->

</div><!-- #content -->

<?php get_footer(); ?>