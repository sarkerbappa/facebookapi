<?php
session_start();
require_once __DIR__ . '/Facebook/autoload.php';
// Initialize the Facebook PHP SDK v5.
$fb = new Facebook\Facebook([
  'app_id' => '192649580875833',
  'app_secret' => '5d5bcc3b413bdd03e9aed34a2d46c830',
  'default_graph_version' => 'v2.0',
  ]);

$helper = $fb->getRedirectLoginHelper();
try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (isset($accessToken)) {
  // Logged in!
  $_SESSION['facebook_access_token'] = (string) $accessToken;
  header( 'Location: http://localhost/facebookapi/logedin.php' );
  // Now you can redirect to another page and use the
  // access token from $_SESSION['facebook_access_token']
}

