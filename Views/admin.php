<?php
   session_start();
   if (!isset($_SESSION['admin']))
      header('Location: ../Controlers/admin.php');
?>


<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="../CSS/admin.css" />
      <link rel="stylesheet" href="../CSS/header.css" />
      <link rel="stylesheet" href="../CSS/nav.css" />
      <link rel="stylesheet" href="../CSS/footer.css" />
      <link rel="stylesheet" href="../CSS/backgroundFilter.css">
      <script type="text/javascript" src="../Scripts/pizza_admin.js"></script>
      <title>AdminView</title>
   </head>
   <body class="homePage">
      <header></header>
      <?php
         include './nav.php';
      ?>
      <div class="mainWrapper">
         <?php
            include './pizza_admin.php';
            include './ingre_admin.php';
            include './size_admin.php';
            include './dough_admin.php';
         ?>
      </div>
      <?php
         include './footer.php';
      ?>
      <div id="backgroundFilter">
      </div>
   </body>
</html>
