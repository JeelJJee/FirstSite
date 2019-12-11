<?php

error_reporting(-1);

require_once 'config.php';

session_start();

if(isset($_SESSION['username'])){




//Нужна безопасность
//Перезаписывает айлы с одинаковым именем

	
$total = count($_FILES['userfile']['name']);

$fileId = $_POST['zagolovok'];

for ($i=0; $i < $total; $i++) { 
		
		


$uploadfile = ROOT_DIR . "/files/"."$i"."$fileId".".jpg";


//finfo шлет хедер в случае исключения
/*
$finfo = new finfo(FILEINFO_MIME_TYPE);
try {
if (false === $ext = array_search(
        $finfo->file($_FILES['userfile']['tmp_name'][$i]),
        array(
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
        ),
        true
    )) {
        throw new RuntimeException('Invalid file format.');
    }
} catch(RuntimeException $e){
	header("Location: http://"."$site"."/index.php?error=uploaded");
	exit();
}
*/

if($_FILES['userfile']['size'][$i] > 1500000){
	header("Location: http://"."$site"."/index.php?error=longfile");
	exit();
}

if (!move_uploaded_file($_FILES['userfile']['tmp_name'][$i], $uploadfile)) {
    
    header("Location: http://"."$site"."/index.php?error=uploaded1");
	exit();
}
}


//Добавить пушинг ошибок в файл.
if($_POST['zagolovok'] && $_POST['tema'] && $_POST['message'] && $_POST['submit']){

	$conn = new mysqli($hn, $un, $pw, $db);

	if ($conn->connect_errno) {
		$stmt->close();
    $conn->close();
	header("Location: http://"."$site"."/index.php?error=1");
    //echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
	
	if(!($stmt = $conn->prepare("INSERT INTO words (nick, title, category, words, files) VALUES (?, ?, ?, ?, ?)"))){
		$stmt->close();
    $conn->close();
	header("Location: http://"."$site"."/index.php?error=2");
		//echo "Не удалось подготовить запрос: (" . $mysqli->errno . ") " . $mysqli->error;
	}

	

	if (!$stmt->bind_param("ssssd", $nick, $title, $category, $words, $countOfFiles)) {
		$stmt->close();
    $conn->close();
	header("Location: http://"."$site"."/index.php?error=3");
    //echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
}
$nick = $_SESSION['username'];
$title = $_POST['zagolovok'];
$category = $_POST['tema'];
$words = $_POST['message'];

$countOfFiles = count($_FILES['userfile']['name']);

if($countOfFiles > 3)
{
	$stmt->close();
    $conn->close();
	header("Location: http://"."$site"."/index.php?error=manyfiles");
	exit();
}

if (!$stmt->execute()) {
	$stmt->close();
    $conn->close();
	header("Location: http://"."$site"."/index.php?error=4");
    //echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
}

$stmt->close();
$conn->close();

header("Location: http://"."$site"."/index.php?send=s");
}

else{
	$stmt->close();
    $conn->close();
	header("Location: http://"."$site"."/index.php?error=adminerror");
	exit();
}
}