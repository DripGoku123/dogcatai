var act = 0;
var el = document.getElementById("pass");
var el2 = document.getElementById("inp2");
document.getElementById("guzik").addEventListener("click", function() {
    if (act == 0){
        act = 1;
        el.style.display = "flex";
        el2.type = "submit";
    }
    else{
        act = 0;
        el.style.display = "none";
        el2.type = "hidden";

    }
    console.log("klik")
})
