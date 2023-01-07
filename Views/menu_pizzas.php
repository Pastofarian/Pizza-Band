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
      <link rel="stylesheet" href="../CSS/nav.css">
      <link rel="stylesheet" href="../CSS/kanban.css">
      <link rel="stylesheet" href="../CSS/footer.css">
      <link rel="stylesheet" href="../CSS/panier.css">
      <script type="text/javascript" src="../Functions/listingpizzas.js" defer></script>
      <title>Menu des pizzas</title>
   </head>
   <body>
      <header></header>
      <?php
         include('nav.php');
      ?>
      <div class="container_menu">
         <div id="menu">
            <h2>Nos Pizzas</h2>
            <?php 
               include('kanban.php');    
            ?>
         </div>
         <div id="panier">
            <h2>Panier</h2>
            <div id="panierjson">
            </div>
         </div>
      </div>
      <?php 
         include('footer.php');
         include('orderLineForm.php');
      ?>
      <div id="backgroundFilter">
      </div>
   </body>
</html>
