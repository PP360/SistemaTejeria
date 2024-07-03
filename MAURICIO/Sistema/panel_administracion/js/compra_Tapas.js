$(document).ready(inicio)

function inicio() {
    $(".botoncompraTapas").click(anade)
    $("#carritoTapas").load("../comprar/listaCompraTapas.php");



}


function anade() {
    var tipoTapa = $("#tamano").val();
    var posicion=tipoTapa.lastIndexOf('-');
                
                var idnumero=tipoTapa.substring(0,posicion);



    var cantidad = $("#cantidad").val();
    var cajas = $("#cantidadCajas").val();
    var flete = $("#flete").val();
    console.log(flete);
    debugger;
    var codigo = $("#codigo").val();
    var proveedor = $("#proveedor").val();
    if (idnumero == "0" || cantidad == "" || proveedor == "0" || cajas == "") {
        $('#mensajeTapas').addClass('error').html('<i class="fa fa-check" aria-hidden="true"></i>Complete todos los campos').show(150).delay(1500).hide(150);
    } else {
        $("#carritoTapas").load("../comprar/listaCompraTapas.php?p=" + idnumero + "&cant=" + cantidad + "&cajas=" + cajas + "&cod=" + codigo + "&pro=" + proveedor + "&flete=" + flete, function () {
            $('#mensajeTapas').addClass('error').html('<i class="fa fa-check" aria-hidden="true"></i> Se agrego al carrito correctamente').show(150).delay(1500).hide(150);
            $("#cantidad").val('');
            $("#cantidadCajas").prop('selectedIndex', 0);
            $('#tamano').prop('selectedIndex', 0);
            $('#cantidadCajas').val('');
            $('#btncomprar').attr("disabled", false);

        });



    }

}
