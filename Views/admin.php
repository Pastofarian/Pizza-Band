<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="../CSS/admin.css" />
      <title>AdminView</title>
   </head>
   <body class="homePage">

        <?php
            $pizzas = ["Marguerita"=>17, "Quatro Stagioni"=>20, "Reine"=>22, "Calzone"=>18, "Capriocciosa"=>18, "Saumon"=>23, "Caprese"=>13, "Pepperoni"=>15]; 
            $supp = ["Oeuf"=>17, "Champignon"=>20, "Ananas"=>22, "Olive"=>22, "Câpre"=>22, "Salami"=>10];
        ?>
<h1>Administration des Pizzas</h1>
<div class="form-container">
         <form id="display" class="form" method="post" action="admin.php">
         <label for="display">Afficher une pizza</label><br>
         <select name="pizza" id="pizza" size="0" form="order">
         <?php foreach ($pizzas as $key => $value) 
            {
                echo '<option value="' . $key . '">' . $key . '</option>';
            }
            ?>
         <input type="submit" value="Afficher">
         </form>

         <form id="update" class="form" method="post" action="admin.php">
         <label for="display">Modifier une pizza</label><br>
         <select name="pizza" id="pizza" size="0" form="order">
         <?php foreach ($pizzas as $key => $value) 
            {
                echo '<option value="' . $key . '">' . $key . '</option>';
            }
            ?>
         <input type="submit" value="Modifier">
         </form>

         <form id="delete" class="form" method="post" action="admin.php">
         <label for="display">Effacer une pizza</label><br>
         <select name="pizza" id="pizza" size="0" form="order">
         <?php foreach ($pizzas as $key => $value) 
            {
                echo '<option value="' . $key . '">' . $key . '</option>';
            }
            ?>
         <input type="submit" value="Effacer">
         </form>

         <form id="create" class="form" method="post" action="admin.php">
         <label for="display">Créer une pizza</label><br>
         <p>Nom de la pizza</p>
         <input class="form-input" name="pizzaName" id="pizzaName" type="text" required>

         <p>Prix de la pizza</p>
         <input class="form-input" name="pizzaPrice" id="pizzaPrice" type="text" required>
         <input type="submit" value="Créer">
         </form>
         </div>

         <h1>Administration des Ingrédients</h1>
<div class="form-container">
         <form id="display" class="form" method="post" action="admin.php">
         <label for="display">Afficher un ingrédient</label><br>
         <select name="pizza" id="pizza" size="0" form="order">
         <?php foreach ($pizzas as $key => $value) 
            {
                echo '<option value="' . $key . '">' . $key . '</option>';
            }
            ?>
         <input type="submit" value="Afficher">
         </form>

         <form id="update" class="form" method="post" action="admin.php">
         <label for="display">Modifier un ingrédient</label><br>
         <select name="pizza" id="pizza" size="0" form="order">
         <?php foreach ($pizzas as $key => $value) 
            {
                echo '<option value="' . $key . '">' . $key . '</option>';
            }
            ?>
         <input type="submit" value="Modifier">
         </form>

         <form id="delete" class="form" method="post" action="admin.php">
         <label for="display">Effacer un ingrédient</label><br>
         <select name="pizza" id="pizza" size="0" form="order">
         <?php foreach ($pizzas as $key => $value) 
            {
                echo '<option value="' . $key . '">' . $key . '</option>';
            }
            ?>
         <input type="submit" value="Effacer">
         </form>

         <form id="create" class="form" method="post" action="admin.php">
         <label for="display">Créer un ingrédient</label><br>
         <p>Nom de l'ingrédient</p>
         <input class="form-input" name="ingredientName" id="ingredientName" type="text" required>

         <p>Prix de l'ingrédient</p>
         <input class="form-input" name="ingredientPrice" id="ingredientPrice" type="text" required><br>

         Végétarien
         <input class="checkBox" type="checkbox" id="ingredientVege" name="vegetarian" value="Végétarien">

         Sans Gluten
         <input class="checkBox" type="checkbox" id="ingredientGluten" name="gluten" value="Sans Gluten"><br>

         <input type="submit" value="Créer">

         </form>
         </div>
   </body>
</html>
