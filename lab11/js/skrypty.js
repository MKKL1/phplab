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
//dodaj słuchaczy akcji do pozostałych przycisków w nawigacji
// ...
});

function pokazOnas() {
    fetch("http://localhost/phplab/lab11/skrypty/onas.php")
        .then((response) => {
            if (response.status !== 200) {
                return Promise.reject('Coś poszło nie tak!');
            }
            return response.text();
        })
        .then((data) => {
            document.getElementById('main').innerHTML=data;
        })
        .catch((error) => {
            console.log(error);
        });
}
function pokazGalerie() {
    fetch("http://localhost/phplab/lab11/skrypty/galeria.php")
        .then((response) => {
            if (response.status !== 200) {
                return Promise.reject('Coś poszło nie tak!');
            }
            return response.text();
        })
        .then((data) => {
            document.getElementById('main').innerHTML=data;
        })
        .catch((error) => {
            console.log(error);
        });
}
//dodaj funkcje do obsługi kolejnych akci