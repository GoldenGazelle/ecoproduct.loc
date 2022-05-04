<?php
/*Запускаем сессии*/
session_start();
/*Подключаем библиотеки*/
require "settings_db.php";
require "lib_db.php";
 
$id = clearData($_GET["id"], "i");
basketDel($id);
header("Location: basket.php");
?>
