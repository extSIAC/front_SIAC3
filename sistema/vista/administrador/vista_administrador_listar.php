<script type="text/javascript" src="../../../../extraescolares_itpachuca/sistema/js/administrador.js?rev=<?php echo time();?>"></script>



<div class="col-12">
    <div class="block block-themed">
        <div class="block-header block-header-default">
            <h1 class="block-title"><b>ADMINISTRADORES</b></h1>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle">  <i class="si si-size-fullscreen"></i>           </button>
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="pinned_toggle">      <i class="si si-pin"></i>                       </button>
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                </div>
        </div>

        <div class="block-content">
            <div class="container row" style="margin-right:0px; margin-left:0px; padding-top:10px;">
                <div class="col-lg-8">  
                    <input type="text" class="global_filter form-control" id="global_filter" onkeyup="mayus(this);" placeholder="Buscar registro administrador" >  <br>   
                </div>

                <div class="col-lg-4">
                    <button type="button" class="btn btn-alt-success " style="width:100%" data-toggle="modal" data-target="#modal_registro_administrador_adm"><i class="glyphicon glyphicon-plus"></i>NUEVO REGISTRO</button> <br>  
                </div>
       

                <div class="col-lg-12">  
                    <p><b>Oprima el símbolo "+" para ver las acciones disponibles al registro seleccionado.</b></p>
                </div>           
            </div>
            <div id="capturar" class="block">
                <table id="tabla_administrador" class="text-center hidden dataTables_wrapper dt-bootstrap4 no-footer display responsive table-bordered table-vcenter" style="width:100%; font-size:11px">
                    <thead>
                        <tr>
                            <th style="width:10px"> </th>
                            <th style="width:10px"> PATERNO</th>
                            <th style="width:10px"> MATERNO</th>
                            <th style="width:10px"> NOMBRE</th>
                            <th style="width:5px">  EDAD</th>
                            <th style="width:10px"> SEXO</th>
                            <th style="width:10px"> TELEFONO</th>
                            <th style="width:10px"> CORREO</th>
                            <th style="width:10px"> USUARIO</th>
                            <th style="width:10px"> TIPO DE USUARIO</th>
                            <th style="width:10px"> TIPO DE EXTRAESCOLAR</th>
                            <th style="width:10px"> ESTADO</th>
                            <th style="width:10px"> ACCIONES</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Inicio modal registro de usuarios administradores -->
    <form autocomplete="false" onSubmit="return false">
        <div class="modal fade " id="modal_registro_administrador_adm" role="dialog"   data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-fromright modal-lg ">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary">
                            <h3 class="block-title">REGISTRO DE ADMINISTRADOR</h3>
                            <div class="block-options">
                                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                        <i class="si si-close"></i>
                                    </button>
                                </div>
                        </div>
                        <div class="container row" style="margin-right:0px; margin-left:0px; padding-top:10px;">
                            <br>
                            <div class="col-md-12">
                                <label for="">Nombre(s):</label>
                                <input autocomplete="off" type="text" onpaste="return false;" class="form-control" id="REG_ADM_NOMBRE"  onkeyup="mayus(this);" onkeypress="return Solo_Letras(event)" maxlength="35" placeholder="Ingrese nombre(s)"><br>
                            </div>
                            <div class="col-md-6">
                                <label for="">Apellido paterno:</label>
                                <input autocomplete="off" type="text" class="form-control" id="REG_ADM_APELLIDO_PATERNO" onkeyup="mayus(this);" onkeypress="return Solo_Letras(event)"  maxlength="35" placeholder="Ingrese apellido paterno"><br>
                            </div>
                            <div class="col-md-6">
                                <label for="">Apellido materno:</label>
                                <input autocomplete="off" type="text" class="form-control" id="REG_ADM_APELLIDO_MATERNO" onkeyup="mayus(this);" onkeypress="return Solo_Letras(event)" maxlength="35" placeholder="Ingrese apellido materno"><br>
                            </div>
                            <div class="col-md-3">
                                <label for="">Edad:</label>
                                <input autocomplete="off" type="number" min="17" max="80" class="form-control" onkeypress="return Solo_Numeros(event)" maxlength="2" id="REG_ADM_EDAD"><br>
                            </div>
                            <div class="col-lg-3">
                                <label for="">Sexo:</label>
                                <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="REG_ADM_SEXO" style="width:100%;" >
                                    <option value="M">MASCULINO</option>
                                    <option value="F">FEMENINO</option>
                                </select><br><br>
                            </div>
                            <div class="col-md-6">
                                <label for="">Teléfono:</label>
                                <input autocomplete="off" type="text" class="form-control" id="REG_ADM_TELEFONO" onkeypress="return Solo_Numeros(event)" maxlength="12" placeholder="Ingrese número de teléfono"><br>
                            </div>
                            <div class="col-md-6">
                                <label for="">Correo electrónico:</label>
                                <input autocomplete="off" type="email" class="form-control" id="REG_ADM_CORREO" maxlength="50" placeholder="Ingrese correo electrónico">
                                <label id="validacion_correo" style="color: red;"></label>
                                <input disabled id="validar_correo" type="text" hidden>
                            </div>
                            <div class="col-md-6">
                                <label for="">Nombre de usuario:</label>
                                <input autocomplete="off" type="text" class="form-control" id="REG_ADM_USUARIO" onkeyup="mayus(this);" onkeypress="return Solo_Letras(event)"  maxlength="30" placeholder="Ingrese nombre de usuario"><br>
                            </div>
                            <div class="col-md-3">
                                <label for="">Contraseña:</label>
                                <input autocomplete="off" type="password" class="form-control" id="REG_ADM_CONTRASENA1" placeholder="Ingrese contraseña"><br>
                            </div>
                            <div class="col-md-3">
                                <label for="">Repita la contraseña:</label>
                                <input autocomplete="off" type="password" class="form-control" id="REG_ADM_CONTRASENA2" placeholder="Repita contrase&ntilde;a"><br>
                            </div>
                            <div class="col-lg-6 ">
                                <label for="">Tipo de extraescolar:</label>
                                <select autocomplete="off" class="js-example-basic-single form-control" name="state" id="opcion_tipo_extraescolar_adm" style="width:100%;">
                                </select><br><br>
                            </div>
                        
                        </div>                   
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button"  class="btn btn-alt-success"   onclick="Registrar_Usuario_Administrador();" data-dismiss="modal">
                            <i class="fa fa-check"></i> Registrar
                        </button>
                    </div>
                </div>
            </div>         
        </div>
    </form>
<!-- Fin modal registro de usuarios administradores -->

<!-- Inicio modal edición de usuarios administradores -->
    <form autocomplete="false" >
        <div class="modal fade " id="modal_editar_administrador" role="dialog"   data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-fromright modal-lg ">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary">
                            <h3 class="block-title">EDITAR USUARIO ADMINISTRADOR</h3>
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
                                <input disabled type="text" name="EDIT_ADM_ID_ADMINISTRADOR" class="form-control disable" id="EDIT_ADM_ID_ADMINISTRADOR" maxlength="30" ><br>
                            </div>
                            <div class="col-md-4">
                                <label for="">Nombre de usuario:</label>
                                <input disabled type="text" class="form-control disable" id="EDIT_ADM_USUARIO"  maxlength="30" ><br>
                            </div>
                            <div class="col-md-6">
                                <label for="">Nombre(s):</label>
                                <input type="text" class="form-control" id="EDIT_ADM_NOMBRE" maxlength="35" onkeyup="mayus(this);" onkeypress="return Solo_Letras(event)"  placeholder="Ingrese nombre(s)"><br>
                            </div>
                            <div class="col-md-6">
                                <label for="">Apellido paterno:</label>
                                <input type="text" class="form-control" id="EDIT_ADM_APELLIDO_PATERNO" maxlength="35" onkeyup="mayus(this);" onkeypress="return Solo_Letras(event)" placeholder="Ingrese apellido paterno"><br>
                            </div>
                            <div class="col-md-6">
                                <label for="">Apellido materno:</label>
                                <input type="text" class="form-control" id="EDIT_ADM_APELLIDO_MATERNO" maxlength="35" onkeyup="mayus(this);" onkeypress="return Solo_Letras(event)" placeholder="Ingrese apellido materno"><br>
                            </div>
                            <div class="col-md-3">
                                <label for="">Edad:</label>
                                <input type="number" min="17" max="80" class="form-control" maxlength="2" onkeypress="return Solo_Numeros(event)" id="EDIT_ADM_EDAD"><br>
                            </div>
                            <div class="col-lg-3">
                                <label for="">Sexo:</label>
                                <select class="js-example-basic-single form-control" name="state" id="EDIT_ADM_SEXO" style="width:100%;" placeholder="asd" >
                                    <option value="M">MASCULINO</option>
                                    <option value="F">FEMENINO</option>
                                </select><br><br>
                            </div>
                            <div class="col-md-6">
                                <label for="">Teléfono:</label>
                                <input type="text" class="form-control" id="EDIT_ADM_TELEFONO" onkeypress="return Solo_Numeros(event)" maxlength="12" placeholder="Ingrese número de teléfono"><br>
                            </div>
                            <div class="col-md-6">
                                <label for="">Correo electrónico:</label>
                                <input type="email" class="form-control" id="EDIT_ADM_CORREO" maxlength="50" placeholder="Ingrese correo electrónico">
                                <label id="editar_validacion_correo" style="color: red;"></label>
                                <input disabled id="editar_validar_correo" type="text" hidden>
                            </div>
                            <div class="col-lg-6 ">
                                <label for="">Tipo de extraescolar:</label>
                                <select class="js-example-basic-single form-control" name="state" id="opcion_tipo_extraescolar_adm_editar" style="width:100%;">
                                </select><br><br>
                            </div>
                        
                        </div>                   
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button"  class="btn btn-alt-success"  onclick="Editar_Usuario_Administrador();" data-dismiss="modal">
                            <i class="fa fa-check"></i>Modificar
                        </button>
                    </div>
                </div>
            </div>         
        </div>
    </form>
<!-- Fin modal edición de usuarios administradores -->


<script>
$(document).ready(function() {
    listar_administrador();
    $('.js-example-basic-single').select2();
    listar_opcion_tipo_usuario();
    listar_opcion_tipo_extraescolar();    
    listar_opcion_tipo_extraescolar_adm();    
} );
</script>

<script type="text/javascript">
		$(document).ready(function(){
			$('#btnimgGraficaBarras').click(function(){
				tomarImagenPorSeccion('capturar','capturar');
			});

			$('#btnImgGraficaPastel').click(function(){
				tomarImagenPorSeccion('capturar','capturara');
			});
		});
	</script>


<script>
document.getElementById('REG_ADM_CORREO').addEventListener('input',function(){
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
document.getElementById('EDIT_ADM_CORREO').addEventListener('input',function(){
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
