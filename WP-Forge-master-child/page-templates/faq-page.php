<?php
/**
 * Template Name: FAQs Page Template
 *
 * Description: This is the template for the FAQs page
 *
 * @package WordPress
 * @subpackage WP_Starter
 * @since BADASS Dash 1.0
 */

get_header(); ?>
<?php

    function startsWithNumber($string) {
        return preg_match('/^\d/', $string) === 1;
    }

?>
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
    <div class="faq-page row">
        <div class="faq-module columns large-8 small-12">

            <?php
                $params = array (
                    'limit' => -1,
                    'orderby' => 'faq_section.meta_value ASC'      
                );
                $faqPod = pods('faq', $params);
                $faqSectionArray = array();
                $faqPodArray = array();
            ?>
            <?php while ( $faqPod->fetch() ) : ?> 
                <?php
                    $id         = $faqPod->ID();
                    $permalink  = get_permalink( $id );
                    $question   = $faqPod->field('name');
                    $section    = $faqPod->field('faq_section');
                    $answer     = $faqPod->field('answer');
                    $faqstring  = $section . ',,' . $question . ',,' . $answer;

                    $faqSectionArray[]    = $section;
                    $faqPodArray[] = $faqstring;
                ?>
            <?php endwhile; ?> 
            <?php 
                $uniqueFAQSectionArray = array_unique($faqSectionArray);

                foreach($uniqueFAQSectionArray as $sectionTitleRaw) {
                    $sectionTitle = substr($sectionTitleRaw, 1);
                    echo '<h2>' . $sectionTitle . '</h2>';
                    echo '<section class="faq-section">';
                    foreach($faqPodArray as $faqQA) {
                        $faqStringArray = explode(',,', $faqQA);
                        if ($faqStringArray[0] == $sectionTitleRaw) {
                            $faqQuestion = $faqStringArray[1]; 
                            
                            if (startsWithNumber($faqQuestion) == true) {
                                $faqQuestion = substr($faqQuestion, 1);
                            }

                            echo '<div class="faqQuestionAnswer">';
                            echo '<a href="#" class="faq-question">'.$faqQuestion.'</a>';
                            echo '<div class="faq-answer">'.$faqStringArray[2].'</div>';
                            echo '</div>';
                        }
                    }
                    echo '</section>';
                } 
            ?>  

        </div><!-- end of faq-module -->

        <div class="columns large-offeset-1 large-3 hide-for-small">
            <div class="badass-banner-ad vertical">
                <?php // echo adrotate_group(2); ?>
            </div>
    </div>
</div><!-- #content -->
<?php get_footer(); ?>