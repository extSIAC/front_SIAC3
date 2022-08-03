<?php
    // Llama al modelo usuario
    require '../../modelo/modelo_administrador.php';

    $MU = new Modelo_Administrador();
    //Inyección de datos
    $DATOS_USUARIO_PRINCIPAL  = htmlspecialchars($_POST['DATOS_USUARIO_PRINCIPAL'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->TraerDatosUsuario($DATOS_USUARIO_PRINCIPAL);
    echo json_encode($consulta);