<!------------------

    update.php
    Name: Yuheng Zhu
    Date: 2022-08-14
    Description: The php file is used to create a website to update or delete post.
	
-------------------->
<?php
	include('search.php');
	$movieId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

	if(isset($_REQUEST['deletebtn'])){
		 $movieId=filter_input(INPUT_POST, 'movieId', FILTER_SANITIZE_NUMBER_INT);
		 $query = "DELETE FROM Movie where movieId = :movieId LIMIT 1"; 
		 $statement = $db->prepare($query);
	     $statement->bindValue(':movieId', $movieId, PDO::PARAM_INT);
	     $statement->execute();
	      	
        // Redirect after update.
         header("Location:movie.php?");
         exit;
	 }

	 if ($_POST && !empty($_POST['movieId']) && !empty($_POST['description']) && !empty($_POST['movieName'])&& !empty($_POST['categoryId'])&& !empty($_POST['year'])) {

        // Sanitize user input to escape HTML entities and filter out dangerous characters.
        $movieName = filter_input(INPUT_POST, 'movieName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
        $year= filter_input(INPUT_POST, 'year', FILTER_SANITIZE_NUMBER_INT);
        $movieId= filter_input(INPUT_POST, 'movieId', FILTER_SANITIZE_NUMBER_INT);

        // Build the parameterized SQL query and bind to the above sanitized values.
        $query = "UPDATE Movie SET movieName = :movieName, description = :description, year= :year, categoryId = :categoryId WHERE movieId = :movieId";
        $statement = $db->prepare($query);
        
        //Bind values
        $statement->bindValue(':movieName', $movieName);        
        $statement->bindValue(':description', $description);
        $statement->bindValue(':year', $year);
        $statement->bindValue(':categoryId', $categoryId);
        $statement->bindValue(':movieId', $movieId, PDO::PARAM_INT);
        
        // Execute the INSERT.
        $statement->execute();
        
        // Redirect after update.
         header("Location: update.php?id={$movieId}");
         exit;

    }else if (!empty($_GET['id'])) {
    	if(!filter_var($_GET['id'],FILTER_VALIDATE_INT)){
            header("Location:home.php?");
            exit;
	    }

		// Sanitize the id. Like above but this time from INPUT_GET.
        $movieId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        
        // Build the parametrized SQL query using the filtered id.
        $query = "SELECT * FROM Movie WHERE movieId = :movieId";
        $statement = $db->prepare($query);
        $statement->bindValue(':movieId', $movieId, PDO::PARAM_INT);
        
        // Execute the SELECT and fetch the single row returned.
        $statement->execute();
        $row = $statement->fetch();

	}else if(!filter_var($_POST['movieId'],FILTER_VALIDATE_INT) || !strlen($_POST['movieName'])<1 || !strlen($_POST['description'])<1){
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
	<link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Update Movie</title>
</head>
<body>

<div class="main">
	<div class="header">
		<img class="logo" src="image/logo.png" alt="" />
		<h1 class="head">Update The Movie</a></h1>
	</div>

    <div class="form_part">
    <?php if ($movieId): ?>
		<form method="post" action="update.php">
			<input type="hidden" name="movieId" value="<?= $row['movieId'] ?>">
			<div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Movie Name</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="movieName" value="<?= $row['movieName'] ?>">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <input type="text" class="form-control" id="exampleFormControlInput2" name="description" value="<?= $row['description'] ?>">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Year</label>
                <input type="number" class="form-control" id="exampleFormControlInput3" name="year" value="<?= $row['year'] ?>">
            </div>

            <select class="form-select" aria-label="Default select example" name="categoryId">
                <!-- <?php if($row['categoryId']==1): ?>
                    <option selected >Drama</option>
                <?php elseif($row['categoryId']==2): ?>    
                    <option selected>Romance</option>
                <?php elseif($row['categoryId']==3): ?>
                    <option selected >Comedy</option>
                <?php elseif($row['categoryId']==4): ?>
                    <option selected>Crime</option>
                <?php elseif($row['categoryId']==5): ?>
                    <option selected>Action</option>
                <?php endif; ?> -->
                <option value="1">Drama</option>
                <option value="2">Romance</option>
                <option value="3">Comedy</option>
                <option value="4">Crime</option>
                <option value="5">Action</option>

            </select>
            <div>
            <input type="submit" id="updatebutton" value='Update'>
			<input type='submit' name='deletebtn' id="deletebutton" value='Delete'>
            </div>         
		</form>
        <?php endif ?>
        </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</body>
</html>