<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Muso
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'muso' ); ?></a>
	<?php if(is_home() || is_front_page()){ ?>
    	<?php
			$slider_display = get_theme_mod( 'muso_display_slider_setting', 1);
		?>
        <?php if ( $slider_display == 1) : ?>
                <div class="hero-image">
                   <?php the_custom_header_markup();?>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="slide-site-details">
                                  <?php
                                    if ( has_custom_logo() ) {
                                            the_custom_logo();
                                        }
                                    ?>
                                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                    <p class="site-description"><?php bloginfo( 'description' ); ?></p>
                                </div> 
                            </div>   
                        </div> 
                        <a id="jump_next" href="#masthead"><span class="glyphicon glyphicon-chevron-down"></span></a> 
                    </div>
                </div>
        <?php endif; ?>
    <?php } ?>	
	<header id="masthead" class="site-header" role="banner">
    	<div class="container">
        	<div class="row">
            	<div class="col-md-12">
                    <div class="site-branding">
                        <?php 
							if ( has_custom_logo() ) {
								the_custom_logo();
							}
						?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<p class="site-description"><?php bloginfo( 'description' ); ?></p>
                    </div><!-- .site-branding -->
                    <div class="site-main-nav toogle-navigation">
                    	<i class="fa fa-bars" aria-hidden="true"></i>
                    </div>
            		
                    <nav id="site-navigation" class="main-navigation hide-bar" role="navigation">
                    	<i class="fa fa-times close-bar"></i>
                        <?php get_search_form(); ?>
                        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
                    </nav><!-- #site-navigation -->
        		</div>
       		</div>
        </div>
	</header><!-- #masthead -->
    <?php if(is_home() || is_front_page()){ ?>
		<?php $displayayer = get_theme_mod( 'muso_display_album_setting', 0 );
        if ( $displayayer == 1 ) { ?>
            <div class="player-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo muso_audio(); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    
		<?php get_template_part( 'template-parts/carousel' ) ;
		?>
    <?php } ?>	
	<div id="content" class="site-content">
