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
                    echo "<p>Вы вошли как '$login' | <a href='../exit.php'>Выход</a></p>";
                    echo "<p>Вернуться в <a href='adminform.php'>панель администратора</a></p>";?>

                    <h2><center>Отгрузка товаров</center></h2><br>
                    <table border="0" cellpadding="5" cellspacing="0" width="100%">
                        <tr>
                            <td><h3>Номер</h3></td>
                            <td><h3>Дата доставки</h3></td>
                            <td><h3>Город</h3></td>
                            <td><h3>Регион</h3></td>
                            <td><h3>Начало отгрузки</h3></td>
                            <td><h3>Конец отгрузки</h3></td>
                            <td><h3>Транспорт</h3></td>
                            <td width=25></td>
                        </tr>
                        <?
                        $orders_in_process = getOrdersInProcess();
                        foreach($orders_in_process as $order)
                        {
                            $transports = getTransportForOrder($order["id_order"]);
                        ?>
                            <tr>
                                <td><a href="order_details.php?id=<?=$order["id_order"]?>&status=<?=$order["id_status"]?>"><?=$order["number"]?></a></td>
                                <td><?=$order["delivery_date"]?></td>
                                <td><?=$order["point"]?></td>
                                <td><?=$order["region"]?></td>
                                <td><?=$order["shipment_start_date"]?></td>
                                <td><?=$order["shipment_end_date"]?></td>
                                <form method="post" action="set_transport.php">
                                <td>
                                    <?
                                    if ($order["id_status"] == 2)
                                    {
                                        echo "<select name='id_transport'>";
                                        foreach ($transports as $transport)
                                            if ($transport["id_status"] == 1 || $transport["id_status"] == 2)
                                                echo "<option value='$transport[id]'>$transport[name]</option>";
                                        echo "</select>";
                                    }
                                    else echo $order["name"];
                                    ?>
                                </td>
                                <?
                                $res = isTransportSetForOrder($order["id_order"]);
                                if (!$res) {
                                ?>
                                <td><input type="image" name="submit" src="images/logos/edit.ico" title="Сохранить транспорт"></td>
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