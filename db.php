<?php 
    try{
        define('DB_HOST', 'localhost'); //Адрес
        define('DB_USER', 'root'); //Имя пользователя
        define('DB_PASSWORD', ''); //Пароль
        define('DB_NAME', 'webexam'); //Имя БД
        // $mysql = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        $link = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    } catch (Exception $e){
        print ("Ошика подключения к бд");
    }   
?>