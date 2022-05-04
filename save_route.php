<?php 
/*��������� ������*/
session_start();
/*����������� ���������*/
require "settings_db.php";
require "lib_db.php";

$id = clearData($_POST["id"], "i");
$idtypets = clearData($_POST["idtypets"], "i");
$idpoint1 = clearData($_POST["idpoint1"], "i");
$idpoint2 = clearData($_POST["idpoint2"], "i");
$id_points = json_encode($_POST["id_points"]);
$dist = clearData($_POST["dist"], "i");
$time = clearData($_POST["time"], "i");

saveRoute($id, $idtypets, $idpoint1, $idpoint2, $id_points, $dist, $time);
header("Location: edit_route.php");
?>
