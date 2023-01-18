<?php
include_once 'connection.php';
function insertPizzaIngredient($pizzaId, $ingredientId){
    $query = "INSERT INTO `Pizza_Ingredient` (`pizzaId`, `ingredientId`) VALUES (:pizzaId, :ingredientId)";
    $query_params = array(
        ':pizzaId'=>$pizzaId,
        ':ingredientId'=>$ingredientId,
    );
    try {
        $pdo = getPDO();
        $stmt = $pdo->prepare($query);
        $result = $stmt->execute($query_params);
        return $pdo->lastInsertId();
    }
    catch(PDOException $ex){
        die("Failed query : " . $ex->getMessage());
    }
}


