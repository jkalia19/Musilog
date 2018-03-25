<?php
require_once 'Slim/Slim.php';
require_once 'SlimWpOptions.php';
include('httpful.phar');
\Slim\Slim::registerAutoloader();
new \Slim\SlimWpOptions();

add_filter('rewrite_rules_array', function ($rules) {
    $new_rules = array(
        '('.get_option('slim_base_path','slim/api/').')' => 'index.php',
    );
    $rules = $new_rules + $rules;
    return $rules;
});

add_action('init', function () {
    if (strstr($_SERVER['REQUEST_URI'], get_option('slim_base_path','slim/api/'))) {
        $slim = new \Slim\Slim();
        do_action('slim_mapping',$slim);
        
         $slim->get('/slim/api/track/:track',function($track){
            $lastfm_url = 'http://ws.audioscrobbler.com/2.0/?api_key=xyz';
            $response = \Httpful\Request::get($lastfm_url.'&track='.trim($track))->send();
            echo json_encode($response->body->results->trackmatches->track);               
        });

        $slim->get('/slim/api/artist/:artist',function($artist){
            $lastfm_url = 'http://ws.audioscrobbler.com/2.0/?api_key=xyz';
            $response = \Httpful\Request::get($lastfm_url.'&artist='.trim($artist))->send();
            echo json_encode($response->body->results->artistmatches->artist);               
        });

        $slim->get('/slim/api/album/:album',function($album){
            $lastfm_url = 'http://ws.audioscrobbler.com/2.0/?api_key=xyz';
            $response = \Httpful\Request::get($lastfm_url.'&album='.trim($album))->send();
            echo json_encode($response->body->results->albummatches->album);               
        });

        $slim->post('/slim/api/fav', function(){
            global $wpdb, $table_prefix;
            $postdata = file_get_contents("php://input");
            $data = json_decode($postdata);

            if(trim($data->type) == 'track'){

                $checkSql = "SELECT COUNT(*) FROM ".$table_prefix."track WHERE name=%s AND artist=%s AND image=%s";
                $preparedCheckSql = $wpdb->prepare($checkSql,[trim($data->name),trim($data->artist),trim($data->image)]);
                $count = $wpdb->get_var($preparedCheckSql);

                if($count>0){
                    echo "exist";
                }
                else{
                    $insertSql = "INSERT INTO ".$table_prefix."track(name,artist,image) VALUES(%s, %s, %s)";
                    $preparedInsertSql = $wpdb->prepare($insertSql,[trim($data->name),trim($data->artist),trim($data->image)]);
                    $wpdb->query($preparedInsertSql);
                    echo "saved";
                }
            }
            else if(trim($data->type == 'artist')){

                $checkSql = "SELECT COUNT(*) FROM ".$table_prefix."artist WHERE name=%s AND image=%s";
                $preparedCheckSql = $wpdb->prepare($checkSql,[trim($data->name),trim($data->image)]);
                $count = $wpdb->get_var($preparedCheckSql);

                if($count>0){
                    echo "exist";
                }
                else{
                    $insertSql = "INSERT INTO ".$table_prefix."artist(name,image) VALUES(%s, %s)";
                    $preparedInsertSql = $wpdb->prepare($insertSql,[trim($data->name),trim($data->image)]);
                    $wpdb->query($preparedInsertSql);
                    echo "saved";
                }
            }
            else if(trim($data->type == 'album')){

                $checkSql = "SELECT COUNT(*) FROM ".$table_prefix."album WHERE name=%s AND artist=%s AND image=%s";
                $preparedCheckSql = $wpdb->prepare($checkSql,[trim($data->name),trim($data->artist),trim($data->image)]);
                $count = $wpdb->get_var($preparedCheckSql);

                if($count>0){
                    echo "exist";
                }
                else{
                    $insertSql = "INSERT INTO ".$table_prefix."album(name,artist,image) VALUES(%s, %s, %s)";
                    $preparedInsertSql = $wpdb->prepare($insertSql,[trim($data->name),trim($data->artist),trim($data->image)]);
                    $wpdb->query($preparedInsertSql);
                    echo "saved";
                }
            }
            else if(trim($data->type == 'custom')){

                $checkSql = "SELECT COUNT(*) FROM ".$table_prefix."custfav WHERE name=%s AND description=%s";
                $preparedCheckSql = $wpdb->prepare($checkSql,[trim($data->name),trim($data->description)]);
                $count = $wpdb->get_var($preparedCheckSql);

                if($count>0){
                    echo "exist";
                }
                else{
                    $insertSql = "INSERT INTO ".$table_prefix."custfav(name,description) VALUES(%s, %s)";
                    $preparedInsertSql = $wpdb->prepare($insertSql,[trim($data->name),trim($data->description)]);
                    $wpdb->query($preparedInsertSql);
                    echo "saved";
                }
            }
            else{
                echo "bad";
            }
        });

       
        $slim->run();
        exit;
    }
});