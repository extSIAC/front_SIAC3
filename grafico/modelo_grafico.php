<?php
	class Modelo_Grafico{
		private $conexion;
		function __construct()
		{
			require_once('../sistema/modelo/modelo_conexion.php');
			$this->conexion = new conexion();
			$this->conexion->conectar();
        }


// TIPO DE ACTIVIDAD EXTRAESCOLAR
		function TraerDatosGraficoTipoActividadExtraescolar(){
			$sql = "call SP_GRA_INS_CANTIDAD_TIPO_ACTIVIDAD_EXTRAESCOLAR";	
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {

				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					$arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();	
			}
		}



		function TraerDatosGraficoActividadesDeportivas(){
			$sql = "call SP_GRA_INS_CANTIDAD_INSCRIPCIONES_ACTIVIDADES_DEPORTIVAS";	
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {

				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					$arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();	
			}
		}

		function TraerDatosGraficoActividadesCulturales(){
			$sql = "call SP_GRA_INS_CANTIDAD_INSCRIPCIONES_ACTIVIDADES_CULTURALES";	
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {

				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					$arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();	
			}
		}


	}