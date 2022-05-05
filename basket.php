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
          <h1>Корзина экопродуктов</h1>
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
        <div id="gboxm"><br>
		<?	
		echo "<p>Вернуться в <a href='product.php'>каталог товаров.</a></p><hr>";
	?>					
	<table border="0" cellpadding="3" cellspacing="0" width="100%">		
	<tr>
		<td><h4>Артикул</h4></td>
		<td><h4>Товар</h4></td>												
		<td><h4>Кол-во</h4></td>	
		<td><h4>Цена</h4></td>	
	</tr>					
    <?
		$goods = myBasket();
		$i = 1;
		$sum = 0;					
		foreach($goods as $item){				
		?>						
			<tr>
			<td><?=$item["article"]?></td>
			<td><?=$item["name"]?></td>												
			<td><?=$item["quantity"]?>у.е.</td>
			<td><?=$item["price"]?>р.</td>
			<td><a href="delete_from_basket.php?id=<?=$item["id"]?>"><img src="images/del.ICO" alt="product" /></a></td>
			</tr>					
		<?
		$i++;
		$sum += $item["price"]*$item["quantity"];
		}
	?>
	<tr><h3>Всего товаров на сумму: <?=$sum?> руб. </h3>
	<?
	if ($sum > 0) {?>
		<a href="order.php" target="_parent">Оформить доставку продуктов!</a></tr>
    <? } ?>
	</table>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="copyright"> &copy; ООО "ЭКОПРОДУКТ" | Система выполнена в качестве дипломного проекта</div>
</body>
</html>
