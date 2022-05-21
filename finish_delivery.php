<?php
session_start();
/*подключение библиотек*/
require "settings_db.php";
require "lib_db.php";
header("Content-Type: text/html; charset=utf-8");

$id_order = clearData($_POST["id_order"], "i");
finish_delivery($id_order);
$transport = getTransportByOrder($id_order);
$transport_id = $transport["id"];
$sql = "SELECT * FROM delivery WHERE delivery_end IS NULL AND id_transport = $transport_id";
$res = mysql_query($sql) or die(mysql_error());
$transport_check = dataBaseToArray($res);
if (!isset($transport_check[0]["id"]))
    changeTransportStatus($transport_id, 1);
header('Location: admin_delivery.php');