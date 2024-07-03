
<?php   
if (isset($_POST['partida'])==0)
{
    echo "Acceso denegado";
}
else
{   
    include('conexion.php');
 $paginaActual = $_POST['partida'];
 $nroProductos = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM entrega_resina"));
 $nroLotes = 10;
 $nroPaginas = ceil($nroProductos/$nroLotes);
 $lista = '';
 $tabla = '';
 if($paginaActual > 1){
     $lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination('.($paginaActual-1).');">Anterior</a></li>';
 }
 for($i=1; $i<=$nroPaginas; $i++){
     if($i == $paginaActual){
         $lista = $lista.'<li class="page-item active"><a class="page-link" href="javascript:pagination('.$i.');">'.$i.'</a></li>';
     }else{
         $lista = $lista.'<li class="page-item "><a class="page-link" href="javascript:pagination('.$i.');">'.$i.'</a></li>';
     }
 }
 if($paginaActual < $nroPaginas){
     $lista = $lista.'<li class="page-item "><a class="page-link" href="javascript:pagination('.($paginaActual+1).');">Siguiente</a></li>';
 }

 if($paginaActual <= 1){
     $limit = 0;
 }else{
     $limit = $nroLotes*($paginaActual-1);
 }



 $registro = mysqli_query($conexion,"SELECT ER1.id_entregaResina, ER1.fecha_entrega, (U1.nombre_usuario) entrego, (U2.nombre_usuario) recibe FROM entrega_resina ER1, entrega_resina ER2, usuarios U1, usuarios U2 WHERE U1.id_usuario=ER1.id_usuarioEntrega AND U2.id_usuario=ER1.id_usuarioRecibe GROUP BY  ER1.id_entregaResina LIMIT $limit, $nroLotes ");
 $filas=mysqli_num_rows($registro);
 if ($filas>0){
     $tabla = $tabla.

         ' <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tabla">
            <thead>     
        	<tr>
            <th>No.</th>
			    <th>Fecha entrega</th>
			    <th>Entregó</th>
                 <th>Recibió</th>
			    <th>Opciones</th>

            </tr>
            <thead>';

     while($registro2 = mysqli_fetch_array($registro)){
          
         $tabla = $tabla.'
            <tbody>
        <tr>       

                <td>'.$registro2['id_entregaResina'].'</td>
                <td>'.$registro2['fecha_entrega'].'</td>
				<td>'.$registro2['entrego'].'</td>
                <td>'.$registro2['recibe'].'</td>
               
                  <td> 
                 <a href="reportes/entrega_resina.php?Cod='.base64_encode($registro2['id_entregaResina']).'">
                         <button data-toggle="tooltip" data-placement="right" title="Ver entrega" type="button" class="btn btn-primary btn-sm rounded-s"><i class="fa fa-eye" aria-hidden="true"></i> </button>
                </a>
                </td>
				</tr>';	
          
        
        
     }

     $tabla = $tabla.'</tbody>';
     $tabla = $tabla.'</table>';
     $tabla=$tabla.'</div>';



     $array = array(0 => $tabla,
                    1 => $lista);

     echo json_encode($array);
 }
}
?>