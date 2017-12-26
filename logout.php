<?php

// include FB config file 
require_once 'fbConfig.php';

//remove access token from session
unset($_SESSION['facebook_access_token']);

//remove user data from session
unset($_SESSION['userData']);

//redirect to the homepage
header("Location:index.php");

?>