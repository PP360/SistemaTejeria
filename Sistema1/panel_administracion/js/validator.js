//funcion para pregunta al eliminar
function eliminar(){
    var eliminar=confirm("¿Desea eliminar el registro?");
    if (eliminar) 
        return true;
    else
        return false;
}
//funcion para realizar la compra
function comprar(){
    var comprar=confirm("¿Desea realizar la compra?");
    if (comprar) 
        return true;
    else
        return false;
}
//funcion para vaciar la compra
function vaciarCarrito(){
    var compra=confirm("¿Desea vaciar la lista de compra?");
    if (compra) 
        return true;
    else
        return false;
}

//Funcion para validar solo numeros
function numeros() {
 if ((event.keyCode < 48) || (event.keyCode > 57)) 
  event.returnValue = false;
}
// Funcion para validar solo texto y letras
function letras() {
 if ((event.keyCode != 32) && (event.keyCode < 65) || (event.keyCode > 90) && (event.keyCode < 97) || (event.keyCode > 122))
  event.returnValue = false;
}

function onKeyDecimal(e,thix) {
        var keynum = window.event ? window.event.keyCode : e.which;
        if (document.getElementById(thix.id).value.indexOf('.') != -1 && keynum == 46)
            return false;
        if ((keynum == 8 || keynum == 48 || keynum == 46))
            return true;
        if (keynum <= 47 || keynum >= 58) return false;
        return /\d/.test(String.fromCharCode(keynum));
    }
function validar_letras(e) 
    { 
        tecla=(document.all)?e.keyCode:e.which; 
        patron=/[A-Z a-z áéíóú . ()# $ % / " ']/; 
        te=String.fromCharCode(tecla); 
        return patron.test(te); 
    } 


function sololetras(e){

    key=e.keyCode || e.which;

    teclado=String.fromCharCode(key);

    numeros="0123456789.A-Za-záéíóú";

    especiales="8-37-39-46";

    tecla_especial=false;

    for(var i in especiales){
        if(key==especiales[i]){
            tecla_especial=true;
        }
    }

    if(numeros.indexOf(teclado)==-1 && !tecla_especial){
        return false;
    }

}


