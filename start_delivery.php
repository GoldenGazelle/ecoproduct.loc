<?php
session_start();
/*подключение библиотек*/
require "settings_db.php";
require "lib_db.php";
$orders_ids = unserialize($_POST["orders_ids"]);
startDelivery($orders_ids);
header('Location: admin_delivery.php');