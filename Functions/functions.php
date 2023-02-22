<?php
include("../Models/read.php");

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
  $result = recupAllInfoDB("admin");
  if(!empty($result)){
      $error = "";
      for($i = 0; $i < (count($result)); $i++){
        if($email == $result[$i]['login']){
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

//check la validité de l'email
function checkEmail($email) {
  $error = "";
  if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)){
    $error = "Erreur dans votre email";
  }
  return $error;
}
