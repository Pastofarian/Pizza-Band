<?php
    include_once '../Models/readAvailableIngredientsByPizzaId.php';
    if (isset($_GET) && isset($_GET['id']))
    echo json_encode(readAvailableIngredientsByPizzaId($_GET['id']));