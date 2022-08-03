<?php
    require '../../modelo/modelo_administrador.php';

    $MU = new Modelo_Administrador();
            $EDIT_ADM_ID_ADMINISTRADOR       = htmlspecialchars($_POST['EDIT_ADM_ID_ADMINISTRADOR'],ENT_QUOTES,'UTF-8');
            $EDIT_ADM_NOMBRE                 = htmlspecialchars($_POST['EDIT_ADM_NOMBRE'],ENT_QUOTES,'UTF-8');
            $EDIT_ADM_APELLIDO_PATERNO       = htmlspecialchars($_POST['EDIT_ADM_APELLIDO_PATERNO'],ENT_QUOTES,'UTF-8');
            $EDIT_ADM_APELLIDO_MATERNO       = htmlspecialchars($_POST['EDIT_ADM_APELLIDO_MATERNO'],ENT_QUOTES,'UTF-8');
            $EDIT_ADM_EDAD                   = htmlspecialchars($_POST['EDIT_ADM_EDAD'],ENT_QUOTES,'UTF-8');
            $EDIT_ADM_SEXO                   = htmlspecialchars($_POST['EDIT_ADM_SEXO'],ENT_QUOTES,'UTF-8');
            $EDIT_ADM_TELEFONO               = htmlspecialchars($_POST['EDIT_ADM_TELEFONO'],ENT_QUOTES,'UTF-8');
            $EDIT_ADM_CORREO                 = htmlspecialchars($_POST['EDIT_ADM_CORREO'],ENT_QUOTES,'UTF-8');
            $EDIT_ADM_ID_TIPO_EXTRAESCOLAR   = htmlspecialchars($_POST['EDIT_ADM_ID_TIPO_EXTRAESCOLAR'],ENT_QUOTES,'UTF-8');
    
    $consulta = $MU->Editar_Usuario_Administrador($EDIT_ADM_ID_ADMINISTRADOR,$EDIT_ADM_NOMBRE, $EDIT_ADM_APELLIDO_PATERNO, $EDIT_ADM_APELLIDO_MATERNO, $EDIT_ADM_EDAD, $EDIT_ADM_SEXO, $EDIT_ADM_TELEFONO, $EDIT_ADM_CORREO, $EDIT_ADM_ID_TIPO_EXTRAESCOLAR );
    echo $consulta;

