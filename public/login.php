<?php

require '../vendor/autoload.php'; // for auto-loading classes/namespaces
$dotenv = Dotenv\Dotenv::createImmutable('../'); // create dotenv instance at root dir
$dotenv->load(); // load dotenv variables in .dotenv at root dir
session_start();

use Sammy\FbGroupAggregator\Middleware\FacebookAuthMiddleware;

$fbInstance = new FacebookAuthMiddleware(); // defaults
$fb = $fbInstance->getFacebook();

// get an access token by requesting login:
$helper = $fb->getRedirectLoginHelper();
$loginUrl = $helper->getLoginUrl('http://localhost:1111/callback.php', []);
echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';

?>