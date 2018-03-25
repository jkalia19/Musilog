<?php
/*
Plugin Name: Form
*/
function form_shortcodes_init()
{
    function form_shortcode($atts = [], $content = null)
    {
        $content .= file_get_contents(dirname(__FILE__) . "/index.html");
        return $content;
    }
    add_shortcode('form-plugin', 'form_shortcode');

    wp_register_style('form_stylesheet', 
    plugins_url('form.css', __FILE__));
    wp_enqueue_style('form_stylesheet');

    wp_register_script('controller_script', 
    plugins_url('form.js', __FILE__), 
    true);
    wp_enqueue_script('controller_script');
}
add_action('init', 'form_shortcodes_init');
