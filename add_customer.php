<?php
    /*Подключаем библиотеки*/
    require "settings_db.php";
    require "lib_db.php";

    $login = clearData($_POST["login"], "string_file");
    $email = clearData($_POST["email"], "string_file");
    $fio = clearData($_POST["fio"], "string_file");
    $phone = clearData($_POST["phone"], "string_file");
    $password = clearData($_POST["password"], "string_file");

    addCustomer($login, $email, $fio, $phone, $password);
    header('Location: customer_auth.php');