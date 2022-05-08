<?php 
/*��������� ������*/
session_start();
/*����������� ���������*/
require "settings_db.php";
require "lib_db.php";

$idorderst = clearData($_GET["idorderst"], "i");
$idorder = clearData($_GET["idorder"], "i");

deleteTable($idorderst, "orderst");
header("Location: edit_tripf.php?id=".$idorder);
?>
