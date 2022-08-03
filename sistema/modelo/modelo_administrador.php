<?php
// Modelo admnistrador
    class Modelo_Administrador{
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

//------------------------------------------------------------------------- LOGIN -----------------------------------------------------------------
        function VerificarAdministrador($USUARIO_ADMINISTRADOR,$CONTRASENA_ADMINISTRADOR){
			//Llamar el procedimiento almacenado enviando el parámetro.
            $sql = "call SP_ADM_LOGIN_VERIFICAR_ADMINISTRADOR('$USUARIO_ADMINISTRADOR')";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					//Desencriptar la contraseña.
					if(password_verify($CONTRASENA_ADMINISTRADOR, $consulta_VU["ADM_CONTRASENA"])) // Compara con la columna de la base de datos contraseña
                    {
                        $arreglo[] = $consulta_VU;
                    }
				}
				return $arreglo;
				//Cierra la conexión
				$this->conexion->cerrar();
			}
        }

//--------------------------------------------------------------- TRAER DATOS USUARIO ADMINISTRADOR -----------------------------------------------------------------
        function TraerDatosUsuario($DATOS_USUARIO_PRINCIPAL){
			//Llamar el procedimiento almacenado enviando el parámetro.
            $sql = "call SP_ADM_LOGIN_VERIFICAR_ADMINISTRADOR('$DATOS_USUARIO_PRINCIPAL')";
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

//--------------------------------------------------------- CONFIGURAR CONTRASEÑA USUARIO ADMINISTRADOR -----------------------------------------------------------------
		function ConfigurarContrasenaUsuarioAdministrador($CON_CON_ID_USUARIO, $CON_CON_NUEVA){
            $sql = "call SP_ADM_MOD_CONTRASENA_USUARIO('$CON_CON_ID_USUARIO','$CON_CON_NUEVA')";
			if ($consulta = $this->conexion->conexion->query($sql)) {
				return 1;
			}else{
				return 0;
			}
        }

//---------------------------------------------------------------- RESTABLECER CONTRASEÑA ----------------------------------------------
        function Restablecer_Contrasena_Usuario_Administrador($RES_REC_CORREO_USUARIO_ADMINISTRADOR, $RES_CONTRASENA_ALEATORIA){
            $sql = "call SP_ADM_RESTABLECER_CONTRASENA('$RES_REC_CORREO_USUARIO_ADMINISTRADOR', '$RES_CONTRASENA_ALEATORIA')";
			if ($consulta = $this->conexion->conexion->query($sql)) {
				if ($row = mysqli_fetch_array($consulta)) {
                        return $id= trim($row[0]);
				}
				$this->conexion->cerrar();
			}
        }



//############################################################# TABLA ADMINISTRADOR ############################################################################

//------------------------------------------------------------- LISTAR ADMNISTRADOR -------------------------------------------------------------------------
        function listar_administrador(){
            $sql = "call SP_ADM_LISTAR_ADMINISTRADOR()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                    $arreglo["data"][]=$consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
        }

//--------------------------------------------------- MODIFICAR EL ESTADO DEL USUARIO ADMNISTRADOR -----------------------------------
		function Modificar_Estado_Administrador($MOD_ADM_ID_ADMINISTRADOR,$MOD_ADM_ESTADO){
            $sql = "call SP_ADM_MOD_ESTADO_USUARIO('$MOD_ADM_ID_ADMINISTRADOR','$MOD_ADM_ESTADO')";
			if ($consulta = $this->conexion->conexion->query($sql)) {
				return 1;
				
			}else{
				return 0;
			}
        }

//-------------------------------------------------------- REGISTRO DE NUEVO USUARIO ADMINISTRADOR ----------------------------------------------
        function Registrar_Usuario_Administrador($REG_ADM_NOMBRE, $REG_ADM_APELLIDO_PATERNO, $REG_ADM_APELLIDO_MATERNO, $REG_ADM_EDAD, $REG_ADM_SEXO, $REG_ADM_TELEFONO, $REG_ADM_CORREO, $REG_ADM_USUARIO, $REG_ADM_CONTRASENA, $REG_ADM_ID_TIPO_EXTRAESCOLAR){
            $sql = "call SP_ADM_REGISTRAR_USUARIO_ADMINISTRADOR('$REG_ADM_NOMBRE', '$REG_ADM_APELLIDO_PATERNO', '$REG_ADM_APELLIDO_MATERNO', '$REG_ADM_EDAD', '$REG_ADM_SEXO', '$REG_ADM_TELEFONO', '$REG_ADM_CORREO', '$REG_ADM_USUARIO', '$REG_ADM_CONTRASENA', '$REG_ADM_ID_TIPO_EXTRAESCOLAR')";
			if ($consulta = $this->conexion->conexion->query($sql)) {
				if ($row = mysqli_fetch_array($consulta)) {
                        return $id= trim($row[0]);
				}
				$this->conexion->cerrar();
			}
        }

//------------------------------------------------ MODIFICACIÓN DE LOS DATOS DEL USUARIO ADMNISTRADOR ------------------------------------------------------------
		function Editar_Usuario_Administrador($EDIT_ADM_ID_ADMINISTRADOR,$EDIT_ADM_NOMBRE, $EDIT_ADM_APELLIDO_PATERNO, $EDIT_ADM_APELLIDO_MATERNO, $EDIT_ADM_EDAD, $EDIT_ADM_SEXO, $EDIT_ADM_TELEFONO, $EDIT_ADM_CORREO, $EDIT_ADM_ID_TIPO_EXTRAESCOLAR){
            $sql = "call SP_ADM_EDITAR_USUARIO_ADMINISTRADOR('$EDIT_ADM_ID_ADMINISTRADOR','$EDIT_ADM_NOMBRE','$EDIT_ADM_APELLIDO_PATERNO','$EDIT_ADM_APELLIDO_MATERNO','$EDIT_ADM_EDAD','$EDIT_ADM_SEXO','$EDIT_ADM_TELEFONO','$EDIT_ADM_CORREO','$EDIT_ADM_ID_TIPO_EXTRAESCOLAR')";
			if ($consulta = $this->conexion->conexion->query($sql)) {
				return 1;
				
			}else{
				return 0;
			}
        }

//############################################################# FIN TABLA ADMINISTRADOR ############################################################################

 

//############################################################# TABLA PROMOTOR ############################################################################

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
        function Registrar_Usuario_Promotor($REG_PRO_NOMBRE, $REG_PRO_APELLIDO_PATERNO, $REG_PRO_APELLIDO_MATERNO, $REG_PRO_EDAD, $REG_PRO_SEXO, $REG_PRO_TELEFONO, $REG_PRO_CORREO, $REG_PRO_USUARIO, $REG_PRO_CONTRASENA, $REG_PRO_TIPEXT_TIPO_EXTRAESCOLAR){
            $sql = "call SP_PRO_REGISTRAR_USUARIO_PROMOTOR('$REG_PRO_NOMBRE', '$REG_PRO_APELLIDO_PATERNO', '$REG_PRO_APELLIDO_MATERNO', '$REG_PRO_EDAD', '$REG_PRO_SEXO', '$REG_PRO_TELEFONO', '$REG_PRO_CORREO', '$REG_PRO_USUARIO', '$REG_PRO_CONTRASENA','$REG_PRO_TIPEXT_TIPO_EXTRAESCOLAR')";
			if ($consulta = $this->conexion->conexion->query($sql)) {
				if ($row = mysqli_fetch_array($consulta)) {
                        return $id= trim($row[0]);
				}
				$this->conexion->cerrar();
			}
        }

//------------------------------------------------ MODIFICACIÓN DE LOS DATOS DEL USUARIO PROMOTOR ------------------------------------------------------------
		function Editar_Usuario_Promotor($EDIT_PRO_ID_PROMOTOR,$EDIT_PRO_NOMBRE, $EDIT_PRO_APELLIDO_PATERNO, $EDIT_PRO_APELLIDO_MATERNO, $EDIT_PRO_EDAD, $EDIT_PRO_SEXO, $EDIT_PRO_TELEFONO, $EDIT_PRO_CORREO, $EDIT_PRO_TIPEXT_TIPO_EXTRAESCOLAR){
            $sql = "call SP_PRO_EDITAR_USUARIO_PROMOTOR('$EDIT_PRO_ID_PROMOTOR','$EDIT_PRO_NOMBRE','$EDIT_PRO_APELLIDO_PATERNO','$EDIT_PRO_APELLIDO_MATERNO','$EDIT_PRO_EDAD','$EDIT_PRO_SEXO','$EDIT_PRO_TELEFONO','$EDIT_PRO_CORREO','$EDIT_PRO_TIPEXT_TIPO_EXTRAESCOLAR')";
			if ($consulta = $this->conexion->conexion->query($sql)) {
				return 1;
				
			}else{
				return 0;
			}
        }
    
//############################################################# FIN TABLA PROMOTOR ############################################################################




//##################################################### TABLA PROMOTOR ACTIVIDADES DEPORTIVAS ############################################################################

//------------------------------------------------------------- LISTAR PROMOTOR ACTIVIDADES DEPORTIVAS -------------------------------------------------------------------------
        function listar_promotor_actividades_deportivas(){
            $sql = "call SP_PRO_LISTAR_PROMOTOR_ACTIVIDADES_DEPORTIVAS()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                    $arreglo["data"][]=$consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
        }
//------------------------------------------------------- MODIFICAR EL ESTADO DEL USUARIO PROMOTOR -----------------------------------
		function Modificar_Estado_Promotor_Actividades_Deportivas($MOD_PRO_ID_PROMOTOR,$MOD_PRO_ESTADO){
            $sql = "call SP_PRO_MOD_ESTADO_USUARIO('$MOD_PRO_ID_PROMOTOR','$MOD_PRO_ESTADO')";
			if ($consulta = $this->conexion->conexion->query($sql)) {
				return 1;
				
			}else{
				return 0;
			}
        }

//------------------------------------------------ REGISTRO DE NUEVO USUARIO PROMOTOR ----------------------------------------------
        function Registrar_Usuario_Promotor_Actividades_Deportivas($REG_PRO_NOMBRE, $REG_PRO_APELLIDO_PATERNO, $REG_PRO_APELLIDO_MATERNO, $REG_PRO_EDAD, $REG_PRO_SEXO, $REG_PRO_TELEFONO, $REG_PRO_CORREO, $REG_PRO_USUARIO, $REG_PRO_CONTRASENA){
            $sql = "call SP_PRO_REGISTRAR_USUARIO_PROMOTOR('$REG_PRO_NOMBRE', '$REG_PRO_APELLIDO_PATERNO', '$REG_PRO_APELLIDO_MATERNO', '$REG_PRO_EDAD', '$REG_PRO_SEXO', '$REG_PRO_TELEFONO', '$REG_PRO_CORREO', '$REG_PRO_USUARIO', '$REG_PRO_CONTRASENA')";
			if ($consulta = $this->conexion->conexion->query($sql)) {
				if ($row = mysqli_fetch_array($consulta)) {
                        return $id= trim($row[0]);
				}
				$this->conexion->cerrar();
			}
        }

//------------------------------------------------ MODIFICACIÓN DE LOS DATOS DEL USUARIO PROMOTOR ------------------------------------------------------------
		function Editar_Usuario_Promotor_Actividades_Deportivas($EDIT_PRO_ID_PROMOTOR,$EDIT_PRO_NOMBRE, $EDIT_PRO_APELLIDO_PATERNO, $EDIT_PRO_APELLIDO_MATERNO, $EDIT_PRO_EDAD, $EDIT_PRO_SEXO, $EDIT_PRO_TELEFONO, $EDIT_PRO_CORREO){
            $sql = "call SP_PRO_EDITAR_USUARIO_PROMOTOR('$EDIT_PRO_ID_PROMOTOR','$EDIT_PRO_NOMBRE','$EDIT_PRO_APELLIDO_PATERNO','$EDIT_PRO_APELLIDO_MATERNO','$EDIT_PRO_EDAD','$EDIT_PRO_SEXO','$EDIT_PRO_TELEFONO','$EDIT_PRO_CORREO')";
			if ($consulta = $this->conexion->conexion->query($sql)) {
				return 1;
				
			}else{
				return 0;
			}
        }
    
//############################################################# FIN TABLA PROMOTOR ACTIVIDADES EXTRAESCOLARES ############################################################################





//##################################################### TABLA PROMOTOR ACTIVIDADES CULTURALES ############################################################################

//------------------------------------------------------------- LISTAR PROMOTOR ACTIVIDADES CULTURALES -------------------------------------------------------------------------
        function listar_promotor_actividades_culturales(){
            $sql = "call SP_PRO_LISTAR_PROMOTOR_ACTIVIDADES_CULTURALES()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                    $arreglo["data"][]=$consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
        }
//------------------------------------------------------- MODIFICAR EL ESTADO DEL USUARIO PROMOTOR -----------------------------------
		function Modificar_Estado_Promotor_Actividades_Culturales($MOD_PRO_ID_PROMOTOR,$MOD_PRO_ESTADO){
            $sql = "call SP_PRO_MOD_ESTADO_USUARIO('$MOD_PRO_ID_PROMOTOR','$MOD_PRO_ESTADO')";
			if ($consulta = $this->conexion->conexion->query($sql)) {
				return 1;
				
			}else{
				return 0;
			}
        }

//------------------------------------------------ REGISTRO DE NUEVO USUARIO PROMOTOR ----------------------------------------------
        function Registrar_Usuario_Promotor_Actividades_Culturales($REG_PRO_NOMBRE, $REG_PRO_APELLIDO_PATERNO, $REG_PRO_APELLIDO_MATERNO, $REG_PRO_EDAD, $REG_PRO_SEXO, $REG_PRO_TELEFONO, $REG_PRO_CORREO, $REG_PRO_USUARIO, $REG_PRO_CONTRASENA){
            $sql = "call SP_PRO_REGISTRAR_USUARIO_PROMOTOR('$REG_PRO_NOMBRE', '$REG_PRO_APELLIDO_PATERNO', '$REG_PRO_APELLIDO_MATERNO', '$REG_PRO_EDAD', '$REG_PRO_SEXO', '$REG_PRO_TELEFONO', '$REG_PRO_CORREO', '$REG_PRO_USUARIO', '$REG_PRO_CONTRASENA')";
			if ($consulta = $this->conexion->conexion->query($sql)) {
				if ($row = mysqli_fetch_array($consulta)) {
                        return $id= trim($row[0]);
				}
				$this->conexion->cerrar();
			}
        }

//------------------------------------------------ MODIFICACIÓN DE LOS DATOS DEL USUARIO PROMOTOR ------------------------------------------------------------
		function Editar_Usuario_Promotor_Actividades_Culturales($EDIT_PRO_ID_PROMOTOR,$EDIT_PRO_NOMBRE, $EDIT_PRO_APELLIDO_PATERNO, $EDIT_PRO_APELLIDO_MATERNO, $EDIT_PRO_EDAD, $EDIT_PRO_SEXO, $EDIT_PRO_TELEFONO, $EDIT_PRO_CORREO){
            $sql = "call SP_PRO_EDITAR_USUARIO_PROMOTOR('$EDIT_PRO_ID_PROMOTOR','$EDIT_PRO_NOMBRE','$EDIT_PRO_APELLIDO_PATERNO','$EDIT_PRO_APELLIDO_MATERNO','$EDIT_PRO_EDAD','$EDIT_PRO_SEXO','$EDIT_PRO_TELEFONO','$EDIT_PRO_CORREO')";
			if ($consulta = $this->conexion->conexion->query($sql)) {
				return 1;
				
			}else{
				return 0;
			}
        }
    
//############################################################# FIN TABLA PROMOTOR ACTIVIDADES EXTRAESCOLARES ############################################################################













//############################################################# TABLA ALUMNO ############################################################################

//------------------------------------------------------------- LISTAR ALUMNO -------------------------------------------------------------------------
        function listar_alumno(){
            $sql = "call SP_ALU_LISTAR_ALUMNO_INSCRIPCION()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                    $arreglo["data"][]=$consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
        }


//------------------------------------------------ REGISTRO DE NUEVO USUARIO ALUMNO ----------------------------------------------
        function Registrar_Usuario_Alumno($REG_ALU_NUMERO_CONTROL, $REG_ALU_NOMBRE, $REG_ALU_APELLIDO_PATERNO, $REG_ALU_APELLIDO_MATERNO, $REG_ALU_EDAD, $REG_ALU_SEXO, $REG_ALU_TELEFONO,$REG_ALU_CORREO, $REG_ALU_CONTRASENA,$REG_ALU_CARRERA,$REG_ALU_SEMESTRE,$REG_ALU_EXTRAESCOLAR){
            $sql = "call SP_ALU_REGISTRAR_USUARIO_ALUMNO_INSCRIPCION('$REG_ALU_NUMERO_CONTROL', '$REG_ALU_NOMBRE', '$REG_ALU_APELLIDO_PATERNO', '$REG_ALU_APELLIDO_MATERNO', '$REG_ALU_EDAD', '$REG_ALU_SEXO', '$REG_ALU_TELEFONO','$REG_ALU_CORREO', '$REG_ALU_CONTRASENA','$REG_ALU_CARRERA','$REG_ALU_SEMESTRE','$REG_ALU_EXTRAESCOLAR')";
			if ($consulta = $this->conexion->conexion->query($sql)) {
				if ($row = mysqli_fetch_array($consulta)) {
                        return $id= trim($row[0]);
				}
				$this->conexion->cerrar();
			}
        }



//------------------------------------------------------- MODIFICAR EL ESTADO DEL USUARIO ALUMNO -----------------------------------
		function Modificar_Estado_Alumno($MOD_ALU_ID_ALUMNO,$MOD_ALU_ESTADO){
            $sql = "call SP_ALU_MOD_ESTADO_USUARIO('$MOD_ALU_ID_ALUMNO','$MOD_ALU_ESTADO')";
			if ($consulta = $this->conexion->conexion->query($sql)) {
				return 1;
				
			}else{
				return 0;
			}
        }

		

//------------------------------------------------ MODIFICACIÓN DE LOS DATOS DEL USUARIO ALUMNO ------------------------------------------------------------
		function Editar_Usuario_Alumno($EDIT_ALU_ID_ALUMNO,$EDIT_ALU_NOMBRE, $EDIT_ALU_APELLIDO_PATERNO, $EDIT_ALU_APELLIDO_MATERNO, $EDIT_ALU_EDAD, $EDIT_ALU_SEXO, $EDIT_ALU_TELEFONO, $EDIT_ALU_CORREO, $EDIT_ALU_CARRERA,$EDIT_ALU_SEMESTRE,$EDIT_ALU_EXTRAESCOLAR){
            $sql = "call SP_ALU_EDITAR_USUARIO_ALUMNO_INSCRIPCION('$EDIT_ALU_ID_ALUMNO','$EDIT_ALU_NOMBRE', '$EDIT_ALU_APELLIDO_PATERNO', '$EDIT_ALU_APELLIDO_MATERNO', '$EDIT_ALU_EDAD', '$EDIT_ALU_SEXO', '$EDIT_ALU_TELEFONO', '$EDIT_ALU_CORREO', '$EDIT_ALU_CARRERA','$EDIT_ALU_SEMESTRE','$EDIT_ALU_EXTRAESCOLAR')";
			if ($consulta = $this->conexion->conexion->query($sql)) {
				return 1;
				
			}else{
				return 0;
			}
        }
    
//############################################################# FIN TABLA ALUMNO ############################################################################







//############################################################# TABLA LISTA ASISTENCIAS ############################################################################

//------------------------------------------------------------- LISTAR LISTA DE ASISTENCIAS -------------------------------------------------------------------------
        function listar_lista_asistencias_listar(){
            $sql = "call SP_ALU_LISTAR_ALUMNO_LISTA_ACREDITACION()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                    $arreglo["data"][]=$consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
        }






//############################################################# TABLA LISTA ASISTENCIAS ############################################################################

//------------------------------------------------------------- LISTAR LISTA DE ASISTENCIAS -------------------------------------------------------------------------
        function listar_lista_acreditacion(){
            $sql = "call SP_ALU_LISTAR_ALUMNO_LISTA_ACREDITACION()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                    $arreglo["data"][]=$consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
        }


//------------------------------------------------------- MODIFICAR EL ESTADO DEL EXTRAESCOLAR -----------------------------------
		function Modificar_Estado_Acreditacion($MOD_INS_ID_INSCRIPCION,$MOD_INS_ESTADO_ACREDITACION){
            $sql = "call SP_ALU_MOD_ESTADO_ACREDITACION('$MOD_INS_ID_INSCRIPCION','$MOD_INS_ESTADO_ACREDITACION')";
			if ($consulta = $this->conexion->conexion->query($sql)) {
				return 1;
				
			}else{
				return 0;
			}
        }













//############################################################# TABLA EXTRAESCOLAR ############################################################################

//------------------------------------------------------------- LISTAR EXTRAESCOLAR -------------------------------------------------------------------------
        function listar_extraescolar(){
            $sql = "call SP_EXT_LISTAR_EXTRAESCOLAR()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                    $arreglo["data"][]=$consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
        }




//------------------------------------------------ REGISTRO DE NUEVA EXTRAESCOLAR ----------------------------------------------
        function Registrar_Extraescolar($REG_EXT_EXTRAESCOLAR, $REG_EXT_GRUPO_EXTRAESCOLAR, $REG_EXT_PROMOTOR, $REG_EXT_LUGAR, $REG_EXT_TIPEXT_TIPO_EXTRAESCOLAR, $REG_EXT_PERIODO, $REG_EXT_HORA_LUNES_INICIO, $REG_EXT_HORA_LUNES_FIN, $REG_EXT_HORA_MARTES_INICIO, $REG_EXT_HORA_MARTES_FIN, $REG_EXT_HORA_MIERCOLES_INICIO,$REG_EXT_HORA_MIERCOLES_FIN,$REG_EXT_HORA_JUEVES_INICIO,$REG_EXT_HORA_JUEVES_FIN,$REG_EXT_HORA_VIERNES_INICIO,$REG_EXT_HORA_VIERNES_FIN){
            $sql = "call SP_EXT_REGISTRAR_EXTRAESCOLAR('$REG_EXT_EXTRAESCOLAR', '$REG_EXT_GRUPO_EXTRAESCOLAR', '$REG_EXT_PROMOTOR', '$REG_EXT_LUGAR', '$REG_EXT_TIPEXT_TIPO_EXTRAESCOLAR', '$REG_EXT_PERIODO', '$REG_EXT_HORA_LUNES_INICIO', '$REG_EXT_HORA_LUNES_FIN', '$REG_EXT_HORA_MARTES_INICIO', '$REG_EXT_HORA_MARTES_FIN', '$REG_EXT_HORA_MIERCOLES_INICIO','$REG_EXT_HORA_MIERCOLES_FIN','$REG_EXT_HORA_JUEVES_INICIO','$REG_EXT_HORA_JUEVES_FIN','$REG_EXT_HORA_VIERNES_INICIO','$REG_EXT_HORA_VIERNES_FIN')";
			if ($consulta = $this->conexion->conexion->query($sql)) {
				if ($row = mysqli_fetch_array($consulta)) {
                        return $id= trim($row[0]);
				}
				$this->conexion->cerrar();
			}
        }







//------------------------------------------------------- MODIFICAR EL ESTADO DEL EXTRAESCOLAR -----------------------------------
		function Modificar_Estado_Extraescolar($MOD_EXT_ID_EXTRAESCOLAR,$MOD_EXT_ESTADO){
            $sql = "call SP_EXT_MOD_ESTADO_EXTRAESCOLAR('$MOD_EXT_ID_EXTRAESCOLAR','$MOD_EXT_ESTADO')";
			if ($consulta = $this->conexion->conexion->query($sql)) {
				return 1;
				
			}else{
				return 0;
			}
        }



//------------------------------------------------ MODIFICACIÓN DE LOS DATOS DE EXTRAESCOLAR ------------------------------------------------------------
		function Editar_Extraescolar($EDIT_EXT_ID_EXTRAESCOLAR, $EDIT_EXT_PROMOTOR, $EDIT_EXT_LUGAR, $EDIT_EXT_TIPEXT_TIPO_EXTRAESCOLAR, $EDIT_EXT_HORA_LUNES_INICIO, $EDIT_EXT_HORA_LUNES_FIN, $EDIT_EXT_HORA_MARTES_INICIO, $EDIT_EXT_HORA_MARTES_FIN, $EDIT_EXT_HORA_MIERCOLES_INICIO,$EDIT_EXT_HORA_MIERCOLES_FIN,$EDIT_EXT_HORA_JUEVES_INICIO,$EDIT_EXT_HORA_JUEVES_FIN,$EDIT_EXT_HORA_VIERNES_INICIO,$EDIT_EXT_HORA_VIERNES_FIN){
            $sql = "call SP_EXT_EDITAR_EXTRAESCOLAR('$EDIT_EXT_ID_EXTRAESCOLAR', '$EDIT_EXT_PROMOTOR', '$EDIT_EXT_LUGAR', '$EDIT_EXT_TIPEXT_TIPO_EXTRAESCOLAR', '$EDIT_EXT_HORA_LUNES_INICIO', '$EDIT_EXT_HORA_LUNES_FIN', '$EDIT_EXT_HORA_MARTES_INICIO', '$EDIT_EXT_HORA_MARTES_FIN', '$EDIT_EXT_HORA_MIERCOLES_INICIO','$EDIT_EXT_HORA_MIERCOLES_FIN','$EDIT_EXT_HORA_JUEVES_INICIO','$EDIT_EXT_HORA_JUEVES_FIN','$EDIT_EXT_HORA_VIERNES_INICIO','$EDIT_EXT_HORA_VIERNES_FIN')";
			if ($consulta = $this->conexion->conexion->query($sql)) {
				return 1;
				
			}else{
				return 0;
			}
        }
    
//############################################################# FIN TABLA EXTRAESCOLAR ############################################################################





//############################################################# TABLA EXTRAESCOLAR HORARIO ACTIVIDADES DEPORTIVAS ############################################################################

//------------------------------------------------------------- LISTAR EXTRAESCOLAR HORARIO ACTIVIDADES DEPORTIVAS-------------------------------------------------------------------------
        function listar_extraescolar_horario_actividades_deportivas(){
            $sql = "call SP_EXT_LISTAR_EXTRAESCOLAR_ACTIVIDADES_DEPORTIVAS()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                    $arreglo["data"][]=$consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
        }

//------------------------------------------------------------- LISTAR EXTRAESCOLAR HORARIO ACTIVIDADES CULTURALES -------------------------------------------------------------------------
        function listar_extraescolar_horario_actividades_culturales(){
            $sql = "call SP_EXT_LISTAR_EXTRAESCOLAR_ACTIVIDADES_CULTURALES()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                    $arreglo["data"][]=$consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
        }










//#################################################################### LISTADO DE OPCIONES ########################################################################

//------------------------------------------------------------- INICIO LISTADO DE SELECT OPTIONS -------------------------------------------------------------------------
        //LISTADO TIPO DE USUARIO
		function listar_opcion_tipo_usuario(){
            $sql = "call SP_LISTAR_OPCION_TIPO_USUARIO_ADM()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}
		
        //LISTADO TIPO DE EXTRAESCOLAR
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

        //LISTADO TIPO DE EXTRAESCOLAR
        function listar_opcion_tipo_extraescolar_adm(){
            $sql = "call SP_LISTAR_OPCION_TIPO_EXTRAESCOLAR_ADM()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}

        //LISTADO CARRERAS
        function listar_opcion_carrera(){
            $sql = "call SP_LISTAR_OPCION_CARRERA()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}

        //LISTADO GRUPO DE EXTRAESCOLAR		
        function listar_opcion_grupo_extraescolar(){
            $sql = "call SP_LISTAR_OPCION_GRUPO_EXTRAESCOLAR()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}

        //LISTADO PERIODO
		function listar_opcion_periodo(){
            $sql = "call SP_LISTAR_OPCION_PERIODO()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}

        //LISTADO LUGAR
		function listar_opcion_lugar(){
            $sql = "call SP_LISTAR_OPCION_LUGAR()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}

		//LISTADO PROMOTOR
		function listar_opcion_promotor(){
            $sql = "call SP_LISTAR_OPCION_PROMOTOR()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}

		//LISTADO ADMINISTRADOR
		function listar_opcion_administrador(){
            $sql = "call SP_LISTAR_OPCION_ADMINISTRADOR()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}

		//LISTADO ALUMNO
		function listar_opcion_alumno(){
            $sql = "call SP_LISTAR_OPCION_ALUMNO()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}

		//LISTADO SEMESTRE
		function listar_opcion_semestre(){
            $sql = "call SP_LISTAR_OPCION_SEMESTRE()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}
		
        //LISTADO EXTRAESCOLAR
		function listar_opcion_extraescolar(){
            $sql = "call SP_LISTAR_OPCION_EXTRAESCOLAR()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}
		

		        //LISTADO EXTRAESCOLAR
		function listar_opcion_extraescolar_atletismo(){
            $sql = "call SP_LISTAR_OPCION_EXTRAESCOLAR_ATLETISMO()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}
		


				        //LISTADO EXTRAESCOLAR
		function listar_opcion_extraescolar_ajedrez(){
            $sql = "call SP_LISTAR_OPCION_EXTRAESCOLAR_AJEDREZ()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}


				        //LISTADO EXTRAESCOLAR
		function listar_opcion_extraescolar_baile_moderno(){
            $sql = "call SP_LISTAR_OPCION_EXTRAESCOLAR_BAILE_MODERNO()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}



				        //LISTADO EXTRAESCOLAR
		function listar_opcion_extraescolar_baile_salon(){
            $sql = "call SP_LISTAR_OPCION_EXTRAESCOLAR_BAILE_SALON()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}

				        //LISTADO EXTRAESCOLAR
		function listar_opcion_extraescolar_basquetbol(){
            $sql = "call SP_LISTAR_OPCION_EXTRAESCOLAR_BASQUETBOL()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}



				        //LISTADO EXTRAESCOLAR
		function listar_opcion_extraescolar_beisbol(){
            $sql = "call SP_LISTAR_OPCION_EXTRAESCOLAR_BEISBOL()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}


						        //LISTADO EXTRAESCOLAR
		function listar_opcion_extraescolar_cine_club(){
            $sql = "call SP_LISTAR_OPCION_EXTRAESCOLAR_CINE_CLUB()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}


				        //LISTADO EXTRAESCOLAR
		function listar_opcion_extraescolar_danza(){
            $sql = "call SP_LISTAR_OPCION_EXTRAESCOLAR_DANZA()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}


				        //LISTADO EXTRAESCOLAR
		function listar_opcion_extraescolar_escolta(){
            $sql = "call SP_LISTAR_OPCION_EXTRAESCOLAR_ESCOLTA()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}



				        //LISTADO EXTRAESCOLAR
		function listar_opcion_extraescolar_fotografia(){
            $sql = "call SP_LISTAR_OPCION_EXTRAESCOLAR_FOTOGRAFIA()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}

				        //LISTADO EXTRAESCOLAR
		function listar_opcion_extraescolar_futbol_femenil(){
            $sql = "call SP_LISTAR_OPCION_EXTRAESCOLAR_FUTBOL_FEMENIL()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}


				        //LISTADO EXTRAESCOLAR
		function listar_opcion_extraescolar_futbol_varonil(){
            $sql = "call SP_LISTAR_OPCION_EXTRAESCOLAR_FUTBOL_VARONIL()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}


				        //LISTADO EXTRAESCOLAR
		function listar_opcion_extraescolar_musica(){
            $sql = "call SP_LISTAR_OPCION_EXTRAESCOLAR_MUSICA()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}



				        //LISTADO EXTRAESCOLAR
		function listar_opcion_extraescolar_parkour(){
            $sql = "call SP_LISTAR_OPCION_EXTRAESCOLAR_PARKOUR()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}


				        //LISTADO EXTRAESCOLAR
		function listar_opcion_extraescolar_pintura_dibujo(){
            $sql = "call SP_LISTAR_OPCION_EXTRAESCOLAR_PINTURA_DIBUJO()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}


				        //LISTADO EXTRAESCOLAR
		function listar_opcion_extraescolar_softbol(){
            $sql = "call SP_LISTAR_OPCION_EXTRAESCOLAR_SOFTBOL()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}



				        //LISTADO EXTRAESCOLAR
		function listar_opcion_extraescolar_taekwondo(){
            $sql = "call SP_LISTAR_OPCION_EXTRAESCOLAR_TAEKWONDO()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}



				        //LISTADO EXTRAESCOLAR
		function listar_opcion_extraescolar_teatro(){
            $sql = "call SP_LISTAR_OPCION_EXTRAESCOLAR_TEATRO()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}


				        //LISTADO EXTRAESCOLAR
		function listar_opcion_extraescolar_voleibol(){
            $sql = "call SP_LISTAR_OPCION_EXTRAESCOLAR_VOLEIBOL()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}
























































































//------------------------------------------------------------- FIN LISTADO DE SELECT OPTIONS -------------------------------------------------------------------------


		
}










?>

