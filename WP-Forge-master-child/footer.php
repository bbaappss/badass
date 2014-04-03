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
    
	<?php
        if ( ! is_404() )
        get_sidebar( 'footer' );
    ?>    
        
	<footer class="footer row" role="contentinfo">
        <ul class="columns small-12 large-8">
            <li><a href="/contact">Contact us</a></li>
            <li><a href="/privacy-policy">Privacy Policy</a></li>
        </ul>
        <span class="columns small-12 large-4 copyright">Copyright 2012-2014 BADASS Dash, LLC</span>
	</footer><!-- .row -->
    
	</div><!-- #wrapper -->  
    
    <div id="backtotop">
    
        <i class="fa fa-chevron-circle-up fa-3x"></i>   
    
    </div><!-- #backtotop -->  

<?php wp_footer(); ?>
<!--<script type="text/javascript" async src="//assets.pinterest.com/js/pinit.js"></script>-->
</body>
</html>
