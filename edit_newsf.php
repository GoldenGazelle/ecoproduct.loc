<?php  
/*Запускаем сессию*/
session_start();
/*подключение библиотек*/
require "settings_db.php";
require "lib_db.php";
header("Content-Type: text/html; charset=utf-8");

$id = clearData($_GET["id"], "i");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Панель администратора</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="style.css" type="text/css" charset="utf-8" />
</head>
<body>
<div id="outer">
  <div id="wrapper">
    <div id="body-bot">
      <div id="body-top">
        <div id="logo">
          <h1>Доставка экопродуктов</h1>
          <p><a href="adminform.php" target="_parent">Мы доставим ВАШИ продукты</a></p>
        </div>
        <div id="nav">
          <ul>
            <?php print_customer_header(); ?>
          </ul>
          <div class="clear"> </div>
        </div>
        <div id="gboxm">                
				<?php
				$login = $_SESSION['login'];
				$password = $_SESSION['password'];
		
				if(empty($login) and empty($password))
				{
					echo "<h2>Ошибка!</h2>";
					echo "<p>Необходимо пройти авторизацию | <a href='adminform.php'>Вход</a></p>";
				}
				else
				{
					echo "<p>Вы вошли как '$login' | <a href='../exit.php'>Выход</a></p>";
					echo "<p>Вернуться в <a href='adminform.php'>панель администратора</a></p>";?>

					<h2><center>Новости</center></h2>						
					<form action="../admin/save_news.php" method="post">
					<?
					 if ($id > 0) 
					 {
						$sql = "SELECT * FROM news WHERE id=$id";						
						$resultat = mysql_query($sql) or die(mysql_error()); 
						$news = dataBaseToArray($resultat);
						foreach($news as $item){?>						
						<input type="hidden" name="id" value="<?=$item["id"]?>">
						<h4>Заголовок: <input type="text" name="title" size="50" value="<?=$item["title"]?>" style='width:200px'></h4>					
						<h4>Новость: <br><textarea name="news" cols="50" rows="5"><?=$item["news"]?></textarea></h4>
						<?}						
					}
					else
					{?>	
						<h4>Заголовок: <input type="text" name="title" size="50" style='width:200px'></h4>					
						<h4>Новость: <br><textarea name="news" cols="50" rows="5"></textarea></h4>
					<?}?>
						<input type="submit" value="Сохранить">
					</form>	
				<?}?>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="copyright"> &copy; ООО "ЭКОПРОДУКТ" | Система выполнена в качестве дипломного проекта</div>
</body>
</html>