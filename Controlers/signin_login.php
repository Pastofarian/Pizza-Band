<?php

include("../Models/readUserByEmail.php");
include("../Models/readCities.php");
include("../Functions/functions.php");

session_start();

$url;
$_SESSION["citylist"] = readCities();
$_SESSION["error"] = "";


if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'])
{

   $url ="Location: ../Controlers/orderline.php"; //redirect to the login page
}

if(isset($_POST) && !empty($_POST))
{
    $isPassAndLogOk = false;
    $error = false;
    $email = sanitize_input($_POST["logEmail"]);
    $pass = sanitize_input($_POST["logPassword"]); 
    unset($_POST["logPassword"]);
    //var_dump($email);

    if (empty(checkEmail($email)))
    {
        $user = readUserByEmail($email);

        if($user != 'NULL')
        {
            if(password_verify($pass, $user[0]['pass']))
            {
                $isPassAndLogOk = true;
            }
            else 
            {
                $_SESSION["error"] .= "Erreur dans le mot de passe ou le login";
            }
            //si les flags sont ok -> pizza_menu
            if($isPassAndLogOk)
            {
                $_SESSION["loggedIn"] = TRUE;
                $_SESSION["userLoggedIn"] = $user[0];
                $url = "Location: ../Controlers/orderline.php";
            } 
            else 
            {
                $url = "Location: ../Views/signin_login.php";
            }
        }
        else 
        {
            $_SESSION["error"] .= "<br> Utilisateur inconnu dans la base de données";
            $url = "Location: ../Views/signin_login.php";
        }
    }
    else 
    {
        $_SESSION["error"] .= "<br> Email mal formaté";
        $url = "Location: ../Views/signin_login.php";
    }
}
else 
{
    $url = "Location: ../Views/signin_login.php";
}

header($url);
