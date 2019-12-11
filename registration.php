<?php
  require "header.php";
?>

<main>
	<div class="wrapper-main">
		<section class="section-default">

			<h1>Регестрация</h1>
			<?php

			if($_GET['error'] == '38'){
			echo "Ошибка! Заполните всю форму!<br>";
		}

				if($_GET['error'] == 1){ echo "Неудачная попытка войти, вы не зарегестрированы!<br>";
				}
			    echo "Введите свои данные<br>";
			?>

				<form action="inc/registration.inc.php" method="post">
					
					<input type="text" name="email" placeholder="email" required>
					<input type="text" name="login" placeholder="login" required>
					<input type="password" name="password" placeholder="password" required>
					<input type="nick" name="nick" placeholder="nickname" required>

					<input type="submit" name="submit" onclick="alert('Форма отправлена!')" value="отправить" required> 

					<button type="reset">Очистить форму</button> 
   					
				</form>

			</section>
		</div>
	</main>
	

<?php 
  require "footer.php";
?>