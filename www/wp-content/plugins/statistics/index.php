<?php
/*
Plugin Name: StatsPlugin
*/
function stats_shortcodes_init()
{
    function stats_shortcode($atts = [], $content = null)
    {
        global $wpdb, $table_prefix;
        $stOne = "SELECT COUNT(*) FROM ".$table_prefix."track";
        $stTwo = "SELECT COUNT(*) FROM ".$table_prefix."album";
        $stThree = "SELECT COUNT(*) FROM ".$table_prefix."artist";
        $stFour = "SELECT COUNT(*) FROM ".$table_prefix."custfav";

        $resOne = $wpdb->get_var($stOne);
        $resTwo = $wpdb->get_var($stTwo);
        $resThree = $wpdb->get_var($stThree);
        $resFour = $wpdb->get_var($stFour);

        $total = ($resOne + $resTwo + $resThree + $resFour)*0.01;

        $arr = [wp_count_posts()->publish, count_users()['total_users'], wp_count_comments()->total_comments];
        $favData = [$resOne/$total,$resTwo/$total,$resThree/$total,$resFour/$total];
        $content .= "<script>var graphatts = " .
        json_encode($arr) .
        "; var favdata = ".json_encode($favData).";</script>";
        $content .= file_get_contents(dirname(__FILE__) . "/index.html");
        return $content;
    }
    add_shortcode('stats-plugin', 'stats_shortcode');

    wp_register_style('stats_stylesheet', 
    plugins_url('stats.css', __FILE__));
    wp_enqueue_style('stats_stylesheet');

    
   
}
add_action('init', 'stats_shortcodes_init');
