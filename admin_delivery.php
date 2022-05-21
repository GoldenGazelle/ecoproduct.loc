<?php
/*Запускаем сессию*/
session_start();
/*подключение библиотек*/
require "settings_db.php";
require "lib_db.php";
header("Content-Type: text/html; charset=utf-8");
getDeliveries();
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
                            <td><h3>Дата доставки</h3></td>
                            <td><h3>Город</h3></td>
                            <td><h3>Транспорт</h3></td>
                            <td><h3>Заказы</h3></td>
                            <td><h3>Статус</h3></td>
                            <td><h3>Дата начала</h3></td>
                            <td><h3>Дата завершения</h3></td>
                            <td width=25></td>
                        </tr>
                        <?
                        $deliveries = getDeliveries();
                        foreach ($deliveries as $date => $routes)
                        {
                            echo "<tr><td>$date</td>";
                            $deliv_start = null;
                            $deliv_end = null;
                            $orders_statuses = array();
                            $orders_ids = array();
                            foreach ($routes as $id_route => $transports)
                            {
                                $route = getPoint2($id_route);
                                $id_point_2 = $route["idpoint2"];
                                $point = $route["point"];
                                echo "<td>$point</td>";
                                foreach ($transports as $id_transport => $orders)
                                {
                                    $sql = "SELECT t.name, ts.name as status FROM transport t JOIN transport_statuses ts ON t.id_status = ts.id WHERE t.id = $id_transport";
                                    $res = mysql_query($sql) or die(mysql_error());
                                    $transport = dataBaseToArray($res);
                                    $transport_name = $transport[0]["name"];
                                    $transport_status = $transport[0]["status"];
                                    echo "<td>$transport_name</td>";
                                    echo '<td>';
                                    foreach ($orders as $id_order)
                                    {
                                        $order = getOrder($id_order);
                                        $order = $order[0];
                                        $orders_statuses[] = $order["id_status"];
                                        $orders_ids[] = $id_order;
                                        echo "<a href='order_details.php?id=$order[id]&status=$order[id_status]'>$order[number]</a><br>";
                                        $sql = "SELECT delivery_start, delivery_end FROM delivery WHERE id_order = $id_order";
                                        $res = mysql_query($sql) or die(mysql_error());
                                        $delivery = dataBaseToArray($res);
                                        $deliv_start = $delivery[0]["delivery_start"];
                                        $deliv_end = $delivery[0]["delivery_end"];
                                    }
                                    echo '</td>';
                                    if ($transport_status == 'Свободен')
                                        echo "<td>Доставлен</td>";
                                    else
                                        echo "<td>$transport_status</td>";
                                }
                            }
                            echo "<td>$deliv_start</td><td>$deliv_end</td>";
                            if (count(array_unique($orders_statuses)) == 1 AND in_array(7, array_unique($orders_statuses)))
                            {
                                ?>
                                <form method="post" action="start_delivery.php">
                                    <td><input type="image" name="submit" src="images/logos/edit.ico" title="Начать доставку"></td>
                                    <input type="hidden" name="orders_ids" value=<?=serialize($orders_ids)?>>
                                </form>
                            <?}
                            echo "</tr>";
                        }
                    }?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="copyright"> &copy; ООО "ЭКОПРОДУКТ" | Система выполнена в качестве дипломного проекта</div>
</body>
</html>