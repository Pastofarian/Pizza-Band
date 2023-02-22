<?php
// include_once 'connection.php';
// function deleteDB($id){
//     $query = "DELETE FROM `Ingredient` WHERE id = :id";
//     $query_params = array(
//         ':id'=>$id
//     );
//     try {
//         $stmt = $db->prepare($query); //change from getPDO() to $db
//         $result = $stmt->execute($query_params);
//     }
//     catch(PDOException $ex){
//         die("Failed query : " . $ex->getMessage());
//     }
// }

function deleteEmployee($id) {
    include('connection.php');
  
    try {
      // delete rows from employe_activite table that reference the employe to delete
      $stmt = $db->prepare('DELETE FROM employe_activite WHERE fk_employe = ?');
      $stmt->execute(array($id));
  
      // delete employe row
      $stmt = $db->prepare('DELETE FROM employe WHERE id = ?');
      $stmt->execute(array($id));
  
    } catch (PDOException $ex) {
      die("Failed query : " . $ex->getMessage());
    }
  }
  