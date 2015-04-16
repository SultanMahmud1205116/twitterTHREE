<?php
require("twitter/twitteroauth.php");
require 'config/twconfig.php';
session_start();

$twitteroauth = new TwitterOAuth('L09KdlGCBlMsZHM3YucSwuaSw', 'QwYdktWHmxNr5BkvOKYdlE7O2oEYD5HOe5PwIw3q1t0lrXKwHx');
// Requesting authentication tokens, the parameter is the URL we will be redirected to

$request_token = $twitteroauth->getRequestToken('https://infinite-escarpment-2472.herokuapp.com/getTwitterData.php');

// Saving them into the session

$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
//echo $twitteroauth->http_code."    " ;

// If everything goes well..
if ($twitteroauth->http_code == 200) {
    // Let's generate the URL and redirect
    $url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
    header('Location: ' . $url);
} else {
    // It's a bad idea to kill the script, but we've got to know when there's an error.
    die('Something wrong happened.');
}
?>
