<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="../CSS/style.css">
      <link rel="stylesheet" href="../CSS/user_account.css">
      <title>Compte utilisateur</title>
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
