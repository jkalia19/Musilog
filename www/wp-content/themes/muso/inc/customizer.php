<?php
/**
 * Muso Theme Customizer.
 *
 * @package Muso
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function muso_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'muso_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function muso_customize_preview_js() {
	wp_enqueue_script( 'muso_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'muso_customize_preview_js' );

if (!function_exists( 'muso_theme_customizer' ) ) :
	function muso_theme_customizer( $wp_customize ) {
		
		$wp_customize->add_panel( 'muso_home_featured', array(
			'priority'       => 10,
			'capability'     => 'edit_theme_options',
			'title'          => __('Home Page Features', 'muso'),
			'description'    => __('Features that will show on the home page', 'muso'),
		) );
		
		//Hero Image
		$wp_customize->add_section( 'muso_slider_section' , array(
			'title'       => __( 'Home page Header Image', 'muso' ),
			'priority'    => 20,
			'description' => __( 'Header Image Option', 'muso' ),
			'panel'  => 'muso_home_featured',
		) );
	
		$wp_customize->add_setting('muso_display_slider_setting', array(
			'default'        => 1,
			'sanitize_callback' => 'muso_sanitize_checkbox',
		));
	
		$wp_customize->add_control('muso_display_slider_control', array(
			'settings' => 'muso_display_slider_setting',
			'label'    => __('Display Header Image', 'muso'),
			'section'  => 'muso_slider_section',
			'type'     => 'checkbox',
			'priority'	=> 23
		));
		
		//Sound Cloud Option	
		$wp_customize->add_section( 'muso_audio_section' , array(
			'title'       => __( 'Music Player', 'muso' ),
			'priority'    => 20,
			'description' => __( 'Music Player Option', 'muso' ),
			'panel'  => 'muso_home_featured',
		) );
		
		$wp_customize->add_setting( 'muso_embed_setting', array (
			'default' => __('Enter Album or Music link','muso'),
			'sanitize_callback' => 'muso_sanitize_textarea'
				
		));
		
		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'muso_embed_setting', array(
		   'label'      => __( 'Enter Album or Music link', 'muso' ),
		   'section'    => 'muso_audio_section',
		   'settings'   => 'muso_embed_setting',
		   'type'   	=> 	'textarea',
		   'priority'    => 24
		   )
		));
		
		//embed Album Control
		$wp_customize->add_setting('muso_display_album_setting', array(
			'default'        => 0,
			'sanitize_callback' => 'muso_sanitize_checkbox',
		));
	
		$wp_customize->add_control('muso_display_album_control', array(
			'settings' => 'muso_display_album_setting',
			'label'    => __('Display Music Album', 'muso'),
			'section'  => 'muso_audio_section',
			'type'     => 'checkbox',
			'priority'	=> 10
		));
		
		//Carousel
		$wp_customize->add_section( 'muso_carousel_section' , array(
			'title'       => __( 'Carousel', 'muso' ),
			'priority'    => 20,
			'description' => __( 'Carousel Option', 'muso' ),
			'panel'  => 'muso_home_featured',
		) );
		
		$wp_customize->add_setting('muso_display_carousel_setting', array(
			'default'        => 0,
			'sanitize_callback' => 'muso_sanitize_checkbox',
		));
	
		$wp_customize->add_control('muso_display_carousel_control', array(
			'settings' => 'muso_display_carousel_setting',
			'label'    => __('Display Carousel', 'muso'),
			'section'  => 'muso_carousel_section',
			'type'     => 'checkbox',
			'priority'	=> 24
		));
	
				
		$categories = get_categories();
				$cats = array();
				$i = 0;
				foreach($categories as $category){
					if($i==0){
						$default = $category->slug;
						$i++;
					}
					$cats[$category->slug] = $category->name;
				}
		
		//  =============================
		//  Select Box               
		//  =============================
		$wp_customize->add_setting('muso_carousel_category_setting', array(
			'default' => '',
			'sanitize_callback' => 'muso_sanitize_category',
		));
	
	
		$wp_customize->add_control('muso_carousel_category_control', array(
			'settings' => 'muso_carousel_category_setting',
			'type' => 'select',
			'label' => __('Select Category:', 'muso'),
			'section' => 'muso_carousel_section',
			'choices' => $cats,
			'priority'	=> 24
		));
			
		//  Set Speed
		$wp_customize->add_setting( 'muso_carousel_speed_setting', array (
			'default' => '6000',
			'sanitize_callback' => 'muso_sanitize_integer',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'muso_carousel_speed', array(
			'label'    => __( 'Slider Speed (milliseconds)', 'muso' ),
			'section'  => 'muso_carousel_section',
			'settings' => 'muso_carousel_speed_setting',
			'priority'	=> 24
		) ) );	
		
		//Post section Label
		$wp_customize->add_section( 'muso_post_section' , array(
			'title'       => __( 'Post Label', 'muso' ),
			'priority'    => 20,
			'description' => __( 'Post Label Option', 'muso' ),
			'panel'  => 'muso_home_featured',
		) );
		
		$wp_customize->add_setting( 'muso_post_label', array (
			'default' => __('Latest post', 'muso'),
			'sanitize_callback' => 'muso_sanitize_text_field'
		));
		
		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'muso_post_label', array(
		   'label'      => __( 'Enter Desired Label', 'muso' ),
		   'section'    => 'muso_post_section',
		   'settings'   => 'muso_post_label',
		   'priority'    => 83
		   )
		));
		
		/* color option */
		$wp_customize->add_setting( 'muso_primary_color_setting', array (
			'default'     => '#db0600',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'muso_primary_color', array(
			'label'    => __( 'Theme Primary Color', 'muso' ),
			'section'  => 'colors',
			'settings' => 'muso_primary_color_setting',
		) ) );
	
	}
endif;
add_action('customize_register', 'muso_theme_customizer');

function muso_sanitize_textarea( $text ) {
	return esc_textarea( $text );
}

/**
 * Sanitize integer input
 */
if ( ! function_exists( 'muso_sanitize_integer' ) ) :
	function muso_sanitize_integer( $input ) {		
		return absint($input);
	}
endif;

/**
 * Sanitize checkbox
 */

if (!function_exists( 'muso_sanitize_checkbox' ) ) :
	function muso_sanitize_checkbox( $input ) {
		if ( $input != 1 ) {
			return 0;
		} else {
			return 1;
		}
	}
endif;

function muso_sanitize_text_field( $str ) {

	return sanitize_text_field( $str );

}

if ( ! function_exists( 'muso_sanitize_category' ) ){
	function muso_sanitize_category( $input ) {
		$categories = get_categories();
		$cats = array();
		$i = 0;
		foreach($categories as $category){
			if($i==0){
				$default = $category->slug;
				$i++;
			}
			$cats[$category->slug] = $category->name;
		}
		$valid = $cats;

		if ( array_key_exists( $input, $valid ) ) {
			return $input;
		} else {
			return '';

		}
	}
}

if ( ! function_exists( 'muso_apply_color' ) ) :
  function muso_apply_color() {
	?>
	<style id="color-settings">
	<?php if (get_theme_mod('muso_primary_color_setting') ) { ?>
		.read_more, button, input[type="button"], input[type="reset"], input[type="submit"], .tagcloud a:hover, #footer-widget .tagcloud a, #menu-social li a:hover, .nav-links .fa, .comment-reply-link {background:<?php echo esc_html(get_theme_mod('muso_primary_color_setting')); ?>}
		.post-details {border-bottom: 3px solid <?php echo esc_html(get_theme_mod('muso_primary_color_setting')); ?>}
		.gallery-item a img:hover {border: 5px solid <?php echo esc_html(get_theme_mod('muso_primary_color_setting')); ?>}
		a, .page-numbers.current, .widget-area ul li a:hover, #footer-widget a:hover, .nav-links a:hover {color:<?php echo esc_html(get_theme_mod('muso_primary_color_setting')); ?>}
	<?php } ?>
	
	</style>
	<?php	  
  }
endif;
add_action( 'wp_head', 'muso_apply_color' );