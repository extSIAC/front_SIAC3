//--------------------------------------------------------------- LOGIN --------------------------------------------------------
// FUNCIÓN DE VERIFICAR USUARIO - LLAMA LOS INPUT DEL FORMULARIO DEL LOGIN
function VerificarPromotor() {
    var LOG_PROMOTOR   = $("#PRO_USUARIO_LOGIN")   .val();
    var LOG_PRO_CONTRASENA = $("#PRO_CONTRASENA_LOGIN").val();

    // VALIDACIÓN DE CAMPOS VACÍOS
    if (LOG_PROMOTOR.length == 0 || LOG_PRO_CONTRASENA.length == 0) {
        return Swal.fire("CAMPOS VACÍOS", "Por favor, llene los campos vacíos.", "warning"); // Mensaje de advertencia para campos vacíos.
    }

    // Ajax para la recepción de paramétros.
    $.ajax({
            url: '../controlador/promotor/controlador_verificar_promotor.php', //Ruta del controlador
            type: 'POST',
            data: {
                DATO_PRO_USUARIO:   LOG_PROMOTOR,
                DATO_PRO_CONTRASENA:LOG_PRO_CONTRASENA
            }
        }) // Validación de que no encuentra el usuario o la contraseña.
        .done(function (resp) {
            alert(resp);
            if (resp == 0) {
                Swal.fire("ERROR", 'Usuario, correo y/o contraseña son incorrectos. Intente de nuevo.', "error");
            } else {
                // Validación del estado del usuario.
                var data = JSON.parse(resp);
                if (data[0][14] === 'INACTIVO') {
                    return Swal.fire("USUARIO INACTIVO", "El usuario " +LOG_PROMOTOR+ " se encuentra suspendido, comuníquese con el admnistrador.", "warning");
                }

                // Crear sesión
                $.ajax({
                    url: '../controlador/promotor/controlador_crear_sesion_promotor.php',
                    type: 'POST',
                    data: {
                        // Posición de los datos en la consulta del procedimento almacenado
                        VAR_PRO_ID_PROMOTOR:                data[0][0],  //PRO_ID_PROMOTOR         
	                    VAR_PRO_NOMBRE:                     data[0][1],  //PRO_NOMBRE                           
	                    VAR_PRO_APELLIDO_PATERNO:           data[0][2],  //PRO_APELLIDO_PATERNO         
	                    VAR_PRO_APELLIDO_MATERNO:           data[0][3],  //PRO_APELLIDO_MATERNO         
	                    VAR_PRO_EDAD:                       data[0][4],  //PRO_EDAD                
	                    VAR_PRO_SEXO:                       data[0][5],  //PRO_SEXO                
	                    VAR_PRO_TELEFONO:                   data[0][6],  //PRO_TELEFONO            
	                    VAR_PRO_CORREO_ELECTRONICO:         data[0][7],  //PRO_CORREO_ELECTRONICO    
	                    VAR_PRO_USUARIO:                    data[0][8],  //PRO_USUARIO             
	                    VAR_PRO_CONTRASENA:                 data[0][9],  //PRO_CONTRASENA          
	                    VAR_PRO_TIPUSU_ID_TIPO_USUARIO:     data[0][10], //TIPUSU_ID_TIPO_USUARIO      
                        VAR_PRO_TIPUSU_TIPO_USUARIO:        data[0][11], //TIPUSU_TIPO_USUARIO    
                        VAR_PRO_ESTADO:                     data[0][12]  //PRO_ESTADO
                    }
                }).done(function (resp) {
                    alert(resp);
                    let timerInterval
                    Swal.fire({
                        title: 'DEPARTAMENTO DE ACTIVIDADES EXTRAESCOLARES',
                        html: 'Ingresando...',
                        timer: 1000,
                        timerProgressBar: true,
                        confirmButton: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                            timerInterval = setInterval(() => {
                                const content = Swal.getContent()
                                if (content) {
                                    const b = content.querySelector('b')
                                    if (b) {
                                        b.textContent = Swal.getTimerLeft()
                                    }
                                }
                            }, 100)
                        },
                        onClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            location.reload();
                        }
                    })
                })

            }
        })
}
/*
//------------------------------------------------------------ LISTADO DE TABLA PROMOTOR -----------------------------------------------------------------------------
// Mostrar la tabla promotor
var table_pro;

function listar_promotor() {

    table_pro = $("#tabla_promotor").DataTable({ //ID de la tabla
        "ordering": true,
        "bLengthChange": true,
        "searching": { "regex": true },
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        "pageLength": 10,
        "destroy": true,
        "async": true,
        "processing": true,

        "ajax": {
            "url": "../controlador/promotor/controlador_promotor_listar.php",
            type: 'POST'
        },
        "columns": [
            { "data": "POSICION_PRO" },
            { "data": "PRO_APELLIDO_PATERNO" },
            { "data": "PRO_APELLIDO_MATERNO" },
            { "data": "PRO_NOMBRE" },
            { "data": "PRO_EDAD" },
            {
                "data": "PRO_SEXO",
                render: function(data, type, row) {
                    if (data == 'M') {
                        return "MASCULINO";
                    } else {
                        return "FEMENINO";
                    }
                }
            },
            { "data": "PRO_TELEFONO" },
            { "data": "PRO_CORREO_ELECTRONICO" },
            { "data": "PRO_USUARIO" },
            { "data": "TIPUSU_TIPO_USUARIO" },
            { "data": "TIPEXT_TIPO_EXTRAESCOLAR" },
            {
                "data": "PRO_ESTADO",
                render: function(data, type, row) {
                    if (data == 'ACTIVO') {
                        return "<span class='badge badge-pill badge-success'>" + data + "</span>";
                    } else {
                        return "<span class='badge badge-pill badge-danger' placeholder='dsd'>" + data + "</span>";
                    }
                }
            },

            {
                "data": "PRO_ESTADO",
                render: function(data, type, row) {
                    if (data == 'ACTIVO') {
                        return "<button disabled style='font-size:15px; height:30%; text-align:center;' type='button' class='activar btn btn-alt-success'><i class='si si-check'></i></button>&nbsp;<button style='font-size:15px; height:30%; text-align:center;' type='button' class='desactivar btn btn-alt-warning'><i class='si si-close'></i></button>&nbsp;<button style='font-size:15px; height:30%; text-align:center;' type='button' data-toggle='modal' data-target='#modal_editar_promotor' class='editar btn btn-alt-info'><i class='fa fa-edit'></i></button>&nbsp;<button style='font-size:15px; height:30%; text-align:center;' type='button' class='eliminar btn btn-alt-danger'><i class='fa fa-trash-o'></i></button>";
                    } else {
                        return "<button style='font-size:15px; height:30%; text-align:center;' type='button' class='activar btn btn-alt-success'><i class='si si-check'></i></button>&nbsp;<button disabled style='font-size:15px; height:30%; text-align:center;' type='button' class='desactivar btn btn-alt-warning'><i class='si si-close'></i></button>&nbsp;<button style='font-size:15px; height:30%; text-align:center;' type='button' data-toggle='modal' data-target='#modal_editar_promotor' class='editar btn btn-alt-info'><i class='fa fa-edit'></i></button>&nbsp;<button style='font-size:15px; height:30%; text-align:center;' type='button' class='eliminar btn btn-alt-danger'><i class='fa fa-trash-o'></i></button>";
                    }
                }
            }
        ],

        "language": idioma_espanol,
        select: true
    });

    document.getElementById("tabla_promotor_filter").style.display = "none";
    $('input.global_filter').on('keyup click', function() {
        filterGlobal();
    });
    $('input.column_filter').on('keyup click', function() {
        filterColumn($(this).parents('tr').attr('data-column'));
    });

}

function filterGlobal() {
    $('#tabla_Promotor').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}


function AbrirModalRegistropromotor() {
    $("#modal_registro_promotor").modal({ backdrop: 'static', keyboard: false })
    $("#modal_registro_promotor").modal('show');
}

//-------------------------------------------------------LISTADOS SELECT OPTIONS -----------------------------------------------------------
// Listado de opciones para los select options
function listar_opcion_tipo_usuario() {
    $.ajax({
        "url": "../controlador/promotor/controlador_listar_opcion_tipo_usuario.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
            }
            $("#opcion_tipo_usuario").html(cadena);
            $("#opcion_tipo_usuario_editar").html(cadena);
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#opcion_tipo_usuario").html(cadena);
            $("#opcion_tipo_usuario_editar").html(cadena);
        }
    })
}

function listar_opcion_tipo_extraescolar() {
    $.ajax({
        "url": "../controlador/promotor/controlador_listar_opcion_tipo_extraescolar.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
            }
            $("#opcion_tipo_extraescolar").html(cadena);
            $("#opcion_tipo_extraescolar_editar").html(cadena);
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#opcion_tipo_extraescolar").html(cadena);
            $("#opcion_tipo_extraescolar_editar").html(cadena);
        }
    })
}
 //------------------------------------------------------------- REGISTRO DE NUEVO USUARIO PROMOTOR ---------------------------------------------------- 

function Registrar_Usuario_Promotor() {
    var REG_PRO_NOMBRE              = $("#REG_PRO_NOMBRE").val();
    var REG_PRO_APELLIDO_PATERNO    = $("#REG_PRO_APELLIDO_PATERNO").val();
    var REG_PRO_APELLIDO_MATERNO    = $("#REG_PRO_APELLIDO_MATERNO").val();
    var REG_PRO_EDAD                = $("#REG_PRO_EDAD").val();
    var REG_PRO_SEXO                = $("#REG_PRO_SEXO").val();
    var REG_PRO_TELEFONO            = $("#REG_PRO_TELEFONO").val();
    var REG_PRO_CORREO              = $("#REG_PRO_CORREO").val();
    var REG_PRO_USUARIO             = $("#REG_PRO_USUARIO").val();
    var REG_PRO_CONTRASENA1         = $("#REG_PRO_CONTRASENA1").val();
    var REG_PRO_CONTRASENA2         = $("#REG_PRO_CONTRASENA2").val();
    var REG_PRO_TIPO_USUARIO        = $("#opcion_tipo_usuario").val();
    var REG_PRO_TIPO_EXTRAESCOLAR   = $("#opcion_tipo_extraescolar").val();
    var VALIDAR_CORREO              = $("#validar_correo").val();

    if (REG_PRO_NOMBRE.length == 0 || REG_PRO_APELLIDO_PATERNO.length == 0 ||
        REG_PRO_EDAD.length == 0 || REG_PRO_SEXO.length == 0 || REG_PRO_TELEFONO.length == 0 || REG_PRO_USUARIO.length == 0 || REG_PRO_CONTRASENA1.length == 0 ||
        REG_PRO_CONTRASENA2.length == 0 || REG_PRO_TIPO_USUARIO.length == 0 || REG_PRO_TIPO_EXTRAESCOLAR.length == 0) {
        return Swal.fire("VERIFICAR CAMPOS", "Por favor, llene los campos vacíos", "warning");
    }
    if (REG_PRO_EDAD < 17 || REG_PRO_EDAD > 99) {
        return Swal.fire("VERIFICAR EDAD", "Por favor, ingrese una edad válida", "warning");
    }
    if (VALIDAR_CORREO == "incorrecto") {
        return Swal.fire("VERIFICAR CORREO ELECTRÓNICO", "Por favor, ingrese un formato de correo válido", "warning");
    } 

    if (REG_PRO_CONTRASENA1 != REG_PRO_CONTRASENA2) {
        return Swal.fire("VERIFICAR CONTRASEÑA", "Las contraseñas deben coincidir", "warning");
    }

    if (REG_PRO_CONTRASENA1.length < 8) {
        return Swal.fire("VERIFICAR CONTRASEÑA", "La contraseña debe contener al menos 8 caracteres", "warning");
    }

    $.ajax({
        "url": "../controlador/promotor/controlador_promotor_registro.php",
        type: 'POST',
        data: {
            REG_PRO_NOMBRE: REG_PRO_NOMBRE,
            REG_PRO_APELLIDO_PATERNO: REG_PRO_APELLIDO_PATERNO,
            REG_PRO_APELLIDO_MATERNO: REG_PRO_APELLIDO_MATERNO,
            REG_PRO_EDAD: REG_PRO_EDAD,
            REG_PRO_SEXO: REG_PRO_SEXO,
            REG_PRO_TELEFONO: REG_PRO_TELEFONO,
            REG_PRO_CORREO: REG_PRO_CORREO,
            REG_PRO_USUARIO: REG_PRO_USUARIO,
            REG_PRO_CONTRASENA: REG_PRO_CONTRASENA1,
            REG_PRO_ID_TIPO_USUARIO: REG_PRO_TIPO_USUARIO,
            REG_PRO_ID_TIPO_EXTRAESCOLAR: REG_PRO_TIPO_EXTRAESCOLAR
        }
    }).done(function (resp) {
        alert(resp);
        if (resp > 0) {
            if (resp == 1) {
                Swal.fire("REGISTRO EXITOSO", "Datos correctos, nuevo usuario registrado", "success")
                    .then((value) => {
                        LimpiarRegistro();
                        table_pro.ajax.reload();
                    });
            } else {
                return Swal.fire("ADVERTENCIA", "El nombre del usuario ingresado se encuentra registrado en la base de datos", "warning");
            }
        } else {
            Swal.fire("ERROR", "No fue posible realizar el registro en la base de datos", "error", );
        }
    })
}

//Limpeza del formulario
function LimpiarRegistro() {
    $("#REG_PRO_NOMBRE").val("");
    $("#REG_PRO_APELLIDO_PATERNO").val("");
    $("#REG_PRO_APELLIDO_MATERNO").val("");
    $("#REG_PRO_EDAD").val("");
    $("#REG_PRO_TELEFONO").val("");
    $("#REG_PRO_CORREO").val("");
    $("#REG_PRO_USUARIO").val("");
    $("#REG_PRO_CONTRASENA1").val("");
    $("#REG_PRO_CONTRASENA2").val("");
}

//---------------------------------------------------------- MODIFICACIÓN DEL ESTADO DEL USUARIO PROMOTOR ----------------------------------------------------------------------------------

function Modificar_Estado_PROMOTOR(MOD_PRO_ID_PROMOTOR, MOD_PRO_ESTADO) {
    var mensaje = "";
    if (MOD_PRO_ESTADO == 'INACTIVO') {
        mensaje = "desactivó";
    } else {
        mensaje = "activó";
    }
    $.ajax({
        "url": "../controlador/promotor/controlador_modificar_estado_promotor.php",
        type: 'POST',
        data: {
            MOD_PRO_ID_PROMOTOR:   MOD_PRO_ID_PROMOTOR,
            MOD_PRO_ESTADO:             MOD_PRO_ESTADO
        }

    }).done(function(resp) {
        if (resp > 0) {
            Swal.fire("MODIFICACIÓN EXITOSA", "El usuario se " + mensaje + " con éxito", "success")
                .then((value) => {
                    table_pro.ajax.reload();
                });
        }
    })
}

//----------------------------------------------------------- BOTONES DE ACCIONES ----------------------------------------------------------------------------
// BOTÓN ACTIVAR
$('#tabla_Promotor').on('click', '.activar', function() {
    var data = table_pro.row($(this).parents('tr')).data();
    if (table_pro.row(this).child.isShown()) {
        var data = table_pro.row(this).data();
    }
    Swal.fire({
        title: '¿Desea activar al usuario?',
        text: "Una vez realizada la acción, el usuario tendrá acceso al sistema",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí'
    }).then((result) => {
        if (result.value) {
            Modificar_Estado_Promotor(data.PRO_ID_PROMOTOR, 'ACTIVO');
        }
    })
})

// BOTÓN DESACTIVAR
$('#tabla_promotor').on('click', '.desactivar', function () {
    var data = table_pro.row($(this).parents('tr')).data();
    if (table_pro.row(this).child.isShown()) {
        var data = table_pro.row(this).data();
    }
    Swal.fire({
        title: '¿Desea desactivar al usuario?',
        text: "Una vez realizada la acción, el usuario no tendrá acceso al sistema",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí'
    }).then((result) => {
        if (result.value) {
            Modificar_Estado_Promotor(data.PRO_ID_PROMOTOR, 'INACTIVO');
        }
    })
})

// BOTÓN EDITAR
$('#tabla_promotor').on('click', '.editar', function () {
    var data = table_pro.row($(this).parents('tr')).data();
    if (table_pro.row(this).child.isShown()) {
        var data = table_pro.row(this).data();
    }
    $("#EDIT_PRO_ID_PROMOTOR").val(data.PRO_ID_PROMOTOR);
    $("#EDIT_PRO_USUARIO").val(data.PRO_USUARIO);
    $("#EDIT_PRO_NOMBRE").val(data.PRO_NOMBRE);
    $("#EDIT_PRO_APELLIDO_PATERNO").val(data.PRO_APELLIDO_PATERNO);
    $("#EDIT_PRO_APELLIDO_MATERNO").val(data.PRO_APELLIDO_MATERNO);
    $("#EDIT_PRO_EDAD").val(data.PRO_EDAD);
    $("#EDIT_PRO_SEXO").val(data.PRO_SEXO).trigger("change");
    $("#EDIT_PRO_TELEFONO").val(data.PRO_TELEFONO);
    $("#EDIT_PRO_CORREO").val(data.PRO_CORREO_ELECTRONICO);
    $("#opcion_tipo_usuario_editar").val(data.TIPUSU_ID_TIPO_USUARIO).trigger("change");
    $("#opcion_tipo_promotor_editar").val(data.TIPEXT_ID_TIPO_EXTRAESCOLAR).trigger("change");
});

//--------------------------------- MODIFICACIÓN DE LOS DATOS DEL USUARIO PROMOTOR --------------------------------------

function Editar_Usuario_PROMOTOR() {
    var EDIT_PRO_ID_PROMOTOR       = $("#EDIT_PRO_ID_PROMOTOR").val();
    var EDIT_PRO_NOMBRE                 = $("#EDIT_PRO_NOMBRE").val();
    var EDIT_PRO_APELLIDO_PATERNO       = $("#EDIT_PRO_APELLIDO_PATERNO").val();
    var EDIT_PRO_APELLIDO_MATERNO       = $("#EDIT_PRO_APELLIDO_MATERNO").val();
    var EDIT_PRO_EDAD                   = $("#EDIT_PRO_EDAD").val();
    var EDIT_PRO_SEXO                   = $("#EDIT_PRO_SEXO").val();
    var EDIT_PRO_TELEFONO               = $("#EDIT_PRO_TELEFONO").val();
    var EDIT_PRO_CORREO                 = $("#EDIT_PRO_CORREO").val();
    var EDIT_PRO_ID_TIPO_USUARIO        = $("#opcion_tipo_usuario_editar").val();
    var EDIT_PRO_ID_TIPO_EXTRAESCOLAR   = $("#opcion_tipo_extraescolar_editar").val();
    var EDIT_VALIDAR_CORREO             = $("#editar_validar_correo").val();

    if (EDIT_PRO_NOMBRE.length == 0 || EDIT_PRO_APELLIDO_PATERNO.length == 0 || EDIT_PRO_APELLIDO_MATERNO.length == 0 ||
        EDIT_PRO_EDAD.length == 0 || EDIT_PRO_SEXO.length == 0 || EDIT_PRO_TELEFONO.length == 0 ||
        EDIT_PRO_CORREO.length == 0 || EDIT_PRO_ID_TIPO_USUARIO.length == 0 || EDIT_PRO_ID_TIPO_EXTRAESCOLAR.length == 0) {
        return Swal.fire("VERIFICAR CAMPOS", "Por favor, llene los campos vacíos", "warning");
    }
    if (EDIT_PRO_EDAD < 17 || EDIT_PRO_EDAD > 99) {
        return Swal.fire("VERIFICAR EDAD", "Por favor, ingrese una edad válida", "warning");
    }
    if (EDIT_VALIDAR_CORREO == "incorrecto") {
        return Swal.fire("VERIFICAR CORREO ELECTRÓNICO", "Por favor, ingrese un formato de correo válido", "warning");
    } 
    $.ajax({
        "url": "../controlador/promotor/controlador_promotor_editar.php",
        type: 'POST',
        data: {
            EDIT_PRO_ID_PROMOTOR: EDIT_PRO_ID_PROMOTOR,
            EDIT_PRO_NOMBRE: EDIT_PRO_NOMBRE,
            EDIT_PRO_APELLIDO_PATERNO: EDIT_PRO_APELLIDO_PATERNO,
            EDIT_PRO_APELLIDO_MATERNO: EDIT_PRO_APELLIDO_MATERNO,
            EDIT_PRO_EDAD: EDIT_PRO_EDAD,
            EDIT_PRO_SEXO: EDIT_PRO_SEXO,
            EDIT_PRO_TELEFONO: EDIT_PRO_TELEFONO,
            EDIT_PRO_CORREO: EDIT_PRO_CORREO,
            EDIT_PRO_ID_TIPO_USUARIO: EDIT_PRO_ID_TIPO_USUARIO,
            EDIT_PRO_ID_TIPO_EXTRAESCOLAR: EDIT_PRO_ID_TIPO_EXTRAESCOLAR
        }
    }).done(function(resp) {
        alert(resp);
        if (resp > 0) {
            Swal.fire("MODIFICACIÓN EXITOSA", "Datos correctamente registrados, usuario modifcado", "success")
                .then((value) => {
                    table_pro.ajax.reload();
                    TraerDatosUsuario();
                });
        } else {
            Swal.fire("ERROR", "No fue posible la modificación en la base de datos", "error");
        }
    })
}

//------------------------------------ FIN DE .JS PROMOTOR -----------------------------------------------------

//---------------------------------------- DATOS DEL USUARIO ----------------------------------------------
    function TraerDatosUsuario() {
        var DATOS_USUARIO_PRINCIPAL = $("#USUARIO_PRINCIPAL").val();
        $.ajax({
            "url": "../controlador/promotor/controlador_traer_datos_usuario_PROnistrador.php",
            type: 'POST',
            data: {
                DATOS_USUARIO_PRINCIPAL: DATOS_USUARIO_PRINCIPAL
            }
        }).done(function (resp) {
            var data = JSON.parse(resp);
            if (data.length > 0) {
                $("#EDITAR_CONTRASENA_ACTUAL_BD").val(data[0][9]);
                if (data[0][5] === "M") {
                    $("#IMAGEN_USUARIO").attr("src", "../public/assets/img/avatars/hombre.jpg");
                    $("#IMAGEN_USUARIO_MINI").attr("src", "../public/assets/img/avatars/hombre.jpg");
                } else {
                    $("#IMAGEN_USUARIO").attr("src", "../public/assets/img/avatars/mujer.jpg");
                    $("#IMAGEN_USUARIO_MINI").attr("src", "../public/assets/img/avatars/mujer.jpg");
                }
            }
        })
    }
//---------------------------------------------- CONFIGURAR CONTRASEÑA ------------------------------------
        function ConfigurarContrasenaUsuarioPromotor(){
            var CON_CON_ID_USUARIO  = $("#ID_USUARIO_PRINCIPAL").val();
            var CON_CON_ACTUAL_BD   = $("#EDITAR_CONTRASENA_ACTUAL_BD").val();
            var CON_CON_ACTUAL      = $("#EDITAR_CONTRASENA_ACTUAL").val();
            var CON_CON_NUEVA       = $("#EDITAR_CONTRASENA_NUEVA").val();
            var CON_CON_REPETIR     = $("#EDITAR_CONTRASENA_REPETIR").val();
            
            if (CON_CON_NUEVA.length == 0 || CON_CON_REPETIR.length == 0 || CON_CON_ACTUAL.length == 0) {
                return Swal.fire("VERIFICAR CAMPOS", "Por favor, llene los campos vacíos", "warning");
            }
            if (CON_CON_NUEVA != CON_CON_REPETIR) {
                return Swal.fire("VERIFICAR CONTRASEÑA", "Las contraseñas deben coincidir", "warning");
            }

            $.ajax({
                url: '../controlador/promotor/controlador_configurar_contrasena_promotor.php',
                type: 'POST',
                data: {
                    CON_CON_ID_USUARIO: CON_CON_ID_USUARIO,
                    CON_CON_ACTUAL_BD:  CON_CON_ACTUAL_BD,
                    CON_CON_ACTUAL:     CON_CON_ACTUAL,
                    CON_CON_NUEVA:      CON_CON_NUEVA
                }
            }).done(function (resp) {
                if (resp > 0) {
                    
                    if (resp == 1) {
                        LimpiarEditarContrasena();
                        Swal.fire("MODIFICACIÓN EXITOSA", "Contraseña correctamente modificada", "success")
                            .then((value) => {
                                TraerDatosUsuario();
                            });
                    } else {
                        Swal.fire("VERIFICAR CONTRASEÑA ACTUAL", "Ingrese correctamente la contraseña actual de su cuenta antes de configurarla", "warning");
                    }

                } else {
                    Swal.fire("ERROR", "No fue posible la modificación de la contraseña en la base de datos", "error");
                }
            })
        }

        //Limpeza del formulario
        function LimpiarEditarContrasena() {
            $("#EDITAR_CONTRASENA_ACTUAL").val("");
            $("#EDITAR_CONTRASENA_NUEVA").val("");
            $("#EDITAR_CONTRASENA_REPETIR").val("");
        }

function Restablecer_Contrasena_Usuario_Promotor() {
    var REC_CORREO_USUARIO_PROMOTOR = $("#REC_CORREO_USUARIO_PROMOTOR").val();
    if (REC_CORREO_USUARIO_PROMOTOR.length == 0) {
        return Swal.fire("CAMPO VACÍO", "No se ha ingresado ningún correo.", "warning");
    }
    var caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    var contrasena_aleatoria = "";
    for (var i = 0; i < 6; i++){
        contrasena_aleatoria += caracteres.charAt(Math.floor(Math.random()*caracteres.length));
    }
    alert(contrasena_aleatoria);
            $.ajax({
                url: '../controlador/promotor/controlador_restablecer_contrasena_promotor.php',
                type: 'POST',
                data: {
                    REC_CORREO_USUARIO_PROMOTOR:   REC_CORREO_USUARIO_PROMOTOR,
                    CONTRASENA_ALEATORIA:               contrasena_aleatoria
                }
            }).done(function (resp) {
                alert(resp);
            })

        
    
        }*/