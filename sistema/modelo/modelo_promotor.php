<?php
// Modelo promotor
    class Modelo_Promotor{
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

//--------------------------------------------------------------- LOGIN -----------------------------------------------------------------
        function VerificarPromotor($USUARIO_PROMOTOR,$CONTRASENA_PROMOTOR){
			//Llamar el procedimiento almacenado enviando el parámetro.
            $sql = "call SP_PRO_LOGIN_VERIFICAR_PROMOTOR('$USUARIO_PROMOTOR')";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					//Desencriptar la contraseña.
					if(password_verify($CONTRASENA_PROMOTOR, $consulta_VU["PRO_CONTRASENA"])) // Compara con la columna de la base de datos contraseña
                    {
                        $arreglo[] = $consulta_VU;
                    }
				}
				return $arreglo;
				//Cierra la conexión
				$this->conexion->cerrar();
			}
        }
/*
//------------------------------------------------------------- LISTAR PROMOTOR -------------------------------------------------------------------------
        function listar_promotor(){
            $sql = "call SP_PRO_LISTAR_PROMOTOR()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                    $arreglo["data"][]=$consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
        }

//------------------------------------------------------------- LISTADO DE SELECT OPTIONS -------------------------------------------------------------------------
        //LISTADO TIPO DE USUARIO
		function listar_opcion_tipo_usuario(){
            $sql = "call SP_LISTAR_OPCION_TIPO_USUARIO_PRO()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}
		

        function listar_opcion_tipo_extraescolar(){
            $sql = "call SP_LISTAR_OPCION_TIPO_EXTRAESCOLAR()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}

//------------------------------------------------------- MODIFICAR EL ESTADO DEL USUARIO PROMOTOR -----------------------------------
		function Modificar_Estado_Promotor($MOD_PRO_ID_PROMOTOR,$MOD_PRO_ESTADO){
            $sql = "call SP_PRO_MOD_ESTADO_USUARIO('$MOD_PRO_ID_PROMOTOR','$MOD_PRO_ESTADO')";
			if ($consulta = $this->conexion->conexion->query($sql)) {
				return 1;
				
			}else{
				return 0;
			}
        }

//------------------------------------------------ REGISTRO DE NUEVO USUARIO PROMOTOR ----------------------------------------------
        function Registrar_Usuario_Promotor($REG_PRO_NOMBRE, $REG_PRO_APELLIDO_PATERNO, $REG_PRO_APELLIDO_MATERNO, $REG_PRO_EDAD, $REG_PRO_SEXO, $REG_PRO_TELEFONO, $REG_PRO_CORREO, $REG_PRO_USUARIO, $REG_PRO_CONTRASENA, $REG_PRO_ID_TIPO_USUARIO, $REG_PRO_ID_TIPO_EXTRAESCOLAR){
            $sql = "call SP_AMD_REGISTRAR_USUARIO_PROMOTOR('$REG_PRO_NOMBRE', '$REG_PRO_APELLIDO_PATERNO', '$REG_PRO_APELLIDO_MATERNO', '$REG_PRO_EDAD', '$REG_PRO_SEXO', '$REG_PRO_TELEFONO', '$REG_PRO_CORREO', '$REG_PRO_USUARIO', '$REG_PRO_CONTRASENA', '$REG_PRO_ID_TIPO_USUARIO', '$REG_PRO_ID_TIPO_EXTRAESCOLAR')";
			if ($consulta = $this->conexion->conexion->query($sql)) {
				if ($row = mysqli_fetch_array($consulta)) {
                        return $id= trim($row[0]);
				}
				$this->conexion->cerrar();
			}
        }

//------------------------------------------------ MODIFICACIÓN DE LOS DATOS DEL USUARIO PROMOTOR ------------------------------------------------------------
		function Editar_Usuario_Promotor($EDIT_PRO_ID_PROMOTOR,$EDIT_PRO_NOMBRE, $EDIT_PRO_APELLIDO_PATERNO, $EDIT_PRO_APELLIDO_MATERNO, $EDIT_PRO_EDAD, $EDIT_PRO_SEXO, $EDIT_PRO_TELEFONO, $EDIT_PRO_CORREO, $EDIT_PRO_ID_TIPO_USUARIO, $EDIT_PRO_ID_TIPO_EXTRAESCOLAR){
            $sql = "call SP_PRO_EDITAR_USUARIO_PROMOTOR('$EDIT_PRO_ID_PROMOTOR','$EDIT_PRO_NOMBRE','$EDIT_PRO_APELLIDO_PATERNO','$EDIT_PRO_APELLIDO_MATERNO','$EDIT_PRO_EDAD','$EDIT_PRO_SEXO','$EDIT_PRO_TELEFONO','$EDIT_PRO_CORREO','$EDIT_PRO_ID_TIPO_USUARIO','$EDIT_PRO_ID_TIPO_EXTRAESCOLAR')";
			if ($consulta = $this->conexion->conexion->query($sql)) {
				return 1;
				
			}else{
				return 0;
			}
        }

    
//----------------------------------------------------- FIN DE MODELO PROMOTOR ----------------------------------------------------------


//--------------------------------------------------------------- TRAER DATOS USUARIO PROMOTOR -----------------------------------------------------------------
        function TraerDatosUsuario($DATOS_USUARIO_PRINCIPAL){
			//Llamar el procedimiento almacenado enviando el parámetro.
            $sql = "call SP_PRO_LOGIN_VERIFICAR_PROMOTOR('$DATOS_USUARIO_PRINCIPAL')";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					$arreglo[]=$consulta_VU;
				}
				return $arreglo;
				//Cierra la conexión
				$this->conexion->cerrar();
			}
        }

//-------------------------------------------------- CONFIGURAR CONTRASEÑA USUARIO PROMOTOR -----------------------------------------------------------------

		function ConfigurarContrasenaUsuarioPromotor($CON_CON_ID_USUARIO, $CON_CON_NUEVA){
            $sql = "call SP_PRO_MOD_CONTRASENA_USUARIO('$CON_CON_ID_USUARIO','$CON_CON_NUEVA')";
			if ($consulta = $this->conexion->conexion->query($sql)) {
				return 1;
			}else{
				return 0;
			}
        }

//------------------------------------------------ RESTABLECER CONTRASEÑA ----------------------------------------------
        function Restablecer_Contrasena_Usuario_Promotor($RES_REC_CORREO_USUARIO_PROMOTOR, $RES_CONTRASENA_ALEATORIA){
            $sql = "call SP_AMD_RESTABLECER_CONTRASENA('$RES_REC_CORREO_USUARIO_PROMOTOR', '$RES_CONTRASENA_ALEATORIA')";
			if ($consulta = $this->conexion->conexion->query($sql)) {
				if ($row = mysqli_fetch_array($consulta)) {
                        return $id= trim($row[0]);
				}
				$this->conexion->cerrar();
			}
        }

*/

		
}

?>

