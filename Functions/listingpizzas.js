document.addEventListener('DOMContentLoaded', (event) => {
    let window = document.querySelector('.formWindow');
    window.style.display = 'none';
    let filter = document.querySelector('.filter');
    filter.style.display = 'none';
    let quantityInput = document.querySelector('.formWindow #quantityField');
    quantityInput.value = "1";
    let pizzaSelect = document.querySelector('#pizzaContainer .fieldData');
    let sizeSelect = document.querySelector('#sizeContainer .fieldData');
    let doughSelect = document.querySelector('#doughContainer .fieldData');
    let suppSelect = document.querySelector('#suppContainer .fieldData');
    let priceTag = document.querySelector('#pizzaPrice');
    let totalPriceTag = document.querySelector('#totalPrice');
    console.log(quantityInput);
    console.log(totalPriceTag);
    priceTag.innerHTML = 'salut';
    let pizzaContainers = document.querySelectorAll('.pizzaContainer');
    for (let c of pizzaContainers) {
        c.addEventListener('click', function() {
            filter.style.display = 'flex';
            window.style.display = 'block';
            updateForm(
                this,
                quantityInput,
                pizzaSelect,
                sizeSelect,
                doughSelect,
                suppSelect,
                priceTag,
                totalPriceTag
            );
            filter.addEventListener('click', function (e) {
                if (e.target === e.currentTarget) {
                    filter.style.display = 'none';
                    window.style.display = 'none';
                }
            });
        });
    }
});

function updateForm(clickedPizza, quantityInput, pizzaSelect, sizeSelect, doughSelect, suppSelect, priceTag, totalPriceTag) {
    let clickedPizzaId = clickedPizza.getAttribute('pizzaid');
    //Ces données pourraient être directement écrite via le php
    //Requête simple pour obtenir toutes les informations nécessaire au remplissage du formulaire
    request('http://localhost:8888/mainbranch/Controlers/orderlinedatajson.php', function(httpRequest) {
        let response = JSON.parse(httpRequest.responseText);
        //Création des élements dom options des différents champs select en utilisant la réponse de la requête
        for (let pizza of response['pizzas']) {
            let newOpt = document.createElement('option');
            newOpt.value = pizza['id'];
            newOpt.innerHTML = pizza['name'] + ' (' + pizza['totalPrice'] + '€)';
            pizzaSelect.appendChild(newOpt);
        }
        for (let dough of response['doughs']) {
            let newOpt = document.createElement('option');
            newOpt.value = dough['id'];
            newOpt.innerHTML = dough['name'] + ' (+' + dough['price'] + '€)';
            doughSelect.appendChild(newOpt);
        }
        for (let size of response['sizes']) {
            let newOpt = document.createElement('option');
            newOpt.value = size['id'];
            newOpt.innerHTML = size['name'] + ' (+' + size['price'] + '€)';
            sizeSelect.appendChild(newOpt);
        }
        //Pré-sélection de la pizza qui a été cliquée
        for (let option in pizzaSelect.options) {
            if (pizzaSelect.options[option].value == clickedPizzaId) {
                pizzaSelect.selectedIndex = option;
            }
        }
        fillSupplements(suppSelect, pizzaSelect.options[pizzaSelect.selectedIndex].value);
        let tmp = computePrice(
            pizzaSelect.options[pizzaSelect.selectedIndex].value,
            sizeSelect.options[sizeSelect.selectedIndex].value,
            doughSelect.options[doughSelect.selectedIndex].value,
            getSelectedValues(suppSelect),
            response
        );
        priceTag.innerHTML = tmp;
        totalPriceTag.innerHTML = parseFloat(tmp) * parseInt(quantityInput.value);
        console.log(tmp * parseInt(quantityInput.value));
        
        quantityInput.addEventListener('change', function() {
            let tmp = computePrice(
                pizzaSelect.options[pizzaSelect.selectedIndex].value,
                sizeSelect.options[sizeSelect.selectedIndex].value,
                doughSelect.options[doughSelect.selectedIndex].value,
                getSelectedValues(suppSelect),
                response
            );
            priceTag.innerHTML = tmp;
            totalPriceTag.innerHTML = tmp * parseInt(quantityInput.value);
        });
        pizzaSelect.addEventListener('change', function() {
            fillSupplements(suppSelect, pizzaSelect.options[pizzaSelect.selectedIndex].value)
            let tmp = computePrice(
                pizzaSelect.options[pizzaSelect.selectedIndex].value,
                sizeSelect.options[sizeSelect.selectedIndex].value,
                doughSelect.options[doughSelect.selectedIndex].value,
                getSelectedValues(suppSelect),
                response
            );
            priceTag.innerHTML = tmp;
            totalPriceTag.innerHTML = tmp * parseInt(quantityInput.value);
        });
        doughSelect.addEventListener('change', function() {
            let tmp = computePrice(
                pizzaSelect.options[pizzaSelect.selectedIndex].value,
                sizeSelect.options[sizeSelect.selectedIndex].value,
                doughSelect.options[doughSelect.selectedIndex].value,
                getSelectedValues(suppSelect),
                response
            );
            priceTag.innerHTML = tmp;
            totalPriceTag.innerHTML = tmp * parseInt(quantityInput.value);
        });
        sizeSelect.addEventListener('change', function() {
            let tmp = computePrice(
                pizzaSelect.options[pizzaSelect.selectedIndex].value,
                sizeSelect.options[sizeSelect.selectedIndex].value,
                doughSelect.options[doughSelect.selectedIndex].value,
                getSelectedValues(suppSelect),
                response
            );
            priceTag.innerHTML = tmp;
            totalPriceTag.innerHTML = tmp * parseInt(quantityInput.value);
        });
        suppSelect.addEventListener('change', function() {
            let tmp = computePrice(
                pizzaSelect.options[pizzaSelect.selectedIndex].value,
                sizeSelect.options[sizeSelect.selectedIndex].value,
                doughSelect.options[doughSelect.selectedIndex].value,
                getSelectedValues(suppSelect),
                response
            );
            priceTag.innerHTML = tmp;
            totalPriceTag.innerHTML = tmp * parseInt(quantityInput.value);
        });
    });
}

function fillSupplements(suppSelect, selectedPizzaId) {
    //Vidage du contenu de la sélection des suppléments disponible en vue de son ré-remplissage
    while (suppSelect.options.length > 0)
        suppSelect.remove(suppSelect.lastChild);
    //Requete base de donnée pour connaitre les ingrédients disponible à la nouvelle pizza sélectionnée
    request('http://localhost:8888/mainbranch/Controlers/orderlinedatajson1.php?id='+selectedPizzaId, function(httpRequest) {
        let response = JSON.parse(httpRequest.responseText);
        for (let ingredient of response) {
            let newOpt = document.createElement('option');
            newOpt.value = ingredient['id'];
            newOpt.innerHTML = ingredient['name'] + ' (+' + ingredient['price'] + '€)';
            suppSelect.appendChild(newOpt);
        }
    });
}

function computePrice(selectedPizzaId, selectedSizeId, selectedDoughId, selectedSuppIds, datas) {
    let p, s, d;
    for (let pizza of datas['pizzas']) {
        if (pizza['id'] == selectedPizzaId) {
            p = pizza;
            break;
        }
    }
    for (let size of datas['sizes']) {
        if (size['id'] == selectedSizeId) {
            s = size;
            break;
        }
    }
    for (let dough of datas['doughs']) {
        if (dough['id'] == selectedDoughId) {
            d = dough;
            break;
        }
    }
    let sps = 0;
    if (Array.isArray(selectedSuppIds)) { 
        for (let selectedSuppId of selectedSuppIds) {
            for (ingredient of datas['ingredients']) {
                if (ingredient['id'] == selectedSuppId) {
                    sps += parseFloat(ingredient['price']);
                }
            }
        }
    }
    return parseFloat(p['price']) + parseFloat(s['price']) + parseFloat(d['price']) + sps;
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

function getSelectedValues(select) {
    let result = [];
    let options = select && select.options;
    let opt;
  
    for (var i=0, iLen=options.length; i<iLen; i++) {
      opt = options[i];
  
      if (opt.selected) {
        result.push(opt.value);
      }
    }
    return result;
  }