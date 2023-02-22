<?php

session_start();

include("../Models/read.php");

$result = recupAllInfoDB("admin");

$logLine; //1 user/password
$isPassAndLogOk = false;
$islogOk = false;
$error = false;
$email = $_POST["logMail"];
$data = $_POST["logPass"]; 
// unset($_POST["logPass"]);
$login = 'Location: ../Views/logAdmin.php';
$admin = 'Location: ../Views/admin.php';

// check si l'email est bien dans la db
for($i = 0; $i < (count($result)); $i++){ 
    if($email == $result[$i]['login']){
        $islogOk = true; //est présent dans la db
        $logLine = $i; //attribue la ligne log
        break; //si le trouve, s'arrête de boucler
    } else {
        $error = true; //si log(email) pas trouvé dans la db => erreur
    }
}

// check si le password correspond bien au log (2 users peuvent avoir le même pw)
    if(password_verify($data, $result[$logLine]['password'])){
        $isPassAndLogOk = true;
    }else {
        $error = true;
    }

// si erreur, affiche dans le formulaire login
if($error){
    $_SESSION["logError"] = "Erreur dans le mot de passe ou le login";
}

//si les flags sont ok -> welcome
if($islogOk && $isPassAndLogOk){
    $_SESSION["loggedIn"] = TRUE; //permets l'accès. Evite accès direct url
    header($admin);
} else {
    header($login);
}

// echo "isLogOk : " . $islogOk;
// echo ' <br>';
// echo "logLine : " . $logLine;
// echo ' <br>';
// echo "isPassAndLogOk : " . $isPassAndLogOk;
// echo ' <br>';
// echo "pass : " . $data;
// echo ' <br>';
// echo "result[logLine]['Password1'] : ". $result[$logLine]['password'];
// echo ' <br>';
// echo "error " . $error;
// echo ' <br>';
//session_destroy();
