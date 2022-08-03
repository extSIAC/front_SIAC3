<script type="text/javascript" src="../../../../extraescolares_itpachuca/sistema/js/administrador.js?rev=<?php echo time();?>"></script>

<div class="col-12">
    <div class="block block-themed">
        <div class="block-header block-header-default">
            <h1 class="block-title"><b>EXTRAESCOLARES</b></h1>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle">  <i class="si si-size-fullscreen"></i>           </button>
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="pinned_toggle">      <i class="si si-pin"></i>                       </button>
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                </div>
        </div>










        <div class="block-content">
            
            <div class="container row" style="margin-right:0px; margin-left:0px; padding-top:10px;">
                <div class="col-lg-8">  
                    <input type="text" class="global_filter form-control" id="global_filter_ext" onkeyup="mayus(this);" placeholder="Buscar registro extraescolar" >  <br>   
                </div>

                <div class="col-md-4">
                    <button type="button" class="btn btn-alt-success " style="width:100%" data-toggle="modal" data-target="#modal_registro_extraescolar"><i class="glyphicon glyphicon-plus"></i>Nueva extraescolar</button> <br>  
                </div>
       

                <div class="col-lg-8">  
                    <br>   <p><b>Oprima el símbolo "+" para ver las acciones disponibles al registro seleccionado.</b></p>
                </div>           
                    <div class="col-lg-4">                               
                        <label for="">FILTRAR POR TIPO DE EXTRAESCOLAR:</label>
                        <select autocomplete="off" class="js-example-basic-single form-control" name="filtrar_tipo_extraescolar" id="opcion_tipo_extraescolar_busqueda" onchange="filterGlobal_ext();" style="width:100%;" >
                        </select><br>   
                    </div>
            </div>



            <div class="block">
                <table id="tabla_extraescolar" class="text-center hidden dataTables_wrapper dt-bootstrap4 no-footer display responsive table-bordered table-vcenter" style="width:100%; font-size:10px">
                    <thead>
                        <tr>
                            <th style="width:5px">  </th>
                            <th style="width:5px">  EXTRAESCOLAR</th>
                            <th style="width:10px"> GRUPO</th>
                            <th style="width:10px"> PROMOTOR</th>
                            <th style="width:10px"> LUGAR</th>
                            <th style="width:5px">  TIPO DE EXTRAESCOLAR</th>
                            <th style="width:10px"> PERIODO</th>
                            <th style="width:10px"> ESTADO</th>
                            <th style="width:10px"> ACCIONES</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Inicio modal registro de usuarios alumnos -->
    <form autocomplete="false" onSubmit="return false">
        <div class="modal fade " id="modal_registro_extraescolar" role="dialog"   data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-fromright modal-lg ">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary">
                            <h3 class="block-title">REGISTRO DE EXTRAESCOLARES</h3>
                            <div class="block-options">
                                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                        <i class="si si-close"></i>
                                    </button>
                                </div>
                        </div>
                        <div class="container row" style="margin-right:0px; margin-left:0px; padding-top:10px;">
                            <br>
                            <div class="col-lg-8">
                                <label for="">Nombre de la extraescolar:</label>
                                <input autocomplete="off" type="text" class="form-control" id="REG_EXT_EXTRAESCOLAR" maxlength="35" onkeyup="mayus(this);" onkeypress="return Solo_Letras(event)" placeholder="Ingrese el nombre de la extraescolar"><br>
                            </div>
                            <div class="col-lg-4">
                                <label for="">Grupo:</label>
                                <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="opcion_grupo_extraescolar" style="width:100%;" >
                                </select><br><br>
                            </div>     
                            <div class="col-lg-6">
                                <label for="">Promotor:</label>
                                <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="opcion_promotor" style="width:100%;" >
                                </select><br><br>
                            </div>     
                            <div class="col-lg-6">
                                <label for="">Lugar:</label>
                                <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="opcion_lugar" style="width:100%;" >
                                </select><br><br>
                            </div>     
                            <div class="col-lg-6">
                                <label for="">Tipo de extraescolar:</label>
                                <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="opcion_tipo_extraescolar" style="width:100%;" >
                                </select><br><br>
                            </div>     
                            <div class="col-lg-6">
                                <label for="">Periodo:</label>
                                <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="opcion_periodo" style="width:100%;" >
                                </select><br><br>
                            </div>
                            <div class="col-lg-1"></div>     
                            <div class="col-lg-2">
                                <label for=""><b>LUNES:</b></label>
                                    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                                        <label for="">Inicio:</label>
                                        <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="REG_EXT_HORA_LUNES_INICIO" style="width:100%;padding-left: 0px;" >
                                            <option value=""> - </option>
                                            <option value="7:00">7:00 am.</option>
                                            <option value="8:00">8:00 am.</option>
                                            <option value="9:00">9:00 am.</option>
                                            <option value="10:00">10:00 am.</option>
                                            <option value="11:00">11:00 am.</option>
                                            <option value="12:00">12:00 pm.</option>
                                            <option value="13:00">1:00 pm.</option>
                                            <option value="14:00">2:00 pm.</option>
                                            <option value="15:00">3:00 pm.</option>
                                            <option value="16:00">4:00 pm.</option>
                                            <option value="17:00">5:00 pm.</option>
                                            <option value="18:00">6:00 pm.</option>
                                            <option value="19:00">7:00 pm.</option>
                                            <option value="20:00">8:00 pm.</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                                        <label for="">Fin:</label>
                                        <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="REG_EXT_HORA_LUNES_FIN" style="width:100%;padding-left: 0px;" >
                                            <option value=""> - </option>
                                            <option value=" - 8:00">8:00 am.</option>
                                            <option value=" - 9:00">9:00 am.</option>
                                            <option value=" - 10:00">10:00 am.</option>
                                            <option value=" - 11:00">11:00 am.</option>
                                            <option value=" - 12:00">12:00 pm.</option>
                                            <option value=" - 13:00">1:00 pm.</option>
                                            <option value=" - 14:00">2:00 pm.</option>
                                            <option value=" - 15:00">3:00 pm.</option>
                                            <option value=" - 16:00">4:00 pm.</option>
                                            <option value=" - 17:00">5:00 pm.</option>
                                            <option value=" - 18:00">6:00 pm.</option>
                                            <option value=" - 19:00">7:00 pm.</option>
                                            <option value=" - 20:00">8:00 pm.</option>
                                            <option value=" - 21:00">9:00 pm.</option>                                            
                                        </select><br><br>
                                    </div>                                    
                            </div>
                            <div class="col-lg-2">
                                <label for=""><b>MARTES:</b></label>
                                    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                                        <label for="">Inicio:</label>
                                        <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="REG_EXT_HORA_MARTES_INICIO" style="width:100%;padding-left: 0px;">
                                            <option value=""> - </option>
                                            <option value="7:00">7:00 am.</option>
                                            <option value="8:00">8:00 am.</option>
                                            <option value="9:00">9:00 am.</option>
                                            <option value="10:00">10:00 am.</option>
                                            <option value="11:00">11:00 am.</option>
                                            <option value="12:00">12:00 pm.</option>
                                            <option value="13:00">1:00 pm.</option>
                                            <option value="14:00">2:00 pm.</option>
                                            <option value="15:00">3:00 pm.</option>
                                            <option value="16:00">4:00 pm.</option>
                                            <option value="17:00">5:00 pm.</option>
                                            <option value="18:00">6:00 pm.</option>
                                            <option value="19:00">7:00 pm.</option>
                                            <option value="20:00">8:00 pm.</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                                        <label for="">Fin:</label>
                                        <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="REG_EXT_HORA_MARTES_FIN" style="width:100%;padding-left: 0px;" >
                                            <option value=""> - </option>
                                            <option value=" - 8:00">8:00 am.</option>
                                            <option value=" - 9:00">9:00 am.</option>
                                            <option value=" - 10:00">10:00 am.</option>
                                            <option value=" - 11:00">11:00 am.</option>
                                            <option value=" - 12:00">12:00 pm.</option>
                                            <option value=" - 13:00">1:00 pm.</option>
                                            <option value=" - 14:00">2:00 pm.</option>
                                            <option value=" - 15:00">3:00 pm.</option>
                                            <option value=" - 16:00">4:00 pm.</option>
                                            <option value=" - 17:00">5:00 pm.</option>
                                            <option value=" - 18:00">6:00 pm.</option>
                                            <option value=" - 19:00">7:00 pm.</option>
                                            <option value=" - 20:00">8:00 pm.</option>
                                            <option value=" - 21:00">9:00 pm.</option>     
                                        </select><br><br>
                                    </div>                                    
                            </div>          
                            <div class="col-lg-2" >
                                <label for=""><b>MIÉRCOLES:</b></label>
                                    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                                        <label for="">Inicio:</label>
                                        <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="REG_EXT_HORA_MIERCOLES_INICIO" style="width:100%;padding-left: 0px;" >
                                            <option value=""> - </option>
                                            <option value="7:00">7:00 am.</option>
                                            <option value="8:00">8:00 am.</option>
                                            <option value="9:00">9:00 am.</option>
                                            <option value="10:00">10:00 am.</option>
                                            <option value="11:00">11:00 am.</option>
                                            <option value="12:00">12:00 pm.</option>
                                            <option value="13:00">1:00 pm.</option>
                                            <option value="14:00">2:00 pm.</option>
                                            <option value="15:00">3:00 pm.</option>
                                            <option value="16:00">4:00 pm.</option>
                                            <option value="17:00">5:00 pm.</option>
                                            <option value="18:00">6:00 pm.</option>
                                            <option value="19:00">7:00 pm.</option>
                                            <option value="20:00">8:00 pm.</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                                        <label for="">Fin:</label>
                                        <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="REG_EXT_HORA_MIERCOLES_FIN" style="width:100%;padding-left: 0px;" >
                                            <option value=""> - </option>
                                            <option value=" - 8:00">8:00 am.</option>
                                            <option value=" - 9:00">9:00 am.</option>
                                            <option value=" - 10:00">10:00 am.</option>
                                            <option value=" - 11:00">11:00 am.</option>
                                            <option value=" - 12:00">12:00 pm.</option>
                                            <option value=" - 13:00">1:00 pm.</option>
                                            <option value=" - 14:00">2:00 pm.</option>
                                            <option value=" - 15:00">3:00 pm.</option>
                                            <option value=" - 16:00">4:00 pm.</option>
                                            <option value=" - 17:00">5:00 pm.</option>
                                            <option value=" - 18:00">6:00 pm.</option>
                                            <option value=" - 19:00">7:00 pm.</option>
                                            <option value=" - 20:00">8:00 pm.</option>
                                            <option value=" - 21:00">9:00 pm.</option>     
                                        </select><br><br>
                                    </div>                                    
                            </div>
                            <div class="col-lg-2">
                                <label for=""><b>JUEVES:</b></label>
                                    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                                        <label for="">Inicio:</label>
                                        <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="REG_EXT_HORA_JUEVES_INICIO" style="width:100%;padding-left: 0px;" >
                                            <option value=""> - </option>
                                            <option value="7:00">7:00 am.</option>
                                            <option value="8:00">8:00 am.</option>
                                            <option value="9:00">9:00 am.</option>
                                            <option value="10:00">10:00 am.</option>
                                            <option value="11:00">11:00 am.</option>
                                            <option value="12:00">12:00 pm.</option>
                                            <option value="13:00">1:00 pm.</option>
                                            <option value="14:00">2:00 pm.</option>
                                            <option value="15:00">3:00 pm.</option>
                                            <option value="16:00">4:00 pm.</option>
                                            <option value="17:00">5:00 pm.</option>
                                            <option value="18:00">6:00 pm.</option>
                                            <option value="19:00">7:00 pm.</option>
                                            <option value="20:00">8:00 pm.</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                                        <label for="">Fin:</label>
                                        <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="REG_EXT_HORA_JUEVES_FIN" style="width:100%;padding-left: 0px;" >
                                            <option value=""> - </option>
                                            <option value=" - 8:00">8:00 am.</option>
                                            <option value=" - 9:00">9:00 am.</option>
                                            <option value=" - 10:00">10:00 am.</option>
                                            <option value=" - 11:00">11:00 am.</option>
                                            <option value=" - 12:00">12:00 pm.</option>
                                            <option value=" - 13:00">1:00 pm.</option>
                                            <option value=" - 14:00">2:00 pm.</option>
                                            <option value=" - 15:00">3:00 pm.</option>
                                            <option value=" - 16:00">4:00 pm.</option>
                                            <option value=" - 17:00">5:00 pm.</option>
                                            <option value=" - 18:00">6:00 pm.</option>
                                            <option value=" - 19:00">7:00 pm.</option>
                                            <option value=" - 20:00">8:00 pm.</option>
                                            <option value=" - 21:00">9:00 pm.</option>     
                                        </select><br><br>
                                    </div>                                    
                            </div>
                            <div class="col-lg-2">
                                <label for=""><b>VIERNES:</b></label>
                                    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                                        <label for="">Inicio:</label>
                                        <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="REG_EXT_HORA_VIERNES_INICIO" style="width:100%;padding-left: 0px;" >
                                            <option value=""> - </option>
                                            <option value="7:00">7:00 am.</option>
                                            <option value="8:00">8:00 am.</option>
                                            <option value="9:00">9:00 am.</option>
                                            <option value="10:00">10:00 am.</option>
                                            <option value="11:00">11:00 am.</option>
                                            <option value="12:00">12:00 pm.</option>
                                            <option value="13:00">1:00 pm.</option>
                                            <option value="14:00">2:00 pm.</option>
                                            <option value="15:00">3:00 pm.</option>
                                            <option value="16:00">4:00 pm.</option>
                                            <option value="17:00">5:00 pm.</option>
                                            <option value="18:00">6:00 pm.</option>
                                            <option value="19:00">7:00 pm.</option>
                                            <option value="20:00">8:00 pm.</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                                        <label for="">Fin:</label>
                                        <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="REG_EXT_HORA_VIERNES_FIN" style="width:100%;padding-left: 0px;" >
                                            <option value=""> - </option>
                                            <option value=" - 8:00">8:00 am.</option>
                                            <option value=" - 9:00">9:00 am.</option>
                                            <option value=" - 10:00">10:00 am.</option>
                                            <option value=" - 11:00">11:00 am.</option>
                                            <option value=" - 12:00">12:00 pm.</option>
                                            <option value=" - 13:00">1:00 pm.</option>
                                            <option value=" - 14:00">2:00 pm.</option>
                                            <option value=" - 15:00">3:00 pm.</option>
                                            <option value=" - 16:00">4:00 pm.</option>
                                            <option value=" - 17:00">5:00 pm.</option>
                                            <option value=" - 18:00">6:00 pm.</option>
                                            <option value=" - 19:00">7:00 pm.</option>
                                            <option value=" - 20:00">8:00 pm.</option>
                                            <option value=" - 21:00">9:00 pm.</option>     
                                        </select><br><br>
                                    </div>                                    
                            </div>

                        </div>                   
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button"  class="btn btn-alt-success"   onclick="Registrar_Extraescolar();" data-dismiss="modal">
                            <i class="fa fa-check"></i> Registrar
                        </button>
                    </div>
                </div>
            </div>         
        </div>
    </form>
<!-- Fin modal registro de usuarios alumnos -->

<!-- Inicio modal edición de usuarios alumnos -->
    <form autocomplete="false" onSubmit="return false">
        <div class="modal fade " id="modal_editar_extraescolar" role="dialog"   data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-fromright modal-lg ">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary">
                            <h3 class="block-title">EDITAR EXTRAESCOLAR</h3>
                            <div class="block-options">
                                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                        <i class="si si-close"></i>
                                    </button>
                                </div>
                        </div>
                        <div class="container row" style="margin-right:0px; margin-left:0px; padding-top:10px;">
                            <br>
                            <div class="col-lg-3">
                                <label for="">ID de extraescolar:</label>
                                <input  disabled autocomplete="off" type="text" class="form-control" id="EDIT_EXT_ID_EXTRAESCOLAR" maxlength="35" placeholder=""><br>
                            </div>                            
                            <div class="col-lg-6">
                                <label for="">Nombre de la extraescolar:</label>
                                <input  disabled autocomplete="off" type="text" class="form-control" id="EDIT_EXT_EXTRAESCOLAR" maxlength="35" placeholder="Ingrese el nombre de la extraescolar"><br>
                            </div>
                            <div class="col-lg-3">
                                <label disabled for="">Grupo:</label>
                                <select disabled autocomplete="off" class="js-example-basic-single form-control" name="state" id="opcion_grupo_extraescolar_editar" style="width:100%;" >
                                </select><br><br>
                            </div>     
                            <div class="col-lg-6">
                                <label for="">Promotor:</label>
                                <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="opcion_promotor_editar" style="width:100%;" >
                                </select><br><br>
                            </div>     
                            <div class="col-lg-6">
                                <label for="">Lugar:</label>
                                <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="opcion_lugar_editar" style="width:100%;" >
                                </select><br><br>
                            </div>     
                            <div class="col-lg-6">
                                <label for="">Tipo de extraescolar:</label>
                                <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="opcion_tipo_extraescolar_editar" style="width:100%;" >
                                </select><br><br>
                            </div>     
                            <div class="col-lg-6">
                                <label for="">Periodo:</label>
                                <select disabled autocomplete="off" class="js-example-basic-single form-control" name="state" id="opcion_periodo_editar" style="width:100%;" >
                                </select><br><br>
                            </div>
                            <div class="col-lg-1"></div>     
                            <div class="col-lg-2">
                                <label for=""><b>LUNES:</b></label>
                                    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                                        <label for="">Inicio:</label>
                                        <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="EDIT_EXT_HORA_LUNES_INICIO" style="width:100%;padding-left: 0px;" >
                                            <option value=""> - </option>
                                            <option value="7:00">7:00 am.</option>
                                            <option value="8:00">8:00 am.</option>
                                            <option value="9:00">9:00 am.</option>
                                            <option value="10:00">10:00 am.</option>
                                            <option value="11:00">11:00 am.</option>
                                            <option value="12:00">12:00 pm.</option>
                                            <option value="13:00">1:00 pm.</option>
                                            <option value="14:00">2:00 pm.</option>
                                            <option value="15:00">3:00 pm.</option>
                                            <option value="16:00">4:00 pm.</option>
                                            <option value="17:00">5:00 pm.</option>
                                            <option value="18:00">6:00 pm.</option>
                                            <option value="19:00">7:00 pm.</option>
                                            <option value="20:00">8:00 pm.</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                                        <label for="">Fin:</label>
                                        <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="EDIT_EXT_HORA_LUNES_FIN" style="width:100%;padding-left: 0px;" >
                                            <option value=""> - </option>
                                            <option value=" - 8:00">8:00 am.</option>
                                            <option value=" - 9:00">9:00 am.</option>
                                            <option value=" - 10:00">10:00 am.</option>
                                            <option value=" - 11:00">11:00 am.</option>
                                            <option value=" - 12:00">12:00 pm.</option>
                                            <option value=" - 13:00">1:00 pm.</option>
                                            <option value=" - 14:00">2:00 pm.</option>
                                            <option value=" - 15:00">3:00 pm.</option>
                                            <option value=" - 16:00">4:00 pm.</option>
                                            <option value=" - 17:00">5:00 pm.</option>
                                            <option value=" - 18:00">6:00 pm.</option>
                                            <option value=" - 19:00">7:00 pm.</option>
                                            <option value=" - 20:00">8:00 pm.</option>
                                            <option value=" - 21:00">9:00 pm.</option>                                            
                                        </select><br><br>
                                    </div>                                    
                            </div>
                            <div class="col-lg-2">
                                <label for=""><b>MARTES:</b></label>
                                    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                                        <label for="">Inicio:</label>
                                        <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="EDIT_EXT_HORA_MARTES_INICIO" style="width:100%;padding-left: 0px;">
                                            <option value=""> - </option>
                                            <option value="7:00">7:00 am.</option>
                                            <option value="8:00">8:00 am.</option>
                                            <option value="9:00">9:00 am.</option>
                                            <option value="10:00">10:00 am.</option>
                                            <option value="11:00">11:00 am.</option>
                                            <option value="12:00">12:00 pm.</option>
                                            <option value="13:00">1:00 pm.</option>
                                            <option value="14:00">2:00 pm.</option>
                                            <option value="15:00">3:00 pm.</option>
                                            <option value="16:00">4:00 pm.</option>
                                            <option value="17:00">5:00 pm.</option>
                                            <option value="18:00">6:00 pm.</option>
                                            <option value="19:00">7:00 pm.</option>
                                            <option value="20:00">8:00 pm.</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                                        <label for="">Fin:</label>
                                        <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="EDIT_EXT_HORA_MARTES_FIN" style="width:100%;padding-left: 0px;" >
                                            <option value=""> - </option>
                                            <option value=" - 8:00">8:00 am.</option>
                                            <option value=" - 9:00">9:00 am.</option>
                                            <option value=" - 10:00">10:00 am.</option>
                                            <option value=" - 11:00">11:00 am.</option>
                                            <option value=" - 12:00">12:00 pm.</option>
                                            <option value=" - 13:00">1:00 pm.</option>
                                            <option value=" - 14:00">2:00 pm.</option>
                                            <option value=" - 15:00">3:00 pm.</option>
                                            <option value=" - 16:00">4:00 pm.</option>
                                            <option value=" - 17:00">5:00 pm.</option>
                                            <option value=" - 18:00">6:00 pm.</option>
                                            <option value=" - 19:00">7:00 pm.</option>
                                            <option value=" - 20:00">8:00 pm.</option>
                                            <option value=" - 21:00">9:00 pm.</option>     
                                        </select><br><br>
                                    </div>                                    
                            </div>          
                            <div class="col-lg-2" >
                                <label for=""><b>MIÉRCOLES:</b></label>
                                    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                                        <label for="">Inicio:</label>
                                        <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="EDIT_EXT_HORA_MIERCOLES_INICIO" style="width:100%;padding-left: 0px;" >
                                            <option value=""> - </option>
                                            <option value="7:00">7:00 am.</option>
                                            <option value="8:00">8:00 am.</option>
                                            <option value="9:00">9:00 am.</option>
                                            <option value="10:00">10:00 am.</option>
                                            <option value="11:00">11:00 am.</option>
                                            <option value="12:00">12:00 pm.</option>
                                            <option value="13:00">1:00 pm.</option>
                                            <option value="14:00">2:00 pm.</option>
                                            <option value="15:00">3:00 pm.</option>
                                            <option value="16:00">4:00 pm.</option>
                                            <option value="17:00">5:00 pm.</option>
                                            <option value="18:00">6:00 pm.</option>
                                            <option value="19:00">7:00 pm.</option>
                                            <option value="20:00">8:00 pm.</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                                        <label for="">Fin:</label>
                                        <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="EDIT_EXT_HORA_MIERCOLES_FIN" style="width:100%;padding-left: 0px;" >
                                            <option value=""> - </option>
                                            <option value=" - 8:00">8:00 am.</option>
                                            <option value=" - 9:00">9:00 am.</option>
                                            <option value=" - 10:00">10:00 am.</option>
                                            <option value=" - 11:00">11:00 am.</option>
                                            <option value=" - 12:00">12:00 pm.</option>
                                            <option value=" - 13:00">1:00 pm.</option>
                                            <option value=" - 14:00">2:00 pm.</option>
                                            <option value=" - 15:00">3:00 pm.</option>
                                            <option value=" - 16:00">4:00 pm.</option>
                                            <option value=" - 17:00">5:00 pm.</option>
                                            <option value=" - 18:00">6:00 pm.</option>
                                            <option value=" - 19:00">7:00 pm.</option>
                                            <option value=" - 20:00">8:00 pm.</option>
                                            <option value=" - 21:00">9:00 pm.</option>     
                                        </select><br><br>
                                    </div>                                    
                            </div>
                            <div class="col-lg-2">
                                <label for=""><b>JUEVES:</b></label>
                                    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                                        <label for="">Inicio:</label>
                                        <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="EDIT_EXT_HORA_JUEVES_INICIO" style="width:100%;padding-left: 0px;" >
                                            <option value=""> - </option>
                                            <option value="7:00">7:00 am.</option>
                                            <option value="8:00">8:00 am.</option>
                                            <option value="9:00">9:00 am.</option>
                                            <option value="10:00">10:00 am.</option>
                                            <option value="11:00">11:00 am.</option>
                                            <option value="12:00">12:00 pm.</option>
                                            <option value="13:00">1:00 pm.</option>
                                            <option value="14:00">2:00 pm.</option>
                                            <option value="15:00">3:00 pm.</option>
                                            <option value="16:00">4:00 pm.</option>
                                            <option value="17:00">5:00 pm.</option>
                                            <option value="18:00">6:00 pm.</option>
                                            <option value="19:00">7:00 pm.</option>
                                            <option value="20:00">8:00 pm.</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                                        <label for="">Fin:</label>
                                        <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="EDIT_EXT_HORA_JUEVES_FIN" style="width:100%;padding-left: 0px;" >
                                            <option value=""> - </option>
                                            <option value=" - 8:00">8:00 am.</option>
                                            <option value=" - 9:00">9:00 am.</option>
                                            <option value=" - 10:00">10:00 am.</option>
                                            <option value=" - 11:00">11:00 am.</option>
                                            <option value=" - 12:00">12:00 pm.</option>
                                            <option value=" - 13:00">1:00 pm.</option>
                                            <option value=" - 14:00">2:00 pm.</option>
                                            <option value=" - 15:00">3:00 pm.</option>
                                            <option value=" - 16:00">4:00 pm.</option>
                                            <option value=" - 17:00">5:00 pm.</option>
                                            <option value=" - 18:00">6:00 pm.</option>
                                            <option value=" - 19:00">7:00 pm.</option>
                                            <option value=" - 20:00">8:00 pm.</option>
                                            <option value=" - 21:00">9:00 pm.</option>     
                                        </select><br><br>
                                    </div>                                    
                            </div>
                            <div class="col-lg-2">
                                <label for=""><b>VIERNES:</b></label>
                                    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                                        <label for="">Inicio:</label>
                                        <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="EDIT_EXT_HORA_VIERNES_INICIO" style="width:100%;padding-left: 0px;" >
                                            <option value=""> - </option>
                                            <option value="7:00">7:00 am.</option>
                                            <option value="8:00">8:00 am.</option>
                                            <option value="9:00">9:00 am.</option>
                                            <option value="10:00">10:00 am.</option>
                                            <option value="11:00">11:00 am.</option>
                                            <option value="12:00">12:00 pm.</option>
                                            <option value="13:00">1:00 pm.</option>
                                            <option value="14:00">2:00 pm.</option>
                                            <option value="15:00">3:00 pm.</option>
                                            <option value="16:00">4:00 pm.</option>
                                            <option value="17:00">5:00 pm.</option>
                                            <option value="18:00">6:00 pm.</option>
                                            <option value="19:00">7:00 pm.</option>
                                            <option value="20:00">8:00 pm.</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                                        <label for="">Fin:</label>
                                        <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="EDIT_EXT_HORA_VIERNES_FIN" style="width:100%;padding-left: 0px;" >
                                            <option value=""> - </option>
                                            <option value=" - 8:00">8:00 am.</option>
                                            <option value=" - 9:00">9:00 am.</option>
                                            <option value=" - 10:00">10:00 am.</option>
                                            <option value=" - 11:00">11:00 am.</option>
                                            <option value=" - 12:00">12:00 pm.</option>
                                            <option value=" - 13:00">1:00 pm.</option>
                                            <option value=" - 14:00">2:00 pm.</option>
                                            <option value=" - 15:00">3:00 pm.</option>
                                            <option value=" - 16:00">4:00 pm.</option>
                                            <option value=" - 17:00">5:00 pm.</option>
                                            <option value=" - 18:00">6:00 pm.</option>
                                            <option value=" - 19:00">7:00 pm.</option>
                                            <option value=" - 20:00">8:00 pm.</option>
                                            <option value=" - 21:00">9:00 pm.</option>     
                                        </select><br><br>
                                    </div>                                    
                            </div>

                        </div>                    
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button"  class="btn btn-alt-success"   onclick="Editar_Extraescolar();" data-dismiss="modal">
                            <i class="fa fa-check"></i>Modificar
                        </button>
                    </div>
                </div>
            </div>         
        </div>
    </form>
<!-- Fin modal edición de usuarios alumnos -->


<script>
$(document).ready(function() {
    listar_extraescolar();
    listar_opcion_grupo_extraescolar();
    listar_opcion_lugar();
    listar_opcion_periodo();
    listar_opcion_promotor();
    listar_opcion_tipo_extraescolar();
    listar_opcion_tipo_extraescolar_busqueda();
    $('.js-example-basic-single').select2();
} );
</script>


