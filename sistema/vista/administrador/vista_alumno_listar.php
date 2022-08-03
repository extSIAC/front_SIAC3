<script type="text/javascript" src="../../../../extraescolares_itpachuca/sistema/js/administrador.js?rev=<?php echo time();?>"></script>

<div class="col-12">
    <div class="block block-themed">
        <div class="block-header block-header-default">
            <h1 class="block-title"><b>ALUMNOS</b></h1>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle">  <i class="si si-size-fullscreen"></i>           </button>
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="pinned_toggle">      <i class="si si-pin"></i>                       </button>
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                </div>
        </div>

        <div class="block-content">
            

            <div class="container row" style="margin-right:0px; margin-left:0px; padding-top:10px;">
                <div class="col-lg-6">  <br>
                    <input type="text" class="global_filter form-control" id="global_filter_alu" onkeyup="mayus(this);" placeholder="Buscar registro alumno" >  <br>   
                </div>

                <div class="col-lg-3"> <br>
                    <button type="button" class="btn btn-alt-success " style="width:100%" data-toggle="modal" data-target="#modal_registro_alumno_adm"><i class="glyphicon glyphicon-plus"></i>Nuevo registro</button> <br>  
                </div>
                    <div class="col-lg-3">                               
                        <label for="">FILTRAR POR EXTRAESCOLAR:</label>
                        <select autocomplete="off" class="js-example-basic-single form-control" name="filtrar_tipo_extraescolar" id="opcion_extraescolar_busqueda" onchange="filterGlobal_alu();" style="width:100%;" >
                        </select><br>   
                    </div>
                <div class=" row col-lg-12 border-2x">  
                    <div class="col-lg-2">  
                                <label for="">Día:</label>
                                <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="REG_FECHA_DIA_INSCRIPCION" style="width:100%;" >
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select><br>
                    </div>     

                     <div class="col-lg-2">  
                                <label for="">Mes:</label>
                                <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="REG_FECHA_MES_INSCRIPCION" style="width:100%;" >
                                    <option value="1">ENERO</option>
                                    <option value="2">FEBRERO</option>
                                    <option value="3">MARZO</option>
                                    <option value="4">ABRIL</option>
                                    <option value="5">MAYO</option>
                                    <option value="6">JUNIO</option>
                                    <option value="7">JULIO</option>
                                    <option value="8">AGOSTO</option>
                                    <option value="9">SEPTIEMBRE</option>
                                    <option value="10">OCTUBRE</option>
                                    <option value="11">NOVIEMBRE</option>
                                    <option value="12">DICIEMBRE</option>
                                </select><br>
                    </div>     

                    <div class="col-lg-2">  
                                <label for="">Año:</label>
                                <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="REG_FECHA_ANO_INSCRIPCION" style="width:100%;" >
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                </select><br>
                    </div>     
   
                <div class="col-lg-6"><br>
                    <button type="button" class="btn btn-alt-info " style="width:100%" ><i class="glyphicon glyphicon-plus"></i>Establecer fecha límite de inscripción</button> <br>  
                </div>  
                                </div>                   


                <div class="col-lg-8">  <br>
                    <p><b>Oprima el símbolo "+" para ver las acciones disponibles al registro seleccionado.</b></p>
                </div>     
            </div>


            <div class="block">
                <table id="tabla_alumno" class="text-center hidden dataTables_wrapper dt-bootstrap4 no-footer display responsive table-bordered table-vcenter" style="width:100%; font-size:10px">
                    <thead>
                        <tr>
                            <th style="width:5px"> </th>
                            <th style="width:5px">  NO. DE CONTROL</th>
                            <th style="width:10px"> PATERNO</th>
                            <th style="width:10px"> MATERNO</th>
                            <th style="width:10px"> NOMBRE</th>
                            <th style="width:5px">  EDAD</th>
                            <th style="width:10px"> SEXO</th>
                            <th style="width:10px"> TELEFONO</th>
                            <th style="width:10px"> CORREO</th>
                            <th style="width:10px"> CARRERA</th>
                            <th style="width:10px"> SEMESTRE</th>
                            <th style="width:10px"> EXTRAESCOLAR</th>
                            <th style="width:10px"> TIPO EXTRAESCOLAR</th>                            
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
        <div class="modal fade " id="modal_registro_alumno_adm" role="dialog"   data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-fromright modal-lg ">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary">
                            <h3 class="block-title">INSCRIPCIÓN A EXTRAESCOLAR</h3>
                            <div class="block-options">
                                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                        <i class="si si-close"></i>
                                    </button>
                                </div>
                        </div>
                        <div class="container row" style="margin-right:0px; margin-left:0px; padding-top:10px;">
                            <br>
                            <div class="col-md-6">
                                <label for="">Nombre(s):</label>
                                <input autocomplete="off" type="text" class="form-control" id="REG_ALU_NOMBRE" onkeyup="mayus(this);" onkeypress="return Solo_Letras(event)" maxlength="35" placeholder="Ingrese nombre(s)"><br>
                            </div>
                            <div class="col-md-6">
                                <label for="">Apellido paterno:</label>
                                <input autocomplete="off" type="text" class="form-control" id="REG_ALU_APELLIDO_PATERNO" onkeyup="mayus(this);" onkeypress="return Solo_Letras(event)" maxlength="35" placeholder="Ingrese apellido paterno"><br>
                            </div>
                            <div class="col-md-6">
                                <label for="">Apellido materno:</label>
                                <input autocomplete="off" type="text" class="form-control" id="REG_ALU_APELLIDO_MATERNO" onkeyup="mayus(this);" onkeypress="return Solo_Letras(event)" maxlength="35" placeholder="Ingrese apellido materno"><br>
                            </div>
                          <div class="col-md-6">
                                <label for="">Número de control:</label>
                                <input autocomplete="off" type="text" class="form-control" id="REG_ALU_NUMERO_CONTROL" onkeypress="return Solo_Numeros(event)" maxlength="30" placeholder="Ingrese su número de control"><br>
                            </div>
                            <div class="col-lg-6">
                                <label for="">Carrera:</label>
                                <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="opcion_carrera" style="width:100%;" >
                                </select><br>
                            </div>     
                            <div class="col-lg-6">
                                <label for="">Semestre:</label>
                                <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="opcion_semestre" style="width:100%;" >
                                </select><br><br>
                            </div>     
                            <div class="col-md-3">
                                <label for="">Edad:</label>
                                <input autocomplete="off" type="number" min="17" max="80" class="form-control" maxlength="2" onkeypress="return Solo_Numeros(event)" id="REG_ALU_EDAD"><br>
                            </div>
                            <div class="col-lg-3">
                                <label for="">Sexo:</label>
                                <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="REG_ALU_SEXO" style="width:100%;" >
                                    <option value="M">MASCULINO</option>
                                    <option value="F">FEMENINO</option>
                                </select><br>
                            </div>
                            <div class="col-md-6">
                                <label for="">Teléfono:</label>
                                <input autocomplete="off" type="text" class="form-control" id="REG_ALU_TELEFONO" maxlength="12" onkeypress="return Solo_Numeros(event)" placeholder="Ingrese número de teléfono"><br>
                            </div>
                            <div class="col-md-6">
                                <label for="">Correo electrónico:</label>
                                <input autocomplete="off" type="email" class="form-control" id="REG_ALU_CORREO" maxlength="50" placeholder="Ingrese correo electrónico">
                                <label id="validacion_correo" style="color: red;"></label>
                                <input disabled id="validar_correo" type="text" hidden>
                            </div>

                            <div class="col-md-3">
                                <label for="">Contraseña:</label>
                                <input autocomplete="off" type="password" class="form-control" id="REG_ALU_CONTRASENA1" placeholder="Ingrese contraseña"><br>
                            </div>
                            <div class="col-md-3">
                                <label for="">Repita la contraseña:</label>
                                <input autocomplete="off" type="password" class="form-control" id="REG_ALU_CONTRASENA2" placeholder="Repita contrase&ntilde;a"><br>
                            </div>            
                            <div class="col-md-12">
                                <label for="">Extraescolar a inscribirse:</label>
                                <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="opcion_extraescolar" style="width:100%;" >
                                </select><br><br>
                            </div>      
                        </div>                   
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button"  class="btn btn-alt-success"   onclick="Registrar_Usuario_Alumno();" data-dismiss="modal">
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
        <div class="modal fade " id="modal_editar_alumno" role="dialog"   data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-fromright modal-lg ">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary">
                            <h3 class="block-title">EDITAR INSCRIPCIÓN DE ALUMNO</h3>
                            <div class="block-options">
                                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                        <i class="si si-close"></i>
                                    </button>
                                </div>
                        </div>
                        <div class="container row" style="margin-right:0px; margin-left:0px; padding-top:10px;">
                            <br>
                            <div class="col-md-2">
                                <label for="">ID de usuario:</label>
                                <input disabled type="text" class="form-control disable" id="EDIT_ALU_ID_ALUMNO" maxlength="30" ><br>
                            </div>
                            <div class="col-md-4">
                                <label for="">Número de control:</label>
                                <input disabled type="text" class="form-control disable" id="EDIT_ALU_NUMERO_CONTROL" maxlength="30" ><br>
                            </div>
                            <div class="col-md-6">
                                <label for="">Nombre(s):</label>
                                <input type="text" class="form-control" id="EDIT_ALU_NOMBRE" maxlength="35" onkeyup="mayus(this);" onkeypress="return Solo_Letras(event)" placeholder="Ingrese nombre(s)"><br>
                            </div>
                            <div class="col-md-6">
                                <label for="">Apellido paterno:</label>
                                <input type="text" class="form-control" id="EDIT_ALU_APELLIDO_PATERNO" maxlength="35" onkeyup="mayus(this);" onkeypress="return Solo_Letras(event)" placeholder="Ingrese apellido paterno"><br>
                            </div>
                            <div class="col-md-6">
                                <label for="">Apellido materno:</label>
                                <input type="text" class="form-control" id="EDIT_ALU_APELLIDO_MATERNO" maxlength="35" onkeyup="mayus(this);" onkeypress="return Solo_Letras(event)" placeholder="Ingrese apellido materno"><br>
                            </div>
                            <div class="col-lg-6">
                                <label for="">Carrera:</label>
                                <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="opcion_carrera_editar" style="width:100%;" >
                                </select><br>
                            </div>     
                            <div class="col-lg-6">
                                <label for="">Semestre:</label>
                                <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="opcion_semestre_editar" style="width:100%;" >
                                </select><br><br>
                            </div>   
                            <div class="col-md-3">
                                <label for="">Edad:</label>
                                <input type="number" min="17" max="80" class="form-control" onkeypress="return Solo_Numeros(event)" maxlength="2" id="EDIT_ALU_EDAD"><br>
                            </div>
                            <div class="col-lg-3">
                                <label for="">Sexo</label>
                                <select class="js-example-basic-single form-control" name="state" id="EDIT_ALU_SEXO" style="width:100%;" placeholder="asd" >
                                    <option value="M">MASCULINO</option>
                                    <option value="F">FEMENINO</option>
                                </select><br><br>
                            </div>
                            <div class="col-md-6">
                                <label for="">Teléfono:</label>
                                <input type="text" class="form-control" id="EDIT_ALU_TELEFONO" onkeypress="return Solo_Numeros(event)" maxlength="12" placeholder="Ingrese número de teléfono"><br>
                            </div>
                            <div class="col-md-6">
                                <label for="">Correo electrónico:</label>
                                <input type="email" class="form-control" id="EDIT_ALU_CORREO" maxlength="50" placeholder="Ingrese correo electrónico">
                                <label id="editar_validacion_correo" style="color: red;"></label>
                                <input disabled id="editar_validar_correo" type="text" hidden>
                            </div>   
                            <div class="col-md-6">
                                <label for="">Extraescolar a inscribirse:</label>
                                <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="opcion_extraescolar_editar" style="width:100%;" >
                                </select><br><br>
                            </div>                                    
                        </div>                        
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button"  class="btn btn-alt-success"   onclick="Editar_Usuario_Alumno();" data-dismiss="modal">
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
    listar_alumno();
    listar_opcion_extraescolar_busqueda();    
    listar_opcion_extraescolar();        
    listar_opcion_carrera();
    listar_opcion_semestre();
    $('.js-example-basic-single').select2();
} );
</script>




<script>
document.getElementById('REG_ALU_CORREO').addEventListener('input',function(){
    campo=event.target;
    emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    if(emailRegex.test(campo.value)){
        $(this).css("border","");
        $("#validacion_correo").html(" ");
        $("#validar_correo").val("correcto");
    }else{
        $(this).css("border","1px solid red");
        $("#validacion_correo").html("Correo electrónico inválido");
        $("#validar_correo").val("incorrecto");
    }
});
</script>

<script>
document.getElementById('EDIT_ALU_CORREO').addEventListener('input',function(){
    campo=event.target;
    emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    if(emailRegex.test(campo.value)){
        $(this).css("border","");
        $("#editar_validacion_correo").html(" ");
        $("#editar_validar_correo").val("correcto");
    }else{
        $(this).css("border","1px solid red");
        $("#editar_validacion_correo").html("Correo electrónico inválido");
        $("#editar_validar_correo").val("incorrecto");
    }
});
</script>
