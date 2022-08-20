<?php
    require('search.php');
    //Sign up function
    function emptyInputSignup($userName,$email, $password,$passwordRepeat){
        $result = true;
        if(empty($userName)||empty($email)||empty($password)||empty($passwordRepeat)){
            $result=true;
        }
        else{
            $result=false;
        }
        return $result;
    }

    function pwdMatch($password,$passwordRepeat){
        $result = true;
        if($password !== $passwordRepeat){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    function createUser($userName,$email, $password,$db){     
        $hashedPassword = password_hash($password,PASSWORD_DEFAULT);

        $query = "INSERT INTO User (userName,email,password) VALUES (:userName,:email,:password)";
        $statement = $db -> prepare($query);

         //Bind values
         $statement->bindValue(':userName', $userName);
         $statement->bindValue(':email', $email);
         $statement->bindValue(':password', $hashedPassword);
    
         $statement -> execute();    
         header("location: signUp.php?error=none");
         exit();
    }

    // Login function
    function emptyInputLogin($userName,$password){
        $result = true;
        if(empty($userName)||empty($password)){
            $result=true;
        }
        else{
            $result=false;
        }
        return $result;
    }

    function loginUser($db,$userName,$password){

        $sql = "SELECT * FROM User WHERE userName = '%".$userName."%' AND password= '%".$password."%' limit 1";
        
        $statement = $db -> prepare($sql);
         $statement -> execute(); 
         $row = $statement -> fetch();
         echo $row;
        if($row == 1){
            header("location: home.php");
            exit();
        }

    }

?> 