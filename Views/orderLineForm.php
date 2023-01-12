<div class="filter">
    <div class="formWindow">
        <div id="pizzaContainer" class="fieldContainer">
            <span class="fieldLabel">Pizza :</span>
            <select class="fieldData">
            </select>
        </div>
        <div id="sizeContainer" class="fieldContainer">
            <span class="fieldLabel">Taille :</span>
            <select class="fieldData">
            </select>
        </div>
        <div id="doughContainer" class="fieldContainer">
            <span class="fieldLabel">Pâte :</span>
            <select class="fieldData">
            </select>
        </div>
        <div id="suppContainer" class="fieldContainer">
            <span class="fieldLabel">Suppléments :</span>
            <select multiple class="fieldData">
            </select>
        </div>
        <div id="priceContainer" class="fieldContainer">
            <span class="fieldLabel">Prix :</span>
            <div class="subContainer fieldData">
                <span>
                    <span id="pizzaPrice"></span>
                    <span>€</span>
                </span>
                <span>x</span>
                <input id="quantityField" class="inlineField" type="number">
                <span>=</span>
                <span>
                    <span id="totalPrice"></span>
                    <span>€</span>
                </span>
            </div>
        </div>
        <button id='sendOrderLine'>Ajouter à ma commande</button>
    </div>
</div>