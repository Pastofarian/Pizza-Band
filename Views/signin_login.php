<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Inscription/Connexion</title>
	<link rel="stylesheet" type="text/css" href="../CSS/signin_login.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">

</head>
<body>           
    <a href="menu_pizzas.php"><img src="../Images/small_logo.png" id="main_logo"></a>
	    <section class="forms-section">
        <div class="forms">
          <div class="form-wrapper is-active">
            <button type="button" class="switcher switcher-login">
              Connexion
              <span class="underline"></span>
            </button>
            <form class="form form-login" action="../Controlers/control_signin.php" method="POST">
            <div class="error-message">
                <?php
                  session_start();
                  error_reporting(0);
                  //if(!isset($_SESSION["error"])){
                  echo'<pre>';
                  echo $_SESSION["error"];
                  echo'<pre>';
                  //session_destroy();
                  //}
                  ?>
                </div>
              <fieldset>
                <legend>Entrez votre Email et mot de passe pour vous connecter</legend>
                <div class="input-block">
                  <label for="login-email">E-mail</label>
                  <input id="login-email" autocomplete="on" type="email" required name="logEmail">
                </div>
                <div class="input-block">
                  <label for="login-password">Mot de passe</label>
                  <input id="login-password" autocomplete="on" type="password" required name="logPassword">
                </div>
              </fieldset>
              <button type="submit" class="btn-login">Connexion</button>
            </form>
          </div>
          <div class="form-wrapper">
            <button type="button" class="switcher switcher-signup">
              Inscription
              <span class="underline"></span>
            </button>

            <form class="form form-signup" action="../Controlers/control_new_account.php" method="POST">
            <div class="error-message">
                <?php
                session_start();
                //error_reporting(0);

                foreach($_SESSION["checkEmpty"] as $key => $value){
                    echo'<pre>';
                    echo $key.' -> '.$value.'<br>';
                }
                echo'<pre>';
                echo $_SESSION["checkPassword"];
                echo'<pre>';
                echo $_SESSION["checkIdFn"];
                echo'<pre>';
                echo $_SESSION["checkIdLn"];
                echo'<pre>';
                echo $_SESSION["checkEmail"];
                echo'<pre>';
                echo $_SESSION["checkDob"];
                echo'<pre>';
                echo $_SESSION["matchPassword"];
                echo'<pre>';
                echo $_SESSION["checkDuplicates"];
                //session_destroy();
                ?>
              </div>
              <fieldset>
                <legend>Entrez votre E-mail, mot de passe et confirmation de mot de passe pour l'inscription</legend>
                <div class="input-block">
                  <label for="lastname">Nom *</label>
                  <input name="lastname" id="lastname" type="text" autocomplete="on" required>
                </div>
                  <div class="input-block">
                  <label for="firstname">Prenom *</label>
                  <input name="firstname" id="firstname" type="text" autocomplete="on" required>
                </div>
                <div class="input-block">
                  <label for="email">E-mail *</label>
                  <input name="email" id="email" type="email" autocomplete="on" required>
                </div>
                <div class="input-block">
                  <label for="dob">Date de naissance *</label>
                  <input name="dob" id="dob" type="date" autocomplete="on" required>
                </div>
                <div class="input-block">
                  <label for="address">Adresse *</label>
                  <input name="address" id="address" type="text" autocomplete="on" required>
                </div>
                <div class="input-block">
                  <label for="postcode">Code Postal *</label>
                  <input name="postcode" id="postcode" type="text" autocomplete="on" required>
                </div>
                <div class="input-block">
                  <label for="signup-password">Mot de passe **</label>
                  <input name="signup-password" id="signup-password" type="password" required>
                </div>
                <div class="input-block">
                  <label for="signup-password-confirm">Mot de passe confirmation **</label>
                  <input name="signup-password-confirm" id="signup-password-confirm" type="password" required>
                </div>
                <p style="font-size:12px">(*) Champs requis</p>
                    <p style="font-size:12px"> (**) Le mot de passe doit comporter : <br>8 caractères minimum, 1 chiffre minimum, 1 majuscule minimum, 1 minuscule minimum</p>
                    <p>
              </fieldset>
              <button type="submit" class="btn-signup">Continue</button>
            </form>
          </div>
        </div>
      </section>
</body>
</html>
<script>
    const switchers = [...document.querySelectorAll('.switcher')]
    
    switchers.forEach(item => {
        item.addEventListener('click', function() {
            switchers.forEach(item => item.parentElement.classList.remove('is-active'))
            this.parentElement.classList.add('is-active')
        })
    })
        </script> 
