<?php  
/*Запускаем сессию*/
session_start();
/*подключение библиотек*/
require "settings_db.php";
require "lib_db.php";
header("Content-Type: text/html; charset=utf-8");

/*Получаем данные из формы*/
$login = clearData($_POST["login"], "string_file");
$password = clearData($_POST["password"], "string_file");
$user_type = clearData($_POST["user_type"], "string_file");

/*Вызываем функцию enter() из нашей библиотеке функций 
для проверки регистрации данного пользователя*/
$result = enter($login, $password, $user_type);
if ($result) header("Location: ". $_SESSION['last_page']);
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
            <?php print_customer_header(); ?>
          </ul>
          <div class="clear"> </div>
        </div>
        <div id="gbox">
          <div id="gbox-top"> </div>
          <div id="gbox-bg">
            <div id="gbox-grd">
                <h2>Авторизация в системе "ЭКОПРОДУКТЫ"</h2>
				<?
                    if (!$result)
                    {
                        echo "<br>Извините, введённый вами логин или пароль неверный.";
                    }
                    else
                    {
                        echo '<br>Вы успешно прошли авторизацию';
                        if ($user_type == 'admin')
                        {
                            echo "<p>Войти в <a href='adminform.php'>Панель администратора</a></a></p>";
                        }
                    }
                ?>

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
<?php
