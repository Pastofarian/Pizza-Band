<?php
    include_once '../Models/readUserById.php';

?>
    <nav id="mainNav">
        <ul>
            <li><a href="../Controlers/orderline.php">Menu</a></li>
            <?php
                if (
                    isset($_SESSION['loggedIn']) &&
                    $_SESSION['loggedIn'] == TRUE &&
                    isset($_SESSION['userLoggedIn']) &&
                    ($user = readUserById($_SESSION['userLoggedIn']['id'])) != 'NULL'
                )
                {
            ?>
            <li><a href="../Controlers/user_account.php">Mon Compte</a></li>
            <li><a href="../Controlers/disconnect.php">Se déconnecter</a></li>
            <?php
                }
                else
                {
            ?>
            <li><a href="../Controlers/signin_login.php">Créer un compte</a></li>
            <li><a href="../Controlers/signin_login.php">Se connecter</a></li>
            <?php 
                }
            ?>
        </ul>
    </nav>
