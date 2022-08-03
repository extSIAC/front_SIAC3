<?php
    require '../../modelo/modelo_administrador.php';

    $MU = new Modelo_Administrador();
    
            $REG_ALU_NOMBRE                 = htmlspecialchars($_POST['REG_ALU_NOMBRE'],ENT_QUOTES,'UTF-8');
            $REG_ALU_APELLIDO_PATERNO       = htmlspecialchars($_POST['REG_ALU_APELLIDO_PATERNO'],ENT_QUOTES,'UTF-8');
            $REG_ALU_APELLIDO_MATERNO       = htmlspecialchars($_POST['REG_ALU_APELLIDO_MATERNO'],ENT_QUOTES,'UTF-8');
            $REG_ALU_EDAD                   = htmlspecialchars($_POST['REG_ALU_EDAD'],ENT_QUOTES,'UTF-8');
            $REG_ALU_SEXO                   = htmlspecialchars($_POST['REG_ALU_SEXO'],ENT_QUOTES,'UTF-8');
            $REG_ALU_TELEFONO               = htmlspecialchars($_POST['REG_ALU_TELEFONO'],ENT_QUOTES,'UTF-8');
            $REG_ALU_CORREO                 = htmlspecialchars($_POST['REG_ALU_CORREO'],ENT_QUOTES,'UTF-8');
            $REG_ALU_NUMERO_CONTROL         = htmlspecialchars($_POST['REG_ALU_NUMERO_CONTROL'],ENT_QUOTES,'UTF-8');
            $REG_ALU_CONTRASENA             = password_hash   ($_POST['REG_ALU_CONTRASENA'],PASSWORD_DEFAULT,['cost']);
            $REG_ALU_SEMESTRE               = htmlspecialchars($_POST['REG_ALU_SEMESTRE'],ENT_QUOTES,'UTF-8');
            $REG_ALU_CARRERA                = htmlspecialchars($_POST['REG_ALU_CARRERA'],ENT_QUOTES,'UTF-8');
            $REG_ALU_EXTRAESCOLAR           = htmlspecialchars($_POST['REG_ALU_EXTRAESCOLAR'],ENT_QUOTES,'UTF-8');
    
    $consulta = $MU->Registrar_Usuario_Alumno($REG_ALU_NUMERO_CONTROL, $REG_ALU_NOMBRE, $REG_ALU_APELLIDO_PATERNO, $REG_ALU_APELLIDO_MATERNO, $REG_ALU_EDAD, $REG_ALU_SEXO, $REG_ALU_TELEFONO,$REG_ALU_CORREO, $REG_ALU_CONTRASENA,$REG_ALU_CARRERA,$REG_ALU_SEMESTRE,$REG_ALU_EXTRAESCOLAR);
    echo $consulta;

