<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once __DIR__ . '/constants.php';
require_once __DIR__ . '/vendor/autoload.php';
?>

<form method="post" action="">
    <table>
        <tr>
            <td>URL:</td><td><input name="url" /></td>
        </tr>
        <tr>
            <td>&nbsp;</td><td><input type="submit" name="share_url" value="Share on my wall" /></td>
        </tr>    
    </table>
</form>
<?php
if (isset($_POST['share_url']) && !empty($_POST['url'])) {
    //print_r($_POST);die;
    $client = new Google_Client();
    $client->setClientId(CLIENT_ID);
    $client->setClientSecret(SECRET);
    $client->getCache()->clear();
    $client->setAccessToken($_SESSION['access_token']);
    $plus = new Google_Service_Plus($client);
    $plusdomains = new Google_Service_PlusDomains($client);
    $activityAccess = new Google_Service_PlusDomains_Acl();
    $activityAccess->setDomainRestricted(true);
    $activityObject = new Google_Service_PlusDomains_ActivityObject();
    /*
     * If you only want to share the plain text
     */
//  $activityObject->setOriginalContent('I have just shared my facebook profile page');

    $activityObject->setAttachments([
        ['url' => $_POST['url'], 'objectType' => 'article']
    ]);
    $resource = new Google_Service_PlusDomains_PlusDomainsAclentryResource();
    $resource->setType("public");
    $resources = array();
    $resources[] = $resource;
    $activityAccess->setItems($resources);
    $activity = new Google_Service_PlusDomains_Activity();
    $activity->setObject($activityObject);
    $activity->setAccess($activityAccess);
    $res = $plusdomains->activities->insert("me", $activity);
    echo "<pre>";
    print_r($res);
}else{
    echo "Warning:Nothing to share";
}






