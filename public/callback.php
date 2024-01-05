<?php

require '../vendor/autoload.php'; // for auto-loading classes/namespaces
$dotenv = Dotenv\Dotenv::createImmutable('../'); // create dotenv instance at root dir
$dotenv->load(); // load dotenv variables in .dotenv at root dir
session_start();

use Sammy\FbGroupAggregator\Middleware\FacebookAuthMiddleware;

$fbInstance = new FacebookAuthMiddleware(); // defaults
$fb = $fbInstance->getFacebook(); 

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(JanuSoftware\Facebook\Exception\SDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (isset($accessToken)) {
  // Logged in!
  $_SESSION['facebook_access_token'] = (string) $accessToken;
  session_write_close();

  header("Location: demo.php");
  // Now you can redirect to another page and use the
  // access token from $_SESSION['facebook_access_token']
} elseif ($helper->getError()) {
  // The user denied the request
  header("Location: login.php");
  exit;
}

?>