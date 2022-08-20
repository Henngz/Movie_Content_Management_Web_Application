<?php
    
    require('function.php');

    if(isset($_POST["submit"])){
        $userName = $_POST["userName"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $passwordRepeat = $_POST["passwordRepeat"];

        if(emptyInputSignup($userName,$email, $password,$passwordRepeat )!== false){
            header("location:signUp.php?error=emptyinput");
            exit();
        }

        if(pwdMatch($password,$passwordRepeat)!== false){
            header("location:signUp.php?error=passwordsdontmatch");
            exit();
        }

        // if(userIdExists($db,$userName,$email)!== false){
        //     header("location:signUp.php?error=usernametaken");
        //     exit();
        // }
        
        createUser($userName,$email, $password,$db);

    }else{
        header("location:signUp.php");
        exit();
    }
?>
