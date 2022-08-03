<?php
    require '../../modelo/modelo_administrador.php';

    $MU = new Modelo_Administrador();
            $EDIT_PRO_ID_PROMOTOR            = htmlspecialchars($_POST['EDIT_PRO_ID_PROMOTOR'],ENT_QUOTES,'UTF-8');
            $EDIT_PRO_NOMBRE                 = htmlspecialchars($_POST['EDIT_PRO_NOMBRE'],ENT_QUOTES,'UTF-8');
            $EDIT_PRO_APELLIDO_PATERNO       = htmlspecialchars($_POST['EDIT_PRO_APELLIDO_PATERNO'],ENT_QUOTES,'UTF-8');
            $EDIT_PRO_APELLIDO_MATERNO       = htmlspecialchars($_POST['EDIT_PRO_APELLIDO_MATERNO'],ENT_QUOTES,'UTF-8');
            $EDIT_PRO_EDAD                   = htmlspecialchars($_POST['EDIT_PRO_EDAD'],ENT_QUOTES,'UTF-8');
            $EDIT_PRO_SEXO                   = htmlspecialchars($_POST['EDIT_PRO_SEXO'],ENT_QUOTES,'UTF-8');
            $EDIT_PRO_TELEFONO               = htmlspecialchars($_POST['EDIT_PRO_TELEFONO'],ENT_QUOTES,'UTF-8');
            $EDIT_PRO_CORREO                 = htmlspecialchars($_POST['EDIT_PRO_CORREO'],ENT_QUOTES,'UTF-8');
            $EDIT_PRO_TIPO_EXTRAESCOLAR      = htmlspecialchars($_POST['EDIT_PRO_TIPO_EXTRAESCOLAR'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->Editar_Usuario_Promotor($EDIT_PRO_ID_PROMOTOR,$EDIT_PRO_NOMBRE, $EDIT_PRO_APELLIDO_PATERNO, $EDIT_PRO_APELLIDO_MATERNO, $EDIT_PRO_EDAD, $EDIT_PRO_SEXO, $EDIT_PRO_TELEFONO, $EDIT_PRO_CORREO, $EDIT_PRO_TIPO_EXTRAESCOLAR);
    echo $consulta;

?>