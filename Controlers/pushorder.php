<?php 
include '../Models/insertOrder.php';
include '../Models/insertOrderline.php';
include '../Models/readPizzaById.php';
include '../Models/readDoughById.php';
include '../Models/readSizeById.php';
include '../Models/readIngredientById.php';
include '../Models/readIngredientsByPizzaId.php';
include '../Models/insertOrderlineSupp.php';

session_start();

$orderId = insertOrder();
for($i = 0 ; $i < count($_SESSION["order"]); $i++)
{
    $quantity = $_SESSION["order"][$i]['quantity'];
    $pizzaId = $_SESSION["order"][$i]['pizzaId'];
    $doughId = $_SESSION["order"][$i]['doughId'];
    $sizeId = $_SESSION["order"][$i]['sizeId'];
    $suppIds = $_SESSION["order"][$i]['suppIds'];
    $price = computePrice($pizzaId, $doughId, $sizeId, $suppIds) * $quantity;
    $orderlineId = insertOrderline($orderId, $quantity, $pizzaId, $doughId, $sizeId, $price);
    for($j = 0 ; $j < count($suppIds) ; $j++)
    {
        insertOrderlineSupp($suppIds[$j], $orderlineId);
    }
}

function computePrice($pizzaId, $doughId, $sizeId, $suppIds)
{
    if(($pizza = readPizzaById($pizzaId)) == 'NULL') return;
    if(($dough = readDoughById($doughId)) == 'NULL') return;
    if(($size = readSizeById($sizeId)) == 'NULL') return; 
    if(($pizzaIngredients = readIngredientsByPizzaId($pizzaId)) == 'NULL') return; 
    $ingredientOnPizzaTotalPrice = 0;
    for($i = 0 ; $i < count($pizzaIngredients) ; $i++)
    { 
        $ingredientOnPizzaTotalPrice += $pizzaIngredients[$i]['price'];
    }
    $suppsTotalPrice = 0;
    for($i = 0 ; $i < count($suppIds) ; $i++)
    {
        if(($ingredient = readIngredientById($suppIds[$i])) == 'NULL') return;  
        $suppsTotalPrice += $ingredient[0]['price'];
    }

    return $pizza[0]['price'] + $dough[0]['price'] + $size[0]['price'] + $ingredientOnPizzaTotalPrice + $suppsTotalPrice;
}

$_SESSION["order"] = NULL;

header("Location: ../Views/order_confirmation.php");