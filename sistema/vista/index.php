<?php
session_start();
if(!isset($_SESSION['SES_VAR_ADM_ID_ADMINISTRADOR'])){
	header('Location: ./../../../extraescolares_itpachuca/sistema/vista/login.php');
}
?>

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

 
        <div id="page-container" class="sidebar-mini sidebar-o side-scroll page-header-classic main-content-boxed ">
            <header id="page-header">
                <div class="content-header">
                    
                    <div class="content-header-section">
                        <input hidden disabled type="text" id="ID_USUARIO_PRINCIPAL" value="<?php echo $_SESSION['SES_VAR_ADM_ID_ADMINISTRADOR'] ?>">
                        <input hidden disabled type="text" id="USUARIO_PRINCIPAL" value="<?php echo $_SESSION['SES_VAR_ADM_USUARIO']     ?>">
                    <!-- BOTÓN DESPLAZAMIENTO DE BARRA DE NAVEGACIÓN -->
                        <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="sidebar_toggle">
                            <i class="fa fa-navicon"></i>
                        </button>
                   
                              
                               
                        <!-- ELECCIÓN DE COLOR -->
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-circle btn-dual-secondary" id="page-header-themes-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-paint-brush"></i>
                            </button>
                            <div class="dropdown-menu min-width-150" aria-labelledby="page-header-themes-dropdown">
                                <h6 class="dropdown-header text-center">Cambiar colores del tema</h6>
                                <div class="row no-gutters text-center mb-5">
                                    <div class="col-4 mb-5">
                                        <a class="text-default" data-toggle="theme" data-theme="default" href="javascript:void(0)">
                                            <i class="fa fa-2x fa-circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-4 mb-5">
                                        <a class="text-elegance" data-toggle="theme" data-theme="../public/assets/css/themes/elegance.min.css" href="javascript:void(0)">
                                            <i class="fa fa-2x fa-circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-4 mb-5">
                                        <a class="text-pulse" data-toggle="theme" data-theme="../public/assets/css/themes/pulse.min.css" href="javascript:void(0)">
                                            <i class="fa fa-2x fa-circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-4 mb-5">
                                        <a class="text-flat" data-toggle="theme" data-theme="../public/assets/css/themes/flat.min.css" href="javascript:void(0)">
                                            <i class="fa fa-2x fa-circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-4 mb-5">
                                        <a class="text-corporate" data-toggle="theme" data-theme="../public/assets/css/themes/corporate.min.css" href="javascript:void(0)">
                                            <i class="fa fa-2x fa-circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-4 mb-5">
                                        <a class="text-earth" data-toggle="theme" data-theme="../public/assets/css/themes/earth.min.css" href="javascript:void(0)">
                                            <i class="fa fa-2x fa-circle"></i>
                                        </a>
                                    </div>
                                </div>
                                <div>
                                </div>
                            </div>
                        </div>
                        <!-- FIN DE ELECCIÓN DE COLOR -->
                    </div>
                    <!-- SECCIÓN DE USUARIO -->
                    <div class="content-header-section">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-rounded btn-dual-secondary " id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?php
                                            echo $_SESSION['SES_VAR_ADM_NOMBRE'];
                                            ?> -  
                                            <?php
                                            echo $_SESSION['SES_VAR_ADM_TIPUSU_TIPO_USUARIO'];
                                            ?> 
                                            <i class="fa fa-angle-down ml-5"></i>
                            </button>

                            <!-- MENÚ DE USUARIO -->
                            <div class="dropdown-menu dropdown-menu-right min-width-150" aria-labelledby="page-header-user-dropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" data-toggle="modal" data-target="#modal_configurar_cuenta">
                                    <i class="si si-wrench mr-5"></i> Configurar contraseña
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-primary" href="./../../../../extraescolares_itpachuca/sistema/controlador/administrador/controlador_cerrar_sesion_administrador.php">
                                    <i class="si si-logout mr-5"></i> CERRAR SESIÓN
                                </a>
                            </div>
                        </div>
                        <!-- FIN DE SECCIÓN DE USUARIO -->

                    </div>
                </div>

                <!-- Cargar barra de navegación -->
                <div id="page-header-loader" class="overlay-header bg-primary">
                    <div class="content-header content-header-fullrow text-center">
                        <div class="content-header-item">
                            <i class="fa fa-sun-o fa-spin text-white"></i>
                        </div>
                    </div>
                </div>
                <!-- Fin de cargar barra de navegación -->
            </header>


            <nav id="sidebar" style="width: 215px;">
                <div id="sidebar-scroll ">
                    <div class="sidebar-content">
                        <div class="content-header content-header-fullrow px-10">
                            <div class="content-header-section sidebar-mini-visible-b">
                              
                            <!-- ABREVIATURA ITP -->
                                <span class="content-header-item font-w700 font-size-xl float-left animated wobble">
                                    <span class="text-dual-primary-dark">I</span><span class="text-primary">TP</span>
                                </span>
                                <!-- FIN ABREVIATURA ITP -->
                            </div>
                        
                            <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                                <!-- TÍTULO NAV -->
                                    <a class="link-effect font-w1000">
                                        <span class="font-size-xs text-dual-primary-dark" >ACTIVIDADES </span><span class="font-size-xs text-primary">EXTRAESCOLARES</span>
                                    </a>
                                <div class="content-header-item">
                                    <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="sidebar_toggle">
                                        <i class="fa fa-arrow-left fa-x"></i>
                                    </button>
                                 </div>
                                <!-- FIN TÍTULO NAV -->
                            </div>
                        </div>
                            <div class="content-side content-side-full content-side-user px-10 align-parent">
                                <div class="sidebar-mini-visible-b align-v animated fadeIn">
                                    <img class="img-avatar img-avatar32" id="IMAGEN_USUARIO_MINI">
                                </div>

                                <div class="sidebar-mini-hidden-b text-center">
                                    <a class="img-link" href="javascript:void(0)">
                                     <img class="img-avatar" id="IMAGEN_USUARIO" >
                                </a>
                                    <ul class="list-inline mt-10">
                                        <li class="list-inline-item">
                                            <a class="link-effect text-primary font-size-xs font-w600 text-uppercase " href="javascript:void(0)"></a>
                                        </li>
                                        <li class="list-inline-item">
                                        <a class="link-effect text-primary" data-toggle="layout" ><b>
                                            <?php
                                            echo $_SESSION['SES_VAR_ADM_NOMBRE'];
                                            ?>
                                        </b></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="link-effect text-dual-primary-dark" href="op_auth_signin.html">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                    <!-- NAVEGACIÓN -->
                        <div class="content-side content-side-full" style="padding-top: 0px;">
                            <ul class="nav-main">
                                
                            
                                <li >
                                    <!-- MANDA A LLAMAR LA VISTA DEL CONTENEDOR PRINCIPAL DE USUARIO -->
                                    <a  href="index.php" style="padding-bottom: 0px; padding-top: 0px;"> <i class="si si-home fa-2x"></i><span class="sidebar-mini-hide" data-toggle="dropdown" data-action="sidebar_toggle" ><div class="dropdown-divider"></div>Inicio<div class="dropdown-divider"></div></span></a>
                                </li>
                                <li >
                                    <!-- MANDA A LLAMAR LA VISTA DEL CONTENEDOR PRINCIPAL DE USUARIO -->
                                    <a onclick="cargar_contenido('contenido_principal','administrador/vista_administrador_listar.php'); Codebase.loader('show', 'bg-primary-ligth');
                                        setTimeout(function () {
                                            Codebase.loader('hide');
                                        }, 200);" style="padding-bottom: 0px; padding-top: 0px;"> <i class="si si-screen-desktop fa-2x"></i><span style="cursor: pointer;" class="sidebar-mini-hide" data-toggle="dropdown" data-action="sidebar_toggle" ><div class="dropdown-divider"></div style="cursor: pointer;">Administradores<div class="dropdown-divider"></div></span></a>
                                </li>
                                <li >
                                    <!-- MANDA A LLAMAR LA VISTA DEL CONTENEDOR PRINCIPAL DE PROMOTORES -->
                                    <a onclick="cargar_contenido('contenido_principal','administrador/vista_promotor_listar.php'); Codebase.loader('show', 'bg-primary-ligth');
                                        setTimeout(function () {
                                            Codebase.loader('hide');
                                        }, 200);" style="padding-bottom: 0px; padding-top: 0px;"> <i class="si si-users fa-2x"></i><span style="cursor: pointer;" class="sidebar-mini-hide" data-toggle="dropdown" data-action="sidebar_toggle" ><div class="dropdown-divider"></div style="cursor: pointer;">Promotores<div class="dropdown-divider"></div></span></a>
                                </li>

                                <li >
                                    <!-- MANDA A LLAMAR LA VISTA DEL CONTENEDOR PRINCIPAL DE EXTRAESCOLARES -->
                                    <a onclick="cargar_contenido('contenido_principal','administrador/vista_extraescolar_listar.php'); Codebase.loader('show', 'bg-primary-ligth');
                                        setTimeout(function () {
                                            Codebase.loader('hide');
                                        }, 200);" style="padding-bottom: 0px; padding-top: 0px;"> <i class="si si-notebook fa-2x"></i><span style="cursor: pointer;" class="sidebar-mini-hide" data-toggle="dropdown" data-action="sidebar_toggle" ><div class="dropdown-divider"></div style="cursor: pointer;">EXTRAESCOLARES<div class="dropdown-divider"></div></span></a>
                                </li>
                                <li >
                                    <!-- MANDA A LLAMAR LA VISTA DEL CONTENEDOR PRINCIPAL DE HORARIOS -->
                                    <a onclick="cargar_contenido('contenido_principal','administrador/vista_extraescolar_horarios_listar.php'); Codebase.loader('show', 'bg-primary-ligth');
                                        setTimeout(function () {
                                            Codebase.loader('hide');
                                        }, 200);" style="padding-bottom: 0px; padding-top: 0px;"> <i class="si si-calendar fa-2x"></i><span style="cursor: pointer;" class="sidebar-mini-hide" data-toggle="dropdown" data-action="sidebar_toggle" ><div class="dropdown-divider"></div style="cursor: pointer;">HORARIOS<div class="dropdown-divider"></div></span></a>
                                </li>             
                                <li >
                                    <!-- MANDA A LLAMAR LA VISTA DEL CONTENEDOR PRINCIPAL DE ALUMNOS -->
                                    <a onclick="cargar_contenido('contenido_principal','administrador/vista_alumno_listar.php'); Codebase.loader('show', 'bg-primary-ligth');
                                        setTimeout(function () {
                                            Codebase.loader('hide');
                                        }, 200);" style="padding-bottom: 0px; padding-top: 0px;"> <i class="si si-graduation fa-2x"></i><span style="cursor: pointer;" class="sidebar-mini-hide" data-toggle="dropdown" data-action="sidebar_toggle" ><div class="dropdown-divider"></div style="cursor: pointer;">Alumnos<div class="dropdown-divider"></div></span></a>
                                </li>
                                <li >
                                    <!-- MANDA A LLAMAR LA VISTA DEL CONTENEDOR PRINCIPAL DE INSCRIPCIONES -->
                                    <a onclick="cargar_contenido('contenido_principal','administrador/vista_lista_asistencias_listar.php'); Codebase.loader('show', 'bg-primary-ligth');
                                        setTimeout(function () {
                                            Codebase.loader('hide');
                                        }, 200);" style="padding-bottom: 0px; padding-top: 0px;"> <i class="si si-note fa-2x"></i><span style="cursor: pointer;" class="sidebar-mini-hide" data-toggle="dropdown" data-action="sidebar_toggle" ><div class="dropdown-divider"></div style="cursor: pointer;">LISTAS DE ASISTENCIA<div class="dropdown-divider"></div></span></a>
                                </li>
                                <li >
                                    <!-- MANDA A LLAMAR LA VISTA DEL CONTENEDOR PRINCIPAL DE ACREDITACONES -->
                                    <a onclick="cargar_contenido('contenido_principal','administrador/vista_acreditacion_listar.php'); Codebase.loader('show', 'bg-primary-ligth');
                                        setTimeout(function () {
                                            Codebase.loader('hide');
                                        }, 200);" style="padding-bottom: 0px; padding-top: 0px;"> <i class="si si-badge fa-2x"></i><span style="cursor: pointer;" class="sidebar-mini-hide" data-toggle="dropdown" data-action="sidebar_toggle" ><div class="dropdown-divider"></div style="cursor: pointer;">Acreditaciones<div class="dropdown-divider"></div></span></a>
                                </li>
                                <!--<li >
                                    -- MANDA A LLAMAR LA VISTA DEL CONTENEDOR PRINCIPAL DE USUARIO -
                                    <a data-toggle="modal" data-target="#modal_gestor_archivos" style="padding-bottom: 0px; padding-top: 0px;"> <i class="si si-folder-alt fa-2x"></i><span data-toggle="modal" data-target="#modal_registro_administrador_adm" style="cursor: pointer;" class="sidebar-mini-hide" data-toggle="dropdown" data-action="sidebar_toggle" ><div class="dropdown-divider"></div  style="cursor: pointer;">GESTOR DE ARCHIVOS<div class="dropdown-divider"></div></span></a>
                                </li> -->
                                <li>
                                    <a  href="./../../../../extraescolares_itpachuca/sistema/controlador/administrador/controlador_cerrar_sesion_administrador.php"><i class="si si-logout"></i><span class="sidebar-mini-hide text-primary">Cerrar sesión</span></a>
                                </li>
                                


                        </div>
                        <!-- END Side Navigation -->
                    </div>
                    <!-- Sidebar Content -->
                </div>
                <!-- END Sidebar Scroll Container -->
            </nav>






            <!-- CONTENEDOR PRINCIPAL -->
            <main id="main-container-narrow">
                <!-- CONTENIDO -->
                <div class="content">
                    <div class="row" id="contenido_principal">

                        <div class="col-md-12">
                            <div class="block">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">SISTEMA INTEGRAL DEL DEPARTAMENTO DE ACTIVIDADES EXTRAESCOLARES</h3>


                                </div>
                                <div class="block-content">


                            </div>

                        </div>



                    </div>
                </div>
                <!-- FIN DE CONTENIDO -->
            </main>
            <!-- FIN DE CONTENEDOR PRINCIPAL -->


<!-- Inicio modal edición de usuarios administradores -->

        <div class="modal fade " id="modal_gestor_archivos" role="dialog"   data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-fromright modal-lg">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <iframe 
                            src="../box/index.php"  style="width:100%; height:400px; border:0;">
                        </iframe>                                  
                    </div>
                </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-alt-danger" data-dismiss="modal">Cerrar</button>
                        </button>
                    </div>
            </div>         
        </div>

<!-- Fin modal edición de usuarios administradores -->


<!-- Inicio modal edición de usuarios administradores -->
    <form autocomplete="false" onSubmit="return false">
        <div class="modal fade " id="modal_configurar_cuenta" role="dialog"   data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-fromright modal-lg">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary">
                            <h3 class="block-title">CONFIGURACIÓN DE LA CUENTA</h3>
                            <div class="block-options">
                                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                        <i class="si si-close"></i>
                                    </button>
                            </div>
                        </div>
                                <div class="container row" style="margin-right:0px; margin-left:0px; padding-top:10px;">
                                    <br>
                                    <div class="col-md-12">
                                        <input disabled type="text" id="EDITAR_CONTRASENA_ACTUAL_BD" hidden>
                                        <label for="">Contraseña actual:</label>
                                        <input  type="password" class="form-control" id="EDITAR_CONTRASENA_ACTUAL" placeholder="Introduzca contraseña actual"><br>
                                        
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Nueva contraseña:</label>
                                        <input  type="password" class="form-control" id="EDITAR_CONTRASENA_NUEVA" placeholder="Escriba nueva contraseña"><br>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Confirmar contraseña:</label>
                                        <input type="password" class="form-control" id="EDITAR_CONTRASENA_REPETIR" placeholder="Repita nueva contraseña"><br>
                                    </div>                     
                                </div>                   
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-alt-danger" data-dismiss="modal">Cancelar</button>
                            <button type="button"  class="btn btn-alt-success"   onclick="ConfigurarContrasenaUsuarioAdministrador();" data-dismiss="modal">
                            <i class="fa fa-check"></i>Modificar
                        </button>
                    </div>
                </div>
            </div>         
        </div>
    </form>
<!-- Fin modal edición de usuarios administradores -->





        
        <script src="../public/assets/js/core/jquery.min.js"></script>
        <script src="../public/assets/js/core/popper.min.js"></script>
        <script src="../public/assets/js/core/bootstrap.min.js"></script>
        <script src="../public/assets/js/core/jquery.slimscroll.min.js"></script>
        <script src="../public/assets/js/core/jquery.scrollLock.min.js"></script>
        <script src="../public/assets/js/core/jquery.appear.min.js"></script>
        <script src="../public/assets/js/core/jquery.countTo.min.js"></script>
        <script src="../public/assets/js/core/js.cookie.min.js"></script>
        <script src="../public/assets/js/codebase.js"></script>

<!-- Traer el contenido de las vistas -->
        <script>
            function cargar_contenido(contenedor, contenido) {
                $("#"+contenedor).load(contenido);
            }
        </script>

<script>$(document).ready(function() {
    $('#example').DataTable();
} );</script>
                                          

<script>
	var idioma_espanol = {
			select: {
			rows: "%d fila seleccionada"
			},
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ning&uacute;n dato disponible en esta tabla",
			"sInfo":           "Registros del (_START_ al _END_) total de _TOTAL_ registros",
			"sInfoEmpty":      "Registros del (0 al 0) total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "<b>No se encontraron datos</b>",
			"oPaginate": {
					"sFirst":    "Primero",
					"sLast":     "Último",
					"sNext":     "Siguiente",
					"sPrevious": "Anterior"
			},
			"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
	 }
</script>

        <script src="../public/assets/js/plugins/chartjs/Chart.bundle.min.js"></script>
        <script src="../public/assets/js/pages/be_pages_dashboard.js"></script>
        <script src="./datatables/datatables.min.js"></script>
        <script src="./select2/select2.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../js/administrador.js"></script>
        <script src="../js/htmlToCanvas.js"></script>

        <script>TraerDatosUsuario();</script>

    </body>
</html>