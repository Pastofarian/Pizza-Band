<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="../CSS/style.css">
      <link rel="stylesheet" type="text/css" href="../CSS/footer.css">
      <title>Menu des pizzas</title>
   </head>
   <body>
      <header>
         <!-- <div class="container">
            <a href="new_account.php"><span id="newAccount">Créer un compte</span></a>
            <a href=""><span id="login">| Se connecter</span></a>
            </div> -->
      </header>
      <a href="menu_pizzas.php"><img src="../Images/small_logo.png" id="small_logo"></a>
      <div class="menu_title">
         <h1>Mon panier</h1>
      </div>
      <form action="../Controlers/control_basket.php" methode="GET">
      <input type="submit" value="Passer commande">
      <?php 
         include('footer.php');
         ?>
   </body>
</html>
