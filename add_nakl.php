<?php 
/*Запускаем сессию*/
session_start();
/*подключение библиотек*/
require "settings_db.php";
require "lib_db.php";

$id_order = clearData($_POST["id_order"], "i");

addNakl($id_order);
changeOrderStatus($id_order, 2);
header("Location: admin_new_orders.php");
?>
