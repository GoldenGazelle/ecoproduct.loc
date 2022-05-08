<?php 
/*��������� ������*/
session_start();
/*����������� ���������*/
require "settings_db.php";
require "lib_db.php";

$id = clearData($_POST["id"], "i");
$region = clearData($_POST["region"], "string_file");

saveRegion($id, $region);
header("Location: edit_region.php");
?>
