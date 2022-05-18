<?php
/*Запускаем сессию*/
session_start();
/*подключение библиотек*/
require "settings_db.php";
require "lib_db.php";

$id_order = clearData($_POST["id_order"], "i");
addDelivery($id_order);
changeOrderStatus($id_order, 7);
header("Location: admin_shipment.php");