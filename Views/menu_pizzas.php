<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Menu des pizzas</title>
</head>
<body>
        <img src="../Images/small_logo.png" id="small_logo">
    <div class="menu_title">
        <h1>Les Pizzas</h1>
    </div>

    <div class="menu_list">
    <?php
        session_start();
        foreach ($_SESSION["pizzas"] as $key => $value)
        {
        echo '<div class="menu_list_item">';
            echo '<span class="menu_list_title">'?><?=$key?><?='</span>';
            echo '<span class="menu_list_price">'?><?=$value?><?='</span>';
            echo '<span class="menu_list_ingredients">ingredients</span>';

            echo '<span class="menu_list_badge">VÉGÉTARIENNE</span>';
        echo '</div>';

        //var_dump($_SESSION["pizzas"]);
        }
        //session_destroy();
        ?>
    </div>
</body>
</html>
