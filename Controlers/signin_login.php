<?php

include("../Models/readUserByEmail.php");
include("../Functions/functions.php");

session_start();

$url; 
$_SESSION["error"] = "";

if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'])
{

   $url ="Location: ../Controlers/orderline.php"; //redirect to the login page
}

if(isset($_POST) && !empty($_POST))
{
    $isPassAndLogOk = false;
    $error = false;
    $email = $_POST["logEmail"];
    $data = $_POST["logPassword"]; 
    unset($_POST["logPassword"]);
    var_dump($email);

    if (empty(checkEmail($email)))
    {
        $user = readUserByEmail($email);

        if($user != 'NULL')
        {
            if(password_verify($data, $user[0]['pass']))
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
                $_SESSION["loggedIn"] = TRUE; //permets l'accès. Evite accès direct par url
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
    echo "test3";
    $url = "Location: ../Views/signin_login.php";
}

header($url);
