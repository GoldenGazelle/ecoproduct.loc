<?php 
/*Запускаем сессию*/
session_start();
/*подключение библиотек*/
require "settings_db.php";
require "lib_db.php";

$id = clearData($_GET["id"], "i");
deleteTable($id, "news");
header("Location: edit_news.php");
?>
