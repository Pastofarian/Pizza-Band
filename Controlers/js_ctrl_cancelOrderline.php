<?php
    session_start();

    if(isset($_GET) && isset($_GET['index']))
    {
        foreach($_SESSION['order'] as $key => $values)
        {
            if ($key == $_GET['index'])
            {
                unset($_SESSION['order'][$key]);
            }
        }
    }