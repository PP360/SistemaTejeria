//Grafica compra resina
 $(document).ready(mostrarResultadosResina(2017));  
                function mostrarResultadosResina(añoResina){
                    $.ajax({
                        type:'POST',
                        url:'comprar/procesarGraficaResina.php',
                        data:'añoResina='+añoResina,
                        success:function(data){

                            var valoresResina = eval(data);

                            var e   = valoresResina[0];
                            var f   = valoresResina[1];
                            var m   = valoresResina[2];
                            var a   = valoresResina[3];
                            var ma  = valoresResina[4];
                            var j   = valoresResina[5];
                            var jl  = valoresResina[6];
                            var ag  = valoresResina[7];
                            var s   = valoresResina[8];
                            var o   = valoresResina[9];
                            var n   = valoresResina[10];
                            var d   = valoresResina[11];
                                
                            var Datos = {
                                    labels : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                                    datasets : [
                                        {fillColor : "#85ce36",
                        strokeColor : "#85ce36",
                        pointColor : "#85ce36",
                        pointStrokeColor : "#85ce36",
                        pointHighlightFill : "#fff",
                        pointHighlightStroke : "rgba(220,220,220,1)",
                                            data : [e, f, m, a, ma, j, jl, ag, s, o, n, d]
                                        }
                                    ]
                                }
                                
                            var contexto = document.getElementById('graficoResina').getContext('2d');
                            window.Barra = new Chart(contexto).Bar(Datos, { responsive : true });
                        }
                    });
                    return false;
                }




