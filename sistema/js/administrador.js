//##################################################################################################### LOGIN ####################################################################################################
// FUNCIÓN DE VERIFICAR USUARIO - LLAMA LOS INPUT DEL FORMULARIO DEL LOGIN
function VerificarAdministrador() {
    var LOG_ADMINISTRADOR   = $("#ADM_USUARIO_LOGIN")   .val();
    var LOG_CONTRASENA      = $("#ADM_CONTRASENA_LOGIN").val();

    // VALIDACIÓN DE CAMPOS VACÍOS
    if (LOG_ADMINISTRADOR.length == 0 || LOG_CONTRASENA.length == 0) {
        return Swal.fire("CAMPOS VACÍOS", "Por favor, llene los campos vacíos.", "warning"); // Mensaje de advertencia para campos vacíos.
    }

    // Ajax para la recepción de paramétros.
    $.ajax({
            url: '../controlador/administrador/controlador_verificar_administrador.php', //Ruta del controlador
            type: 'POST',
            data: {
                DATO_ADM_USUARIO:   LOG_ADMINISTRADOR,
                DATO_ADM_CONTRASENA:LOG_CONTRASENA
            }
        }) // Validación de que no encuentra el usuario o la contraseña.
        .done(function (resp) {
                   if (resp == 0) {
                Swal.fire("ERROR", 'Usuario, correo y/o contraseña son incorrectos. Intente de nuevo.', "error");
            } else {
                // Validación del estado del usuario.
                var data = JSON.parse(resp);
                if (data[0][14] === 'INACTIVO') {
                    return Swal.fire("USUARIO INACTIVO", "El usuario " +LOG_ADMINISTRADOR+ " se encuentra suspendido, comuníquese con el administrador.", "warning");
                }

                // Crear sesión
                $.ajax({
                    url: '../controlador/administrador/controlador_crear_sesion_administrador.php',
                    type: 'POST',
                    data: {
                        // Posición de los datos en la consulta del procedimento almacenado
                        VAR_ADM_ID_ADMINISTRADOR:           data[0][0],  //ADM_ID_ADMINISTRADOR         
	                    VAR_ADM_NOMBRE:                     data[0][1],  //ADM_NOMBRE                           
	                    VAR_ADM_APELLIDO_PATERNO:           data[0][2],  //ADM_APELLIDO_PATERNO         
	                    VAR_ADM_APELLIDO_MATERNO:           data[0][3],  //ADM_APELLIDO_MATERNO         
	                    VAR_ADM_EDAD:                       data[0][4],  //ADM_EDAD                
	                    VAR_ADM_SEXO:                       data[0][5],  //ADM_SEXO                
	                    VAR_ADM_TELEFONO:                   data[0][6],  //ADM_TELEFONO            
	                    VAR_ADM_CORREO_ELECTRONICO:         data[0][7],  //ADM_CORREO_ELECTRONICO    
	                    VAR_ADM_USUARIO:                    data[0][8],  //ADM_USUARIO             
	                    VAR_ADM_CONTRASENA:                 data[0][9],  //ADM_CONTRASENA          
	                    VAR_ADM_TIPUSU_ID_TIPO_USUARIO:     data[0][10], //TIPUSU_ID_TIPO_USUARIO      
                        VAR_ADM_TIPUSU_TIPO_USUARIO:        data[0][11], //TIPUSU_TIPO_USUARIO    
                        VAR_ADM_TIPEXT_ID_TIPO_EXTRAESCOLAR:data[0][12], //TIPUSU_TIPO_USUARIO   
                        VAR_ADM_TIPEXT_TIPO_EXTRAESCOLAR:   data[0][13], //TIPUSU_TIPO_USUARIO   
                        VAR_ADM_ESTADO:                     data[0][14]  //TIPUSU_TIPO_USUARIO   
                    }
                }).done(function (resp) {

                    let timerInterval
                    Swal.fire({
                        title: 'DEPARTAMENTO DE ACTIVIDADES EXTRAESCOLARES',
                        html: 'Ingresando...',
                        timer: 1500,
                        timerProgressBar: true,
                        confirmButton: false,
                        showConfirmButton: false,
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

//################################################################################################# USUARIO PRINCIPAL #############################################################################################
//---------------------------------------- DATOS DEL USUARIO ----------------------------------------------
    function TraerDatosUsuario() {
        var DATOS_USUARIO_PRINCIPAL = $("#USUARIO_PRINCIPAL").val();
        $.ajax({
            "url": "../controlador/administrador/controlador_traer_datos_usuario_admnistrador.php",
            type: 'POST',
            data: {
                DATOS_USUARIO_PRINCIPAL: DATOS_USUARIO_PRINCIPAL
            }
        }).done(function (resp) {
            var data = JSON.parse(resp);
            if (data.length > 0) {
                $("#EDITAR_CONTRASENA_ACTUAL_BD").val(data[0][9]);
                $("#TRAER_DATO_TIPO_EXTRAESCOLAR_USUARIO_PRINCIPAL").val(data[0][13]);
                if (data[0][5] === "M") {
                    $("#IMAGEN_USUARIO").attr("src", "../public/assets/img/avatars/hombre.png");
                    $("#IMAGEN_USUARIO_MINI").attr("src", "../public/assets/img/avatars/hombre.png");
                } else {
                    $("#IMAGEN_USUARIO").attr("src", "../public/assets/img/avatars/mujer.png");
                    $("#IMAGEN_USUARIO_MINI").attr("src", "../public/assets/img/avatars/mujer.png");
                }
            }
        })
    }
//---------------------------------------------- CONFIGURAR CONTRASEÑA ------------------------------------
        function ConfigurarContrasenaUsuarioAdministrador(){
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
                url: '../controlador/administrador/controlador_configurar_contrasena_administrador.php',
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

function Restablecer_Contrasena_Usuario_Administrador() {
    var REC_CORREO_USUARIO_ADMINISTRADOR = $("#REC_CORREO_USUARIO_ADMINISTRADOR").val();
    if (REC_CORREO_USUARIO_ADMINISTRADOR.length == 0) {
        return Swal.fire("CAMPO VACÍO", "No se ha ingresado ningún correo.", "warning");
    }
    var caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    var contrasena_aleatoria = "";
    for (var i = 0; i < 6; i++){
        contrasena_aleatoria += caracteres.charAt(Math.floor(Math.random()*caracteres.length));
    }
            $.ajax({
                url: '../controlador/administrador/controlador_restablecer_contrasena_administrador.php',
                type: 'POST',
                data: {
                    REC_CORREO_USUARIO_ADMINISTRADOR:   REC_CORREO_USUARIO_ADMINISTRADOR,
                    CONTRASENA_ALEATORIA:               contrasena_aleatoria
                }
            }).done(function (resp) {
            })

        
    
}
        
//#################################################################################################################################################################################################################



//################################################################################################ TABLA ADMINISTRADOR #############################################################################################

//--------------------------------------------------------------------------- INICIO LISTADO DE TABLA ADMINISTRADOR PERFIL ADMINISTRADOR ------------------------------------------------------------------------------

// Mostrar la tabla administrador
var table_administrador_adm;
function listar_administrador() {

    table_administrador_adm = $("#tabla_administrador").DataTable({ //ID de la tabla
        "ordering": true,
        "bLengthChange": true,
        "searching": { "regex": true },
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "TODOS"]
        ],
            "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        }],

        "dom": 'Bfrtip',
        "buttons": [
            {
                "extend": 'copyHtml5',
                "text": 'COPIAR'
            },
            {
                "extend": 'excelHtml5',
                "text": 'EXCEL'
            },
            {
                "extend": 'csvHtml5',
                "text": 'CVS'
            }],
        
        "order": [[ 1, 'asc' ]],
        "pageLength": 10,
        "destroy": true,
        "async": true,
        "processing": true,

        "ajax": {
            "url": "../controlador/administrador/controlador_administrador_listar.php",
            type: 'POST'
        },
        "columns": [
            { "data": "ADM_ID_ADMINISTRADOR" },
            { "data": "ADM_APELLIDO_PATERNO" },
            { "data": "ADM_APELLIDO_MATERNO" },
            { "data": "ADM_NOMBRE" },
            { "data": "ADM_EDAD" },
            {
                "data": "ADM_SEXO",
                render: function(data, type, row) {
                    if (data == 'M') {
                        return "MASCULINO";
                    } else {
                        return "FEMENINO";
                    }
                }
            },
            { "data": "ADM_TELEFONO" },
            { "data": "ADM_CORREO_ELECTRONICO" },
            { "data": "ADM_USUARIO" },
            { "data": "TIPUSU_TIPO_USUARIO" },
            { "data": "TIPEXT_TIPO_EXTRAESCOLAR" },
            {
                "data": "ADM_ESTADO",
                render: function(data, type, row) {
                    if (data == 'ACTIVO') {
                        return "<span class='badge badge-pill badge-success'>" + data + "</span>";
                    } else {
                        return "<span class='badge badge-pill badge-danger' placeholder='dsd'>" + data + "</span>";
                    }
                }
            },

            {
                "data": "ADM_ESTADO",
                render: function(data, type, row) {
                    if (data == 'ACTIVO') {
                        return "<button style='font-size:15px; height:30%; text-align:center;' type='button' class='desactivar btn btn-alt-danger'><i class='si si-close'></i></button>&nbsp;<button style='font-size:15px; height:30%; text-align:center;' type='button' data-toggle='modal' data-target='#modal_editar_administrador' class='editar btn btn-alt-info'><i class='fa fa-edit'></i></button>";
                    } else {
                        return "<button style='font-size:15px; height:30%; text-align:center;' type='button' class='activar btn btn-alt-success'><i class='si si-check'></i></button>&nbsp;<button style='font-size:15px; height:30%; text-align:center;' type='button' data-toggle='modal' data-target='#modal_editar_administrador' class='editar btn btn-alt-info'><i class='fa fa-edit'></i></button>";
                    }
                }
            }
        ],

        "language": idioma_espanol,
        select: true
    });

  document.getElementById("tabla_administrador_filter").style.display="none";
   $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
    } );
    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    });



    table_administrador_adm.on( 'order.dt search.dt', function () {
        table_administrador_adm.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();







}

function filterGlobal() {
    $('#tabla_administrador').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}


function AbrirModalRegistroAdministrador() {
    $("#modal_registro_administrador_adm").modal({ backdrop: 'static', keyboard: false })
    $("#modal_registro_administrador_adm").modal('show');
}


//--------------------------------------------------------------------------- FIN LISTADO DE TABLA ADMINISTRADOR PERFIL ADMINISTRADOR ------------------------------------------------------------------------------


 //------------------------------------------------------------------------------ INICIO REGISTRO DE NUEVO USUARIO ADMINISTRADOR -----------------------------------------------------------------------------------

function Registrar_Usuario_Administrador() {
    var REG_ADM_NOMBRE              = $("#REG_ADM_NOMBRE").val();
    var REG_ADM_APELLIDO_PATERNO    = $("#REG_ADM_APELLIDO_PATERNO").val();
    var REG_ADM_APELLIDO_MATERNO    = $("#REG_ADM_APELLIDO_MATERNO").val();
    var REG_ADM_EDAD                = $("#REG_ADM_EDAD").val();
    var REG_ADM_SEXO                = $("#REG_ADM_SEXO").val();
    var REG_ADM_TELEFONO            = $("#REG_ADM_TELEFONO").val();
    var REG_ADM_CORREO              = $("#REG_ADM_CORREO").val();
    var REG_ADM_USUARIO             = $("#REG_ADM_USUARIO").val();
    var REG_ADM_CONTRASENA1         = $("#REG_ADM_CONTRASENA1").val();
    var REG_ADM_CONTRASENA2         = $("#REG_ADM_CONTRASENA2").val();
    var REG_ADM_TIPO_EXTRAESCOLAR   = $("#opcion_tipo_extraescolar_adm").val();
    var VALIDAR_CORREO              = $("#validar_correo").val();

    if (REG_ADM_NOMBRE.length == 0 || REG_ADM_APELLIDO_PATERNO.length == 0 ||
        REG_ADM_EDAD.length == 0 || REG_ADM_SEXO.length == 0 || REG_ADM_TELEFONO.length == 0 || REG_ADM_USUARIO.length == 0 || REG_ADM_CONTRASENA1.length == 0 ||
        REG_ADM_CONTRASENA2.length == 0 || REG_ADM_TIPO_EXTRAESCOLAR.length == 0) {
        return Swal.fire("VERIFICAR CAMPOS", "Por favor, llene los campos vacíos", "warning");
    }
    if (REG_ADM_EDAD < 17 || REG_ADM_EDAD > 99) {
        return Swal.fire("VERIFICAR EDAD", "Por favor, ingrese una edad válida", "warning");
    }
    if (VALIDAR_CORREO == "incorrecto") {
        return Swal.fire("VERIFICAR CORREO ELECTRÓNICO", "Por favor, ingrese un formato de correo válido", "warning");
    } 

    if (REG_ADM_CONTRASENA1 != REG_ADM_CONTRASENA2) {
        return Swal.fire("VERIFICAR CONTRASEÑA", "Las contraseñas deben coincidir", "warning");
    }

    if (REG_ADM_CONTRASENA1.length < 8) {
        return Swal.fire("VERIFICAR CONTRASEÑA", "La contraseña debe contener al menos 8 caracteres", "warning");
    }

    $.ajax({
        "url": "../controlador/administrador/controlador_administrador_registro.php",
        type: 'POST',
        data: {
            REG_ADM_NOMBRE: REG_ADM_NOMBRE,
            REG_ADM_APELLIDO_PATERNO: REG_ADM_APELLIDO_PATERNO,
            REG_ADM_APELLIDO_MATERNO: REG_ADM_APELLIDO_MATERNO,
            REG_ADM_EDAD: REG_ADM_EDAD,
            REG_ADM_SEXO: REG_ADM_SEXO,
            REG_ADM_TELEFONO: REG_ADM_TELEFONO,
            REG_ADM_CORREO: REG_ADM_CORREO,
            REG_ADM_USUARIO: REG_ADM_USUARIO,
            REG_ADM_CONTRASENA: REG_ADM_CONTRASENA1,
            REG_ADM_ID_TIPO_EXTRAESCOLAR: REG_ADM_TIPO_EXTRAESCOLAR
        }
    }).done(function (resp) {
        if (resp > 0) {
            if (resp == 1) {
                Swal.fire("REGISTRO EXITOSO", "Datos correctos, nuevo administrador registrado", "success")
                    .then((value) => {
                        LimpiarRegistro();
                        table_administrador_adm.ajax.reload();
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
    $("#REG_ADM_NOMBRE").val("");
    $("#REG_ADM_APELLIDO_PATERNO").val("");
    $("#REG_ADM_APELLIDO_MATERNO").val("");
    $("#REG_ADM_EDAD").val("");
    $("#REG_ADM_SEXO").val("").trigger("change");
    $("#REG_ADM_TELEFONO").val("");
    $("#REG_ADM_CORREO").val("");
    $("#REG_ADM_USUARIO").val("");
    $("#REG_ADM_CONTRASENA1").val("");
    $("#REG_ADM_CONTRASENA2").val("");
    $("#opcion_tipo_extraescolar_adm_editar").val("").trigger("change");
}

 //-------------------------------------------------------------------------------- FIN REGISTRO DE NUEVO USUARIO ADMINISTRADOR -----------------------------------------------------------------------------------


//----------------------------------------------------------------------------- INICIO MODIFICACIÓN DEL ESTADO DEL USUARIO ADMINISTRADOR ----------------------------------------------------------------------------------

function Modificar_Estado_Administrador(MOD_ADM_ID_ADMINISTRADOR, MOD_ADM_ESTADO) {
    var mensaje = "";
    if (MOD_ADM_ESTADO == 'INACTIVO') {
        mensaje = "desactivó";
    } else {
        mensaje = "activó";
    }
    $.ajax({
        "url": "../controlador/administrador/controlador_modificar_estado_administrador.php",
        type: 'POST',
        data: {
            MOD_ADM_ID_ADMINISTRADOR:   MOD_ADM_ID_ADMINISTRADOR,
            MOD_ADM_ESTADO:             MOD_ADM_ESTADO
        }

    }).done(function(resp) {
        if (resp > 0) {
            Swal.fire("MODIFICACIÓN EXITOSA", "El usuario se " + mensaje + " con éxito", "success")
                .then((value) => {
                    table_administrador_adm.ajax.reload();
                });
        }
    })
}

//----------------------------------------------------------------------------- FIN MODIFICACIÓN DEL ESTADO DEL USUARIO ADMINISTRADOR ----------------------------------------------------------------------------------


//--------------------------------------------------------------------------------- INICIO DE BOTONES DE ACCIONES ADMINISTRADOR ----------------------------------------------------------------------------
// BOTÓN ACTIVAR
$('#tabla_administrador').on('click', '.activar', function() {
    var data = table_administrador_adm.row($(this).parents('tr')).data();
    if (table_administrador_adm.row(this).child.isShown()) {
        var data = table_administrador_adm.row(this).data();
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
            Modificar_Estado_Administrador(data.ADM_ID_ADMINISTRADOR, 'ACTIVO');
        }
    })
})

// BOTÓN DESACTIVAR
$('#tabla_administrador').on('click', '.desactivar', function () {
    var data = table_administrador_adm.row($(this).parents('tr')).data();
    if (table_administrador_adm.row(this).child.isShown()) {
        var data = table_administrador_adm.row(this).data();
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
            Modificar_Estado_Administrador(data.ADM_ID_ADMINISTRADOR, 'INACTIVO');
        }
    })
})

// BOTÓN EDITAR
$('#tabla_administrador').on('click', '.editar', function () {
    var data = table_administrador_adm.row($(this).parents('tr')).data();
    if (table_administrador_adm.row(this).child.isShown()) {
        var data = table_administrador_adm.row(this).data();
    }
    $("#EDIT_ADM_ID_ADMINISTRADOR").val(data.ADM_ID_ADMINISTRADOR);
    $("#EDIT_ADM_USUARIO").val(data.ADM_USUARIO);
    $("#EDIT_ADM_NOMBRE").val(data.ADM_NOMBRE);
    $("#EDIT_ADM_APELLIDO_PATERNO").val(data.ADM_APELLIDO_PATERNO);
    $("#EDIT_ADM_APELLIDO_MATERNO").val(data.ADM_APELLIDO_MATERNO);
    $("#EDIT_ADM_EDAD").val(data.ADM_EDAD);
    $("#EDIT_ADM_SEXO").val(data.ADM_SEXO).trigger("change");
    $("#EDIT_ADM_TELEFONO").val(data.ADM_TELEFONO);
    $("#EDIT_ADM_CORREO").val(data.ADM_CORREO_ELECTRONICO);
    $("#opcion_tipo_extraescolar_adm_editar").val(data.TIPEXT_ID_TIPO_EXTRAESCOLAR).trigger("change");
});

//---------------------------------------------------------------------------------- FIN DE BOTONES DE ACCIONES ADMINISTRADOR ----------------------------------------------------------------------------------------

//----------------------------------------------------------------------------- INICIO MODIFICACIÓN DE LOS DATOS DEL USUARIO ADMINISTRADOR ----------------------------------------------------------------------------------







function Editar_Usuario_Administrador() {
    var EDIT_ADM_ID_ADMINISTRADOR       = $("#EDIT_ADM_ID_ADMINISTRADOR").val();
    var EDIT_ADM_NOMBRE                 = $("#EDIT_ADM_NOMBRE").val();
    var EDIT_ADM_APELLIDO_PATERNO       = $("#EDIT_ADM_APELLIDO_PATERNO").val();
    var EDIT_ADM_APELLIDO_MATERNO       = $("#EDIT_ADM_APELLIDO_MATERNO").val();
    var EDIT_ADM_EDAD                   = $("#EDIT_ADM_EDAD").val();
    var EDIT_ADM_SEXO                   = $("#EDIT_ADM_SEXO").val();
    var EDIT_ADM_TELEFONO               = $("#EDIT_ADM_TELEFONO").val();
    var EDIT_ADM_CORREO                 = $("#EDIT_ADM_CORREO").val();
    var EDIT_VALIDAR_CORREO             = $("#editar_validar_correo").val();
    var EDIT_ADM_ID_TIPO_EXTRAESCOLAR   = $("#opcion_tipo_extraescolar_adm_editar").val();


    if (EDIT_ADM_NOMBRE.length == 0 || EDIT_ADM_APELLIDO_PATERNO.length == 0 || EDIT_ADM_APELLIDO_MATERNO.length == 0 ||
        EDIT_ADM_EDAD.length == 0 || EDIT_ADM_SEXO.length == 0 || EDIT_ADM_TELEFONO.length == 0 ||
        EDIT_ADM_CORREO.length == 0) {
        return Swal.fire("VERIFICAR CAMPOS", "Por favor, llene los campos vacíos", "warning");
    }
    if (EDIT_ADM_EDAD < 17 || EDIT_ADM_EDAD > 99) {
        return Swal.fire("VERIFICAR EDAD", "Por favor, ingrese una edad válida", "warning");
    }
    if (EDIT_VALIDAR_CORREO == "incorrecto") {
        return Swal.fire("VERIFICAR CORREO ELECTRÓNICO", "Por favor, ingrese un formato de correo válido", "warning");
    } 
    $.ajax({
        "url": "../controlador/administrador/controlador_administrador_editar.php",
        type: 'POST',
        data: {
            EDIT_ADM_ID_ADMINISTRADOR: EDIT_ADM_ID_ADMINISTRADOR,
            EDIT_ADM_NOMBRE: EDIT_ADM_NOMBRE,
            EDIT_ADM_APELLIDO_PATERNO: EDIT_ADM_APELLIDO_PATERNO,
            EDIT_ADM_APELLIDO_MATERNO: EDIT_ADM_APELLIDO_MATERNO,
            EDIT_ADM_EDAD: EDIT_ADM_EDAD,
            EDIT_ADM_SEXO: EDIT_ADM_SEXO,
            EDIT_ADM_TELEFONO: EDIT_ADM_TELEFONO,
            EDIT_ADM_CORREO: EDIT_ADM_CORREO,
            EDIT_ADM_ID_TIPO_EXTRAESCOLAR: EDIT_ADM_ID_TIPO_EXTRAESCOLAR
        }
    }).done(function(resp) {

        if (resp > 0) {
            Swal.fire("MODIFICACIÓN EXITOSA", "Datos correctamente registrados, usuario modifcado", "success")
                .then((value) => {
                    table_administrador_adm.ajax.reload();
                    TraerDatosUsuario();
                });
        } else {
            Swal.fire("ERROR", "No fue posible la modificación en la base de datos", "error");
        }
    })
}

//------------------------------------------------------------------------------ FIN MODIFICACIÓN DE LOS DATOS DEL USUARIO ADMINISTRADOR ----------------------------------------------------------------------------------

//############################################################################################ FIN DE TABLA ADMINISTRADOR #############################################################################################





//################################################################################################ TABLA PROMOTOR #############################################################################################

//--------------------------------------------------------------------------- INICIO LISTADO DE TABLA PROMOTOR PERFIL ADMINISTRADOR ------------------------------------------------------------------------------

// Mostrar la tabla promotor
var table_promotor_adm;

function listar_promotor() {

    table_promotor_adm = $("#tabla_promotor").DataTable({ //ID de la tabla
            "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        }],
        "dom": 'Bfrtip',
        "buttons": [
            {
                "extend": 'copyHtml5',
                "text": 'COPIAR'
            },
            {
                "extend": 'excelHtml5',
                "text": 'EXCEL'
            },
            {
                "extend": 'csvHtml5',
                "text": 'CVS'
            }],
        "order": [[ 1, 'asc' ]],

        "ordering": true,
        "bLengthChange": true,
        "searching": { "regex": true },
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "TODOS"]
        ],
        "pageLength": 10,
        "destroy": true,
        "async": true,
        "processing": true,

        "ajax": {
            "url": "../controlador/administrador/controlador_promotor_listar.php",
            type: 'POST'
        },
        "columns": [
            { "data": "PRO_ID_PROMOTOR" },
            { "data": "PRO_NOMBRE" },
            { "data": "PRO_APELLIDO_PATERNO" },
            { "data": "PRO_APELLIDO_MATERNO" },
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
                        return "<button style='font-size:15px; height:30%; text-align:center;' type='button' class='desactivar btn btn-alt-danger'><i class='si si-close'></i></button>&nbsp;<button style='font-size:15px; height:30%; text-align:center;' type='button' data-toggle='modal' data-target='#modal_editar_promotor' class='editar btn btn-alt-info'><i class='fa fa-edit'></i></button>";
                    } else {
                        return "<button style='font-size:15px; height:30%; text-align:center;' type='button' class='activar btn btn-alt-success'><i class='si si-check'></i></button>&nbsp;<button style='font-size:15px; height:30%; text-align:center;' type='button' data-toggle='modal' data-target='#modal_editar_promotor' class='editar btn btn-alt-info'><i class='fa fa-edit'></i></button>";
                    }
                }
            }
        ],

        "language": idioma_espanol,
        select: true
    });


  document.getElementById("tabla_promotor_filter").style.display="none";
   $('input.global_filter').on( 'keyup click', function () {
        filterGlobal_pro();
    } );
    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    });


   table_promotor_adm.on( 'order.dt search.dt', function () {
        table_promotor_adm.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();



}

function filterGlobal_pro() {
    $('#tabla_promotor').DataTable().search(
        $('#global_filter_pro').val(),
    ).draw();
}


//--------------------------------------------------------------------------- FIN LISTADO DE TABLA PROMOTOR PERFIL ADMINISTRADOR ------------------------------------------------------------------------------


 //------------------------------------------------------------------------------ INICIO REGISTRO DE NUEVO USUARIO PROMOTOR -----------------------------------------------------------------------------------

function Registrar_Usuario_Promotor() {
    var REG_PRO_NOMBRE                      = $("#REG_PRO_NOMBRE").val();
    var REG_PRO_APELLIDO_PATERNO            = $("#REG_PRO_APELLIDO_PATERNO").val();
    var REG_PRO_APELLIDO_MATERNO            = $("#REG_PRO_APELLIDO_MATERNO").val();
    var REG_PRO_EDAD                        = $("#REG_PRO_EDAD").val();
    var REG_PRO_SEXO                        = $("#REG_PRO_SEXO").val();
    var REG_PRO_TELEFONO                    = $("#REG_PRO_TELEFONO").val();
    var REG_PRO_CORREO                      = $("#REG_PRO_CORREO").val();
    var REG_PRO_USUARIO                     = $("#REG_PRO_USUARIO").val();
    var REG_PRO_CONTRASENA1                 = $("#REG_PRO_CONTRASENA1").val();
    var REG_PRO_CONTRASENA2                 = $("#REG_PRO_CONTRASENA2").val();
    var REG_PRO_TIPEXT_TIPO_EXTRAESCOLAR    = $("#opcion_tipo_extraescolar").val();
    var VALIDAR_CORREO                      = $("#validar_correo").val();

    if (REG_PRO_NOMBRE.length == 0 || REG_PRO_APELLIDO_PATERNO.length == 0 ||
        REG_PRO_EDAD.length == 0 || REG_PRO_SEXO.length == 0 || REG_PRO_TELEFONO.length == 0 ||
        REG_PRO_USUARIO.length == 0 || REG_PRO_CONTRASENA1.length == 0 ||
        REG_PRO_CONTRASENA2.length == 0 || REG_PRO_TIPEXT_TIPO_EXTRAESCOLAR.length == 0) {
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
        "url": "../controlador/administrador/controlador_promotor_registro.php",
        type: 'POST',
        data: {
            REG_PRO_NOMBRE:                     REG_PRO_NOMBRE,
            REG_PRO_APELLIDO_PATERNO:           REG_PRO_APELLIDO_PATERNO,
            REG_PRO_APELLIDO_MATERNO:           REG_PRO_APELLIDO_MATERNO,
            REG_PRO_EDAD:                       REG_PRO_EDAD,
            REG_PRO_SEXO:                       REG_PRO_SEXO,
            REG_PRO_TELEFONO:                   REG_PRO_TELEFONO,
            REG_PRO_CORREO:                     REG_PRO_CORREO,
            REG_PRO_USUARIO:                    REG_PRO_USUARIO,
            REG_PRO_CONTRASENA:                 REG_PRO_CONTRASENA1,
            REG_PRO_TIPEXT_TIPO_EXTRAESCOLAR:   REG_PRO_TIPEXT_TIPO_EXTRAESCOLAR
        }
    }).done(function (resp) {
        if (resp > 0) {
            if (resp == 1) {
                Swal.fire("REGISTRO EXITOSO", "Datos correctos, nuevo usuario registrado", "success")
                    .then((value) => {
                        LimpiarRegistroPro();
                        table_promotor_adm.ajax.reload();
                        table_promotor_adm_actividades_deportivas.ajax.reload();
                        table_promotor_adm_actividades_culturales.ajax.reload();
                        listar_extraescolar_horario_actividades_culturales.ajax.reload();
                        listar_extraescolar_horario_actividades_deportivas.ajax.reload();
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
function LimpiarRegistroPro() {
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

 //-------------------------------------------------------------------------------- FIN REGISTRO DE NUEVO USUARIO PROMOTOR -----------------------------------------------------------------------------------


//----------------------------------------------------------------------------- INICIO MODIFICACIÓN DEL ESTADO DEL USUARIO PROMOTOR ----------------------------------------------------------------------------------

function Modificar_Estado_Promotor(MOD_PRO_ID_PROMOTOR, MOD_PRO_ESTADO) {
    var mensaje = "";
    if (MOD_PRO_ESTADO == 'INACTIVO') {
        mensaje = "desactivó";
    } else {
        mensaje = "activó";
    }
    $.ajax({
        "url": "../controlador/administrador/controlador_modificar_estado_promotor.php",
        type: 'POST',
        data: {
            MOD_PRO_ID_PROMOTOR:   MOD_PRO_ID_PROMOTOR,
            MOD_PRO_ESTADO:        MOD_PRO_ESTADO
        }

    }).done(function(resp) {
        if (resp > 0) {
            Swal.fire("MODIFICACIÓN EXITOSA", "El usuario se " + mensaje + " con éxito", "success")
                .then((value) => {
                    table_promotor_adm.ajax.reload();
                    table_promotor_adm_actividades_deportivas.ajax.reload();
                    table_promotor_adm_actividades_culturales.ajax.reload();
                });
        }
    })
}

//----------------------------------------------------------------------------- FIN MODIFICACIÓN DEL ESTADO DEL USUARIO PROMOTOR ----------------------------------------------------------------------------------


//--------------------------------------------------------------------------------- INICIO DE BOTONES DE ACCIONES PROMOTOR ----------------------------------------------------------------------------

// BOTÓN ACTIVAR
$('#tabla_promotor').on('click', '.activar', function() {
    var data = table_promotor_adm.row($(this).parents('tr')).data();
    if (table_promotor_adm.row(this).child.isShown()) {
        var data = table_promotor_adm.row(this).data();
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
    var data = table_promotor_adm.row($(this).parents('tr')).data();
    if (table_promotor_adm.row(this).child.isShown()) {
        var data = table_promotor_adm.row(this).data();
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
    var data = table_promotor_adm.row($(this).parents('tr')).data();
    if (table_promotor_adm.row(this).child.isShown()) {
        var data = table_promotor_adm.row(this).data();
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
    $("#opcion_tipo_extraescolar_editar").val(data.TIPEXT_ID_TIPO_EXTRAESCOLAR).trigger("change");
});

//---------------------------------------------------------------------------------- FIN DE BOTONES DE ACCIONES PROMOTOR ----------------------------------------------------------------------------------------


//----------------------------------------------------------------------------- INICIO MODIFICACIÓN DE LOS DATOS DEL USUARIO PROMOTOR ----------------------------------------------------------------------------------


function Editar_Usuario_Promotor() {
    var EDIT_PRO_ID_PROMOTOR            = $("#EDIT_PRO_ID_PROMOTOR").val();
    var EDIT_PRO_NOMBRE                 = $("#EDIT_PRO_NOMBRE").val();
    var EDIT_PRO_APELLIDO_PATERNO       = $("#EDIT_PRO_APELLIDO_PATERNO").val();
    var EDIT_PRO_APELLIDO_MATERNO       = $("#EDIT_PRO_APELLIDO_MATERNO").val();
    var EDIT_PRO_EDAD                   = $("#EDIT_PRO_EDAD").val();
    var EDIT_PRO_SEXO                   = $("#EDIT_PRO_SEXO").val();
    var EDIT_PRO_TELEFONO               = $("#EDIT_PRO_TELEFONO").val();
    var EDIT_PRO_CORREO                 = $("#EDIT_PRO_CORREO").val();
    var EDIT_PRO_TIPO_EXTRAESCOLAR      = $("#opcion_tipo_extraescolar_editar").val();
    var EDIT_VALIDAR_CORREO             = $("#editar_validar_correo").val();

    if (EDIT_PRO_NOMBRE.length == 0 || EDIT_PRO_APELLIDO_PATERNO.length == 0 || EDIT_PRO_APELLIDO_MATERNO.length == 0 ||
        EDIT_PRO_EDAD.length == 0 || EDIT_PRO_SEXO.length == 0 || EDIT_PRO_TELEFONO.length == 0 ||
        EDIT_PRO_CORREO.length == 0 || EDIT_PRO_TIPO_EXTRAESCOLAR.length == 0) {
        return Swal.fire("VERIFICAR CAMPOS", "Por favor, llene los campos vacíos", "warning");
    }
    if (EDIT_PRO_EDAD < 17 || EDIT_PRO_EDAD > 99) {
        return Swal.fire("VERIFICAR EDAD", "Por favor, ingrese una edad válida", "warning");
    }
    if (EDIT_VALIDAR_CORREO == "incorrecto") {
        return Swal.fire("VERIFICAR CORREO ELECTRÓNICO", "Por favor, ingrese un formato de correo válido", "warning");
    } 
    $.ajax({
        "url": "../controlador/administrador/controlador_promotor_editar.php",
        type: 'POST',
        data: {
            EDIT_PRO_ID_PROMOTOR:       EDIT_PRO_ID_PROMOTOR,
            EDIT_PRO_NOMBRE:            EDIT_PRO_NOMBRE,
            EDIT_PRO_APELLIDO_PATERNO:  EDIT_PRO_APELLIDO_PATERNO,
            EDIT_PRO_APELLIDO_MATERNO:  EDIT_PRO_APELLIDO_MATERNO,
            EDIT_PRO_EDAD:              EDIT_PRO_EDAD,
            EDIT_PRO_SEXO:              EDIT_PRO_SEXO,
            EDIT_PRO_TELEFONO:          EDIT_PRO_TELEFONO,
            EDIT_PRO_CORREO:            EDIT_PRO_CORREO,
            EDIT_PRO_TIPO_EXTRAESCOLAR: EDIT_PRO_TIPO_EXTRAESCOLAR
        }
    }).done(function(resp) {
          if (resp > 0) {
            Swal.fire("MODIFICACIÓN EXITOSA", "Datos correctamente registrados, usuario modifcado", "success")
                .then((value) => {
                    table_promotor_adm.ajax.reload();
                    table_promotor_adm_actividades_deportivas.ajax.reload();
                    table_promotor_adm_actividades_culturales.ajax.reload();
                    TraerDatosUsuario();
                });
        } else {
            Swal.fire("ERROR", "No fue posible la modificación en la base de datos", "error");
        }
    })
}

//----------------------------------------------------------------------------- FIN MODIFICACIÓN DE LOS DATOS DEL USUARIO PROMOTOR ----------------------------------------------------------------------------------

//############################################################################################ FIN DE TABLA PROMOTOR #############################################################################################







//################################################################################### TABLA PROMOTOR ACTIVIDADES DEPORTIVAS #############################################################################################

//----------------------------------------------------------------- INICIO LISTADO DE TABLA PROMOTOR PERFIL ADMINISTRADOR ACTIVIDADES DEPORTIVAS ------------------------------------------------------------------------------

// Mostrar la tabla promotor
var table_promotor_adm_actividades_deportivas;

function listar_promotor_actividades_deportivas() {

    table_promotor_adm_actividades_deportivas = $("#tabla_promotor_actividades_deportivas").DataTable({ //ID de la tabla
            "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        "order": [[1, 'asc']],
        "dom": 'Bfrtip',
        "buttons": [
            {
                "extend": 'copyHtml5',
                "text": 'COPIAR'
            },
            {
                "extend": 'excelHtml5',
                "text": 'EXCEL'
            },
            {
                "extend": 'csvHtml5',
                "text": 'CVS'
            }],
        "ordering": true,
        "bLengthChange": true,
        "searching": { "regex": true },
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "TODOS"]
        ],
        "pageLength": 10,
        "destroy": true,
        "async": true,
        "processing": true,

        "ajax": {
            "url": "../controlador/administrador/controlador_promotor_actividades_deportivas_listar.php",
            type: 'POST'
        },
        "columns": [
            { "data": "PRO_ID_PROMOTOR" },
            { "data": "PRO_NOMBRE" },
            { "data": "PRO_APELLIDO_PATERNO" },
            { "data": "PRO_APELLIDO_MATERNO" },
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
                        return "<button style='font-size:15px; height:30%; text-align:center;' type='button' class='desactivar btn btn-alt-danger'><i class='si si-close'></i></button>&nbsp;<button style='font-size:15px; height:30%; text-align:center;' type='button' data-toggle='modal' data-target='#modal_editar_promotor' class='editar btn btn-alt-info'><i class='fa fa-edit'></i></button>";
                    } else {
                        return "<button style='font-size:15px; height:30%; text-align:center;' type='button' class='activar btn btn-alt-success'><i class='si si-check'></i></button>&nbsp;<button style='font-size:15px; height:30%; text-align:center;' type='button' data-toggle='modal' data-target='#modal_editar_promotor' class='editar btn btn-alt-info'><i class='fa fa-edit'></i></button>";
                    }
                }
            }
        ],

        "language": idioma_espanol,
        select: true
    });

    document.getElementById("tabla_promotor_actividades_deportivas_filter").style.display = "none";
    $('input.global_filter').on('keyup click', function() {
        filterGlobal_pro_actividades_deportivas();
    });
    $('input.column_filter').on('keyup click', function() {
        filterColumn($(this).parents('tr').attr('data-column'));
    });


   table_promotor_adm_actividades_deportivas.on( 'order.dt search.dt', function () {
        table_promotor_adm_actividades_deportivas.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

}

function filterGlobal_pro_actividades_deportivas() {
    $('#tabla_promotor_actividades_deportivas').DataTable().search(
        $('#global_filter_pro_actividades_deportivas').val(),
    ).draw();
}


//--------------------------------------------------------------------------- FIN LISTADO DE TABLA PROMOTOR PERFIL ADMINISTRADOR ------------------------------------------------------------------------------


 //------------------------------------------------------------------------------ INICIO REGISTRO DE NUEVO USUARIO PROMOTOR -----------------------------------------------------------------------------------

function Registrar_Usuario_Promotor_Actividades_Deportivas() {
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
    var VALIDAR_CORREO              = $("#validar_correo").val();

    if (REG_PRO_NOMBRE.length == 0 || REG_PRO_APELLIDO_PATERNO.length == 0 ||
        REG_PRO_EDAD.length == 0 || REG_PRO_SEXO.length == 0 || REG_PRO_TELEFONO.length == 0 || REG_PRO_USUARIO.length == 0 || REG_PRO_CONTRASENA1.length == 0 ||
        REG_PRO_CONTRASENA2.length == 0) {
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
        "url": "../controlador/administrador/controlador_promotor_actividades_deportivas_registro.php",
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
            REG_PRO_CONTRASENA: REG_PRO_CONTRASENA1
        }
    }).done(function (resp) {

        if (resp > 0) {
            if (resp == 1) {
                Swal.fire("REGISTRO EXITOSO", "Datos correctos, nuevo usuario registrado", "success")
                    .then((value) => {
                        LimpiarRegistroPro();
                        table_promotor_adm.ajax.reload();
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
function LimpiarRegistroProActividadesDeportivas() {
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

 //-------------------------------------------------------------------------------- FIN REGISTRO DE NUEVO USUARIO PROMOTOR -----------------------------------------------------------------------------------


//----------------------------------------------------------------------------- INICIO MODIFICACIÓN DEL ESTADO DEL USUARIO PROMOTOR ----------------------------------------------------------------------------------

function Modificar_Estado_Promotor_Actividades_Deportivas(MOD_PRO_ID_PROMOTOR, MOD_PRO_ESTADO) {
    var mensaje = "";
    if (MOD_PRO_ESTADO == 'INACTIVO') {
        mensaje = "desactivó";
    } else {
        mensaje = "activó";
    }
    $.ajax({
        "url": "../controlador/administrador/controlador_modificar_estado_promotor_actividades_deportivas.php",
        type: 'POST',
        data: {
            MOD_PRO_ID_PROMOTOR:   MOD_PRO_ID_PROMOTOR,
            MOD_PRO_ESTADO:             MOD_PRO_ESTADO
        }

    }).done(function(resp) {
        if (resp > 0) {
            Swal.fire("MODIFICACIÓN EXITOSA", "El usuario se " + mensaje + " con éxito", "success")
                .then((value) => {
                    table_promotor_adm.ajax.reload();
                    table_promotor_adm_actividades_deportivas.ajax.reload();
                });
        }
    })
}

//----------------------------------------------------------------------------- FIN MODIFICACIÓN DEL ESTADO DEL USUARIO PROMOTOR ----------------------------------------------------------------------------------


//--------------------------------------------------------------------------------- INICIO DE BOTONES DE ACCIONES PROMOTOR ----------------------------------------------------------------------------

// BOTÓN ACTIVAR
$('#tabla_promotor_actividades_deportivas').on('click', '.activar', function() {
    var data = table_promotor_adm_actividades_deportivas.row($(this).parents('tr')).data();
    if (table_promotor_adm_actividades_deportivas.row(this).child.isShown()) {
        var data = table_promotor_adm_actividades_deportivas.row(this).data();
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
            Modificar_Estado_Promotor_Actividades_Deportivas(data.PRO_ID_PROMOTOR, 'ACTIVO');
        }
    })
})

// BOTÓN DESACTIVAR
$('#tabla_promotor_actividades_deportivas').on('click', '.desactivar', function () {
    var data = table_promotor_adm_actividades_deportivas.row($(this).parents('tr')).data();
    if (table_promotor_adm_actividades_deportivas.row(this).child.isShown()) {
        var data = table_promotor_adm_actividades_deportivas.row(this).data();
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
            Modificar_Estado_Promotor_Actividades_Deportivas(data.PRO_ID_PROMOTOR, 'INACTIVO');
        }
    })
})

// BOTÓN EDITAR
$('#tabla_promotor_actividades_deportivas').on('click', '.editar', function () {
    var data = table_promotor_adm_actividades_deportivas.row($(this).parents('tr')).data();
    if (table_promotor_adm_actividades_deportivas.row(this).child.isShown()) {
        var data = table_promotor_adm_actividades_deportivas.row(this).data();
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
    $("#opcion_tipo_extraescolar_editar").val(data.TIPEXT_ID_TIPO_EXTRAESCOLAR).trigger("change");
});

//---------------------------------------------------------------------------------- FIN DE BOTONES DE ACCIONES PROMOTOR ----------------------------------------------------------------------------------------


//----------------------------------------------------------------------------- INICIO MODIFICACIÓN DE LOS DATOS DEL USUARIO PROMOTOR ----------------------------------------------------------------------------------


function Editar_Usuario_Promotor_Actividades_Deportivas() {
    var EDIT_PRO_ID_PROMOTOR            = $("#EDIT_PRO_ID_PROMOTOR").val();
    var EDIT_PRO_NOMBRE                 = $("#EDIT_PRO_NOMBRE").val();
    var EDIT_PRO_APELLIDO_PATERNO       = $("#EDIT_PRO_APELLIDO_PATERNO").val();
    var EDIT_PRO_APELLIDO_MATERNO       = $("#EDIT_PRO_APELLIDO_MATERNO").val();
    var EDIT_PRO_EDAD                   = $("#EDIT_PRO_EDAD").val();
    var EDIT_PRO_SEXO                   = $("#EDIT_PRO_SEXO").val();
    var EDIT_PRO_TELEFONO               = $("#EDIT_PRO_TELEFONO").val();
    var EDIT_PRO_CORREO                 = $("#EDIT_PRO_CORREO").val();
    var EDIT_VALIDAR_CORREO             = $("#editar_validar_correo").val();

    if (EDIT_PRO_NOMBRE.length == 0 || EDIT_PRO_APELLIDO_PATERNO.length == 0 || EDIT_PRO_APELLIDO_MATERNO.length == 0 ||
        EDIT_PRO_EDAD.length == 0 || EDIT_PRO_SEXO.length == 0 || EDIT_PRO_TELEFONO.length == 0 ||
        EDIT_PRO_CORREO.length == 0) {
        return Swal.fire("VERIFICAR CAMPOS", "Por favor, llene los campos vacíos", "warning");
    }
    if (EDIT_PRO_EDAD < 17 || EDIT_PRO_EDAD > 99) {
        return Swal.fire("VERIFICAR EDAD", "Por favor, ingrese una edad válida", "warning");
    }
    if (EDIT_VALIDAR_CORREO == "incorrecto") {
        return Swal.fire("VERIFICAR CORREO ELECTRÓNICO", "Por favor, ingrese un formato de correo válido", "warning");
    } 
    $.ajax({
        "url": "../controlador/administrador/controlador_promotor_actividades_deportivas_editar.php",
        type: 'POST',
        data: {
            EDIT_PRO_ID_PROMOTOR: EDIT_PRO_ID_PROMOTOR,
            EDIT_PRO_NOMBRE: EDIT_PRO_NOMBRE,
            EDIT_PRO_APELLIDO_PATERNO: EDIT_PRO_APELLIDO_PATERNO,
            EDIT_PRO_APELLIDO_MATERNO: EDIT_PRO_APELLIDO_MATERNO,
            EDIT_PRO_EDAD: EDIT_PRO_EDAD,
            EDIT_PRO_SEXO: EDIT_PRO_SEXO,
            EDIT_PRO_TELEFONO: EDIT_PRO_TELEFONO,
            EDIT_PRO_CORREO: EDIT_PRO_CORREO
        }
    }).done(function(resp) {

        if (resp > 0) {
            Swal.fire("MODIFICACIÓN EXITOSA", "Datos correctamente registrados, usuario modifcado", "success")
                .then((value) => {
                    table_promotor_adm.ajax.reload();
                    table_promotor_adm_actividades_deportivas.ajax.reload();
                    TraerDatosUsuario();
                });
        } else {
            Swal.fire("ERROR", "No fue posible la modificación en la base de datos", "error");
        }
    })
}

//----------------------------------------------------------------------------- FIN MODIFICACIÓN DE LOS DATOS DEL USUARIO PROMOTOR ----------------------------------------------------------------------------------

//############################################################################## FIN DE TABLA PROMOTOR ACTIVIDADES DEPORTIVAS #############################################################################################




//################################################################################### TABLA PROMOTOR ACTIVIDADES CULTURALES #############################################################################################

//----------------------------------------------------------------- INICIO LISTADO DE TABLA PROMOTOR PERFIL ADMINISTRADOR ACTIVIDADES CULTURALES ------------------------------------------------------------------------------

// Mostrar la tabla promotor
var table_promotor_adm_actividades_culturales;

function listar_promotor_actividades_culturales() {

    table_promotor_adm_actividades_culturales = $("#tabla_promotor_actividades_culturales").DataTable({ //ID de la tabla
            "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        }],
        "dom": 'Bfrtip',
        "buttons": [
            {
                "extend": 'copyHtml5',
                "text": 'COPIAR'
            },
            {
                "extend": 'excelHtml5',
                "text": 'EXCEL'
            },
            {
                "extend": 'csvHtml5',
                "text": 'CVS'
            }],
        "order": [[1, 'asc']],
        "ordering": true,
        "bLengthChange": true,
        "searching": { "regex": true },
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "TODOS"]
        ],
        "pageLength": 10,
        "destroy": true,
        "async": true,
        "processing": true,

        "ajax": {
            "url": "../controlador/administrador/controlador_promotor_actividades_culturales_listar.php",
            type: 'POST'
        },
        "columns": [
            { "data": "PRO_ID_PROMOTOR" },
            { "data": "PRO_NOMBRE" },
            { "data": "PRO_APELLIDO_PATERNO" },
            { "data": "PRO_APELLIDO_MATERNO" },
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
                        return "<button style='font-size:15px; height:30%; text-align:center;' type='button' class='desactivar btn btn-alt-danger'><i class='si si-close'></i></button>&nbsp;<button style='font-size:15px; height:30%; text-align:center;' type='button' data-toggle='modal' data-target='#modal_editar_promotor' class='editar btn btn-alt-info'><i class='fa fa-edit'></i></button>";
                    } else {
                        return "<button style='font-size:15px; height:30%; text-align:center;' type='button' class='activar btn btn-alt-success'><i class='si si-check'></i></button>&nbsp;<button style='font-size:15px; height:30%; text-align:center;' type='button' data-toggle='modal' data-target='#modal_editar_promotor' class='editar btn btn-alt-info'><i class='fa fa-edit'></i></button>";
                    }
                }
            }
        ],

        "language": idioma_espanol,
        select: true
    });

    document.getElementById("tabla_promotor_actividades_culturales_filter").style.display = "none";
    $('input.global_filter').on('keyup click', function() {
        filterGlobal_pro_actividades_culturales();
    });
    $('input.column_filter').on('keyup click', function() {
        filterColumn($(this).parents('tr').attr('data-column'));
    });

   table_promotor_adm_actividades_culturales.on( 'order.dt search.dt', function () {
        table_promotor_adm_actividades_culturales.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();


}

function filterGlobal_pro_actividades_culturales() {
    $('#tabla_promotor_actividades_culturales').DataTable().search(
        $('#global_filter_pro_actividades_culturales').val(),
    ).draw();
}


//--------------------------------------------------------------------------- FIN LISTADO DE TABLA PROMOTOR PERFIL ADMINISTRADOR ------------------------------------------------------------------------------


 //------------------------------------------------------------------------------ INICIO REGISTRO DE NUEVO USUARIO PROMOTOR -----------------------------------------------------------------------------------

function Registrar_Usuario_Promotor_Actividades_Culturales() {
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
    var VALIDAR_CORREO              = $("#validar_correo").val();

    if (REG_PRO_NOMBRE.length == 0 || REG_PRO_APELLIDO_PATERNO.length == 0 ||
        REG_PRO_EDAD.length == 0 || REG_PRO_SEXO.length == 0 || REG_PRO_TELEFONO.length == 0 || REG_PRO_USUARIO.length == 0 || REG_PRO_CONTRASENA1.length == 0 ||
        REG_PRO_CONTRASENA2.length == 0) {
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
        "url": "../controlador/administrador/controlador_promotor_actividades_culturales_registro.php",
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
            REG_PRO_CONTRASENA: REG_PRO_CONTRASENA1
        }
    }).done(function (resp) {

        if (resp > 0) {
            if (resp == 1) {
                Swal.fire("REGISTRO EXITOSO", "Datos correctos, nuevo usuario registrado", "success")
                    .then((value) => {
                        LimpiarRegistroPro();
                        table_promotor_adm.ajax.reload();
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
function LimpiarRegistroProActividadesCulturales() {
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

 //-------------------------------------------------------------------------------- FIN REGISTRO DE NUEVO USUARIO PROMOTOR -----------------------------------------------------------------------------------


//----------------------------------------------------------------------------- INICIO MODIFICACIÓN DEL ESTADO DEL USUARIO PROMOTOR ----------------------------------------------------------------------------------

function Modificar_Estado_Promotor_Actividades_Culturales(MOD_PRO_ID_PROMOTOR, MOD_PRO_ESTADO) {
    var mensaje = "";
    if (MOD_PRO_ESTADO == 'INACTIVO') {
        mensaje = "desactivó";
    } else {
        mensaje = "activó";
    }
    $.ajax({
        "url": "../controlador/administrador/controlador_modificar_estado_promotor_actividades_culturales.php",
        type: 'POST',
        data: {
            MOD_PRO_ID_PROMOTOR:   MOD_PRO_ID_PROMOTOR,
            MOD_PRO_ESTADO:             MOD_PRO_ESTADO
        }

    }).done(function(resp) {
        if (resp > 0) {
            Swal.fire("MODIFICACIÓN EXITOSA", "El usuario se " + mensaje + " con éxito", "success")
                .then((value) => {
                    table_promotor_adm.ajax.reload();
                    table_promotor_adm_actividades_culturales.ajax.reload();
                });
        }
    })
}

//----------------------------------------------------------------------------- FIN MODIFICACIÓN DEL ESTADO DEL USUARIO PROMOTOR ----------------------------------------------------------------------------------


//--------------------------------------------------------------------------------- INICIO DE BOTONES DE ACCIONES PROMOTOR ----------------------------------------------------------------------------

// BOTÓN ACTIVAR
$('#tabla_promotor_actividades_culturales').on('click', '.activar', function() {
    var data = table_promotor_adm_actividades_culturales.row($(this).parents('tr')).data();
    if (table_promotor_adm_actividades_culturales.row(this).child.isShown()) {
        var data = table_promotor_adm_actividades_culturales.row(this).data();
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
            Modificar_Estado_Promotor_Actividades_Culturales(data.PRO_ID_PROMOTOR, 'ACTIVO');
        }
    })
})

// BOTÓN DESACTIVAR
$('#tabla_promotor_actividades_culturales').on('click', '.desactivar', function () {
    var data = table_promotor_adm_actividades_culturales.row($(this).parents('tr')).data();
    if (table_promotor_adm_actividades_culturales.row(this).child.isShown()) {
        var data = table_promotor_adm_actividades_culturales.row(this).data();
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
            Modificar_Estado_Promotor_Actividades_Culturales(data.PRO_ID_PROMOTOR, 'INACTIVO');
        }
    })
})

// BOTÓN EDITAR
$('#tabla_promotor_actividades_culturales').on('click', '.editar', function () {
    var data = table_promotor_adm_actividades_culturales.row($(this).parents('tr')).data();
    if (table_promotor_adm_actividades_culturales.row(this).child.isShown()) {
        var data = table_promotor_adm_actividades_culturales.row(this).data();
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
    $("#opcion_tipo_extraescolar_editar").val(data.TIPEXT_ID_TIPO_EXTRAESCOLAR).trigger("change");
});

//---------------------------------------------------------------------------------- FIN DE BOTONES DE ACCIONES PROMOTOR ----------------------------------------------------------------------------------------


//----------------------------------------------------------------------------- INICIO MODIFICACIÓN DE LOS DATOS DEL USUARIO PROMOTOR ----------------------------------------------------------------------------------


function Editar_Usuario_Promotor_Actividades_Culturales() {
    var EDIT_PRO_ID_PROMOTOR            = $("#EDIT_PRO_ID_PROMOTOR").val();
    var EDIT_PRO_NOMBRE                 = $("#EDIT_PRO_NOMBRE").val();
    var EDIT_PRO_APELLIDO_PATERNO       = $("#EDIT_PRO_APELLIDO_PATERNO").val();
    var EDIT_PRO_APELLIDO_MATERNO       = $("#EDIT_PRO_APELLIDO_MATERNO").val();
    var EDIT_PRO_EDAD                   = $("#EDIT_PRO_EDAD").val();
    var EDIT_PRO_SEXO                   = $("#EDIT_PRO_SEXO").val();
    var EDIT_PRO_TELEFONO               = $("#EDIT_PRO_TELEFONO").val();
    var EDIT_PRO_CORREO                 = $("#EDIT_PRO_CORREO").val();
    var EDIT_VALIDAR_CORREO             = $("#editar_validar_correo").val();

    if (EDIT_PRO_NOMBRE.length == 0 || EDIT_PRO_APELLIDO_PATERNO.length == 0 || EDIT_PRO_APELLIDO_MATERNO.length == 0 ||
        EDIT_PRO_EDAD.length == 0 || EDIT_PRO_SEXO.length == 0 || EDIT_PRO_TELEFONO.length == 0 ||
        EDIT_PRO_CORREO.length == 0) {
        return Swal.fire("VERIFICAR CAMPOS", "Por favor, llene los campos vacíos", "warning");
    }
    if (EDIT_PRO_EDAD < 17 || EDIT_PRO_EDAD > 99) {
        return Swal.fire("VERIFICAR EDAD", "Por favor, ingrese una edad válida", "warning");
    }
    if (EDIT_VALIDAR_CORREO == "incorrecto") {
        return Swal.fire("VERIFICAR CORREO ELECTRÓNICO", "Por favor, ingrese un formato de correo válido", "warning");
    } 
    $.ajax({
        "url": "../controlador/administrador/controlador_promotor_actividades_culturales_editar.php",
        type: 'POST',
        data: {
            EDIT_PRO_ID_PROMOTOR: EDIT_PRO_ID_PROMOTOR,
            EDIT_PRO_NOMBRE: EDIT_PRO_NOMBRE,
            EDIT_PRO_APELLIDO_PATERNO: EDIT_PRO_APELLIDO_PATERNO,
            EDIT_PRO_APELLIDO_MATERNO: EDIT_PRO_APELLIDO_MATERNO,
            EDIT_PRO_EDAD: EDIT_PRO_EDAD,
            EDIT_PRO_SEXO: EDIT_PRO_SEXO,
            EDIT_PRO_TELEFONO: EDIT_PRO_TELEFONO,
            EDIT_PRO_CORREO: EDIT_PRO_CORREO
        }
    }).done(function(resp) {
        if (resp > 0) {
            Swal.fire("MODIFICACIÓN EXITOSA", "Datos correctamente registrados, usuario modifcado", "success")
                .then((value) => {
                    table_promotor_adm.ajax.reload();
                    table_promotor_adm_actividades_culturales.ajax.reload();
                    TraerDatosUsuario();
                });
        } else {
            Swal.fire("ERROR", "No fue posible la modificación en la base de datos", "error");
        }
    })
}

//----------------------------------------------------------------------------- FIN MODIFICACIÓN DE LOS DATOS DEL USUARIO PROMOTOR ----------------------------------------------------------------------------------

//############################################################################## FIN DE TABLA PROMOTOR ACTIVIDADES CULTURALES #############################################################################################










//################################################################################################ TABLA ALUMNO #############################################################################################

//--------------------------------------------------------------------------- INICIO LISTADO DE TABLA ALUMNO PERFIL ADMINISTRADOR ------------------------------------------------------------------------------

// Mostrar la tabla alumno
var table_alumno_adm;

function listar_alumno() {

    table_alumno_adm = $("#tabla_alumno").DataTable({ //ID de la tabla
            "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        }],
        "dom": 'Bfrtip',
        "buttons": [
            {
                "extend": 'copyHtml5',
                "text": 'COPIAR'
            },
            {
                "extend": 'excelHtml5',
                "text": 'EXCEL'
            },
            {
                "extend": 'csvHtml5',
                "text": 'CVS'
            }],
        "order": [[1, 'asc']],
        "ordering": true,
        "bLengthChange": true,
        "oSearch": {"bSmart": false},
        "searching": { "regex": true },
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "TODOS"]
        ],
        "pageLength": 10,
        "destroy": true,
        "async": true,
        "processing": true,

        "ajax": {
            "url": "../controlador/administrador/controlador_alumno_listar.php",
            type: 'POST'
        },
        "columns": [
            { "data": "ALU_ID_ALUMNO" },
            { "data": "ALU_NUMERO_CONTROL" },
            { "data": "ALU_APELLIDO_PATERNO" },
            { "data": "ALU_APELLIDO_MATERNO" },
            { "data": "ALU_NOMBRE" },
            { "data": "ALU_EDAD" },
            {
                "data": "ALU_SEXO",
                render: function(data, type, row) {
                    if (data == 'M') {
                        return "MASCULINO";
                    } else {
                        return "FEMENINO";
                    }
                }
            },
            { "data": "ALU_TELEFONO" },
            { "data": "ALU_CORREO_ELECTRONICO" },
            { "data": "CAR_CARRERA" },
            { "data": "SEM_SEMESTRE" },
            { "data": "ALU_EXTRAESCOLAR_COMPLETO" },
            { "data": "TIPEXT_TIPO_EXTRAESCOLAR" },
            {
                "data": "ALU_ESTADO",
                render: function(data, type, row) {
                    if (data == 'ACTIVO') {
                        return "<span class='badge badge-pill badge-success'>" + data + "</span>";
                    } else {
                        return "<span class='badge badge-pill badge-danger' placeholder='dsd'>" + data + "</span>";
                    }
                }
            },

            {
                "data": "ALU_ESTADO",
                render: function(data, type, row) {
                    if (data == 'ACTIVO') {
                        return "<button style='font-size:15px; height:30%; text-align:center;' type='button' class='desactivar btn btn-alt-danger'><i class='si si-close'></i></button>&nbsp;<button style='font-size:15px; height:30%; text-align:center;' type='button' data-toggle='modal' data-target='#modal_editar_alumno' class='editar btn btn-alt-info'><i class='fa fa-edit'></i></button>";
                    } else {
                        return "<button style='font-size:15px; height:30%; text-align:center;' type='button' class='activar btn btn-alt-success'><i class='si si-check'></i></button>&nbsp;<button style='font-size:15px; height:30%; text-align:center;' type='button' data-toggle='modal' data-target='#modal_editar_alumno' class='editar btn btn-alt-info'><i class='fa fa-edit'></i></button>";
                    }
                }
            }
        ],

        "language": idioma_espanol,
        select: true
    });



 document.getElementById("tabla_alumno_filter").style.display="none";
   $('input.global_filter').on( 'keyup click', function () {
        filterGlobal_alum();
    } );
    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    });


   table_alumno_adm.on( 'order.dt search.dt', function () {
        table_alumno_adm.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

}

function filterGlobal_alum() {
    $('#tabla_alumno').DataTable().search(
        $('#global_filter_alu').val(),
    ).draw();
}


function filterGlobal_alu() {
    $('#tabla_alumno').DataTable().search(
        $('#opcion_extraescolar_busqueda').val(), //NOMBRE DEL INPUT
    ).draw();
}







 //------------------------------------------------------------------------------ INICIO REGISTRO DE NUEVO USUARIO ALUMNO -----------------------------------------------------------------------------------

function Registrar_Usuario_Alumno() {
    var REG_ALU_NOMBRE              = $("#REG_ALU_NOMBRE").val();
    var REG_ALU_APELLIDO_PATERNO    = $("#REG_ALU_APELLIDO_PATERNO").val();
    var REG_ALU_APELLIDO_MATERNO    = $("#REG_ALU_APELLIDO_MATERNO").val();
    var REG_ALU_EDAD                = $("#REG_ALU_EDAD").val();
    var REG_ALU_SEXO                = $("#REG_ALU_SEXO").val();
    var REG_ALU_TELEFONO            = $("#REG_ALU_TELEFONO").val();
    var REG_ALU_CORREO              = $("#REG_ALU_CORREO").val();
    var REG_ALU_NUMERO_CONTROL      = $("#REG_ALU_NUMERO_CONTROL").val();
    var REG_ALU_CONTRASENA1         = $("#REG_ALU_NUMERO_CONTROL").val();
    var REG_ALU_CONTRASENA2         = $("#REG_ALU_NUMERO_CONTROL").val();
    var REG_ALU_CARRERA             = $("#opcion_carrera").val();
    var REG_ALU_SEMESTRE            = $("#opcion_semestre").val();
    var REG_ALU_EXTRAESCOLAR        = $("#opcion_extraescolar").val();
    var VALIDAR_CORREO              = $("#validar_correo").val();

    if (REG_ALU_NOMBRE.length == 0 || REG_ALU_APELLIDO_PATERNO.length == 0 ||
        REG_ALU_EDAD.length == 0 || REG_ALU_SEXO.length == 0 || REG_ALU_TELEFONO.length == 0 || REG_ALU_NUMERO_CONTROL.length == 0 || REG_ALU_CONTRASENA1.length == 0 ||
        REG_ALU_CONTRASENA2.length == 0 || REG_ALU_CARRERA.length == 0 || REG_ALU_SEMESTRE.length == 0) {
        return Swal.fire("VERIFICAR CAMPOS", "Por favor, llene los campos vacíos", "warning");
    }
    if (REG_ALU_EXTRAESCOLAR.length ==0) {
        return Swal.fire("Extraescolar no disponible", "La extraescolar ha alcanzado el límite de inscripciones, por favor seleccione otra extraescolar en el listado de actividades ofertadas", "warning");
    }
    if (REG_ALU_EDAD < 17 || REG_ALU_EDAD > 99) {
        return Swal.fire("VERIFICAR EDAD", "Por favor, ingrese una edad válida", "warning");
    }
    if (VALIDAR_CORREO == "incorrecto") {
        return Swal.fire("VERIFICAR CORREO ELECTRÓNICO", "Por favor, ingrese un formato de correo válido", "warning");
    } 

    if (REG_ALU_CONTRASENA1 != REG_ALU_CONTRASENA2) {
        return Swal.fire("VERIFICAR NÚMERO DE CONTROL", "Las contraseñas deben coincidir", "warning");
    }

    if (REG_ALU_CONTRASENA1.length < 8) {
        return Swal.fire("VERIFICAR  NÚMERO DE CONTROL", "El número de control debe contener 8 caracteres", "warning");
    }

    $.ajax({
        "url": "../controlador/administrador/controlador_alumno_registro.php",
        type: 'POST',
        data: {
            REG_ALU_NOMBRE: REG_ALU_NOMBRE,
            REG_ALU_APELLIDO_PATERNO: REG_ALU_APELLIDO_PATERNO,
            REG_ALU_APELLIDO_MATERNO: REG_ALU_APELLIDO_MATERNO,
            REG_ALU_EDAD: REG_ALU_EDAD,
            REG_ALU_SEXO: REG_ALU_SEXO,
            REG_ALU_TELEFONO: REG_ALU_TELEFONO,
            REG_ALU_CORREO: REG_ALU_CORREO,
            REG_ALU_NUMERO_CONTROL: REG_ALU_NUMERO_CONTROL,
            REG_ALU_CONTRASENA: REG_ALU_CONTRASENA1,
            REG_ALU_CARRERA: REG_ALU_CARRERA,
            REG_ALU_SEMESTRE: REG_ALU_SEMESTRE,
            REG_ALU_EXTRAESCOLAR: REG_ALU_EXTRAESCOLAR
        }
    }).done(function (resp) {
        if (resp > 0) {
            if (resp == 1) {
                Swal.fire("REGISTRO EXITOSO", "Datos correctos, la inscripción ha sido realizada. Espera un correo de confirmación el día 11 de febrero con los datos de contacto de tu extraescolar.", "success")
                    .then((value) => {
                        LimpiarRegistroAlu();
                        table_alumno_adm.ajax.reload();
                    });
            } else if (resp == 3){
                return Swal.fire("ADVERTENCIA", "El número de control ya se encuentra registrado, si presentaste algún problema manda un correo a: inscripciones.extraescolares@pachuca.tecnm.mx", "warning");
            } else {
                return Swal.fire("ADVERTENCIA", "La extraescolar alcanzó el límite de inscripciones permitidas, te inivitamos a realizar tu registro en otra actividad extraescolar.", "warning");
            }
        } else {
            Swal.fire("ERROR", "No fue posible realizar el registro en la base de datos", "error", );
        }
    })
}





//Limpeza del formulario
function LimpiarRegistroAlu() {
    $("#REG_ALU_NOMBRE").val("");
    $("#REG_ALU_APELLIDO_PATERNO").val("");
    $("#REG_ALU_APELLIDO_MATERNO").val("");
    $("#REG_ALU_EDAD").val("");
    $("#REG_ALU_TELEFONO").val("");
    $("#REG_ALU_CORREO").val("");
    $("#REG_ALU_NUMERO_CONTROL").val("");
    $("#REG_ALU_CONTRASENA1").val("");
    $("#REG_ALU_CONTRASENA2").val("");
    $("#opcion_semestre").val("").trigger("change");
    $("#opcion_carrera").val("").trigger("change");
    $("#REG_ALU_SEXO").val("").trigger("change");
    $("#opcion_extraescolar").val("").trigger("change");
}

 //-------------------------------------------------------------------------------- FIN REGISTRO DE NUEVO USUARIO ALUMNO -----------------------------------------------------------------------------------




//----------------------------------------------------------------------------- INICIO MODIFICACIÓN DEL ESTADO DEL USUARIO ALUMNO ----------------------------------------------------------------------------------

function Modificar_Estado_Alumno(MOD_ALU_ID_ALUMNO, MOD_ALU_ESTADO) {
    var mensaje = "";
    if (MOD_ALU_ESTADO == 'INACTIVO') {
        mensaje = "desactivó";
    } else {
        mensaje = "activó";
    }
    $.ajax({
        "url": "../controlador/administrador/controlador_modificar_estado_alumno.php",
        type: 'POST',
        data: {
            MOD_ALU_ID_ALUMNO:   MOD_ALU_ID_ALUMNO,
            MOD_ALU_ESTADO:             MOD_ALU_ESTADO
        }

    }).done(function(resp) {
        if (resp > 0) {
            Swal.fire("MODIFICACIÓN EXITOSA", "El usuario se " + mensaje + " con éxito", "success")
                .then((value) => {
                    table_alumno_adm.ajax.reload();
                    table_alumno_adm_actividades_deportivas.ajax.reload();
                    table_alumno_adm_actividades_culturales.ajax.reload();
                });
        }
    })
}

//----------------------------------------------------------------------------- FIN MODIFICACIÓN DEL ESTADO DEL USUARIO ALUMNO ----------------------------------------------------------------------------------


//--------------------------------------------------------------------------------- INICIO DE BOTONES DE ACCIONES ALUMNO ----------------------------------------------------------------------------

// BOTÓN ACTIVAR
$('#tabla_alumno').on('click', '.activar', function() {
    var data = table_alumno_adm.row($(this).parents('tr')).data();
    if (table_alumno_adm.row(this).child.isShown()) {
        var data = table_alumno_adm.row(this).data();
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
            Modificar_Estado_Alumno(data.ALU_ID_ALUMNO, 'ACTIVO');
        }
    })
})

// BOTÓN DESACTIVAR
$('#tabla_alumno').on('click', '.desactivar', function () {
    var data = table_alumno_adm.row($(this).parents('tr')).data();
    if (table_alumno_adm.row(this).child.isShown()) {
        var data = table_alumno_adm.row(this).data();
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
            Modificar_Estado_Alumno(data.ALU_ID_ALUMNO, 'INACTIVO');
        }
    })
})

// BOTÓN EDITAR
$('#tabla_alumno').on('click', '.editar', function () {
    var data = table_alumno_adm.row($(this).parents('tr')).data();
    if (table_alumno_adm.row(this).child.isShown()) {
        var data = table_alumno_adm.row(this).data();
    }
    $("#EDIT_ALU_ID_ALUMNO").val(data.ALU_ID_ALUMNO);
    $("#EDIT_ALU_NUMERO_CONTROL").val(data.ALU_NUMERO_CONTROL);
    $("#EDIT_ALU_NOMBRE").val(data.ALU_NOMBRE);
    $("#EDIT_ALU_APELLIDO_PATERNO").val(data.ALU_APELLIDO_PATERNO);
    $("#EDIT_ALU_APELLIDO_MATERNO").val(data.ALU_APELLIDO_MATERNO);
    $("#EDIT_ALU_EDAD").val(data.ALU_EDAD);
    $("#EDIT_ALU_SEXO").val(data.ALU_SEXO).trigger("change");
    $("#EDIT_ALU_TELEFONO").val(data.ALU_TELEFONO);
    $("#EDIT_ALU_CORREO").val(data.ALU_CORREO_ELECTRONICO);
    $("#opcion_carrera_editar").val(data.CAR_ID_CARRERA).trigger("change");
    $("#opcion_semestre_editar").val(data.SEM_ID_SEMESTRE).trigger("change");
    $("#opcion_extraescolar_editar").val(data.EXT_ID_EXTRAESCOLAR).trigger("change");
});

//---------------------------------------------------------------------------------- FIN DE BOTONES DE ACCIONES ALUMNO ----------------------------------------------------------------------------------------





//----------------------------------------------------------------------------- INICIO MODIFICACIÓN DE LOS DATOS DEL USUARIO ALUMNO ----------------------------------------------------------------------------------


function Editar_Usuario_Alumno() {
    var EDIT_ALU_ID_ALUMNO              = $("#EDIT_ALU_ID_ALUMNO").val();
    var EDIT_ALU_NOMBRE                 = $("#EDIT_ALU_NOMBRE").val();
    var EDIT_ALU_APELLIDO_PATERNO       = $("#EDIT_ALU_APELLIDO_PATERNO").val();
    var EDIT_ALU_APELLIDO_MATERNO       = $("#EDIT_ALU_APELLIDO_MATERNO").val();
    var EDIT_ALU_EDAD                   = $("#EDIT_ALU_EDAD").val();
    var EDIT_ALU_SEXO                   = $("#EDIT_ALU_SEXO").val();
    var EDIT_ALU_TELEFONO               = $("#EDIT_ALU_TELEFONO").val();
    var EDIT_ALU_CORREO                 = $("#EDIT_ALU_CORREO").val();
    var EDIT_ALU_CARRERA                = $("#opcion_carrera_editar").val();
    var EDIT_ALU_SEMESTRE               = $("#opcion_semestre_editar").val();
    var EDIT_VALIDAR_CORREO             = $("#editar_validar_correo").val();
    var EDIT_ALU_EXTRAESCOLAR           = $("#opcion_extraescolar_editar").val();
    
    if (EDIT_ALU_NOMBRE.length == 0 || EDIT_ALU_APELLIDO_PATERNO.length == 0 || EDIT_ALU_APELLIDO_MATERNO.length == 0 ||
        EDIT_ALU_EDAD.length == 0 || EDIT_ALU_SEXO.length == 0 || EDIT_ALU_TELEFONO.length == 0 ||
        EDIT_ALU_CORREO.length == 0 || EDIT_ALU_CARRERA.length == 0 || EDIT_ALU_SEMESTRE.length == 0 || EDIT_ALU_EXTRAESCOLAR.length == 0) {
        return Swal.fire("VERIFICAR CAMPOS", "Por favor, llene los campos vacíos", "warning");
    }
    if (EDIT_ALU_EDAD < 17 || EDIT_ALU_EDAD > 99) {
        return Swal.fire("VERIFICAR EDAD", "Por favor, ingrese una edad válida", "warning");
    }
    if (EDIT_VALIDAR_CORREO == "incorrecto") {
        return Swal.fire("VERIFICAR CORREO ELECTRÓNICO", "Por favor, ingrese un formato de correo válido", "warning");
    } 
    $.ajax({
        "url": "../controlador/administrador/controlador_alumno_editar.php",
        type: 'POST',
        data: {
            EDIT_ALU_ID_ALUMNO: EDIT_ALU_ID_ALUMNO,
            EDIT_ALU_NOMBRE: EDIT_ALU_NOMBRE,
            EDIT_ALU_APELLIDO_PATERNO: EDIT_ALU_APELLIDO_PATERNO,
            EDIT_ALU_APELLIDO_MATERNO: EDIT_ALU_APELLIDO_MATERNO,
            EDIT_ALU_EDAD: EDIT_ALU_EDAD,
            EDIT_ALU_SEXO: EDIT_ALU_SEXO,
            EDIT_ALU_TELEFONO: EDIT_ALU_TELEFONO,
            EDIT_ALU_CORREO: EDIT_ALU_CORREO,
            EDIT_ALU_CARRERA: EDIT_ALU_CARRERA,
            EDIT_ALU_SEMESTRE: EDIT_ALU_SEMESTRE,
            EDIT_ALU_EXTRAESCOLAR:EDIT_ALU_EXTRAESCOLAR
        }
    }).done(function(resp) {
        if (resp > 0) {
            Swal.fire("MODIFICACIÓN EXITOSA", "Datos correctamente registrados, usuario modifcado", "success")
                .then((value) => {
                    table_alumno_adm.ajax.reload();
                    TraerDatosUsuario();
                });
        } else {
            Swal.fire("ERROR", "No fue posible la modificación en la base de datos", "error");
        }
    })
}

//----------------------------------------------------------------------------- FIN MODIFICACIÓN DE LOS DATOS DEL USUARIO ALUMNO ----------------------------------------------------------------------------------

//############################################################################################ FIN DE TABLA ALUMNO #############################################################################################














//################################################################################################ TABLA EXTRAESCOLAR #############################################################################################

//--------------------------------------------------------------------------- INICIO LISTADO DE TABLA EXTRAESCOLAR PERFIL ADMINISTRADOR ------------------------------------------------------------------------------

// Mostrar la tabla extraescolar
var table_extraescolar_adm;

function listar_extraescolar() {

    table_extraescolar_adm = $("#tabla_extraescolar").DataTable({ //ID de la tabla
            "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        }],
        "dom": 'Bfrtip',
        "buttons": [
            {
                "extend": 'copyHtml5',
                "text": 'COPIAR'
            },
            {
                "extend": 'excelHtml5',
                "text": 'EXCEL'
            },
            {
                "extend": 'csvHtml5',
                "text": 'CVS'
            }],
        "order": [[1, 'asc']],
        "ordering": true,
        "bLengthChange": true,
        "orderCellsTop": true,
        "fixedHeader": true,

        "searching": { "regex": true },
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "TODOS"]
        ],
        "pageLength": 10,
        "destroy": true,
        "async": true,
        "processing": true,

        "ajax": {
            "url": "../controlador/administrador/controlador_extraescolar_listar.php",
            type: 'POST'
        },
        "columns": [
            { "data": "EXT_ID_EXTRAESCOLAR" },
            { "data": "EXT_EXTRAESCOLAR" },
            { "data": "GRUEXT_GRUPO_NOMBRE" },
            { "data": "PRO_NOMBRE_COMPLETO" },
            { "data": "LUG_LUGAR" },
            { "data": "TIPEXT_TIPO_EXTRAESCOLAR" },
            { "data": "EXT_PERIODO" },
            {
                "data": "EXT_ESTADO",
                render: function(data, type, row) {
                    if (data == 'ACTIVO') {
                        return "<span class='badge badge-pill badge-success'>" + data + "</span>";
                    } else {
                        return "<span class='badge badge-pill badge-danger' placeholder='dsd'>" + data + "</span>";
                    }
                }
            },

            {
                "data": "EXT_ESTADO",
                render: function(data, type, row) {
                    if (data == 'ACTIVO') {
                        return "<button style='font-size:15px; height:30%; text-align:center;' type='button' class='desactivar btn btn-alt-danger'><i class='si si-close'></i></button>&nbsp;<button style='font-size:15px; height:30%; text-align:center;' type='button' data-toggle='modal' data-target='#modal_editar_extraescolar' class='editar btn btn-alt-info'><i class='fa fa-edit'></i></button>";
                    } else {
                        return "<button style='font-size:15px; height:30%; text-align:center;' type='button' class='activar btn btn-alt-success'><i class='si si-check'></i></button>&nbsp;<button style='font-size:15px; height:30%; text-align:center;' type='button' data-toggle='modal' data-target='#modal_editar_extraescolar' class='editar btn btn-alt-info'><i class='fa fa-edit'></i></button>";
                    }
                }
            }
        ],

        "language": idioma_espanol,
        select: true
    });

  document.getElementById("tabla_extraescolar_filter").style.display="none";
   $('input.global_filter').on( 'keyup click', function () {
        filterGlobal_extra();
    } );
    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    });

   table_extraescolar_adm.on( 'order.dt search.dt', function () {
        table_extraescolar_adm.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

}

function filterGlobal_extra() {
    $('#tabla_extraescolar').DataTable().search(
        $('#global_filter_ext').val(),
    ).draw();
}


function filterGlobal_ext() {
    $('#tabla_extraescolar').DataTable().search(
        $('#opcion_tipo_extraescolar_busqueda').val(), //NOMBRE DEL INPUT
    ).draw();
}





//--------------------------------------------------------------------------- FIN LISTADO DE TABLA EXTRAESCOLAR PERFIL ADMINISTRADOR ------------------------------------------------------------------------------


 //------------------------------------------------------------------------------ INICIO REGISTRO DE NUEVO USUARIO EXTRAESCOLAR -----------------------------------------------------------------------------------

function Registrar_Extraescolar() {
    var REG_EXT_EXTRAESCOLAR                = $("#REG_EXT_EXTRAESCOLAR").val();
    var REG_EXT_GRUPO_EXTRAESCOLAR          = $("#opcion_grupo_extraescolar").val();
    var REG_EXT_PROMOTOR                    = $("#opcion_promotor").val();
    var REG_EXT_LUGAR                       = $("#opcion_lugar").val();
    var REG_EXT_TIPEXT_TIPO_EXTRAESCOLAR    = $("#opcion_tipo_extraescolar").val();
    var REG_EXT_PERIODO                     = $("#opcion_periodo").val();
    var REG_EXT_HORA_LUNES_INICIO           = $("#REG_EXT_HORA_LUNES_INICIO").val();
    var REG_EXT_HORA_LUNES_FIN              = $("#REG_EXT_HORA_LUNES_FIN").val();
    var REG_EXT_HORA_MARTES_INICIO          = $("#REG_EXT_HORA_MARTES_INICIO").val();
    var REG_EXT_HORA_MARTES_FIN             = $("#REG_EXT_HORA_MARTES_FIN").val();
    var REG_EXT_HORA_MIERCOLES_INICIO       = $("#REG_EXT_HORA_MIERCOLES_INICIO").val();
    var REG_EXT_HORA_MIERCOLES_FIN          = $("#REG_EXT_HORA_MIERCOLES_FIN").val();
    var REG_EXT_HORA_JUEVES_INICIO          = $("#REG_EXT_HORA_JUEVES_INICIO").val();
    var REG_EXT_HORA_JUEVES_FIN             = $("#REG_EXT_HORA_JUEVES_FIN").val();
    var REG_EXT_HORA_VIERNES_INICIO         = $("#REG_EXT_HORA_VIERNES_INICIO").val();
    var REG_EXT_HORA_VIERNES_FIN            = $("#REG_EXT_HORA_VIERNES_FIN").val();

    if (REG_EXT_EXTRAESCOLAR.length == 0 || REG_EXT_GRUPO_EXTRAESCOLAR.length == 0 ||
        REG_EXT_PROMOTOR.length == 0 || REG_EXT_LUGAR.length == 0 || REG_EXT_TIPEXT_TIPO_EXTRAESCOLAR.length == 0 || REG_EXT_PERIODO.length == 0) {
        return Swal.fire("VERIFICAR CAMPOS", "Por favor, llene los campos vacíos", "warning");
    }

    $.ajax({
        "url": "../controlador/administrador/controlador_extraescolar_registro.php",
        type: 'POST',
        data: {
            REG_EXT_EXTRAESCOLAR: REG_EXT_EXTRAESCOLAR,
            REG_EXT_GRUPO_EXTRAESCOLAR: REG_EXT_GRUPO_EXTRAESCOLAR,
            REG_EXT_PROMOTOR: REG_EXT_PROMOTOR,
            REG_EXT_LUGAR: REG_EXT_LUGAR,
            REG_EXT_TIPEXT_TIPO_EXTRAESCOLAR: REG_EXT_TIPEXT_TIPO_EXTRAESCOLAR,
            REG_EXT_PERIODO: REG_EXT_PERIODO,
            REG_EXT_HORA_LUNES_INICIO: REG_EXT_HORA_LUNES_INICIO,
            REG_EXT_HORA_LUNES_FIN: REG_EXT_HORA_LUNES_FIN,            
            REG_EXT_HORA_MARTES_INICIO: REG_EXT_HORA_MARTES_INICIO,
            REG_EXT_HORA_MARTES_FIN: REG_EXT_HORA_MARTES_FIN,
            REG_EXT_HORA_MIERCOLES_INICIO: REG_EXT_HORA_MIERCOLES_INICIO,            
            REG_EXT_HORA_MIERCOLES_FIN: REG_EXT_HORA_MIERCOLES_FIN,
            REG_EXT_HORA_JUEVES_INICIO: REG_EXT_HORA_JUEVES_INICIO,
            REG_EXT_HORA_JUEVES_FIN: REG_EXT_HORA_JUEVES_FIN,
            REG_EXT_HORA_VIERNES_INICIO: REG_EXT_HORA_VIERNES_INICIO,
            REG_EXT_HORA_VIERNES_FIN: REG_EXT_HORA_VIERNES_FIN
        }
    }).done(function (resp) {
                if (resp > 0) {
            if (resp == 1) {
                Swal.fire("REGISTRO EXITOSO", "Datos correctos, nueva extraescolar registrada", "success")
                    .then((value) => {
                        LimpiarRegistroExt();
                        table_extraescolar_adm.ajax.reload();
                        table_extraescolar_horario_actividades_deportivas_adm.ajax.reload();
                        table_extraescolar_horario_actividades_culturales_adm.ajax.reload();
                    });
            } else {
                return Swal.fire("ADVERTENCIA", "El nombre de la extraescolar ingresada se encuentra registrado en la base de datos", "warning");
            }
        } else {
            Swal.fire("ERROR", "No fue posible realizar el registro en la base de datos", "error", );
        }
    })
}

//Limpeza del formulario
function LimpiarRegistroExt() {
    $("#REG_EXT_EXTRAESCOLAR").val("");
    $("#opcion_promotor").val("").trigger("change");
    $("#opcion_lugar").val("").trigger("change");
    $("#opcion_tipo_extraescolar").val("").trigger("change");
    $("#opcion_grupo_extraescolar").val("").trigger("change");
    $("#opcion_periodo").val("").trigger("change");
    $("#REG_EXT_HORA_LUNES_INICIO").val("").trigger("change");
    $("#REG_EXT_HORA_LUNES_FIN").val("").trigger("change");
    $("#REG_EXT_HORA_MARTES_INICIO").val("").trigger("change");
    $("#REG_EXT_HORA_MARTES_FIN").val("").trigger("change");
    $("#REG_EXT_HORA_MIERCOLES_INICIO").val("").trigger("change");
    $("#REG_EXT_HORA_MIERCOLES_FIN").val("").trigger("change");
    $("#REG_EXT_HORA_JUEVES_INICIO").val("").trigger("change");
    $("#REG_EXT_HORA_JUEVES_FIN").val("").trigger("change");
    $("#REG_EXT_HORA_VIERNES_INICIO").val("").trigger("change");
    $("#REG_EXT_HORA_VIERNES_FIN").val("").trigger("change");
}


 //-------------------------------------------------------------------------------- FIN REGISTRO DE NUEVA EXTRAESCOLAR -----------------------------------------------------------------------------------


//----------------------------------------------------------------------------- INICIO MODIFICACIÓN DEL ESTADO DE EXTRAESCOLAR ----------------------------------------------------------------------------------

function Modificar_Estado_Extraescolar(MOD_EXT_ID_EXTRAESCOLAR, MOD_EXT_ESTADO) {
    var mensaje = "";
    if (MOD_EXT_ESTADO == 'INACTIVO') {
        mensaje = "desactivó";
    } else {
        mensaje = "activó";
    }
    $.ajax({
        "url": "../controlador/administrador/controlador_modificar_estado_extraescolar.php",
        type: 'POST',
        data: {
            MOD_EXT_ID_EXTRAESCOLAR:   MOD_EXT_ID_EXTRAESCOLAR,
            MOD_EXT_ESTADO:             MOD_EXT_ESTADO
        }

    }).done(function(resp) {
        if (resp > 0) {
            Swal.fire("MODIFICACIÓN EXITOSA", "La extraescolar se " + mensaje + " con éxito", "success")
                .then((value) => {
                    table_extraescolar_adm.ajax.reload();
                });
        }
    })
}

//----------------------------------------------------------------------------- FIN MODIFICACIÓN DEL ESTADO DEL USUARIO EXTRAESCOLAR ----------------------------------------------------------------------------------


//--------------------------------------------------------------------------------- INICIO DE BOTONES DE ACCIONES EXTRAESCOLAR ----------------------------------------------------------------------------

// BOTÓN ACTIVAR
$('#tabla_extraescolar').on('click', '.activar', function() {
    var data = table_extraescolar_adm.row($(this).parents('tr')).data();
    if (table_extraescolar_adm.row(this).child.isShown()) {
        var data = table_extraescolar_adm.row(this).data();
    }
    Swal.fire({
        title: '¿Desea activar la extraescolar?',
        text: "Una vez realizada la acción, la extraescolar podrá ser seleccionada en el sistema",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí'
    }).then((result) => {
        if (result.value) {
            Modificar_Estado_Extraescolar(data.EXT_ID_EXTRAESCOLAR, 'ACTIVO');
        }
    })
})

// BOTÓN DESACTIVAR
$('#tabla_extraescolar').on('click', '.desactivar', function () {
    var data = table_extraescolar_adm.row($(this).parents('tr')).data();
    if (table_extraescolar_adm.row(this).child.isShown()) {
        var data = table_extraescolar_adm.row(this).data();
    }
    Swal.fire({
        title: '¿Desea desactivar la extraescolar?',
        text: "Una vez realizada la acción, la extraescolar no podrá ser seleccionada en el sistema",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí'
    }).then((result) => {
        if (result.value) {
            Modificar_Estado_Extraescolar(data.EXT_ID_EXTRAESCOLAR, 'INACTIVO');
        }
    })
})

// BOTÓN EDITAR
$('#tabla_extraescolar').on('click', '.editar', function () {
    var data = table_extraescolar_adm.row($(this).parents('tr')).data();
    if (table_extraescolar_adm.row(this).child.isShown()) {
        var data = table_extraescolar_adm.row(this).data();
    }
    $("#EDIT_EXT_ID_EXTRAESCOLAR").val(data.EXT_ID_EXTRAESCOLAR);
    $("#EDIT_EXT_EXTRAESCOLAR").val(data.EXT_EXTRAESCOLAR);
    $("#opcion_grupo_extraescolar_editar").val(data.GRUEXT_ID_GRUPO_EXTRAESCOLAR).trigger("change");
    $("#opcion_promotor_editar").val(data.PRO_ID_PROMOTOR).trigger("change");
    $("#opcion_lugar_editar").val(data.LUG_ID_LUGAR).trigger("change");
    $("#opcion_tipo_extraescolar_editar").val(data.TIPEXT_ID_TIPO_EXTRAESCOLAR).trigger("change");
    $("#opcion_periodo_editar").val(data.PER_ID_PERIODO).trigger("change");
    $("#EDIT_EXT_HORA_LUNES_INICIO")     .val(data.EXT_HORA_INICIO_LUNES).trigger("change");
    $("#EDIT_EXT_HORA_LUNES_FIN")        .val(data.EXT_HORA_FIN_LUNES).trigger("change");
    $("#EDIT_EXT_HORA_MARTES_INICIO")    .val(data.EXT_HORA_INICIO_MARTES).trigger("change");
    $("#EDIT_EXT_HORA_MARTES_FIN")       .val(data.EXT_HORA_FIN_MARTES).trigger("change");
    $("#EDIT_EXT_HORA_MIERCOLES_INICIO") .val(data.EXT_HORA_INICIO_MIERCOLES).trigger("change");
    $("#EDIT_EXT_HORA_MIERCOLES_FIN")    .val(data.EXT_HORA_FIN_MIERCOLES).trigger("change");
    $("#EDIT_EXT_HORA_JUEVES_INICIO")    .val(data.EXT_HORA_INICIO_JUEVES).trigger("change");
    $("#EDIT_EXT_HORA_JUEVES_FIN")       .val(data.EXT_HORA_FIN_JUEVES).trigger("change");
    $("#EDIT_EXT_HORA_VIERNES_INICIO")   .val(data.EXT_HORA_INICIO_VIERNES).trigger("change");
    $("#EDIT_EXT_HORA_VIERNES_FIN")      .val(data.EXT_HORA_FIN_VIERNES).trigger("change");

});

//---------------------------------------------------------------------------------- FIN DE BOTONES DE ACCIONES EXTRAESCOLAR ----------------------------------------------------------------------------------------




//----------------------------------------------------------------------------- INICIO MODIFICACIÓN DE LOS DATOS DEL USUARIO EXTRAESCOLAR ----------------------------------------------------------------------------------


function Editar_Extraescolar() {

    var EDIT_EXT_ID_EXTRAESCOLAR             = $("#EDIT_EXT_ID_EXTRAESCOLAR").val();
    var EDIT_EXT_PROMOTOR                    = $("#opcion_promotor_editar").val();
    var EDIT_EXT_LUGAR                       = $("#opcion_lugar_editar").val();
    var EDIT_EXT_TIPEXT_TIPO_EXTRAESCOLAR    = $("#opcion_tipo_extraescolar_editar").val();
    var EDIT_EXT_HORA_LUNES_INICIO           = $("#EDIT_EXT_HORA_LUNES_INICIO").val();
    var EDIT_EXT_HORA_LUNES_FIN              = $("#EDIT_EXT_HORA_LUNES_FIN").val();
    var EDIT_EXT_HORA_MARTES_INICIO          = $("#EDIT_EXT_HORA_MARTES_INICIO").val();
    var EDIT_EXT_HORA_MARTES_FIN             = $("#EDIT_EXT_HORA_MARTES_FIN").val();
    var EDIT_EXT_HORA_MIERCOLES_INICIO       = $("#EDIT_EXT_HORA_MIERCOLES_INICIO").val();
    var EDIT_EXT_HORA_MIERCOLES_FIN          = $("#EDIT_EXT_HORA_MIERCOLES_FIN").val();
    var EDIT_EXT_HORA_JUEVES_INICIO          = $("#EDIT_EXT_HORA_JUEVES_INICIO").val();
    var EDIT_EXT_HORA_JUEVES_FIN             = $("#EDIT_EXT_HORA_JUEVES_FIN").val();
    var EDIT_EXT_HORA_VIERNES_INICIO         = $("#EDIT_EXT_HORA_VIERNES_INICIO").val();
    var EDIT_EXT_HORA_VIERNES_FIN            = $("#EDIT_EXT_HORA_VIERNES_FIN").val();

    if (EDIT_EXT_PROMOTOR.length == 0 || EDIT_EXT_LUGAR.length == 0 || EDIT_EXT_TIPEXT_TIPO_EXTRAESCOLAR.length == 0) {
        return Swal.fire("VERIFICAR CAMPOS", "Por favor, llene los campos vacíos", "warning");
    }


    $.ajax({
        "url": "../controlador/administrador/controlador_extraescolar_editar.php",
        type: 'POST',
        data: {
                 
            EDIT_EXT_ID_EXTRAESCOLAR:           EDIT_EXT_ID_EXTRAESCOLAR,
            EDIT_EXT_PROMOTOR:                  EDIT_EXT_PROMOTOR,
            EDIT_EXT_LUGAR:                     EDIT_EXT_LUGAR,                   
            EDIT_EXT_TIPEXT_TIPO_EXTRAESCOLAR:  EDIT_EXT_TIPEXT_TIPO_EXTRAESCOLAR,
            EDIT_EXT_HORA_LUNES_INICIO:         EDIT_EXT_HORA_LUNES_INICIO,   
            EDIT_EXT_HORA_LUNES_FIN:            EDIT_EXT_HORA_LUNES_FIN,
            EDIT_EXT_HORA_MARTES_INICIO:        EDIT_EXT_HORA_MARTES_INICIO,  
            EDIT_EXT_HORA_MARTES_FIN:           EDIT_EXT_HORA_MARTES_FIN,    
            EDIT_EXT_HORA_MIERCOLES_INICIO:     EDIT_EXT_HORA_MIERCOLES_INICIO,
            EDIT_EXT_HORA_MIERCOLES_FIN:        EDIT_EXT_HORA_MIERCOLES_FIN,
            EDIT_EXT_HORA_JUEVES_INICIO:        EDIT_EXT_HORA_JUEVES_INICIO  ,
            EDIT_EXT_HORA_JUEVES_FIN:           EDIT_EXT_HORA_JUEVES_FIN,
            EDIT_EXT_HORA_VIERNES_INICIO:       EDIT_EXT_HORA_VIERNES_INICIO,  
            EDIT_EXT_HORA_VIERNES_FIN:          EDIT_EXT_HORA_VIERNES_FIN     
        }
    }).done(function(resp) {
               if (resp > 0) {
            Swal.fire("MODIFICACIÓN EXITOSA", "Datos correctamente registrados, extraescolar modifcada", "success")
                .then((value) => {
                    table_extraescolar_adm.ajax.reload();
                    TraerDatosUsuario();
                });
        } else {
            Swal.fire("ERROR", "No fue posible la modificación en la base de datos", "error");
        }
    })
}

//----------------------------------------------------------------------------- FIN MODIFICACIÓN DE LOS DATOS DEL USUARIO EXTRAESCOLAR ----------------------------------------------------------------------------------

//############################################################################################ FIN DE TABLA EXTRAESCOLAR #############################################################################################






//################################################################################################ TABLA ALUMNO #############################################################################################

//--------------------------------------------------------------------------- INICIO LISTADO DE TABLA ALUMNO PERFIL ADMINISTRADOR ------------------------------------------------------------------------------

// Mostrar la tabla alumno
var table_lista_asistencias_adm;

function listar_lista_asistencias() {

    table_lista_asistencias_adm = $("#tabla_lista_asistencias").DataTable({ //ID de la tabla
        "bAutoWidth": false,
        "columnDefs": [{
            "searchable": true,
                "orderable": false,
            "targets": 0
        }
        ],
        
        "order": [[1, 'asc']],
        "dom": 'Bfrtip',
        "buttons": [
            {
                "extend": 'copyHtml5',
                "text": 'COPIAR'
            },
            {
                "extend": 'excelHtml5',
                "text": 'EXCEL'
            },
            {
                "extend": 'csvHtml5',
                "text": 'CVS'
            }],
        "ordering": false,
        "bLengthChange": true,
        "oSearch": {"bSmart": false},
        "searching": { "regex": true },
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "TODOS"]
        ],
        "pageLength": 10,
        "destroy": true,
        "async": true,
        "processing": true,

        "ajax": {
            "url": "../controlador/administrador/controlador_lista_asistencias_listar.php",
            type: 'POST'
        },
        "columns": [
            { "data": "ALU_EXTRAESCOLAR_COMPLETO" },
            { "data": "ALU_NOMBRE_COMPLETO" },
            { "data": "ALU_NUMERO_CONTROL" },
            { "data": "CAR_ABREVIATURA" },
            { "data": "vacio" },
            { "data": "vacio" },
            { "data": "vacio" },
            { "data": "vacio" },
            { "data": "vacio" },
            { "data": "vacio" },
            { "data": "vacio" },
            { "data": "vacio" },
            { "data": "vacio" },
            { "data": "vacio" },
            { "data": "vacio" },
            { "data": "vacio" },
            { "data": "vacio" },
            { "data": "vacio" },
            { "data": "vacio" },
            { "data": "vacio" },
            { "data": "vacio" },
            { "data": "vacio" },
            { "data": "vacio" },
            { "data": "vacio" },
            { "data": "vacio" },
            { "data": "vacio" },
            { "data": "vacio" },
            { "data": "vacio" },
            { "data": "vacio" },
            { "data": "vacio" },
            { "data": "vacio" },
            { "data": "vacio" },
            { "data": "vacio" },
            { "data": "vacio" },
            { "data": "vacio" }
        ],

        "language": idioma_espanol,
        select: true
    });



 document.getElementById("tabla_lista_asistencias_filter").style.display="none";
   $('input.global_filter').on( 'keyup click', function () {
        filterGlobal_lista_asistencias();
    } );
    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    });


   table_lista_asistencias_adm.on( 'order.dt search.dt', function () {
        table_lista_asistencias_adm.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

}

function filterGlobal_lista_asistencias() {
    $('#tabla_lista_asistencias').DataTable().search(
        $('#global_filter_lista_asistencias').val(),
    ).draw();
}


function filterGlobal_lista_asis() {
    $('#tabla_lista_asistencias').DataTable().search(
        $('#opcion_extraescolar_busqueda').val(), //NOMBRE DEL INPUT
    ).draw();
}


// Mostrar la tabla alumno
var table_lista_asistencias_reporte;

function listar_lista_asistencias_reporte() {

    table_lista_asistencias_reporte = $("#tabla_lista_asistencias_reporte").DataTable({ //ID de la tabla
        "bAutoWidth": false,
        "columnDefs": [{
            "searchable": true,
            "orderable": false,
            "targets": 0
        }
        ],
        
        "order": [[1, 'asc']],
        "dom": 'Bfrtip',
        "buttons": [
            {
                "extend": 'copyHtml5',
                "text": 'COPIAR'
            },
            {
                "extend": 'excelHtml5',
                "text": 'EXCEL'
            },
            {
                "extend": 'csvHtml5',
                "text": 'CVS'
            }],
        "ordering": false,
        "bLengthChange": true,
        "oSearch": { "bSmart": false },
        "searching": { "regex": true },
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "TODOS"]
        ],
        "pageLength": 10,
        "destroy": true,
        "async": true,
        "processing": true,

        "ajax": {
            "url": "../controlador/administrador/controlador_lista_asistencias_listar.php",
            type: 'POST'
        },
        "columns": [
            { "data": "ALU_EXTRAESCOLAR_COMPLETO" },
            { "data": "ALU_NOMBRE_COMPLETO" },
            { "data": "ALU_NUMERO_CONTROL" },
            { "data": "CAR_ABREVIATURA" }
        ],

        "language": idioma_espanol,
        select: true
    });

document.getElementById("tabla_lista_asistencias_filter").style.display="none";
   $('input.global_filter').on( 'keyup click', function () {
        filterGlobal_lista_asistencias();
    } );
    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    });


   table_lista_asistencias_reporte.on( 'order.dt search.dt', function () {
        table_lista_asistencias_reporte.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

}















//################################################################################################ TABLA ALUMNO #############################################################################################

//--------------------------------------------------------------------------- INICIO LISTADO DE TABLA ALUMNO PERFIL ADMINISTRADOR ------------------------------------------------------------------------------

// Mostrar la tabla alumno
var table_lista_acreditacion;

function listar_lista_acreditacion() {

    table_lista_acreditacion = $("#tabla_lista_acreditacion").DataTable({ //ID de la tabla
        "columnDefs": [{
            "searchable": true,
                "orderable": false,
            "targets": 0
        }
        ],
        "dom": 'Bfrtip',
        "buttons": [
            {
                "extend": 'copyHtml5',
                "text": 'COPIAR'
            },
            {
                "extend": 'excelHtml5',
                "text": 'EXCEL'
            },
            {
                "extend": 'csvHtml5',
                "text": 'CVS'
            }],
        "order": [[1, 'asc']],
        "ordering": false,
        "bLengthChange": true,
        "oSearch": {"bSmart": false},
        "searching": { "regex": true },
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "TODOS"]
        ],
        "pageLength": 10,
        "destroy": true,
        "async": true,
        "processing": true,

        "ajax": {
            "url": "../controlador/administrador/controlador_lista_acreditacion_listar.php",
            type: 'POST'
        },
        "columns": [
            { "data": "ALU_EXTRAESCOLAR_COMPLETO" },
            { "data": "ALU_NOMBRE_COMPLETO" },
            { "data": "ALU_NUMERO_CONTROL" },
            { "data": "CAR_ABREVIATURA" },
            { "data": "SEM_SEMESTRE" },
            { "data": "ALU_SEXO" },
            {
                "data": "INS_ESTADO_ACREDITACION",
                render: function(data, type, row) {
                    if (data == 'ACREDITADO') {
                        return "<span class='badge badge-pill badge-success'>" + data + "</span>";
                    } else {
                        return "<span class='badge badge-pill badge-danger'>" + data + "</span>";
                    }
                }
            },

            {
                "data": "INS_ESTADO_ACREDITACION",
                render: function(data, type, row) {
                    if (data == 'ACREDITADO') {
                        return "<button style='font-size:15px; height:30%; text-align:center;' type='button' class='desactivar btn btn-alt-danger'><i class='si si-close'></i></button>&nbsp;<button style='font-size:15px; height:30%; text-align:center;' type='button'  class='imprimir btn btn-alt-info'><i class='fa fa-print'></i></button>";
                    } else {
                        return "<button style='font-size:15px; height:30%; width:50%; text-align:center;' type='button' class='activar btn btn-alt-success'><i class='si si-check'></i></button>";
                    }
                }
            }
        ],

        "language": idioma_espanol,
        select: true
    });



 document.getElementById("tabla_lista_acreditacion_filter").style.display="none";
   $('input.global_filter').on( 'keyup click', function () {
        filterGlobal_lista_acreditacion();
    } );
    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    });


   table_lista_acreditacion.on( 'order.dt search.dt', function () {
        table_lista_acreditacion.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

}

function filterGlobal_lista_acreditacion() {
    $('#tabla_lista_acreditacion').DataTable().search(
        $('#global_filter_lista_acreditacion').val(),
    ).draw();
}


function filterGlobal_lista_acre() {
    $('#tabla_lista_acreditacion').DataTable().search(
        $('#opcion_extraescolar_busqueda').val(), //NOMBRE DEL INPUT
    ).draw();
}



//----------------------------------------------------------------------------- INICIO MODIFICACIÓN DEL ESTADO DE ACREDITACIÓN ----------------------------------------------------------------------------------

function Modificar_Estado_Acreditacion(MOD_INS_ID_INSCRIPCION, MOD_INS_ESTADO_ACREDITACION) {
    var mensaje = "";
    if (MOD_INS_ESTADO_ACREDITACION == 'N/A') {
        mensaje = '"no acredtado"';
    } else {
        mensaje = '"acreditado"';
    }
    $.ajax({
        "url": "../controlador/administrador/controlador_modificar_estado_acreditacion.php",
        type: 'POST',
        data: {
            MOD_INS_ID_INSCRIPCION:         MOD_INS_ID_INSCRIPCION,
            MOD_INS_ESTADO_ACREDITACION:    MOD_INS_ESTADO_ACREDITACION
        }

    }).done(function(resp) {
        if (resp > 0) {
            Swal.fire("MODIFICACIÓN EXITOSA", "Se ha establecido al alumno como " + mensaje + "", "success")
                .then((value) => {
                    table_lista_acreditacion.ajax.reload();
                });
        }
    })
}



//--------------------------------------------------------------------------------- INICIO DE BOTONES DE ACCIONES ACREDITACIÓN ----------------------------------------------------------------------------

// BOTÓN ACTIVAR
$('#tabla_lista_acreditacion').on('click', '.activar', function() {
    var data = table_lista_acreditacion.row($(this).parents('tr')).data();
    if (table_lista_acreditacion.row(this).child.isShown()) {
        var data = table_lista_acreditacion.row(this).data();
    }
    Swal.fire({
        title: '¿Desea marcar al alumno como "acreditado"?',
        text: "Será habilidata la opción para imprimir la constancia de acreditación",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí'
    }).then((result) => {
        if (result.value) {
            Modificar_Estado_Acreditacion(data.INS_ID_INSCRIPCION, 'ACREDITADO');
        }
    })
})

// BOTÓN DESACTIVAR
$('#tabla_lista_acreditacion').on('click', '.desactivar', function () {
    var data = table_lista_acreditacion.row($(this).parents('tr')).data();
    if (table_lista_acreditacion.row(this).child.isShown()) {
        var data = table_lista_acreditacion.row(this).data();
    }
    Swal.fire({
        title: '¿Desea marcar al alumno como "no acreditado"?',
        text: "Será deshabilidata la opción para imprimir la constancia de acreditación",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí'
    }).then((result) => {
        if (result.value) {
            Modificar_Estado_Acreditacion(data.INS_ID_INSCRIPCION, 'N/A');
        }
    })
})

// BOTÓN EDITAR
$('#tabla_lista_acreditacion').on('click', '.imprimir', function () {
    var data = table_lista_acreditacion.row($(this).parents('tr')).data();
    if (table_lista_acreditacion.row(this).child.isShown()) {
        var data = table_lista_acreditacion.row(this).data();
    } 
    if (data.TIPEXT_TIPO_EXTRAESCOLAR == 'ACTIVIDADES DEPORTIVAS') {
        window.open("../vista/reporte/deportivo.php?NUMERO_CONTROL="+(data.ALU_NUMERO_CONTROL)+"&PERIODO="+(data.ALU_PERIODO)+"&NOMBRE="+(data.ALU_NOMBRE_COMPLETO)+"&CARRERA="+(data.CAR_ABREVIATURA)+"&SEMESTRE="+(data.SEM_SEMESTRE)+"&EXTRAESCOLAR="+(data.ALU_EXTRAESCOLAR_COMPLETO)+"&RESULTADO="+(data.INS_ESTADO_ACREDITACION));
                            Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'La constancia de acreditación ha sido generada con éxito',
                        showConfirmButton: false,
                        timer: 1500
                    });
    } else {
        window.open("../vista/reporte/cultural.php?NUMERO_CONTROL="+(data.ALU_NUMERO_CONTROL)+"&PERIODO="+(data.ALU_PERIODO)+"&NOMBRE="+(data.ALU_NOMBRE_COMPLETO)+"&CARRERA="+(data.CAR_ABREVIATURA)+"&SEMESTRE="+(data.SEM_SEMESTRE)+"&EXTRAESCOLAR="+(data.ALU_EXTRAESCOLAR_COMPLETO)+"&RESULTADO="+(data.INS_ESTADO_ACREDITACION));
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'La constancia de acreditación ha sido generada con éxito',
                        showConfirmButton: false,
                        timer: 1500
                    });
    }

});



//---------------------------------------------------------------------------------- FIN DE BOTONES DE ACCIONES EXTRAESCOLAR ----------------------------------------------------------------------------------------













//############################################################################33 FUNCIONES DE VALIDACION DE DATOS EN FORMULARIOS #########################################
function Solo_Numeros(e){
      tecla = (document.all) ? e.keyCode : e.which;
      if (tecla==8){
          return true;
      }
      // Patron de entrada, en este caso solo acepta numeros
      patron =/[0-9]/;
      tecla_final = String.fromCharCode(tecla);
      return patron.test(tecla_final);
  }
  function Solo_Letras(e){
      key = e.keyCode || e.which;
      tecla = String.fromCharCode(key).toLowerCase();
      letras = "áéíóúabcdefghijklmnñopqrstuvwxyz _";
      especiales = "8-37-39-46";
      tecla_especial = false
      for(var i in especiales){
          if(key == especiales[i]){
              tecla_especial = true;
              break;
          }
      }
      if(letras.indexOf(tecla)==-1 && !tecla_especial){
          return false;
      }
  }

function mayus(e) {
    e.value = e.value.toUpperCase();
}



//#######################################

function tomarImagenPorSeccion(div,nombre) {

	html2canvas(document.querySelector("#" + div)).then(canvas => {
		var img = canvas.toDataURL();
		console.log(img);
		base = "img=" + img + "&nombre=" + nombre;

		$.ajax({
			type:"POST",
			url:"../procesos/crearImagenes.php",
			data:base,
			success:function(respuesta) {	
				respuesta = parseInt(respuesta);
                if (respuesta > 0) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'El horario ha sido capturado con éxito',
                        showConfirmButton: false,
                        timer: 1500
                    });

				} else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'El horario no ha sido capturado',
                        showConfirmButton: false,
                        timer: 1500
                    });
				}
			}
		});
	});	
}









//########################################################################### TABLA EXTRAESCOLAR HORARIOS ACTIVIDADES DEPORTIVAS #############################################################################################

//---------------------------------------------------- INICIO LISTADO DE TABLA EXTRAESCOLAR HORARIOS ACTIVIDADES DEPORTIVAS PERFIL ADMINISTRADOR ------------------------------------------------------------------------------

// Mostrar la tabla extraescolar
var table_extraescolar_horario_actividades_deportivas_adm;

function listar_extraescolar_horario_actividades_deportivas() {

    table_extraescolar_horario_actividades_deportivas_adm = $("#tabla_extraescolar_horario_actividades_deportivas").DataTable({ //ID de la tabla
        "ordering": false,
        "bLengthChange": false,
        "searching": { "regex": true },
        "lengthMenu": [
            [30, 40, 50, 100, -1],
            [30, 40, 50, 100, "TODOS"]
        ],
        "pageLength": 30,
        "destroy": true,
        "async": true,
        "processing": true,
        "info": false,
        "paging": false,
        "ajax": {
            "url": "../controlador/administrador/controlador_extraescolar_horario_actividades_deportivas_listar.php",
            type: 'POST'
        },
        "columns": [
            { "data": "EXT_NOMBRE_EXTRAESCOLAR" },
            { "data": "EXT_HORARIO_LUNES" },
            { "data": "EXT_HORARIO_MARTES" },
            { "data": "EXT_HORARIO_MIERCOLES" },
            { "data": "EXT_HORARIO_JUEVES" },
            { "data": "EXT_HORARIO_VIERNES" },
            { "data": "LUG_LUGAR" },
            { "data": "PRO_NOMBRE_COMPLETO" },
        ],

        "language": idioma_espanol,
        select: true
    });


  document.getElementById("tabla_extraescolar_horario_actividades_deportivas_filter").style.display="none";
   $('input.global_filter').on( 'keyup click', function () {
        filterGlobal_ext_horario_actividades_deportivas();
    } );
    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    });

}




//---------------------------------------------------- INICIO LISTADO DE TABLA EXTRAESCOLAR HORARIOS ACTIVIDADES CULTURALES PERFIL ADMINISTRADOR ------------------------------------------------------------------------------

// Mostrar la tabla de horarios de extraescolar
var table_extraescolar_horario_actividades_culturales_adm;

function listar_extraescolar_horario_actividades_culturales() {

    table_extraescolar_horario_actividades_culturales_adm = $("#tabla_extraescolar_horario_actividades_culturales").DataTable({ //ID de la tabla
         "ordering": false,
        "bLengthChange": false,
        "searching": { "regex": true },
        "lengthMenu": [
            [30, 40, 50, 100, -1],
            [30, 40, 50, 100, "TODOS"]
        ],
        "pageLength": 30,
        "destroy": true,
        "async": true,
        "processing": true,
        "info": false,
        "paging": false,
        "ajax": {
            "url": "../controlador/administrador/controlador_extraescolar_horario_actividades_culturales_listar.php",
            type: 'POST'
        },
        "columns": [
            { "data": "EXT_NOMBRE_EXTRAESCOLAR" },
            { "data": "EXT_HORARIO_LUNES" },
            { "data": "EXT_HORARIO_MARTES" },
            { "data": "EXT_HORARIO_MIERCOLES" },
            { "data": "EXT_HORARIO_JUEVES" },
            { "data": "EXT_HORARIO_VIERNES" },
            { "data": "LUG_LUGAR" },
            { "data": "PRO_NOMBRE_COMPLETO" },
        ],

        "language": idioma_espanol,
        select: true
    });


  document.getElementById("tabla_extraescolar_horario_actividades_culturales_filter").style.display="none";
   $('input.global_filter').on( 'keyup click', function () {
        filterGlobal_ext_horario_actividades_culturales();
    } );
    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    });

}


function filterGlobal_ext_horario_actividades_culturales() {
    $('#tabla_extraescolar_horario_actividades_culturales').DataTable().search(
        $('#global_filter_ext_horario_actividades_culturales').val(),
    ).draw();
}




//######################################################################################## FIN DE .JS ADMINISTRADOR ##################################################################################################





//################################################################################### LISTADOS SELECT OPTIONS #####################################################################################

// -------------------------------------------------------------------------------- Listado de tipo de usuario -----------------------------------------------------------------------------------------
function listar_opcion_tipo_usuario() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_tipo_usuario.php",
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

// -------------------------------------------------------------------------------- Listado de tipo de extraescolar -----------------------------------------------------------------------------------------
function listar_opcion_tipo_extraescolar() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_tipo_extraescolar.php",
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

// -------------------------------------------------------------------------------- Listado de tipo de extraescolar búsqueda -----------------------------------------------------------------------------------------
function listar_opcion_tipo_extraescolar_busqueda() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_tipo_extraescolar.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value=' '> AMBAS </option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][1] + "'>" + data[i][1] + "</option>";
            }
            
            $("#opcion_tipo_extraescolar_busqueda").html(cadena);
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#opcion_tipo_extraescolar_busqueda").html(cadena);
        }
    })
}

// -------------------------------------------------------------------------------- Listado de tipo de extraescolar administrador -----------------------------------------------------------------------------------------
function listar_opcion_tipo_extraescolar_adm() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_tipo_extraescolar_adm.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
            }
            $("#opcion_tipo_extraescolar_adm").html(cadena);
            $("#opcion_tipo_extraescolar_adm_editar").html(cadena);
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#opcion_tipo_extraescolar_adm").html(cadena);
            $("#opcion_tipo_extraescolar_adm_editar").html(cadena);
        }
    })
}



// -------------------------------------------------------------------------------- Listado de carreras -----------------------------------------------------------------------------------------
function listar_opcion_carrera() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_carrera.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value=''>Seleccionar carrera</option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + " - " + data[i][2] +"</option>";
            }
            $("#opcion_carrera").html(cadena);
            $("#opcion_carrera_editar").html(cadena);
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#opcion_carrera").html(cadena);
            $("#opcion_carrera_editar").html(cadena);
        }
    })
}

// -------------------------------------------------------------------------------- Listado de grupos de extraescolar -----------------------------------------------------------------------------------------
function listar_opcion_grupo_extraescolar() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_grupo_extraescolar.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
            }
            $("#opcion_grupo_extraescolar").html(cadena);
            $("#opcion_grupo_extraescolar_editar").html(cadena);
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#opcion_grupo_extraescolar").html(cadena);
            $("#opcion_grupo_extraescolar_editar").html(cadena);
        }
    })
}


// -------------------------------------------------------------------------------- Listado de periodo -----------------------------------------------------------------------------------------
function listar_opcion_periodo() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_periodo.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value=''>Seleccionar periodo </option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][1]  + " - " + data[i][2] + "</option>";
            }
            $("#opcion_periodo").html(cadena);
            $("#opcion_periodo_editar").html(cadena);
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#opcion_periodo").html(cadena);
            $("#opcion_periodo_editar").html(cadena);
        }
    })
}

// -------------------------------------------------------------------------------- Listado de extraescolar -----------------------------------------------------------------------------------------
function listar_opcion_extraescolar() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_extraescolar.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value=''>Seleccionar extraescolar</option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][3]  + "</option>";
            }
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        }
    })
}


function listar_opcion_extraescolar_atletismo() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_extraescolar_atletismo.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value=''>Seleccionar extraescolar</option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][3]  + "</option>";
            }
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        } else {
            cadena += "<option value=''>El tipo de extraescolar no cuenta con cupo disponible</option>";
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        }
    })
}

function listar_opcion_extraescolar_ajedrez() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_extraescolar_ajedrez.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value=''>Seleccionar extraescolar</option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][3]  + "</option>";
            }
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        } else {
            cadena += "<option value=''>El tipo de extraescolar no cuenta con cupo disponible</option>";
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        }
    })
}


function listar_opcion_extraescolar_baile_moderno() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_extraescolar_baile_moderno.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value=''>Seleccionar extraescolar</option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][3]  + "</option>";
            }
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        } else {
            cadena += "<option value=''>El tipo de extraescolar no cuenta con cupo disponible</option>";
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        }
    })
}

function listar_opcion_extraescolar_baile_salon() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_extraescolar_baile_salon.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value=''>Seleccionar extraescolar</option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][3]  + "</option>";
            }
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        } else {
            cadena += "<option value=''>El tipo de extraescolar no cuenta con cupo disponible</option>";
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        }
    })
}



function listar_opcion_extraescolar_basquetbol() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_extraescolar_basquetbol.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value=''>Seleccionar extraescolar</option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][3]  + "</option>";
            }
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        } else {
            cadena += "<option value=''>El tipo de extraescolar no cuenta con cupo disponible</option>";
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        }
    })
}

function listar_opcion_extraescolar_beisbol() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_extraescolar_beisbol.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value=''>Seleccionar extraescolar</option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][3]  + "</option>";
            }
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        } else {
            cadena += "<option value=''>El tipo de extraescolar no cuenta con cupo disponible</option>";
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        }
    })
}



function listar_opcion_extraescolar_cine_club() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_extraescolar_cine_club.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value=''>Seleccionar extraescolar</option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][3]  + "</option>";
            }
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        } else {
            cadena += "<option value=''>El tipo de extraescolar no cuenta con cupo disponible</option>";
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        }
    })
}

function listar_opcion_extraescolar_danza() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_extraescolar_danza.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value=''>Seleccionar extraescolar</option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][3]  + "</option>";
            }
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        } else {
            cadena += "<option value=''>El tipo de extraescolar no cuenta con cupo disponible</option>";
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        }
    })
}

function listar_opcion_extraescolar_escolta() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_extraescolar_escolta.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value=''>Seleccionar extraescolar</option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][3]  + "</option>";
            }
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        } else {
            cadena += "<option value=''>El tipo de extraescolar no cuenta con cupo disponible</option>";
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        }
    })
}


function listar_opcion_extraescolar_fotografia() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_extraescolar_fotografia.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value=''>Seleccionar extraescolar</option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][3]  + "</option>";
            }
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        } else {
            cadena += "<option value=''>El tipo de extraescolar no cuenta con cupo disponible</option>";
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        }
    })
}

function listar_opcion_extraescolar_futbol_femenil() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_extraescolar_futbol_femenil.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value=''>Seleccionar extraescolar</option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][3]  + "</option>";
            }
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        } else {
            cadena += "<option value=''>El tipo de extraescolar no cuenta con cupo disponible</option>";
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        }
    })
}

function listar_opcion_extraescolar_futbol_varonil() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_extraescolar_futbol_varonil.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value=''>Seleccionar extraescolar</option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][3]  + "</option>";
            }
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        } else {
            cadena += "<option value=''>El tipo de extraescolar no cuenta con cupo disponible</option>";
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        }
    })
}


function listar_opcion_extraescolar_musica() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_extraescolar_musica.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value=''>Seleccionar extraescolar</option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][3]  + "</option>";
            }
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        } else {
            cadena += "<option value=''>El tipo de extraescolar no cuenta con cupo disponible</option>";
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        }
    })
}


function listar_opcion_extraescolar_parkour() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_extraescolar_parkour.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value=''>Seleccionar extraescolar</option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][3]  + "</option>";
            }
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        } else {
            cadena += "<option value=''>El tipo de extraescolar no cuenta con cupo disponible</option>";
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        }
    })
}


function listar_opcion_extraescolar_pintura_dibujo() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_extraescolar_pintura_dibujo.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value=''>Seleccionar extraescolar</option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][3]  + "</option>";
            }
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        } else {
            cadena += "<option value=''>El tipo de extraescolar no cuenta con cupo disponible</option>";
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        }
    })
}


function listar_opcion_extraescolar_softbol() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_extraescolar_softbol.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value=''>Seleccionar extraescolar</option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][3]  + "</option>";
            }
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        } else {
            cadena += "<option value=''>El tipo de extraescolar no cuenta con cupo disponible</option>";
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        }
    })
}


function listar_opcion_extraescolar_taekwondo() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_extraescolar_taekwondo.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value=''>Seleccionar extraescolar</option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][3]  + "</option>";
            }
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        } else {
            cadena += "<option value=''>El tipo de extraescolar no cuenta con cupo disponible</option>";
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        }
    })
}


function listar_opcion_extraescolar_teatro() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_extraescolar_teatro.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value=''>Seleccionar extraescolar</option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][3]  + "</option>";
            }
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        } else {
            cadena += "<option value=''>El tipo de extraescolar no cuenta con cupo disponible</option>";
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        }
    })
}


function listar_opcion_extraescolar_voleibol() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_extraescolar_voleibol.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value=''>Seleccionar extraescolar</option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][3]  + "</option>";
            }
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        } else {
            cadena += "<option value=''>El tipo de extraescolar no cuenta con cupo disponible</option>";
            $("#opcion_extraescolar").html(cadena);
            $("#opcion_extraescolar_editar").html(cadena);
        }
    })
}






// -------------------------------------------------------------------------------- Listado de extraescolar búsqueda -----------------------------------------------------------------------------------------
function listar_opcion_extraescolar_busqueda() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_extraescolar.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value=' '>TODOS</option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][1] + " " + data[i][2] + "'>" + data[i][3]  + "</option>";
            }
            $("#opcion_extraescolar_busqueda").html(cadena);
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#opcion_extraescolar_busqueda").html(cadena);
        }
    })
}


// -------------------------------------------------------------------------------- Listado de lugares -----------------------------------------------------------------------------------------
function listar_opcion_lugar() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_lugar.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value=''>Seleccionar instalación</option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
            }
            $("#opcion_lugar").html(cadena);
            $("#opcion_lugar_editar").html(cadena);
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#opcion_lugar").html(cadena);
            $("#opcion__lugar_editar").html(cadena);
        }
    })
}

// -------------------------------------------------------------------------------- Listado de promotores -----------------------------------------------------------------------------------------
function listar_opcion_promotor() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_promotor.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value=''>Seleccionar promotor</option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][1]  + " " + data[i][2]  + " " + data[i][3] + "</option>";
            }
            $("#opcion_promotor").html(cadena);
            $("#opcion_promotor_editar").html(cadena);
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#opcion_promotor").html(cadena);
            $("#opcion_promotor_editar").html(cadena);
        }
    })
}

// -------------------------------------------------------------------------------- Listado de admnistradores -----------------------------------------------------------------------------------------
function listar_opcion_administrador() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_administrador.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
            }
            $("#opcion_administrador").html(cadena);
            $("#opcion_administrador_editar").html(cadena);
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#opcion_administrador").html(cadena);
            $("#opcion_administrador_editar").html(cadena);
        }
    })
}


// -------------------------------------------------------------------------------- Listado de alumnos -----------------------------------------------------------------------------------------
function listar_opcion_alumno() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_alumno.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value=''>Seleccionar alumno</option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][1]  + " - " + data[i][2]  + " " + data[i][3]  + " " + data[i][4] +"</option>";
            }
            $("#opcion_alumno").html(cadena);
            $("#opcion_alumno_editar").html(cadena);
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#opcion_alumno").html(cadena);
            $("#opcion_alumno_editar").html(cadena);
        }
    })
}

// -------------------------------------------------------------------------------- Listado de alumnos -----------------------------------------------------------------------------------------
function listar_opcion_semestre() {
    $.ajax({
        "url": "../controlador/administrador/controlador_listar_opcion_semestre.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value=''>Seleccionar semestre</option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][1] +"</option>";
            }
            $("#opcion_semestre").html(cadena);
            $("#opcion_semestre_editar").html(cadena);
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#opcion_semestre").html(cadena);
            $("#opcion_semestre_editar").html(cadena);
        }
    })
}
//################################################################################ FIN DE LISTADOS SELECT OPTIONS #####################################################################################
