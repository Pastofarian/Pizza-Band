<div class="displayFlex">
<?php    

$pizzas = $_SESSION['pizzasList'];
$supp = $_SESSION['suppList'];
?>
    <form id="order" method="post" action="../Controlers/orderline.php">
        <label for="cars">Choisissez votre pizza:</label><br>
        <select name="pizza" id="pizza" size="0" form="order">
            <?php foreach ($pizzas as $key => $value) 
                {  
                echo '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
                }
            ?>
        </select>
        <br>
        <label for="qty">Choisissez votre quantité :</label><br>
        <input type="number" id="qty" name="qty" value="1"> <br>
        <label for="cars">Choisissez vos suppléments:</label><br>
        <select name="supp[]" id="supp" multiple size="3" form="order">
            <?php foreach ($supp as $key => $value) 
                {
                    echo '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
                }
            ?>
        <br>
        <input type="submit" value="Ajouter au panier">
    </form>
</div>