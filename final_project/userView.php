<?php
	include('search.php');
    $userId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

	if (!empty($_GET['id'])) {
    	if(!filter_var($_GET['id'],FILTER_VALIDATE_INT)){
            header("Location:home.php?");
            exit;
	    }

		// Sanitize the id. Like above but this time from INPUT_GET.
        $userId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        
        // Build the parametrized SQL query using the filtered id.
        $query = "SELECT * FROM User WHERE userId = :userId";
        $statement = $db->prepare($query);
        $statement->bindValue(':userId', $userId, PDO::PARAM_INT);
        
        // Execute the SELECT and fetch the single row returned.
        $statement->execute();
        $row = $statement->fetch();

	}
	else {
        $userId = false; // False if we are not UPDATING or SELECTING.
    }	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>User Details</title>
</head>
<body>

<div class="main">
	<div class="header">
		<img class="logo" src="image/logo.png" alt="" />
		<h1 class="head">User Details</a></h1>
    </div>

    <div class="form_part">
        <?php if ($userId): ?>
           
                <input type="hidden" name="userId" value="<?= $row['userId'] ?>">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">User Name</label>
                    <p><?= $row['userName'] ?></p>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Email</label>
                    <p> <?= $row['email'] ?></p>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">isAdmin</label>
                    <p><?= $row['isAdmin'] ?></p>
                </div>        
            
        <?php endif ?>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</body>
</html>