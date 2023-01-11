<?php
include_once('connection.php');
function insertOrderlineSupp($ingredientId, $orderlineId){
    
    $query = "INSERT INTO `supplement`(`ingredientId`,`orderlineId`) VALUES(:ingredientId, :orderlineId)";
        $query_params = array(
            ":ingredientId" => $ingredientId,
            ":orderlineId" => $orderlineId,
        );

        try{
            $stmt = getPDO()->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex){
            die("Failed query : " . $ex->getMessage());
        }
}
