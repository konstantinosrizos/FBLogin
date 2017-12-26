<?php

if (!session_id()) {
	session_start();
}

//include the autoloader provided in the SDK
require_once __DIR__ . '/facebook-php-sdk/autoload.php';

//include required libraries
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

/*
configuration and setup 
*/ 
$appId = '135388033829521'; //Facebook app id
$appSecret = 'f66025c880f4d0229fcd3ad490e15872'; // Facebook secret
$redirectURL = 'http://php.dev/FBLogin/'; // Callback URL
$fbPermissions = array('email'); // optional permissions

$fb = new Facebook(array(
    'app_id' => $appId,
    'app_secret' => $appSecret,
    'default_graph_version' => 'v2.2',
));

//Get redirect login helper
$helper = $fb->getRedirectLoginHelper();

//Try to get access token
try {
	if (isset($_SESSION['facebook_access_token'])) {
		$accessToken = $_SESSION['facebook_access_token'];
	} else {
		$accessToken = $helper->getAccessToken();
	}
} catch (FacebookResponseException $e) {
	echo 'Graph returned an error: ' . $e->getMessage();
	exit;
} catch (FacebookSDKException $e) {
	echo 'Facebook SDK return an error' . $e->getMessage();
	exit;
}

?>