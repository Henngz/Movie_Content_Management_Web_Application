<?php
	include('search.php');
    $userId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

	if(isset($_REQUEST['deletebtn'])){
       
        $userId=filter_input(INPUT_POST, 'userId', FILTER_SANITIZE_NUMBER_INT);
        echo  $userId;
        $query = "DELETE FROM User where userId = :userId LIMIT 1"; 
        $statement = $db->prepare($query);
        $statement->bindValue(':userId', $userId, PDO::PARAM_INT);
        echo $statement->execute()? "true":"false";
             
       // Redirect after update.
        // header("Location:home.php?");
        // exit;
    }
    
	 if ($_POST && !empty($_POST['userName']) && !empty($_POST['email']) && !empty($_POST['userId'])) {

        // Sanitize user input to escape HTML entities and filter out dangerous characters.
        $userName = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $isAdmin = filter_input(INPUT_POST, 'isAdmin', FILTER_SANITIZE_NUMBER_INT);
        $userId= filter_input(INPUT_POST, 'userId', FILTER_SANITIZE_NUMBER_INT);

        // Build the parameterized SQL query and bind to the above sanitized values.
        $query = "UPDATE User SET userName = :userName, email = :email, isAdmin= :isAdmin WHERE userId = :userId";
        $statement = $db->prepare($query);
        
        //Bind values
        $statement->bindValue(':userName', $userName);        
        $statement->bindValue(':email', $email);
        $statement->bindValue(':isAdmin', $isAdmin);
        $statement->bindValue(':userId', $userId, PDO::PARAM_INT);
        
        // Execute the INSERT.
        $statement->execute();
        
        // Redirect after update.
         header("Location: users.php?id={$userId}");
         exit;

    }else if (!empty($_GET['id'])) {
    	// if(!filter_var($_GET['id'],FILTER_VALIDATE_INT)){
        //     header("Location:home.php?");
        //     exit;
	    // }

		// Sanitize the id. Like above but this time from INPUT_GET.
        $userId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        
        // Build the parametrized SQL query using the filtered id.
        $query = "SELECT * FROM User WHERE userId = :userId";
        $statement = $db->prepare($query);
        $statement->bindValue(':userId', $userId, PDO::PARAM_INT);
        
        // Execute the SELECT and fetch the single row returned.
        $statement->execute();
        $row = $statement->fetch();

	}else if(!filter_var($_POST['userId'],FILTER_VALIDATE_INT)|| strlen($_POST['userName'])<1 || strlen($_POST['email'])<1){
		echo "<h1>"."You do not input correct datas."."</h1>";     
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
    <title>Update User</title>
</head>
<body>

<div class="main">
	<div class="header">
		<img class="logo" src="image/logo.png" alt="" />
		<h1 class="head">Update The User</a></h1>
    </div>

    <div class="form_part">
        <?php if ($userId): ?>
            <form method="post" action="userUpdate.php">
                <input type="hidden" name="userId" value="<?= $row['userId'] ?>">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">User Name</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="userName" value="<?= $row['userName'] ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Email</label>
                    <input type="text" class="form-control" id="exampleFormControlInput2" name="email" value="<?= $row['email'] ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">isAdmin</label>
                    <input type="text" class="form-control" id="exampleFormControlInput3" name="isAdmin" value="<?= $row['isAdmin'] ?>">
                </div>
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