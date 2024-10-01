window.onload = function () {
    console.log("members.js loaded");
}

function toggleMenu(elem) {
    document.querySelectorAll('.modifMenu').forEach(function(menu) {
        menu.style.display = 'none';
    });

    const menu = elem.querySelector('.modifMenu');

    if (menu.style.display === 'none' || menu.style.display === '') {
        menu.style.display = 'block';
    } else {
        menu.style.display = 'none';
    }
}