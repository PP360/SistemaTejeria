$(document).ready(inicio)

function inicio() {
    $(".botoncompraTapas").click(anade)
    $("#carritoTapas").load("../comprar/listaCompraTapas.php");



}

function anade() {
    var idnumero = $("#tamano").val();
    var cantidad = $("#cantidad").val();
    var cajas = $("#cantidadCajas").val();
    //debugger;
    var codigo = $("#codigo").val();
    var proveedor = $("#proveedor").val();
    if (idnumero == "0" || cantidad == "" || proveedor == "0") {
        $('#mensajeTapas').addClass('error').html('<i class="fa fa-check" aria-hidden="true"></i>Complete todos los campos').show(150).delay(1500).hide(150);
    } else {
        $("#carritoTapas").load("../comprar/listaCompraTapas.php?p=" + idnumero + "&cant=" + cantidad + "&cajas=" + cajas + "&cod=" + codigo + "&pro=" + proveedor, function () {
            $('#mensajeTapas').addClass('error').html('<i class="fa fa-check" aria-hidden="true"></i> Se agrego al carrito correctamente').show(150).delay(1500).hide(150);
            $("#cantidad").val('');
            $("#cantidadCajas").prop('selectedIndex', 0);
            $('#tamano').prop('selectedIndex', 0);
            $('#btncomprar').attr("disabled", false);
        });



    }

}
