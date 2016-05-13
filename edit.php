<?php
include_once('sql.php');
include_once('include/php/cookie.php');


if (isset($_GET['post'])){
            $post = $_GET['post'];
            $res = mysqli_query($mysqli, "SELECT * FROM `posts` WHERE id = $post ");
            $row = mysqli_fetch_assoc($res);
            $type = 'post';   
}
    
elseif (isset($_GET['block'])){    
            $block = $_GET['block'];
            $res = mysqli_query($mysqli, "SELECT * FROM `blocks` WHERE id = $block ");
            $row = mysqli_fetch_assoc($res);   
            $type = 'block';      
}

elseif (isset($_GET['category'])){
            $category = $_GET['category'];
            $res = mysqli_query($mysqli, "SELECT * FROM `category` WHERE id = $category ");
            $row = mysqli_fetch_assoc($res);
            $type = 'category';      
}

elseif (isset($_GET['location'])){
            $location = $_GET['location'];
            $res = mysqli_query($mysqli, "SELECT * FROM `blocks_location` WHERE id = $location ");
            $row = mysqli_fetch_assoc($res);
            $type = 'location';      
}

elseif (isset($_GET['page'])){   
            $page = $_GET['page'];
            $res = mysqli_query($mysqli, "SELECT * FROM `pages` WHERE id = $page ");
            $row = mysqli_fetch_assoc($res);       
            $type = 'page';         
}

elseif (isset($_GET['users'])){   
            $users = $_GET['users'];
            $res = mysqli_query($mysqli, "SELECT * FROM `users` WHERE id = $users ");
            $row = mysqli_fetch_assoc($res);       
            $type = 'users';         
}
   
else {
            header('Location: '.$_SERVER['HTTP_REFERER']);
}


    
    
    

 
    


    ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>SCMS|Edit</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="ckeditor/ckeditor.js" type="text/javascript"></script>

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

<div class="page-header">
 
  <h1>Панель управления<br> <small>Редактирование</small></h1>
</div>

                <div class="row">
                 
                  <div class="col-xs-12 col-sm-8 col-md-8">
                  
                  
             <?php
              
           if($type == 'post') { 
              
            echo  "<form method='post' action=\"update.php\">";
                   
                   $getSettingsType = getSettings('type');
               if ($getSettingsType == 'blog'){
                echo "<label for='title'>Название:</label><input type=\"text\" class=\"form-control\" placeholder=\"Введите название статьи\" name='title' id='title' value='".$row['title']."'>
                 <br> ";
        }
        else {
                echo "<input type=\"hidden\" class=\"form-control\" placeholder=\"Введите название статьи\" name='title' id='title' value='".$row['title']."'>
               ";
        }
                   
                   
                echo "
                  <br> <label for='date'>Дата и время:</label>
                  <input type=\"text\" class=\"form-control\" value='".$row['date']."' name='date' id='date'>
<br> <label for='category'>Выбор категории:</label> 
        <select class=\"form-control\" id='category' name='category'>";
                 
               $category = mysqli_query($mysqli, "SELECT * FROM `category` ORDER BY `id`") or die(mysqli_error());

               while($row2 = mysqli_fetch_array($category)){
              echo "<option value = '".$row2['id']."'>".$row2['category']."</option>";
               }
        echo "
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
                 ".$row['annonce']."
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
                 ".$row['content']."
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
      
       
      <center>
      <input type=\"hidden\" value='".$post."' name='id'>
      <input type=\"hidden\" value=\"post\" name='type'>
      <input type=\"submit\"  class='btn btn-default' value='Сохранить редактирование'>
      </center> 
        </form>";
                }  
        
        elseif($type == 'block'){
            echo "
                      <form method='post' action=\"update.php\">
                    
                  <label for='title'>Название:</label>  
                  <input type=\"text\" class=\"form-control\" placeholder=\"Введите название статьи\" name='name' id='title' value='".$row['name']."'>
                 <br> <label for='category'>Выбор категории:</label> 
        <select class=\"form-control\" id='category' name='location'>";
                 
               $category = mysqli_query($mysqli, "SELECT * FROM `blocks_location` ORDER BY `id`") or die(mysqli_error());

               while($row2 = mysqli_fetch_array($category)){
              echo "<option value = '".$row2['id']."'>".$row2['description']."</option>";
               }
        echo "
        </select>
      <br>
               
                   <label for='editor1'>Контент:</label> 
            <textarea name=\"content\" id=\"editor1\" rows=\"10\" cols=\"80\">
                 ".$row['content']."
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
       
      <center>
      <input type=\"hidden\" value='".$block."' name='id'>
      <input type=\"hidden\" value=\"block\" name='type'>
      <input type=\"submit\"  class='btn btn-default' value='Сохранить редактирование'>
      </center> 
        </form>
                  ";
        }
        elseif($type == 'category'){
            echo "
                      <form method='post' action=\"update.php\">
                    
                  <label for='title'>Название:</label>  
                  <input type=\"text\" class=\"form-control\" placeholder=\"Введите название статьи\" name='category' id='title' value='".$row['category']."'>
                  
               
                   <label for='editor1'>Контент:</label> 
            <textarea name=\"description\" id=\"editor1\" rows=\"10\" cols=\"80\">
                 ".$row['description']."
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
       
      <center>
      <input type=\"hidden\" value='".$category."' name='id'>
      <input type=\"hidden\" value=\"category\" name='type'>
      <input type=\"submit\"  class='btn btn-default' value='Сохранить редактирование'>
      </center> 
        </form>
                  ";
        }
        
        
        elseif($type == 'location'){
            echo "
                      <form method='post' action=\"update.php\">
                    
                  <label for='title'>Название:</label>  
                  <input type=\"text\" class=\"form-control\" placeholder=\"Введите название статьи\" name='description' id='title' value='".$row['description']."'>
                  
               
        
     
      <br>
       
      <center>
      <input type=\"hidden\" value='".$location."' name='id'>
      <input type=\"hidden\" value=\"location\" name='type'>
      <input type=\"submit\"  class='btn btn-default' value='Сохранить редактирование'>
      </center> 
        </form>
                  ";
        }
        
        
        
         elseif($type == 'page'){
            echo " <form method='post' action=\"update.php\">
                    
                  <label for='title'>Название:</label>  
                  <input type=\"text\" class=\"form-control\" placeholder=\"Введите название статьи\" name='title' id='title' value='".$row['title']."'>
                  <br> <label for='date'>Дата и время:</label>
                  <input type=\"text\" class=\"form-control\" value='".$row['date']."' name='date' id='date'>
<br>
                   <label for='editor1'>Анонс:</label> 
            <textarea name=\"content\" id=\"editor1\" rows=\"10\" cols=\"80\">
                 ".$row['content']."
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
       
      <center>
      <input type=\"hidden\" value='".$page."' name='id'>
      <input type=\"hidden\" value=\"page\" name='type'>
      <input type=\"submit\"  class='btn btn-default' value='Сохранить редактирование'>
      </center> 
        </form>";
        }
        elseif($type == 'users'){
            echo " <form method='post' action=\"update.php\">
                    
                  <label for='user'>Имя:</label>  
                  <input type=\"text\" class=\"form-control\" placeholder=\"Введите название статьи\" name='user' id='user' value='".$row['user']." ' disabled>
                  <br> <label for='password'>Пароль:</label>
                  <input type=\"text\" class=\"form-control\" name='password' id='password'>

                   
     
      <br>
       
      <center>
      <input type=\"hidden\" value='".$users."' name='id'>
      <input type=\"hidden\" value=\"users\" name='type'>
      <input type=\"submit\"  class='btn btn-default' value='Сохранить редактирование'>
      </center> <br>
        </form>";
        }
        
               ?>       
 
                  </div>
                  
                  
                  <div class="col-xs-6 col-sm-4 col-md-4">
                  
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        Уведомление
                      </div>
                      <div class="panel-body">
                          <p>Сделайте резервную копию и запишите новый пароль заранее!</p>
                      </div>
                    </div>
                    
                    
                    
                    
                    </div>
                </div>
                
                
      <div class="panel-footer" style="margin-top: 20px;">
 
        <?php
          include('include/html/footer.php')
    ?>
 
      </div>

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    
  </body>
</html>
