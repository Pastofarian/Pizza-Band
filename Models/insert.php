<?php

// function insertEmploye($LastName, $FirstName, $Email, $Diner, $Postcode, $Locomotion, $Department){
//     include('connection.php');
//     $query = "INSERT INTO employe (nom, prenom, mail, souper, fk_cp, fk_locomotion, fk_departement) VALUES(:nom, :prenom, :mail, :souper, :fk_cp, :fk_locomotion, :fk_departement)";
//     $query_params = array(':nom'=>$LastName,
//                               ':prenom'=>$FirstName,
//                                 ':mail'=>$Email,
//                                 ':souper'=>$Diner,
//                                 ':fk_cp'=>$Postcode,
//                                 ':fk_locomotion'=>$Locomotion,
//                                 ':fk_departement'=>$Department);

//         try{
//             $stmt = $db->prepare($query);
//             $result = $stmt->execute($query_params);
//         }
//         catch(PDOException $ex){
//             die("Failed query : " . $ex->getMessage());
//         }
// }

function insertEmploye($LastName, $FirstName, $Email, $Diner, $Postcode, $Locomotion, $Department){
    include('connection.php');
    $query = "INSERT INTO employe (nom, prenom, mail, souper, fk_cp, fk_locomotion, fk_departement) VALUES(:nom, :prenom, :mail, :souper, :fk_cp, :fk_locomotion, :fk_departement)";
    $query_params = array(':nom'=>$LastName,
                              ':prenom'=>$FirstName,
                                ':mail'=>$Email,
                                ':souper'=>$Diner,
                                ':fk_cp'=>$Postcode,
                                ':fk_locomotion'=>$Locomotion,
                                ':fk_departement'=>$Department);

        try{
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
            $employeId = $db->lastInsertId();
        }
        catch(PDOException $ex){
            die("Failed query : " . $ex->getMessage());
        }

    return $employeId;
}

function insertActivity($activity, $employeId){
    include('connection.php');
    $query = "INSERT INTO employe_activite (fk_activite, fk_employe) VALUES(:fk_activite, :fk_employe)";
    $query_params = array(':fk_activite'=>$activity,
                              ':fk_employe'=>$employeId);

        try{
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex){
            die("Failed query : " . $ex->getMessage());
        }
}

function insertNewAdmin($email, $pass){
    include('connection.php');
    $query = "INSERT INTO admin (login, password) VALUES(:login, :password)";
    $query_params = array(':login'=>$email,
                              ':password'=>$pass);

        try{
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex){
            die("Failed query : " . $ex->getMessage());
        }
}

//insertNewAdmin("test1", "test");