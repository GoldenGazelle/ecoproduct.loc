<?php 
/*��������� ������*/
session_start();
/*����������� ���������*/
require "settings_db.php";
require "lib_db.php";

$idorder = clearData($_POST["idorder"], "i");
$nakl = clearData($_POST["nakl"], "i");

$departureId = getCityId($_POST['point1']); //����� �����������
$departureId = $departureId[0]['id'];

$arrivalId = getCityId($_POST['point2']);
$arrivalId = $arrivalId[0]['id'];

$passingIds = getPassingCitiesById($departureId);
$unActiveOrders = getUnActiveOrders();

foreach ($unActiveOrders as $unActiveOrder) {
    if ($unActiveOrder["idpoint1"] == $departureId) { // ���� ��������� ����� ������ �� ���������� ����������� ��������� � �������
        if (!empty($passingIds) && !empty($passingIds[0]["id_points"])) { // � ���� � ������� ������ ���� ���������� ������
            foreach (json_decode($passingIds[0]["id_points"]) as $passingId) { // �������� �������� ����� ����������� �������� � ����������� �������
                if ($passingId == $arrivalId) {
                    setOrderNumber($unActiveOrder["id"], $nakl); // ��������� �� �� ���������
                }
            }
        }
    }
}

addNakl($idorder, $nakl);
header("Location: edit_tripf.php?id=".$idorder);
?>
