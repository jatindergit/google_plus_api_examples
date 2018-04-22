<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once __DIR__ . '/constants.php';
require_once __DIR__ . '/vendor/autoload.php';
//assuming a successful authentication code is return
$client = new Google_Client();
$client->setClientId(CLIENT_ID);
$client->setClientSecret(SECRET);
//.... configure $client object code goes here

$client->setAccessToken(ACCESS_TOKEN);

//get user email address
$google_oauth = new Google_Service_Oauth2($client);
echo "<pre>";
print_r($google_oauth->userinfo->get());
echo $google_account_email = $google_oauth->userinfo->get()->email;
//$google_oauth->userinfo->get()->familyName;
 //$google_oauth->userinfo->get()->givenName;
 //$google_oauth->userinfo->get()->name;
 //$google_oauth->userinfo->get()->gender;
 //$google_oauth->userinfo->get()->picture; //profile picture
