
function ajouterLigne(){
    var table = document.getElementById("tableOrdre");

    var row = table.insertRow(table.rows.length-1);

    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);

    cell1.innerHTML = document.getElementById('text_id1').value;
    cell2.innerHTML = document.getElementById('text_id2').value;

    var button = document.createElement('input');
    button.type = 'button';
    button.id = 'suppId';
    button.value = '';

    button.onclick = function () {
        var rowIndex = this.parentNode.parentNode.rowIndex;
        table.deleteRow(rowIndex);
    };

    cell3.appendChild(button);

    document.getElementById('text_id1').value = '';
    document.getElementById('text_id2').value = '';

};

function supprimer() {
    document.getElementById("tableOrdre").deleteRow(this.rowIndex);
};
