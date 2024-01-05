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
    $group = $fb->get('/674918458180338', $access_token);
    $group_feed = $fb->get('/674918458180338/feed', $access_token);
} catch(\JanuSoftware\Facebook\Exception\ResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(\JanuSoftware\Facebook\Exception\SDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

$group = $group->getGraphNode();
$group_feed = $group_feed->getGraphEdge();

echo "<b><br>Test group name: <u>" . $group->getField('name');
echo "</u></b><br>" . $group;

echo "<br>";

echo "<b><br>Test group post (array index 0): <u>" . $group_feed[0]->getField('message');
echo "</u><br>Total posts found: " . $group_feed->getTotalCount();
echo "</b><br>" . $group_feed;


?>