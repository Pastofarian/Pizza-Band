<?php

if(!isset($_SESSION))
{
    session_start();
}

if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == TRUE)
{
    ?> 
        <header>
            <div class="container">
                <a href="../Controlers/user_account.php"><span id="myaccount">Mon compte</span></a>
                <a href="../Controlers/disconnect.php"><span id="disconnect">Se déconnecter</span></a>
            </div>
        </header>
    <?php
}
else 
{
    ?> 
        <header>
            <div class="container">
                <a href="signin_login.php"><span id="newAccount">Créer un compte</span></a>
                <a href="signin_login.php"><span id="login">| Se connecter</span></a>
            </div>
        </header>
    <?php
}
