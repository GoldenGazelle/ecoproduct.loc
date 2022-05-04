<?php  
/*��������� ������*/
session_start();
/*����������� ���������*/
require "settings_db.php";
require "lib_db.php";

$id = clearData($_POST["id"], "i");
$type = clearData($_POST["type"], "string_file");
$price = clearData($_POST["price"], "f");

saveTypets($id, $type, $price);
header("Location: edit_typets.php");
?>
