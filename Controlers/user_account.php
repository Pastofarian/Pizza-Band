<?php
    include '../Models/readUserById.php';
    include '../Models/readCityById.php';

    session_start();
    $relativePath;
    if  (
            isset($_SESSION['loggedIn']) &&
            $_SESSION['loggedIn'] == TRUE &&
            isset($_SESSION['userLoggedIn']) &&
            ($user = readUserById($_SESSION['userLoggedIn']['id'])) != 'NULL' &&
            isset($user) && 
            ($city = readCityById($user[0]['cityId'])) != 'NULL'
        )
    {
        $_SESSION['user'] = $user;
        $_SESSION['city'] = $city;
        $relativePath = '../Views/user_account.php';    
    }
    else
    {
        unset($_SESSION['userLoggedIn']);
        $_SESSION['loggedIn'] = FALSE;
        $relativePath = '../Controlers/signin_login.php';
    }
    header('Location: '.$relativePath);
   
    //var_dump($city[0]['name']);