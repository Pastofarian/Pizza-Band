<?php
include '../Models/readUserById.php';
session_start();

if (
    isset($_SESSION['loggedIn']) &&
    $_SESSION['loggedIn'] == TRUE &&
    isset($_SESSION['userLoggedIn']) &&
    ($user = readUserById($_SESSION['userLoggedIn']['id'])) != 'NULL' &&
    $user[0]['isAdmin'] == "1"
)
{ 
    $url = "Location: ../Views/admin.php";
    $_SESSION['admin'] = $user[0];
}
else
{
    $url = "Location: ./signin_login.php";
}

header($url);
