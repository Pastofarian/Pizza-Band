<?php
include_once('connection.php');
function insertUser($firstname, $name, $email, $pass, $address, $cityId){
    
    $query = "INSERT INTO User (firstname, name, email, pass, address, cityId) VALUES(:firstname, :name, :email, :pass, :address, :cityId)";
        $query_params = array(
            ':firstname'=>$firstname,
            ':name'=>$name,
            ':email'=>$email,
            ':pass'=>$pass,
            ':address'=>$address,
            ':cityId'=>$cityId
        );
        try{
            $stmt = getPDO()->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex){
            die("Failed query : " . $ex->getMessage());
        }
}


//insertUser("John", "Doe", 'John@outlook.com', 'test45', 'Rue du poulet 666', 2);
?>