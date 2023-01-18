<?php
    include_once '../Models/readIngredients.php';
    $ingredients = readIngredients();
    if ($ingredients == 'NULL') $ingredients = array();
    echo json_encode($ingredients);