<?php
session_start();

include("../Models/readUsers.php"); 

$result = readUsers();

$lastName;
$firstName;
$logLine; //1 user/password
$isPassAndLogOk = false;
$islogOk = false;
$error = false;
$email = $_POST["logEmail"];
$data = $_POST["logPassword"]; 
unset($_POST["logPassword"]);

// check si l'email est bien dans la db
for($i = 0; $i < (count($result)); $i++){ 
    // echo "<pre>";
    // echo $result[$i]['email'];
    // echo "<pre>";
    if($email == $result[$i]['email']){
        $islogOk = true; //est présent dans la db
        $logLine = $i; //attribue la ligne log
        $lastName = $result[$i]['name']; //attribue le nom 
        $firstName = $result[$i]['firstName']; //attribue le prénom
        break; //si le trouve, s'arrête de boucler
    } else {
        $error = true; //si log(email) pas trouvé dans la db => erreur
    }
}
//echo $result[$i]['email'];

// check si le password correspond bien au log (2 users peuvent avoir le même pw)
    if(password_verify($data, $result[$logLine]['pass'])){
        $isPassAndLogOk = true;
    }else {
        $error = true;
    }

// si erreur, affiche dans le formulaire login
if($error){
    $_SESSION["error"] = "Erreur dans le mot de passe ou le login";
}

//si les flags sont ok -> pizza_menu
if($islogOk && $isPassAndLogOk){
    $_SESSION["loggedIn"] = TRUE; //permets l'accès. Evite accès direct par url
    header("Location: ../Views/user_account.php");
} else {
    header("Location: ../Views/signin_login.php");
}

// echo $lastName;
// echo "<pre>";
// var_dump($result);
// echo "<pre>";
// echo "Current age is ".$age->format("%y");
// echo ' <br>';
// echo "currentDate : " . $currentDate;
// echo ' <br>';
// echo "birthDate : " . $birthDate;
// echo ' <br>';
// echo "isLogOk : " . $islogOk;
// echo ' <br>';
// echo "logLine : " . $logLine;
// echo ' <br>';
// echo "isPassAndLogOk : " . $isPassAndLogOk;
// echo ' <br>';
// echo ' <br>';
// echo "pass : " . $data;
// echo ' <br>';
// echo ' <br>';
// echo "result[logLine]['Password1'] : ". $result[$logLine]['Password1'];
// echo ' <br>';
// echo "nom : " . $lastName;
// echo ' <br>';
// echo "prenom : " . $firstName;
// echo ' <br>';
// echo "error " . $error;
// echo ' <br>';
//session_destroy();
?>