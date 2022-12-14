<?php

// libre à vous de renommer ce fichier

session_start();
$pizzas = ["Marguerita"=>17, "Quatro Stagioni"=>20, "Reine"=>22, "Calzone"=>18, "Capriocciosa"=>18,"Saumon"=>23];

$_SESSION["pizzas"] = $pizzas;

header("Location: ../Views/menu_pizzas.php");
?>