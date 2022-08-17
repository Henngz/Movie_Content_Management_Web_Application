<?php
require('connect.php');


if (!empty($_GET['id'])) {
    if(!filter_var($_GET['id'],FILTER_VALIDATE_INT)){
        header("Location:home.php?");
        exit;
    }

    // Fetch movie information
    // Sanitize the id. Like above but this time from INPUT_GET.
    $movieId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    
    // Build the parametrized SQL query using the filtered id.
    $movie_query = "SELECT * FROM Movie WHERE movieId = :movieId";
    $movie_statement = $db->prepare($movie_query);
    $movie_statement->bindValue(':movieId', $movieId, PDO::PARAM_INT);
    
    // Execute the SELECT and fetch the single row returned.
    $movie_statement->execute();
    $movie_row = $movie_statement->fetch();

    echo !empty($_POST['userName'])? "true":"false"; 
    echo !empty($_POST['content'])? "true":"false"; 
    echo !empty($_POST['movieId'])? "true":"false"; 
    //Post review
    if(!empty($_POST['userName']) && !empty($_POST['content'])){	
    
        // if(empty($_POST['userName']) || empty($_POST['userName'])){
        //     echo "<h1>"."Please input contents."."</h1>";
        // }	  	
		//  Sanitize user input to escape HTML entities and filter out dangerous characters.
        $userId = filter_input(INPUT_POST, 'userId', FILTER_SANITIZE_NUMBER_INT);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
       
        //Build the parameterized SQL query and bind with values
        $query = "INSERT INTO Review (userName,content, movieId) VALUES (:userName,:content, :movieId)";
        $statement = $db -> prepare($query);
        
        //Bind values
        $statement->bindValue(':userName', $userName);
        $statement->bindValue(':content', $content);
        $statement->bindValue(':movieId', $movieId, PDO::PARAM_INT);

        //Execute the insert       
        echo $statement -> execute()? "atrue":"afalse"; 
        echo $movieId;
        header("Location:review.php?id={$movieId}");
        
    }

    // Fetch review
    $review_query = "SELECT * FROM Review WHERE movieId = :movieId";
    $review_statement = $db->prepare($review_query);
    $review_statement->bindValue(':movieId', $movieId, PDO::PARAM_INT);
    
    // Execute the SELECT and fetch the single row returned.
    
    echo $review_statement->execute()? "true":"false";
    $review_row = $review_statement->fetch();
    
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css" />
    <title>Movie Details</title>
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
		<h1 class="head">Movie Details</a></h1>
	</div>

    <div class="form_part">
    <?php if ($movieId): ?>
		
			<input type="hidden" name="movieId" value="<?= $movie_row['movieId'] ?>">
			<div class="mb-3">
                <label for="exampleFormControlInput1" class="subtitle">Movie Name:</label>
                <p><?= $movie_row['movieName'] ?></p>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="subtitle">Description:</label>
                <p><?= $movie_row['description'] ?></p>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="subtitle">Year:</label>
                <p><?= $movie_row['year'] ?></p>
            </div>

            <label for="exampleFormControlTextarea1" class="subtitle">Category:</label>
                <?php if($movie_row['categoryId']==1): ?>
                    <p>Drama</p>
                <?php elseif($movie_row['categoryId']==2): ?>    
                    <p>Romance</p>
                <?php elseif($movie_row['categoryId']==3): ?>
                    <p>Comedy</p>
                <?php elseif($movie_row['categoryId']==4): ?>
                    <p>Crime</p>
                <?php elseif($movie_row['categoryId']==5): ?>
                    <p>Action</p>
                <?php endif; ?>		
		<?php endif ?>
    </div>
    
    <div class="review-head">
        <h1>User reviews </h1>
    </div>

    <div class="form_part">
      <form method="post" action="review.php">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">User Name</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="userName">
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

    <div class="review-part">      
        <?php if ($movieId): ?>		
            
        <?php while ($review_row = $review_statement -> fetch()): ?>
            <div class="card">
                <div class="card-body">
                    <p class="card-subtitle mb-2 text-muted"><?= $review_row['content'] ?></p>             
                </div>              
            </div>
        <?php endwhile ?>
        <?php endif?>
    
    </div>       
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</body>
</html>