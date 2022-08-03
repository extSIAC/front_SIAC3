<?php
    require '../../modelo/modelo_administrador.php';

    $MU = new Modelo_Administrador();
    
            $REG_EXT_EXTRAESCOLAR               = htmlspecialchars($_POST['REG_EXT_EXTRAESCOLAR'],ENT_QUOTES,'UTF-8');
            $REG_EXT_GRUPO_EXTRAESCOLAR         = htmlspecialchars($_POST['REG_EXT_GRUPO_EXTRAESCOLAR'],ENT_QUOTES,'UTF-8');
            $REG_EXT_PROMOTOR                   = htmlspecialchars($_POST['REG_EXT_PROMOTOR'],ENT_QUOTES,'UTF-8');
            $REG_EXT_LUGAR                      = htmlspecialchars($_POST['REG_EXT_LUGAR'],ENT_QUOTES,'UTF-8');
            $REG_EXT_TIPEXT_TIPO_EXTRAESCOLAR   = htmlspecialchars($_POST['REG_EXT_TIPEXT_TIPO_EXTRAESCOLAR'],ENT_QUOTES,'UTF-8');
            $REG_EXT_PERIODO                    = htmlspecialchars($_POST['REG_EXT_PERIODO'],ENT_QUOTES,'UTF-8');
            $REG_EXT_HORA_LUNES_INICIO          = htmlspecialchars($_POST['REG_EXT_HORA_LUNES_INICIO'],ENT_QUOTES,'UTF-8');
            $REG_EXT_HORA_LUNES_FIN             = htmlspecialchars($_POST['REG_EXT_HORA_LUNES_FIN'],ENT_QUOTES,'UTF-8');
            $REG_EXT_HORA_MARTES_INICIO         = htmlspecialchars($_POST['REG_EXT_HORA_MARTES_INICIO'],ENT_QUOTES,'UTF-8');
            $REG_EXT_HORA_MARTES_FIN            = htmlspecialchars($_POST['REG_EXT_HORA_MARTES_FIN'],ENT_QUOTES,'UTF-8');
            $REG_EXT_HORA_MIERCOLES_INICIO      = htmlspecialchars($_POST['REG_EXT_HORA_MIERCOLES_INICIO'],ENT_QUOTES,'UTF-8');
            $REG_EXT_HORA_MIERCOLES_FIN         = htmlspecialchars($_POST['REG_EXT_HORA_MIERCOLES_FIN'],ENT_QUOTES,'UTF-8');
            $REG_EXT_HORA_JUEVES_INICIO         = htmlspecialchars($_POST['REG_EXT_HORA_JUEVES_INICIO'],ENT_QUOTES,'UTF-8');
            $REG_EXT_HORA_JUEVES_FIN            = htmlspecialchars($_POST['REG_EXT_HORA_JUEVES_FIN'],ENT_QUOTES,'UTF-8'); 
            $REG_EXT_HORA_VIERNES_INICIO         = htmlspecialchars($_POST['REG_EXT_HORA_VIERNES_INICIO'],ENT_QUOTES,'UTF-8');
            $REG_EXT_HORA_VIERNES_FIN           = htmlspecialchars($_POST['REG_EXT_HORA_VIERNES_FIN'],ENT_QUOTES,'UTF-8');            
            
    $consulta = $MU->Registrar_Extraescolar($REG_EXT_EXTRAESCOLAR, $REG_EXT_GRUPO_EXTRAESCOLAR, $REG_EXT_PROMOTOR, $REG_EXT_LUGAR, $REG_EXT_TIPEXT_TIPO_EXTRAESCOLAR, $REG_EXT_PERIODO, $REG_EXT_HORA_LUNES_INICIO, $REG_EXT_HORA_LUNES_FIN, $REG_EXT_HORA_MARTES_INICIO, $REG_EXT_HORA_MARTES_FIN, $REG_EXT_HORA_MIERCOLES_INICIO,$REG_EXT_HORA_MIERCOLES_FIN,$REG_EXT_HORA_JUEVES_INICIO,$REG_EXT_HORA_JUEVES_FIN,$REG_EXT_HORA_VIERNES_INICIO,$REG_EXT_HORA_VIERNES_FIN);
    echo $consulta;

?>