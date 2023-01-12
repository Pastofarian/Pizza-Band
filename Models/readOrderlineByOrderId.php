<?php
include_once 'connection.php';
function readIngredientsByPizzaId($id){
    $query = "SELECT `Pizza_Ingredient`.id AS 'PizzaIngredientId', `Ingredient`.*
        FROM `Pizza_Ingredient`
        INNER JOIN `Pizza` ON `Pizza_Ingredient`.pizzaId = `Pizza`.id
        INNER JOIN `Ingredient` ON `Pizza_Ingredient`.ingredientId = `Ingredient`.id
        WHERE `Pizza`.id = :id
        ORDER BY `Ingredient`.id";
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

