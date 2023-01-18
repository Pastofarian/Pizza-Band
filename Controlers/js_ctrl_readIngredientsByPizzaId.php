<?php
    include_once '../Models/readIngredientsByPizzaId.php';
    if (isset($_GET) && isset($_GET['id'])) {
        $pizzaIngredients = readIngredientsByPizzaId($_GET['id']);
        if ($pizzaIngredients == 'NULL') $pizzaIngredients = array();
    }
        echo json_encode($pizzaIngredients);