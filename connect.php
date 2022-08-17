<!------------------

    connect.php
    Name: Yuheng Zhu
    Date: 2022-08-12
    Description: The php file is used to create a connect to the database.
   
-------------------->
<?php
     define('DB_DSN','mysql:host=localhost;dbname=serverside;charset=utf8');
     define('DB_USER','serveruser');
     define('DB_PASS','gorgonzola7!');     
     
     try {
         // Try creating new PDO connection to MySQL.
         $db = new PDO(DB_DSN, DB_USER, DB_PASS);    
     } catch (PDOException $e) {
         print "Error: " . $e->getMessage();
         die(); 
     }
 ?>