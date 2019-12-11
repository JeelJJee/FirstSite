<?php
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
    <style type="text/css">
    img{
       height: auto;
       max-width: 100%;
       width: auto;
       }
</style>
		<meta charset="utf-8">
		<meta name="description" content="">

		<meta name=viewport content="width=device-width, initial-scale=1">
		<title>Site</title>
	 <link rel="stylesheet" href="style.css">
    
	</head>
  <body>
	<header>
<p><a name="#top"></a></p>
   



<nav class="nav-header-main">


      <p><a href="/index.php"  class="rollover"> </a></p>
			
		


  <ul>
       <li><a href="#" aria-haspopup="true">one </a>
        <!---
        <ul class="dropdown" aria-label="submenu">
        <li><a href="#1">О нас</a></li>
        <li><a href="#">Sub-2</a></li>
        <li><a href="#">Sub-3</a></li>
      </ul>     
      --->
  </li>
  </ul>

  <ul>
       <li><a href="#" aria-haspopup="true">Two </a>
<!---
        <ul class="dropdown" aria-label="submenu">
        <li><a href="#">Sub-1</a></li>
         <li><a href="#">Sub-2</a></li>
          <li><a href="#">Sub-3</a></li>
      </ul>
    -->
  </li>
  </ul>

  <ul>
       <li><a href="#" aria-haspopup="true">three ↓</a>
        <ul class="dropdown" aria-label="submenu">
        <li><a href="testpage.php"><b>testpage<b></a></li>
        <li><a href="#">Sub-2</a></li>
        <li><a href="#">Sub-3</a></li>
      </ul>
  </li>
  </ul>


   <div class="logstatus">

    
     
     
    <?if(isset($_SESSION['username'])):?>
      
        Добро пожаловать!
        <p class="login-status"> Вы вошли</p>
        <font color="red"><?=$_SESSION['username']?></font>
        
        <?else:?>
        <p class="login-status">&nbsp; &nbsp; &nbsp; Вы не залогинились &nbsp; &nbsp; &nbsp;</p>
        <?endif;?>
        
        </div>
        
        <div class="logstatus2">
        
        
        
        <?if(isset($_SESSION['username'])):?>
          

            <form action="inc/logout.inc.php" method="post">
            <input type="submit" name="logout-submit" value="exit"></form>
          <?else:?>
            
          <form action="inc/authenticate.inc.php" method="post">
          <p>Ваш логин: <input type="text" name="name" / required></p>
          <p>Ваш паролль: <input type="text" name="pwd" / required></p>
          <button type="sumbit" name="login-sumbit">Войти</button>
        </form>
        <a href="registration.php">Зарегестрироваться</a>
        <?endif;?>
</div>

      </nav>
    
			<div class="header-login">
				
			</div>

	</header>
