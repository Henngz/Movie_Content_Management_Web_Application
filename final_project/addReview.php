<?php
	require('connect.php');
    echo !empty($_POST['userName'])? "true":"false"; 
    echo !empty($_POST['content'])? "true":"false"; 
    echo !empty($_POST['movieId'])? "true":"false"; 
    if (!empty($_GET['id'])) {
            $movieId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    
            if(!empty($_POST['userName']) && !empty($_POST['content'])){	
            
                // if(empty($_POST['userName']) || empty($_POST['userName'])){
                //     echo "<h1>"."Please input contents."."</h1>";
                // }	  	
                //  Sanitize user input to escape HTML entities and filter out dangerous characters.
                $userName= filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                
            
                //Build the parameterized SQL query and bind with values
                $query = "INSERT INTO Review (userName,content, movieId) VALUES (:userName,:content, :movieId)";
                $statement = $db -> prepare($query);
                
                //Bind values
                $statement->bindValue(':userName', $userName);
                $statement->bindValue(':content', $content);
                $statement->bindValue(':movieId', $movieId, PDO::PARAM_INT);
    
                //Execute the insert       
                echo $statement -> execute()? "atrue":"afalse"; 
                echo $movieId;
                header("Location:review.php?id={$movieId}");
            }
        }
    
?>
