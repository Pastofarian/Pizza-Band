<?php
    include_once '../Models/readPizzas.php';
    include_once '../Models/readDoughs.php';
    include_once '../Models/readSizes.php';
    include_once '../Models/readIngredients.php';
    include_once '../Models/readPizzaTotalPriceById.php';
    include_once '../Models/readIngredientsByPizzaId.php';

    $pizzas = readPizzas();
    if ($pizzas == 'NULL')
        $pizzas = array();
    for ($i = 0; $i < count($pizzas); $i++) {
        $pizzas[$i]['ingredients'] = readIngredientsByPizzaId($pizzas[$i]['id']);
        $pizzas[$i]['totalPrice'] = readPizzaTotalPriceById($pizzas[$i]['id'])[0]['price'];
    }
    echo json_encode(array(
        'pizzas' => $pizzas,
        'doughs' => readDoughs(),
        'sizes' => readSizes(),
        'ingredients' => readIngredients()
    ));