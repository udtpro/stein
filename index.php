<?php
include_once('sql.php');
include_once('include/php/index_functions.php');
include_once('include/php/system.php');
if(isset($_GET['page'])){
    $type = 1;
    $page = validate($_GET['page'],$mysqli,0);
}
elseif(isset($_GET['post'])){
    $type = 2;
    $post = validate($_GET['post'],$mysqli,0);
}
else{
    $type = 0;
}

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?=$row['title'];?></title>

    
  </head>
  <body>
   
    <div class="container">
    

    <nav role="navigation" class="navbar navbar-default">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="#" class="navbar-brand"><?=$row['brand'];?></a>
      </div>
      <!-- Collection of nav links, forms, and other content for toggling -->
      <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="index.php">Главная</a></li>
          <li><a href="#">Разделы</a></li>
          <li><a href="index.php?page=1">Проекты</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="login.php">Войти</a></li>
        </ul>
      </div>
    </nav>

<div class="page-header">
 
  <h1><?=$row['title'];?><br> <small><?=$row['title_text'];?></small></h1>
</div>

                <div class="row">
                 
                  <div class="col-xs-12 col-sm-12 col-md-8">
                  
                  
                       <?php
                      
                      
                      if($type == 2){
                                        if($post > 0 and is_numeric($post)){
                    
                                        $res = mysqli_query($mysqli, "SELECT * FROM `posts` WHERE id = $post");
                                        $row = mysqli_fetch_assoc($res);


                                        echo "<h2>".$row['title']."</h2><p>".$row['content']." </p><hr>";
                          
                      }
                      }
                      elseif($type == 1){
                           
                                        if($page > 0 and is_numeric($page)){

                                        $res = mysqli_query($mysqli, "SELECT * FROM `pages` WHERE id = $page");
                                        $row = mysqli_fetch_assoc($res);


                                        echo "<h3>".$row['title']."</h3><p>".$row['content']." </p>";
                }
                      }
                      else{
                            
                            
                            $post_page = numpost();
                            $total_page = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM `posts`"));
                            
                            $total = ceil($total_page / $post_page);
                            
                            if(isset($_GET['p']) and ($_GET['p'] > 0)){
                                $p = $_GET['p'];
                                if($p > $total){
                                    $p = $total;
                                }
                            }
                            else{  
                              $p = $total;  
                            }
                          
                          
                          
                          
                            $maxpost = $p * $post_page;
                            $minpost = $maxpost - $post_page;
                            $oldest = $p - 1;
                            
                            $newest = $p + 1;
                            if ($newest > $total){
                                $newest = $p;
                            }
                            
                            
                                
                                
                                
                            $posts = mysqli_query($mysqli, "SELECT * FROM `posts` WHERE id > $minpost AND id <= $maxpost ORDER BY id DESC");
                            $type = typepost();
                            
                          
                            if ($type == 'micro'){
                                   while($row = mysqli_fetch_array($posts)){
                            
                            
                            echo                            "<div class=\"blog-post\">";
                                                  $getSettingsPreview = getSettings('images');
                                                    if ($getSettingsPreview == 'on'){           
                                                        echo "<div class='preview'><img src=".$row['preview']." width='100%'></div>";
                                                    }
                            echo                             "</p>
                                                              <p>".$row['annonce']."</p>
                                                              
                                                              
                                <p class=\"blog-post-meta\"><small>".$row['date']." by ";
                             
                        
                                                             if($row['user'] == 1){
                                                                 echo 'udt';
                                                             };
                                      
                                       echo " Категория: ".getcategory($row['category']);
                                       echo "</small><hr></div>";
                         } 
                            }
                            else{
                                   while($row = mysqli_fetch_array($posts)){
                            
                            
                            echo                            "<div class=\"blog-post\">";
                                $getSettingsPreview = getSettings('images');
                                                    if ($getSettingsPreview == 'on'){           
                                                        echo "<div class='preview'><img src=".$row['preview']." width='100%'></div>";
                                                    }
                                       echo"
                                                            <a href='index.php?post=".$row['id']."'><h2 class=\"blog-post-title\">".$row['title']."</h2></a>
                                                            <p class=\"blog-post-meta\">".$row['date']." by ";
                             
                        
                                                             if($row['user'] == 1){
                                                                 echo 'udt';
                                                             }
                                
                            echo                             "</p>
                                                              <p>".$row['annonce']."</p>
                                                              <hr>
                                                              </div>";
                         } 
                            }
                          
                          
                         
                            
                           
                            
                            echo                           "         
                                                          <ul class=\"pager\">
                                                          <li><a href=\"index.php?p=".$newest."\">Новее</a></li>
                                                          <li><a href=\"index.php?p=".$oldest."\">Позднее</a></li>
                                                          </ul>";

                      }
                      
                      
               
                      ?>
                        
                  
                  
                  </div>
                  
                  
                  <div class="col-xs-12 col-sm-12 col-md-4">
                  
                    
                     <?php
                        $posts = mysqli_query($mysqli, "SELECT * FROM `blocks` ORDER BY `id` DESC") or die(mysqli_error());
                    
                         while($row = mysqli_fetch_array($posts)){
                     
                     
                     
                     
                     
                   echo"  <div class=\"panel panel-default\">
                      <div class=\"panel-heading\">
                        ".$row['name']."
                      </div>
                      <div class=\"panel-body\">
                           ".$row['content']."
                      </div>
                    </div>";
                         }
                    
                    ?>
                    
                    </div>
                </div>
                
                
      <div class="panel-footer" style="margin-top: 20px;">
 
        <center><p>The blog udt.pro &copy; 2016</p></center>
 
      </div>

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap -->
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </body>
</html>
