<?php
session_start();
/*подключение библиотек*/
require "settings_db.php";
require "lib_db.php";
$id_order = clearData($_POST["id_order"], "i");

changeOrderStatus($id_order, 7);
$transport = getTransportByOrder($id_order);
changeTransportStatus($transport["id"], 4);
setShipmentEndDate($id_order);