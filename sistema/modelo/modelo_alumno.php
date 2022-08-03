<?php
// Modelo usuario
    class Modelo_Alumno{
		// Conexión privada
        private $conexion;
		// Creación de constructor
        function __construct(){
			// Llama el modelo conexión.
            require_once 'modelo_conexion.php';
			// Variable conectar.
            $this->conexion = new conexion();
			// Ejecuta el método conectar.
            $this->conexion->conectar();
        }

        function VerificarAlumno($usuario,$contra){
			//Lla mar el procedimiento almacenado enviando el parámetro.
            $sql = "call SP_VERIFICAR_ALUMNO('$usuario')";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					//Desencriptar la contraseña.
					if(password_verify($contra, $consulta_VU["ALU_CONTRASENA"])) // Columna de la base de datos
                    {
                        $arreglo[] = $consulta_VU;
                    }
				}
				return $arreglo;
				//Cierra la conexión
				$this->conexion->cerrar();
			}
        }

        function listar_usuario(){
            $sql = "call SP_LISTAR_USUARIO()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                    $arreglo["data"][]=$consulta_VU;

				}
				return $arreglo;
				$this->conexion->cerrar();
			}
        }

        function listar_combo_rol(){
            $sql = "call SP_LISTAR_COMBO_ROL()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}
		
		function Modificar_Estatus_Usuario($idusuario,$estatus){
            $sql = "call SP_MODIFICAR_ESTATUS_USUARIO('$idusuario','$estatus')";
			if ($consulta = $this->conexion->conexion->query($sql)) {
				return 1;
				
			}else{
				return 0;
			}
        }

        function Registrar_Usuario($usuario,$contra,$sexo,$rol){
            $sql = "call SP_REGISTRAR_USUARIO('$usuario','$contra','$sexo','$rol')";
			if ($consulta = $this->conexion->conexion->query($sql)) {
				if ($row = mysqli_fetch_array($consulta)) {
                        return $id= trim($row[0]);
				}
				$this->conexion->cerrar();
			}
        }

    }
?>