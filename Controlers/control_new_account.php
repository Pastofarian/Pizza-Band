<?php
// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";
session_start();
include("../Functions/functions.php");
include("../Models/insert.php"); 
$url;

$autentificationPage = '../Views/signin_login.php';
$login = '../Views/menu_pizzas.php';

$data1 = $_POST["signup-password"];
unset($_POST["signup-password"]); //efface les traces
$data2 = $_POST["signup-password-confirm"];
unset($_POST["signup-password-confirm"]);

$_SESSION["checkEmpty"] = checkEmpty($_POST);
$_SESSION["matchPassword"] = MatchPassword($data1, $data2);
$_SESSION["checkIdFn"] = validateUserId($_POST["firstname"], "firstname");
$_SESSION["checkIdLn"] = validateUserId($_POST["lastname"], "lastname");
$_SESSION["checkEmail"] = checkEmail($_POST["email"]);
$_SESSION["checkDob"] = checkDob($_POST["dob"]);
$_SESSION["checkPassword"] = checkPassword($data1);
$_SESSION["checkDuplicates"] = duplicates($_POST["email"]);

$data1 = password_hash($data1,PASSWORD_BCRYPT); //écrase data1 avec password crypté

if(
    !empty($_SESSION["checkEmpty"]) ||
    !empty($_SESSION["matchPassword"]) || 
    !empty($_SESSION["checkIdFn"]) || 
    !empty($_SESSION["checkIdLn"]) || 
    !empty($_SESSION["checkEmail"]) ||
    !empty($_SESSION["checkPassword"]) ||
    !empty($_SESSION["checkDob"]) ||
    !empty($_SESSION["checkDuplicates"])
    ) {
    //header("Location: " . $autentificationPage); 
    $url = $autentificationPage;

}else{ 
    insertDB($_POST["lastname"], $_POST["firstname"], $_POST["dob"], $_POST["email"], $data1);
    //header("Location: " . $login);
    $url = $autentificationPage;
}

header("Location: " . $url);
//session_destroy();
?>