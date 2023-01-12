<?php   

    session_start();

    include_once('../Models/readIngredientById.php');
    include_once('../Models/readPizzaById.php');
    include_once('../Models/readPizzas.php');
    include_once('../Models/readIngredients.php');
    include_once('../Models/readIngredientsByPizzaId.php');
    include_once('../Models/readPizzaTotalPriceById.php');
    include_once('../Models/readDoughById.php');
    include_once('../Models/readSizeById.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
    }

    $currentOrder = array();

    if(!isset($_SESSION["order"]))
    {
          $_SESSION["order"] = [];
    }

    if(isset($data))
    {
        if (
            isset($data['pizzaId']) && checkPizza($data['pizzaId']) &&
            isset($data['quantity']) && checkQty($data['quantity']) &&
            (!isset($data['suppIds']) || (isset($data['suppIds']) && checkSupp($data['suppIds']))) &&
            isset($data['doughId']) && checkDough($data['doughId']) &&
            isset($data['sizeId']) && checkSize($data['sizeId'])
        ) 
        {   
            $currentOrder['pizzaId'] = $data['pizzaId'];
            $currentOrder['doughId'] = $data['doughId'];
            $currentOrder['sizeId']= $data['sizeId'];
            $currentOrder['quantity'] = $data['quantity'];
            if(isset($data['suppIds'])){
                $currentOrder['suppIds'] = $data['suppIds'];
            }
            array_push($_SESSION['order'], $currentOrder);
        }
    }


    function checkPizza($id)
    {
        //Reçoit un ID et s'assure que cet ID existe en DB
        if (readPizzaById($id) != 'NULL')
        {
            return true;
        }
        return false; 
    }

    function checkQty($qty)
    {
        return is_numeric($qty) == true;
    }

    function checkSupp($supp)
    {
        for($i = 0 ; $i < count($supp) ; $i++)
        {
            if (readIngredientById($supp[$i]) == 'NULL')
            {
                return false;
            }
        }
        return true;
    }

    function checkDough($id)
    {
        if (readDoughById($id) != 'NULL')
        {
            return true;
        }
        return false;
    }

    function checkSize($id)
    {
        if (readSizeById($id) != 'NULL')
        {
            return true;
        }
        return false;
    }

?>
