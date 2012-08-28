<?php
$consumerKey    = 'woBHba4y1vR7lJ6qr5ucg';
$consumerSecret = 'XKTjb36Iz3D27YRWA5oXtprcyaLyyVkswgH25OhUxY';
$oAuthToken     = '786684985-bnT6fi5BrL4xUFC5NcwdELsk4LG0IGQkrEAHw433'; 
$oAuthSecret    = 'z7YDC8OKPISj3h1X257pVm8Upt2gPlohG49kqtGw';
require_once('twitteroauth.php');
// twitteroauth.php points to OAuth.php
// all files are in the same dir
// create a new instance
$tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);
 ?>

