<?php

# Facebook PHP SDK v5: One-Click Registration & Login Example
 
// Pass session data to script (only if not already included in your app).
session_start();
 
// Include the required Composer dependencies.
require_once __DIR__ . '/Facebook/autoload.php';
//// Initialize the Facebook PHP SDK v5.
$fb = new Facebook\Facebook([
  'app_id' => '192649580875833',
  'app_secret' => '5d5bcc3b413bdd03e9aed34a2d46c830',
  'default_graph_version' => 'v2.0',
  ]);
 
$helper = $fb->getRedirectLoginHelper();
$permissions = ['email', 'user_likes','user_about_me','user_birthday','user_actions.music
','user_friends','user_photos','user_relationships
','user_tagged_places','user_work_history','user_actions.books',
'user_actions.news','user_education_history','user_games_activity',
'user_location','user_posts','user_religion_politics',
'user_videos','user_actions.fitness','user_actions.video','user_events','user_hometown','user_managed_groups','user_relationship_details','user_status','user_website']; // optional
$loginUrl = $helper->getLoginUrl('http://localhost/facebookapi/login-callback.php', $permissions);

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';


