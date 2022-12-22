<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Menu des pizzas</title>
</head>
<body>
<header>    
        <div class="container">
            <a href="new_account.php"><span id="newAccount">Créer un compte</span></a>
            <a href=""><span id="login">| Se connecter</span></a>
        </div>
</header> 
    <a href="menu_pizzas.php"><img src="../Images/small_logo.png" id="small_logo"></a>
    <div class="menu_title">
        <h1>Les Pizzas</h1>
    </div>

    <div class="menu_list">
    <?php
        session_start();
        $pizzas = ["Marguerita"=>17, "Quatro Stagioni"=>20, "Reine"=>22, "Calzone"=>18, "Capriocciosa"=>18, "Saumon"=>23, "Caprese"=>13, "Pepperoni"=>15]; // problème de session avec le contrôleur?

        $_SESSION["pizzas"] = $pizzas;

        foreach ($_SESSION["pizzas"] as $key => $value)
        {
        echo '<div class="menu_list_item">';
            echo '<span class="menu_list_title">'?><?=$key?><?='</span>';
            echo '<span class="menu_list_price">'?><?=$value?><?='€</span>';
            echo '<span class="menu_list_ingredients">ingredients</span>';
            echo '<span class="menu_list_badge">VÉGÉTARIENNE</span>';
        echo '</div>';
            
        //var_dump($_SESSION["pizzas"]);
        }
        //echo "test";
        //session_destroy();
        ?>
    </div>
    <div class="container_basket">
        <div class="basket">
            <form class="form form-signup" action="../Controlers/control_new_account.php" method="POST">
            <button type="submit" class="btn-basket">Acheter</button>

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