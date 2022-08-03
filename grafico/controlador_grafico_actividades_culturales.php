<?php
    require 'modelo_grafico.php';
    $MU = new Modelo_Grafico();
    

    $consulta = $MU->TraerDatosGraficoActividadesCulturales();
    echo json_encode ($consulta);

