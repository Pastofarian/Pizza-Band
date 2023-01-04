<?php

session_start();

if(isset($_SESSION) && isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == TRUE)
{
    session_destroy();
}

header("Location: signin_login.php");
?>