<?php 
session_start();
include_once '../functions/functions.php';
include_once '../Models/readPizzas.php';
include_once '../Models/readIngredients.php';
include_once '../models/readPizzaById.php';
include_once '../models/readIngredientById.php';
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
      <header>
         <div class="container">
            <a href="signin_login.php"><span id="newAccount">Créer un compte</span></a>
            <a href="signin_login.php"><span id="login">| Se connecter</span></a>
         </div>
      </header>
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
   
   
    <footer class="footer">
        <ul class="footer__nav">         
      </div>

      <footer class="footer">
         <ul class="footer__nav">
            <li>
               <h2>Horaires d'ouverture</h2>
            </li>
            <li>
               <p>Mardi - Samedi</p>
            </li>
            <li>
               <p>12:00 - 14:00</p>
            </li>
            <li>
               <p>19:00 - 21:30</p>
            </li>
         </ul>
         <ul class="footer__nav">
            <li class="nav__item">
            <li>
               <h2>Fermeture annuelle</h2>
            </li>
            <li>
               <p>Le 7 & 8 juin
            </li>
            <li>
               <p>Du 17 au 31 juillet inclus</p>
            </li>
            <li>
               <p>Du 17 au 26 Septembre inclus</p>
            </li>
         </ul>
         <ul class="footer__nav">
            <li class="nav__item">
            <li>
               <h2>Pizza Mama</h2>
            </li>
            <li>
               <p>1 rue de la limite
            </li>
            <li>
               <p>1300 Wavre</p>
            </li>
            <li>
               <p>Belgique</p>
            </li>
         </ul>
         <ul class="footer__nav">
            <li>
               <h2>Suivez-nous !</h2>
            </li>
            <li>
               <a class="nav__title" href="https://www.facebook.com/" target="_blank">Facebook</a>
            </li>
            <li>
               <a class="nav__title" href="https://www.instagram.com/" target="_blank">Instagram</a>
            </li>
            <li>
               <a class="nav__title" href="https://twitter.com/" target="_blank">Twitter</a>
            </li>
         </ul>
      </footer>
      <div>
         <p id="copyright">&copy; 2022 Pizza Mama. All rights reserved.</p>
      </div>
   </body>
</html>
