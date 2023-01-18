<?php
    include_once '../Models/insertPizzaIngredient.php';
    // also check if admin
    $toJson = array();
    if (isset($_GET) && isset($_GET['pizzaId']) && isset($_GET['ingredientId'])) {
        $toJson['newIndex'] = insertPizzaIngredient($_GET['pizzaId'], $_GET['ingredientId']);
    }
    echo json_encode($toJson);

