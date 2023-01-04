<?php
    function getPDO() {
        // if (isset($_SESSION) && isset($_SESSION["PDO"]))
        //     return $_SESSION["PDO"];
        $db;
        $username = "root";
        $password = "";
        $host = "localhost";
        $dbname = "Pizzas";
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
        try {
            $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);
        }
        catch(PDOException $ex){
            die("Failed to connect to the database: " . $ex->getMessage());
        }
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $db;
    }
    //PAGE DE CONNECTION A LA DB

