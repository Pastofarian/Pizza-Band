<?php
    include_once '../Models/readPizzas.php';
    include_once '../Models/readPizzaTotalPriceById.php';
    include_once '../Models/readIngredientsByPizzaId.php';

    $pizzas = readPizzas();
    if ($pizzas == 'NULL') $pizzas = array();

    for ($i = 0; $i < count($pizzas); $i++) {
        $pizzaTotalPrice = readPizzaTotalPriceById($pizzas[$i]['id'])[0]['price'];
        if ($pizzaTotalPrice == 'NULL') $pizzaTotalPrice = 'null';
        $pizzas[$i]['totalPrice'] = $pizzaTotalPrice;
        $pizzaIngredients = readIngredientsByPizzaId($pizzas[$i]['id']);
        if ($pizzaIngredients == 'NULL') $pizzaIngredients = array();
        $pizzas[$i]['ingredients'] = $pizzaIngredients;
    }
    echo json_encode($pizzas);