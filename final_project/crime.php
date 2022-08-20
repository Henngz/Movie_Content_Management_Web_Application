<?php
	include('search.php');
	$query = "SELECT * FROM Movie WHERE categoryId = 4";
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
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Drama Movies</title>
</head>
<body>
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
                <?php if (checkAdmin($db)): ?>
                    <a href="update.php?id=<?= $row['movieId']?>" class="card-link">edit</a>
                    <a href="update.php?id=<?= $row['movieId']?>" class="card-link">delete</a>
                  <?php endif; ?>
                    <a href="review.php?id=<?= $row['movieId']?>" class="card-link">review</a>
                </div>
            </div>
        <?php endwhile ?> 
</div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</body>
</html>