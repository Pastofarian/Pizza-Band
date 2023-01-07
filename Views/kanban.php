<div id="listingpizzas" class='displayFlex'>
    <?php
        $pizzas = $_SESSION['pizzasList'];
        foreach ($pizzas as $pizza) {
    ?>
    <div class='pizzaContainer' id='pizzaContainer<?= $pizza['id'] ?>' pizzaId='<?= $pizza['id'] ?>'>
        <h4 class='title'><?= $pizza['name'] ?></h4>
        <span class='price'><?= $pizza['totalPrice']?>€</span>
        <ul class='ingredientList'>
            <?php
                if (isset($pizza['ingredients']) && $pizza['ingredients'] != 'NULL') {
                    foreach ($pizza['ingredients'] as $ingredient) {
            ?>
            <li>
                <span class='ingredientName'><?= $ingredient['name'] ?></span>
                <div class='flagContainer'>
                    <?php 
                        if ($ingredient['isVege']) {
                    ?>
                    <span class='flag vegeFlag'>VG</span>
                    <?php
                        }
                    ?>
                    <?php 
                        if ($ingredient['isGlutenFree']) {
                    ?>
                    <span class='flag glutenFlag'>GF</span>
                    <?php
                        }
                    ?>
                </div>
            </li>
            <?php
                    }
                }
            ?>
        </ul>
    </div>
    <?php
        }
    ?>
</div>