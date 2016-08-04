
<?php
error_reporting(0);
session_start();
include '../Modelo/DOC_Autoevaluacion_Modelo.php';

class Autoevaluacion_Controlador {

    /**
     * [__construct description]
     */
    public function __construct(){
        $this->autoevaluacion = new Autoevaluacion_Modelo;
    }

    /**
     * [seleccionarFactores selecciona los factores]
     * @return [json] array codificado en json con los factores
     */
    public function seleccionarFactores(){
        echo json_encode($this->autoevaluacion->cargarFactores()->GetRows());
    }

    /**
     * [seleccionarInformacionFactores selecciona la informacion de cada factor como lo es su nombre, descripcion]
     * @return [json] array codificado en json con la informacion de cada factores
     */
    public function seleccionarInformacionFactores(){
        echo json_encode($this->autoevaluacion->cargarInformacionBasicaFactor($_POST['idFactor'])->GetRows());
    }

    /**
     * [cargarInformacionFactor selecciona la informacion de cada factor con sus caracteristicas y para cada caracteristica selecciona los instrumentos
     *  de evaluacion que tenga asociado asi mismo para cada instrumento su respectivas opciones de respuesta y tablas de informacion aidicional y
     *  los documentos que tenga asociados , todos estos datos se guardan en un solo arreglo para ser procesado en e archivo selectores.js]
     * @return [json] array codificado en json con la informacion de cada factores y sus respectivos instrumentos
     */
    public function cargarInformacionFactor(){
        
        if ($_POST['idgrupo'] == $_SESSION['grupos_documental']['grupoP']){
            $fk_proceso = $_SESSION['pk_proceso'];
        }else{
            $fk_proceso = 0 ;
        }

        $pagina = $_POST['pagina'];
        $items  = $_POST['items'];
        $grupo = $_POST['grupo'];

        $caracteristicas = array();
        $arreglo = $this->autoevaluacion->cargarInformacionCaracteristicas($_POST['idFactor'], $pagina, $items)->GetRows();
        for($i=0; $i<count($arreglo); $i++){
            $arreglo[$i]['instrumentos'] = array();
            $instrumentos = $this->autoevaluacion->cargarInformacionPreguntas($arreglo[$i]['pk_caracteristica'] , $grupo , $fk_proceso)->GetRows();
            for($j=0; $j<count($instrumentos); $j++){
                $instrumentos[$j]['respuestas'] = array();
                $instrumentos[$j]['informacion'] = array();
                $instrumentos[$j]['documentos'] = array();
                $instrumentos[$j]['informacionadicional'] = array();
                $respuestas = $this->autoevaluacion->cargarInformacionRespuestas($instrumentos[$j]['pk_instru_evaluacion'])->GetRows();
                $informacion = $this->autoevaluacion->cargarInformacionAdicional($instrumentos[$j]['pk_instru_evaluacion'])->GetRows();
                $informacionadicional = $this->autoevaluacion->cargarInformacionAdicionaldoc($instrumentos[$j]['pk_instru_evaluacion'],$_SESSION['pk_usuario'], $fk_proceso )->GetRows();
                $documento = $this->autoevaluacion->cargarDocumentos($instrumentos[$j]['pk_instru_evaluacion'], $_SESSION['pk_usuario'], $fk_proceso)->GetRows();
                for($k=0; $k<count($respuestas); $k++){
                    array_push($instrumentos[$j]['respuestas'], $respuestas[$k]);
                }
                for($l=0; $l<count($informacion); $l++){
                    array_push($instrumentos[$j]['informacion'], $informacion[$l]);
                }
                for($t=0; $t<count($informacionadicional); $t++){
                    array_push($instrumentos[$j]['informacionadicional'], $informacionadicional[$t]);
                }
                for($m=0; $m<count($documento); $m++){
                    array_push($instrumentos[$j]['documentos'], $documento[$m]);
                }
                array_push($arreglo[$i]['instrumentos'], $instrumentos[$j]);
            }
            array_push($caracteristicas, $arreglo[$i]);
        }
        echo json_encode($caracteristicas);
    }

    /**
     * [guadarRespuestas Guarda las respuestas que un usuario asigno a un instrumento de evaluacion]
     * @return [json] array codificado en json con un estado que nos indica si la operacion fue realizada o no
     */
    public function guadarRespuestas(){

        if ($_POST['idgrupo'] == $_SESSION['grupos_documental']['grupoP']){
            $fk_proceso = $_SESSION['pk_proceso'];
        }else{
            $fk_proceso = "0";
        }

        $resultados = 1;
        $pk_usuario = $_SESSION['pk_usuario'];
        foreach($_POST['respuestas'] as &$valor){
            if(!$this->autoevaluacion->guardarRespuesta($valor['id_pregunta'], $valor['id_respuesta'], $valor['ponderacion'], $valor['observaciones'], $pk_usuario ,$fk_proceso, $valor['tipo'])){
                $resultados = 0;
            }
        }
        echo json_encode(array('estado' => $resultados));
    }

    /**
     * [cargarRespuestasGrupo CArga las opciones de respuesta de un instrumento dependiendo de el grupo que seleccione]
     * @param  [int] $grupo es una variable que indica a quee grupo de respuestas esta asoaciada un tipo de pregunta
     * @return [json] array codificado en json con las respuestas de cada grupo
     */
    public function cargarRespuestasGrupo($grupo){
         echo json_encode($this->autoevaluacion->cargarRespuestasGrupo($grupo)->GetRows());
    }

    /**
     * [verificarProcesos verifica si un susario tiene procesos activos actualmente]
     * @return [json] array codificado en json con el numero de procesos que tiene el usuario y el nombre del proceso
     */
    public function verificarProcesos(){

        $resultados = $this->autoevaluacion->verificarProceso($_SESSION['pk_usuario'])->GetRows();
        $datos = array('resultados' => count($resultados), 'proceso' => $resultados);
        echo json_encode($datos);
    }

    /**
     * [obtenerTotalCaracteristicas Obtiene el total de caracteristicas segun el factor que le enviamos]
     * @return [json] array codificado en json con el total de caracteristicas un int
     */
    public function obtenerTotalCaracteristicas(){
        $resultados = $this->autoevaluacion->totalCaracteristicas($_POST['idFactor'])->GetRows();
        echo json_encode($resultados);
    }

    /**
     * [obtenerRespuestas Obtiene las respuestas de cada instrumentos si ya tiene una para poder mostrarlas en el ingreso de la consolidacion]
     * @return [json] array codificado en json con el los resultados
     */
    public function obtenerRespuestas(){
        if ($_POST['idgrupo'] == $_SESSION['grupos_documental']['grupoP']){
            $fk_proceso =  $_SESSION['pk_proceso'];
        }else{
            $fk_proceso = "0";
        }
        $resultados = $this->autoevaluacion->obtenerRespuestas($_POST['id_pregunta'] , $fk_proceso)->GetRows();
        echo json_encode($resultados);
    }

    /**
     * [obtenerPorcentaje Obtiene el porcentaje que lleva cada proceso de respuestas que ya respondio]
     * @return [json] array codificado en json con el datos de el porcentaje por programa e institucional
     */
    public function obtenerPorcentaje(){

        if ($_POST['idgrupo'] == $_SESSION['grupos_documental']['grupoP']){
            $institucional = 0;
        }else{
            $institucional = 1;
        }

        $fk_proceso = $_SESSION['pk_proceso'];
        $instrumentos = $this->autoevaluacion->obtenerTotalInstrumentos($_SESSION['grupos_documental']['grupoP']);
        $totalPrograma = $this->autoevaluacion->obtenerAcumuladoProceso($fk_proceso);
        $porcentajePrograma = round(( $totalPrograma * 100 ) / $instrumentos);

        $instrumentos_institucional = $this->autoevaluacion->obtenerTotalInstrumentosInstitucional($_SESSION['grupos_documental']['grupoI']);
        $totalInstitucional = $this->autoevaluacion->obtenerAcumuladoProceso(0);
        $porcentajeInstitucional = round(( $totalInstitucional * 100 ) / $instrumentos_institucional);

        if ($porcentajePrograma == 100 && $porcentajeInstitucional == 100){
            $estado = 1;
        }else{
            $estado = 0;
        }

        $resultados = array(
            'institucional' => $institucional,
            'estado' => $estado,
            'instrumentos' => $instrumentos,
            'totalPrograma' => $totalPrograma,
            'porcentaje_programa' => $porcentajePrograma,
            'instrumentos_institucional' => $instrumentos_institucional,
            'totalInstitucional' => $totalInstitucional,
            'porcentaje_institucional' => $porcentajeInstitucional
        );
        
        echo json_encode($resultados);
    }

    /**
     * [consolidacionFinal Guarda la respuestas de un proceso en la tabla cna_respuestas_evidencia y es el momento en que un proceso se consolida]
     * @return [json] array codificado en json con el resultados que se obtuvieron en este caso un estado 1 y 0
     */
    public function consolidacionFinal(){
        $fk_proceso = $_SESSION['pk_proceso'];
        $resultados = $this->autoevaluacion->consolidacionFinal($fk_proceso);
        echo $resultados;
    
    }

    /**
     * [modificarRespuesta Modifica el valor que tenga una respuesta por el nuevo que le sea ingresado]
     * @return [json] array codificado en json con el resultados que se obtuvieron 
     */
    public function modificarRespuesta(){
        $resultados = 1;
        foreach($_POST['respuestas'] as &$valor){
            if(!$this->autoevaluacion->modificarRespuesta($valor['pk_respuestas_pregunta'], $valor['texto'], $valor['fk_respuesta_ponderacion'], $valor['tipo_respuesta'])){
                $resultados = 0;
            }
        }
        echo json_encode(array('estado' => $resultados));
    }

    /**
     * [eliminarTipoRespuesta Modifica el estado de un tipo de repuesta a 0]
     * @return [json] array codificado en json con el resultados que se obtuvieron 
     */
    public function eliminarTipoRespuesta(){
        $resultados = $this->autoevaluacion->eliminarTipoRespuesta($_POST['tipoEliminar']);
        echo $resultados;
    }  

    /**
     * [guardarArchivosExistentes Guarda los documentos de un instrumento de evaluacion]
     * @return [json] array codificado en json con el resultados que se obtuvieron 
     */
    public function guardarArchivosExistentes(){
        if ($_POST['programa'] == 0){
            $fk_proceso = "0";
        }else{
            $fk_proceso = $_SESSION['pk_proceso'];
        }
        
        if ($_POST['pk_documentos'] =! 0 && $_POST['programa'] =! 0 && $_POST['sede'] =! 0){
            $resultados = $this->autoevaluacion->guardarArchivosExistentes($_POST['pk_documento'], $_POST['programa'] ,$_POST['sede'], $fk_proceso);
            echo $resultados;
        }else{
            echo 0;
        }
      
    }

    /**
     * [verificarConsolidacion Verifica si un proceso se encuentra o no en la tabla doc_procesos_finalizados]
     * @return [json] array codificado en json con el resultados que se obtuvieron 
     */
    public function verificarConsolidacion(){
        $resultados = $this->autoevaluacion->verificarConsolidacion()->GetRows();
        echo json_encode($resultados);
    }
}

$controlador = new Autoevaluacion_Controlador;
$_operacion = $_POST['operacion'];

switch ($_operacion) {
    case 'consultarFactores':
        $controlador->seleccionarFactores();
    break;
    case 'cargarInformacionFactor':  
        $controlador->cargarInformacionFactor();      
    break;
    case 'cargarInformacionBasicaFactor':
        $controlador->seleccionarInformacionFactores();
    break;
    case 'verificarProcesos':
        $controlador->verificarProcesos();
    break;
    case 'obtenerTotalCaracteristicas':
        $controlador->obtenerTotalCaracteristicas();
    break;
    case 'guadarRespuestas':
        $controlador->guadarRespuestas();
    break;
    case 'obtenerRespuestas':
        $controlador->obtenerRespuestas();
    break;
    case 'obtenerPorcentaje':
        $controlador->obtenerPorcentaje();
    break;
    case 'consolidacionFinal':
        $controlador->consolidacionFinal();
    break;
    case 'cargarTiposDeRespuesta':
        $controlador->cargarTiposDeRespuesta();
    break;
    case 'cargarRespuestasGrupo':
        $controlador->cargarRespuestasGrupo($_POST['grupo_respuesta']);
    break;
    case 'modificarRespuesta':
        $controlador->modificarRespuesta();
    break;
    case 'eliminarTipoRespuesta':
        $controlador->eliminarTipoRespuesta();
    break;
    case 'guardarArchivosExistentes':
        $controlador->guardarArchivosExistentes();
    break;
    case 'porcentajeProcesos':
        $controlador->porcentajeProcesos();
    break;
    case 'verificarConsolidacion':
        $controlador->verificarConsolidacion();
    break;
    default:

    break;
    
}
?>


    