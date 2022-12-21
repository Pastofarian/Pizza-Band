<?php

session_start();
//include("../Functions/functions.php");
//include("../Models/insert.php"); //provoque des conflits
$url;

$registration = '../Views/new_account.php';
$login = '../Views/home_page.php';

$data1 = $_POST["pass1"];
unset($_POST["pass1"]); //efface les traces
$data2 = $_POST["pass2"];
unset($_POST["pass2"]);

$_SESSION["checkEmpty"] = checkEmpty($_POST);
$_SESSION["matchPassword"] = MatchPassword($data1, $data2);
$_SESSION["checkIdFn"] = validateUserId($_POST["prenom"], "prenom");
$_SESSION["checkIdLn"] = validateUserId($_POST["nom"], "nom");
$_SESSION["checkEmail"] = checkEmail($_POST["email"]);
$_SESSION["checkDob"] = checkDob($_POST["dob"]);
$_SESSION["checkPassword"] = checkPassword($data1);

// $_SESSION["checkDuplicates"] = duplicates($_POST["email"]);

$data1 = password_hash($data1,PASSWORD_BCRYPT); //écrase data1 avec password crypté

if(
    !empty($_SESSION["checkEmpty"]) ||
    !empty($_SESSION["matchPassword"]) || 
    !empty($_SESSION["checkIdFn"]) || 
    !empty($_SESSION["checkIdLn"]) || 
    !empty($_SESSION["checkEmail"]) ||
    !empty($_SESSION["checkPassword"]) ||
    !empty($_SESSION["checkDob"]) 
    //!empty($_SESSION["checkDuplicates"])
    ) {
    //header("Location: " . $registration); 
    $url = "Location: ../Views/new_account.php";
}else{ 
    insertDB($_POST["nom"], $_POST["prenom"], $_POST["dob"], $_POST["email"], $data1);
    //header("Location: " . $login);
    $url = "Location: ../Views/home_page.php";
}
header($url);
//session_destroy();
?>