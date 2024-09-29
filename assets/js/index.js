
var cpf = document.getElementById("cpf-form");

cpf.addEventListener("input", () => {

var limpar = cpf.value.replace(/\D/g, "").substring(0,14);

var numerosArray = limpar.split("");

var numeroFormatado = "";


if(numerosArray.length > 0){
    alert("a");
    numeroFormatado += `${numerosArray.slice(0,3).join("")}.`;
}

if(numerosArray.length > 2){
    numeroFormatado += ` ${numerosArray.slice(2,7).join("")}`;
}

if(numerosArray.length > 7){
    numeroFormatado += `-${numerosArray.slice(7,11).join("")}`;
}

cpf.value = numeroFormatado; 

});