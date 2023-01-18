document.addEventListener('DOMContentLoaded', (event) => {
    let pizzaTable = new Table([
        {name:'id', displayName:'ID'},
        {name:'name', displayName:'Nom', custom:true, type:'text'},
        {name:'price', displayName:'Prix', custom:true, type:'number'},
        {name:'totalPrice', displayName:'Total Price'},
        {name:'ingredients', displayName:'Ingredients', type:'many2many', 
            fields:[
                {name:'id', displayName:'ID'},
                {name:'name', displayName:'Nom', custom:true, type:'select'},
                {name:'price', displayName:'Prix'},
            ],
            functions:{
                insertFunc:insertPizzaIngredient,
                readAllRel:readIngredientsByPizzaId,
                readAllNotRel:readAvailableIngredientsByPizzaId,
                deleteFunc:deletePizzaIngredientById
            },
        }
    ], insertPizza, readPizzaById, updatePizzaById, deletePizzaById, readPizzas);
    document.querySelector("#pizzas").appendChild(pizzaTable.tableElement);
    let ingredientTable = new Table([
        {name:'id', displayName:'ID'},
        {name:'name', displayName:'Nom', custom:true, type:'text'},
        {name:'price', displayName:'Prix', custom:true, type:'number'},
        {name:'isVege', displayName:'Vegetarien', custom:true, type:'bool'},
        {name:'isGlutenFree', displayName:'Sans gluten', custom:true, type:'bool'}
    ], insertIngredient, readIngredientById, updateIngredientById, deleteIngredientById, readIngredients);
    document.querySelector("#ingredients").appendChild(ingredientTable.tableElement);
});

function request(url, onsuccess) {
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

// Pizza CRUD

function insertPizza(fields, onSuccess) {
    request(`${path}/controlers/js_ctrl_insertPizza.php?name=${fields.name}&price=${fields.price}`, function(httpRequest) {
        let response;
        try {
            response = JSON.parse(httpRequest.responseText);
            onSuccess(response);
        } catch (e) {
            console.log(e)
        }
    })
}

function deletePizzaById(id, onSuccess) {
    request(`${path}/controlers/js_ctrl_deletePizzaById.php?id=${id}`, function(httpRequest) {
        let response;
        try {
            response = JSON.parse(httpRequest.responseText);
            onSuccess(response);
        } catch (e) {
            console.log(e)
        }
    })
}

function updatePizzaById(id, fields, onSuccess) {
    request(`${path}/controlers/js_ctrl_updatePizzaById.php?id=${id}&name=${fields.name}&price=${fields.price}`, function(httpRequest) {
        let response;
        try {
            response = JSON.parse(httpRequest.responseText);
            onSuccess(response);
        } catch (e) {
            console.log(e)
        }
    })
}

function readPizzaById(id, onSuccess) {
    request(`${path}/controlers/js_ctrl_readPizzaById.php?id=${id}`, function(httpRequest) {
        let response;
        try {
            response = JSON.parse(httpRequest.responseText);
            onSuccess(response);
        } catch (e) {
            console.log(e)
        }
    })
}

function readPizzas(onSuccess) {
    request(`${path}/controlers/js_ctrl_readPizzas.php`, function(httpRequest) {
        let response;
        try {
            response = JSON.parse(httpRequest.responseText);
            onSuccess(response);
        } catch (e) {
            console.log(e)
        }
    })
}

// Pizza_Ingredient CRD NO U =======================================================
/*
    Necessaire pour effectuer l'ajout d'ingredient
*/
function insertPizzaIngredient(fields, onSuccess) {
    request(`${path}/controlers/js_ctrl_insertPizzaIngredient.php?pizzaId=${fields.pizzaId}&ingredientId=${fields.ingredientId}`, function(httpRequest) {
        let response;
        try {
            response = JSON.parse(httpRequest.responseText);
            onSuccess(response);
        } catch (e) {
            console.log(e)
        }
    })
}

/*
    Necessaire pour effectuer le retrait d'ingredient
*/
function deletePizzaIngredientById(id, onSuccess) {
    console.log(id)
    request(`${path}/controlers/js_ctrl_deletePizzaIngredientById.php?id=${id}`, function(httpRequest) {
        let response;
        try {
            //response = JSON.parse(httpRequest.responseText);
            onSuccess(/*response*/);
        } catch (e) {
            console.log(e)
        }
    })
}

/*
    Necessaire pour remplir la listbox d'ajout
*/
function readAvailableIngredientsByPizzaId(id, onSuccess) {
    request(`${path}/controlers/js_ctrl_readAvailableIngredientsByPizzaId.php?id=${id}`, function(httpRequest) {
        let response;
        try {
            response = JSON.parse(httpRequest.responseText);
            onSuccess(response);
        } catch (e) {
            console.log(e)
        }
    })
}

/*
    Necessaire pour remplir le tableau
*/
function readIngredientsByPizzaId(id, onSuccess) {
    request(`${path}/controlers/js_ctrl_readIngredientsByPizzaId.php?id=${id}`, function(httpRequest) {
        let response;
        try {
            response = JSON.parse(httpRequest.responseText);
            onSuccess(response);
        } catch (e) {
            console.log(e)
        }
    })
}

/* ======================= INGREDIENTS ======================== */

function insertIngredient(fields, onSuccess) { // OK
    request(`${path}/controlers/js_ctrl_insertIngredient.php?name=${fields.name}&price=${fields.price}&isvege=${fields.isVege}&isglutenfree=${fields.isGlutenFree}`, function(httpRequest) {
        let response;
        try {
            response = JSON.parse(httpRequest.responseText);
            onSuccess(response);
        } catch (e) {
            console.log(e)
        }
    })
}

function deleteIngredientById(id, onSuccess) { // NOT OK
    request(`${path}/controlers/js_ctrl_deleteIngredientById.php?id=${id}`, function(httpRequest) {
        let response;
        try {
            response = JSON.parse(httpRequest.responseText);
            onSuccess(response);
        } catch (e) {
            console.log(e)
        }
    })
}

function updateIngredientById(id, fields, onSuccess) { // OK
    request(`${path}/controlers/js_ctrl_updateIngredientById.php?id=${id}&name=${fields.name}&price=${fields.price}&isvege=${fields.isVege}&isglutenfree=${fields.isGlutenFree}`, function(httpRequest) {
        let response;
        try {
            response = JSON.parse(httpRequest.responseText);
            onSuccess(response);
        } catch (e) {
            console.log(e)
        }
    })
}

function readIngredientById(id, onSuccess) { // NOT OK
    request(`${path}/controlers/js_ctrl_readIngredientById.php?id=${id}`, function(httpRequest) {
        let response;
        try {
            response = JSON.parse(httpRequest.responseText);
            onSuccess(response);
        } catch (e) {
            console.log(e)
        }
    })
}

function readIngredients(onSuccess) { // OK
    request(`${path}/controlers/js_ctrl_readIngredients.php`, function(httpRequest) {
        let response;
        try {
            response = JSON.parse(httpRequest.responseText);
            onSuccess(response);
        } catch (e) {
            console.log(e)
        }
    })
}
