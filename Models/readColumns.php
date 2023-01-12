<?php
    include_once 'connection.php';
    function readColumns($table){
        $query = "SHOW COLUMNS FROM {$table}";
        $query_params = array();
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