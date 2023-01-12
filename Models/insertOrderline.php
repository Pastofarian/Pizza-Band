<?php
include_once('connection.php');
function insertOrderLine($orderId, $quantity, $pizzaId, $doughId, $sizeId, $price){
    
    $query = "INSERT INTO `Orderline`(`orderId`,`quantity`, `pizzaId`, `sizeId`, `doughId`, `price`) VALUES(:orderId, :quantity, :pizzaId, :sizeId, :doughId, :price)";
        $query_params = array(
            ":orderId" => $orderId,
            ":quantity" => $quantity,
            ":pizzaId" => $pizzaId,
            ":doughId" => $doughId,
            ":sizeId" => $sizeId,
            ":price" => $price,
        );
        try{
            $pdo = getPDO();
            $stmt = $pdo->prepare($query);
            $result = $stmt->execute($query_params);
            return $pdo->lastInsertId();
        }
        catch(PDOException $ex){
            die("Failed query : " . $ex->getMessage());
        }
}


