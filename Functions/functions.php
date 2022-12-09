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
  $result = recupAllInfoAdmin();
  if(!empty($result)){
      $error = "";
      for($i = 0; $i < (count($result)); $i++){
        if($email == $result[$i]['Email']){
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


//check de la date de naissance
function checkDob($dob){
  $message = '';
  $date = $dob;
  $today = date("Y-m-d");
  
  //fonction explode pour diviser la date
  $dateExploded = explode("-", $date);
  
  //la date doit contenir 3 éléments
  if(count($dateExploded) != 3){
    $message = "La date de naissance n'est pas dans le format valide JJ/MM/AAAA";
  }
  
  $day = $dateExploded[2];
  $month = $dateExploded[1];
  $year = $dateExploded[0];
  
  //fonction checkdate pour vérifier si la date existe
  if(!checkdate($month, $day, $year)){
    $message = 'La date de naissance est invalide.<br> Verifiez que le mois est bien situé entre 1 et 12. <br> Vérifiez que le jour est valide pour ce mois.';
  }
  //si la date est valide, il faut vérifier l'age
   if ($message == '') {
  //convertis la date en année
    $year = (date('Y') - date('Y', strtotime($date)));
  
    if($year > 120){
      $message = 'Vous devez être vivant pour vous inscrire sur ce site';
    } elseif($year < 10){
      $message = "Vous devez être agé d'au moins 10 ans pour vous inscrire sur ce site";
    }
   }
 return $message;
}

?>