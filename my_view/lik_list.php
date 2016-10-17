<?php
session_start();
require_once __DIR__ . '/../Facebook/autoload.php';
$fb = new Facebook\Facebook([
    'app_id' => '192649580875833',
    'app_secret' => '5d5bcc3b413bdd03e9aed34a2d46c830',
    'default_graph_version' => 'v2.0',
        ]);
$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
try {
    $requestLikes = $fb->get('/me/likes?limit=210');
    $likes = $requestLikes->getGraphEdge();
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
$number = 0;
foreach ($likes as $value) {
    echo '<ul>';
    echo '<li>'.$number.'</li>';
    echo '<li>'.$value['name']. '</li>';
    echo '<li>'.$value['category']. '</li>';
    
    echo '</ul>';
//    echo '<pre>';
//    print_r($value['name']);
//    echo '</pre>';
    $number ++;
}

?>
