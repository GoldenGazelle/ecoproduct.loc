<?php 
/*«апускаем сессию*/
session_start();
/*подключение библиотек*/
require "settings_db.php";
require "lib_db.php";

$idorder = clearData($_POST["idorder"], "i");
$nakl = clearData($_POST["nakl"], "i");

$departureId = getCityId($_POST['point1']); //пункт отправлени€
$departureId = $departureId[0]['id'];

$arrivalId = getCityId($_POST['point2']);
$arrivalId = $arrivalId[0]['id'];

$passingIds = getPassingCitiesById($departureId);
$unActiveOrders = getUnActiveOrders();

foreach ($unActiveOrders as $unActiveOrder) {
    if ($unActiveOrder["idpoint1"] == $departureId) { // если начальный пункт одного из неактивных отправлений совпадает с текущим
        if (!empty($passingIds) && !empty($passingIds[0]["id_points"])) { // и если у текущей за€вки есть проход€щие города
            foreach (json_decode($passingIds[0]["id_points"]) as $passingId) { // проверим конечную точки неактивного маршрута с проход€щими точками
                if ($passingId == $arrivalId) {
                    setOrderNumber($unActiveOrder["id"], $nakl); // назначаем ту же накладную
                }
            }
        }
    }
}

addNakl($idorder, $nakl);
header("Location: edit_tripf.php?id=".$idorder);
?>
