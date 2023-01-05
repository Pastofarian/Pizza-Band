<?php   
   session_start();
   $pizzas = ["Marguerita"=>17, "Quatro Stagioni"=>20, "Reine"=>22, "Calzone"=>18, "Capriocciosa"=>18, "Saumon"=>23, "Caprese"=>13, "Pepperoni"=>15]; // problème de session avec le contrôleur?
   $supp = ["Oeuf"=>17, "Champignon"=>20, "Ananas"=>22];
   
   ?>
<form id="order" method="post" action="order.php">
   <label for="cars">Choisissez votre pizza:</label><br>
   <select name="pizza" id="pizza" size="0" form="order">
   <?php foreach ($pizzas as $key => $value) 
      {
          echo '<option value="' . $key . '">' . $key . '</option>';
      }
      
      ?>
   </select><br>
   <label for="qty">Choisissez votre quantité :</label><br>
   <input type="number" id="qty" name="qty" value="1"> <br>
   <label for="cars">Choisissez vos suppléments:</label><br>
   <select name="supp[]" id="supp" multiple size="0" form="order">
   <?php foreach ($supp as $key => $value) 
      {
          echo '<option value="' . $key . '">' . $key . '</option>';
      }
      ?>
   <br>
   <input type="submit" value="Ajouter au panier">
</form>
<br>----------------------------------<br>
<?php 
   //Créé un tableau vide qui recevra toutes les orderline
   if(!isset($_SESSION["order"]))
   {
       $_SESSION["order"] = [];
   }
   
   //Ajoute l'order line au tableau lorsque le formulaire est envoyé 
   addOrderLine($_POST);
   
   
   // unset($_SESSION["order"]);
   
   ?>
<!-- Créé un deuxième formulaire qui validera la commande et l'enverra au controler -->
<form id="sendorder" method="post" action="/controlerconfig.php">
   Votre panier :
   <?php 
      // Passe en revue chaque ligne de commande (tableau) et affiche les informations relatives à la commandes
      if(!empty($_SESSION["order"]))
      {
          foreach($_SESSION["order"] as $key => $orderline)
          {
              echo $orderline["qty"];
              echo " ";
              echo $orderline["pizza"];
              echo "<br>";
              if(array_key_exists("supp", $orderline))
                  {
                      echo "Suppléments : ";
                      echo "<br>";
                      foreach($orderline["supp"] as $supp)
                      {
                      echo $supp;
                      echo "<br>";
                      }
                  }
          }
          echo "<br>";
          // Donne la possibilité de supprimer sa commande en entier (devrait pouvoir supprimer 1 order line et pas toute l'order mais je n'arrive pas à transmettre l'index à la fonction) Fait appel à ajax.php et scripts.js
          echo '<a href="" onclick="myAjax()" class="deletebtn">Annuler sa commande</a>';
          echo "<br>";
          echo '<input type="submit" value="Passer commande">';
      }
      ?>
</form>
<?php 
   function addOrderLine($values)
   {
       array_push($_SESSION["order"], $values);
   }
   echo "<br>";
   
   function deleteOrderLine($index)
   {
       unset($_SESSION["order"][$index]);
   }
   ?>
