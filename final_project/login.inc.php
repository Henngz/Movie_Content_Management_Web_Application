<?php
     require('connect.php');

    //echo !empty($_POST["userName"])? "true":"false";

     if(empty($_POST["userName"]) || empty($_POST["password"])){
        header("location:login.php?error=emptyinput");
        exit();
     }

   

    if(!empty($_POST["userName"]) && !empty($_POST["password"])){
        $userName = $_POST["userName"];
        $password = $_POST["password"];
        
        loginUser($db,$userName,$password);
    }
    

    function loginUser($db,$userName,$password){

        $sql = "SELECT * FROM User WHERE userName = '".$userName."'"; 
        $statement = $db -> prepare($sql);
         $statement -> execute(); 
        $row=  $statement -> fetch(); 
         $rowCount= $statement -> rowCount();
        
        if($rowCount == 1){
            $result = password_verify($password,$row["password"]);
            if($result){
                session_start();
            
                $_SESSION["userName"] = $row["userName"];
                $_SESSION["isAdmin"] = $row["isAdmin"];
                header("location: home.php?error=none");
                exit();
            }else{
                header("location: login.php?error=wrongInformation");
                exit();
            }
            
        }else{
            header("location: login.php?error=wrongInformation");
            exit();
        }

    }
    
?>