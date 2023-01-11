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
      <link rel="stylesheet" href="../CSS/header.css" />
      <link rel="stylesheet" href="../CSS/nav.css">
      <link rel="stylesheet" href="../CSS/kanban.css">
      <link rel="stylesheet" href="../CSS/footer.css">
      <link rel="stylesheet" href="../CSS/panier.css">
      <link rel="stylesheet" href="../CSS/backgroundFilter.css">
      <script type="text/javascript" src="../Scripts/listingpizzas.js" defer></script>
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
            <h2>Commande</h2>
            <div id="panierjson">
            </div>
            <form method="GET" action="../Controlers/pushorder.php">
               <input type="submit" value="Passer commande">
            </form>
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
