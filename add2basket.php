<?php
/*Запускаем сессию*/
session_start();
/*Подключяем библиотеки*/
require "settings_db.php";
require "lib_db.php";
 
/*Получаем идентификатор пользователя*/
$customer = session_id();
/*Получаем id товара*/
$goodsid = clearData($_GET["id"], "i");
/*Получаем время*/
$datetime = date('Y:m:d G:i:s');
 
add2basket($customer, $goodsid, $datetime);
header("Location: basket.php");
?>
