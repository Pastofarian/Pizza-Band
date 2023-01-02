<?php
include '../Models/readIngredientbyId.php';
include '../Models/readPizzaById.php';
include '../Models/readPizzas.php';
include '../Models/readIngredients.php';





function deleteOrderLine($index)
{
    unset($_SESSION["order"][$index]);
}


function addOrderLine($values)
{
    array_push($_SESSION["order"], $values);
}

?>