<?php
/**
 * Muso functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Muso
 */

if ( ! function_exists( 'muso_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function muso_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Muso, use a find and replace
	 * to change 'muso' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'muso', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_editor_style();
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'muso-featured-thumbnail',  620, 480 , true );
	add_image_size( 'muso-widget-post-thumb',  90, 90 , true );
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 400,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'muso' ),
		'social'	=> esc_html__( 'Social', 'muso' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-list',
		'gallery',
		'caption',
	) );
	
	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'muso_custom_background_args', array(
		'default-color' => 'ebebeb',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'muso_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function muso_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'muso_content_width', 640 );
}
add_action( 'after_setup_theme', 'muso_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function muso_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'muso' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'muso' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer One', 'muso' ),
		'id' => 'footer-one-widget',
		'before_widget' => '<div id="footer-one" class="widget footer-widget">',
		'after_widget' => "</div>",
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Two', 'muso' ),
		'id' => 'footer-two-widget',
		'before_widget' => '<div id="footer-two" class="widget footer-widget">',
		'after_widget' => "</div>",
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Three', 'muso' ),
		'id' => 'footer-three-widget',
		'before_widget' => '<div id="footer-three" class="widget footer-widget">',
		'after_widget' => "</div>",
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'muso_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function muso_scripts() {

	wp_enqueue_style( 'muso-responsive', get_template_directory_uri() .'/assets/css/bootstrap.min.css', array(), false ,'screen' );
	wp_enqueue_style( 'flexslider', get_template_directory_uri() .'/assets/css/flexslider.css' );
	wp_enqueue_style( 'font_awesome', get_template_directory_uri() .'/assets/font-awesome/css/font-awesome.min.css' );
	wp_enqueue_style( 'prettyPhoto', get_template_directory_uri() .'/assets/css/prettyPhoto.css' );
	wp_enqueue_style('muso-googleFonts', '//fonts.googleapis.com/css?family=Lato:400,300,700,900,100|Playfair+Display:400,700,900');
	wp_enqueue_style( 'muso-ie-style', get_stylesheet_directory_uri() . "/assets/css/ie.css", array()  );
    wp_style_add_data( 'muso-ie-style', 'conditional', 'IE' );
	wp_enqueue_style( 'muso-style', get_stylesheet_uri() );
	
	wp_enqueue_script( 'muso-responsive-js', get_template_directory_uri() . '/js/responsive.js', array('jquery') );
	wp_enqueue_script( 'prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.min.js', array('jquery'));
	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array('jquery') );
	wp_enqueue_script( 'muso-custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery-masonry', 'imagesloaded') );
	wp_enqueue_script( 'muso-ie-responsive-js', get_template_directory_uri() . '/js/ie-responsive.min.js', array() );
	wp_script_add_data( 'muso-ie-responsive-js', 'conditional', 'lt IE 9' );
	wp_enqueue_script( 'muso-ie-shiv', get_template_directory_uri() . "/js/html5shiv.min.js");
	wp_script_add_data( 'muso-ie-shiv', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'muso-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'muso-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	
	$carousel_speed = 6000;
	if ( get_theme_mod( 'muso_carousel_speed_setting' ) ) {
		$carousel_speed = get_theme_mod( 'muso_carousel_speed_setting' ) ;
	}
	
	wp_localize_script( "muso-custom-js", "carousel_speed", array('vars' => $carousel_speed) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'muso_scripts' );

function muso_audio() {
	$audioembed = wp_oembed_get(get_theme_mod( 'muso_embed_setting' ));
	if (strpos($audioembed, 'playlists') !== false) {
		$height = 350;
	}
	else{
		$height = 200;
	}
	$muso_audioembed = wp_oembed_get(get_theme_mod( 'muso_embed_setting' ), array('width'=>1140, 'height'=>$height));
	$search = array('visual=true&','hide_cover=1');
	$newembed = str_replace( $search, '', $muso_audioembed );
	return $newembed;
}

function muso_catch_first_video() {
    global $post;
	
	preg_match_all('/(http|https).*(yout).*/i', $post->post_content, $matches);
    $url = isset($matches[0][0]) ? $matches[0][0]: '';
	
	preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match); 
	$id = isset($match[1]) ? $match[1]: '';
	//var_dump($id);

    return 'https://www.youtube.com/watch?v='.$id;
	
}

add_filter('wp_get_attachment_link', 'muso_add_rel_attribute');
function muso_add_rel_attribute($link) {
	global $post;
	return str_replace('<a href', '<a rel="prettyPhoto[gallery1]" href', $link);
}

function muso_breadcrumb() {
    global $post;
    echo '<ul id="breadcrumbs">';
    if (!is_home()) {
        echo '<li><a href="';
        echo home_url();
        echo '">';
        echo 'Home';
        echo '</a></li><li class="separator"> / </li>';
        if (is_category() || is_single()) {
            echo '<li>';
            the_category(' </li><li class="separator"> / </li><li> ');
            if (is_single()) {
                echo '</li><li class="separator"> / </li><li>';
                the_title();
                echo '</li>';
            }
        } elseif (is_page()) {
            if($post->post_parent){
                $fanzone_act = get_post_ancestors( $post->ID );
                $title = get_the_title();
                foreach ( $fanzone_act as $fanzone_inherit ) {
                    $output = '<li><a href="'.get_permalink($fanzone_inherit).'" title="'.get_the_title($fanzone_inherit).'">'.get_the_title($fanzone_inherit).'</a></li> <li class="separator">/</li>';
                }
                echo $output;
                echo $title;
            } else {
                echo '<li>'.get_the_title().'</li>';
            }
        }
    }
    echo '</ul>';
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/widget.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
