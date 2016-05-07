<head>
    <meta charset="utf-8">
</head>
<?php
include_once('../../sql.php');
include_once('system.php');
 if (isset($_POST['login']) and isset($_POST['password'])){
    $post_pass = $_POST['password'];
    $post_login = $_POST['login'];
    $err = array(); 
     
    $password = validate($post_pass, $mysqli, 0); 
    $user = validate($post_login, $mysqli, 0); 
    $user = mysqli_real_escape_string($mysqli, $user);
    
    $query = mysqli_query($mysqli, "SELECT * FROM `users` WHERE `user`='$user'");
     
    if(mysqli_num_rows($query) < 1)
    {
        $err[] = "Такого пользователя нет";
    }
    
    $password = hashpassword($password);
    $query = mysqli_fetch_assoc($query);
    if($password !== $query['hash'])
    {
        $err[] = "Неверный пароль";
    }
     
    if(count($err) == 0) {
        $id = $query['id'];
        $session = generatesession($user, $password);
        mysqli_query($mysqli, "UPDATE `users` SET `last_session`='$session' WHERE `id`='$id'");
        cookie('session', $session);
        header("Location: ../../panel.php");
    }   
    
 
 
else {
    print "<b>При авторизации произошли следующие ошибки:</b><br>";
        foreach($err AS $error)
        {
            print $error."<br>";
        }
}
 }
if (isset($_GET['logout'])){
    setcookie("session", "", time() - 6000, "/");
    
    header("Location: ../../index.php");
} 
?>
