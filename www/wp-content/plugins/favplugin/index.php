<?php
/*
Plugin Name: FavPlugin
*/
function fav_shortcodes_init()
{
    function fav_shortcode($atts = [], $content = null)
    {
        global $wpdb, $table_prefix;
        $obj = new ArrayObject();
        $arr = ['track','artist','album','custfav'];
        foreach($arr as $val){
            $sSql = "SELECT * FROM ".$table_prefix.$val;
            $stmt = $wpdb->prepare($sSql,null);
            $results = $wpdb->get_results($stmt);
            $obj->append($results);
        }
        $content .= "<script>var atts = " .
        json_encode($obj) .
        "</script>";
        $content .= file_get_contents(dirname(__FILE__) . "/index.html");
        return $content;
    }
    add_shortcode('fav-plugin', 'fav_shortcode');

    wp_register_style('fav_stylesheet', 
    plugins_url('fav.css', __FILE__));
    wp_enqueue_style('fav_stylesheet');

    
   
}
add_action('init', 'fav_shortcodes_init');
