window.onload = function(){
    const sidenav = document.getElementById("mySidenav");
    const openBtn = document.getElementById("openBtn");
    const closeBtn = document.getElementById("closeBtn");

    function openNav() {
        console.log('Salut !')
        sidenav.classList.add("active");
    }

    function closeNav() {
        sidenav.classList.remove("active");
    }

    openBtn.onclick = openNav;
    closeBtn.onclick = closeNav;
};