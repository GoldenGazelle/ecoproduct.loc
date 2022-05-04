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
            <li><a href="index.php">Главная</a></li>
            <li><a href="news.php">Новости</a></li>
            <li><a href="find.php">Найти груз</a></li>
            <li><a href="calc.php">Калькулятор</a></li>
            <li><a href="order.php">Оформить доставку</a></li>
            <li><a href="product.php">Продукты</a></li>
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
					echo "<p>Вы вошли как '$login' | <a href='exit.php'>Выход</a></p>";
					echo "<p>Вернуться в <a href='adminform.php'>панель администратора</a></p>";?>					

					<h2><center>Пункты маршрута</center></h2>	
					<form action="save_point.php" method="post">
					<?
					 if ($id > 0) 
					 {
						$sql = "SELECT * FROM points WHERE id=$id";						
						$resultat = mysql_query($sql) or die(mysql_error()); 
						$points = dataBaseToArray($resultat);
						foreach($points as $item){?>						
						<input type="hidden" name="id" value="<?=$item["id"]?>">
						<?$items = "<h4>Регион:<select name='idregion' size='1' style='width:200px;'>
						<option value='vse'>Выберите из списка</option>";									
						$regions = getRegion();
					
						foreach($regions as $region)
						{						
							$ss = "";
							if ($region['id'] == $item['idregion']) $ss = "selected";
							$items .= "<option ".$ss." value='".$region['id']."'>".$region['region']."</option>";
						};
						$items .= "</select></h4>";
						echo $items;?>
						<h4>Пункт маршрута: <input type="text" name="point" size="50" value="<?=$item["point"]?>" style='width:200px'></h4>											
						<?}						
					}
					else
					{	
						$items = "<h4>Регион:<select name='idregion' size='1' style='width:200px;'>
						<option value='vse'>Выберите из списка</option>";									
						$regions = getRegion();
					
						foreach($regions as $region)
						{						
							$items .= "<option value='".$region['id']."'>".$region['region']."</option>";
						};
						$items .= "</select></h4>";
						echo $items;?>
						<h4>Пункт маршрута: <input type="text" name="point" size="50" style='width:200px'></h4>	
					<?}?>
						<input type="submit" value="Сохранить">
					</form>	
				<?}?>				  
        </div>
      </div>
    </div>
  </div>
</div>
<div id="copyright"> &copy; ООО "ЭКОПРОДУКТ" | Сайт выполнен в качестве курсового проекта</div>
</body>
</html>