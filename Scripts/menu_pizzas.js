document.addEventListener('DOMContentLoaded', (event) => {
    let pizzaContainers = document.querySelectorAll('.pizzaContainer');
    setGridDynamic(pizzaContainers.length);
    setHeightDynamic();
    refreshBasket();
    let window = document.querySelector('.formWindow');
    let filter = document.querySelector('.filter');
    let fields = {
        'quantity': document.querySelector('.formWindow #quantityField'),
        'pizza': document.querySelector('#pizzaContainer .fieldData'),
        'size': document.querySelector('#sizeContainer .fieldData'),
        'dough': document.querySelector('#doughContainer .fieldData'),
        'supps': document.querySelector('#suppContainer .fieldData'),
        'price': document.querySelector('#pizzaPrice'),
        'totalPrice': document.querySelector('#totalPrice'),
        'send': document.querySelector('#sendOrderLine'),
    }
    fields['send'].addEventListener('click', function () {
        let post = {
            'pizzaId': fields['pizza'].value,
            'doughId': fields['dough'].value,
            'sizeId': fields['size'].value,
            'suppIds': getSelectedValues(fields['supps']),
            'quantity': fields['quantity'].value,
            'price': fields['totalPrice'].value
        }
        postRequest('http://localhost/Pizza-Band/Controlers/js_ctrl_pushSessionOrderline.php', function (httpRequest) {
            refreshBasket();
        }, post);
    });
    for (let c of pizzaContainers) {
        c.addEventListener('click', function () {
            removeAllOptions(fields['pizza']);
            removeAllOptions(fields['dough']);
            removeAllOptions(fields['size']);
            fields['quantity'].value = '1';
            filter.style.display = 'flex';
            window.style.display = 'flex';
            updateForm(
                this,
                fields
            );
            filter.addEventListener('click', function (e) {
                if (e.target === e.currentTarget) {
                    filter.style.display = 'none';
                    window.style.display = 'none';
                    // supprimer le contenu des différents selects et prix
                }
            });
            fields['send'].addEventListener('click', function (e) {
                if (e.target === e.currentTarget) {
                    filter.style.display = 'none';
                    window.style.display = 'none';
                    // supprimer le contenu des différents selects et prix
                }
            });
        });
    }
});

function updateForm(clickedPizza, fields) {
    let clickedPizzaId = clickedPizza.getAttribute('pizzaid');

    request('http://localhost/Pizza-Band/Controlers/js_ctrl_orderlineFormFillingDatas.php', function (httpRequest) {
        let response = JSON.parse(httpRequest.responseText);
        //Création des élements dom options des différents champs select en utilisant la réponse de la requête
        console.log(response);
        if (response['pizzas'].length > 0) {
            for (let pizza of response['pizzas']) {
                let newOpt = document.createElement('option');
                newOpt.value = pizza['id'];
                newOpt.innerHTML = pizza['name'] + ' (' + pizza['totalPrice'] + '€)';
                fields['pizza'].appendChild(newOpt);
            }
            for (let option in fields['pizza'].options) {
                if (fields['pizza'].options[option].value == clickedPizzaId) {
                    fields['pizza'].selectedIndex = option;
                }
            }
        }
        if (response['doughs'] != 'NULL') {
            for (let dough of response['doughs']) {
                let newOpt = document.createElement('option');
                newOpt.value = dough['id'];
                newOpt.innerHTML = dough['name'] + ' (+' + dough['price'] + '€)';
                fields['dough'].appendChild(newOpt);
            }
        }
        if (response['sizes'] != 'NULL') {
            for (let size of response['sizes']) {
                let newOpt = document.createElement('option');
                newOpt.value = size['id'];
                newOpt.innerHTML = size['name'] + ' (+' + size['price'] + '€)';
                fields['size'].appendChild(newOpt);
            }
        }
        fillSupplements(fields['supps'], fields['pizza'].options[fields['pizza'].selectedIndex].value);
        setPricesHTML(fields, response);

        fields['quantity'].addEventListener('change', function () {
            if (fields['quantity'].value == '' || isNaN(fields['quantity'].value)) {
                fields['quantity'].value = '1';
            }
            setPricesHTML(fields, response);
        });
        fields['pizza'].addEventListener('change', function () {
            fillSupplements(fields['supps'], fields['pizza'].options[fields['pizza'].selectedIndex].value)
            setPricesHTML(fields, response);
        });
        fields['dough'].addEventListener('change', function () {
            setPricesHTML(fields, response);
        });
        fields['size'].addEventListener('change', function () {
            setPricesHTML(fields, response);
        });
        fields['supps'].addEventListener('change', function () {
            setPricesHTML(fields, response);
        });
    });
}

function setPricesHTML(fields, datas) {
    let currentPizzaPrice = computePrice(fields, datas);
    fields['price'].innerHTML = currentPizzaPrice;
    fields['totalPrice'].innerHTML = parseFloat(currentPizzaPrice) * parseInt(fields['quantity'].value);
}

function fillSupplements(suppSelect, selectedPizzaId) {
    //Vidage du contenu de la sélection des suppléments disponible en vue de son ré-remplissage
    while (suppSelect.options.length > 0)
        suppSelect.remove(suppSelect.lastChild);
    //Requete base de donnée pour connaitre les ingrédients disponible à la nouvelle pizza sélectionnée
    request('http://localhost/Pizza-Band/Controlers/js_ctrl_readAvailableIngredientsByPizzaId.php?id=' + selectedPizzaId, function (httpRequest) {
        let response = JSON.parse(httpRequest.responseText);
        if (response != 'NULL') {
            for (let ingredient of response) {
                let newOpt = document.createElement('option');
                newOpt.value = ingredient['id'];
                newOpt.innerHTML = ingredient['name'] + ' (+' + ingredient['price'] + '€)';
                suppSelect.appendChild(newOpt);
            }
        }
    });
}

function computePrice(fields, datas) {
    let selectedPizzaOptions = fields['pizza'].options[fields['pizza'].selectedIndex];
    let selectedSizeOption = fields['size'].options[fields['size'].selectedIndex];
    let selectedDoughOption = fields['dough'].options[fields['dough'].selectedIndex];
    let selectedPizzaId = (selectedPizzaOptions != undefined) ? selectedPizzaOptions.value : false;
    let selectedSizeId = (selectedSizeOption != undefined) ? selectedSizeOption.value : false;
    let selectedDoughId = (selectedDoughOption != undefined) ? selectedDoughOption.value : false;
    let selectedSuppIds = getSelectedValues(fields['supps']);
    let pizzaTotalPrice = 0;
    let sizePrice = 0;
    let doughPrice = 0;
    let suppsTotalPrice = 0;
    if (datas)
        for (let pizza of datas['pizzas']) {
            if (pizza['id'] == selectedPizzaId) {
                pizzaTotalPrice = parseFloat(pizza['totalPrice']);
                break;
            }
        }
    for (let size of datas['sizes']) {
        if (size['id'] == selectedSizeId) {
            sizePrice = parseFloat(size['price']);
            break;
        }
    }
    for (let dough of datas['doughs']) {
        if (dough['id'] == selectedDoughId) {
            doughPrice = parseFloat(dough['price']);
            break;
        }
    }
    if (Array.isArray(selectedSuppIds)) {
        for (let selectedSuppId of selectedSuppIds) {
            for (ingredient of datas['ingredients']) {
                if (ingredient['id'] == selectedSuppId) {
                    suppsTotalPrice += parseFloat(ingredient['price']);
                }
            }
        }
    }
    return pizzaTotalPrice + sizePrice + doughPrice + suppsTotalPrice;
}

let request = function (url, onsuccess) {
    let httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = function () {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            const status = httpRequest.status;
            if (status === 0 || (status >= 200 && status < 400)) {
                onsuccess(httpRequest);
            }
        }
    }
    httpRequest.open('GET', url, true);
    httpRequest.send();
}

let postRequest = function (url, onsuccess, datas) {
    let httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = function () {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            const status = httpRequest.status;
            if (status === 0 || (status >= 200 && status < 400)) {
                onsuccess(httpRequest);
            }
        }
    }
    httpRequest.open("POST", url, true);
    httpRequest.setRequestHeader("Accept", "application/json");
    httpRequest.setRequestHeader("Content-Type", "application/json");
    httpRequest.send(JSON.stringify(datas));
}

function getSelectedValues(select) {
    let result = [];
    let options = select && select.options;
    let opt;

    for (var i = 0, iLen = options.length; i < iLen; i++) {
        opt = options[i];

        if (opt.selected) {
            result.push(opt.value);
        }
    }
    return result;
}

function removeAllOptions(select) {
    while (select.options.length > 0)
        select.remove(select.lastChild);
}

function refreshBasket() {
    let parentContainer = document.getElementById("panierjson");
    request('http://localhost/Pizza-Band/Controlers/js_ctrl_panierJson.php', function (httpRequest) {
        let response = JSON.parse(httpRequest.responseText);
        while (parentContainer.children.length > 0) {
            parentContainer.removeChild(parentContainer.children[0])
        }
        for (let i in response) {
            let orderline = response[i];
            let container = document.createElement('div');
            let quantity = document.createElement('span');
            let pizzaName = document.createElement('span');
            let sizeName = document.createElement('span');
            let doughName = document.createElement('span');
            let ingredientNames = document.createElement('ul');
            container.setAttribute('class', 'orderlineContainer');
            quantity.setAttribute('class', 'quantityValue textField');
            quantity.innerHTML = orderline['quantity'];
            pizzaName.setAttribute('class', 'pizzaName textField');
            pizzaName.innerHTML = orderline['pizzaId']['name'];
            sizeName.setAttribute('class', 'sizeName textField');
            sizeName.innerHTML = orderline['sizeId']['name'];
            doughName.setAttribute('class', 'doughName textField');
            doughName.innerHTML = orderline['doughId']['name'];
            ingredientNames.setAttribute('class', 'ingredientsNames');
            for (let supp of orderline['suppIds']) {
                let newOpt = document.createElement('li');
                newOpt.setAttribute('class', 'ingredientName');
                newOpt.innerHTML = supp['name'];
                ingredientNames.appendChild(newOpt);
            }
            container.appendChild(quantity);
            container.appendChild(pizzaName);
            container.appendChild(sizeName);
            container.appendChild(doughName);
            container.appendChild(ingredientNames);
            parentContainer.appendChild(container);
            let btnCancelOrderline = document.createElement('button');
            btnCancelOrderline.setAttribute('class', 'deletebtn'); //class pour styler le button delete
            btnCancelOrderline.innerHTML = 'Annuler'
            btnCancelOrderline.setAttribute('orderlineindex', i);
            container.appendChild(btnCancelOrderline);

            btnCancelOrderline.addEventListener("click", function (c) {
                let httpRequest = new XMLHttpRequest();
                httpRequest.onreadystatechange = function () {
                    if (httpRequest.readyState === XMLHttpRequest.DONE) {
                        const status = httpRequest.status;
                        if (status === 0 || (status >= 200 && status < 400)) {
                            refreshBasket();
                        }
                    }
                }
                httpRequest.open('GET', 'http://localhost/Pizza-Band/Controlers/js_ctrl_cancelOrderline.php?index=' + i, true);
                httpRequest.send();
            })
        }
    })
}

function setGridDynamic(pizzaCount) {
    console.log('repeat(' + (Math.floor(pizzaCount / 3) || 1) + ', 200px)');
    document.querySelector('#listingpizzas').style.gridTemplateRows = 'repeat(' + (Math.floor(pizzaCount / 3) || 1) + ', 200px)';
}

function setHeightDynamic() {
    let c = document.querySelector('.container_menu');
    let c_child = document.querySelector('#menu');
    let c_child_height = window.getComputedStyle(c_child, null).height;
    console.log(c_child_height)
    c.style.height = c_child_height;
}


