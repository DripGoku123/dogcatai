var act = 0;
var act2 = 0;
var form1 = document.getElementById("form1");
var but = document.getElementById("but");
var but2 = document.getElementById("but2");
var k = document.getElementById("k");

function func(){
  if (act == 0){
    but.classList.add("act");
    act = 1;
    act2 = 1;
    but2.classList.add("act");
    k.value = "Zarejestruj się";
  }
  else{
    but2.classList.remove("act");
    act2 = 0;
    but.classList.remove("act");
    act = 0;
    k.value = "Zaloguj się";
  }
}

function func2(){
  if (act2 == 0){
    but.classList.add("act");
    act = 1;
    but2.classList.add("act");
    act2 = 1;
    k.value = "Zarejestruj się";
  }
  else{
    but2.classList.remove("act");
    act2 = 0;
    act = 1
    but.classList.remove("act");
    k.value = "Zaloguj się";
  }
}
