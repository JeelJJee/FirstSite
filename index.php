<?php
require_once "header.php";
?>
 
<main class="main">
  <script type="text/javascript">

    function deleteArticle(str) {
      if(str == ""){
        alert('error js 1');
        return;
        } else {
          if (window.XMLHttpRequest) {
            // IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);
            }
        };
        xmlhttp.open("GET","delete.php?q="+str,true);

        xmlhttp.send();
        alert("Статья удалена!");
      }
    }
  </script>

  <div class="wrapper-main">
  <section class="section-defoult">
    

    <!---небезопасно, добавить позже проверку пароля в куки-->
    <?if($_SESSION['username'] =='ccc'):?>

    
    <h1>Добавить статью</h1>
     <form action="admin.php" method="post" enctype="multipart/form-data">
      <input type="text" name="zagolovok" placeholder="Заголовок" required>
      <input type="text" name="tema" placeholder="Тема" required>
      <br>
      <textarea id="post-textarea" name="message" rows="14" cols="92" required></textarea>
      <br>
      <input type="hidden" name="MAX_FILE_SIZE" value="1500000" />
      <input type="file" name="userfile[]" accept="image/jpeg,image/png,image/gif" multiple required>
      <input type="submit" name="submit" value="отправить">
      </form>
      
    <?endif?>



  		<?php 
      if($_GET['file']==='uploaded'){echo "Файл успешно загружен!";}
      if($_GET['error']==='uploaded'){echo "Ошибка загрузки файла! 0";}
      if($_GET['error']==='uploaded1'){echo "Ошибка загрузки файла 1!";}
      if($_GET['error']==='longfile'){echo "Файл слишком большой!";}
      if($_GET['send']==='s'){echo "Статья успешно загружена!";}
      if($_GET['error'] === 1 && $_GET['error']==='adminerror'){echo "DB error 1";}
      if($_GET['error'] === 2 && $_GET['error']==='adminerror'){echo "DB error 2";}
      if($_GET['error'] === 3 && $_GET['error']==='adminerror'){echo "DB error 3";}
      if($_GET['error'] === 4 && $_GET['error']==='adminerror'){echo "DB error 4";}
      if($_GET['error'] === 'manyfiles'){echo "Слишком много файлов";}


      echo "<pre>";
      require_once "config.php";

      $count = 5;
      
      // Количество записей на странице
      
      $page = $_GET["page"];
     
      // Узнаём номер страницы

      if(!$page || $page < 0){ $page = 1;}
      
      $conn = new mysqli ($hn, $un, $pw, $db);

      $shift = $count * ($page - 1);
     
      // Смещение в LIMIT. Те записи, порядковый номер которого больше этого числа, будут выводиться.


      if ($conn->connect_error){
        echo $conn->connect_error." sory errror: gl330";
        exit();
      }

      $query = "SELECT * FROM `words` ORDER BY post_data DESC LIMIT $shift, $count";//ORDER BY id DESC";

      //# последние count записей из таблицы words, но без первых shift

      $result = $conn->query($query); 

      if (!$result){
        echo $conn->error;
        echo "Sory , error 677876";
        exit();
      }
      $rows = $result->num_rows;// Кол-во строк в ответе из запроса

      for ($i=0; $i < $rows; ++$i) { 
        $result->data_seek($i);// Указатель в результате на строку
        $row = $result->fetch_array(MYSQLI_ASSOC);//1 строка в виде асс-массива
        $a = $row['text_id'];
        //need secur
        if($_SESSION['username'] == 'ccc'){
        echo "<button onclick='deleteArticle($a)'>Удалить</button>";
      }

        echo "Статья: <b>".$row['title']."</b><br>";
        echo "Дата: ".$row['post_data']."<br>";
        echo "Категория: ".$row['category']."<br><br>";
        $countOfFiles = $row['files'];
        for ($h=0; $h < $countOfFiles; $h++) { 
          $rr = $row['title'];
          echo "<img src='/files/$h$rr.jpg'><br>";
        }
        

        echo $row['words']."<br><br>";


        
        
        echo "<p><a name='$a'></a></p>";
        echo "<b>Комментарии: </b>";
        echo "<hr>";
       
       
        //

        $query = "SELECT * FROM `chat` WHERE whoseart = $a ORDER BY dateofcom ASC";
        $result2 = $conn->query($query); 
         if (!$result2){
        echo $conn->error;
        echo " Sory , index error 1";
        exit();
        }
        $rows2 = $result2->num_rows;

        for ($j=0; $j < $rows2; ++$j) { 
        $result2->data_seek($j);

        $row2 = $result2->fetch_array(MYSQLI_ASSOC);
      


      
        echo "<br>Дата: ".$row2['dateofcom'];

        
        echo "<br>Ник: <b>".$row2['name']."</b>";
        
        echo "<br>Cообщение: ".$row2['message'];
        echo "<br>---------------------------------------";
      }

        echo <<<_END
        <form name="comment" action="comment.php" method="post"><p><label>Имя:</label><input type="text" name="name" /></p><p><label>Комментарий:</label> <br /><textarea name="text_comment" cols="80" rows="3"></textarea>
        </p><p><input type="hidden" name="text_id" value="$a"/><input type="submit" value="Отправить" />
        </p>
        </form>
_END;
//?
      }
?>
   
  
  </section>

  </div>

<div class="first_pag">
  <?php

  $count_pages = 50;
  //всего страниц
  $active = $_GET["page"];
  //текущая активная страница.
  $count_show_pages = 5;
  //сколько показывать

  $url = "/index.php";
  $url_page = "/index.php?page=";
  //текущая

  if ($count_pages > 1) { 
   
    $left = $active - 1;
    $right = $count_pages - $active;

    if ($left < floor($count_show_pages / 2)) $start = 1;
    //20 - 24
    else $start = $active - floor($count_show_pages / 2);
    $end = $start + $count_show_pages - 1;
    if ($end > $count_pages) {
      $start -= ($end - $count_pages);
      $end = $count_pages;
      if ($start < 1) $start = 1;
    }
  }
  echo "</pre>";
?>

<div id="pagination" class="pagination">
  <span>Страницы: </span>
  <?php if ($active != 1) { ?>
    <a href="<?=$url?>" title="Первая страница">&lt;&lt;&lt;</a>
    <a href="<?php if ($active == 2) { ?>
      <?=$url?><?php } 
      else { 
        ?><?=$url_page.($active - 1)?><?php } ?>" title="Предыдущая страница">&lt;</a>
  <?php } ?>

  <?php for ($i = $start; $i <= $end; $i++) { ?>
    <?php if ($i == $active) { ?><span><?=$i?></span><?php } else { ?><a href="<?php if ($i == 1) { ?><?=$url?><?php } else { ?><?=$url_page.$i?><?php } ?>"><?=$i?></a><?php } ?>
    <?php } ?>
    <?php if ($active != $count_pages) { ?>
      <a href="<?=$url_page.($active + 1)?>" title="Следующая страница">&gt;</a>
      <a href="<?=$url_page.$count_pages?>" title="Последняя страница">&gt;&gt;&gt;</a>
    <?php } ?>



</div>
</div>
</div>
</div>

<?php
$result->close();
$conn->close();
      
if($_GET['send'] == 's'){
  echo "<script type='text/javascript'>alert('Статья отправлена!');</script>";
}

?>

<div class="rss">
</div>
</main>
</body>
<?php
  require_once "footer.php";
?>