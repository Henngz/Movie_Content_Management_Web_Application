<?php
    require('search.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css" />
  <script src="ckeditor/ckeditor.js"></script>
  <title>Log in</title>
</head>
<body>
    
<div class="main">
	<div class="header">
		<img class="logo" src="image/logo.png" alt="" />
		<h1 class="head">Log in Now</a></h1>
</div>

<!--  
    Call function.php and signup.inc.php to work.
 -->

<section class="text-center">
<?php
 
 if(isset($_GET["error"])){
     if($_GET["error"]=="emptyinput"){
         echo"<h2>Please fill in all fields.</h2>";
     }elseif($_GET["error"]=="wrongInformation"){
         echo"<h2>Information is wrong.</h2>";
     }elseif($_GET["error"]=="none"){
         echo"<h2>Sign up successfully!</h2>";
     }
 } 
?>
  <div class="card mx-4 mx-md-5 shadow-5-strong" style="
        background: hsla(0, 0%, 100%, 0.8);
        backdrop-filter: blur(30px);
        width:700px;
        height:500px;
        ">
    <div class="card-body py-5 px-md-5">

      <div class="row d-flex justify-content-center">
       
          <form method="POST" action="login.inc.php" >
            <!-- Username input -->
            <div class="form-outline mb-4">
              <input type="text" id="form3Example1" class="form-control" name="userName"/>
             <label class="form-label" for="form3Example1">Username</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
              <input type="password" id="form3Example3" class="form-control" name="password"/>
              <label class="form-label" for="form3Example3">Password</label>
            </div>
            
            <!-- Submit button -->
            <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">
              Sign in
            </button>

            <p>Not a member? <a href="signUp.php">Register</a></p>
         </form>
        </div>
      </div>
    </div>
    
</section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</body>
</html>