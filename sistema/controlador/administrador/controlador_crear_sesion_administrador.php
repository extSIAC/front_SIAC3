<?php
    $S_VAR_ADM_ID_ADMINISTRADOR             = $_POST['VAR_ADM_ID_ADMINISTRADOR'];                    
	$S_VAR_ADM_NOMBRE                       = $_POST['VAR_ADM_NOMBRE'];                                                
	$S_VAR_ADM_APELLIDO_PATERNO             = $_POST['VAR_ADM_APELLIDO_PATERNO'];                    
	$S_VAR_ADM_APELLIDO_MATERNO             = $_POST['VAR_ADM_APELLIDO_MATERNO'];                 
	$S_VAR_ADM_EDAD                         = $_POST['VAR_ADM_EDAD'];                                       
	$S_VAR_ADM_SEXO                         = $_POST['VAR_ADM_SEXO'];                                       
	$S_VAR_ADM_TELEFONO                     = $_POST['VAR_ADM_TELEFONO'];                              
	$S_VAR_ADM_CORREO_ELECTRONICO           = $_POST['VAR_ADM_CORREO_ELECTRONICO'];             
	$S_VAR_ADM_USUARIO                      = $_POST['VAR_ADM_USUARIO'];                                 
	$S_VAR_ADM_CONTRASENA                   = $_POST['VAR_ADM_CONTRASENA'];                           
	$S_VAR_ADM_TIPUSU_ID_TIPO_USUARIO       = $_POST['VAR_ADM_TIPUSU_ID_TIPO_USUARIO'];           
    $S_VAR_ADM_TIPUSU_TIPO_USUARIO          = $_POST['VAR_ADM_TIPUSU_TIPO_USUARIO'];            
    $S_VAR_ADM_TIPEXT_ID_TIPO_EXTRAESCOLAR  = $_POST['VAR_ADM_TIPEXT_ID_TIPO_EXTRAESCOLAR'];  
    $S_VAR_ADM_TIPEXT_TIPO_EXTRAESCOLAR     = $_POST['VAR_ADM_TIPEXT_TIPO_EXTRAESCOLAR'];   
    $S_VAR_ADM_ESTADO                       = $_POST['VAR_ADM_ESTADO'];                        


session_start();
    $_SESSION['SES_VAR_ADM_ID_ADMINISTRADOR']                = $S_VAR_ADM_ID_ADMINISTRADOR;                    
    $_SESSION['SES_VAR_ADM_NOMBRE']                         = $S_VAR_ADM_NOMBRE;                                                
    $_SESSION['SES_VAR_ADM_APELLIDO_PATERNO']               = $S_VAR_ADM_APELLIDO_PATERNO;                    
    $_SESSION['SES_VAR_ADM_APELLIDO_MATERNO']               = $S_VAR_ADM_APELLIDO_MATERNO;                 
    $_SESSION['SES_VAR_ADM_EDAD']                           = $S_VAR_ADM_EDAD;                                       
    $_SESSION['SES_VAR_ADM_SEXO']                           = $S_VAR_ADM_SEXO;                                       
    $_SESSION['SES_VAR_ADM_TELEFONO']                       = $S_VAR_ADM_TELEFONO;                              
    $_SESSION['SES_VAR_ADM_CORREO_ELECTRONICO']             = $S_VAR_ADM_CORREO_ELECTRONICO;             
    $_SESSION['SES_VAR_ADM_USUARIO']                        = $S_VAR_ADM_USUARIO;                                 
    $_SESSION['SES_VAR_ADM_CONTRASENA']                     = $S_VAR_ADM_CONTRASENA;                           
    $_SESSION['SES_VAR_ADM_TIPUSU_ID_TIPO_USUARIO']         = $S_VAR_ADM_TIPUSU_ID_TIPO_USUARIO;           
    $_SESSION['SES_VAR_ADM_TIPUSU_TIPO_USUARIO']            = $S_VAR_ADM_TIPUSU_TIPO_USUARIO;            
    $_SESSION['SES_VAR_ADM_TIPEXT_ID_TIPO_EXTRAESCOLAR']    = $S_VAR_ADM_TIPEXT_ID_TIPO_EXTRAESCOLAR;  
    $_SESSION['SES_VAR_ADM_TIPEXT_TIPO_EXTRAESCOLAR']       = $S_VAR_ADM_TIPEXT_TIPO_EXTRAESCOLAR;   
    $_SESSION['SES_VAR_ADM_ESTADO']                         = $S_VAR_ADM_ESTADO;                        

?>                        