$(document).ready(inicio)


function inicio() {
    $(".botoncompraPreformas").click(anade)
    $("#carritoPreformas").load("../comprar/listaCompraPreformas.php");
 

}



    function anade() {
        var tipoPreforma = $("#gramaje").val();
        var posicion=tipoPreforma.lastIndexOf('-');
        var idnumero=tipoPreforma.substring(0,posicion);


        var cantidad = $("#cantidad").val();
        var codigo = $("#codigo").val();
        var proveedor = $("#proveedor").val();
        var cajasPreformas = $("#CajasPreformas").val();
        var flete = $("#flete").val();
        console.log(cajasPreformas);
        console.log(flete);
        if (idnumero == "0" || cantidad == "" || codigo == 0 || proveedor == "0") {
            $('#mensaje').addClass('error').html('<i class="fa fa-check" aria-hidden="true"></i> Complete todos los campos').show(150).delay(1500).hide(150);
        } else {
            $("#carritoPreformas").load("../comprar/listaCompraPreformas.php?p=" + idnumero + "&cant=" + cantidad + "&cod=" + codigo + "&pro=" + proveedor + "&cajasPreformas=" + cajasPreformas + "&flete=" + flete);
            $('#mensaje').addClass('error').html('<i class="fa fa-check" aria-hidden="true"></i> Se agrego al carrito correctamente').show(150).delay(1500).hide(150);
            $("#cantidad").val('');
            $("#CajasPreformas").val('');
            $('#gramaje').prop('selectedIndex', 0);
            $('#btncomprar').attr("disabled", false);




        }

    }

 

