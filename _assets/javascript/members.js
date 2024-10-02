window.onload = function () {
    console.log("members.js loaded");
}

function openModal(id) {
    document.getElementById('modifMenu-' + id).style.display = 'flex';
}

function closeModal(id) {
    document.getElementById('modifMenu-' + id).style.display = 'none';
}