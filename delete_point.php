<?php 
/*Запускаем сессию*/
session_start();
/*подключение библиотек*/
require "settings_db.php";
require "lib_db.php";

$id = clearData($_GET["id"], "i");
deleteTable($id, "points");
header("Location: edit_point.php");
?>
