<?php

session_start();
//error_reporting(0);
include("../Models/readUsers.php");
include("../Models/readCities.php");
include("../Models/readCityById.php");
include("../Models/insertUser.php");



//Check si toutes les données du formulaire sont bien remplie
function checkEmpty($data){
    $error = array();
    foreach ($data as $key => $value) {
      if(empty($value)){
        $error[$key]='Veuillez remplir le champ ' . $key;
      } 
    }
  return $error;
}

//Check si le password et sa confirmation match
function matchPassword($pass1, $pass2){
    $error = "";
    if($pass1 != $pass2){
        $error = "Erreur dans le mot de passe, recommencez !";
    }
return $error;
}

//check si le log (email) est déjà présent dans la DB
function duplicates($email){
  $result = readUsers();
  if(!empty($result)){
      $error = "";
      for($i = 0; $i < (count($result)); $i++){
        if($email == $result[$i]['email']){
          $error = "Votre email est déjà dans notre base de données";
        }
      }
      return $error;
  }
}

//Controle password
/*Stratégie de mot de passe :
    - 8 caractères minimum
    - 1 chiffre minimum
    - 1 majuscule minimum
    - 1 minuscule minimum*/
    function checkPassword($password){
      $error = "";
      if (strlen($password) <= '8') {
          $error = "Votre mot de passe doit contenir au moins 8 caractères !";
      }
      elseif(!preg_match("#[0-9]+#",$password)) {
          $error = "Votre mot de passe doit contenir au moins 1 chiffre !";
      }
      elseif(!preg_match("#[A-Z]+#",$password)) {
          $error = "Votre mot de passe doit contenir au moins 1 majuscule minimum !";
      }
      elseif(!preg_match("#[a-z]+#",$password)) {
          $error = "Votre mot de passe doit contenir au moins 1 minuscule minimum !";
      }
      return $error;
  }
// check si le prenom et le nom sont correctes
/*    ^[a-zA-z] Can only start with letters. Either small or capital letter.
    [0-9a-zA-Z_]{2,23} Allowed length between 1 and 23. 
    [0-9a-zA-Z]$ Can only end with a number and a letters.
    https://www.businesstyc.com/php-preg_match-examples-to-validate-user-inputs/
*/

function validateUserId($userName, $id) {
  $error = "";
  if(!preg_match('/^[a-zA-Z][0-9a-zA-Z_]{1,23}[0-9a-zA-Z]$/', $userName)) {
    $error = "Erreur dans votre " . $id;
  }
  return $error;
}

//check la validité de l'email
function checkEmail($email) {
  $error = "";
  if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)){
    $error = "Erreur dans votre email";
  }
  return $error;
}

function checkCityId($cityId){
    $error = "";
    if(readCityById($cityId) == "NULL"){
        $error = "la ville est incorrecte";
    }
    return $error;
}

$url;

$autentificationPage = '../Views/signin_login.php';
$login = '../Views/menu_pizzas.php';

$data1 = $_POST["signup-password"];
unset($_POST["signup-password"]); //efface les traces
$data2 = $_POST["signup-password-confirm"];
unset($_POST["signup-password-confirm"]);

$_SESSION["citylist"] = readCities();

if(!empty($_POST)){
    $_SESSION["checkEmpty"] = checkEmpty($_POST);
    $_SESSION["matchPassword"] = MatchPassword($data1, $data2);
    $_SESSION["checkIdFn"] = validateUserId($_POST["firstname"], "firstname");
    $_SESSION["checkIdLn"] = validateUserId($_POST["name"], "name");
    $_SESSION["checkEmail"] = checkEmail($_POST["email"]);
    $_SESSION["checkPassword"] = checkPassword($data1);
    $_SESSION["checkDuplicates"] = duplicates($_POST["email"]);
    $_SESSION["checkCityId"] = checkCityId($_POST["cityId"]);

    $data1 = password_hash($data1,PASSWORD_BCRYPT); //écrase data1 avec password crypté

    if(
        empty($_SESSION["checkEmpty"]) &&
        empty($_SESSION["matchPassword"]) && 
        empty($_SESSION["checkIdFn"]) && 
        empty($_SESSION["checkIdLn"]) && 
        empty($_SESSION["checkEmail"]) &&
        empty($_SESSION["checkPassword"]) &&
        empty($_SESSION["checkDuplicates"]) &&
        empty($_SESSION["checkCityId"])
    ) {
        insertUser($_POST["firstname"], $_POST["name"], $_POST["email"], $data1, $_POST["address"],$_POST["cityId"]);
    }
}
header("Location: ../Views/signin_login.php");
//session_destroy();
?>