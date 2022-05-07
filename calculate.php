<?php 
/*Запускаем сессию*/
session_start();
/*Подключаем библиотеки*/
require "settings_db.php";
require "lib_db.php";
header("Content-Type: text/html; charset=utf-8");

/*Получаем данные из формы*/
$idtypets = clearData($_POST["idtypets"], "i");
$idpoint1 = clearData($_POST["idpoint1"], "i");
$idpoint2 = clearData($_POST["idpoint2"], "i");

$result = calc($idtypets, $idpoint1, $idpoint2);
$sum = $result['minP'];
$time = $result['time'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Расчет доставки КУРЬЕР</title>
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
				<h2><center>Расчет доставки по маршруту</h2>
				<?
				if ($sum == 0)
				{?>
					<p>Приносим свои извенения, но данный маршрут временно не обслуживается.</p>
					<p>Попробуйте обратиться к Нашим услугам позже.</p>
					<p>Рассчитать <a href='calc.php'>еще</a> ?</p>
				<?
				}
				else
				{?>
					<p>Минимальная стоимость доставки составила: <b> <?=number_format($sum, 2)?> руб.</b></p>
					<p>Примерное время доставки составила: <b><?=number_format($time, 2)?> ч.</b></p> 
					<p>Расчет стоимости приблизителен и может меняться от разных факторов:</p>
					<ul>
						<li>срочность доставки;</a></li>
						<li>габаритность груза;</a></li>				  
						<li>тип груза;</a></li>
						<li>упаковка груза.</a></li>
					</ul>
					<p>Для более точного расчета Вам необходимо связаться с менеджером по указанным ниже телефонам или отставить заявку.</p>
					<p>Подать <a href='order.php'>заявку</a> Вы также можете в нашей системе.</p>
				<?};?>
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
