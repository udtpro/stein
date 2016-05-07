<?php
include_once('sql.php');
include_once('include/php/cookie.php');
include_once('include/php/update_settings.php');
include_once('include/php/loader.php');
if(isset($_GET['posts'])){
  $panel = 'posts';  
}
elseif(isset($_GET['blocks'])){
    $panel = 'blocks';
}
elseif(isset($_GET['pages'])){
    $panel = 'pages';
}
elseif(isset($_GET['settings'])){
    $panel = 'settings';
}
elseif(isset($_GET['loader'])){
    $panel = 'loader';
}
elseif(isset($_GET['category'])){
    $panel = 'category';
}
elseif(isset($_GET['location'])){
    $panel = 'location';
}
elseif(isset($_GET['users'])){
    $panel = 'users';
}
else{
   $panel = 'default'; 
}






?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>SCMS | Панель управления</title>

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

                  
               <?php   
                  
                  switch ($panel) {
                                case 'loader':
                                
                                    
                                    echo "<div class=\"page-header\">
 
  <h1>Панель управления<br> <small>Загрузчик</small></h1>
</div>

                <div class=\"row\">
                 
                  <div class=\"col-xs-12 col-sm-8 col-md-8\">";
                  
                 ?>
                  
                           <?php if(!empty($error_array)): ?>
		<span style="color: red;">Файл не загружен!</span><br/>
		<?php foreach($error_array as $one_error): ?>
			<span style="color: red;"><?=$one_error;?></span><br/>
		<?php endforeach; ?>
	<?php endif; ?>
	<?php if(empty($error_array) AND $_FILES):  print("Ссылка на файл: http://lite.zhrt.ru/".$catalog."<br>"); ?>
		<span style="color: green;">Файл успешно загружен!</span><br/>
	<?php endif; ?>
	<form action="panel.php?loader" method="POST" enctype="multipart/form-data">
       
		<p align='center'><label for="file">File input</label>
		<input type="file" name="upload_file" id='file'><br> 
		<input type="submit" class="btn btn-default" value="Загрузить"><br>
</p>
		</form>
                  
                  
                  
                  
            
                  
                  
                  </div>
               <?php   
                 echo " 
                  <div class=\"col-xs-6 col-sm-4 col-md-4\">
                  
                    <div class=\"panel panel-default\">
                      <div class=\"panel-heading\">
                        Описание
                      </div>
                      <div class=\"panel-body\">
                          <p>Принимает файлы: jpeg, jpg, gif, png, doc, docx, xls, pdf, zip, rar</p>
                          <p>Максимальнй размер файла равен 20Мбайт</p>
                          <p>Выдает полную ссылку на файл.</p>
                      </div>
                    </div>
                    
                    
                    
                    
                    </div>
                </div>";
                                    break;
                                case 'pages':
                                        echo "<div class=\"page-header\">
 
                                                  <h1>Панель управления<br> <small>Страницы</small></h1>
                                                </div>

                                                                <div class=\"row\">

                                                                  <div class=\"col-xs-12 col-sm-8 col-md-8\">";
                          
                                         echo "<div class=\"panel panel-default\">
                                                  <!-- Default panel contents -->
                                                                <div class=\"panel-heading\">Список страниц</div>

                                                  <!-- Table -->
                                                                  <table class=\"table\" cols=5>
                                                        <thead>
                                                          <tr>
                                                            <th>ID</th>
                                                            <th>Название</th>
                                                            <th colspan='3'>Управление</th>

                                                          </tr>
                                                        </thead>
                                                        <tbody>


                                                         ";

                                          $posts = mysqli_query($mysqli, "SELECT * FROM `pages` ORDER BY `id`") or die(mysqli_error());

                                                                        while($row = mysqli_fetch_array($posts)){
                                                                        echo "
                                                          <tr>
                                                            <td>".$row['id']."</td>
                                                            <td>".$row['title']."</td>
                                                            <td>Информация</td>
                                                            <td><a href='edit.php?page=".$row['id']."'>Редактировать</a></td>
                                                            <td><a href='delete.php?type=1&id=".$row['id']."'>Удалить</a></td>
                                                          </tr>";
                                                          }
                                                echo "
                                                        </tbody>
                                                      </table>
                                                </div>";
                                                echo"  
                  </div>
                  
                  
                  <div class=\"col-xs-6 col-sm-4 col-md-4\">
                  
                    <div class=\"panel panel-default\">
                      <div class=\"panel-heading\">
                        Управление страницами
                      </div>
                      <div class=\"panel-body\">
                          <p><a href=\"create.php?page\"> + Добавить новую</a></p>
                      </div>
                    </div>
                    <div class=\"panel panel-default\">
                      <div class=\"panel-heading\">
                        Описание
                      </div>
                      <div class=\"panel-body\">
                          <p>Страница — это документ, который используется для страниц с редко изменяемой информацией. Например, таких страниц как «О сайте» или «Наш адрес». По умолчанию, документы этого типа не выводятся на первую страницу сайта и их комментирование отключено.</p>
                      </div>
                    </div>
                
                    
                    
                    </div>
                </div>";
                          
                          
                           
                  
                  
                  
                  
                  
                          
                          
                          
                          
                          
                                   
                                    break;
                          case 'users':
                                        echo "<div class=\"page-header\">
 
                                                  <h1>Панель управления<br> <small>Пользователи</small></h1>
                                                </div>

                                                                <div class=\"row\">

                                                                  <div class=\"col-xs-12 col-sm-8 col-md-8\">";
                          
                                         echo "<div class=\"panel panel-default\">
                                                  <!-- Default panel contents -->
                                                                <div class=\"panel-heading\">Список пользователей</div>

                                                  <!-- Table -->
                                                                  <table class=\"table\" cols=5>
                                                        <thead>
                                                          <tr>
                                                            <th>ID</th>
                                                            <th>Название</th>
                                                            <th colspan='3'>Управление</th>

                                                          </tr>
                                                        </thead>
                                                        <tbody>


                                                         ";

                                          $posts = mysqli_query($mysqli, "SELECT * FROM `users` ORDER BY `id`") or die(mysqli_error());

                                                                        while($row = mysqli_fetch_array($posts)){
                                                                        echo "
                                                          <tr>
                                                            <td>".$row['id']."</td>
                                                            <td>".$row['user']."</td>
                                                            <td>Информация</td>
                                                            <td><a href='edit.php?users=".$row['id']."'>Редактировать</a></td>";
                                                            if($row['id'] == 1){
                                                                echo "<td>Удалить нельзя</td>";
                                                            }
                                                                            else{
                                                                                echo "<td><a href='delete.php?type=6&id=".$row['id']."'>Удалить</a></td>";
                                                                            }
                                                            
                                                        echo"  </tr>";
                                                          }
                                                echo "
                                                        </tbody>
                                                      </table>
                                                </div>";
                                                echo"  
                  </div>
                  
                  
                  <div class=\"col-xs-6 col-sm-4 col-md-4\">
                  
                    <div class=\"panel panel-default\">
                      <div class=\"panel-heading\">
                        Управление пользователями
                      </div>
                      <div class=\"panel-body\">
                          <p><a href=\"create.php?users\"> + Добавить нового</a></p>
                      </div>
                    </div>
                    <div class=\"panel panel-default\">
                      <div class=\"panel-heading\">
                        Описание
                      </div>
                      <div class=\"panel-body\">
                          <p></p>
                      </div>
                    </div>
                
                    
                    
                    </div>
                </div>";
                          
                          
                           
                  
                  
                  
                  
                  
                          
                          
                          
                          
                          
                                   
                                    break;
                          case 'location':
                                        echo "<div class=\"page-header\">
 
                                                  <h1>Панель управления<br> <small>Локации</small></h1>
                                                </div>

                                                                <div class=\"row\">

                                                                  <div class=\"col-xs-12 col-sm-8 col-md-8\">";
                          
                                         echo "<div class=\"panel panel-default\">
                                                  <!-- Default panel contents -->
                                                                <div class=\"panel-heading\">Список локаций</div>

                                                  <!-- Table -->
                                                                  <table class=\"table\" cols=5>
                                                        <thead>
                                                          <tr>
                                                            <th>ID</th>
                                                            
                                                            <th>Описание</th>
                                                            <th colspan='2'>Управление</th>

                                                          </tr>
                                                        </thead>
                                                        <tbody>


                                                         ";

                                          $posts = mysqli_query($mysqli, "SELECT * FROM `blocks_location` ORDER BY `id`") or die(mysqli_error());

                                                                        while($row = mysqli_fetch_array($posts)){
                                                                        echo "
                                                          <tr>
                                                            <td>".$row['id']."</td><td>".$row['description']."</td>
                                                            <td>Информация</td>
                                                            <td><a href='edit.php?location=".$row['id']."'>Редактировать</a></td>
                                                            <td><a href='delete.php?type=5&id=".$row['id']."'>Удалить</a></td>
                                                          </tr>";
                                                          }
                                                echo "
                                                        </tbody>
                                                      </table>
                                                </div>";
                                                echo"  
                  </div>
                  
                  
                  <div class=\"col-xs-6 col-sm-4 col-md-4\">
                  
                    <div class=\"panel panel-default\">
                      <div class=\"panel-heading\">
                        Управление категориями
                      </div>
                      <div class=\"panel-body\">
                          <p><a href=\"create.php?location\"> + Добавить новую</a></p>
                      </div>
                    </div>
                    
                    <div class=\"panel panel-default\">
                      <div class=\"panel-heading\">
                        Описание
                      </div>
                      <div class=\"panel-body\">
                          <p>Локации используются для управления расположением блоков.</p>
                      </div>
                    </div>
                    
                    
                    </div>
                </div>";
                          
                          
                           
                  
                  
                  
                  
                  
                          
                          
                          
                          
                          
                                   
                                    break;
                           case 'category':
                                        echo "<div class=\"page-header\">
 
                                                  <h1>Панель управления<br> <small>Категории</small></h1>
                                                </div>

                                                                <div class=\"row\">

                                                                  <div class=\"col-xs-12 col-sm-8 col-md-8\">";
                          
                                         echo "<div class=\"panel panel-default\">
                                                  <!-- Default panel contents -->
                                                                <div class=\"panel-heading\">Список категорий</div>

                                                  <!-- Table -->
                                                                  <table class=\"table\" cols=5>
                                                        <thead>
                                                          <tr>
                                                            <th>ID</th>
                                                            <th>Название</th>
                                                            <th>Описание</th>
                                                            <th colspan='2'>Управление</th>

                                                          </tr>
                                                        </thead>
                                                        <tbody>


                                                         ";

                                          $posts = mysqli_query($mysqli, "SELECT * FROM `category` ORDER BY `id`") or die(mysqli_error());

                                                                        while($row = mysqli_fetch_array($posts)){
                                                                        echo "
                                                          <tr>
                                                            <td>".$row['id']."</td>
                                                            <td>".$row['category']."</td>
                                                            <td>".$row['description']."</td>
                                                            <td>Информация</td>
                                                            <td><a href='edit.php?category=".$row['id']."'>Редактировать</a></td>
                                                            <td><a href='delete.php?type=4&id=".$row['id']."'>Удалить</a></td>
                                                          </tr>";
                                                          }
                                                echo "
                                                        </tbody>
                                                      </table>
                                                </div>";
                                                echo"  
                  </div>
                  
                  
                  <div class=\"col-xs-6 col-sm-4 col-md-4\">
                  
                    <div class=\"panel panel-default\">
                      <div class=\"panel-heading\">
                        Управление категориями
                      </div>
                      <div class=\"panel-body\">
                          <p><a href=\"create.php?category\"> + Добавить новую</a></p>
                      </div>
                    </div>
                    
                    <div class=\"panel panel-default\">
                      <div class=\"panel-heading\">
                        Описание
                      </div>
                      <div class=\"panel-body\">
                          <p>Категории используются для сортировки статей и новостей.</p>
                      </div>
                    </div>
                    
                    
                    </div>
                </div>";
                          
                          
                           
                  
                  
                  
                  
                  
                          
                          
                          
                          
                          
                                   
                                    break;
                                case 'settings':
                                    echo "<div class=\"page-header\">
 
  <h1>Панель управления<br> <small>Настройки главной страницы</small></h1>
</div>

                <div class=\"row\">
                 
                  <div class=\"col-xs-12 col-sm-8 col-md-8\">
                  
                  
                  
                           
                  
                  
                  
                  <form method='post'>
                    
                  <label for='title'>Бренд:</label>  
                  <input type=\"text\" class=\"form-control\" placeholder=\"Находится в шапке\" name='brand' id='title' value='";
                  echo $row['brand'];
                  echo "'><br> 
                  <label for='title'>Заголовок:</label>  
                  <input type=\"text\" class=\"form-control\" placeholder=\"Заголовок сайта\" name='title' id='title' value='";
                  echo $row['title'];
                  echo "'><br> 
                  <label for='title'>Слоган заголовка:</label>  
                  <input type=\"text\" class=\"form-control\" placeholder=\"Информация под заголовком\" name='title_text' id='title' value='";
                  echo $row['title_text'];
                  echo "'><br> 
      <br>
       
      <center>
      
      <input type=\"submit\"  class='btn btn-default' value='Сохранить редактирование'>
      </center> 
        </form>                          <br><h2>Системные настройки</h2><hr>
                                         <form action=\"\" method=\"post\">
                                             <label for='select'  >Тип отображения:</label>  
                                             <select id='select' class=\"form-control\" name ='typepost'>
                                              <option value = 'blog'>Блог</option>
                                              <option value = 'micro'>Микроблог</option>
                                            </select>
                                              <br>
                                               <center>
      
      <input type=\"submit\"  class='btn btn-default' value='Сохранить редактирование'>
      </center> 
                  
                  
                                         </form>
                       <form action=\"\" method=\"post\">
                                             <label for='preview'  >Превью:</label>  
                                             <select id='preview' class=\"form-control\" name ='preview'>
                                              <option value = 'on'>Включить</option>
                                              <option value = 'off'>Выключить</option>
                                            </select>
                                              <br>
                                               <center>
      
      <input type=\"submit\"  class='btn btn-default' value='Сохранить редактирование'>
      </center> 
                  
                  
                                         </form>                   
                                        

                      <form method='post'>
                    
                  <label for='numpost'>Количество постов на странице:</label>  
                  <input type=\"text\" class=\"form-control\" placeholder=\"Введите число\" name='numpost' id='numpost' value='";
                  echo numpost();
                echo "'>
                  
      <br>
       
      <center>
      
      <input type=\"submit\"  class='btn btn-default' value='Сохранить редактирование'>
      </center> 
        </form>
                  
                  
                  </div>
                  
                  
                  <div class=\"col-xs-6 col-sm-4 col-md-4\">
                  
                    <div class=\"panel panel-default\">
                      <div class=\"panel-heading\">
                        Описание
                      </div>
                      <div class=\"panel-body\">
                          <p>Используется для настройки отображения главной страницы сайта, например шапки, количества статей на странице и т.п.</p>
                      </div>
                    </div>
                    
                    
                    
                    
                    </div>
                </div>";
                                    break;
                                case 'blocks':
                                    echo "<div class=\"page-header\">
 
  <h1>Панель управления<br> <small>Блоки</small></h1>
</div>

                <div class=\"row\">
                 
                  <div class=\"col-xs-12 col-sm-8 col-md-8\">
                  
                <div class=\"panel panel-default\">
  <!-- Default panel contents -->
                <div class=\"panel-heading\">Список страниц</div>

  <!-- Table -->
                  <table class=\"table\" cols=5>
        <thead>
          <tr>
            <th>ID</th>
            <th>Название</th>
            <th colspan='3'>Управление</th>
            
          </tr>
        </thead>
        <tbody>
         
         
       ";
         
         $posts = mysqli_query($mysqli, "SELECT * FROM `blocks` ORDER BY `id`") or die(mysqli_error());
                    
                        while($row = mysqli_fetch_array($posts)){
                        echo "
          <tr>
            <td>".$row['id']."</td>
            <td>".$row['name']."</td>
            <td>Информация</td>
            <td><a href='edit.php?block=".$row['id']."'>Редактировать</a></td>
            <td><a href='delete.php?type=3&id=".$row['id']."'>Удалить</a></td>
          </tr>";
          }
        echo "
        </tbody>
      </table>
</div>

                          
                          
                           
                  
                  
                  
                  
                  
                  
                  
                  </div>
                  
                  
                  <div class=\"col-xs-6 col-sm-4 col-md-4\">
                  
                    <div class=\"panel panel-default\">
                      <div class=\"panel-heading\">
                        Управление страницами
                      </div>
                      <div class=\"panel-body\">
                          <p><a href=\"create.php?block\"> + Добавить новый</a></p>
                          <p><a href=\"panel.php?location\">Управление локациями</a></p>
                      </div>
                    </div>
                    
                     <div class=\"panel panel-default\">
                      <div class=\"panel-heading\">
                        Описание
                      </div>
                      <div class=\"panel-body\">
                          <p>Блок — это блок с текстом и названием, в котором может находится важная информация, например расписание или версия.</p>
                      </div>
                    </div>
                    
                    
                    </div>
                </div>
                ";
                                    break;
                                case 'posts':
                                    echo "<div class=\"page-header\">
 
  <h1>Панель управления<br> <small>Статьи</small></h1>
</div>

                <div class=\"row\">
                 
                  <div class=\"col-xs-12 col-sm-8 col-md-8\">
                  
                <div class=\"panel panel-default\">
  <!-- Default panel contents -->
                <div class=\"panel-heading\">Список статей</div>

  <!-- Table -->
                  <table class=\"table\" cols=5>
        <thead>
          <tr>
            <th>ID</th>
            <th>Название</th>
            <th colspan='3'>Управление</th>
            
          </tr>
        </thead>
        <tbody>";
         
                            $post_page = 10;
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
                          
                          
                          
        // $posts = mysqli_query($mysqli, "SELECT * FROM `posts` ORDER BY `id`") or die(mysqli_error());
                    
                        while($row = mysqli_fetch_array($posts)){
                        echo "
          <tr>
            <td>".$row['id']."</td>
            <td>".$row['title']."</td>
            <td>Информация</td>
            <td><a href='edit.php?post=".$row['id']."'>Редактировать</a></td>
            <td><a href='delete.php?type=2&id=".$row['id']."'>Удалить</a></td>
          </tr>";
          }
        echo "
        </tbody>
      </table>
</div>

                          
             
                                                          <ul class=\"pager\">
                                                          <li><a href=\"panel.php?posts&p=".$newest."\">Новее</a></li>
                                                          <li><a href=\"panel.php?posts&p=".$oldest."\">Позднее</a></li>
                                                          </ul>           
                           
                  
                  
                  
                  
                  
                  
                  
                  </div>
                  
                  
                  <div class=\"col-xs-6 col-sm-4 col-md-4\">
                  
                    <div class=\"panel panel-default\">
                      <div class=\"panel-heading\">
                        Управление статьями
                      </div>
                      <div class=\"panel-body\">
                          <p><a href=\"create.php?post\"> + Добавить новую</a></p>
                          <p><a href=\"panel.php?category\">Управление категориями</a><p>
                      </div>
                    </div>
                    
                    
                    <div class=\"panel panel-default\">
                      <div class=\"panel-heading\">
                        Описание
                      </div>
                      <div class=\"panel-body\">
                          <p>Статья — это документ, который обычно используется для новостей, анонсов и любых других сообщений, для которых не задействованы другие типы документов. Этот тип документа также используют для ведения персонального блога. По умолчанию, документы этого типа выводятся на первую страницу сайта и их разрешено комментировать.</p>
                      </div>
                    </div>
                    
                    
                    </div>
                </div>
                ";
                                    break;
                                
                      
                      
                      
                      
                      
                      
                      
                                case 'default':
                                    echo "<div class=\"page-header\">
 
                                        <h1>Панель управления<br> <small>SCMS</small></h1>
                                        </div>

                                            <div class=\"row\">
                 
                                        <div class=\"col-xs-12 col-sm-8 col-md-8\">";
                                    echo "<h2>Добро пожаловать в Stein CMS</h2>
                                    <p></p>
                                    ";
                                       
                                    echo "</div>
                  

                                                  <div class=\"col-xs-6 col-sm-4 col-md-4\">

                                                    <div class=\"panel panel-default\">
                                                      <div class=\"panel-heading\">
                                                        Информация
                                                      </div>
                                                      <div class=\"panel-body\">
                                                          <p>Версия: 1.1.1</p>
                                                      </div>
                                                    </div>




                                                    </div>
                                                </div> ";
                                    break;
                            }         

                  
              ?>    
                  
                                          
                                        

                  
                  
               
                
                
      <div class="panel-footer" style="margin-top: 20px;">
 
        <?php
          include('include/html/footer.php')
    ?>
 
      </div>

   

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <br/> <br/>
    
  </body>
</html>