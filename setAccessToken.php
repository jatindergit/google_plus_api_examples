<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once __DIR__ . '/constants.php';
require_once __DIR__ . '/vendor/autoload.php';

if (isset($_GET['code'])) {

    $authCode = $_GET['code'];

    $client = new Google_Client();
    $client->addScope(Google_Service_Plus::PLUS_ME);
    $client->setRedirectUri(AUTH_REDIRECT_URI);

    $client->setClientId(CLIENT_ID);
    $client->setClientSecret(SECRET);


    // Exchange authorization code for an access token.
    $accessToken = $client->authenticate($authCode);
    if (isset($accessToken['access_token'])) {
        $_SESSION = $accessToken;
    }
    print_r($accessToken);

    $client->setAccessToken($accessToken);

    // Refresh the token if it's expired.
    if ($client->isAccessTokenExpired()) {
        $client->refreshToken($client->getRefreshToken());
    }
// returns a Guzzle HTTP Client
    $httpClient = $client->authorize();
    // make an HTTP request
    $response = $httpClient->get('https://www.googleapis.com/plus/v1/people/me');

    //get user email address
    $google_oauth = new Google_Service_Oauth2($client);
echo    $google_account_email = $google_oauth->userinfo->get()->email;
    //$google_oauth->userinfo->get()->familyName;
    //$google_oauth->userinfo->get()->givenName;
    //$google_oauth->userinfo->get()->name;
    //$google_oauth->userinfo->get()->gender;
    //$google_oauth->userinfo->get()->picture; //profile picture
}
echo "<pre>";
print_r($_SESSION);
?>
<a href="index.php?action=connect">Connect with Google</a>

<a href="me.php">My Profile</a>
<br>
<a href="shareActivity.php">Share Activity</a>
