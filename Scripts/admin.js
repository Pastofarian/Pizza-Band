document.addEventListener('DOMContentLoaded', (event) => {

    refreshPizzaHeader();
    refreshPizzaTable();
    refreshIngreTable();
    refreshSizeTable();
    refreshDoughTable();

});

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

function refreshPizzaHeader()
{
    let thead = document.querySelector("#pizza_header");
    request("http://localhost/Projet%20PHP/test3/Controlers/js_ctrl_listColumns.php?name=pizza", function(httpRequest){
        let response = httpRequest.responseText;
        if(response == 'NULL') return; 
        let columns = JSON.parse(response);
        console.log(columns);

        let newTr = document.createElement("tr");
        for (let column of columns)
        {
            let newTh = document.createElement("th");
            newTh.innerHTML = column['Field'];
            newTr.appendChild(newTh);
        }
        thead.appendChild(newTr);
    })
}

function refreshIngreHeader()
{

}

function refreshSizeHeader()
{
    
}

function refreshDoughHeader()
{
    
}


function refreshPizzaTable()
{
    let root = document.querySelector("#pizza_admin table");
    let thead = document.querySelector("#pizza_header");
    let tbody = document.querySelector("#pizza_body");

    request("http://localhost/Projet%20PHP/test3/Controlers/js_ctrl_listpizza.php", function(httpRequest){
        let response = httpRequest.responseText;
        if(response == 'NULL') return; 
        let pizzas = JSON.parse(response);
        for(let pizza of pizzas)
        {
            let newTr = document.createElement("tr");
            for (let key in pizza)
            {
                let newTd = document.createElement("td");
                newTd.innerHTML = pizza[key];
                newTr.appendChild(newTd);
            }
            tbody.appendChild(newTr);
        }
        let newTr = document.createElement("tr");
        for (let key in pizzas[0])
        {
            let newTd = document.createElement("td");
            if(key != "id")
            {
                let newInput = document.createElement("input");
                newInput.setAttribute("type", "text");
                newTd.appendChild(newInput);
            }
            newTr.appendChild(newTd);
        }
        tbody.appendChild(newTr);
    })
}


function refreshIngreTable()
{
    let thead = document.querySelector("#ingre_header");
    let tbody = document.querySelector("#ingre_body");

    request("http://localhost/Projet%20PHP/test3/Controlers/js_ctrl_listingre.php", function(httpRequest){
        let response = httpRequest.responseText;
        if(response == 'NULL') return; 
        let ingredients = JSON.parse(response);
        for(let ingredient of ingredients)
        {
            let newTr = document.createElement("tr");
            for (let key in ingredient)
            {
                let newTd = document.createElement("td");
                newTd.innerHTML = ingredient[key];
                newTr.appendChild(newTd);
            }
            tbody.appendChild(newTr);
        }
    })
}

function refreshSizeTable()
{
    let thead = document.querySelector("#size_header");
    let tbody = document.querySelector("#size_body");

    request("http://localhost/Projet%20PHP/test3/Controlers/js_ctrl_listsize.php", function(httpRequest){
        let response = httpRequest.responseText;
        if(response == 'NULL') return; 
        let sizes = JSON.parse(response);
        for(let size of sizes)
        {
            let newTr = document.createElement("tr");
            for (let key in size)
            {
                let newTd = document.createElement("td");
                newTd.innerHTML = size[key];
                newTr.appendChild(newTd);
            }
            tbody.appendChild(newTr);
        }
    })
}

function refreshDoughTable()
{
    let thead = document.querySelector("#dough_header");
    let tbody = document.querySelector("#dough_body");

    request("http://localhost/Projet%20PHP/test3/Controlers/js_ctrl_listdough.php", function(httpRequest){
        let response = httpRequest.responseText;
        if(response == 'NULL') return; 
        let doughs = JSON.parse(response);
        for(let dough of doughs)
        {
            let newTr = document.createElement("tr");
            for (let key in dough)
            {
                let newTd = document.createElement("td");
                newTd.innerHTML = dough[key];
                newTr.appendChild(newTd);
            }
            tbody.appendChild(newTr);
        }
    })
}
