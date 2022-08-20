<?php
    require('connect.php');
    require('users.inc.php');
    
    if(isset($_GET['search']) && empty($_GET['navCategoryId'])){
        $searchContent = trim($_GET['search']);
        $query = "SELECT * FROM Movie WHERE CONCAT(movieName) LIKE '%".$searchContent."%'";
	    $statement = $db -> prepare($query);
	    $statement -> execute();
    
   }
    
    if(isset($_GET['search']) && !empty($_GET['navCategoryId'])){
        $searchContent = trim($_GET['search']);
        $filterCategory = $_GET['navCategoryId'];

        $query = "SELECT * FROM Movie WHERE CONCAT(movieName) LIKE '%".$searchContent."%' AND categoryId =  $filterCategory";
	    $statement = $db -> prepare($query);
	    $statement -> execute();
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    
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
        <li class="nav-item">
          <a class="nav-link" href="theatre.php">Theatre</a>
        </li>
        <?php if (checkAdmin($db)): ?>
          <li class="nav-item">
            <a class="nav-link" href="users.php">
              Users
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="post.php">
              Post
            </a>
          </li>
        <?php endif; ?>

        <?php if(isset($_SESSION["userName"])):?>
        <li class="nav-item">
          <a class="nav-link" href="logout.inc.php">
            Logout
          </a>
        </li>
        <?php elseif(!isset($_SESSION["userName"])):?> 
          <li class="nav-item">
          <a class="nav-link" href="login.php">
            Login
          </a>
        </li>
        <?php endif; ?>
      </ul>
      <form class="d-flex" role="search" action="search.php" method="GET">
        <input class="form-control me-2" type="search" placeholder="Search Movie" aria-label="Search" name="search">
        <select class="nav-form-select" aria-label="Default select example" name="navCategoryId" aria-placeholder="Filter Cayegory">
            <option selected value="">Choose One Category</option>
            <option value="1">Drama</option>
            <option value="2">Romance</option>
            <option value="3">Comedy</option>
            <option value="4">Crime</option>
            <option value="5">Action</option>
        </select>
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<div class="display-part">
    <?php if (isset($_GET['search'])): ?>   
        
        <div class="header">
            <img class="logo" src="image/logo.png" alt="" />
            <h1 class="head">There Are <?= $statement->rowCount() ?> Results</a></h1>
        </div>
        <?php while ($row = $statement -> fetch()): ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $row['movieName'] ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?= $row['year'] ?></h6>
                    <p class="card-text"><?= $row['description'] ?></p>
                </div>
                <div class="action">
                    <a href="update.php?id=<?= $row['movieId']?>" class="card-link">edit</a>
                    <a href="update.php?id=<?= $row['movieId']?>" class="card-link">delete</a>
                    <a href="review.php?id=<?= $row['movieId']?>" class="card-link">reviews</a>
                </div>
            </div>
        <?php endwhile ?> 
        <?php endif?> 
</div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</body>
</html>