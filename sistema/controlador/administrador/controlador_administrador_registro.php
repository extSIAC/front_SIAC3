<?php
    require '../../modelo/modelo_administrador.php';

    $MU = new Modelo_Administrador();
    
            $REG_ADM_NOMBRE                 = htmlspecialchars($_POST['REG_ADM_NOMBRE'],ENT_QUOTES,'UTF-8');
            $REG_ADM_APELLIDO_PATERNO       = htmlspecialchars($_POST['REG_ADM_APELLIDO_PATERNO'],ENT_QUOTES,'UTF-8');
            $REG_ADM_APELLIDO_MATERNO       = htmlspecialchars($_POST['REG_ADM_APELLIDO_MATERNO'],ENT_QUOTES,'UTF-8');
            $REG_ADM_EDAD                   = htmlspecialchars($_POST['REG_ADM_EDAD'],ENT_QUOTES,'UTF-8');
            $REG_ADM_SEXO                   = htmlspecialchars($_POST['REG_ADM_SEXO'],ENT_QUOTES,'UTF-8');
            $REG_ADM_TELEFONO               = htmlspecialchars($_POST['REG_ADM_TELEFONO'],ENT_QUOTES,'UTF-8');
            $REG_ADM_CORREO                 = htmlspecialchars($_POST['REG_ADM_CORREO'],ENT_QUOTES,'UTF-8');
            $REG_ADM_USUARIO                = htmlspecialchars($_POST['REG_ADM_USUARIO'],ENT_QUOTES,'UTF-8');
            $REG_ADM_CONTRASENA             = password_hash   ($_POST['REG_ADM_CONTRASENA'],PASSWORD_DEFAULT,['cost']);
            $REG_ADM_ID_TIPO_EXTRAESCOLAR   = htmlspecialchars($_POST['REG_ADM_ID_TIPO_EXTRAESCOLAR'],ENT_QUOTES,'UTF-8');
    
    $consulta = $MU->Registrar_Usuario_Administrador($REG_ADM_NOMBRE, $REG_ADM_APELLIDO_PATERNO, $REG_ADM_APELLIDO_MATERNO, $REG_ADM_EDAD, $REG_ADM_SEXO, $REG_ADM_TELEFONO, $REG_ADM_CORREO, $REG_ADM_USUARIO, $REG_ADM_CONTRASENA, $REG_ADM_ID_TIPO_EXTRAESCOLAR );
    echo $consulta;

