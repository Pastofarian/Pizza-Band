<?php
    include_once '../Models/deletePizzaIngredientById.php';
    // also check if admin
    $toJson = array();
    if (isset($_GET) && isset($_GET['id'])) {
        echo json_encode(deletePizzaIngredientById($_GET['id']));
    }
    //echo json_encode($toJson);