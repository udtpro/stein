<?php
include_once('system.php');

if(isset($_COOKIE['session'])){
    $session = validate($_COOKIE['session'], $mysqli, 0); 
    $session = mysqli_real_escape_string($mysqli, $session);
    $query = mysqli_query($mysqli, "SELECT * FROM `users` WHERE `last_session`='$session'");
    if(mysqli_num_rows($query) < 1) {
     header("Location: index.php");
        
    }
}
    
elseif (isset($_GET['getsess'])){
    $session = validate($_GET['getsess'], $mysqli, 0); 
    $session = mysqli_real_escape_string($mysqli, $session);
    
    $query = mysqli_query($mysqli, "SELECT * FROM `users` WHERE `last_session`='$session'");
    if(mysqli_num_rows($query) < 1) {
      header("Location: index.php");
        
    }
    }
else {
    header("Location: index.php");
}
    
$getsession = $_COOKIE['session'];
?>