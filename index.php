<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once __DIR__ . '/constants.php';
require_once __DIR__ . '/vendor/autoload.php';
$client = new Google_Client();
// Set to name/location of your client_secrets.json file.
$client->setAuthConfigFile(JSON_FILE);
// Set to valid redirect URI for your project.
$client->setRedirectUri(AUTH_REDIRECT_URI);

$client->addScope(Google_Service_Plus::PLUS_ME);
$client->addScope(Google_Service_PlusDomains::PLUS_STREAM_WRITE);
//$client->addScope('https://www.googleapis.com/auth/plus.stream.write');
$client->setAccessType('offline');
$authUrl = $client->createAuthUrl();
?>
<a href="<?php echo $authUrl; ?>">Connect with Google</a>
