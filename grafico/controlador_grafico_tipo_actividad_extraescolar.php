<?php
    require 'modelo_grafico.php';
    $MU = new Modelo_Grafico();
    

    $consulta = $MU->TraerDatosGraficoTipoActividadExtraescolar();
    echo json_encode ($consulta);

