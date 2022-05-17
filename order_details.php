<?php
/*Запускаем сессию*/
session_start();
/*подключение библиотек*/
require "settings_db.php";
require "lib_db.php";

$id_order = clearData($_GET["id"], "i");
$id_status = clearData($_GET["status"], "i");
$goods = getOrdersSPByOrder($id_order);
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
                        <?
                        if ($_SESSION["user_type"] == 'admin')
                            echo "<li><a href='index.php'>Главная</a></li>";
                        else print_customer_header();
                        ?>
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
                        echo "<p>Вернуться в <a href='adminform.php'>панель администратора</a></p>";
                        echo "<h2><center>Проверка заказа</center></h2>";
                    }?>
                    <table border="0" cellpadding="0" cellspacing="0" width="50%">
                        <tr>
                            <td align="center"><h3>Продукт</h3></td>
                            <td align="center"><h3>Количество</h3></td>
                            <td align="center"><h3>Цена</h3></td>
                        </tr>
                        <?
                        $sum = 0;
                        foreach ($goods as $good)
                        {
                            $sum += $good["summa"];
                            echo "<tr>
                                    <td align='center'>$good[name]</td>
                                    <td align='center'>$good[quantity]</td>
                                    <td align='center'>$good[summa]</td>
                                  </tr>";
                        }
                        ?>
                    </table>
                    <h3>Всего товаров на сумму: <?=$sum?> руб.</h3>
                    <br>
                    <?
                    if ($_SESSION["user_type"] == 'admin')
                        echo "<form action='add_nakl.php' method='post'>
                                <input type='submit' name='submit' value='Подтвердить'>
                                <input type='hidden' name='id_order' value='$id_order'>
                              </form>";
                    if ($id_status == 1)
                        echo "<form action='decline_order.php' method='post'>
                                <input type='submit' value='Отклонить'>
                                <input type='hidden' name='id_order' value='$id_order'>
                              </form>"

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="copyright"> &copy; ООО "ЭКОПРОДУКТ" | Система выполнена в качестве дипломного проекта</div>
</body>
</html>