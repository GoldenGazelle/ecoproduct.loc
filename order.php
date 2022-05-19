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

$addresses = getCustomerAddresses($_SESSION["id"]);
if (empty($addresses))
{
    header("Location: add_address.php");
}
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
                    echo "Ваша корзина пуста. Выберите товары в <a href='product.php'>каталоге</a>";
                }
                else
                {?>
                <h3 align='center'>Подтверждение заказа</h3><br>
                <table border="0" cellpadding="3" cellspacing="0" width="100%">
                    <tr>
                        <td><h4>Товар</h4></td>
                        <td><h4>Кол-во</h4></td>
                        <td><h4>Цена</h4></td>
                    </tr>
                    <?
                    $goods = myBasket();
                    $sum = 0;
                    foreach($goods as $item)
                    {
                        ?>
                        <tr>
                            <td><?=$item["name"]?></td>
                            <td><?=$item["quantity"]?>у.е.</td>
                            <td><?=$item["price"]?>р.</td>
                        </tr>
                        <?
                        $sum += $item["price"]*$item["quantity"];
                    }
                    ?>
                </table>
                <h3>Всего товаров на сумму: <?=$sum?> руб. </h3>

                <table border="0" cellpadding="3" cellspacing="0" width="100%">
                    <tr>
                        <td>
                            <form id="SAVE_ORDER" action='save_order.php' method='POST'>
                                <select name='id_address' size='1' style='width:313px;'>
                                    <?
                                    $items = "<option value='vse'>Выберите адрес доставки</option>";
                                    foreach($addresses as $address)
                                    {
                                        $items .= "<option value='".$address['id']."'>".$address["address"]."</option>";
                                    }
                                    echo $items;
                                    ?>
                                </select>
                            <a href="add_address.php"><img height="15" src="images/logos/add.png" alt="add"/></a>
                                <p><input type="date" name="delivery_date"></p>
                                <p><input type="time" name="delivery_time"></p>
                            </form>

                    </tr>
                    <tr><td><input type='submit' value='Заказать' form="SAVE_ORDER"></td><td></td></tr>
                </table>

                <?}?>
              <div class="clear"><br> Телефоны: +375 17 293-89-97, +375 17 293-23-66, 293-89-77</div>
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
