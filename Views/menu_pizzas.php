<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

<?php   

session_start();
$pizzas = ["Marguerita"=>17, "Quatro Stagioni"=>20, "Reine"=>22, "Calzone"=>18, "Capriocciosa"=>18, "Saumon"=>23, "Caprese"=>13, "Pepperoni"=>15]; 
$supp = ["Oeuf"=>17, "Champignon"=>20, "Ananas"=>22, "Olive"=>22, "Câpre"=>22, "Salami"=>10];

?>
<div class="container_menu"> 
<div class="displayFlex"> 
<form id="order" method="post" action="menu_pizzas.php">
<label for="cars">Choisissez votre pizza:</label><br>
<select name="pizza" id="pizza" size="0" form="order">
<?php foreach ($pizzas as $key => $value) 
{
    echo '<option value="' . $key . '">' . $key . '</option>';
}

?>
<script>
    $(document).ready(function() {
  // Select all options in the "supp" select element
  var options = $('#supp option');

  // Bind a change event to the "pizza" select element
  $('#pizza').on('change', function() {
    // Get the selected value
    var selected = $(this).val();

    // Hide all options in the "supp" select element
    options.hide();

    // Show the options that are valid for the selected pizza
    switch(selected) {
      case 'Marguerita':
        $('#supp option[value="Oeuf"]').show();
        break;
      case 'Quatro Stagioni':
        $('#supp option[value="Champignon"]').show();
        $('#supp option[value="Olive"]').show();
        $('#supp option[value="Câpre"]').show();

        break;
      case 'Reine':
        $('#supp option[value="Oeuf"]').show();
        $('#supp option[value="Champignon"]').show();
        break;
      case 'Calzone':
        $('#supp option[value="Olive"]').show();
        break;
      case 'Capriocciosa':
        $('#supp option[value="Olive"]').show();
        $('#supp option[value="Oeuf"]').show();
        break;
      case 'Caprese':
        $('#supp option[value="Câpre"]').show();
        $('#supp option[value="Oeuf"]').show();
        break;
      case 'Pepperoni':
        $('#supp option[value="Salami"]').show();
        break;
        default:
        break;
    }
  });
});
</script>
</select><br>

<label for="qty">Choisissez votre quantité :</label><br>
<input type="number" id="qty" name="qty" value="1"> <br>

<label for="cars">Choisissez vos suppléments:</label><br>
<select name="supp[]" id="supp" multiple size="3" form="order">
<?php foreach ($supp as $key => $value) 
{
    echo '<option value="' . $key . '">' . $key . '</option>';
}
?>
<br>
<input type="submit" value="Ajouter au panier">
</form>
</div>
<?php 

//Créé un tableau vide qui recevra toutes les orderline
if(!isset($_SESSION["order"]))
{
    $_SESSION["order"] = [];
}

//Ajoute l'order line au tableau lorsque le formulaire est envoyé 
addOrderLine($_POST);


// unset($_SESSION["order"]);

?>
<!-- Créé un deuxième formulaire qui validera la commande et l'enverra au controler -->
<div class="displayFlex"> 
<form id="sendorder" method="post" action="/controlerconfig.php">
<div id="basket"> Votre panier : </div>

<?php 
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

function addOrderLine($values)
{
    array_push($_SESSION["order"], $values);
}
echo "<br>";

function deleteOrderLine($index)
{
    unset($_SESSION["order"][$index]);
}
?>

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