<?php
/*��������� ������*/
session_start();
/*���������� ����������*/
require "settings_db.php";
require "lib_db.php";
 
/*�������� ������������� ������������*/
$customer = session_id();
/*�������� id ������*/
$goodsid = clearData($_GET["id"], "i");
/*�������� �����*/
$datetime = date('Y:m:d G:i:s');
 
add2basket($customer, $goodsid, $datetime);
header("Location: basket.php");
?>
