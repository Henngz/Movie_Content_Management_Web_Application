<?php
    require('search.php');

    $query = "SELECT * FROM User ORDER BY userId";  
    $statement = $db -> prepare($query);
	$statement -> execute();
?>

<!Doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
  <body>

<div class="homepage_main">
    <div class="header">
      <img class="logo" src="image/logo.png" alt="" />
      <h1 class="head">Manage Users</a></h1>
</div>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>


<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>User Id</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>isAdmin</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = $statement -> fetch()): ?>            
                    <tr>
                        <td><?= $row['userId'] ?></td>
                        <td><?= $row['userName'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['isAdmin'] ?></td>
                        <td>
                            <a href="userView.php?id=<?= $row['userId'] ?>">view</a>
                            <a href="userUpdate.php?id=<?= $row['userId'] ?>">edit</a>
                            <a href="userUpdate.php?id=<?= $row['userId'] ?>">delete</a>
                        </td>
                    </tr>    
                <?php endwhile; ?>                           
            </div>
        </div>
    </div>  
</div>  
                  
</body>
</html>