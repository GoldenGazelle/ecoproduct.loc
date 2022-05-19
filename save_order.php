<?php 
/*Запускаем сессию*/
session_start();
/*Подключаем библиотеки*/
require "settings_db.php";
require "lib_db.php";
header("Content-Type: text/html; charset=utf-8");

/*Получаем данные из формы*/
$id_address = clearData($_POST["id_address"], "i");
$customer_id = $_SESSION['id'];
$delivery_date = $_POST['delivery_date'];
$delivery_time = $_POST['delivery_time'];
addOrder($customer_id, $id_address, $delivery_date.' '.$delivery_time);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Доставка продуктов ЭКОПРОДУКТ</title>
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
        <div id="gbox">
          <div id="gbox-top"> </div>
          <div id="gbox-bg">
            <div id="gbox-grd">
				<h2><center>Заявка на доставку подана</h2>
				<p>Ваша заявка принята.</p>
				<p>В течение двух часов Наш менеджер свяжется по указанным Вами данным для уточнения заявки.</p>
				<p>Подать <a href='order.php'>новую заявку</a>?</p>
              <div class="clear"><br> Телефоны: +375 17 293-89-97, +375 17 293-23-66, 293-89-77</div>
            </div>
          </div>
          <div id="gbox-bot"> </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="copyright"> &copy; ООО "ЭКОПРОДУКТ" | Система выполнена в качестве дипломного проекта</div>
</body>
</html>