<?php
    include_once '../Models/updateIngredientById.php';
    if (isset($_GET) && isset($_GET['id']) && isset($_GET['name']) && isset($_GET['price']) && isset($_GET['isvege']) && isset($_GET['isglutenfree']))
        echo json_encode(updateIngredientById($_GET['id'], $_GET['name'], $_GET['price'], $_GET['isvege'], $_GET['isglutenfree']));