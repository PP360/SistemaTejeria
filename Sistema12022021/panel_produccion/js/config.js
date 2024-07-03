$(function(){
	
	$('#ingresar').on('click',function(){
		var usu = $('#usu').val();
		var pass = $('#pass').val();
		var area = $('#area').val();
		var url = 'procesar_login.php';
		var total = usu.length * pass.length * area.length;
		if (total>0){
			$.ajax({
				type: 'POST',
				url: url,
				data: 'usu='+usu+'&pass='+pass+'&area='+area,
				success: function(valor){
					if(valor == 'usuario'){
						$('#mensaje').addClass('error').html('El nombre de usuario ingresado no existe').show(300).delay(3000).hide(300);
						$('#usu').focus();
						return false;
					}else if(valor == 'area'){
						$('#mensaje').addClass('error').html('Usted no pertenece al área seleccionada').show(300).delay(3000).hide(300);
						$('#area').focus();
						return false;
					}else if(valor == 'password'){
						$('#mensaje').addClass('error').html('Su contraseña es incorrecta').show(300).delay(3000).hide(300);
						$('#pass').focus();
						return false;
					}else if(valor == '1'){
						document.location.href = 'panel_administracion/principal.php'; 
					}else if(valor == '2'){
						document.location.href = 'panel_bodega/principal.php';
					}
				}
			});
			return false;
		}else{
			if(usu.length<=0)
                {
			$('#mensaje').addClass('error').html('Ingrese el nombre de usuario ').show(300).delay(3000).hide(300);
            $('#usu').focus();
                }
            else if(pass.length<=0)
                {
			$('#mensaje').addClass('error').html('Ingrese la contraseña ').show(300).delay(3000).hide(300);
            $('#pass').focus();
                }
            		}
	});
    // lista de Paises	
            $('#entrega').change(function()
                                 {
                var entreg = $(this).val();

                // Lista de Paises
                $.post( 'entrega.php', { entregas: entreg} ).done( function( respuesta )
                                                                  {
                    $( '#cantidad' ).html( respuesta );
                });
            });

});