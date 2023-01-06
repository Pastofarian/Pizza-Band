document.addEventListener('DOMContentLoaded', (event) => {
    let pizzaContainers = document.querySelectorAll('.pizzaContainer');
    for (let c of pizzaContainers) {
        c.addEventListener('click', function() {
            let filter = setFilter();
            let window = document.createElement('div');
            window.setAttribute('class', 'formWindow');
            window.style.width = '50%';
            window.style.margin = 'auto';
            window.style.backgroundColor = 'white';
            window.style.height = '80%';
            window.style.zIndex = '3';
            window.style.padding = '1em';
            createFormular(window, this);
            filter.appendChild(window);
        })
    }
});

function createFormular(root, clickedPizza) {
    let clickedPizzaId = clickedPizza.getAttribute('pizzaid');

    //Création du dom du formulaire

    //Création des élement dom du choix de quantité
    let quantityContainer = document.createElement('div');
    quantityContainer.setAttribute('class', 'fieldContainer');
    let quantityLabel = document.createElement('label');
    quantityLabel.setAttribute('for', 'quantity');
    quantityLabel.setAttribute('class', 'fieldLabel');
    quantityLabel.innerText = 'Quantité :';
    let quantityInput = document.createElement('input');
    quantityInput.setAttribute('class', 'fieldData');
    quantityInput.type = 'number';
    quantityInput.value = 1;
    quantityInput.setAttribute('name', 'quantity');
    quantityContainer.appendChild(quantityLabel);
    quantityContainer.appendChild(quantityInput);

    //Création des éléments dom du choix de pizza
    let pizzaContainer = document.createElement('div');
    pizzaContainer.setAttribute('class', 'fieldContainer');
    let pizzaLabel = document.createElement('label');
    pizzaLabel.setAttribute('for', 'pizza');
    pizzaLabel.setAttribute('class', 'fieldLabel');
    pizzaLabel.innerText = 'Pizza :';
    let pizzaSelect = document.createElement('select');
    pizzaSelect.setAttribute('class', 'fieldData');
    pizzaSelect.setAttribute('name', 'pizza');
    pizzaContainer.appendChild(pizzaLabel);
    pizzaContainer.appendChild(pizzaSelect);

    //Création des éléments dom du choix de taille
    let sizeContainer = document.createElement('div');
    sizeContainer.setAttribute('class', 'fieldContainer');
    let sizeLabel = document.createElement('label');
    sizeLabel.setAttribute('for', 'size');
    sizeLabel.setAttribute('class', 'fieldLabel');
    sizeLabel.innerText = 'Taille :';
    let sizeSelect = document.createElement('select');
    sizeSelect.setAttribute('class', 'fieldData');
    sizeSelect.setAttribute('name', 'size');
    sizeContainer.appendChild(sizeLabel);
    sizeContainer.appendChild(sizeSelect);

    //Création des éléments dom du choix de pate
    let doughContainer = document.createElement('div');
    doughContainer.setAttribute('class', 'fieldContainer');
    let doughLabel = document.createElement('label');
    doughLabel.setAttribute('for', 'dough');
    doughLabel.setAttribute('class', 'fieldLabel');
    doughLabel.innerText = 'Pâte :';
    let doughSelect = document.createElement('select');
    doughSelect.setAttribute('class', 'fieldData');
    doughSelect.setAttribute('name', 'dough');
    doughContainer.appendChild(doughLabel);
    doughContainer.appendChild(doughSelect);

    //Création des éléments dom du choix des suppléments
    let suppContainer = document.createElement('div');
    suppContainer.setAttribute('class', 'fieldContainer');
    let suppLabel = document.createElement('label');
    suppLabel.setAttribute('for', 'supp');
    suppLabel.setAttribute('class', 'fieldLabel');
    suppLabel.innerText = 'Suppléments :';
    let suppSelect = document.createElement('select');
    suppSelect.setAttribute('multiple','');
    suppSelect.setAttribute('class', 'fieldData');
    suppSelect.setAttribute('name', 'supp');
    suppContainer.appendChild(suppLabel);
    suppContainer.appendChild(suppSelect);

    //Création des éléments dom de l'affichage du prix
    let priceContainer = document.createElement('div');
    priceContainer.setAttribute('class', 'fieldContainer');
    let priceLabel = document.createElement('label');
    priceLabel.setAttribute('for', 'price');
    priceLabel.setAttribute('class', 'fieldLabel');
    priceLabel.innerText = 'Prix :';
    let subPriceContainer = document.createElement('div');
    subPriceContainer.setAttribute('class', 'subContainer fieldData');
    let priceTag = document.createElement('span');
    priceTag.setAttribute('name', 'price');
    let currencyTag = document.createElement('span');
    currencyTag.innerHTML = '€';
    subPriceContainer.appendChild(priceTag);
    subPriceContainer.appendChild(currencyTag);
    priceContainer.appendChild(priceLabel);
    priceContainer.appendChild(subPriceContainer);

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
        computePrice(
            priceTag,
            quantityInput.value,
            pizzaSelect.options[pizzaSelect.selectedIndex].value,
            sizeSelect.options[sizeSelect.selectedIndex].value,
            doughSelect.options[doughSelect.selectedIndex].value,
            getSelectedValues(suppSelect),
            response
        );
        quantityInput.addEventListener('change', function() {
            computePrice(
                priceTag,
                quantityInput.value,
                pizzaSelect.options[pizzaSelect.selectedIndex].value,
                sizeSelect.options[sizeSelect.selectedIndex].value,
                doughSelect.options[doughSelect.selectedIndex].value,
                getSelectedValues(suppSelect),
                response
            );
        });
        pizzaSelect.addEventListener('change', function() {
            fillSupplements(suppSelect, pizzaSelect.options[pizzaSelect.selectedIndex].value)
            computePrice(
                priceTag,
                quantityInput.value,
                pizzaSelect.options[pizzaSelect.selectedIndex].value,
                sizeSelect.options[sizeSelect.selectedIndex].value,
                doughSelect.options[doughSelect.selectedIndex].value,
                getSelectedValues(suppSelect),
                response
            );
        });
        doughSelect.addEventListener('change', function() {
            computePrice(
                priceTag,
                quantityInput.value,
                pizzaSelect.options[pizzaSelect.selectedIndex].value,
                sizeSelect.options[sizeSelect.selectedIndex].value,
                doughSelect.options[doughSelect.selectedIndex].value,
                getSelectedValues(suppSelect),
                response
            );
        });
        sizeSelect.addEventListener('change', function() {
            computePrice(
                priceTag,
                quantityInput.value,
                pizzaSelect.options[pizzaSelect.selectedIndex].value,
                sizeSelect.options[sizeSelect.selectedIndex].value,
                doughSelect.options[doughSelect.selectedIndex].value,
                getSelectedValues(suppSelect),
                response
            );
        });
        suppSelect.addEventListener('change', function() {
            computePrice(
                priceTag,
                quantityInput.value,
                pizzaSelect.options[pizzaSelect.selectedIndex].value,
                sizeSelect.options[sizeSelect.selectedIndex].value,
                doughSelect.options[doughSelect.selectedIndex].value,
                getSelectedValues(suppSelect),
                response
            );
        });
    });

    //Ajout des différents élements a l'élément dom 'root' reçu en argument
    root.appendChild(quantityContainer);
    root.appendChild(pizzaContainer);
    root.appendChild(sizeContainer);
    root.appendChild(doughContainer);
    root.appendChild(suppContainer);
    root.appendChild(priceContainer);
}

function fillSupplements(suppSelect, selectedPizzaId) {
    //Vidage du contenu de la sélection des suppléments disponible en vue de son ré-remplissage
    while (suppSelect.lastChild)
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

function computePrice(root, quantity, selectedPizzaId, selectedSizeId, selectedDoughId, selectedSuppIds, datas) {
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
    for (let selectedSuppId of selectedSuppIds) {
        for (ingredient of datas['ingredients']) {
            if (ingredient['id'] == selectedSuppId) {
                sps += parseFloat(ingredient['price']);
            }
        }
    }
    let price = parseFloat(p['totalPrice']) + parseFloat(s['price']) + parseFloat(d['price']) + sps;
    root.innerHTML = price + ' x ' + parseInt(quantity) + ' = ' + price*parseInt(quantity);
}

let filterSet = false;

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

function setFilter() {
    if (filterSet == false) {
        let filter = document.createElement('div');
        filter.setAttribute('class', 'filter');
        filter.style.top = '0';
        filter.style.left = '0';
        filter.style.width = '100%';
        filter.style.display = 'flex';
        filter.style.justifyContent = 'center';
        filter.style.alignItems = 'center';
        filter.style.minHeight = '100%';
        filter.style.position = 'fixed';
        filter.style.backgroundColor = 'rgba(0,0,0,0.6)';
        //filter.style.float = 'none';
        filter.style.zIndex = '2';
        filter.addEventListener('click', function(e) {
            if (e.target === e.currentTarget) {
                if (filterSet == true) {
                    this.remove();
                    filterSet = false;
                }
            }
        })
        document.body.appendChild(filter);
        filterSet = true;
        return filter;
    }
}