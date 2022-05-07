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
					echo "<p>Вы вошли как '$login' | <a href='exit.php'>Выход</a></p>";
					echo "<p>Вернуться в <a href='adminform.php'>панель администратора</a></p>";?>					

					<h2><center>Характеристика маршрута</center></h2>	
					<form action="save_route.php" method="post">
					<?
					 if ($id > 0) 
					 {
						$sql = "SELECT * FROM route WHERE id=$id";						
						$resultat = mysql_query($sql) or die(mysql_error()); 
						$route = dataBaseToArray($resultat);
						foreach($route as $item){?>						
						<input type="hidden" name="id" value="<?=$item["id"]?>">
						<?
						$items = "<h4>Тип транспорта:<select name='idtypets' size='1' style='width:150px;'>
						<option value='vse'>Выберите из списка</option>";									
						$typeTS = getTypeTS();					
						foreach($typeTS as $type)
						{						
							$ss = "";
							if ($type['id'] == $item['idtypets']) $ss = "selected";
							$items .= "<option ".$ss." value='".$type['id']."'>".$type['type']."</option>";
						};
						$items .= "</select></h4>";
						echo $items;

						$items = "<h4>Пункт отправления:<select name='idpoint1' size='1' style='width:150px;'>
						<option value='vse'>Выберите из списка</option>";									
						$points = getPoint();					
						foreach($points as $point)
						{						
							$ss = "";
							if ($point['id'] == $item['idpoint1']) $ss = "selected";
							$items .= "<option ".$ss." value='".$point['id']."'>".$point['point']."</option>";
						};
						$items .= "</select></h4>";
						echo $items;
						
						$items = "<h4>Пункт прибытия:<select name='idpoint2' size='1' style='width:150px;'>
						<option value='vse'>Выберите из списка</option>";									
						$points = getPoint();					
						foreach($points as $point)
						{						
							$ss = "";
							if ($point['id'] == $item['idpoint2']) $ss = "selected";
							$items .= "<option ".$ss." value='".$point['id']."'>".$point['point']."</option>";
						};
						$items .= "</select></h4>";
						echo $items;

                            $items = "<h4>Проходящие города маршрута:<select name='id_points[]' size='5' multiple='multiple' style='width:150px;'>
                                    <option value='vse' multiple='multiple'>Выберите из списка</option>";
                                    $points = getPoint();
                                    foreach($points as $point)
                                    {
                                    $ss = "";
                                    if ($point['id'] == $item['idpoint2']) $ss = "selected";
                                    $items .= "<option ".$ss." value='".$point['id']."'>".$point['point']."</option>";
                                    };
                                    $items .= "</select></h4>";
                                                             echo $items;?>

						<h4>Расстояние: <input type="text" name="dist" size="50" value="<?=$item["dist"]?>" style='width:100px'></h4>											
						<h4>Время: <input type="text" name="time" size="50" value="<?=$item["time"]?>" style='width:100px'></h4>											
						<?}						
					}
					else
					{	
						$items = "<h4>Тип транспорта:<select name='idtypets' size='1' style='width:150px;'>
						<option value='vse'>Выберите из списка</option>";									
						$typeTS = getTypeTS();					
						foreach($typeTS as $type)
						{						;
							$items .= "<option value='".$type['id']."'>".$type['type']."</option>";
						};
						$items .= "</select></h4>";
						echo $items;						
						
						$items = "<h4>Пункт отправления:<select name='idpoint1' size='1' style='width:150px;'>
						<option value='vse'>Выберите из списка</option>";									
						$points = getPoint();					
						foreach($points as $point)
						{						
							$items .= "<option value='".$point['id']."'>".$point['point']."</option>";
						};
						$items .= "</select></h4>";
						echo $items;
						
						$items = "<h4>Пункт прибытия:<select name='idpoint2' size='1' style='width:150px;'>
						<option value='vse'>Выберите из списка</option>";									
						$points = getPoint();					
						foreach($points as $point)
						{						
							$items .= "<option value='".$point['id']."'>".$point['point']."</option>";
						};
						$items .= "</select></h4>";
						echo $items;

                        $items = "<h4 style='padding: 10px 0; display: flex; align-items: center;'>Проходящие города маршрута:<select name='id_points[]' size='5' multiple='multiple' style='width:150px;'>
						<option value='vse'>Выберите из списка</option>";
                        $points = getPoint();
                        foreach($points as $point)
                        {
                            $items .= "<option value='".$point['id']."'>".$point['point']."</option>";
                        };
                        $items .= "</select></h4>";
                        echo $items;?>
						
						<h4>Расстояние: <input type="text" name="dist" size="50" style='width:100px'></h4>											
						<h4>Время: <input type="text" name="time" size="50" style='width:100px'></h4>					
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