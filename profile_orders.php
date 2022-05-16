<?php
/*Запускаем сессию*/
session_start();
/*подключение библиотек*/
require "settings_db.php";
require "lib_db.php";
header("Content-Type: text/html; charset=utf-8");
if (empty($_SESSION['auth']))
{
    $_SESSION['last_page'] = basename(__FILE__);
    header('Location: customer_auth.php');
}
$user = getUser($_SESSION['id']);
$fio = $user[0]['fio'];

//$datetime = date_create_from_format("Y-m-d H:i:s", "2022-05-14 22:50:29");
//echo $datetime->format("Y-m-d")

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Профиль</title>
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
                        <?php print_customer_header(); ?>
                    </ul>
                    <div class="clear"> </div>
                </div>
                <div id="gbox">
                    <div id="gbox-top"> </div>
                    <div id="gbox-bg">
                        <div id="gbox-grd">
                            <h3>Вы вошли как <?= $fio ?>. <a href="exit.php">Выход</a></h3>
                            <br><h3 align="center">Заказы</h3>
                            <table border="0" cellpadding="3" cellspacing="0" width="100%">
                                <tr>
                                    <th><h4>Дата создания</h4></th>
                                    <th><h4>Дата доставки</h4></th>
                                    <th><h4>Адрес</h4></th>
                                    <th><h4>Сумма</h4></th>
                                    <th><h4>Статус</h4></th>
                                </tr>
                                <?
                                $orders = getOrdersForProfile($_SESSION["id"]);
                                foreach($orders as $order){
                                    ?>
                                    <tr>
                                        <td><?=$order["creation_date"]?></td>
                                        <td><?=$order["delivery_date"]?></td>
                                        <td><?=$order["address"]?></td>
                                        <td><?=$order["summa"]?> у.е.</td>
                                        <td><?=$order["status"]?></td>
                                        <?
                                        echo "<td>
                                                <a href='order_details.php?id=$order[id]&status=$order[id_status]'>Детали</a>
                                              </td>";
                                        ?>
                                    </tr>
                                <?}?>
                            </table>
                        </div>
                    </div>
                    <div id="gbox-bot"> </div>
                </div>
                <div id="greybox">
                    <div id="greybox-bot">
                        <div id="greybox-top">
                            <h2>ХОТИТЕ УЗНАТЬ СТОИМОСТЬ ДОСТАВКИ ВАШИХ ПРОДУКТОВ? </h2>
                            <p><a href="calc.php">Подробнее</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="copyright"> &copy; ООО "ЭКОПРОДУКТ" | Система выполнена в качестве дипломного проекта</div>
</body>
</html>