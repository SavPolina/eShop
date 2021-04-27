let burger = document.querySelector('.burger');

burger.addEventListener('click', function (e) {
    let menu = document.querySelector('.burger-menu');
    menu.classList.toggle("burger-menu-show");
});

let burgerClose = document.querySelector('.burger-close');

burgerClose.addEventListener('click', function (e) {
    let menu = document.querySelector('.burger-menu');
    menu.classList.remove("burger-menu-show");
});


