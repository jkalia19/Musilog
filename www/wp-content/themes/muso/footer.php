<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Muso
 */

?>

	</div><!-- #content -->
	<div class="widget-area" id="footer-widget">
    	<div class="container">
        	
            <div class="row">
                <div class="col-md-4">                    
                    <?php dynamic_sidebar('footer-one-widget'); ?>
                </div>
                <div class="col-md-4">                    
                    <?php dynamic_sidebar('footer-two-widget'); ?>
                </div>
                <div class="col-md-4">                    
                    <?php dynamic_sidebar('footer-three-widget'); ?>
                </div>
            </div>
            
        </div>
    </div>
    
	<footer id="colophon" class="site-footer" role="contentinfo">
    	<div class="container">
        	<div class="col-md-12">
            
            	<?php if ( has_nav_menu( 'social' ) ) {
					wp_nav_menu(
						array(
							'theme_location'  => 'social',
							'container'       => 'div',
							'container_id'    => 'menu-social',
							'container_class' => 'menu',
							'menu_id'         => 'menu-social-items',
							'menu_class'      => 'menu-items',
							'depth'           => 1,
							'link_before'     => '<span class="screen-reader-text">',
							'link_after'      => '</span>',
							'fallback_cb'     => '',
						)
					);
				
				} ?>
                
                <div class="site-info">
                   <?php if(is_home() && !is_paged()){
					   $theme = wp_get_theme();?> 
                                <?php _e('Powered by ', 'muso'); ?><a href="<?php echo esc_url( __( 'http://wordpress.org/', 'muso' ) ); ?>" title="<?php esc_attr_e( 'WordPress' ,'muso' ); ?>"><?php _e('WordPress' ,'muso'); ?></a>
					<?php _e(' and ', 'muso'); ?><a href="<?php echo esc_url( $theme->get( 'AuthorURI' ) ); ?>"><?php _e('Band Themes', 'muso'); ?></a>
                <?php } else{?>
                    <?php echo __('&copy; ', 'muso') . esc_attr( get_bloginfo( 'name' ) );  ?>
                    <?php } ?>
                </div><!-- .site-info -->
            </div>
        </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
