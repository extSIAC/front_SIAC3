<?php
    require '../../modelo/modelo_administrador.php';

    $MU = new Modelo_Administrador();
            $EDIT_EXT_ID_EXTRAESCOLAR            = htmlspecialchars($_POST['EDIT_EXT_ID_EXTRAESCOLAR'],ENT_QUOTES,'UTF-8');          
            $EDIT_EXT_PROMOTOR                   = htmlspecialchars($_POST['EDIT_EXT_PROMOTOR'],ENT_QUOTES,'UTF-8');
            $EDIT_EXT_LUGAR                      = htmlspecialchars($_POST['EDIT_EXT_LUGAR'],ENT_QUOTES,'UTF-8');
            $EDIT_EXT_TIPEXT_TIPO_EXTRAESCOLAR   = htmlspecialchars($_POST['EDIT_EXT_TIPEXT_TIPO_EXTRAESCOLAR'],ENT_QUOTES,'UTF-8');
            $EDIT_EXT_HORA_LUNES_INICIO          = htmlspecialchars($_POST['EDIT_EXT_HORA_LUNES_INICIO'],ENT_QUOTES,'UTF-8');
            $EDIT_EXT_HORA_LUNES_FIN             = htmlspecialchars($_POST['EDIT_EXT_HORA_LUNES_FIN'],ENT_QUOTES,'UTF-8');
            $EDIT_EXT_HORA_MARTES_INICIO         = htmlspecialchars($_POST['EDIT_EXT_HORA_MARTES_INICIO'],ENT_QUOTES,'UTF-8');
            $EDIT_EXT_HORA_MARTES_FIN            = htmlspecialchars($_POST['EDIT_EXT_HORA_MARTES_FIN'],ENT_QUOTES,'UTF-8');
            $EDIT_EXT_HORA_MIERCOLES_INICIO      = htmlspecialchars($_POST['EDIT_EXT_HORA_MIERCOLES_INICIO'],ENT_QUOTES,'UTF-8');
            $EDIT_EXT_HORA_MIERCOLES_FIN         = htmlspecialchars($_POST['EDIT_EXT_HORA_MIERCOLES_FIN'],ENT_QUOTES,'UTF-8');
            $EDIT_EXT_HORA_JUEVES_INICIO         = htmlspecialchars($_POST['EDIT_EXT_HORA_JUEVES_INICIO'],ENT_QUOTES,'UTF-8');
            $EDIT_EXT_HORA_JUEVES_FIN            = htmlspecialchars($_POST['EDIT_EXT_HORA_JUEVES_FIN'],ENT_QUOTES,'UTF-8'); 
            $EDIT_EXT_HORA_VIERNES_INICIO        = htmlspecialchars($_POST['EDIT_EXT_HORA_VIERNES_INICIO'],ENT_QUOTES,'UTF-8');
            $EDIT_EXT_HORA_VIERNES_FIN           = htmlspecialchars($_POST['EDIT_EXT_HORA_VIERNES_FIN'],ENT_QUOTES,'UTF-8');  


    $consulta = $MU->Editar_Extraescolar($EDIT_EXT_ID_EXTRAESCOLAR, $EDIT_EXT_PROMOTOR, $EDIT_EXT_LUGAR, $EDIT_EXT_TIPEXT_TIPO_EXTRAESCOLAR, $EDIT_EXT_HORA_LUNES_INICIO, $EDIT_EXT_HORA_LUNES_FIN, $EDIT_EXT_HORA_MARTES_INICIO, $EDIT_EXT_HORA_MARTES_FIN, $EDIT_EXT_HORA_MIERCOLES_INICIO,$EDIT_EXT_HORA_MIERCOLES_FIN,$EDIT_EXT_HORA_JUEVES_INICIO,$EDIT_EXT_HORA_JUEVES_FIN,$EDIT_EXT_HORA_VIERNES_INICIO,$EDIT_EXT_HORA_VIERNES_FIN);
    echo $consulta;

?>