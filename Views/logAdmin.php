<!DOCTYPE html>
<html lang="fr">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="../CSS/logAdmin.css">
      <title>Administration</title>
   </head>
   <body>
      <main role="main">
         <h1 class="form-title">Log in</h1>
         <form action="../Controlers/logAdmin.php" method="POST" class="login-form">
            <p>
               <label for="email" class="form-label">Adresse e-mail *</label>
               <input type="email" name="logMail" autocomplete="on" required="required" class="form-input">
            </p>
            <p>
               <label for="pass" class="form-label">Entrez votre mot de passe *</label>
               <input type="password" name="logPass" required="required" class="form-input">
            </p>
            <p>
               <input type="submit" value="Envoyer" id="submit" class="form-button">
            </p>
         </form>
         <?php
            session_start();
            error_reporting(0);
            if(!isset($_SESSION["errorLog"])){
              echo $_SESSION["errorLog"];
              //session_destroy();
            }
         ?>
      </main>
   </body>
</html>
