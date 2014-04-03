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
        $futureEventPodArray = array();
        $pastEventPodArray = array();
    ?>

    <?php while ( $eventPod->fetch() ) : ?> 
        <?php
            $id                     = $eventPod->ID();
            $permalink              = get_permalink( $id );
            $name                   = $eventPod->field('name');
            $date                   = $eventPod->field('event_date');
            $eventbrightlink        = $eventPod->field('event_bright_registration_link');
            $eventString            = $name . ',,' . $date . ',,' . $permalink . ',,' . $eventbrightlink;
            
            if ( (strtotime($date) > time()) ) {
                $futureEventPodArray[] = $eventString;
            } else {
                $pastEventPodArray[] = $eventString;
            }
        ?>
    <?php endwhile; ?>

    <div class="columns small-12 events-page">
        <div class="section-container tabs" data-section="tabs">
            <section class="upcoming-events active">
                <p class="title" data-section-title>
                    <a href="#panel1">UPCOMING EVENTS</a>
                </p>
                <div class="content" data-section-content>
                    <div class="events-container">
                        <div class="row event-headings hide-for-small">
                            <span class="columns large-7 small-12 header-event-title">EVENT</span>
                            <span class="columns large-2 small-12 header-date">DATE</span>
                            <span class="columns large-3 small-12 header-register-now">REGISTER</span>
                        </div>
                        <?php foreach($futureEventPodArray as $futureEvent) : ?>
                            <?php
                                $eventStringArray = explode(',,', $futureEvent);
                                $title = $eventStringArray[0]; 
                                $date = $eventStringArray[1]; 
                                $linkToContent = $eventStringArray[2]; 
                                $eventBriteUrl = $eventStringArray[3];
                            ?> 
                            <div class="row event">
                                <div class="columns large-7 small-12 event-title-container">
                                    <a href="<?php echo $linkToContent ?>" class="event-title ba-btn font-messy">
                                            <?php echo $title; ?>
                                    </a>
                                </div>
                                <p class="columns large-2 small-12 date"><?php 
                                    $formattedDate = new DateTime($date);
                                    echo $formattedDate->format('F d, Y');
                                    ?>
                                </p>
                                <a class="columns large-3 small-12 register-now" href="<?php echo $eventBriteUrl; ?>" target="_blank">
                                    <img src="<?php bloginfo('stylesheet_directory'); ?>/images/eventbrite-custombutton.png" width="184" alt="Register Now"/>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <section class="past-events">
                <p class="title" data-section-title>
                    <a href="#panel1">PAST EVENTS</a>
                </p>
                <div class="content" data-section-content>
                    <div class="events-container">
                        <div class="row event-headings hide-for-small">
                            <span class="columns large-7 small-12 header-event-title">EVENT</span>
                            <span class="columns large-2 small-12 header-date">DATE</span>
                        </div>
                        <?php foreach($pastEventPodArray as $pastEvent) : ?>
                        <?php
                            $eventStringArray = explode(',,', $pastEvent);
                            $title = $eventStringArray[0]; 
                            $date = $eventStringArray[1]; 
                            $linkToContent = $eventStringArray[2]; 
                            $eventBriteUrl = $eventStringArray[3];
                        ?> 
                        <div class="row event">
                            <div class="columns large-7 small-12 event-title-container">
                                <a href="<?php echo $linkToContent ?>" class="event-title ba-btn font-messy">
                                        <?php echo $title; ?>
                                </a>
                            </div>
                            <p class="columns large-2 small-12 date"><?php 
                                $formattedDate = new DateTime($date);
                                echo $formattedDate->format('F d, Y');
                                ?>
                            </p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div><!-- #content -->

<?php get_footer(); ?>