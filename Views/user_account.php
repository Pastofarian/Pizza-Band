<?php
   session_start();
   if (!isset($_SESSION['user']))
      header('Location: ../Controlers/user_account.php');
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="../CSS/style.css">
      <link rel="stylesheet" href="../CSS/user_account.css">
      <script type="text/javascript" src="../Functions/panierjsonscript.js"></script>
      <title>Compte utilisateur</title>
   </head>
   <body>
      <?php
      include('header.php')
      ?>
      <a href="menu_pizzas.php"><img src="../Images/small_logo.png" id="small_logo"></a>
      <div class="menu_title">
         <h1>Votre compte</h1>
      </div>
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
                     Menvusa
                  </li>
                  <li>
                     <span class="info-title">Prénom</span>
                     Gérard
                  </li>
                  <li>
                     <span class="info-title">Email:</span>
                     email@example.com
                  </li>
                  <li>
                     <span class="info-title">Date de naissance:</span>
                     01/01/1970
                  </li>
                  <li>
                     <span class="info-title">Adresse</span>
                     Chemin de Lanusse, 3
                  </li>
                  <li>
                     <span class="info-title">Code postal</span>
                     1300
                  </li>
                  <li>
                     <span class="info-title">Mot de passe</span>
                     **********
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
