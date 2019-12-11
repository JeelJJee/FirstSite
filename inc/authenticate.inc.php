<?php




error_reporting(-1);

require_once '../config.php';

$conn = new mysqli($hn, $un, $pw, $db);



if(!$conn ){
	header("Location: http://"."$site"."/index.php?error=2");
	exit();
}

//if (isset($_SERVER['PHP_AUTH_USER']) &&
 //     isset($_SERVER['PHP_AUTH_PW'])) 
if (!isset($_SESSION['authorized']) and  !isset($_SESSION['username']) and $_POST['pwd'])
{


$login = mysql_entities_fix_string($conn ,$_POST['name']);
$password = mysql_entities_fix_string($conn ,$_POST['pwd']);


$salt111 = "&h*p";
$salt222 = "za2za@";
$hex = hash('ripemd128', "$salt111$password$salt222");

$query = "SELECT * FROM `users` WHERE login ='$login' AND password = '$hex'";

$result = $conn->query($query);

if (!$result) {
	header("Location: http://"."$site"."/index.php?error=3");
	exit();
}

elseif ($result->num_rows)
{
 $row = $result->fetch_array(MYSQLI_NUM);
 $result->close();

if ($hex == $row[2]){

  session_start();
  $_SESSION['username'] = $login;
  $_SESSION['password'] = $password;
  $_SESSION['email'] = $row[3];
  $_SESSION['name'] = $row[4];
  $_SESSION['authorized'] = 1;

}
else die("Неверная комбинация имя пользователя — пароль"); 
}


}
else {
 // header('WWW-Authenticate: Basic realm="Restricted Section"');
  header('HTTP/1.0 401 Unauthorized');
  echo 'Пожалуйста, введите имя пользователя и пароль <a href="/index.php">щелкните здесь для продолжения </a>';
  die ();

}

header("Location: http://"."$site"."/index.php");


function mysql_entities_fix_string($connection, $string)
{
    return htmlentities(mysql_fix_string($connection, $string));
  }
  function mysql_fix_string($connection, $string)
  {//если get_magic_quotes_gpc вернет 1 значит опция в php ini включена и она экранизирует все ковычки , NUL и слэш символы a потом stripslashes удалит экранирование. а real_escape_string экранирует вновь. Это для того, что бы небыло операции экранировании 2 раза подряд , а то экранирование сотрет само себя 
    if (get_magic_quotes_gpc()) $string = stripslashes($string);
    return $connection->real_escape_string($string);
  }	

  $conn->close();

?>