<?php
include_once 'connection.php';
function deleteIngredient($id){
    $query = "DELETE FROM `Ingredient` WHERE id = :id";
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
}
deleteIngredient(10);

//insertDB("Doe", "John", "2022-08-05", "john.doe@outlook.com", "pass");
?>