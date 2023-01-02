<?php
include_once 'connection.php';
function readCityById($id){
    $query = "SELECT * FROM `City` WHERE id = :id";
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
