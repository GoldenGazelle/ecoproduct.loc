<?
/*Запускаем сессию*/
session_start();
/*подключение библиотек*/
require "settings_db.php";
require "lib_db.php";
header("Content-Type: text/html; charset=utf-8");

	$login = $_SESSION['login'];
	$password = $_SESSION['password'];
		
	if(empty($login) and empty($password))
	{
		echo "<h2>Ошибка!</h2>";
		echo "<p>Необходимо пройти авторизацию | <a href='adminform.php'>Вход</a></p>";						
	}
	else
	{
		echo "<p>Вы вошли как '$login' | <a href='exit.php'>Выход</a></p>";
		echo "<p>Вернуться в <a href='adminform.php'>панель администратора</a></p>";					

		$xml = new XMLWriter(); 
		$xml->openURI('test.xml');//openMemory(); 
		$xml->startDocument("1.0"); 
		$xml->startElement("orders"); //создание корневого узла
		$items = getOrders('',' AND number>0');					
		foreach($items as $item)
		{
			$xml->startElement("order");
			$xml->writeElement("number", $item["number"]);
			$xml->writeElement("date_format", $item["date_format"]); //запись элемента
			$xml->writeElement("fio", $item["fio"]);
			$xml->writeElement("type", $item["type"]);
			$xml->writeElement("point1", $item["point1"]);
			$xml->writeElement("point2", $item["point2"]);
			$xml->endElement();
		}
		$xml->endElement(); //закрытие корневого элемента
		$xml->endDocument();
		$xml->flush();
		echo "<p>Просмотреть <a href='test.xml'>XML файл</a></p>"; 
	}
?>