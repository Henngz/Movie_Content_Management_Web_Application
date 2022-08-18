<!------------------

    home.php
    Name: Yuheng Zhu
    Date: 2022-07-28
    Description: The php file is used to create the home page of the site.
   
-------------------->
<?php
     include('search.php');
?>
<!Doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>

  <body>
<div class="homepage_main">
    <div class="header">
      <img class="logo" src="image/logo.png" alt="" />
      <h1 class="head">What to watch</a></h1>
	  </div>
    <ul class="list-group">
      <li class="list-group-item"><a href="drama.php">Drama</a></li>
      <li class="list-group-item"><a href="action.php">Action</a></li>
      <li class="list-group-item"><a href="romance.php">Romance</li>
      <li class="list-group-item"><a href="comedy.php">Comedy</li>
      <li class="list-group-item"><a href="crime.php">Crime</a></li>
    </ul>
</div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
  </body>
</html>