<?php  
/*Запускаем сессию*/
session_start();
/*подключение библиотек*/
require "settings_db.php";
require "lib_db.php";
header("Content-Type: text/html; charset=utf-8");
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
              <li><a href="index.php">Главная</a></li>
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

					<h2><center>Исполнение заказа</center></h2>
					<table border="0" cellpadding="5" cellspacing="0" width="100%">							
					<tr>						
						<td><h3>Номер</h3></td>
						<td><h3>Дата</h3></td>
						<td><h3>Заказчик</h3></td>
						<td><h3>Тип ТС</h3></td>
						<td><h3>Откуда</h3></td>
						<td><h3>Куда</h3></td>
					</tr>
					<?	
					$items = getOrders('',' AND number>0');					
					foreach($items as $item)
					{?>
						<tr>
                        <td><a href="edit_orderf.php?id=<?=$item["number"]?>"><img src="images/logos/edit.ico" alt="edit" /><?=$item["number"]?></a>
                        <td><?=$item["date_format"]?></td>
						<td><?=$item["fio"]?></td>
						<td><?=$item["type"]?></td>
						<td><?=$item["point1"]?></td>
						<td><?=$item["point2"]?></td>
						</tr>
					<?}
						echo "</table>";				
					}?>				  
        </div>
      </div>
    </div>
  </div>
</div>
<div id="copyright"> &copy; ООО "ЭКОПРОДУКТ" | Система выполнена в качестве дипломного проекта</div>
</body>
</html>