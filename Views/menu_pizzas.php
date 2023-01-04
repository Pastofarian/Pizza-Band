<?php 
session_start();
include_once('../Functions/functions.php');
include_once('../Models/readPizzas.php');
include_once('../Models/readIngredients.php');
include_once('../Models/readPizzaById.php');
// include_once('../Models/readIngredientById.php');

if(!(isset($_SESSION["pizzasList"])) || !(isset($_SESSION["suppList"])))
{
   header("Location: ../Controlers/orderline.php");
}
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="../CSS/style.css">
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script type="text/javascript" src="../Functions/panierjsonscript.js"></script>
      <title>Menu des pizzas</title>
   </head>
   <body>

      <?php
      include('header.php');
      ?>
      <a href="menu_pizzas.php"><img src="../Images/small_logo.png" id="small_logo"></a>
      <div class="menu_title">
         <h1>Les Pizzas</h1>
      </div>


      <div class="container_menu">
         
         <?php 


         include('orderline.php');
         
         include('panier.php');



         ?>

         </div>
         <?php 
         include('footer.php');
         ?>
   

   </body>
</html>
