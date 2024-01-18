document.addEventListener('DOMContentLoaded', () => {
    var bonas = document.getElementById('onas');
    bonas.addEventListener("click", () => {
        console.log("Strona O nas");
        pokazOnas();
    });

    var bgaleria = document.getElementById('galeria');
    bgaleria.addEventListener("click", () => {
        console.log("Galeria zdjęć");
        pokazGalerie();
    });

    var bform = document.getElementById('formularz');
    bform.addEventListener('click', () => {
        console.log("Formularz");
        pokazFormularz();
    });
//dodaj słuchaczy akcji do pozostałych przycisków w nawigacji
// ...
});

function pokazOnas() {
    $.ajax({
        url: "http://localhost/phplab/lab11/skrypty/onas.php",
        method: "get",
    })
    .done(res => {
        document.getElementById('main').innerHTML=res;
    });
}
function pokazGalerie() {
    $.ajax({
        url: "http://localhost/phplab/lab11/skrypty/galeria.php",
        method: "get",
    })
    .done(res => {
        document.getElementById('main').innerHTML=res;
    });
}

function pokazFormularz() {
    $.ajax({
        url: "http://localhost/phplab/lab11/skrypty/formularz.php",
        method: "get",
    })
        .done(res => {
            document.getElementById('main').innerHTML=res;
        });
}
//dodaj funkcje do obsługi kolejnych akci