<?php
session_start();
require "settings_db.php";
require "lib_db.php";
header("Content-Type: text/html; charset=utf-8");

$id_order = $_POST["id_order"];
$id_transport = $_POST["id_transport"];
setTransportForOrder($id_order, $id_transport);
header("Location: admin_shipment.php");