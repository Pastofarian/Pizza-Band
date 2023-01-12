<?php
   session_start();
   include_once('../Models/readUserById.php');
   include_once('header.php');

   if (!isset($_SESSION['user']) || !isset($_SESSION['city']))
      header('Location: ../Controlers/user_account.php');
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="../CSS/user_account.css">
      <link rel="stylesheet" href="../CSS/footer.css">
      <link rel="stylesheet" href="../CSS/nav.css">

      <script type="text/javascript" src="../Functions/panierjsonscript.js"></script>
      <title>Compte utilisateur</title>
   </head>
   <body>
      <header></header>
      <?php
         include('nav.php');
      ?>
      <a href="menu_pizzas.php"><img src="../Images/small_logo.png" id="small_logo"></a>
      <div class="container_menu">
         <div class="displayFlex">
            <div class="user-profile">
               <div class="user-avatar">
                  <img src="https://images.firstwefeast.com/complex/image/upload/kzumczjzaufqzg7stno7.jpg" alt="image de profile">
               </div>
               <h2 class="user-name">Informations de votre compte</h2>
               <ul class="user-info">
                  <li>
                     <span class="info-title">Nom</span>
                     <?= $_SESSION['user'][0]['name'] ?>
                  </li>
                  <li>
                     <span class="info-title">Prénom</span>
                     <?= $_SESSION['user'][0]['firstname'] ?>
                  </li>
                  <li>
                     <span class="info-title">Email:</span>
                     <?= $_SESSION['user'][0]['email'] ?>
                  </li>
                  <li>
                     <span class="info-title">Adresse</span>
                     <?= $_SESSION['user'][0]['address'] ?>
                  </li>
                  <li>
                     <span class="info-title">Ville</span>
                     <?= $_SESSION['city'][0]['name'] ?>
                  </li>
   
               </ul>
            </div>
         </div>
         <?php
         include 'panier.php';
         ?>
      </div>
      <?php 
         include('footer.php')
      ?>
   </body>
</html>
