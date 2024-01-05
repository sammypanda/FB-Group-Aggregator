<?php

namespace Sammy\FbGroupAggregator\Model;

use Sammy\FbGroupAggregator\Middleware\FacebookAuthMiddleware;

class GroupModel {
    public static function getGroupName() {
        return "groupName";
    }

    public function getCurrentUser() {
        $fbMiddleware = new FacebookAuthMiddleware(); // use defaults
        $fb = $fbMiddleware->getFacebook();

        try {
            // If you provided a 'default_access_token', the '{access-token}' is optional.
            $response = $fb->get('/me', $accessToken);
        } catch(\JanuSoftware\Facebook\Exception\ResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(\JanuSoftware\Facebook\Exception\SDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
    }
}

?>