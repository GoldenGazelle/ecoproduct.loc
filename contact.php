<?php 
/*подключение библиотек*/
require "settings_db.php";
require "lib_db.php";
header("Content-Type: text/html; charset=utf-8");
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
            <li><a href="find.php">Найти груз</a></li>
            <li><a href="calc.php">Калькулятор</a></li>
            <li><a href="order.php">Оформить доставку</a></li>
            <li><a href="contact.php">Контакты</a></li>
          </ul>
          <div class="clear"> </div>
        </div>
        <div id="gbox">
          <div id="gbox-top"> </div>
          <div id="gbox-bg">
            <div id="gbox-grd">
              <h2>Контактные данные ООО "ЭКОПРОДУКТ"</h2>
              <p>Адрес: Республика Беларусь,</p>
              <p>г. Минск, улица Якуба Колоса, 28.</p>
              <p>Телефоны:</p>
              <p>+375 17 293-89-97</p>
			  <p>+375 17 293-23-66</p>
			  <p>293-89-77</p>
              <div id="features">
                <h2>Основные возможности системы</h2>
                <ul>
                  <li><a href="news.php">Новости компании</a></li>
                  <li><a href="calc.php">Калькулятор доставки</a></li>
                </ul>
                <ul>
                  <li><a href="order.php">Оформление заявки</a></li>
                  <li><a href="find.php">Найти груз</a></li>
                </ul>
                <div class="clear"> </div>
              </div>
              <div id="newsorder">
                <h2>НАЙТИ ГРУЗ</h2>
                <form action="find.php" method="get" accept-charset="utf-8">
                  <input type="text" class="text" name="norder" value="" />
                  <input type="submit" value="НАЙТИ">
                </form>
                <p><a href="contact.php">Данные для связи с Нами!</a></p>
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
