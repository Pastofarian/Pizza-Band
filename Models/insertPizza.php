<?php
include_once 'connection.php';
function insertPizza($name, $price){
    $query = "INSERT INTO `Pizza` (`name`, `price`) VALUES (:name, :price)";
    $query_params = array(
        ':name'=>$name,
        ':price'=>$price,
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


