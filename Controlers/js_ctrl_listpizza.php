<?php
    include_once '../Models/readPizzas.php';
    
    echo json_encode(readPizzas());