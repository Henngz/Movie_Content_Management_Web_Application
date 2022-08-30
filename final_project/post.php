<!------------------
    
    post.php
    Name: Yuheng Zhu
    Date: 2022-08-13
    Description: The php file is used to create a new post page for user to uplaod new movie.
	
-------------------->
<?php 
require('search.php');
  
  function file_upload_path($original_filename, $upload_subfolder_name = 'uploads') {
    $current_folder = dirname(__FILE__);
    
    // Build an array of paths segment names to be joins using OS specific slashes.
    $path_segments = [$current_folder, $upload_subfolder_name, basename($original_filename)];
    
    // The DIRECTORY_SEPARATOR constant is OS specific.
    return join(DIRECTORY_SEPARATOR, $path_segments);
 }

 // file_is_an_image() - Checks the mime-type & extension of the uploaded file for "image-ness".
 function file_is_an_image($temporary_path, $new_path) {
     $allowed_mime_types      = ['image/gif', 'image/jpeg', 'image/png'];
     $allowed_file_extensions = ['gif', 'jpg', 'jpeg', 'png'];
     
     $actual_file_extension   = pathinfo($new_path, PATHINFO_EXTENSION);
     $actual_mime_type        = getimagesize($temporary_path)['mime'];
     
     $file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);
     $mime_type_is_valid      = in_array($actual_mime_type, $allowed_mime_types);
     
     return $file_extension_is_valid && $mime_type_is_valid;
 }
 
 $image_upload_detected = isset($_FILES['image']) && ($_FILES['image']['error'] === 0);
 $upload_error_detected = isset($_FILES['image']) && ($_FILES['image']['error'] > 0);

 if ($image_upload_detected) { 
     $image_filename        = $_FILES['image']['name'];
     $temporary_image_path  = $_FILES['image']['tmp_name'];
     $new_image_path        = file_upload_path($image_filename);
     if (file_is_an_image($temporary_image_path, $new_image_path)) {
         move_uploaded_file($temporary_image_path, $new_image_path);
     }
 }

  //Chech if there is an image uploading
  if(!empty($_FILES['image']['name'])){
    if(!empty($_POST['movieName']) && !empty($_POST['description']) && !empty($_POST['categoryId']) && !empty($_POST['year'])){	
      
          if(empty($_POST['movieName']) || empty($_OST['description']) || empty($_POST['categoryId']) || empty($_POST['year'])){
              echo "<h1>"."Please input contents."."</h1>";
          }	  	
      //  Sanitize user input to escape HTML entities and filter out dangerous characters.
          $movieName = filter_input(INPUT_POST, 'movieName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
          $year = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_NUMBER_INT);
          $image = $_FILES['image']['name'];

          //Build the parameterized SQL query and bind with values
          $query = "INSERT INTO Movie (movieName,description, categoryId,year,image) VALUES (:movieName,:description,:categoryId,:year,:image)";
          $statement = $db -> prepare($query);
          
          //Bind values
          $statement->bindValue(':movieName', $movieName);
          $statement->bindValue(':description', $description);
          $statement->bindValue(':categoryId', $categoryId);
          $statement->bindValue(':year', $year);
          $statement->bindValue(':image', $image);
        
          //Execute the insert       
          $statement -> execute();           
      }
    
  }elseif(empty($_FILES['image']['name'])){

    //  Sanitize user input to escape HTML entities and filter out dangerous characters.
      $movieName = filter_input(INPUT_POST, 'movieName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
      $year = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_NUMBER_INT);
      

      //Build the parameterized SQL query and bind with values
      $query = "INSERT INTO Movie (movieName,description, categoryId,year) VALUES (:movieName,:description,:categoryId,:year)";
      $statement = $db -> prepare($query);
      
      //Bind values
      $statement->bindValue(':movieName', $movieName);
      $statement->bindValue(':description', $description);
      $statement->bindValue(':categoryId', $categoryId);
      $statement->bindValue(':year', $year);
      

      //Execute the insert       
      $statement -> execute();   
  }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css" />
  <script src="ckeditor/ckeditor.js"></script>
    <title>Post Movie</title>
</head>
<body>

<div class="main">
	<div class="header">
		<img class="logo" src="image/logo.png" alt="" />
		<h1 class="head">Post New Movie Now</a></h1>
	</div>

    <div class="form_part">
      <form method="post" action="post.php" enctype='multipart/form-data'>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Movie Name</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="movieName">
            </div>
           <div class="mb-3">  
              <label for="exampleFormControlTextarea1" class="form-label">Description</label>
              <textarea name="description"></textarea>
                <script>
                        CKEDITOR.replace( 'description' );
                </script>
           </div> 
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Year</label>
                <input type="number" class="form-control" id="exampleFormControlInput3" name="year">
            </div>
            <select class="form-select" aria-label="Default select example" name="categoryId">
              <option selected >Choose One Category</option>
              <option value="1">Drama</option>
              <option value="2">Romance</option>
              <option value="3">Comedy</option>
              <option value="4">Crime</option>
              <option value="5">Action</option>
            </select>

            <div>
            <label for='image'>Image Filename(optional):</label>
            <input type='file' name='image' id='image'>
            </div>

            <div class="button">
                <input type="submit" id="submitbutton">
            </div>
      </form>
    </div>
</div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</body>
</html>
