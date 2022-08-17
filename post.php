<!------------------
    
    post.php
    Name: Yuheng Zhu
    Date: 2022-08-13
    Description: The php file is used to create a new post page for user to uplaod new movie.
	
-------------------->
<?php
	require('connect.php');

	if(!empty($_POST['movieName']) && !empty($_POST['description']) && !empty($_POST['categoryId']) && !empty($_POST['year'])){	
    
        if(empty($_POST['movieName']) || empty($_OST['description']) || empty($_POST['categoryId']) || empty($_POST['year'])){
            echo "<h1>"."Please input contents."."</h1>";
        }	  	
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
	<link rel="stylesheet" type="text/css" href="style.css" />
  <script src="ckeditor/ckeditor.js"></script>
    <title>Post Movie</title>
</head>
<body>
    
<nav class="navbar navbar-expand-lg bg-light" style="background-color: #e3f2fd;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">DouBan</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="movie.php">Movie</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="post.php">
            Post
          </a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<div class="main">
	<div class="header">
		<img class="logo" src="image/logo.png" alt="" />
		<h1 class="head">Post New Movie Now</a></h1>
	</div>

    <div class="form_part">
      <form method="post" action="post.php">
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