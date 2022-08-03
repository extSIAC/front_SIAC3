<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

        <meta name="description" content="Sistema integral Departamento de Actividades Extraescolares Campus Pachuca">
        <meta name="author" content="Julio Martínez Zarco ">

        <link rel="stylesheet" id="css-main" href="../..//public/assets/css/codebase.min.css">
        <link rel="stylesheet" href="../../datatables/datatables.min.css"/>
        <link rel="stylesheet" href="../../select2/select2.min.css"/>

<script type="text/javascript" src="../../../../extraescolares_itpachuca/sistema/js/administrador.js?rev=<?php echo time();?>"></script>

<div class="col-12">
    <div class="block block-themed">
        <div class="block-header block-header-default">
            <h1 class="block-title"><b>LISTAS DE ASISTENCIAS</b></h1>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle">  <i class="si si-size-fullscreen"></i>           </button>
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="pinned_toggle">      <i class="si si-pin"></i>                       </button>
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                </div>
        </div>

        <div class="block-content">
            

            <div class="container row" style="margin-right:0px; margin-left:0px; padding-top:10px;">
                <div class="col-lg-8">  
                    <br> 
                    <input type="text" class="global_filter form-control" id="global_filter_lista_asistencias" onkeyup="mayus(this);" placeholder="Buscar registro alumno" >  <br>   
                </div>
    
                    <div class="col-lg-4">                               
                        <label for="">FILTRAR POR EXTRAESCOLAR:</label>
                        <select autocomplete="off" class="js-example-basic-single form-control" name="filtrar_tipo_extraescolar" id="opcion_extraescolar_busqueda" onchange="filterGlobal_lista_asis();" style="width:100%;" >
                        </select><br>   
                    </div>
            </div>


            <div class="block">
                <table id="tabla_lista_asistencias_reporte" class="text-center hover table-primary dt-bootstrap4 no-footer display table-bordered " style="font-size:15px">
                    <thead>
                        <tr>
                            <th colspan="4"></th>
                            <th colspan="30" style="text-align:center;">ASISTENCIAS</th>
                            <th colspan="1"></th>
                        </tr>
                        <tr>
                            <th style="width:5px"> </th>
                            <th style="width:300px; height:50px; text-align:center;">NOMBRE DEL ALUMNO</th>
                            <th style="width:100px; text-align:center;">NO. CONTROL</th>
                            <th style="width:60px; text-align:center;">CARRERA</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>




  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
        <script src="../../public/assets/js/core/jquery.min.js"></script>
        <script src="../../public/assets/js/core/popper.min.js"></script>
        <script src="../../public/assets/js/core/bootstrap.min.js"></script>
        <script src="../../public/assets/js/core/jquery.slimscroll.min.js"></script>
        <script src="../../public/assets/js/core/jquery.scrollLock.min.js"></script>
        <script src="../../public/assets/js/core/jquery.appear.min.js"></script>
        <script src="../../public/assets/js/core/jquery.countTo.min.js"></script>
        <script src="../../public/assets/js/core/js.cookie.min.js"></script>
        <script src="../../public/assets/js/codebase.js"></script>

<script>
$(document).ready(function() {
    listar_lista_asistencias_reporte();
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





<!-- Traer el contenido de las vistas -->
        <script>
            function cargar_contenido(contenedor, contenido) {
                $("#"+contenedor).load(contenido);
            }

        </script>

        <!-- Page JS Plugins -->
        <script src="../../public/assets/js/plugins/chartjs/Chart.bundle.min.js"></script>
        <!-- Page JS Code -->
        <script src="../../public/assets/js/pages/be_pages_dashboard.js"></script>

          <script  src="../../datatables/datatables.min.js"></script>


    </body>
</html>