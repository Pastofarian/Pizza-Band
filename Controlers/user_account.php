<?php
    include '../Models/readUserById.php';
    session_start();
    $relativePath;
    if  (
            isset($_SESSION['loggedIn']) &&
            $_SESSION['loggedIn'] == TRUE &&
            isset($_SESSION['userLoggedIn']) &&
            ($user = readUserById($_SESSION['userLoggedIn']['id'])) != 'NULL'
        )
    {
        $_SESSION['user'] = $user;
        $relativePath = '../Views/user_account.php';    
    }
    else
    {
        unset($_SESSION['userLoggedIn']);
        $_SESSION['loggedIn'] = FALSE;
        $relativePath = '../Controlers/signin_login.php';
    }
    header('Location: '.$relativePath);