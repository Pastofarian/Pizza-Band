function Table(columns, insertFunc, readFunc, updateFunc, deleteFunc, readAll) {
    this.tableElement = document.createElement('table');
    this.theadElement = document.createElement('thead');
    this.tbodyElement = document.createElement('tbody');
    this.columns = columns;
    this.insertFunc = insertFunc;
    this.readFunc = readFunc;
    this.updateFunc = updateFunc;
    this.deleteFunc = deleteFunc;
    this.readAll = readAll;

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

Table.prototype.setDeleteAndUpdateButtons =
    function () {
        for (let row of this.rows) {
            let delTd = document.createElement('td');
            let updateTd = document.createElement('td');
            let delButton = document.createElement('button');
            let updateButton = document.createElement('button');
            delButton.innerHTML = 'Supprimer';
            updateButton.innerHTML = 'Modifier';
            updateButton.addEventListener('click', function() {
                let fields = {}
                for (let column of this.columns) {
                    if (column.custom) {
                        let parent = row.fields[column.name];
                        while (parent.children.length > 0)
                            parent.removeChild(parent.firstChild);
                        parent.innerHTML = '';
                        let newField = document.createElement('input');
                        newField.value = row.datas[column.name];
                        fields[column.name] = newField;
                        parent.appendChild(newField);
                    }
                }
                updateButton.innerHTML = 'Envoyer';
                updateButton.addEventListener('click', function() {
                    let args = {};
                    for (let key in fields) {
                        args[key] = fields[key].value;
                    }
                    this.updateFunc(row.datas['id'], args, function() { // changer ici pour gerer un {} fields['name'].value, fields['price'].value
                        this.queryAndSetDatas();
                    }.bind(this))
                }.bind(this))
            }.bind(this), {once:true})
            delButton.addEventListener('click', function() {
                this.deleteFunc(row.datas['id'], function(r) {
                    this.queryAndSetDatas();
                }.bind(this))
            }.bind(this))
            updateTd.appendChild(updateButton);
            delTd.appendChild(delButton);
            row.elt.appendChild(updateTd);
            row.elt.appendChild(delTd);
        }
    }

Table.prototype.setInsertRow =
    function () {
        let newTr = document.createElement('tr');
        let fields = {}
        for (let column of this.columns) {
            let newTd = document.createElement('td');
            if (column.custom) {
                let newField;
                switch(column.type) {
                    case 'text':
                        newField = document.createElement('input');
                        newField.type = 'text';
                        fields[column.name] = newField;
                        break;
                    case 'number':
                        newField = document.createElement('input');
                        newField.type = 'number';
                        fields[column.name] = newField;
                        break;
                    case 'bool':
                        newField = document.createElement('input');
                        newField.type = 'checkbox';
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
        newButton.innerHTML = 'Creer';
        newButton.addEventListener('click', function() {
            let args = {};
            for (let column of this.columns) {
                if (column.custom) {
                    switch (column.type) {
                        case 'text':
                        case 'number':
                            args[column.name] = fields[column.name].value;
                            break;
                        case 'bool':
                            args[column.name] = (fields[column.name].checked == true)?1:0;
                            break;
                    }
                }
            }
            for (let key in fields) {
                fields[key].value = '';
            }
            console.log(args);
            this.insertFunc(args, function() { // Changer ici pour gerer un objet {}
                this.queryAndSetDatas();
            }.bind(this))
        }.bind(this));
        newTd.appendChild(newButton);
        newTr.appendChild(newTd);
        this.tbodyElement.appendChild(newTr);
    }

Table.prototype.clear =
    function () {
        for (let row of this.rows) {
            row.elt.remove();
        }
        this.rows = [];
    }

Table.prototype.queryAndSetDatas =
    function () {
        this.readAll(function(datas) {
            this.setDatas(datas);
        }.bind(this))
    }

Table.prototype.setDatas =
    function (datas) {
        this.clear();
        for (let data of datas) {
            let newTr = document.createElement('tr');
            let fields = {};
            for (let column of this.columns) {
                let newTd = document.createElement('td');
                fields[column.name] = newTd;
                switch(column.type) {
                    case 'many2many':
                        let m2mField = new Many2ManyTable(column.fields, data['id'], column.functions.insertFunc, column.functions.readAllRel, column.functions.readAllNotRel, column.functions.deleteFunc);
                        newTd.appendChild(m2mField.tableElement);
                        break;
                    case 'bool':
                        let newCb = document.createElement('input');
                        newCb.type = 'checkbox';
                        newCb.checked = (data[column.name] == 0) ? false : true;
                        newCb.setAttribute('disabled', 'disabled');
                        newTd.appendChild(newCb);
                        break;
                    default:
                        newTd.innerHTML = data[column.name];
                        break;
                }
                if (column.custom) {
                    newTd.setAttribute('class', 'customizable');
                }
                newTr.appendChild(newTd);
            }
            this.rows.push({elt:newTr, datas:data, fields:fields});
            this.tbodyElement.appendChild(newTr);
        }
        this.datas = datas;
        this.setDeleteAndUpdateButtons();
    }