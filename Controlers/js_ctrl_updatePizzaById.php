<?php
    include_once '../Models/updatePizzaById.php';
    if (isset($_GET) && isset($_GET['id']) && isset($_GET['name']) && isset($_GET['price']))
        echo json_encode(updatePizzaById($_GET['id'], $_GET['name'], $_GET['price']));