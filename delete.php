<?php
include_once('sql.php');
include_once('include/php/cookie.php');
function return_type($type){
    if($type == 1){
        $type = 'pages';
        return $type;
    }
    elseif($type == 2){
        $type = 'posts';
        return $type;
    }
    elseif($type == 3){
        $type = 'blocks';
        return $type;
    }
    elseif($type == 4){
        $type = 'category';
        return $type;
    }
    elseif($type == 5){
        $type = 'blocks_location';
        return $type;
    }
    elseif($type == 6){
        $type = 'users';
        return $type;
    }
    else{
        $type = 'notype';
        return $type;
    }
    
}


if(isset($_GET['type']) and isset($_GET['id'])){ // выводит подтверждение на удаление
    $id = $_GET['id'];
    $type_real  =   $_GET['type'];
    $status = 1;
}
else{
    $status = 0;
}
if(isset($_GET['type']) and isset($_GET['id']) and isset($_GET['agree'])){ // удаляет из БД строку + редирект 
    $id = $_GET['id'];
    $type  =    $_GET['type'];
     $type = return_type($type_real);
   mysqli_query($mysqli, "DELETE FROM `$type` WHERE id = $id");
    header('Location: panel.php');
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Blog udt.pro's</title>

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
 
  <h1>Панель управления<br> <small>Крутилки, вертелки</small></h1>
</div>

                <div class="row">
                 
                  <div class="col-xs-12 col-sm-8 col-md-8">
                  
               <?php  if($status !== 0)  {
                    
                    $type = return_type($type_real);
                    if($type !== 'notype'){
                   
                    $res = mysqli_query($mysqli, "SELECT * FROM `$type` WHERE id = $id");
                    $row = mysqli_fetch_assoc($res);
                    
                    
        
        
        
        
                echo" <p>Вы точно хотите удалить '";
                        if ($type == 'blocks'){
                            echo $row['name'];
                        }
                        elseif($type == 'category'){
                            echo $row['category'];
                        }
                        elseif($type == 'blocks_location'){
                            echo $row['description'];
                        }
                        elseif($type == 'users'){
                            echo $row['user'];
                        }
                        else{
                            echo $row['title'];
                        }
                echo "' ?<br> Действие нельзя отменить.</p>
                
                          <form method=\"get\">
                             <input type=\"hidden\" value=\"$type_real\" name=\"type\">
                             <input type=\"hidden\" value=\"$id\" name=\"id\">
                             <input type=\"hidden\" value=\"1\" name=\"agree\">
                              <input type=\"submit\" value=\"Да\">
                          </form>
                          <a href=\"panel.php\"><button>Нет</button></a>
                     ";   }   
        
                  else {
                       echo "<p>Неправильные значения</p>";
               }
        }
        else {
          echo "<p>Нет переданных значений</p>";
        }
           ?>       
                  
                  
                  
                  
                  </div>
                  
                  
                  <div class="col-xs-6 col-sm-4 col-md-4">
                  
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        Статистика
                      </div>
                      <div class="panel-body">
                          <p>WTF MTHFCK</p>
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