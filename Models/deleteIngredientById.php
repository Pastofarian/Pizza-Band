<?php
include_once 'connection.php';
function deleteIngredientById($id){
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