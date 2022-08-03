<?php
// Método de inicio de sesión de los usuarios
session_start();
if(isset($_SESSION['SES_VAR_ADM_ID_ADMINISTRADOR'])){
	header('Location: ./../../../extraescolares_itpachuca/sistema/vista/index.php');
}
?>

<!DOCTYPE html>
<html lang="es" class="no-focus">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <title>TECNM|Campus Pachuca|Sistema Integral Departamento de Actividades Extraescolares </title>
    <link rel="icon" href="../public/assets/ico/itp.png">
    <link rel="stylesheet" id="css-main" href="../public/assets/css/codebase.min.css">
</head>

<body>
    <div id="page-container" class="main-content-boxed">
        <main id="main-container">
            <div class="bg-gd-dusk">
                <div class="hero-static content content-full bg-white invisible" data-toggle="appear">
                    <!-- ENCABEZADO DE LOGIN -->
                    <div style="padding-top: 5px!important;" class="py-30 px-5 text-center">
                        <a class="link-effect font-w700" href="../../index.php">
                            <span class="font-size-xl text-primary-dark">TECNOLÓGICO NACIONAL DE MÉXICO</span><span class="font-size-xl"> CAMPUS PACHUCA</span>
                        </a>
                        <h1 style="margin-top: 5px!important;" class="h2 font-w700 mt-50 mb-10">SISTEMA INTEGRAL DEPARTAMENTO DE ACTIVIDADES EXTRAESCOLARES</h1>
                        <h2 class="h4 font-w400 text-muted mb-0">Ingrese sus datos</h2>
                    </div>

                    <div class="row">
                        <!-- INICIO CONTENEDOR IMAGEN -->
                        <div class="col-md-6 col-xl-6">
                            <div class="block">
                                <div class="block-content">
                                    <div class="login100-pic js-tilt" data-tilt=""
                                        style=" will-change: transform; transform: perspective(300px) rotateX(1.23deg) rotateY(-2.44deg) scale3d(1.1, 1.1, 1.1);">
                                        <img src="../public/assets/img/login/tec.png" alt="IMG">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- FIN CONTENEDOR IMAGEN -->

                        <!-- INICIO CONTENEDOR FORMULARIO -->
                        <div class="col-md-6 col-xl-6">
                            <div class="block">
                                <div class="block-content">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <!-- ITEM ALUMNOS --
                                        <li hidden class="nav-item">
                                            <a  class="nav-link active link-effect font-size-xl" id="apartado1-tab" data-toggle="tab" href="#apartado1" role="tab" aria-controls="apartado1" aria-selected="false"> <span class="font-size-xl">ALUMNOS</span></a>
                                        </li>
                                        -- ITEM PROMOTORES --
                                        <li hidden class="nav-item">
                                            <a class="nav-link link-effect font-size-xl" id="apartado2-tab" data-toggle="tab" href="#apartado2" role="tab" aria-controls="apartado2" aria-selected="false"><span class="font-size-xl">PROMOTORES</span></a>
                                        </li>
                                        -- ITEM ADMINISTRADORES -->
                                        <li class="nav-item">
                                            <a class="nav-link active link-effect font-size-xl" id="apartado3-tab" data-toggle="tab" href="#apartado3" role="tab" aria-controls="apartado3" aria-selected="true"><span class="font-size-xl">ADMINISTRADORES</span></a>
                                        </li>
                                    </ul>


                                <!-- CONTENIDO DE TABS -->
                                    <div class="tab-content" id="myTabContent">
                                    <!-- CONTENIDO ALUMNO -->
                                        <div hidden class="tab-pane fade" id="apartado1" role="tabpanel" aria-labelledby="apartado1-tab">
                                            <!-- INICIO CONTENEDOR FORMULARIO -->
                                            <div class="col-md-12 col-xl-12">
                                                <div class="block">
                                                    <div class="block-content">
                                                        <!-- Correo del alumno -->
                                                        <div class="form-group row">
                                                            <div class="col-12">
                                                                <div class="form-material floating">
                                                                    <p></p>
                                                                    <input type="text" class="form-control" id="ALU_USUARIO_LOGIN" name="ALU_CORREO_LOGIN">
                                                                    <label for="ALU_CORREO_LOGIN">NÚMERO DE CONTROL O CORREO INSTITUCIONAL</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Contraseña del alumno -->
                                                        <div class="form-group row">
                                                            <div class="col-12">
                                                                <div class="form-material floating">
                                                                    <p></p>
                                                                    <input type="password" class="form-control" id="ALU_CONTRASENA_LOGIN" name="ALU_CONTRASENA_LOGIN">
                                                                    <label for="USU_CONTRASENA">CONTRASEÑA</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Grupo de botones -->
                                                        <div class="form-group row gutters-tiny">
                                                            <div class="col-12 mb-10">
                                                                <button onclick="VerificarAlumno()" class="btn btn-block btn-hero btn-noborder btn-rounded btn-alt-success">
                                                                    <i class="si si-login mr-10"></i>ACCEDER
                                                                </button>
                                                            </div>
                                                            <!--
                                                                        <div class="col-sm-6 mb-5">
                                                                            <a class="btn btn-block btn-noborder btn-rounded btn-alt-secondary" href="op_auth_signup.html">
                                                                                <i class="fa fa-plus text-muted mr-5"></i> Crear cuenta
                                                                            </a>
                                                                        </div>
                                                                     
                                                            <div class="col-sm-12 mb-5">
                                                                <a class="btn btn-block btn-noborder btn-rounded btn-alt-primary" href="../../index.php#home">
                                                                    <i class="si si-action-undo fa-2xo text-muted mr-0 "></i> Regresar a página principal
                                                                </a>                                                                
                                                            </div>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- FIN CONTENEDOR FORMULARIO -->
                                        </div>
                                    <!-- FIN CONTENIDO ALUMNO -->

                                     <!-- CONTENIDO PROMOTOR -->
                                        <div hidden class="tab-pane fade" id="apartado2" role="tabpanel" aria-labelledby="apartado2-tab">
                                            <!-- INICIO CONTENEDOR FORMULARIO -->
                                            <div class="col-md-12 col-xl-12">
                                                <div class="block">
                                                    <div class="block-content">
                                                        <!-- Usuario o correo del promotor -->
                                                        <div class="form-group row">
                                                            <div class="col-12">
                                                                <div class="form-material floating">
                                                                    <p></p>
                                                                    <input type="text" class="form-control" id="PRO_USUARIO_LOGIN" name="PRO_CORREO_LOGIN">
                                                                    <label for="PRO_CORREO_LOGIN">USUARIO O CORREO ELECTRÓNICO</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Contraseña del alumno -->
                                                        <div class="form-group row">
                                                            <div class="col-12">
                                                                <div class="form-material floating">
                                                                    <p></p>
                                                                    <input type="password" class="form-control" id="PRO_CONTRASENA_LOGIN" name="PRO_CONTRASENA_LOGIN">
                                                                    <label for="USU_CONTRASENA">CONTRASEÑA</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Grupo de botones -->
                                                        <div class="form-group row gutters-tiny">
                                                            <div class="col-12 mb-10">
                                                                <button onclick="VerificarPromotor()" class="btn btn-block btn-hero btn-noborder btn-rounded btn-alt-success">
                                                                    <i class="si si-login mr-10"></i>ACCEDER
                                                                </button>
                                                            </div>
                                                            <!--
                                                                        <div class="col-sm-6 mb-5">
                                                                            <a class="btn btn-block btn-noborder btn-rounded btn-alt-secondary" href="op_auth_signup.html">
                                                                                <i class="fa fa-plus text-muted mr-5"></i> Crear cuenta
                                                                            </a>
                                                                        </div>
                                                                        
                                                            <div class="col-sm-12 mb-5">
                                                                <a class="btn btn-block btn-noborder btn-rounded btn-alt-primary" href="../../index.php#home">
                                                                    <i class="si si-action-undo fa-2xo text-muted mr-0 "></i> Regresar a página principal
                                                                </a>                                                                
                                                            </div>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- FIN CONTENEDOR FORMULARIO -->
                                        </div>
                                    <!-- FIN CONTENIDO PROMOTOR -->

                                     <!-- CONTENIDO ADMINISTRADOR -->
                                        <div class="tab-pane fade show active" id="apartado3" role="tabpanel" aria-labelledby="apartado3-tab">
                                            <!-- INICIO CONTENEDOR FORMULARIO -->
                                            <div class="col-md-12 col-xl-12">
                                                <div class="block">
                                                    <div class="block-content">
                                                        <!-- Correo del alumno -->
                                                        <div class="form-group row">
                                                            <div class="col-12">
                                                                <div class="form-material floating">
                                                                    <p></p>
                                                                    <input type="text" class="form-control" id="ADM_USUARIO_LOGIN" name="ADM_CORREO_LOGIN">
                                                                    <label for="ADM_CORREO_LOGIN">USUARIO O CORREO ELECTRÓNICO</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Contraseña del alumno -->
                                                        <div class="form-group row">
                                                            <div class="col-12">
                                                                <div class="form-material floating">
                                                                    <p></p>
                                                                    <input type="password" class="form-control" id="ADM_CONTRASENA_LOGIN" name="ADM_CONTRASENA_LOGIN">
                                                                    <label for="ADM_CONTRASENA_LOGIN">CONTRASEÑA</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Grupo de botones -->
                                                        <div class="form-group row gutters-tiny">
                                                            <div class="col-12 mb-10">
                                                                <button onclick="VerificarAdministrador()" class="btn btn-block btn-hero btn-noborder btn-rounded btn-alt-success">
                                                                    <i class="si si-login mr-10"></i>ACCEDER
                                                                </button>
                                                            </div>
                                                            <!--
                                                                        <div class="col-sm-6 mb-5">
                                                                            <a class="btn btn-block btn-noborder btn-rounded btn-alt-secondary" href="op_auth_signup.html">
                                                                                <i class="fa fa-plus text-muted mr-5"></i> Crear cuenta
                                                                            </a>
                                                                        </div>
                                                                        
                                                            <div class="col-sm-12 mb-5">
                                                                <a class="btn btn-block btn-noborder btn-rounded btn-alt-primary" href="../../index.php#home">
                                                                    <i class="si si-action-undo fa-2xo text-muted mr-0 "></i> Regresar a página principal
                                                                </a>                                                                
                                                            </div>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- FIN CONTENEDOR FORMULARIO -->
                                        </div>
                                    <!-- FIN CONTENIDO ADMINISTRADOR -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

<!-- Inicio modal recuperación de contraseña de usuarios administradores -->
    <form autocomplete="false" onSubmit="return false">
        <div class="modal fade " id="modal_recuperar_contrasena" role="dialog"   data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-fromright modal-lg">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary">
                            <h3 class="block-title">RECUPERAR CONTRASEÑA</h3>
                            <div class="block-options">
                                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                        <i class="si si-close"></i>
                                    </button>
                            </div>
                        </div>
                                <div class="container row" style="margin-right:0px; margin-left:0px; padding-top:10px;">
                                    <br>
                                    <div class="col-md-12">
                                        <label for="">Ingrese su correo electrónico para recuperar su contraseña:</label>
                                        <input  type="email" class="form-control" id="REC_CORREO_USUARIO_ADMINISTRADOR" placeholder="Correo electrónico"><br>
                                        
                                    </div>               
                                </div>                   
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-alt-danger" data-dismiss="modal">Cancelar</button>
                            <button type="button"  class="btn btn-alt-success"   onclick="Restablecer_Contrasena_Usuario_Administrador()" data-dismiss="modal">
                            <i class="fa fa-check"></i> ACEPTAR 
                        </button>
                    </div>
                </div>
            </div>         
        </div>
    </form>
<!-- Fin modal edición de usuarios administradores -->

    <script src="./login/vendor/jquery/jquery-3.2.1.min.js"> </script>
    <script src="./login/vendor/tilt/tilt.jquery.min.js"> </script>
    <script src="../public/assets/js/core/jquery.min.js"> </script>
    <script src="../public/assets/js/core/popper.min.js"> </script>
    <script src="../public/assets/js/core/bootstrap.min.js"> </script>
    <script src="../public/assets/js/core/jquery.slimscroll.min.js"></script>
    <script src="../public/assets/js/core/jquery.scrollLock.min.js"></script>
    <script src="../public/assets/js/core/jquery.appear.min.js"> </script>
    <script src="../public/assets/js/core/jquery.countTo.min.js"> </script>
    <script src="../public/assets/js/core/js.cookie.min.js"> </script>
    <script src="../public/assets/js/codebase.js"> </script>

    <script src="../js/sweetalert2.js"> </script>
    <script src="../js/administrador.js"> </script>
    <script src="../js/promotor.js"> </script>
    <script src="../js/alumno.js"> </script>
    <script src="../js/extraescolar.js"> </script>
    <script src="../js/inscripcion.js"> </script>
    <script src="../js/acreditacion.js"> </script>

    <script src="../public/assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="../public/assets/js/pages/op_auth_signin.js"></script>
    <script src="../vista/sweetalert2/sweetalert2.js"></script>

</body>

</html>