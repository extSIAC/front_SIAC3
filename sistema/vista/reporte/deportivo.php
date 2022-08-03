
<?php
    include_once('tbs_class.php'); 
    include_once('plugins/tbs_plugin_opentbs.php'); 

    $TBS = new clsTinyButStrong; 
    $TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); 
    
    //Parametros

$meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");

$meses[date('n')-1];
 

    $REP_ALU_NUMERO_CONTROL         = $_GET['NUMERO_CONTROL'];
    $REP_ALU_PERIODO                = $_GET['PERIODO'];
    $REP_ALU_NOMBRE_COMPLETO        = $_GET['NOMBRE'];
    $REP_ALU_ABREVIATURA            = $_GET['CARRERA'];
    $REP_ALU_SEMESTRE               = $_GET['SEMESTRE'];
    $REP_ALU_EXTRAESCOLAR_COPLETO   = $_GET['EXTRAESCOLAR'];
    $REP_ALU_RESULTADO              = $_GET['RESULTADO'];
    $REP_FECHA                      = date('d').' DE '.$meses[date('n')-1].' DEL '.date('Y');
    //Cargando template
    $template = 'CONSTANCIA_ACTIVIDADES_DEPORTIVAS.docx';
    $TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8);
    //Escribir Nuevos campos
    $TBS->MergeField('REP_NO_CONTROL',          $REP_ALU_NUMERO_CONTROL);
    $TBS->MergeField('REP_PERIODO',             $REP_ALU_PERIODO);
    $TBS->MergeField('REP_NOMBRE_COMPLETO ',    $REP_ALU_NOMBRE_COMPLETO);
    $TBS->MergeField('REP_ABREVIATURA',         $REP_ALU_ABREVIATURA);
    $TBS->MergeField('REP_SEMESTRE',            $REP_ALU_SEMESTRE);
    $TBS->MergeField('REP_EXTRAESCOLAR',        $REP_ALU_EXTRAESCOLAR_COPLETO);
    $TBS->MergeField('REP_RESULTADO',           $REP_ALU_RESULTADO);
    $TBS->MergeField('REP_FECHA',               $REP_FECHA);


    $TBS->PlugIn(OPENTBS_DELETE_COMMENTS);

    $save_as = (isset($_POST['save_as']) && (trim($_POST['save_as'])!=='') && ($_SERVER['SERVER_NAME']=='localhost')) ? trim($_POST['save_as']) : '';
    $output_file_name = str_replace('.', '_'.$REP_ALU_EXTRAESCOLAR_COPLETO.'_'.$REP_ALU_NUMERO_CONTROL.'_'.date('Y-m-d').$save_as.'.', $template);
    if ($save_as==='') {
        $TBS->Show(OPENTBS_DOWNLOAD, $output_file_name); 
        exit();
    } else {
        $TBS->Show(OPENTBS_FILE, $output_file_name);
        exit("El archivo [$output_file_name] fue creado correctamente.");
    }
?>