<?php

function insertDB($LastName, $FirstName, $DOB, $Email, $Password){
    include('connection.php');
    $query = "INSERT INTO User (LastName, FirstName, DOB, Email, Password) VALUES(:LastName, :FirstName, :DOB, :Email, :Password)";
        $query_params = array(':LastName'=>$LastName,
                              ':FirstName'=>$FirstName,
                                ':DOB'=>$DOB,
                                ':Email'=>$Email,
                                ':Password'=>$Password);
        try{
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex){
            die("Failed query : " . $ex->getMessage());
        }
}

//insertDB("Doe", "John", "2022-08-05", "john.doe@outlook.com", "pass");
?>