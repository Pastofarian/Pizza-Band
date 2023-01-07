document.addEventListener('DOMContentLoaded', (event) => {
    refreshBasket();
    let window = document.querySelector('.formWindow');
    let filter = document.querySelector('.filter');
    let fields = {
        'quantity' : document.querySelector('.formWindow #quantityField'),
        'pizza' : document.querySelector('#pizzaContainer .fieldData'),
        'size' : document.querySelector('#sizeContainer .fieldData'),
        'dough' : document.querySelector('#doughContainer .fieldData'),
        'supps' : document.querySelector('#suppContainer .fieldData'),
        'price' : document.querySelector('#pizzaPrice'),
        'totalPrice' : document.querySelector('#totalPrice'),
        'send' : document.querySelector('#sendOrderLine'),
    } 
    let pizzaContainers = document.querySelectorAll('.pizzaContainer');
    fields['send'].addEventListener('click', function(){
        let post = {
            'pizzaId':fields['pizza'].value,
            'doughId':fields['dough'].value,
            'sizeId':fields['size'].value,
            'suppIds':getSelectedValues(fields['supps']),
            'quantity':fields['quantity'].value
        }
        postRequest('http://localhost/Projet%20PHP/test3/Controlers/orderline_test.php', function(httpRequest) {
            refreshBasket();
        }, post);
    });
    for (let c of pizzaContainers) {
        c.addEventListener('click', function() {
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

    request('http://localhost/Projet%20PHP/test3/Controlers/orderlinedatajson.php', function(httpRequest) {
        let response = JSON.parse(httpRequest.responseText);
        //Création des élements dom options des différents champs select en utilisant la réponse de la requête
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
        for (let dough of response['doughs']) {
            let newOpt = document.createElement('option');
            newOpt.value = dough['id'];
            newOpt.innerHTML = dough['name'] + ' (+' + dough['price'] + '€)';
            fields['dough'].appendChild(newOpt);
        }
        for (let size of response['sizes']) {
            let newOpt = document.createElement('option');
            newOpt.value = size['id'];
            newOpt.innerHTML = size['name'] + ' (+' + size['price'] + '€)';
            fields['size'].appendChild(newOpt);
        }
        fillSupplements(fields['supps'], fields['pizza'].options[fields['pizza'].selectedIndex].value);
        setPricesHTML(fields, response);
        
        fields['quantity'].addEventListener('change', function() {
            if (fields['quantity'].value == '' || isNaN(fields['quantity'].value)) {
                fields['quantity'].value = '1';
            }
            setPricesHTML(fields, response);
        });
        fields['pizza'].addEventListener('change', function() {
            fillSupplements(fields['supps'], fields['pizza'].options[fields['pizza'].selectedIndex].value)
            setPricesHTML(fields, response);
        });
        fields['dough'].addEventListener('change', function() {
            setPricesHTML(fields, response);
        });
        fields['size'].addEventListener('change', function() {
            setPricesHTML(fields, response);
        });
        fields['supps'].addEventListener('change', function() {
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
    request('http://localhost/Projet%20PHP/test3/Controlers/orderlinedatajson1.php?id='+selectedPizzaId, function(httpRequest) {
        let response = JSON.parse(httpRequest.responseText);
        for (let ingredient of response) {
            let newOpt = document.createElement('option');
            newOpt.value = ingredient['id'];
            newOpt.innerHTML = ingredient['name'] + ' (+' + ingredient['price'] + '€)';
            suppSelect.appendChild(newOpt);
        }
    });
}

function computePrice(fields, datas) {
    let p, s, d;
    let selectedPizzaId = fields['pizza'].options[fields['pizza'].selectedIndex].value;
    let selectedSizeId = fields['size'].options[fields['size'].selectedIndex].value;
    let selectedDoughId = fields['dough'].options[fields['dough'].selectedIndex].value;
    let selectedSuppIds = getSelectedValues(fields['supps']);

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
    return parseFloat(p['totalPrice']) + parseFloat(s['price']) + parseFloat(d['price']) + sps;
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
  
    for (var i=0, iLen=options.length; i<iLen; i++) {
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
    let httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = function () {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            const status = httpRequest.status;
            if (status === 0 || (status >= 200 && status < 400)) {
                let response = JSON.parse(httpRequest.responseText);
                console.log(response);
                let parentContainer = document.getElementById("panierjson");

                while (parentContainer.children.length > 0) {
                    parentContainer.removeChild(parentContainer.children[0])
                }
                for (let i in response) {
                    let container = document.createElement('div');
                    let pizzaName = document.createElement('div');
                    pizzaName.setAttribute('id', 'basket'); //id pour styler le panier
                    pizzaName.innerHTML = response[i]['quantity'] + " x " + response[i]['pizzaId']['name'] + '<br>Suppléments :<br>';
                    for (let k in response[i]['suppIds']) {
                        pizzaName.innerHTML += response[i]['suppIds'][k]['name'] + '<br>';
                    }
                    container.appendChild(pizzaName);
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
                        httpRequest.open('GET', 'http://localhost/Projet%20PHP/test3/Controlers/cancelorderline.php?index='+i, true);
                        httpRequest.send();
                    })
                }
            }
        }
    }
    httpRequest.open('GET', 'http://localhost/Projet%20PHP/test3/Controlers/panierjson.php', true);
    httpRequest.send();
}
