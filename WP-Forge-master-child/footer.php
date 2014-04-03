<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage WP_Starter
 * @since WP-Starter 1.0
 */
?>
	</section><!-- #main .wrapper -->  
        
	<footer class="footer row" role="contentinfo">
        <ul class="columns small-12 large-8">
            <li><a href="/contact">Contact us</a></li>
            <li><a href="/privacy-policy">Privacy Policy</a></li>
        </ul>
        <span class="columns small-12 large-4 copyright">Copyright 2012-2014 BADASS Dash, LLC</span>

	</footer><!-- .row -->
    
	</div><!-- #wrapper -->

    <?php 
      $footerModalPod = pods( 'footer_modal');
      $footerModalPod->find('name ASC'); 
    ?>
    <?php while ( $footerModalPod->fetch() ) : ?> 
        <?php
            $title      = $footerModalPod->field('name');
            $content    = $footerModalPod->display('post_content');
            $fm_url    = $footerModalPod->field( 'fm_url' );
            $fm_image  = $footerModalPod->field( 'fm_background_image' );
            $fm_image  = pods_image($fm_image, '');
            $hide_title = $footerModalPod->field('fm_hide_title');

            echo '<div class="footer-modal';              
                  // include conditional classes
                  if (!($fm_url=='')) {
                    echo 'has-link ';
                  }
                  if (!($fm_image=='')) {
                    echo 'has-bg-image ';
                  }

            echo '">';

                echo '<div class="footer-modal-inner">';
                    echo '<a href="#" class="no-go close-footer-modal close-modal">×</a>';

                    if (!($fm_url=='')) {
                        echo '<a href="'.$fm_url.'" class="link-this-block" target="_blank"></a>';
                    }

                    if (!($fm_image=='')) {
                        echo'<div class="bg-image">'.$fm_image.'</div>';
                    }

                    echo '<div class="fm-content">';
                        if (!($hide_title=='1')) {
                            echo '<h2 class="font-messy">'.$title.'</h2>';
                        }
                        echo $content;
                    echo '</div>';
                echo '</div>';

            echo '</div>';
        ?>
    <?php endwhile; ?>   
    
    <div id="backtotop">
    
        <i class="fa fa-chevron-circle-up fa-3x"></i>   
    
    </div><!-- #backtotop -->  

<?php wp_footer(); ?>

<script type="text/javascript" async src="//assets.pinterest.com/js/pinit.js"></script>
</body>
</html>
