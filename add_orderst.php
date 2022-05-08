<?php 
/*��������� ������*/
session_start();
/*����������� ���������*/
require "settings_db.php";
require "lib_db.php";

$idorder = clearData($_POST["idorder"], "i");
$pointnew = clearData($_POST["pointnew"], "i");

addOrderst($idorder, $pointnew);
header("Location: edit_tripf.php?id=".$idorder);
?>
