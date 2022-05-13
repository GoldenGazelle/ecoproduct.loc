<?php
/*Запускаем сессию*/
session_start();
/*подключение библиотек*/
require "settings_db.php";
require "lib_db.php";
header("Content-Type: text/html; charset=utf-8");
if ($_SESSION["user_type"] != 'admin') unset_session_vars();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Панель администратора</title>
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
                    if (!checkAdminAuth($login, $password)) {;
                    ?>
                    <h2><center>Новые заказы</center></h2>
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <br>
                        <tr>
                            <td align="center"><h3>Детали</h3></td>
                            <td align="center"><h3>Дата</h3></td>
                            <td align="center"><h3>Заказчик</h3></td>
                            <td align="center"><h3>Куда</h3></td>
                        </tr>
                        <?
                        $orders = getNewOrders();
                        foreach($orders as $order)
                        {
                            ?>
                            <tr>
                                <td align="center"><a href="admin_order_details.php?id=<?=$order["id"]?>"><img src="images/logos/edit.ico" alt="edit" /><?=$order["number"]?></a>
                                <td align="center"><?=$order["creation_date"]?></td>
                                <td align="center"><?=$order["fio"]?></td>
                                <td align="center"><?=$order["address"]?></td>
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