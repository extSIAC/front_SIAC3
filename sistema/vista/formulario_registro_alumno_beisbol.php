
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

        <meta name="description" content="Sistema integral Departamento de Actividades Extraescolares Campus Pachuca">
        <meta name="author" content="Julio Martínez Zarco ">
        <title>TECNM|Campus Pachuca|Sistema Integral Departamento de Actividades Extraescolares </title>
        <link rel="icon" href="../public/assets/ico/itp.png">
        <link rel="stylesheet" id="css-main" href="../public/assets/css/codebase.min.css">
        <link rel="stylesheet" href="./datatables/datatables.min.css"/>
        <link rel="stylesheet" href="./select2/select2.min.css"/>

    </head>
<body>
         <script type="text/javascript" src="../../../../extraescolares_itpachuca/sistema/js/administrador.js?rev=<?php echo time();?>"></script>
           
 <div id="page-container" class="sidebar-o side-scroll page-header-modern" style="padding-left: 0px;">

            <main id="main-container" style="background-color: #ffffff;">
                <div class="content" style="margin-left: 0px; margin-right: 0px;padding-left: 0px;padding-right: 0px; background-color: #ffffff;">
                    <div class="block">
     
                        <div class="block-content block-content-full border-0">


                        <div class="row" style="margin-right:0px; margin-left:0px; ; width:100%">
                            <br>
                            <div class="col-md-6">
                                <label for="">Nombre(s):</label>
                                <input autocomplete="off" onpaste="return false;" type="text" class="form-control" id="REG_ALU_NOMBRE" onkeyup="mayus(this);" onkeypress="return Solo_Letras(event)" maxlength="35" placeholder="Ingrese nombre(s)"><br>
                            </div>
                            <div class="col-md-6">
                                <label for="">Apellido paterno:</label>
                                <input autocomplete="off" onpaste="return false;" type="text" class="form-control" id="REG_ALU_APELLIDO_PATERNO" onkeyup="mayus(this);" onkeypress="return Solo_Letras(event)" maxlength="35" placeholder="Ingrese apellido paterno"><br>
                            </div>
                            <div class="col-md-6">
                                <label for="">Apellido materno:</label>
                                <input autocomplete="off" onpaste="return false;" type="text" class="form-control" id="REG_ALU_APELLIDO_MATERNO" onkeyup="mayus(this);" onkeypress="return Solo_Letras(event)" maxlength="35" placeholder="Ingrese apellido materno"><br>
                            </div>
                          <div class="col-md-6">
                                <label for="">Número de control:</label>
                                <input autocomplete="off" onpaste="return false;" type="text" class="form-control" id="REG_ALU_NUMERO_CONTROL" onkeypress="return Solo_Numeros(event)" minlength="8" maxlength="8" placeholder="Ingrese su número de control"><br>
                            </div>
                            <div class="col-md-6">
                                <label for="">Carrera:</label>
                                <select autocomplete="off" onpaste="return false;" class="js-example-basic-single form-control" name="state" id="opcion_carrera" style="width:100%;" >
                                </select><br><br>
                            </div>     
                            <div class="col-md-6">
                                <label for="">Semestre:</label>
                                <select autocomplete="off" onpaste="return false;" class="js-example-basic-single form-control" name="state" id="opcion_semestre" style="width:100%;" >
                                </select><br><br>
                            </div>     
                            <div class="col-md-3">
                                <label for="">Edad:</label>
                                <input autocomplete="off" onpaste="return false;" type="number" min="17" max="80" class="form-control" maxlength="2" onkeypress="return Solo_Numeros(event)" id="REG_ALU_EDAD"><br>
                            </div>
                            <div class="col-md-3">
                                <label for="">Sexo:</label>
                                <select autocomplete="off" onpaste="return false;" class="js-example-basic-single form-control" name="state" id="REG_ALU_SEXO" style="width:100%;" >
                                    <option value="">Seleccionar sexo</option>    
                                    <option value="M">MASCULINO</option>
                                    <option value="F">FEMENINO</option>
                                </select><br><br>
                            </div>
                            <div class="col-md-6">
                                <label for="">Teléfono:</label>
                                <input autocomplete="off" onpaste="return false;" type="text" class="form-control" id="REG_ALU_TELEFONO" maxlength="12"  minlength="8" onkeypress="return Solo_Numeros(event)" placeholder="Ingrese número de teléfono"><br>
                            </div>
                            <div class="col-md-6">
                                <label for="">Correo electrónico:</label>
                                <input autocomplete="off" onpaste="return false;" type="email" class="form-control" id="REG_ALU_CORREO" maxlength="50" placeholder="Ingrese correo electrónico institucional (lxxxxxxxx@pachuca.tecnm.mx)">
                                <label id="validacion_correo" style="color: red;"></label>
                                <input disabled id="validar_correo" type="text" hidden>
                            </div>
     
                            <div class="col-md-6">
                                <label for="">Extraescolar a inscribirse:</label>
                                <select autocomplete="off" onpaste="return false;" class="js-example-basic-single form-control" name="state" id="opcion_extraescolar" style="width:100%;" >
                                </select><br><br>
                            </div>      
                        </div>     

                        </div>
                    <div class="modal-footer">
                        <button type="button"  class="btn btn-alt-success"   onclick="Registrar_Usuario_Alumno();" data-dismiss="modal">
                            <i class="fa fa-check"></i> ACEPTAR
                        </button>
                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </main>

        </div>






        <script src="../public/assets/js/core/jquery.min.js"></script>
        <script src="../public/assets/js/core/popper.min.js"></script>
        <script src="../public/assets/js/core/bootstrap.min.js"></script>
        <script src="../public/assets/js/core/jquery.slimscroll.min.js"></script>
        <script src="../public/assets/js/core/jquery.scrollLock.min.js"></script>
        <script src="../public/assets/js/core/jquery.appear.min.js"></script>
        <script src="../public/assets/js/core/jquery.countTo.min.js"></script>
        <script src="../public/assets/js/core/js.cookie.min.js"></script>
        <script src="../public/assets/js/codebase.js"></script>

        <script src="../public/assets/js/plugins/chartjs/Chart.bundle.min.js"></script>
        <script src="../public/assets/js/pages/be_pages_dashboard.js"></script>
        <script src="./datatables/datatables.min.js"></script>
        <script src="./select2/select2.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../js/administrador.js"></script>
        <script src="../js/htmlToCanvas.js"></script>

        <script>TraerDatosUsuario();</script>

     <script>
$(document).ready(function() {
    listar_opcion_extraescolar_busqueda();   
    listar_opcion_extraescolar_beisbol();        
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


    </body>
</html>