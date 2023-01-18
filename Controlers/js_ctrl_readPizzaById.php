<?php
    include_once '../Models/readPizzaById.php';
    if (isset($_GET) && isset($_GET['id']))
        echo json_encode(readPizzaById($_GET['id']));