<?php
    require 'modelo_grafico.php';
    $MU = new Modelo_Grafico();
    

    $consulta = $MU->TraerDatosGraficoActividadesDeportivas();
    echo json_encode ($consulta);

