<?php
session_start();
/*подключение библиотек*/
require "settings_db.php";
require "lib_db.php";
header("Content-Type: text/html; charset=utf-8");

$id_order = clearData($_POST["id_order"], "i");
finish_delivery($id_order);
header('Location: admin_delivery.php');