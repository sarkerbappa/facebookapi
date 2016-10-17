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
    $requestPicture = $fb->get('/me/picture?redirect=false&height=300');
    $picture = $requestPicture->getGraphUser();
    $response = $fb->get('/me');
    $node = $response->getGraphNode();
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
echo '<pre>';
print_r($node);
echo '</pre>';
echo "<img src='".$picture['url']."'/>";
echo'<h3>Name :  '.$node->getField('name');
echo'<h3>Hometown :  '.$node->getField('hometown')['name']; 
echo '<h3> My Working Details:</h3>';

foreach ($node->getField('work') as $key => $value) {
    echo '<ul><li> ';
    echo 'Organization : ' . $value['employer']['name'] . '</br>';
    if (isset($value['description'])) {
        echo 'Description : ' . $value['description'] . '</br>';
    };
    echo 'Location: ' . $value['location']['name'] . '</br>';
    echo 'Position : ' . $value['position']['name'] . '</br>';
    echo 'Start Date : ' . $value['start_date'] . '</br>';
    echo '</li></ul>';
}
echo '<h3> My Education Details:</h3>';
foreach ($node->getField('education') as $key => $value) {
    echo '<ul><li> ';
    echo 'Institute Name : ' . $value['school']['name'] . '</br>';
    echo 'Institute Type : ' . $value['type'] . '</br>';
    echo 'Reading Year : ' . $value['year']['name'] . '</br>';
    echo '</li></ul>';
}

echo'<h3>Religion :  '.$node->getField('religion');
echo'<h3>Favorite Quotes :  '.$node->getField('quotes'); 
echo'<h3>Website :  '.$node->getField('website');