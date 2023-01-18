function Many2ManyTable(columns, parentId, insertFunc, readAllRel, readAllNotRel, deleteFunc) {
    this.tableElement = document.createElement('table');
    this.theadElement = document.createElement('thead');
    this.tbodyElement = document.createElement('tbody');
    this.columns = columns;
    this.insertFunc = insertFunc;
    this.readAllRel = readAllRel;
    this.deleteFunc = deleteFunc;
    this.readAllNotRel = readAllNotRel;
    this.parentId = parentId;

    for (let column of columns) {
        let newTh = document.createElement('th');
        newTh.innerHTML = column.displayName;
        this.theadElement.appendChild(newTh);
    }

    this.rows = [];
    this.setInsertRow();
    this.queryAndSetDatas();

    this.tableElement.appendChild(this.theadElement);
    this.tableElement.appendChild(this.tbodyElement);
}

Many2ManyTable.prototype.setDeleteButtons = // A priori ok
    function () {
        for (let row of this.rows) {
            let newTd = document.createElement('td');
            let delButton = document.createElement('button');
            delButton.innerHTML = 'Supprimer';
            delButton.addEventListener('click', function() {
                this.deleteFunc(row.datas['PizzaIngredientId'], function(r) {
                    this.queryAndSetDatas();
                    this.adaptSelectContent();
                }.bind(this));
            }.bind(this))
            newTd.appendChild(delButton);
            row.elt.appendChild(newTd);
        }
    }

Many2ManyTable.prototype.adaptSelectContent =
    function () {
        while (this.updateField.children.length > 0)
            this.updateField.remove(this.updateField.lastChild);
        this.readAllNotRel(this.parentId, function(datas) {
            for (let data of datas) {
                let newOpt = document.createElement('option');
                newOpt.value = data['id'];
                newOpt.innerHTML = data['name'];
                this.updateField.appendChild(newOpt);
            }
            this.queryAndSetDatas();
        }.bind(this))
    }

Many2ManyTable.prototype.setInsertRow = // Doit etre adapte a un Many2Many
    function () {
        let newTr = document.createElement('tr');
        let fields = {}
        for (let column of this.columns) {
            let newTd = document.createElement('td');
            if (column.custom) {
                let newField;
                switch(column.type) {
                    case 'select':
                        newField = document.createElement('select');
                        this.updateField = newField;
                        this.adaptSelectContent();
                        fields[column.name] = newField;
                        break;
                }
                if (newField && newField.nodeType === 1)
                    newTd.appendChild(newField);
            }
            newTr.appendChild(newTd);
        }
        let newTd = document.createElement('td');
        let newButton = document.createElement('button');
        newButton.innerHTML = 'Ajouter';
        newButton.addEventListener('click', function() {
            let args = {
                pizzaId:this.parentId,
                ingredientId:fields['name'].value
            };
            this.insertFunc(args, function() {
                this.queryAndSetDatas();
                this.adaptSelectContent();
            }.bind(this))
        }.bind(this));
        newTd.appendChild(newButton);
        newTr.appendChild(newTd);
        this.tbodyElement.appendChild(newTr);
    }

Many2ManyTable.prototype.clear = // OK
    function () {
        for (let row of this.rows) {
            row.elt.remove();
        }
        this.rows = [];
    }

Many2ManyTable.prototype.queryAndSetDatas = // OK
    function () {
        this.readAllRel(this.parentId, function(datas) {
            this.setDatas(datas);
        }.bind(this))
    }

Many2ManyTable.prototype.setDatas =
    function (datas) {
        this.clear();
        for (let data of datas) {
            let newTr = document.createElement('tr');
            let fields = {};
            for (let column of this.columns) {
                let newTd = document.createElement('td');
                fields[column.name] = newTd;
                if (column.type == 'many2many') {
                    //let m2mField = new Table(column.fields, 'many2many', column.);
                    //m2mField.setDatas(data[column.name]);
                    //newTd.appendChild(m2mField.tableElement);
                }
                else {
                    if (column.custom) {
                        newTd.setAttribute('class', 'customizable');
                    }
                    newTd.innerHTML = data[column.name];
                }
                newTr.appendChild(newTd);
            }
            this.rows.push({elt:newTr, datas:data, fields:fields});
            this.tbodyElement.appendChild(newTr);
        }
        this.datas = datas;
        this.setDeleteButtons();
    }