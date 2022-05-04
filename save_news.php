<?php 
/*Запускаем сессию*/
session_start();
/*подключение библиотек*/
require "settings_db.php";
require "lib_db.php";

$id = clearData($_POST["id"], "i");
$date = date('Y:m:d');
$title = clearData($_POST["title"], "string_file");
$news = clearData($_POST["news"], "string_file");

saveNews($id, $date, $title, $news);
header("Location: edit_news.php");
?>
