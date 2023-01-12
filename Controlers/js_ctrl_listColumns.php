<?php
    include_once '../Models/readColumns.php';
    
    if(isset($_GET) && isset($_GET['name']))
    {
        echo json_encode(readColumns($_GET['name']));
    }
   
