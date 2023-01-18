<?php
include '../Models/readIngredientbyId.php';
include '../Models/readPizzaById.php';
include '../Models/readPizzas.php';
include '../Models/readIngredients.php';



//check la validité de l'email
function checkEmail($email) {
    $error = "";
    if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)){
      $error = "Erreur dans votre email";
    }
    return $error;
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

// prevent JavaScript and SQL injection attacks in an HTML form

// The trim() function removes any whitespace from the beginning and end of the input. 
// The stripslashes() function removes any backslashes that may have been added to the input. 
// The htmlspecialchars() function converts special characters to their HTML entities, so they can't be executed as code.

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
