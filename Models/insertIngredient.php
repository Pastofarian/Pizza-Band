<?php
include_once 'connection.php';
function insertIngredient($name, $price, $isVege, $isGluFree){
    $query = "INSERT INTO Ingredient (`name`, `price`, `isVege`, `isGlutenFree`) VALUES (:name, :price, :isVege, :isGlutenFree)";
    $query_params = array(
        ':name'=>$name,
        ':price'=>$price,
        ':isVege'=>$isVege,
        ':isGlutenFree'=>$isGluFree,
    );
    try {
        $stmt = getPDO()->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex){
        die("Failed query : " . $ex->getMessage());
    }
}
insertIngredient("Lard", 2, 0, 1);

//insertDB("Doe", "John", "2022-08-05", "john.doe@outlook.com", "pass");
?>