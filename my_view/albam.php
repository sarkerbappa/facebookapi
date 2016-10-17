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
    $photos_request = $fb->get('/me/photos?limit=250&type=uploaded');
    $photos = $photos_request->getGraphEdge();
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
?>
 

<!DOCTYPE html>
<html>
<head>
<style>
div.img {
    margin: 5px;
    border: 1px solid #ccc;
    float: left;
    width: 180px;
}	

div.img:hover {
    border: 1px solid #777;
}

div.img img {
    width: 100%;
    height: auto;
}

div.desc {
    padding: 15px;
    text-align: center;
}
</style>
</head>
<body>
<?php
$all_photo = $photos->asArray();
foreach ($all_photo as $single_photo) {
?>
    <div class="img">
            <img src="<?php echo $single_photo['picture']; ?>" alt="Trolltunga Norway" width="100" height="100">
            <div class="desc"><?php
              if (isset($single_photo['likes'])){
                  $photo_likes = $single_photo['likes'];
              };
                foreach ( $photo_likes  as $like) {
                    echo'<a href="https://www.facebook.com/'. $like['id'].'">'. $like['name'].','.'</a> ';
//                    echo '<pre>';
//                    print_r($like);
//                    echo '<pre>';
              }
                ?>

            </div>
        </div>

<?php  }
  
 
?>
</body>
</html>
