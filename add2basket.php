<?php
/*��������� ������*/
session_start();
/*���������� ����������*/
require "settings_db.php";
require "lib_db.php";
 
/*�������� ������������� ������������*/
if(!isset($_SESSION['id']))
    header("Location: customer_auth.php");
$customer = $_SESSION['id'];
/*�������� id ������*/
$goodsid = clearData($_GET["id"], "i");
/*�������� �����*/
$datetime = date(DATETIME_FORMAT);
 
add2basket($customer, $goodsid, $datetime);
header("Location: basket.php");
?>
