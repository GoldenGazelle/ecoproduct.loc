<?php
/*Запускаем сессию*/
session_start();
/*подключение библиотек*/
require "settings_db.php";
require "lib_db.php";

$id_order = clearData($_POST["id_order"], "i");
changeOrderStatus($id_order, 5);
if ($_SESSION["user_type"] == 'admin')
    header("Location: admin_new_orders.php");
else
    header("Location: ".$_SESSION["last_page"]);