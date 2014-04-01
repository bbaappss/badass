<div class="top-bar-container sticky fixed">
    <div class="logo-container-outer hide-for-medium-up">
        <div class="logo-container-inner">
            <a 
                href="<?php echo esc_url( home_url( '/' ) ); ?>" 
                title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" 
                rel="home"
                class="top-bar-logo-link">
                <?php $header_image = get_header_image();
                if ( ! empty( $header_image ) ) : ?>
                    <img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
                <?php endif; ?>
            </a>
        </div>
    </div>
    <div class="">
        <nav class="top-bar" data-topbar>
            <div class="top-bar-inner-container">
                <ul class="title-area">
                    <li class="name">
                        <span class="hide">hide</span>
                    </li>
                    <?php //Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone ?>
                    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
                </ul>
                <section class="top-bar-section">
                <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'container' => false,
                        'depth' => 0,
                        'items_wrap' => '<ul>%3$s</ul>',
                        'fallback_cb' => 'wpforge_menu_fallback', // workaround to show a message to set up a menu
                        'walker' => new wpforge_walker( array(
                            'in_top_bar' => true,
                            'item_type' => 'li'
                        ) ),
                    ) );
                ?>
                </section>
            </div>
        </nav><!-- End of Top-Bar -->
    </div> <!-- end of top-bar-conatiner -->
</div>