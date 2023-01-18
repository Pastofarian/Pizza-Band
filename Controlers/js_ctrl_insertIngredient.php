<?php
    include_once '../Models/insertIngredient.php';
    // also check if admin
    $toJson = array();
    if (isset($_GET) && isset($_GET['name']) && isset($_GET['price']) && isset($_GET['isvege']) && isset($_GET['isglutenfree'])) {
        $toJson['newIndex'] = insertIngredient($_GET['name'], $_GET['price'], $_GET['isvege'], $_GET['isglutenfree']);
    }
    echo json_encode($toJson);