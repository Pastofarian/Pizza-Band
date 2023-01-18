<?php
include_once('connection.php');

function updatePizzaById($id, $name, $price){
    $query = "UPDATE `Pizza` SET `name`=:name, `price`=:price WHERE `id` = :id";
    $query_params = array(
        ':name' => $name,
        ':price' => $price,
        ':id' => $id,
    );
    try {
        $stmt = getPDO()->prepare($query);
        $result = $stmt->execute($query_params);
    } catch(PDOException $ex){
        die("Failed query : " . $ex->getMessage());
    }
}