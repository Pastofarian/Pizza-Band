<?php
include_once 'connection.php';
function readPizzaTotalPriceById($id){
    $query = "SELECT `Pizza`.id, SUM(`Pizza`.price + COALESCE(`IngredientsOnPizza`.price, 0)) AS price
    FROM `Pizza`
    LEFT JOIN (
        SELECT `Pizza`.id AS pizzaId, SUM(`Ingredient`.price) AS price
        FROM `Pizza_Ingredient`
        INNER JOIN `Pizza` ON `Pizza_Ingredient`.pizzaId = `Pizza`.id
        INNER JOIN `Ingredient` ON `Pizza_Ingredient`.ingredientId = `Ingredient`.id
        WHERE `Pizza`.id = :id
    ) AS `IngredientsOnPizza` ON `IngredientsOnPizza`.pizzaId IS NOT NULL = `Pizza`.id
    GROUP BY `Pizza`.id";
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