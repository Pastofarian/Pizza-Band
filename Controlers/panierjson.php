<?php
    session_start();

    include_once '../Models/readPizzaById.php';
    include_once '../Models/readIngredientById.php';

    if(isset($_SESSION) && isset($_SESSION['order']))
    {
        $json_arr = [];
        foreach($_SESSION['order'] as $key => $values)
        {
            $json_arr[$key] = [];
            foreach($values as $k => $v)
            {
                if($k == 'pizza')
                {
                    $json_arr[$key][$k] = readPizzaById($v)[0];
                }
                else if ($k == 'supp')
                {
                    $json_arr[$key][$k] = [];
                    foreach($v as $suppkey => $suppvalues)
                    {
                        $json_arr[$key][$k][$suppkey] = readIngredientById($suppvalues)[0];
                    }
                }
                else 
                {
                    $json_arr[$key][$k] = $v;
                }
            }
        }
        echo json_encode($json_arr);
    }
