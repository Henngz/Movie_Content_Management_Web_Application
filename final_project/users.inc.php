<?php
session_start();
function checkAdmin($db){
    If(isset($_SESSION["userName"])){
        // $query = "SELECT isAdmin FROM User WHERE userName = '".$_SESSION["userName"]."' limit 1;";
        // //$query = "SELECT isAdmin FROM User WHERE userName = 'lol' limit 1;";
        // $statement = $db -> prepare($query);
        // $statement -> execute();
        
        if($_SESSION["isAdmin"]==1){
            return true;
        }else{
            return false;
        }
            
    }
}
?>