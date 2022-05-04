<?php 
/*Запускаем сессию*/
session_start();
/*подключение библиотек*/
require "settings_db.php";
require "lib_db.php";

$id = clearData($_POST["id"], "i");
$point = clearData($_POST["point"], "string_file");
$idregion = clearData($_POST["idregion"], "i");

savePoint($id, $point, $idregion);
header("Location: edit_point.php");
?>