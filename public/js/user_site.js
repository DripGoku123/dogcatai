var i = document.getElementById('i');
var powiad = document.getElementById('powiad');


document.getElementById("kom").addEventListener("click", function() {
    i.innerHTML = "<p class='main'>Komunikator</p>" + "<p class='main2'>" + powiad.value + "</p><button class='bor' type='submit' name='kierunek' value='kom'>Przekierować?</button>";
    console.write("www")
})

document.getElementById("ai").addEventListener("click", function() {
    i.innerHTML = "<p class='main'>Sztuczna inteligencja</p><p class='main2'>Czy to zwierzę to kot czy pies?</p><button class='bor' type='submit' name='kierunek' value='ai'>Przekierować?</button>";
    console.write("www")
})

document.getElementById("zad").addEventListener("click", function() {
    i.innerHTML = "<p class='main'>Zadania</p><p class='main2'>Chcesz zaplanować sobie dzień?</p><p class='main2'>Tu możesz to zrobić w łatwy sposób..</p><button class='bor' type='submit' name='kierunek' value='zad'>Przekierować?</button>";
    console.write("www")
})

