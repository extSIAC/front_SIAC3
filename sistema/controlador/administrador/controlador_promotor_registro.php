<?php
    require '../../modelo/modelo_administrador.php';

    $MU = new Modelo_Administrador();
    
            $REG_PRO_NOMBRE                 = htmlspecialchars($_POST['REG_PRO_NOMBRE'],ENT_QUOTES,'UTF-8');
            $REG_PRO_APELLIDO_PATERNO       = htmlspecialchars($_POST['REG_PRO_APELLIDO_PATERNO'],ENT_QUOTES,'UTF-8');
            $REG_PRO_APELLIDO_MATERNO       = htmlspecialchars($_POST['REG_PRO_APELLIDO_MATERNO'],ENT_QUOTES,'UTF-8');
            $REG_PRO_EDAD                   = htmlspecialchars($_POST['REG_PRO_EDAD'],ENT_QUOTES,'UTF-8');
            $REG_PRO_SEXO                   = htmlspecialchars($_POST['REG_PRO_SEXO'],ENT_QUOTES,'UTF-8');
            $REG_PRO_TELEFONO               = htmlspecialchars($_POST['REG_PRO_TELEFONO'],ENT_QUOTES,'UTF-8');
            $REG_PRO_CORREO                 = htmlspecialchars($_POST['REG_PRO_CORREO'],ENT_QUOTES,'UTF-8');
            $REG_PRO_USUARIO                = htmlspecialchars($_POST['REG_PRO_USUARIO'],ENT_QUOTES,'UTF-8');
            $REG_PRO_CONTRASENA             = password_hash   ($_POST['REG_PRO_CONTRASENA'],PASSWORD_DEFAULT,['cost']);
            $REG_PRO_TIPEXT_TIPO_EXTRAESCOLAR   = htmlspecialchars($_POST['REG_PRO_TIPEXT_TIPO_EXTRAESCOLAR'],ENT_QUOTES,'UTF-8');
    
    $consulta = $MU->Registrar_Usuario_Promotor($REG_PRO_NOMBRE, $REG_PRO_APELLIDO_PATERNO, $REG_PRO_APELLIDO_MATERNO, $REG_PRO_EDAD, $REG_PRO_SEXO, $REG_PRO_TELEFONO, $REG_PRO_CORREO, $REG_PRO_USUARIO, $REG_PRO_CONTRASENA,$REG_PRO_TIPEXT_TIPO_EXTRAESCOLAR);
    echo $consulta;

?>