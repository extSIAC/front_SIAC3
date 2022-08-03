<?php
    require '../../modelo/modelo_administrador.php';
    $MU = new Modelo_Administrador();
    $consulta = $MU->listar_extraescolar_horario_actividades_culturales();
    if($consulta){
        echo json_encode($consulta);
    }else{
        // Solución a errores al mostrar datos
        echo '{
		    "sEcho": 1,
		    "iTotalRecords": "0",
		    "iTotalDisplayRecords": "0",
		    "aaData": []
		}';
    }
?>