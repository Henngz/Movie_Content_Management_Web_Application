<?php
	require('connect.php');
	$query = "SELECT * FROM Movie WHERE categoryId = 5";
	$statement = $db -> prepare($query);

	$statement -> execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Drama Movies</title>
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


<div class="header">
		<img class="logo" src="image/logo.png" alt="" />
		<h1 class="head">There Are <?= $statement->rowCount() ?> Drama Movies</a></h1>
	</div>

<div class="display-part">
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
                </div>
            </div>
        <?php endwhile ?> 
</div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</body>
</html>