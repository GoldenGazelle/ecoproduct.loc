<?php   
/*Запускаем сессию*/
session_start();
/*подключение библиотек*/
require "settings_db.php";
require "lib_db.php";

unset($_SESSION['password']);
unset($_SESSION['login']); 
unset($_SESSION['id']);
echo "<meta http-equiv='Refresh' content='0; URL=index.php'>";	
?>