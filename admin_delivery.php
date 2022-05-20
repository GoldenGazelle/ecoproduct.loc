<?php
/*Запускаем сессию*/
session_start();
/*подключение библиотек*/
require "settings_db.php";
require "lib_db.php";
header("Content-Type: text/html; charset=utf-8");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Отгрузка заказов</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="style.css" type="text/css" charset="utf-8" />
</head>
<body>
<div id="outer">
    <div id="wrapper">
        <div id="body-bot">
            <div id="body-top">
                <div id="logo">
                    <h1>Доставка экопродуктов</h1>
                    <p><a href="adminform.php" target="_parent">Мы доставим ВАШИ продукты</a></p>
                </div>
                <div id="nav">
                    <ul>
                        <li><a href="index.php">Главная</a></li>
                    </ul>
                    <div class="clear"> </div>
                </div>
                <div id="gboxm">
                    <?php
                    $login = $_SESSION['login'];
                    $password = $_SESSION['password'];

                    if(empty($login) and empty($password))
                    {
                        echo "<h2>Ошибка!</h2>";
                        echo "<p>Необходимо пройти авторизацию | <a href='adminform.php'>Вход</a></p>";
                    }
                    else
                    {
                    echo "<p>Вы вошли как '$login' </p>";
                    echo "<p>Вернуться в <a href='adminform.php'>панель администратора</a></p>";?>

                    <h2><center>Доставка</center></h2><br>
                    <table border="0" cellpadding="5" cellspacing="0" width="100%">
                        <tr>
                            <td><h3>Номер</h3></td>
                            <td><h3>Дата доставки</h3></td>
                            <td><h3>Город</h3></td>
                            <td><h3>Транспорт</h3></td>
                            <td><h3>Статус</h3></td>
                            <td><h3>Дата начала</h3></td>
                            <td><h3>Дата завершения</h3></td>
                            <td width=25></td>
                        </tr>
                        <?
                        $orders_ready_for_deliver = getOrdersForDeliver();
                        foreach($orders_ready_for_deliver as $order)
                        {
                            $transports = getTransportByRegion($order["id_region"])
                            ?>
                            <tr>
                                <td><a href="order_details.php?id=<?=$order["id_order"]?>&status=<?=$order["id_status"]?>"><?=$order["number"]?></a></td>
                                <td><?=$order["delivery_date"]?></td>
                                <td><?=$order["point"]?></td>
                                <td><?=$order["name"]?></td>
                                <td><?=$order["status"]?></td>
                                <td><?=$order["delivery_start"]?></td>
                                <td><?=$order["delivery_end"]?></td>
                                <?
                                if ($order["id_status"] == 7)
                                {
                                ?>
                                <form method="post" action="start_delivery.php">
                                    <td><input type="image" name="submit" src="images/logos/edit.ico" title="Начать доставку"></td>
                                    <input type="hidden" name="id_order" value="<?=$order["id_order"]?>">
                                </form>
                                <?}?>
                            </tr>
                        <?}
                        echo "</table>";
                        }?>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="copyright"> &copy; ООО "ЭКОПРОДУКТ" | Система выполнена в качестве дипломного проекта</div>
</body>
</html>