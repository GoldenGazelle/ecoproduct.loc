<?php
require "settings_db.php";
require "lib_db.php";

$id_point = $_POST['id_point'];
$ul = $_POST['ul'];
$house = $_POST['house'];
$customer_id = $_POST['customer_id'];
addAddress($id_point, $ul, $house, $customer_id);
header("Location: order.php");