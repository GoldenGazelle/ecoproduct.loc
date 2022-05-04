<?php 
/*Запускаем сессию*/
session_start();
/*подключение библиотек*/
require "settings_db.php";
require "lib_db.php";

$id = clearData($_GET["id"], "i");
$number = clearData($_GET["number"], "i");
orderDate($id);
header("Location: edit_orderf.php?id=".$number);
?>
