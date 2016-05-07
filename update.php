<?php
include_once('sql.php');
include_once('include/php/cookie.php');

if(isset($_POST['type'])){
if (($_POST['type'] == 'page') and isset($_POST['title']) and isset($_POST['content']) and isset($_POST['id'])){


                                                    $name = validate($_POST['title'], $mysqli, 0);
                                                    $content = validate($_POST['content'], $mysqli, 1);
                                                    $date = validate($_POST['date'], $mysqli, 0);
                                                    $id = $_POST['id'];
                                                    mysqli_query($mysqli, "UPDATE `pages` SET `title` = '$name', content = '$content', date = '$date' WHERE `id` ='$id'");
                                                    header('Location: '.$_SERVER['HTTP_REFERER']);
                                                
    }

elseif(($_POST['type'] == 'block') and isset($_POST['name']) and isset($_POST['content']) and isset($_POST['id']) and isset($_POST['location'])){
                                               

                                                    $name = validate($_POST['name'], $mysqli, 0);
                                                    $content = validate($_POST['content'],$mysqli, 1);
                                                    $id = $_POST['id'];
                                                    if(isset($_POST['location'])){
    
                                                        $location = validate($_POST['location'], $mysqli, 1);

                                                    }
                                                    else {
                                                        $location = 1;
                                                    }
                                                    mysqli_query($mysqli, "UPDATE `blocks` SET `name` = '$name', `content` = '$content', `location` = '$location' WHERE `id` ='$id'");
                                                    header('Location: '.$_SERVER['HTTP_REFERER']);
                                                    
    }
    
elseif(($_POST['type'] == 'category') and isset($_POST['category']) and isset($_POST['description']) and isset($_POST['id'])){
                                               

                                                    $category = validate($_POST['category'], $mysqli, 0);
                                                    $description = validate($_POST['description'],$mysqli, 1);
                                                    $id = $_POST['id'];
                                                    mysqli_query($mysqli, "UPDATE `category` SET category = '$category', description = '$description' WHERE `id` ='$id'");
                                                    header('Location: '.$_SERVER['HTTP_REFERER']);
                                            
    }
    
elseif(($_POST['type'] == 'users') and isset($_POST['password']) and isset($_POST['id'])){
                                               

                                                    $password = validate($_POST['password'], $mysqli, 0);
                                                    $password = hashpassword($password);
                                                    $id = $_POST['id'];
                                                    mysqli_query($mysqli, "UPDATE `users` SET hash = '$password' WHERE `id` ='$id'") or die(mysqli_error($mysqli));
                                                    header('Location: '.$_SERVER['HTTP_REFERER']);
                                            
    }


elseif(($_POST['type'] == 'location') and isset($_POST['description']) and isset($_POST['id'])){
                                               

                                                    
                                                    $description = validate($_POST['description'],$mysqli, 1);
                                                    $id = $_POST['id'];
                                                    mysqli_query($mysqli, "UPDATE `blocks_location` SET description = '$description' WHERE `id` ='$id'") ;
                                                    header('Location: '.$_SERVER['HTTP_REFERER']);
                                            
    }
    
elseif(($_POST['type'] == 'post') and isset($_POST['title']) and isset($_POST['content']) and isset($_POST['id']) and isset($_POST['annonce'])){
                                            

                                                    $name = validate($_POST['title'],$mysqli, 0);
                                                    $annonce = validate($_POST['annonce'],$mysqli, 1);
                                                    $content = validate($_POST['content'],$mysqli, 1);
                                                    $date = validate($_POST['date'],$mysqli, 0);
                                                    if (isset($_POST['preview'])){
                                                           $preview = validate($_POST['preview'], $mysqli, 0); 
                                                        }
                                                    else {
                                                            $preview = '0';
                                                        }
                                                    $id = $_POST['id'];
                                                    if(isset($_POST['category'])){
    
                                                        $category = validate($_POST['category'], $mysqli, 1);

                                                    }
                                                    else {
                                                        $category = 1;
                                                    }
                                                    mysqli_query($mysqli, "UPDATE `posts` SET title = '$name', content = '$content', annonce = '$annonce', date = '$date', category = '$category', preview = '$preview' WHERE `id` ='$id'");
                                                    header('Location: '.$_SERVER['HTTP_REFERER']);
                                                
    }


else {
                                                    echo 'Broken type';

    }
}
                                    
else{
                                                    echo "no data";
    }

?>