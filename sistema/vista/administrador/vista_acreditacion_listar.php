<script type="text/javascript" src="../../../../extraescolares_itpachuca/sistema/js/administrador.js?rev=<?php echo time();?>"></script>

<div class="col-12">
    <div class="block block-themed">
        <div class="block-header block-header-default">
            <h1 class="block-title"><b>LISTAS DE ACREDITACIÓN</b></h1>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle">  <i class="si si-size-fullscreen"></i>           </button>
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="pinned_toggle">      <i class="si si-pin"></i>                       </button>
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                </div>
        </div>

        <div class="block-content">
            

            <div class="container row" style="margin-right:0px; margin-left:0px; padding-top:10px;">
                <div class="col-lg-8">  
                    <br>   
                    <input type="text" class="global_filter form-control" id="global_filter_lista_acreditacion" onkeyup="mayus(this);" placeholder="Buscar registro alumno" >  <br>   
                </div>
    
                    <div class="col-lg-4">                               
                        <label for="">FILTRAR POR EXTRAESCOLAR:</label>
                        <select autocomplete="off" class="js-example-basic-single form-control" name="filtrar_tipo_extraescolar" id="opcion_extraescolar_busqueda" onchange="filterGlobal_lista_acre();" style="width:100%;" >
                        </select><br>   
                    </div>
            </div>


            <div class="block">
                <table id="tabla_lista_acreditacion" class="text-center hidden dataTables_wrapper dt-bootstrap4 no-footer display responsive table-bordered table-vcenter" style="width:100%; font-size:11px">
                    <thead>
                        <tr>
                            <th style="width:5px"> </th>
                            <th style="width:200px; text-align:center;">NOMBRE DEL ALUMNO</th>
                            <th style="width:80px; text-align:center;">NO. CONTROL</th>
                            <th style="width:60px; text-align:center;">CARRERA</th>
                            <th style="width:60px; text-align:center;">SEMESTRE</th>
                            <th style="width:60px; text-align:center;">SEXO</th>
                            <th style="width:100px; text-align:center;">RESULTADO</th>
                            <th style="width:10px; text-align:center;">ACCIONES</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>




<script>
$(document).ready(function() {
    listar_lista_acreditacion();
    listar_opcion_extraescolar_busqueda();    
    $('.js-example-basic-single').select2();
} );
</script>

