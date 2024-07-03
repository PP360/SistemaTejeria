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
    var comprar=confirm("¿Desea Realizar la Compra?");
    if (comprar) 
        return true;
    else
        return false;
}
//funcion para vaciar la compra
function vaciarCarrito(){
    var compra=confirm("¿Desea Vaciar la Lista de Compra?");
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
        patron=/[A-Z a-z áéíóú]/; 
        te=String.fromCharCode(tecla); 
        return patron.test(te); 
    }        


