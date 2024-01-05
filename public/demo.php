<?php 

require '../vendor/autoload.php'; // for auto-loading classes/namespaces
session_start();
echo $_SESSION['facebook_access_token'];

use Sammy\FbGroupAggregator\Controller\GroupController;
use Sammy\FbGroupAggregator\Middleware\FacebookAuthMiddleware;
use JanuSoftware\Facebook\Facebook;

$fbInstance = new FacebookAuthMiddleware(); // defaults
$fb = $fbInstance->getFacebook();
$access_token = $_SESSION['facebook_access_token'];

$groupController = new GroupController();
echo $groupController->getGroupName() . "<br>";

try {
    // If you provided a 'default_access_token', the '{access-token}' is optional.
    $response = $fb->get('/me', $access_token);
} catch(\JanuSoftware\Facebook\Exception\ResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(\JanuSoftware\Facebook\Exception\SDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

$me = $response->getGraphNode();
echo "<br>Logged in as " . $me->getField('name');


?>