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
    <a href="menu_pizzas.php"><img src="../Images/main_logo.png" id="main_logo"></a>
	<section class="forms-section">
        <div class="forms">
          <div class="form-wrapper is-active">
            <button type="button" class="switcher switcher-login">
              Connexion
              <span class="underline"></span>
            </button>
            <form class="form form-login" action="../Controlers/control_new_account.php" method="POST">
              <fieldset>
                <legend>Entrez votre Email et mot de passe pour vous connecter</legend>
                <div class="input-block">
                  <label for="login-email">E-mail</label>
                  <input id="login-email" autocomplete="on" type="email" required>
                </div>
                <div class="input-block">
                  <label for="login-password">Mot de passe</label>
                  <input id="login-password" autocomplete="on" type="password" required>
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
            <form class="form form-signup">
              <fieldset>
                <legend>Entrez votre E-mail, mot de passe et confirmation de mot de passe pour l'inscription</legend>
                <div class="input-block">
                  <label for="lastname">Nom *</label>
                  <input id="lastname" type="text" autocomplete="on" required value="Hetfield">
                </div>
                  <div class="input-block">
                  <label for="firstname">Prenom *</label>
                  <input id="firstname" type="text" autocomplete="on" required value="James">
                </div>
                <div class="input-block">
                  <label for="email">E-mail *</label>
                  <input id="email" type="email" autocomplete="on" required value="james.hetfield@outlook.com">
                </div>
                <div class="input-block">
                  <label for="dob">Date de naissance *</label>
                  <input id="dob" type="date" autocomplete="on" required value="1963-08-03">
                </div>
                <div class="input-block">
                  <label for="address">Adresse *</label>
                  <input id="address" type="text" autocomplete="on" required value="Rue de la Limite, 1">
                </div>
                <div class="input-block">
                  <label for="postcode">Code Postal *</label>
                  <input id="postcode" type="text" autocomplete="on" required value="1300">
                </div>
                <div class="input-block">
                  <label for="signup-password">Mot de passe **</label>
                  <input id="signup-password" type="password" required>
                </div>
                <div class="input-block">
                  <label for="signup-password-confirm">Mot de passe confirmation **</label>
                  <input id="signup-password-confirm" type="password" required>
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
