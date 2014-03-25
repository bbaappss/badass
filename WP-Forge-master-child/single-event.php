<?php
/**
 * Template Name: Single Event Page Template
 *
 * Description: This is the template for a singular event page
 *
 * @package WordPress
 * @subpackage WP_Starter
 * @since BADASS Dash 1.0
 */

get_header(); ?>
<div id="content" class="internal-page large-12 columns single-event-page" role="main">
    <div class="row internal-header hide-for-small">
        <div class="badass-banner-ad">
            <?php echo adrotate_group(1); ?>
        </div>
        
    </div>

    <?php while ( have_posts() ) : the_post(); ?>
        <?php
            $name = get_the_title($post->ID);
            $event_date = get_post_meta($post->ID, 'event_date', true);
            $event_bright_link = get_post_meta($post->ID, 'event_bright_registration_link', true);
            $event_waiver_download = get_post_meta($post->ID, 'event_waiver_download');
            $location = get_post_meta($post->ID, 'location', true);
            $event_media = get_post_meta($post->ID, 'event_media');
            $youtube_code = get_post_meta($post->ID, 'event_youtube_code', true);
            $event_date = get_post_meta($post->ID, 'event_date', true);
            $registration_close = get_post_meta($post->ID, 'registration_close', true);
            $event_pricing = get_post_meta($post->ID, 'event_pricing', true);
            $google_map = get_post_meta($post->ID, 'google_map', true);
            $parking_details = get_post_meta($post->ID, 'parking_details', true);
            $event_right_block_1 = get_post_meta($post->ID, 'event_right_block_1', true);
            $volunteer_form_code = get_post_meta($post->ID, 'volunteer_form_code', true);
            $custom_tab_title_1 = get_post_meta($post->ID, 'custom_tab_title_1', true);
            $custom_tab_content_1 = get_post_meta($post->ID, 'custom_tab_content_1', true);
            $custom_tab_title_2 = get_post_meta($post->ID, 'custom_tab_title_2', true);
            $custom_tab_content_2 = get_post_meta($post->ID, 'custom_tab_content_2', true);

            //get Pods object for current post
            $eventPod = pods( 'event', get_the_id() );
            //get the value for the relationship field
            $partners = $eventPod->field( 'event_partners' );
        ?>


    
    <div class="row row-no-max-width page-title">
        <div class="columns large-9 small-12">
            <h1 class="smaller-page-title"><?php single_post_title(); ?></h1>
            <h2 class="date">
                <?php
                   $formatEventDate = new DateTime($event_date); 
                   echo $formatEventDate->format('F j, Y'); 
                ?>
            </h2>
        </div>
        <!-- Comment out social media share boxes -->
        <!-- <div class="columns large-3 small-12">
            <div class="social-media-hori-share">
                <div class="facebook">
                    <div class="fb-like" data-href="http://fasdfd.com" data-layout="box_count" data-action="like" data-show-faces="false" data-share="false"></div>
                </div>
                <div class="twitter">
                    <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo get_permalink( $post->ID ); ?>" data-via="thebadassdash" data-lang="en" data-related="anywhereTheJavascriptAPI" data-count="vertical">Tweet</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                </div>
                <div class="pinterest">
                    <a href="//www.pinterest.com/pin/create/button/?url=badassdash.com&media=http%3A%2F%2Fbadass.com%2Fimage.png&description=baddass%20description" data-pin-do="buttonPin" data-pin-config="above" data-pin-height="28"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_28.png" /></a>
                </div>
            </div>
        </div> -->
    </div>
    <div class="row row-no-max-width event-content">
        <div class="columns large-9 small-12 event-content-inner">
            <?php $boolCheck = $event_media['0']; ?>

            <?php if ( !empty($youtube_code)  || !is_bool($boolCheck) )   : ?>
            <div class="slider-container">
                <?php putRevSlider( "general-event-slider" ) ?>
            </div>
            <?php endif; ?>

            <div class="section-container tabs" data-section="tabs">
                <section class="information active">
                    <p class="title" data-section-title><a href="#panel1">EVENT INFORMATION</a></p>
                    <div class="content" data-section-content>
                        <?php the_content(); ?>
                    </div>
                </section>
                <section class="location">
                    <p class="title" data-section-title><a href="#panel1" class="load-map">LOCATION</a></p>
                    <div class="content" data-section-content>
                        <div class="location">
                            <div class="address">
                                <?php echo $location; ?>
                            </div>
                            <div class="google-map hide-for-small-only">
                                <input type="hidden" class="gmap-code-for-js" value='<?php echo $google_map; ?>'/>
                            </div>
                            <div>
                                <h2>PARKING</h2>
                                <?php echo $parking_details ?>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="pricing">
                    <p class="title" data-section-title><a href="#panel1">PRICING</a></p>
                    <div class="content" data-section-content>
                        <div class="pricing">
                            <?php echo $event_pricing; ?>
                        </div>
                    </div>
                </section>
                <?php if (!empty($custom_tab_title_1) && (!empty($custom_tab_content_1))) : ?>
                    <section class="<?php echo $custom_tab_title_1; ?>">
                        <p class="title" data-section-title><a href="#panel1"><?php echo $custom_tab_title_1; ?></a></p>
                        <div class="content" data-section-content>
                            <div class="<?php echo $custom_tab_title_1; ?>">
                                <?php echo $custom_tab_content_1; ?>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>
                <?php if (!empty($custom_tab_title_2) && (!empty($custom_tab_content_2))) : ?>
                    <section class="<?php echo $custom_tab_title_2; ?>">
                        <p class="title" data-section-title><a href="#panel1"><?php echo $custom_tab_title_2; ?></a></p>
                        <div class="content" data-section-content>
                            <div class="<?php echo $custom_tab_title_2; ?>">
                                <?php echo $custom_tab_content_2; ?>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>
                <!-- <section class="pricing">
                    <p class="title" data-section-title><a href="#panel1">PRICING</a></p>
                    <div class="content" data-section-content>
                        <div class="pricing">
                            <?php echo $event_pricing; ?>
                        </div>
                    </div>
                </section> -->
            </div>
        </div>

        <div class="columns large-3 small-12 sidebar event-sidebar">
            <div>
                <a href="<?php echo $event_bright_link; ?>" class="hide-text-indent" target="_blank">
                    <img src="<?php bloginfo('stylesheet_directory'); ?>/images/eventbrite-custombutton.png" width="264" height="44" alt="Register now"/>
                </a>
            </div>
            
            <div>
                <input type="hidden" class="countdown-end-date"value="<?php 
                        $formatRegistrationClose = new DateTime($registration_close);
                        echo $formatRegistrationClose->format('F j, Y, g:i a');
                    ?>
                ">
                <h2>Registration closes in</h2>
                <div class="countdown event-countdown styled"></div>
            </div>

            <div class="ba-panel">
                <?php
                    echo $event_right_block_1;
                ?>
            </div>
                
            <div>
                <a href="<?php echo $event_waiver_download['0']['guid']; ?>" class="ba-btn btn-large font-messy" target="_blank">DOWNLOAD WAIVER</a>
            </div>

            <div class="volunteer-container">
                <button class="ba-btn btn-large font-messy volunteer-form-trigger">VOLUNTEER</button>
                <div class="volunteer-form">
                    <p>The BADASS Dash is always looking for good volunteers that are BADASS in their own way and are looking for the experience of a lifetime. Each Volunteer will receive a BADASS Dash™ t-shirt and be provided with drinks / snacks.</p>
                    <p><strong>SIGN UP TO VOLUNTEER BELOW</strong></p>
                    <?php echo $volunteer_form_code; ?> 
                </div>
            </div>
            <div>
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
            </div>
        </div>
        
    </div>

    <?php endwhile; // end of the loop. ?>

</div><!-- #content -->

<?php get_footer(); ?>