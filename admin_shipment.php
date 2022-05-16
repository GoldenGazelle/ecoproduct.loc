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

                    <h2><center>Отгрузка товаров</center></h2>
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td width=25></td>
                            <td><h3>Номер</h3></td>
                            <td><h3>Дата доставки</h3></td>
                            <td><h3>Город</h3></td>
                            <td><h3>Регион</h3></td>
                            <td><h3>Транспорт</h3></td>
                        </tr>
                        <?
                        $nakls = getNaklsForShipment();
                        foreach($nakls as $nakl)
                        {?>
                            <tr>
                                <td><a href="edit_tripf.php?id=<?=$nakl["id_order"]?>"><img src="images/logos/edit.ico" alt="edit" /></a></td>
                                <td><a href="order_details.php?id=<?=$nakl["id_order"]?>&status=<?=$nakl["id_status"]?>"><?=$nakl["number"]?></a></td>
                                <td><?=$nakl["delivery_date"]?></td>
                                <td><?=$nakl["region"]?></td>
                                <td><?=$nakl["point"]?></td>
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