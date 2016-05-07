<?php
// System
$date = date('Y-n-d h:i a');

// Function

function validate($data, $mysqli, $type){
    if($type == 0){
        $data = htmlspecialchars($data);
        $data = mysqli_real_escape_string($mysqli, $data);
        return $data;
    }
    elseif($type == 1){
        $data = mysqli_real_escape_string($mysqli, $data);
        return $data;
    }
}

function getname($id){
    global $mysqli;
    $id = validate($id, $mysqli, 0);
    $res = mysqli_query($mysqli, "SELECT * FROM `users` WHERE id = $id");
    $row = mysqli_fetch_assoc($res);
    $name = $row['name'];
    return $name;
}
function getcategory($id){
    global $mysqli;
    if ($id == 0){
       $id = 1; 
    }
    $id = validate($id, $mysqli, 0);
    $res = mysqli_query($mysqli, "SELECT * FROM `category` WHERE id = $id");
    $row = mysqli_fetch_assoc($res);
    $name = $row['category'];
   return $name;
}

function typepost(){
    global $mysqli;
    $type = 'type';
    $type_blog = mysqli_query($mysqli, "SELECT value FROM `system` WHERE `key` ='$type'");
    $type_blog = mysqli_fetch_assoc($type_blog);

    if ($type_blog['value'] == 'micro'){
        $type = 'micro';
    }
    else {
        $type = 'blog';
    }
    return $type;
    }
function numpost(){
    global $mysqli;
    $type = 'numpost';
    $num = mysqli_query($mysqli, "SELECT value FROM `system` WHERE `key` ='$type'");
    $num = mysqli_fetch_assoc($num);
    $num = $num['value'];
    return $num;
}
function generate_password($number)  
  {  
    $arr = array('a','b','c','d','e','f',  
                 'g','h','i','j','k','l',  
                 'm','n','o','p','r','s',  
                 't','u','v','x','y','z',  
                 'A','B','C','D','E','F',  
                 'G','H','I','J','K','L',  
                 'M','N','O','P','R','S',  
                 'T','U','V','X','Y','Z',  
                 '1','2','3','4','5','6',  
                 '7','8','9','0','.',',',  
                 '(',')','[',']','!','?',  
                 '&','^','%','@','*','$',  
                 '<','>','/','|','+','-',  
                 '{','}','`','~');  
    // Генерируем пароль  
    $pass = "";  
    for($i = 0; $i < $number; $i++)  
    {  
      // Вычисляем случайный индекс массива  
      $index = rand(0, count($arr) - 1);  
      $pass .= $arr[$index];  
    }  
    return $pass;  
  }  

function cookie($name, $value){
    setcookie($name, $value, time() + 6000, "/");
}

function hashpassword($password){
    global $solt;
    $password = md5(md5($password).$solt);
    return $password;
}

function generatecapcha(){
    $capcha = rand();
    setcookie("c", "$capcha", time() + 6000, "/");
    return $capcha;
}

function generatesession($user, $password){
    global $date;
    global $solt;
    $session = $user.$password.$date;
    $session = md5(md5($session).$solt);
    return $session;
}

// Return value of table "settings"
function getSettings($key){
    global $mysqli;
    $key = validate($key, $mysqli, 0);
    $settings = mysqli_query($mysqli, "SELECT value FROM `system` WHERE `key` ='$key'");
    $settings = mysqli_fetch_assoc($settings);
    $settings = $settings['value'];
    return $settings;
}
?>