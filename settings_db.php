<?php  
header("Content-Type: text/html; charset=utf-8");
/*Адрес сервера*/
define("DB_HOST", "localhost");
/*Логин для соединения с базой*/
define("DB_LOGIN", "root");
/*Пароль для соединения с базой*/
define("DB_PASSWORD", "");
/*Имя базы данных*/
define("DB_NAME", "ECOPRODUCT2");
  
/*Устанавливаем соединение с сервером базы данных*/
mysql_connect(DB_HOST, DB_LOGIN, DB_PASSWORD) or die("Не могу соединиться с сервером базы данных!");
/*Выбираем базу данных*/
mysql_select_db(DB_NAME) or die(mysql_error());
?>
