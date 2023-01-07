<?php
    session_start();

    include_once '../Models/readPizzaById.php';
    include_once '../Models/readDoughById.php';
    include_once '../Models/readSizeById.php';
    include_once '../Models/readIngredientById.php';

    if(isset($_SESSION) && isset($_SESSION['order']))
    {
        $json_arr = [];
        foreach($_SESSION['order'] as $i => $orderline)
        {
            $json_arr[$i] = [];
            $json_arr[$i]['pizzaId'] = readPizzaById($orderline['pizzaId'])[0];
            $json_arr[$i]['doughId'] = readDoughById($orderline['doughId'])[0];
            $json_arr[$i]['sizeId'] = readSizeById($orderline['sizeId'])[0];
            $json_arr[$i]['suppIds'] = [];
            $json_arr[$i]['quantity'] = $orderline['quantity'];
            foreach($orderline['suppIds'] as $j => $supp)
            {
                $json_arr[$i]['suppIds'][$j] = readIngredientById($supp)[0];
            }
        }
        echo json_encode($json_arr);
    }
