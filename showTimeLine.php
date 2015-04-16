<?php
require_once('TwitterAPIExchange.php');
 
/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "3146903359-7KZYpuFgWUMa31XLdFmhr8RAhqz0pNUAgx5axl0",
    'oauth_access_token_secret' => "46g6dqKdt7IRAASkdP1ZieqIVGF4umDers9Qq2qu8jwNj",
    'consumer_key' => "L09KdlGCBlMsZHM3YucSwuaSw",
    'consumer_secret' => "QwYdktWHmxNr5BkvOKYdlE7O2oEYD5HOe5PwIw3q1t0lrXKwHx"
);
 
$url = "https://api.twitter.com/1.1/statuses/home_timeline.json";
 
$requestMethod = "GET";
 
 $getfield='?screen_name='.$_SESSION['username'].'&count=30';
//$getfield = '?screen_name=1205116_sm&count=30';
 
$twitter = new TwitterAPIExchange($settings);
/*
echo "<pre>";
print_r($twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest()) ;
echo "</pre>";
*/
$string = json_decode($twitter->setGetfield($getfield)
->buildOauth($url, $requestMethod)
->performRequest(),$assoc = TRUE);
if($string["errors"][0]["message"] != "") {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}
foreach($string as $items)
    {
        /*
        echo "Time and Date of Tweet: ".$items['created_at']."<br />";
        echo "Tweet: ". $items['text']."<br />";
        echo "Tweeted by: ". $items['user']['name']."<br />";
        echo "Screen name: ". $items['user']['screen_name']."<br />";
        echo "Followers: ". $items['user']['followers_count']."<br />";
        echo "Friends: ". $items['user']['friends_count']."<br />";
        echo "Listed: ". $items['user']['listed_count']."<br /><hr />";
        */

        /*

        $data = array (
            'postID' => $items['id_str'],
            'userID' => $items['user']['id_str'],
            'post'   => $items['text'],
            'postProvider' => $items['user']['name'],
            'time' => $items['created_at'],
            'numberOfFavourites' => $items['user']['favourites_count'],
            'numberOfRetweets'   => $items['user']['favourites_count']
            );

        $this->db->insert('tPOst',$data);

        
        */


        echo "post id : ".$items['id_str']."<br />";
        echo "poster ID : ".$items['user']['id_str']."<br />";
        echo "post : ".$items['text']."<br />";
        echo "post provider : ".$items['user']['name']."<br />";
        echo "post time : ".$items['created_at']."<br />";
        echo " # of retweets : ".$items['retweet_count']."<br />";
        echo " # of likes : ".$items['user']['favourites_count']."<br /><hr />";


        



    }
?>