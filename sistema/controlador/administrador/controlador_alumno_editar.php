<?php
    require '../../modelo/modelo_administrador.php';

    $MU = new Modelo_Administrador();
            $EDIT_ALU_ID_ALUMNO              = htmlspecialchars($_POST['EDIT_ALU_ID_ALUMNO'],ENT_QUOTES,'UTF-8');
            $EDIT_ALU_NOMBRE                 = htmlspecialchars($_POST['EDIT_ALU_NOMBRE'],ENT_QUOTES,'UTF-8');
            $EDIT_ALU_APELLIDO_PATERNO       = htmlspecialchars($_POST['EDIT_ALU_APELLIDO_PATERNO'],ENT_QUOTES,'UTF-8');
            $EDIT_ALU_APELLIDO_MATERNO       = htmlspecialchars($_POST['EDIT_ALU_APELLIDO_MATERNO'],ENT_QUOTES,'UTF-8');
            $EDIT_ALU_EDAD                   = htmlspecialchars($_POST['EDIT_ALU_EDAD'],ENT_QUOTES,'UTF-8');
            $EDIT_ALU_SEXO                   = htmlspecialchars($_POST['EDIT_ALU_SEXO'],ENT_QUOTES,'UTF-8');
            $EDIT_ALU_TELEFONO               = htmlspecialchars($_POST['EDIT_ALU_TELEFONO'],ENT_QUOTES,'UTF-8');
            $EDIT_ALU_CORREO                 = htmlspecialchars($_POST['EDIT_ALU_CORREO'],ENT_QUOTES,'UTF-8');
            $EDIT_ALU_CARRERA                = htmlspecialchars($_POST['EDIT_ALU_CARRERA'],ENT_QUOTES,'UTF-8');
            $EDIT_ALU_SEMESTRE               = htmlspecialchars($_POST['EDIT_ALU_SEMESTRE'],ENT_QUOTES,'UTF-8');
            $EDIT_ALU_EXTRAESCOLAR           = htmlspecialchars($_POST['EDIT_ALU_EXTRAESCOLAR'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->Editar_Usuario_Alumno($EDIT_ALU_ID_ALUMNO,$EDIT_ALU_NOMBRE, $EDIT_ALU_APELLIDO_PATERNO, $EDIT_ALU_APELLIDO_MATERNO, $EDIT_ALU_EDAD, $EDIT_ALU_SEXO, $EDIT_ALU_TELEFONO, $EDIT_ALU_CORREO, $EDIT_ALU_CARRERA,$EDIT_ALU_SEMESTRE,$EDIT_ALU_EXTRAESCOLAR);
    echo $consulta;

