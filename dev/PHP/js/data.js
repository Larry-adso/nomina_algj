var menuOptions = document.querySelectorAll(".options__menu a");
menuOptions.forEach(function(option) {
    option.addEventListener("mouseenter", open_menu);
    option.addEventListener("mouseleave", close_menu);
});

//Declaramos variables
var side_menu = document.getElementById("menu_side");
var body = document.getElementById("body");

//Evento para mostrar el menú al pasar el cursor sobre una opción
function open_menu() {
    body.classList.add("body_move");
    side_menu.classList.add("menu__side_move");
}

//Evento para ocultar el menú al quitar el cursor de una opción
function close_menu() {
    body.classList.remove("body_move");
    side_menu.classList.remove("menu__side_move");
}

//Si el ancho de la página es menor a 760px, ocultará el menú al recargar la página
if (window.innerWidth < 760) {
    body.classList.add("body_move");
    side_menu.classList.add("menu__side_move");
}

//Haciendo el menú responsive (adaptable)
window.addEventListener("resize", function() {
    if (window.innerWidth > 760) {
        body.classList.remove("body_move");
        side_menu.classList.remove("menu__side_move");
    }
    if (window.innerWidth < 760) {
        body.classList.add("body_move");
        side_menu.classList.add("menu__side_move");
    }
});