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
                            <br><h3><a href="profile_orders.php">Мои заказы</a></h3>
                        </div>
                    </div>
                    <div id="gbox-bot"> </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="copyright"> &copy; ООО "ЭКОПРОДУКТ" | Система выполнена в качестве дипломного проекта</div>
</body>
</html>