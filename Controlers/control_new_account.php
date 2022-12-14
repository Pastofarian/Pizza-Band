<?php

session_start();
include("../Functions/functions.php");
//include("../Models/insert.php"); //provoque des conflits

$registration = '../View/new_account.php';
$login = '../View/home_page.php';

$data1 = $_POST["pass1"];
unset($_POST["pass1"]); //efface les traces
$data2 = $_POST["pass2"];
unset($_POST["pass2"]);

$_SESSION["checkEmpty"] = checkEmpty($_POST);
echo "test1";
$_SESSION["matchPassword"] = MatchPassword($data1, $data2);
echo "test2";
$_SESSION["checkIdFn"] = validateUserId($_POST["prenom"], "prenom");
echo "test3";
$_SESSION["checkIdLn"] = validateUserId($_POST["nom"], "nom");
echo "test4";
$_SESSION["checkEmail"] = checkEmail($_POST["email"]);
echo "test5";
$_SESSION["checkDob"] = checkDob($_POST["dob"]);
echo "test6";
$_SESSION["checkPassword"] = checkPassword($data1);
echo "test7";
// $_SESSION["checkDuplicates"] = duplicates($_POST["email"]);
// echo "test8";
$data1 = password_hash($data1,PASSWORD_BCRYPT); //écrase data1 avec password crypté

if(
    !empty($_SESSION["checkEmpty"]) || 
    !empty($_SESSION["matchPassword"]) || 
    !empty($_SESSION["checkIdFn"]) || 
    !empty($_SESSION["checkIdLn"]) || 
    !empty($_SESSION["checkEmail"]) ||
    !empty($_SESSION["checkPassword"]) ||
    !empty($_SESSION["checkDob"]) ||
    //!empty($_SESSION["checkDuplicates"])

    ) {
    header("Location: " . $registration); 
}else{
    insertDB($_POST["nom"], $_POST["prenom"], $_POST["dob"], $_POST["email"], $data1);
    header("Location: " . $login);
}

//session_destroy();
?>