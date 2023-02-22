<?php

function recupAllInfoDB($table){

  include('connection.php');

  $query = "SELECT * FROM $table";
  $query_params = array();
  try
  {
      $stmt = $db->prepare($query);
      $result = $stmt->execute($query_params);
  }
  catch(PDOException $ex){
      die("Failed query : " . $ex->getMessage());
  }
  $result = $stmt->fetchall();
  return (!empty($result)) ? $result: 'NULL';
}

function retrieveAllEmployees() {
  include('connection.php');

  $query = 'SELECT e.id, e.nom, e.prenom, e.mail, e.souper, CONCAT(cp.cp, " ", cp.nom) AS cp, L.nom AS locomotion, d.nom AS departement FROM employe e
  INNER JOIN cp ON e.fk_cp = cp.id
  INNER JOIN Locomotion L ON e.fk_locomotion = L.id
  INNER JOIN departement d ON e.fk_departement = d.id
  ORDER BY e.id ASC';
  $query_params = array();
  try {
      $stmt = $db->prepare($query);
      $stmt->execute($query_params);
      $employees = $stmt->fetchAll();
      return $employees;
  } catch (PDOException $ex) {
      die("Failed query : " . $ex->getMessage());
  }
}

// $employees = retrieveAllEmployees();
// var_dump($employees);
// echo("test");
//var_dump(recupAllInfoAdmin());

