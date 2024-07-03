//Grafica compra preformas
$(document).ready(mostrarResultados(2016));  
function mostrarResultados(año){
    $.ajax({
        type:'POST',
        url:'bodega/procesarGraficaPreformas.php',
        data:'año='+año,
        success:function(data){

            var valores = eval(data);

            var e   = valores[0];
            var f   = valores[1];
            var m   = valores[2];
            var a   = valores[3];
            var ma  = valores[4];
            var j   = valores[5];
            var jl  = valores[6];
            var ag  = valores[7];
            var s   = valores[8];
            var o   = valores[9];
            var n   = valores[10];
            var d   = valores[11];

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

            var contexto2 = document.getElementById('graficoPreformas').getContext('2d');
            window.myLine = new Chart(contexto2).Bar(Datos, { responsive : true });

        }
    });
    return false;
}