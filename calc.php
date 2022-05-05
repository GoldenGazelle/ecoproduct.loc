<?php 
/*подключение библиотек*/
require "settings_db.php";
require "lib_db.php";
header("Content-Type: text/html; charset=utf-8");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Калькулятор ТК КУРЬЕР</title>
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
        <div id="gbox">
          <div id="gbox-top"> </div>
          <div id="gbox-bg">
            <div id="gbox-grd">
			
				<h2><center>Введите параметры доставки!</h2>
				<table align="center">
				<form action="calculate.php" method="POST">
				<?
				$items = "<tr><td><h3>Тип транспорта:</h3><select name='idtypets' size='1' style='width:313px;'>
					<option value='vse'>Выберите из списка</option>";									
				$typeTS = getTypeTS();
					
				foreach($typeTS as $type)
				{						
					$items .= "<option value='".$type['id']."'>".$type['type']."</option>";
				};
				$items .= "</select></td>";
				echo $items;
					
				$items = "<tr><td><h3>Пункт отправления:</h3><select name='idpoint1' size='1' style='width:313px;'>
					<option value='vse'>Выберите из списка</option>";
				$points = getPoint();
				foreach($points as $point)
				{						
					$items .= "<option value='".$point['id']."'>".$point['point']."</option>";
				};
				$items .= "</select></td>";
				echo $items;
				
				$items = "<tr><td><h3>Пункт прибытия:</h3><select name='idpoint2' size='1' style='width:313px;'>
					<option value='vse'>Выберите из списка</option>";									
					
				foreach($points as $point)
				{						
					$items .= "<option value='".$point['id']."'>".$point['point']."</option>";
				};
				$items .= "</select></td>";
				echo $items;
			
				?>
				<tr><td align="center" colspan="2"><input type="submit" value="Рассчитать" name="submit"></td></tr>
				</form>	
				</table>
				
              <div class="clear"><br> Телефоны: +375 17 293-89-97, +375 17 293-23-66, 293-89-77</div>
            </div>
          </div>
          <div id="gbox-bot"> </div>
        </div>
        <div id="greybox">
          <div id="greybox-bot">
            <div id="greybox-top">
              <h2>ХОТИТЕ УЗНАТЬ СТОИМОСТЬ ДОСТАВКИ ВАШИХ ПРОДУКТОВ? </h2>
              <p><a href="calc.php">Подробнее</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="copyright"> &copy; ООО "ЭКОПРОДУКТ" | Система выполнена в качестве дипломного проекта</div>
</body>
</html>
