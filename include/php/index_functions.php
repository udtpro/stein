<?php
include_once('sql.php');
$id = 1;
$res = mysqli_query($mysqli, "SELECT * FROM `settings` WHERE id ='$id'");
$row = mysqli_fetch_assoc($res);




?>