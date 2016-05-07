<?php
include_once('sql.php');
include_once('include/php/cookie.php');
include_once('include/php/system.php');
if (isset($_POST['brand']) and isset($_POST['title']) and isset($_POST['title_text'])){
    
    $brand = $_POST['brand'];
    $title = $_POST['title'];
    $title_text = $_POST['title_text'];
    $brand = validate($brand, $mysqli, 0);
    $title = validate($title, $mysqli, 0);
    $title_text = validate($title_text, $mysqli, 0);
    $id = 1;
    mysqli_query($mysqli, "UPDATE `settings` SET brand = '$brand', title = '$title', title_text = '$title_text' WHERE id ='$id'");

    header("Location: index.php");
}
$id = 1; 
$res = mysqli_query($mysqli, "SELECT * FROM `settings` WHERE id ='$id'");
$row = mysqli_fetch_assoc($res);
    
    
if(isset($_POST['typepost'])){
    $type = 'type';
    $typepost = validate($_POST['typepost'], $mysqli, 0);
    mysqli_query($mysqli, "UPDATE `system` SET value = '$typepost' WHERE `key` ='$type'");
    cookie('session', $session);
} 

if(isset($_POST['preview'])){
    $type = 'images';
    $preview = validate($_POST['preview'], $mysqli, 0);
    mysqli_query($mysqli, "UPDATE `system` SET value = '$preview' WHERE `key` ='$type'");
    cookie('session', $session);
}

if(isset($_POST['numpost'])){
    $type = 'numpost';
    $numpost = validate($_POST['numpost'], $mysqli, 0);
    mysqli_query($mysqli, "UPDATE `system` SET value = '$numpost' WHERE `key` ='$type'");
}   
    

?>