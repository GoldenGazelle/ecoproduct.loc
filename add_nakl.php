<?php 
/*��������� ������*/
session_start();
/*����������� ���������*/
require "settings_db.php";
require "lib_db.php";

$id_order = clearData($_POST["id_order"], "i");

addNakls($id_order);
header("Location: admin_new_orders.php");
?>
