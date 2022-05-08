<?php  
/*��������� ������*/
session_start();
/*����������� ���������*/
require "settings_db.php";
require "lib_db.php";

$id = clearData($_GET["id"], "i");
deleteTable($id, "typets");
header("Location: edit_typets.php");
?>
