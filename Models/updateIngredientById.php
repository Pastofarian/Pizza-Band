<?php
include_once('connection.php');
function updateIngredientById($id, $name, $price, $isVege, $isGlutenFree){
    $query = "UPDATE `Ingredient` SET `name`=:name, `price`=:price, `isVege`=:isVege, `isGlutenFree`=:isGlutenFree WHERE `id` = :id";
    $query_params = array(
        ':id' => $id,
        ':name' => $name,
        ':price' => $price,
        'isVege' => $isVege,
        'isGlutenFree' => $isGlutenFree
    );
    try {
        $stmt = getPDO()->prepare($query);
        $result = $stmt->execute($query_params);
    } catch(PDOException $ex){
        die("Failed query : " . $ex->getMessage());
    }
}