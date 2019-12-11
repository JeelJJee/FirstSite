<?php
error_reporting(-1);
session_start();

require_once '../config.php';

if (isset($_POST['logout-submit'])) {
	if (isset($_SESSION['username'])) {

    //header( 'Location: /index.php', true, 303 );
    //header("Cache-Control : no-store, no-cache, must-revalidate, max-age=0");
    //setcookie ("login", "", time()-14800);
    //setcookie ("password", "", time()-14800);
    //session_unset();
    //unset($_SERVER['PHP_AUTH_PW'], $_SERVER['PHP_AUTH_USER']);

//Если у вас register_globals=off, то достаточно написать
    unset($_SESSION['name']);
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    unset($_SESSION['email']);
    unset($_SESSION['name']);
//Если же нет, то тогда рядом с ней надо написать
    //session_unregister($_SESSION['name']);
//session_unregister('var');
    //$_SERVER['PHP_AUTH_USER'] = 0;
    //$_SERVER['PHP_AUTH_USER'] = NULL;
    //$_SERVER['PHP_AUTH_PW'] = NULL;

	//$_SESSION = array();
    /*if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-1000);
        setcookie($name, '', time()-1000, '/');
        }
        */
    session_destroy();
	}
	
   
	header("Location: http://"."$site"."/index.php?ex");
	}
else header("Location: http://"."$site"."/index.php?ex2");
		


?>