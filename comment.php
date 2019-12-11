<?php
	require_once 'config.php';
  session_start();

	//if(isset($_POST['submit'])){echo "comment error 0 ".$conn->error; exit();}
  

	$conn = mysqli_connect($hn, $un, $pw, $db);
	if(!$conn){echo "comment error 1 ".$conn->error; exit();}


 	$nick = mysql_entities_fix_string($conn, $_POST['name']);
 	$comment = mysql_entities_fix_string($conn, $_POST['text_comment']);
  $whoseArticle = mysql_entities_fix_string($conn, $_POST['text_id']);
  $postIp =  get_client_ip();

  if(isset($_SESSION['username'])){
    $nick = $_SESSION['username'];
  }

  $query = "INSERT INTO `chat` (`id`, `name`, `message`, `whoseart`, `ipadress`) VALUES (NULL, '$nick', '$comment', '$whoseArticle', '$postIp')";
  
    $result = $conn->query($query);

    if (!$result) {echo "comment error 2  ".$conn->error; exit();}
    
    $conn->close();
    header("Location: http://"."$site"."/index.php");



  function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}


	function mysql_entities_fix_string($connection, $string)
	{
    	return htmlentities(strip_tags(mysql_fix_string($connection, $string)));
  	}
  	function mysql_fix_string($connection, $string)
  	{
    	if (get_magic_quotes_gpc()) $string = stripslashes($string);
    	return $connection->real_escape_string($string);
  	}
?>