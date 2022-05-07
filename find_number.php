<?php  
/*Запускаем сессию*/
session_start();
/*подключение библиотек*/
require "settings_db.php";
require "lib_db.php";
header("Content-Type: text/html; charset=utf-8");

/*Получаем данные из формы*/
$number = clearData($_POST["number"], "string_file");
?>
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Поиск по накладной</title>
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
                <h2>Поиск истории груза по накладной № <?=$number?></h2>
				<p>Вернуться <a href='find.php'>назад</a>.</p>
				<? findNumber($number, ''); ?>
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