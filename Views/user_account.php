<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="../CSS/style.css">
      <link rel="stylesheet" href="../CSS/user_account.css">
      <link rel="stylesheet" href="../CSS/footer.css">
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
         <div class="displayFlex">
            <form id="sendorder" method="post" action="/controlerconfig.php">
               <div id="basket"> Votre panier : </div>
               <?php 
                  session_start();
                  // Passe en revue chaque ligne de commande (tableau) et affiche les informations relatives à la commandes
                  if(!empty($_SESSION["order"]))
                  {
                      foreach($_SESSION["order"] as $key => $orderline)
                      {
                          echo $orderline["qty"];
                          echo " ";
                          echo $orderline["pizza"];
                          echo "<br>";
                          if(array_key_exists("supp", $orderline))
                              {
                                  echo "Suppléments : ";
                                  echo "<br>";
                                  foreach($orderline["supp"] as $supp)
                                  {
                                  echo $supp;
                                  echo "<br>";
                                  }
                                  echo "<br>";
                              }
                      }
                      echo "<br>";
                      // Donne la possibilité de supprimer sa commande en entier (devrait pouvoir supprimer 1 order line et pas toute l'order mais je n'arrive pas à transmettre l'index à la fonction) Fait appel à ajax.php et scripts.js
                      echo '<a href="#" onclick="myAjax" class="deletebtn">Annuler sa commande</a>';
                      echo "<br>";
                      echo '<input type="submit" value="Passer commande">';
                  }
                  ?>
            </form>
         </div>
      </div>
      <?php 
         include('footer.php')
      ?>
   </body>
</html>
