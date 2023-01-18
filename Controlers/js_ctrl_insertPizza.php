<?php
    include_once '../Models/insertPizza.php';
    // also check if admin
    $toJson = array();
    if (isset($_GET) && isset($_GET['name']) && isset($_GET['price'])) {
        $toJson['newIndex'] = insertPizza($_GET['name'], $_GET['price']);
    }
    echo json_encode($toJson);