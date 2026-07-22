const toggleBtn = document.getElementById('toggleBtn');
const sidebar = document.getElementById('sidebar');
toggleBtn.addEventListener('click', function () {
    if (sidebar.classList.contains('me_closed')) {
        sidebar.classList.remove('me_closed');
    } else {
        sidebar.classList.add('me_closed');
    }
});


// active

const menus = sidebar.querySelectorAll('li a');

let curenPage = window.location.href;

menus.forEach(menu => {
    if (menu.href === curenPage) {
        menu.classList.add('active');
    }
});
