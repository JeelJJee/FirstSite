<?php

error_reporting(-1);

/*
if(empty($_SERVER['CONTENT_TYPE']))
{ 
  $_SERVER['CONTENT_TYPE'] = "application/x-www-form-urlencoded"; 
}
*/
require_once '../config.php';

if( isset($_POST['submit']) && !empty($_POST['submit'] && !empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['nick'])))
{

  $conn =  new mysqli($hn, $un, $pw, $db);

  $login = mysql_entities_fix_string($conn, $_POST['login']);
  $password = mysql_entities_fix_string($conn, $_POST['password']);
  $email = mysql_entities_fix_string($conn, $_POST['email']);
  $nick = mysql_entities_fix_string($conn, $_POST['nick']);
  

  

  $salt111 = "&h*p";
  $salt222 = "za2za@";

  $token777 = hash('ripemd128', "$salt111$password$salt222");
	
  // !добавить проверку на повторки в дб

  $query = "INSERT INTO `users` (`id`, `login`, `password`, `nick`, `email`) VALUES (NULL, '$login', '$token777', '$nick', '$email')";

  $result = $conn->query($query);
  
  if (!$result) {
    echo $conn->error;
  	//header("Location: http://"."$hn"."/index.php");
  	exit($conn->error);
  }
header("Location: http://"."$site"."/index.php");
}
else
{                                     
	header("Location: http://"."$site"."/registration.php?error=38");
  exit();
}


//Если get_magic_quotes_gpc вернет 1 значит опция в php ini включена и она экранизирует все ковычки , NUL и слэш символы a потом stripslashes удалит экранирование. а real_escape_string экранирует вновь. Это для того, что бы небыло операции экранировании 2 раза подряд , а то экранирование сотрет само себя 
function mysql_entities_fix_string($connection, $string)
{
    return htmlentities(strip_tags(mysql_fix_string($connection, $string)));
  }
  function mysql_fix_string($connection, $string)
  {
    if (get_magic_quotes_gpc()) $string = stripslashes($string);
    return $connection->real_escape_string($string);
  }