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
        <div class="columns large-3 small-12">
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
        </div>
    </div>
    <div class="row row-no-max-width event-content">
        
        <div class="columns large-9 small-12 event-content-inner">
            
            <?php $boolCheck = $event_media['0']; ?>

            <?php if ( !empty($youtube_code)  || !is_bool($boolCheck) )   : ?>
            <div class="slider-container">
                <div class="badass-orbit event-page-orbit">
                    <ul data-orbit data-options="bullets:false; slide_number: false; swipe: false; timer: false;">
                        <?php if ( !empty($youtube_code) )  : ?>
                            <li>
                                <iframe style="width: 100%; height: 100%; z-index: 100" src="//www.youtube.com/embed/<?php echo $youtube_code; ?>" frameborder="0" allowfullscreen></iframe>
                            </li>
                        <?php endif; ?>
                        <?php if (!is_bool($boolCheck))  : ?>
                            <?php foreach ( $event_media as $attachment ): ?>
                            <li>
                                <div class="cropped-image-slide">
                                    <img src="<?php echo pods_image_url($attachment, '598x264'); ?>" />
                                </div>
                            </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <?php endif; ?>


            <div class="section-container tabs" data-section="tabs">
                <section class="active">
                    <p class="title" data-section-title><a href="#panel1">EVENT INFORMATION</a></p>
                    <div class="content" data-section-content>
                        <?php the_content(); ?>
                    </div>
                </section>
                <section>
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
                <section>
                    <p class="title" data-section-title><a href="#panel1">PRICING</a></p>
                    <div class="content" data-section-content>
                        <div class="pricing">
                            <?php echo $event_pricing; ?>
                        </div>
                    </div>
                </section>
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

            <div>
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
                    <p><strong>Sign up below!</strong></p>
                    <!-- Begin MailChimp Signup Form -->
                    <link href="//cdn-images.mailchimp.com/embedcode/classic-081711.css" rel="stylesheet" type="text/css">
                    <style type="text/css">
                      #mc_embed_signup{ clear:left; width: 100%; height:auto;}
                    /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
                       We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
                    </style>
                    <div id="mc_embed_signup">
                    <form action="http://badassdash.us3.list-manage1.com/subscribe/post?u=8becebe28830f04ca44a8f22a[&]id=fc6cd40047" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                        <div class="mc-field-group">
                        <label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
                        </label>
                        <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
                        </div>
                        <div class="mc-field-group">
                        <label for="mce-FNAME">First Name  <span class="asterisk">*</span>
                        </label>
                        <input type="text" value="" name="FNAME" class="required" id="mce-FNAME">
                        </div>
                        <div class="mc-field-group">
                        <label for="mce-LNAME">Last Name  <span class="asterisk">*</span>
                        </label>
                        <input type="text" value="" name="LNAME" class="required" id="mce-LNAME">
                        </div>
                        <div class="mc-field-group">
                        <label for="mce-MMERGE3">City  <span class="asterisk">*</span>
                        </label>
                        <input type="text" value="" name="MMERGE3" class="required" id="mce-MMERGE3">
                        </div>
                        <div class="mc-field-group">
                        <label for="mce-MMERGE4">State  <span class="asterisk">*</span>
                        </label>
                        <input type="text" value="" name="MMERGE4" class="required" id="mce-MMERGE4">
                        </div>
                        <div class="mc-field-group">
                        <label for="mce-MMERGE5">Race Location
                        </label>
                        <select name="MMERGE5" class="required" id="mce-MMERGE5">
                        <option value=""></option>
                        <option value="Atlanta">Atlanta</option>
                        <option value="Chicago">Chicago</option>
                        <option value="Las Vegas">Las Vegas</option>
                        <option value="Toronto, ON">Toronto, ON</option>
                        <option value="Ohio">Ohio</option>
                        <option value="New Jersey / Philadelphia ">New Jersey / Philadelphia </option>
                        <option value="West Chicago ">West Chicago</option>
                        <option value="Ottawa, ON ">Ottawa, ON</option>
                        </select>
                        </div>
                        <div id="mce-responses" class="clear">
                        <div class="response" id="mce-error-response" style="display:none"></div>
                        <div class="response" id="mce-success-response" style="display:none"></div>
                        </div>  <div class="clear"><input type="submit" value="Submit" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                    </form>
                    </div>
                    <!--End mc_embed_signup-->
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