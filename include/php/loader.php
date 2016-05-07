<?php
// ограничение размера файла
	$limit_size = 20*1024*1024; 
	// корректные форматы файлов
	$valid_format = array("jpeg", "jpg", "gif", "png", "doc", "docx","xls","pdf","zip", "rar");
	// хранилище ошибок
	$error_array = array();
	// путь до нового файла
	$path_file = "files/";
	// имя нового файла
	$rand_name = md5(time() . mt_rand(0, 9999));





    

	// если есть отправленные файлы
	if($_FILES){
		// валидация размера файла
		if($_FILES["upload_file"]["size"] > $limit_size){
			$error_array[] = "Размер файла превышает допустимый!";
		}
		// валидация формата файла
        $file = $_FILES["upload_file"]["name"];
       $explode = explode(".", $file);
		$format = end($explode);
		if(!in_array($format, $valid_format)){
			$error_array[] = "Формат файла не допустимый!";
		}
		// если не было ошибок
		if(empty($error_array)){
			// проверяем загружен ли файл
			if(is_uploaded_file($_FILES["upload_file"]["tmp_name"])){
				// сохраняем файл
				move_uploaded_file($_FILES["upload_file"]["tmp_name"], $path_file . $rand_name . ".$format");
                $catalog = $path_file . $rand_name . ".$format";
			}else{
				// Если файл не загрузился
				$error_array[] = "Ошибка загрузки!";
			}
		}		
	}
?>