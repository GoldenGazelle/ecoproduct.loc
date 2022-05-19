<?php
/*Запускаем сессию*/
session_start();
/*подключение библиотек*/
require "settings_db.php";
require "lib_db.php";
header("Content-Type: text/html; charset=utf-8");
$_SESSION['last_page'] = __FILE__;
if ($_SESSION["user_type"] == 'admin') unset_session_vars();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Доставка продуктов ЭКОПРОДУКТ</title>
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
              <li><a href="news.php">Новости</a></li>
              <li><a href="product.php">Продукты</a></li>
              <li><a href="profile.php">Профиль</a></li>
              <li><a href="basket.php">Корзина</a></li>
          </ul>
          <div class="clear"> </div>
        </div>
        <div id="gbox">
          <div id="gbox-top"> </div>
          <div id="gbox-bg">
            <div id="gbox-grd">
              <h2>Добро пожаловать в ООО "ЭКОПРОДУКТ! "
                <?php
                if (!empty($_SESSION['id']))
                {
                    $user = getUser($_SESSION['id']);
                    echo $user['fio'];
                }
                ?>
              </h2>
              <p>В нашей системе Вы можете рассчитать стоимость доставки продуктов с помощью <a href="calc.php">калькулятора</a> в любое время.</p>
              <p>Вы можете оформить заявку на доставку продуктов, заполнив данные в <a href="order.php">форме</a>. Это поможет съэкономить Ваше время.</p>
              <p>В течение двух часов наш менеджер свяжется с Вами для присвоения номера заказа. Он также раскажет Вам как оформить и оплатить заказ в офисе компании.</p>
              <div id="features">
                <h2>Выберите действие</h2>
                <ul>
                  <li><a href="news.php">Новости компании</a></li>
                </ul>
                <ul>
                  <li><a href="order.php">Оформление заявки</a></li>
                </ul>
                <div class="clear"> </div>
              </div>
              <div id="newsorder">
                <p><a href="contact.php">Данные для связи с Нами</a></p>
              </div>
              <div id="events">
                <h2>НОВОСТИ</h2>
                <ul>
					<?php			  
				  		$news = selectNew();
						$ii = 0;
						foreach($news as $item){						
							echo "<li><a href='news.php'>$item[title]</a></li>";
							$ii++;
							if ($ii == 5) break;
						}?>			
                </ul>
              </div>
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
