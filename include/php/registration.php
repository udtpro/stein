<head>
    <meta charset="utf-8">
</head>
<?php

include_once('../../sql.php');
include_once('cookie.php');

// Страница регистрации нового пользователя

# Соединямся с БД


if(isset($_POST['user']) and isset($_POST['password']) and isset($_POST['capcha']) and isset($_COOKIE['c'])){

    $err = array();

    # проверям логин
 /*   if(!preg_match("/^[a-zA-Z0-9а-яА-Я]+$/",$_POST['name']))
    {
        $err[] = "Имя может состоять только из букв английского алфавита и цифр";
    } */

    if(strlen($_POST['user']) < 3 or strlen($_POST['user']) > 30)
    {
        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
    }

    # проверяем, не сущестует ли пользователя с таким именем
    
    $user = mysqli_real_escape_string($mysqli, $_POST['user']);
    
    $query = mysqli_query($mysqli, "SELECT * FROM `users` WHERE `user`='$user'");
    
    if(mysqli_num_rows($query) > 0)
    {
        $err[] = "Пользователь с такой почтой уже существует в базе данных";
    }

    # Если нет ошибок, то добавляем в БД нового пользователя
    if(count($err) == 0)
    {
        
    $capcha = $_COOKIE['c'];
    $capcha2 = $_POST['capcha'];
    
    if($capcha == $capcha2){
        $user = validate($_POST['user'], $mysqli, 0);
        $password = validate($_POST['password'], $mysqli, 0);
        $password = hashpassword($password);
        mysqli_query($mysqli, "INSERT INTO `users`(`id`, `user`, `hash`, `date`, `last_session`) VALUES ('','$user','$password','$date','')");
        header("Location: ../../panel.php");
    }
    }
    else
    {
        print "<b>При регистрации произошли следующие ошибки:</b><br>";
        foreach($err AS $error)
        {
            print $error."<br>";
        }
    }
}
    
?>

