<?php
    include_once '../Models/deleteIngredientById.php';
    // also check if admin
    $toJson = array();
    if (isset($_GET) && isset($_GET['id'])) {
        deleteIngredientById($_GET['id']);
    }
    echo json_encode($toJson);