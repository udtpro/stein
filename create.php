<?php
include_once('sql.php');
include_once('include/php/cookie.php');

if(isset($_POST['post'])){
  $type = 'post';  
}
elseif(isset($_POST['block'])){
  $type = 'block';    
}
elseif(isset($_POST['category'])){
  $type = 'category';    
}
elseif(isset($_POST['page'])){
  $type = 'page';    
}
elseif(isset($_POST['users'])){
  $type = 'users';    
}
elseif(isset($_POST['location'])){
  $type = 'location';    
}
else {
    $type= '0';
}

if(isset($_GET['post'])){
  $display = 'post';  
}
elseif(isset($_GET['block'])){
  $display = 'block';    
}
elseif(isset($_GET['category'])){
  $display = 'category';    
}
elseif(isset($_GET['page'])){
  $display = 'page';    
}
elseif(isset($_GET['users'])){
  $display = 'users';    
}
elseif(isset($_GET['location'])){
  $display = 'location';    
}
else {
    header('Location: '.$_SERVER['HTTP_REFERER']);
}

switch ($type) {
    case 'post':
       if (isset($_POST['title']) and isset($_POST['annonce']) and isset($_POST['content']) and isset($_POST['date'])){
    
    $title = validate($_POST['title'], $mysqli, 0);
    $annonce = validate($_POST['annonce'], $mysqli, 1);
    $content = validate($_POST['content'], $mysqli, 1);
    $date = validate($_POST['date'], $mysqli, 0);
    if (isset($_POST['preview'])){
       $preview = validate($_POST['preview'], $mysqli, 0); 
    }
    else {
        $preview = '0';
    }
    $user = '1';
    if(isset($_POST['category'])){
    
        $category = validate($_POST['category'], $mysqli, 1);
        
    }
    else {
        $category = 1;
    }
    mysqli_query($mysqli, "INSERT INTO `posts` (`id`, `category`, `title`, `annonce`, `content`, `date`, `user`, `preview`) VALUES (null,'$category','$title','$annonce','$content','$date','$user', '$preview')");
}
        echo 1;
        break;
    case 'block':
    
        
    if (isset($_POST['name']) and isset($_POST['content'])){
    
    $name = validate($_POST['name'], $mysqli, 0);
    
    $content = validate($_POST['content'], $mysqli, 1);
    
    
    
    if(isset($_POST['location'])){
    
        $location = validate($_POST['location'], $mysqli, 1);
        
    }
    else {
        $location = 1;
    }   
    
    
    
    
            mysqli_query($mysqli, "INSERT INTO `blocks` (`id`, `name`, `content`, `location`) VALUES (null,'$name','$content', '$location')");
    }
        break;
    case 'category':
        if (isset($_POST['category']) and isset($_POST['description'])){
    
    $category = validate($_POST['category'], $mysqli, 0);
    
    $description = validate($_POST['description'], $mysqli, 1);
    
  
   
    mysqli_query($mysqli, "INSERT INTO `category` (`id`, `category`, `description`) VALUES (null,' $category','$description')");
}
        break;
    case 'page':
        if (isset($_POST['title']) and isset($_POST['content']) and isset($_POST['date'])){
    
    $title = validate($_POST['title'], $mysqli, 0);
    
    $content = validate($_POST['content'], $mysqli, 1);
    $date = validate($_POST['date'], $mysqli, 0);
  
        $user = '1';
   
    
        $category = '0';
    
    
mysqli_query($mysqli, "INSERT INTO `pages` (`id`, `title`, `content`, `user`, `date`) VALUES (null,'$title','$content','$user','$date')");
}
        break;
    case 'users':
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
        
        mysqli_query($mysqli, "INSERT INTO `users`(`id`, `user`, `hash`, `date`, `last_session`) VALUES (null, '$user','$password','$date','')") or die ('Can\'t use foo : ' . mysqli_error($mysqli));;
        header('Location: '.$_SERVER['HTTP_REFERER']);
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
        break;
    case 'location':
       if (isset($_POST['description'])){
    
$description = validate($_POST['description'], $mysqli, 0);
    
  
   
mysqli_query($mysqli, "INSERT INTO `blocks_location` (`id`, `description`) VALUES ('','$description')");
}
        break;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="demos/Djenx.Explorer/djenx-explorer.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>SCMS| Create</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
   
    <div class="container">
    

    <?php
          include('include/html/navbar.php')
    ?>
    <?php
switch ($display) {
    case 'block':
        echo "
        <div class=\"page-header\">
 
  <h1>Панель управления<br> <small>Создание блока</small></h1>
</div>

                <div class=\"row\">
                 
                  <div class=\"container\">
                  
                     <form method='post' action=\"create.php\">
                    
                  <label for='title'>Название:</label>  
                  <input type=\"text\" class=\"form-control\" placeholder=\"Введите название страницы\" name='name' id='title'>
                  <br> 
                  <label for='select'  >Локация:</label>  
         <select id='select' class=\"form-control\" name='location'>";
                 
                
               $category = mysqli_query($mysqli, "SELECT * FROM `blocks_location` ORDER BY `id`") or die(mysqli_error());

               while($row = mysqli_fetch_array($category)){
              echo "<option value = '".$row['id']."'>".$row['description']."</option>";
               }
            echo "
        </select>
      <br>
                   <label for='editor1'>Текст блока:</label> 
            <textarea name=\"content\" id=\"editor1\" rows=\"10\">
                Введите текст страницы
            </textarea>
            
<script type=\"text/javascript\">

CKEDITOR.replace('editor1',{'filebrowserBrowseUrl':'ckeditor/kcfinder/browse.php?type=files&getsess=".$getsession."',
  'filebrowserImageBrowseUrl':'ckeditor/kcfinder/browse.php?type=images&getsess=".$getsession."',
  'filebrowserFlashBrowseUrl':'ckeditor/kcfinder/browse.php?type=flash&getsess=".$getsession."',
  'filebrowserUploadUrl':'ckeditor/kcfinder/upload.php?type=files&getsess=".$getsession."',
  'filebrowserImageUploadUrl':'ckeditor/kcfinder/upload.php?type=images&getsess=".$getsession."',
  'filebrowserFlashUploadUrl':'ckeditor/kcfinder/upload.php?type=flash&getsess=".$getsession."'});



</script>
     
      <br>
      <input type=\"hidden\" name='block'>
       
      <center>
      <input type=\"submit\"  class='btn btn-default' value='Добавить'>
      </center> 
        </form>
                  
                           
                  
                  
                  
                  
                  
                  
                  
                  </div>
                  
               
                </div>
                
                
      ";
        break;

    case 'category':
        echo "<div class=\"page-header\">
 
  <h1>Панель управления<br> <small>Создание категории</small></h1>
</div>

                <div class=\"row\">
                 
                  <div class=\"container\">
                  
                    <form method='post' action=\"create.php\">
                    
                  <label for='title'>Название:</label>  
                  <input type=\"text\" class=\"form-control\" placeholder=\"Введите название страницы\" name='category' id='title'>
         
       
                   <label for='editor1'>Текст страницы:</label> 
            <textarea name=\"description\" id=\"editor1\" rows=\"10\" cols=\"80\">
                Введите текст страницы
            </textarea>
            <script>
            
     CKEDITOR.replace('editor1',{'filebrowserBrowseUrl':'ckeditor/kcfinder/browse.php?type=files&getsess=".$getsession."',
  'filebrowserImageBrowseUrl':'ckeditor/kcfinder/browse.php?type=images&getsess=".$getsession."',
  'filebrowserFlashBrowseUrl':'ckeditor/kcfinder/browse.php?type=flash&getsess=".$getsession."',
  'filebrowserUploadUrl':'ckeditor/kcfinder/upload.php?type=files&getsess=".$getsession."',
  'filebrowserImageUploadUrl':'ckeditor/kcfinder/upload.php?type=images&getsess=".$getsession."',
  'filebrowserFlashUploadUrl':'ckeditor/kcfinder/upload.php?type=flash&getsess=".$getsession."'});

</script>
     
      <br>
      
       <input type=\"hidden\" name='category'>
      <center>
      <input type=\"submit\"  class='btn btn-default' value='Добавить'>
      </center> 
        </form>
                  
                           
                  
                  
                  
                  
                  
                  
                  
                  </div>
                  
               
                </div>";
        break;

    case 'location':
        echo "<div class=\"page-header\">
 
  <h1>Панель управления<br> <small>Создание локации</small></h1>
</div>

                <div class=\"row\">
                 
                  <div class=\"container\">
                  
                     <form method='post' action=\"create.php\">
                    
                  <label for='title'>Название:</label>  
                  <input type=\"text\" class=\"form-control\" placeholder=\"Введите название страницы\" name='description' id='title'>
         
    
     
      <br>
      <input type=\"hidden\" name='location'>
       
      <center>
      <input type=\"submit\"  class='btn btn-default' value='Добавить'>
      </center> 
        </form>
                  
                           
                  
                  
                  
                  
                  
                  
                  
                  </div>
                  
               
                </div>";
        break;
    case 'page':
        echo "<div class=\"page-header\">
 
  <h1>Панель управления<br> <small>Создание страницы</small></h1>
</div>

                <div class=\"row\">
                 
                  <div class=\"container\">
                  
                     <form method='post' action=\"create.php\">
                    
                  <label for='title'>Название:</label>  
                  <input type=\"text\" class=\"form-control\" placeholder=\"Введите название страницы\" name='title' id='title'>
                  <br> <label for='date'>Дата и время:</label>
                  <input type=\"text\" class=\"form-control\" value='";
            echo $date;
        echo "' name='date' id='date'>
<br> 
       
                   <label for='editor1'>Текст страницы:</label> 
            <textarea name=\"content\" id=\"editor1\" rows=\"10\" cols=\"80\">
                Введите текст страницы
            </textarea>
            <script>
     CKEDITOR.replace('editor1',{'filebrowserBrowseUrl':'ckeditor/kcfinder/browse.php?type=files&getsess=".$getsession."',
  'filebrowserImageBrowseUrl':'ckeditor/kcfinder/browse.php?type=images&getsess=".$getsession."',
  'filebrowserFlashBrowseUrl':'ckeditor/kcfinder/browse.php?type=flash&getsess=".$getsession."',
  'filebrowserUploadUrl':'ckeditor/kcfinder/upload.php?type=files&getsess=".$getsession."',
  'filebrowserImageUploadUrl':'ckeditor/kcfinder/upload.php?type=images&getsess=".$getsession."',
  'filebrowserFlashUploadUrl':'ckeditor/kcfinder/upload.php?type=flash&getsess=".$getsession."'});

</script>
     
      <br>
      
       <input type=\"hidden\" name='page'>
      <center>
      <input type=\"submit\"  class='btn btn-default' value='Добавить'>
      </center> 
        </form>
                  
                           
                  
                  
                  
                  
                  
                  
                  
                  </div>
                  
               
                </div>";
        break;
    case 'post':
        echo "<div class=\"page-header\">
 
  <h1>Панель управления<br> <small>Создание статьи</small></h1>
</div>

                <div class=\"row\">
                 
                  <div class=\"container\">
                  
                    <form method='post' action=\"create.php\">";
                    
                  
                $getSettingsType = getSettings('type');
               if ($getSettingsType == 'blog'){
                echo "<label for='title'>Название:</label><input type=\"text\" class=\"form-control\" placeholder=\"Введите название статьи\" name='title' id='title'>
                 <br> ";
        }
        else {
                echo "<input type=\"hidden\" class=\"form-control\" placeholder=\"Введите название статьи\" name='title' id='title' value='".$date."'>
               ";
        }
       
         echo "
          
           <label for='date'>Дата и время:</label>
                  <input type=\"text\" class=\"form-control\" value='".$date."' name='date' id='date'>
<br> 
        <label for='select'  >Категория:</label>  
         <select id='select' class=\"form-control\" name='category'>";
                 
                 
               $category = mysqli_query($mysqli, "SELECT * FROM `category` ORDER BY `id`") or die(mysqli_error());

               while($row = mysqli_fetch_array($category)){
              echo "<option value = '".$row['id']."'>".$row['category']."</option>";
               }
            echo"
        </select>
      <br>
      ";
        
      $getSettingsPreview = getSettings('images');
        if ($getSettingsPreview == 'on'){
          echo " <label for='preview'>Превью:</label>  
           <input type=\"text\" class=\"form-control\" placeholder=\"Введите ссылку\" name='preview' id='preview'><br>";
       }
        
        
        echo "
                   <label for='editor1'>Анонс:</label> 
            <textarea name=\"annonce\" id=\"editor1\" rows=\"10\" cols=\"80\">
                Введите текст анонса
            </textarea>
            <script>
      CKEDITOR.replace('editor1',{'filebrowserBrowseUrl':'ckeditor/kcfinder/browse.php?type=files&getsess=".$getsession."',
  'filebrowserImageBrowseUrl':'ckeditor/kcfinder/browse.php?type=images&getsess=".$getsession."',
  'filebrowserFlashBrowseUrl':'ckeditor/kcfinder/browse.php?type=flash&getsess=".$getsession."',
  'filebrowserUploadUrl':'ckeditor/kcfinder/upload.php?type=files&getsess=".$getsession."',
  'filebrowserImageUploadUrl':'ckeditor/kcfinder/upload.php?type=images&getsess=".$getsession."',
  'filebrowserFlashUploadUrl':'ckeditor/kcfinder/upload.php?type=flash&getsess=".$getsession."'});

</script>
     <br> <label for='editor2'>Основная статья:</label> 
       <textarea name=\"content\" id=\"editor2\" rows=\"10\" cols=\"80\">
                 Введите текст основной статьи
            </textarea>
            <script>
      CKEDITOR.replace('editor2',{'filebrowserBrowseUrl':'ckeditor/kcfinder/browse.php?type=files&getsess=".$getsession."',
  'filebrowserImageBrowseUrl':'ckeditor/kcfinder/browse.php?type=images&getsess=".$getsession."',
  'filebrowserFlashBrowseUrl':'ckeditor/kcfinder/browse.php?type=flash&getsess=".$getsession."',
  'filebrowserUploadUrl':'ckeditor/kcfinder/upload.php?type=files&getsess=".$getsession."',
  'filebrowserImageUploadUrl':'ckeditor/kcfinder/upload.php?type=images&getsess=".$getsession."',
  'filebrowserFlashUploadUrl':'ckeditor/kcfinder/upload.php?type=flash&getsess=".$getsession."'});

</script>
      <br>
      <input type=\"hidden\" name='post'>
       
      <center>
      <input type=\"submit\"  class='btn btn-default' value='Добавить'>
      </center> 
       
        </form>
                  
                           
                  
                  
                  
                  
                  
                  
                  
                  </div>
                  
               
                </div>";
        break;
    case 'users':
        $capcha = generatecapcha();
        echo "<div class=\"page-header\">
 
  <h1>Панель управления<br> <small>Создание статьи</small></h1>
</div>

                <div class=\"row\">
                 
                  <div class=\"container\">
                  
                    <form method='post' action=\"create.php\">
                    
                    
                    
                    
      
    
    

                    
                  <label for='user'>Логин:</label>  
                  <input type=\"text\" class=\"form-control\" placeholder=\"Введите логин\" name='user' id='user'>
                  <br> <label for='gen'>Генератор:</label>
                  <input type=\"text\" class=\"form-control\"  value='";
                  echo generate_password(10);
                  echo "'  id='gen'>
                  <br> <label for='password'>Пароль:</label>
                  <input type=\"text\" class=\"form-control\"  placeholder=\"Введите свой пароль или сгенерированный выше\" name='password' id='password'>
                  <br><label for='date'>Проверка:</label>
                  <input type=\"text\" class=\"form-control\"  id='user' value='".$capcha."' disabled>
<br>              <input type=\"text\" class=\"form-control\"  name = 'capcha' id='capcha'  placeholder=\"Введите цифры из поля выше\">
                   <input type=\"hidden\" name='users'>
        
         
          
      
      <br>
      
       
      <center>
      <input type=\"submit\"  class='btn btn-default' value='Добавить'>
      </center> 
        </form>
                  
                           
                  
                  
                  
                  
                  
                  
                  
                  </div>
                  
               
                </div>";
        break;
        
}
        
 ?>
  <div class="panel-footer" style="margin-top: 20px;">
 
          <?php
          include('include/html/footer.php')
    ?>
 
      </div>
   </div>

    
    
  </body>
</html>

