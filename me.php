<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once __DIR__ . '/constants.php';
require_once __DIR__ . '/vendor/autoload.php';
//assuming a successful authentication code is return
$client = new Google_Client();
$client->setClientId(CLIENT_ID);
$client->setClientSecret(SECRET);
//.... configure $client object code goes here

$client->setAccessToken($_SESSION['access_token']);

//get user email address
$google_oauth = new Google_Service_Oauth2($client);
//echo "<pre>";
//print_r($google_oauth->userinfo->get());
//echo $google_account_email = $google_oauth->userinfo->get()->email;
//$google_oauth->userinfo->get()->familyName;
 //$google_oauth->userinfo->get()->givenName;
 //$google_oauth->userinfo->get()->name;
 //$google_oauth->userinfo->get()->gender;
 ?>
<table>
    <tr>
        <td>ID</td><td><?= $google_oauth->userinfo->get()->id ?></td>
    </tr>
    <tr>
        <td>Name</td><td><?= $google_oauth->userinfo->get()->name ?></td>
    </tr>
    <tr>
        <td>Picture</td><td><img width="80" src="<?= $google_oauth->userinfo->get()->picture;?>" /></td>
    </tr>
     <tr>
        <td>Gender</td><td><?= $google_oauth->userinfo->get()->gender ?></td>
    </tr>
    <tr>
        <td>Profile Url</td><td><a href="<?= $google_oauth->userinfo->get()->link;?>" ><?= $google_oauth->userinfo->get()->link;?></a></td>
    </tr>
    
</table>
