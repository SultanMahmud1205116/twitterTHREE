<?php
require("twitter/twitteroauth.php");
require 'config/twconfig.php';
session_start();

$twitteroauth = new TwitterOAuth("w5TqlKvu2baoRKxZm6xPgUZfs", "Mc1klDqUy380T41HiE3famsxprnul73Eo2k99GtBtmsttbyCVi");
// Requesting authentication tokens, the parameter is the URL we will be redirected to

// editing this url is left to be done for the last, do not forget
$request_token = $twitteroauth->getRequestToken('http://onlinewebapplication.com/Facebook2/getTwitterData.php');

// Saving them into the session

$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

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
