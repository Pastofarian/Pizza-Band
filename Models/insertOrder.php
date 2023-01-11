<?php
include_once('connection.php');
function insertOrder(){
    
    $query = "INSERT INTO `Order`(`date`,`stateId`) VALUES(NOW(), 1)";
        $query_params = array(

        );
        try{
            $pdo = getPDO();
            $stmt = $pdo->prepare($query);
            $result = $stmt->execute($query_params);
            return $pdo->lastInsertId();
        }
        catch(PDOException $ex){
            die("Failed query : " . $ex->getMessage());
        }
}
