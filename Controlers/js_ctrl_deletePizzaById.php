<?php
    include_once '../Models/deletePizzaById.php';
    // also check if admin
    $toJson = array();
    if (isset($_GET) && isset($_GET['id'])) {
        deletePizzaById($_GET['id']);
    }
    echo json_encode($toJson);