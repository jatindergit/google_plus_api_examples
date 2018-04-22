<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once __DIR__ . '/constants.php';
require_once __DIR__ . '/vendor/autoload.php';
//assuming a successful authentication code is return
$client = new Google_Client();

$client->setClientId(CLIENT_ID);
$client->setClientSecret(SECRET);
$client->getCache()->clear();
$client->setAccessToken(ACCESS_TOKEN);

$plus = new Google_Service_Plus($client);
$plusdomains = new Google_Service_PlusDomains($client);

$activityAccess = new Google_Service_PlusDomains_Acl();
$activityAccess->setDomainRestricted(true);

$activityObject = new Google_Service_PlusDomains_ActivityObject();
$activityObject->setOriginalContent('This is my title');

/*$activityObject->setAttachments([
    ['url' => 'https://www.facebook.com/engineer.jazz', 'objectType' => 'article']
]);*/
//$activityObject->setObjectType('article');
//$activityObject->setUrl('https://www.facebook.com/engineer.jazz');

$resource = new Google_Service_PlusDomains_PlusDomainsAclentryResource();
$resource->setType("public");
$resources = array();
$resources[] = $resource;
$activityAccess->setItems($resources);
$activity = new Google_Service_PlusDomains_Activity();
$activity->setObject($activityObject);
$activity->setAccess($activityAccess);
$res = $plusdomains->activities->insert("me", $activity);
print_r($res);
