<?php
	// require('connect.php');
    include('search.php');

    if(isset($_GET['sortMethod'])){
        if($_GET['sortMethod']==1){
            $query = "SELECT * FROM Movie ORDER BY movieName";
        }elseif($_GET['sortMethod']==2){
        $query = "SELECT * FROM Movie ORDER BY date DESC";
        }elseif($_GET['sortMethod']==3){
        $query = "SELECT * FROM Movie ORDER BY year DESC";
        }
        echo "<h2>"."Sort successfully!"."</h2>";
    }else{
        $query = "SELECT * FROM Movie ORDER BY date DESC";
    }
	
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


<div class="header"> 
		<img class="logo" src="image/logo.png" alt="" />
		<h1 class="head">There Are All Movies</a></h1>
</div>

<form class="sort-part" action="movie.php" method="GET" style="width:320px;">
    <div class="input-group mb-3">
        <select class="form-select" aria-label="Default select example" name="sortMethod" style="margin-top:0px;">
            <option selected >Choose sort method</option>
            <option value="1">Sorted by movie name</option>
            <option value="2">Sorted by update date</option>
            <option value="3">Sorted by release year</option>        
        </select>
        <button type="submit" class="input-group-text btn btn-primary" id="basic-addon2" style="height:41px;">Sort</button>
    </div>  
</form>

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
                    <a href="review.php?id=<?= $row['movieId']?>" class="card-link">reviews</a>
                </div>
            </div>
        <?php endwhile ?> 
</div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</body>
</html>