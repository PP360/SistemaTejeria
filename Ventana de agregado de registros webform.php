 <button title="Ajuste de compra de Preformas" class="btn  btn-sm rounded-s btn-danger test" data-toggle="modal" data-target="#ajusteCompraPreforma"> <i class="fa fa-wrench  fa-lg"></i></button>

<form action="r_ajustePreformas.php" method="post">
    <div class="modal fade" id="ajusteCompraPreforma" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <center>
                                <h4 class="modal-title"><i class="fa fa-wrench  fa-lg" aria-hidden="true"></i>Ajuste de Compra de preformas</h4>
                            </center>
                        </div>

                        <div class="modal-body">
                            <div class="form-group row"> <label for="inputEmail3" class="col-sm-3 form-control-label">No. de Ajuste</label>
                                <div class="col-sm-9"> 
                                <input type="text" name="IDAjuste" id="IDAjuste" class="form-control" placeholder="" disabled value="<?php echo $IDAjuste; ?>" autofocus onkeypress="numeros()">
                                <!-- <input type="text" name="idCodigoAjuste" id="idCodigoAjuste" class="form-control" placeholder="" 
                                required disabled autofocus value="<?php echo $IDAjuste; ?>" onkeypress="numeros()"> -->
                                 </div>
                            </div>
                            <div class="form-group row"> <label for="inputEmail3" class="col-sm-3 form-control-label">IdCompra</label>
                                <?php if($FilasCPA>0){?>
                                <div class="col-sm-9">
                                    <select class="form-control form-control-sm" name="idCompraPRE" id="idCompraPRE">
                                        <option value="0">Seleccione El ID De la Compra a actualizar</option>
                                        <?php while ($row=mysqli_fetch_array($CPA)) { ?>
                                            
                                        <?php echo'<OPTION VALUE="'.$row['ID_compraPreformas'].'">'.$row['ID_compraPreformas'].'</OPTION>';?>
                                        <?php } ?>
                                    </select> </div>


                                <?php } else{ ?>
                                <div class="col-sm-9">
                                    <select class="form-control form-control-sm" name="proveedor" id="proveedor">
                                        <option value="0">No hay Compras de preformas almacenadas</option>
                                    </select> </div>

                                <?php }?>


                            </div>
                            <div class="form-group row"> <label for="inputEmail3" class="col-sm-3 form-control-label">Gramaje</label>

                                <?php if ($filasPreforma>0){ ?>
                                <div class="col-sm-9">
                                    <select class="form-control form-control-sm  " name="gramaje" id="gramaje">
                                        <option value="0">Seleccione el gramaje de la preforma a ajustar</option>
                                        <?php 
                                        $query2="SELECT * FROM preformas";
                                        $Preformas=mysqli_query($conexion,$query2);
                                        $filasPreforma=mysqli_num_rows($Preformas);
                                        while ($row=mysqli_fetch_array($Preformas)) { ?>
                                        <?php echo'<OPTION VALUE="'.$row['id_preforma'].'">'.$row['gramaje'].'</OPTION>';?>
                                        <?php } ?>
                                    </select>
                                </div>

                                <?php } else { ?>
                                <div class="col-sm-9">
                                    <select class="form-control form-control-sm  " name="gramaje" id="gramaje">
                                        <option value="0">No hay preformas agregadas</option>
                                    </select>
                                </div>

                                <?php }?>


                            </div>




                            <div class="form-group row"> <label for="inputEmail3" class="col-sm-3 form-control-label">Cant. Excedente</label>
                                <div class="col-sm-9">
                                    <input type="text" name="cantidadExcedente" id="cantidadExcedente" class="form-control" placeholder="" required maxlength="10" autofocus onkeypress="numeros()">
                                </div>

                            </div>
                          
                            <center>
                                <div id="mensaje" class="col-md-12"></div>
                            </center>


                        </div>
                        <div class="modal-footer">

                            <button type="submit" class="btn btn-oval btn-primary "id="botonAjustePreformas"> <i class="fa fa-check-square" aria-hidden="true"></i> Registrar</button>
                            <button type="submit" id="cerrar" class="btn btn-oval btn-primary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cerrar</button>


                            <!--<button type="button" class="btn btn-oval btn-secondary" data-dismiss="modal">Cerrar</button>-->
                        </div>



                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
</form>