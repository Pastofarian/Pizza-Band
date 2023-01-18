<?php   

    session_start();

    include_once('../Models/readIngredientById.php');
    include_once('../Models/readPizzaById.php');
    include_once('../Models/readPizzas.php');
    include_once('../Models/readIngredients.php');
    include_once('../Models/readIngredientsByPizzaId.php');
    include_once('../Models/readPizzaTotalPriceById.php');

    $pizzas = readPizzas();
    if ($pizzas == 'NULL')
        $pizzas = array();
    for ($i = 0; $i < count($pizzas); $i++) {
        $pizzas[$i]['ingredients'] = readIngredientsByPizzaId($pizzas[$i]['id']);
        $pizzas[$i]['totalPrice'] = readPizzaTotalPriceById($pizzas[$i]['id'])[0]['price'];
    }
    $_SESSION["pizzasList"] = $pizzas;
    $_SESSION["suppList"] = readIngredients();

    $currentOrder = [];

    if(!isset($_SESSION["order"]))
    {
          $_SESSION["order"] = [];
    }

    //partie déplacée vers un controleur appelé par le javascript 
    //var_dump($_POST);

    /*if(isset($_POST))
    {
        if(isset($_POST['pizza']) && checkPizza($_POST['pizza']) &&
            isset($_POST['qty']) && checkQty($_POST['qty']) &&
            (!isset($_POST['supp']) || (isset($_POST['supp']) && checkSupp($_POST['supp']))))
        {   
            $currentOrder['pizza'] = $_POST['pizza'];
            $currentOrder['qty'] = $_POST['qty'];
            if(isset($_POST['supp'])){
                $currentOrder['supp'] = $_POST['supp'];
            }
            array_push($_SESSION['order'], $currentOrder);
        }
    }*/

    header('Location: ../Views/menu_pizzas.php');


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


