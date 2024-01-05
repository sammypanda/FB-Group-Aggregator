<?php

namespace Sammy\FbGroupAggregator\Middleware;

require_once 'common.php';

use JanuSoftware\Facebook\Facebook;

class FacebookAuthMiddleware {
    
    private $fb = null;
    private $access_token = null;

    // Easily construct and build Facebook Graph SDK on the run
    public function __construct(String $app_id = null, String $app_secret = null, String $graph_version = null) {
        $app_id = $app_id ?? $_ENV['APP_ID'] ?? null;
        $app_secret = $app_secret ?? $_ENV['APP_SECRET'] ?? null;
        $graph_version = $graph_version ?? $_ENV['GRAPH_VERSION'] ?? 'v15.0';
        // $access_token = isset($_SESSION['facebook_access_token']) ?? $_SESSION['facebook_access_token'] ?? "hi";

        $this->fb = new Facebook([
            'app_id' => $app_id,
            'app_secret' => $app_secret,
            'default_graph_version' => $graph_version,
            // 'default_access_token' => $access_token,
        ]);
    }

    // set by the constructor
    public function getFacebook() {
        return $this->fb;
    }

    public function setAccessToken(String $access_token) {
        $this->access_token = $access_token;
    }

    public function getAccessToken() {
        if (!$this->access_token) {
            echo "??? why asking the middleware to get you a token when it doesn't have it available ???";
            // // get an access token by requesting login:
            // $helper = $fb->getRedirectLoginHelper();

            // $permissions = []; // Optional permissions
            // $loginUrl = $helper->getLoginUrl('http://localhost:1111/demo.php', $permissions);

            // echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';

            // try {
            //     $accessToken = $helper->getAccessToken();
            // } catch(Facebook\Exceptions\FacebookResponseException $err) {
            //     echo 'Graph failure: ' . $err->getMessage();
            //     exit;
            // } catch(Facebook\Exceptions\FacebookSDKException $err) {
            //     echo 'Facebook SDK failure: ' . $err->getMessage();
            //     exit;
            // }
        } else {
            return $this->access_token;
        }
    }
}