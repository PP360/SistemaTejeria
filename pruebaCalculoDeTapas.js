 <script>
        //loader pagina
        $(window).load(function() {
            $(".loader").fadeOut("slow");
        });
        $(document).ready(function() {
            $('#example').DataTable({
                "order": [
                    [1, "desc"]
                ],
                scrollY: '50vh',
                scrollCollapse: true,
                paging: true,
                scrollX: true
            });
        });

        $(document).ready(function() {
            $("#cantidadCajas").change(function(event) {

                calcularTapas();
        
				var tipotapa=$("#tamano").find(':selected').val();
                if (id == "Seleccione una opción") {
                    document.cantidad.value = 0;
                }

               
            });


        });

        function calcularTapas() {
          
			
			var cajas=ParseInt(document.getElementById("cantidadCajas").value);
			var tipoTapa=document.getElementById("tamano").value;
			var totalTapasCompradas=0;
			if (cajas=="Tapa Rosca #26 mm")
			{
			totalTapasCompradas=8000/cajas;
				
			}
			else if (cajas=="Tapa Rosca #28 mm")
			{
				totalTapasCompradas=4500/cajas;
				
			}
			else
			{
				$('#mensaje').addClass('error').html('<i class="fa fa-check" aria-hidden="true"></i> Tipo de botella no especificada ').show(150).delay(3800).hide(150);
			}

    
            document.calcularTapas.cantidad.value = totalTapasCompradas;


        }

    </script>