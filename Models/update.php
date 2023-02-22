<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
function updateEmployee($id, $nom, $prenom, $mail, $fk_cp, $fk_locomotion, $fk_departement, $souper) {
    include('connection.php');
  
    $query = 'UPDATE employe SET nom = :nom, prenom = :prenom, mail = :mail, fk_cp = :fk_cp, fk_locomotion = :fk_locomotion, fk_departement = :fk_departement, souper = :souper WHERE id = :id';
    $query_params = array(
      ':id' => $id,
      ':nom' => $nom,
      ':prenom' => $prenom,
      ':mail' => $mail,
      ':fk_cp' => $fk_cp,
      ':fk_locomotion' => $fk_locomotion,
      ':fk_departement' => $fk_departement,
      ':souper' => $souper
    );
    try {
      $stmt = $db->prepare($query);
      $stmt->execute($query_params);
    } catch (PDOException $ex) {
      die("Failed query : " . $ex->getMessage());
    }
  }
