<script type="text/javascript" src="../../../../extraescolares_itpachuca/sistema/js/administrador.js?rev=<?php echo time();?>"></script>

<div class="col-12">
    <div class="block block-themed">
        <div class="block-header block-header-default">
            <h1 class="block-title"><b>EXTRAESCOLARES DE ACTIVIDADES DEPORTIVAS</b></h1>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle">  <i class="si si-size-fullscreen"></i>           </button>
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="pinned_toggle">      <i class="si si-pin"></i>                       </button>
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                </div>
        </div>

        <div class="block-content">
            
            <div class="col-md-12">
                <div class="input-group input-group-lg col-md-12">
                        <input type="text" class="global_filter form-control" id="global_filter_ext_horario_actividades_deportivas" placeholder="Buscar registro extraescolar"><span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <div class="col-md-4">
                            <button type="button" id="capturar_horario_actividades_deportivas" class="btn btn-alt-success " style="width:100%" ><i class="glyphicon glyphicon-plus"></i>CAPTURAR HORARIO</button>
                        </div>
                        <div class="col-md-4">
                            <button  class="btn btn-alt-info " style="width:100%" ><i class="glyphicon glyphicon-plus"></i><a   href="../../../../extraescolares_itpachuca/info_extraescolares/horario_actividades_deportivas.html" target="_blank">VISTA PREVIA</a>   </button>
                        </div>
                </div>
            </div>
            <div>
                <br>
                <p><b>Oprima el símbolo "+" para ver las acciones disponibles al registro seleccionado.</b></p>
                <br>
            </div>
            <div id="HORARIO_ACTIVIDADES_DEPORTIVAS" class="block">
                <table id="tabla_extraescolar_horario_actividades_deportivas" class="text-center hidden dataTables_wrapper dt-bootstrap4 no-footer display responsive table-bordered table-vcenter" style="width:100%; font-size:12px; text-align:center" >
                    <thead>
                        <tr>
                            <th style="width:10px; text-align:center"> ACTIVIDAD</th>
                            <th style="width:50px; text-align:center"> LUNES</th>
                            <th style="width:50px; text-align:center"> MARTES</th>
                            <th style="width:50px; text-align:center"> MIÉRCOLES</th>
                            <th style="width:50px ;text-align:center"> JUEVES</th>
                            <th style="width:50px ;text-align:center"> VIERNES</th>
                            <th style="width:10px; text-align:center"> INSTALACIÓN</th>
                            <th style="width:150px; text-align:center"> PROMOTOR</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="block block-themed">
        <div class="block-header block-header-default">
            <h1 class="block-title"><b>EXTRAESCOLARES DE ACTIVIDADES CULTURALES</b></h1>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle">  <i class="si si-size-fullscreen"></i>           </button>
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="pinned_toggle">      <i class="si si-pin"></i>                       </button>
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                </div>
        </div>

        <div class="block-content">
            
            <div class="col-md-12">
                <div class="input-group input-group-lg col-md-12">
                        <input type="text" class="global_filter form-control" id="global_filter_ext_horario_actividades_culturales" placeholder="Buscar registro extraescolar"><span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <div class="col-md-4">
                            <button type="button" id="capturar_horario_actividades_culturales" class="btn btn-alt-success " style="width:100%" ><i class="glyphicon glyphicon-plus"></i>CAPTURAR HORARIO</button>
                        </div>
                        <div class="col-md-4">

                            <button  class="btn btn-alt-info " style="width:100%" ><i class="glyphicon glyphicon-plus"></i><a   href="../../../../extraescolares_itpachuca/info_extraescolares/horario_actividades_culturales.html" target="_blank">VISTA PREVIA</a>   </button>
                        </div>
                </div>
            </div>
            <div>
                <br>
                <p><b>Oprima el símbolo "+" para ver las acciones disponibles al registro seleccionado.</b></p>
                <br>
            </div>
            <div id="HORARIO_ACTIVIDADES_CULTURALES" class="block">
                <table id="tabla_extraescolar_horario_actividades_culturales" class="text-center dataTables_wrapper dt-bootstrap4 no-footer display responsive table-bordered table-vcenter" style="width:100%; font-size:12px">
                    <thead>
                        <tr>
                            <th style="width:10px; text-align:center"> ACTIVIDAD</th>
                            <th style="width:50px; text-align:center"> LUNES</th>
                            <th style="width:50px; text-align:center"> MARTES</th>
                            <th style="width:50px; text-align:center"> MIÉRCOLES</th>
                            <th style="width:50px ;text-align:center"> JUEVES</th>
                            <th style="width:50px ;text-align:center"> VIERNES</th>
                            <th style="width:10px; text-align:center"> INSTALACIÓN</th>
                            <th style="width:150px; text-align:center"> PROMOTOR</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
		$(document).ready(function(){
			$('#capturar_horario_actividades_deportivas').click(function(){
				tomarImagenPorSeccion('HORARIO_ACTIVIDADES_DEPORTIVAS','HORARIO_ACTIVIDADES_DEPORTIVAS');
			});

			$('#capturar_horario_actividades_culturales').click(function(){
				tomarImagenPorSeccion('HORARIO_ACTIVIDADES_CULTURALES','HORARIO_ACTIVIDADES_CULTURALES');
			});
		});
	</script>



<script>
$(document).ready(function() {
    listar_extraescolar_horario_actividades_deportivas();
    listar_extraescolar_horario_actividades_culturales();
    $('.js-example-basic-single').select2();
} );
</script>

