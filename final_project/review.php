<?php
require('search.php');
if (!empty($_GET['id'])) {
    if(!filter_var($_GET['id'],FILTER_VALIDATE_INT)){
        header("Location:home.php?");
        exit;
    }

    $movieId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    // Fetch review
    $query = "SELECT * FROM Review WHERE movieId = :movieId";
    $statement = $db->prepare($query);
    $statement->bindValue(':movieId', $movieId, PDO::PARAM_INT);

    // Execute the SELECT and fetch the single row returned.
    $row = $statement->fetch();
    $statement->execute();
    
}

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
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Movie Details</title>
</head>
<body>
<div class="header">
		<img class="logo" src="image/logo.png" alt="" />
		<h1 class="head">There Are Movie Details And Reviews</a></h1>
	</div>
    <div class="form_part">
    <?php if ($movieId): ?>
        <?php if ($movie_row['image']): ?>
            <img class="movieImage" src="uploads/<?= $movie_row['image'] ?>" alt="" />
        <?php endif; ?>    
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
      <form method="post" action="addReview.php?id=<?= $movie_row['movieId'] ?>">
            <input type="hidden" name="movieId" value="<?= $movie_row['movieId'] ?>">
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
        <?php while ($row = $statement -> fetch()): ?>
            <div class="review-card">
                <div class="review-card-body" >
                    <h5 class="card-title"><?= $row['userName'] ?></h5>
                    <p class="card-subtitle mb-2 text-muted" style="padding-top:15px;"><?= $row['content'] ?></p>             
                </div>              
            </div>
        <?php endwhile ?>
        <?php endif?>
    
    </div>       
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</body>
</html>