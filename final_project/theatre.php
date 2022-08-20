<?php
    require('search.php');
?>

<!Doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/get_theatre.css" />
    <title>Find Theatre</title>
</head>
<body>
    <div class="container">
    <div class="homepage_main">
        <div class="header">
        <img class="logo" src="image/logo.png" alt="" />
        <h1 class="head">Manage Users</a></h1>
    </div>
        <form class="search-bar">
            <input type="text" id="searchBar" placeholder="search" name="searchBar">
            <button id="btn" type="button"><img src="./image/search.png" alt=""></button>
        </form>
        <p style="color:rgb(118, 118, 118); padding-top:20px;padding-left:5px;">Try searching for Acorn Theater, or 45, or Broadway.</p>
    </div>

    <div class="tablecontainer">
        <h1 id="error">Cannot find any theatres.</h1>
        <table id="table">
            <thead id="table-head">
                <tr>
                    <th>Theatre Name</th>
                    <th>Address</th>
                    <th>Contact</th>
                    <th>Zip Code</th>
                </tr>
            </thead>
            <tbody id="table-body">          
            </tbody>
        </table>
    </div>
  
    <script src="js/ajax_get_theatre.js"></script>
</body>
</html>