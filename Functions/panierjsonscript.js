
console.log('test');
document.addEventListener('DOMContentLoaded', (event) => {
    // document.getElementById("btnpanierjson").addEventListener("click", function(e){
    refresh();
    // });
});


function refresh() {
    let httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = function () {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            const status = httpRequest.status;
            if (status === 0 || (status >= 200 && status < 400)) {
                let response = JSON.parse(httpRequest.responseText);
                let parentContainer = document.getElementById("panierjson");

                while (parentContainer.children.length > 0) {
                    parentContainer.removeChild(parentContainer.children[0])
                }
                for (let i in response) {
                    let container = document.createElement('div');
                    let pizzaName = document.createElement('div');
                    pizzaName.setAttribute('id', 'basket'); //id pour styler le panier
                    pizzaName.innerHTML = "Pizza : " + response[i]['qty'] + " " + response[i]['pizza']['name'] + '<br>Suppléments : ';
                    for (let k in response[i]['supp']) {
                        pizzaName.innerHTML += response[i]['supp'][k]['name'] + '<br>';
                    }
                    container.appendChild(pizzaName);
                    parentContainer.appendChild(container);
                    let btnCancelOrderline = document.createElement('button');
                    btnCancelOrderline.setAttribute('class', 'deletebtn'); //class pour styler le button delete
                    btnCancelOrderline.innerHTML = 'Annuler'
                    btnCancelOrderline.setAttribute('orderlineindex', i);
                    parentContainer.appendChild(btnCancelOrderline);

                    btnCancelOrderline.addEventListener("click", function (c) {
                        let httpRequest = new XMLHttpRequest();
                        httpRequest.onreadystatechange = function () {
                            if (httpRequest.readyState === XMLHttpRequest.DONE) {
                                const status = httpRequest.status;
                                if (status === 0 || (status >= 200 && status < 400)) {
                                    refresh();
                                }
                            }
                        }
                        httpRequest.open('GET', 'http://localhost/Projet%20PHP/test1/Controlers/cancelorderline.php?index=' + i, true);
                        httpRequest.send();
                    })
                }
            }
        }
    }
    httpRequest.open('GET', 'http://localhost/Projet%20PHP/test1/Controlers/panierjson.php', true);
    httpRequest.send();
}




