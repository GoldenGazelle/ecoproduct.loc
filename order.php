<?php
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

$error = $_GET['error'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Оформление заявки в ТК КУРЬЕР</title>
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
                <?php
                $basket = myBasket();
                if (empty($basket))
                {
                    echo "Ваша корзина пуста. Выберите товары в <a href='catalog.php'>каталоге</a>";
                }
                else
                    {
                ?>
                    <h2><center>Введите параметры доставки</h2>
                    <table align="center">
                    <form action="save_order.php" method="POST">
                    <tr><td><h3>ФИО заказчика: <input type="text" name="fio" size="44"></h3></td>
                    <tr><td><h3>Телефон для связи: <input type="text" name="phone" size="44"></h3></td>
                    <?
                    $items = "<tr><td><h3>Город:</h3><select name='idpoint2' size='1' style='width:313px;'>
                        <option value='vse'>Выберите из списка</option>";
                    $points = getPoint();
                    foreach($points as $point)
                    {
                        $items .= "<option value='".$point['id']."'>".$point['point']."</option>";
                    };
                    $items .= "</select></td>";
                    echo $items;


                    ?>
                        <tr><td><h3>Улица: <input type="text" name="ul" size="44"></h3></td>
                        <tr><td><h3>Номер дома: <input type="text" name="house" size="44"></h3></td>
                            <?php if(!empty($error)): ?>
                            <?php if($error == "no_distance"): ?>
                                <p class="error">Приносим свои извенения, но данный маршрут временно не обслуживается.</p>
                            <?php elseif($error == "small_distance"): ?>
                                <p class="error">Доставка авиасообщением по данному маршруту невозможна.</p>
                            <?php endif; ?>
                            <tr><td></td></tr>
                        <?php endif; ?>
                    <tr><td align="center" colspan="2"><input type="submit" value="Заказать" name="submit"></td></tr>
                    </form>
                    </table>
				<? } ?>
              <div class="clear"><br> Телефоны: +375 17 293-89-97, +375 17 293-23-66, 293-89-77</div>
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
