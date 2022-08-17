<?php
	require('connect.php');

    echo !empty($_POST['userId'])? "true":"false"; 
    echo !empty($_POST['content'])? "true":"false"; 
    echo !empty($_POST['movieId'])? "true":"false"; 
    // $movieId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    // echo $movieId;

	if(!empty($_POST['userId']) && !empty($_POST['content']) && !empty($_POST['movieId'])){	
    
        // if(empty($_POST['userName']) || empty($_POST['userName'])){
        //     echo "<h1>"."Please input contents."."</h1>";
        // }	  	
		//  Sanitize user input to escape HTML entities and filter out dangerous characters.
        $userId = filter_input(INPUT_POST, 'userId', FILTER_SANITIZE_NUMBER_INT);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $movieId = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        echo $movieId;

        //Build the parameterized SQL query and bind with values
        $query = "INSERT INTO Review (userId,content, movieId) VALUES (:userId,:content, :movieId)";
        $statement = $db -> prepare($query);
        
        //Bind values
        $statement->bindValue(':userId', $userId);
        $statement->bindValue(':content', $content);
        $statement->bindValue(':movieId', $movieId, PDO::PARAM_INT);

        //Execute the insert       
        echo $statement -> execute()? "atrue":"afalse"; 
        header("Location:review.php?id={$movieId}");
         exit;
    }else if (!empty($_GET['id'])) {
    	// if(!filter_var($_GET['id'],FILTER_VALIDATE_INT)){
        //     header("Location:home.php?");
        //     exit;
	    // }

		// Sanitize the id. Like above but this time from INPUT_GET.
        $movieId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        
        // Build the parametrized SQL query using the filtered id.
        $query = "SELECT * FROM Movie WHERE movieId = :movieId";
        $statement = $db->prepare($query);
        $statement->bindValue(':movieId', $movieId, PDO::PARAM_INT);
        // echo $movieId;
        // Execute the SELECT and fetch the single row returned.
        echo $statement->execute()? "trueb":"falseb";
        $row = $statement->fetch();
        echo $row['movieId'];
    }else if(!filter_var($_POST['movieId'],FILTER_VALIDATE_INT) || !strlen($_POST['content'])<1 || !filter_var($_POST['userId'],FILTER_VALIDATE_INT)){
		echo "<h1>"."You do not input correct datas."."</h1>";     
	}
	else {
        $movieId = false; // False if we are not UPDATING or SELECTING.
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
    <title>Post Review</title>
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
		<h1 class="head">Review the Movie Now</a></h1>
	</div>

    <div class="form_part">
      <form method="post" action="addReview.php">
      
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">User Id</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="userId">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Content</label>
                <input type="text" class="form-control" id="exampleFormControlInput2" name="content">
                <!-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="description"></textarea> -->
            </div>
            <div class="button">
                <input type="submit" id="submitbutton">
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</body>
</html>