<?php
include_once 'connection.php';
function readIngredient($id){
    $query = "SELECT * FROM `Ingredient` WHERE id = :id";
    $query_params = array(
        ':id'=>$id
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
var_dump(readIngredient(9));

//insertDB("Doe", "John", "2022-08-05", "john.doe@outlook.com", "pass");
?>