<?php
/*
Plugin Name: LastFM
*/
function lastfm_shortcodes_init()
{
    function lastfm_shortcode($atts = [], $content = null)
    {
        $content .= "<script>var atts = " .
        json_encode($atts) .
        "</script>";
        $content .= file_get_contents(dirname(__FILE__) . "/index.html");
        return $content;
    }
    add_shortcode('lastfm-plugin', 'lastfm_shortcode');

    wp_register_style('lastfm_stylesheet', 
    plugins_url('lastfm.css', __FILE__));
    wp_enqueue_style('lastfm_stylesheet');

    wp_register_style('bootstrap_stylesheet', 
    plugins_url('bootstrap.min.css', __FILE__));
    wp_enqueue_style('bootstrap_stylesheet');
    
    wp_register_script('speech_script', 
    "https://cdnjs.cloudflare.com/ajax/libs/annyang/2.6.0/annyang.min.js", 
    true);
    
    wp_enqueue_script('speech_script');

    wp_register_script('angular_script', 
    "https://ajax.googleapis.com/ajax/libs/angularjs/1.6.6/angular.min.js", 
    true);
    
    wp_enqueue_script('angular_script');

    wp_register_script('ui_script', 
    "https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js", 
    true);
    
    wp_enqueue_script('ui_script');
    wp_register_script('mycontroller_script', 
    plugins_url('main.js', __FILE__), 
    true);

    wp_enqueue_script('mycontroller_script');
   
}
add_action('init', 'lastfm_shortcodes_init');
include_once('backend.php');

register_activation_hook( __FILE__, function(){
    global $wpdb, $table_prefix;
    $sTrack = "CREATE TABLE IF NOT EXISTS " . 
    $table_prefix . "track ('id' INTEGER PRIMARY KEY AUTOINCREMENT, 'name' TEXT, 'artist' TEXT, 'image' TEXT)";
    $wpdb->query($sTrack);
    $sArtist = "CREATE TABLE IF NOT EXISTS " . 
    $table_prefix . "artist ('id' INTEGER PRIMARY KEY AUTOINCREMENT, 'name' TEXT, 'image' TEXT)";
    $wpdb->query($sArtist);
    $sAlbum = "CREATE TABLE IF NOT EXISTS " . 
    $table_prefix . "album ('id' INTEGER PRIMARY KEY AUTOINCREMENT, 'name' TEXT, 'artist' TEXT, 'image' TEXT)";
    $wpdb->query($sAlbum);
    $sCustom = "CREATE TABLE IF NOT EXISTS " . 
    $table_prefix . "custfav ('id' INTEGER PRIMARY KEY AUTOINCREMENT, 'name' TEXT, 'description' TEXT, 'image' TEXT DEFAULT 'http://lorempixel.com/200/200/abstract')";
    $wpdb->query($sCustom);
} );