//Grafica compra tapas
//$('.nav-tabs a[href="#references"]').tab('show')

    $(document).ready(mostrarResultadosTapas(2017)); 



    function mostrarResultadosTapas(añoTapas){
        $.ajax({
            type:'POST',
            url:'comprar/procesarGraficaTapas.php',
            data:'añoTapas='+añoTapas,
            success:function(data){

                var valoresTapas = eval(data);

                var e   = valoresTapas[0];
                var f   = valoresTapas[1];
                var m   = valoresTapas[2];
                var a   = valoresTapas[3];
                var ma  = valoresTapas[4];
                var j   = valoresTapas[5];
                var jl  = valoresTapas[6];
                var ag  = valoresTapas[7];
                var s   = valoresTapas[8];
                var o   = valoresTapas[9];
                var n   = valoresTapas[10];
                var d   = valoresTapas[11];

                var Datos = {
                    labels : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    datasets : [
                        {
                            fillColor : "#85ce36",
                        strokeColor : "#85ce36",
                        pointColor : "#85ce36",
                        pointStrokeColor : "#85ce36",
                        pointHighlightFill : "#fff",
                        pointHighlightStroke : "rgba(220,220,220,1)",
                            data : [e, f, m, a, ma, j, jl, ag, s, o, n, d]
                        }
                    ]
                }

                var contexto = $('#graficoTapas').get(0).getContext('2d');
                var myLineChart2 = new Chart(contexto).Bar(Datos, { responsive : true });
               // $('#resin').on('shown.bs.tab', function (e) {
                   // alert("resina");

                    //var myLineChart2 = new Chart(contexto).Bar(Datos, { responsive : true });
                //});
            }
        });
        return false;
    }







