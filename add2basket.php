<?php
/*Запускаем сессию*/
session_start();
/*Подключяем библиотеки*/
require "settings_db.php";
require "lib_db.php";
 
/*Получаем идентификатор пользователя*/
if(!isset($_SESSION['id']))
    header("Location: customer_auth.php");
$customer = $_SESSION['id'];
/*Получаем id товара*/
$goodsid = clearData($_GET["id"], "i");
/*Получаем время*/
$datetime = date(DATETIME_FORMAT);
 
add2basket($customer, $goodsid, $datetime);
header("Location: basket.php");
?>
