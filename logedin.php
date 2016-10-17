<?php
session_start();
require_once __DIR__ . '/Facebook/autoload.php';
$fb = new Facebook\Facebook([
    'app_id' => '192649580875833',
    'app_secret' => '5d5bcc3b413bdd03e9aed34a2d46c830',
    'default_graph_version' => 'v2.0',
        ]);
$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
try {
        $posts = $fb->get('/10203531187720833/feed'); // page username or group id or user id
	$posts = $posts->getGraphEdge()->asArray(); // got posts along ids
	$post =  $posts[0]['10203531187720833']; // getting specific post id
	$like = $fb->post('/' . $posts[0]['10203531187720833'] . '/likes'); // liking that post on facebook
	
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
print_r($like->getGraphNode()->asArray());
//    foreach ($posts as $key => $value) {
//       
////        echo $value['message'].'</br>';
//    echo '<pre>';
//    print_r($value);
//    echo '</pre>'; 
//}
//    

?>
