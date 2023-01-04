<?php
include_once 'connection.php';
function readUserByEmail($email){
    $query = "SELECT * FROM `User` WHERE email = :email";
    $query_params = array(
        ':email'=>$email
    );
    try {
        $stmt = getPDO()->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex){
        die("Failed query : " . $ex->getMessage());
    }
    $result = $stmt->fetchall();
    return (!empty($result)) ? $result: 'NULL';
}
