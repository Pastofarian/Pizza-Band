<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("../Functions/functions.php");
include("../Models/insert.php");

include("../Models/delete.php");
include("../Models/update.php");

if (isset($_POST['action'])) {
  $id = $_POST['id'];
  if ($_POST['action'] == 'delete') {
    deleteEmployee($id);
  } else if ($_POST['action'] == 'update') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];
    $cp = $_POST['cp'];
    $locomotion = $_POST['locomotion'];
    $departement = $_POST['departement'];
    $souper = isset($_POST['souper']) ? 1 : 0;
    updateEmployee($id, $nom, $prenom, $mail, $cp, $locomotion, $departement, $souper);
  }
}

$admin = 'Location: ../Views/admin.php';
$data1 = $_POST["PassNewAdmin"];
unset($_POST["PassNewAdmin"]); //éfface les traces
$data2 = $_POST["PassNewAdmin2"];
unset($_POST["PassNewAdmin2"]);

$_SESSION["checkEmpty"] = checkEmpty($_POST);
$_SESSION["matchPassword"] = MatchPassword($data1, $data2);
$_SESSION["checkEmail"] = checkEmail($_POST["MailNewAdmin"]);
$_SESSION["checkPassword"] = checkPassword($data1);
$_SESSION["checkDuplicates"] = duplicates($_POST["MailNewAdmin"]);

$data1 = password_hash($data1,PASSWORD_BCRYPT); //écrase data1 avec password crypté

if(
    !empty($_SESSION["checkEmpty"]) || 
    !empty($_SESSION["matchPassword"]) || 
    !empty($_SESSION["checkEmail"]) ||
    !empty($_SESSION["checkPassword"]) ||
    !empty($_SESSION["checkDuplicates"])
    ) {
}else{
    insertNewAdmin($_POST["MailNewAdmin"], $data1);
}
header($admin);
//header('Location: ../Models/update.php');
exit();

// var_dump($data1);

//session_destroy();
