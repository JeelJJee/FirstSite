<?php
include_once('config.php');
$numberOfArt = $_GET['q'];


$conn = mysqli_connect($hn, $un, $pw, $db);
	if(!$conn){
		echo "delete error 1 ".$conn->error; exit();
	}
$query = "DELETE FROM `words` WHERE text_id = $numberOfArt";
$result =  $conn->query($query);
if (!$result) {
	error_log ($conn->error, __DIR__."/my-errors.log");
	exit();
}

$query2 = "DELETE FROM `chat` WHERE whoseart = $numberOfArt";
$result2 =  $conn->query($query2);

if (!$result2) {
	error_log($conn->error, 3, __DIR__."/my-errors.log");
	exit();
}

$conn->close();


?>