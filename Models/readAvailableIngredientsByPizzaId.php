<?php
include_once 'connection.php';
function readAvailableIngredientsByPizzaId($id){
    $query = "SELECT *
        FROM `Ingredient`
        WHERE id NOT IN (
            SELECT `Pizza_Ingredient`.ingredientId
            FROM `Pizza_Ingredient`
            INNER JOIN `Pizza` ON `Pizza_Ingredient`.pizzaId = `Pizza`.id
            WHERE `Pizza`.id = :id
        )";
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