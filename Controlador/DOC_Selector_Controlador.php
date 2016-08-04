<?php
error_reporting(0);
session_start();
include '../Modelo/DOC_Selectores_Modelo.php';

class Select_Controlador {

    /**
     * [__construct description]
     */
    public function __construct(){
        $this->selector = new Selectores_Modelo(); 
    }

    /**
     * [factor obtener los factores]
     * @return [json] [array con los factores]
     */
    public function factor(){
        $factores = $this->selector->factor($_POST['valor']);
        echo json_encode($factores->GetRows());    
    }

    /**
     * [caracteristica obtener las caracteristicas de un factor]
     * @param  [int] $id_factor [id del factor para filtrar caracteristicas]
     * @return [json]            [caracteristicas pertenecientes a un factor]
     */
    public function caracteristica($id_factor){
        $caracteristica = $this->selector->caracteristica($id_factor, $_POST['valor']);
        echo json_encode($caracteristica->GetRows());    
    }

    /**
     * [aspecto obtener los aspectos de una caracteristica]
     * @param  [int] $id_caracteristica [id de la categoria para filtrar aspectos]
     * @return [json]                    [aspectos de un factor]
     */
    public function aspecto($id_caracteristica){
        $aspecto = $this->selector->aspecto($id_caracteristica, $_POST['valor']);
        echo json_encode($aspecto->GetRows());    
    }

    /**
     * [evidencia obtener las evidencias de un aspecto]
     * @param  [int] $id_aspecto [id del aspecto para filtrar evidencias]
     * @return [json]             [evidencias de un aspecto]
     */
    public function evidencia($id_aspecto){
        $evidencia = $this->selector->evidencia($id_aspecto, $_POST['valor']);
        echo json_encode($evidencia->GetRows());    
    }
    
    /**
     * [obtenerFactores obtener factores de un grupo de interes]
     * @return [json] [description]
     */
    public function obtenerFactores(){
        if (count($_POST['grupoInteres']) > 0){
            $arregloGrupo = $_POST['grupoInteres'];
            $guardo = 1;
            if ( count($arregloGrupo) == 1){
                $grupoInteres = $arregloGrupo[0]['value'];
            }else{
                $grupoInteres = 3;
            }
            $factores = $this->selector->obtenerFactores($grupoInteres);
            echo json_encode($factores->GetRows());    
        }else{
            echo 0;
        }
    }
    
    /**
     * [obtenerFactoresUnico obtiene un solo factor]
     * @return [json] [informacion del factor]
     */
    public function obtenerFactoresUnico(){
        $factores = $this->selector->obtenerFactoresUnico();
        echo json_encode($factores->GetRows());    
    }


    /**
     * [obtenerCaracteristicas obtenerCaracteristicas de un grupo de interes]
     * @param  [int] $id_factor [id factor para filtrar caracteristicas]
     * @return [json]            [array caracteristicas]
     */
    public function obtenerCaracteristicas($id_factor){
        if (count($_POST['grupoInteres']) > 0){
            $arregloGrupo = $_POST['grupoInteres'];
            $guardo = 1;
            if ( count($arregloGrupo) == 1){
                $grupoInteres = $arregloGrupo[0]['value'];
            }else{
                $grupoInteres = 3;
            }
            $caracteristicas = $this->selector->obtenerCaracteristicas($id_factor , $grupoInteres);
            echo json_encode($caracteristicas->GetRows());
        }else{
            echo 0;
        }
    }

    /**
     * [obtenerAspecto obtener Aspectos de una caracteristica ]
     * @param  [int] $id_caracteristica [id_caracteristica para filtrar aspectos]
     * @return [json]                    [array aspectos]
     */
    public function obtenerAspecto($id_caracteristica){
        if (count($_POST['grupoInteres']) > 0){
            $arregloGrupo = $_POST['grupoInteres'];
            $guardo = 1;
            if ( count($arregloGrupo) == 1){
                $grupoInteres = $arregloGrupo[0]['value'];
            }else{
                $grupoInteres = 3;
            }
            $aspecto = $this->selector->obtenerAspecto($id_caracteristica , $grupoInteres);
            echo json_encode($aspecto->GetRows());
        }else{
            echo 0;
        }
    }

    /**
     * [obtenerEvidencia obtener evidencias de un aspecto]
     * @param  [int] $id_aspecto [id aspecto para filtrar evidencias]
     * @return [json]             [array evidencias]
     */
    public function obtenerEvidencia($id_aspecto){
        if (count($_POST['grupoInteres']) > 0){
            $arregloGrupo = $_POST['grupoInteres'];
            $guardo = 1;
            if ( count($arregloGrupo) == 1){
                $grupoInteres = $arregloGrupo[0]['value'];
            }else{
                $grupoInteres = 3;
            }
            $evidencia = $this->selector->obtenerEvidencia($id_aspecto, $grupoInteres);
            echo json_encode($evidencia->GetRows());   
        }else{
            echo 0;
        }
    }
    /**
     * [obtenerEvidencia2 obtener evidencias]
     * @return [type] [description]
     */
    public function obtenerEvidencia2(){
        $evidencia = $this->selector->obtenerEvidencia2();
        echo json_encode($evidencia->GetRows());
    }

    /**
     * [obtenerInstrumento obtener instrumentos]
     * @param  [type] $id_evidencia [description]
     * @return [json]               [description]
     */
    public function obtenerInstrumento($id_evidencia){
        $pregunta = $this->selector->obtenerInstrumento($id_evidencia);
        echo json_encode($pregunta->GetRows());
    }

    /**
     * [obtenerTipoRespuesta obtener tipos de respuesta]
     * @return [json] [description]
     */
    public function obtenerTipoRespuesta(){
        $res = $this->selector->obtenerTipoRespuesta();
        echo json_encode($res->GetRows());
    }

    /**
     * [cargarGrupoInteres cargarGrupoInteres]
     * @return [json] [description]
     */
    public function cargarGrupoInteres(){
        $respuesta = $this->selector->cargarGrupoInteres();
        echo json_encode($respuesta->GetRows());
    }

    /**
     * [obtenerOpciones obtenerOpciones de reespuesta preguntas]
     * @return [json] [description]
     */
    public function obtenerOpciones(){
        $respuesta = $this->selector->obtenerOpciones($_POST['id_respuesta']);
        $opciones = array();
        $datos = $respuesta->GetRows();
        $id = -1;

        for($i=0; $i<count($datos); $i++){
            if($datos[$i]['grupo_respuesta'] != $id){
                $id = $datos[$i]['grupo_respuesta'];
                $texto = "";
                for($j=0; $j<count($datos); $j++){
                    if($datos[$j]['grupo_respuesta'] == $id){
                        $texto .= $datos[$j]['texto'].' / ';
                    }
                }
                array_push($opciones, array('id_grupo' => $id, 'opciones' => substr($texto, 0, (strlen($texto) - 3))) );
            }
        }
        echo json_encode($opciones);
    }

    /**
     * [obtenerProcesos obtener procesos actuales]
     * @return [json] [description]
     */
    public function obtenerProcesos(){
        $procesos = $this->selector->obtenerProcesos();
        echo json_encode($procesos->GetRows());
        
    }
    
    /**
     * [cargarDocumentosProceso obtener documentos proceso]
     * @return [json] [description]
     */
    public function cargarDocumentosProceso(){
        $procesos = $this->selector->cargarDocumentosProceso($_POST['proceso'], $_POST['evidencia'], $_POST['_grupo'] );
        $resultados = $procesos->GetRows();
        echo json_encode($resultados);
    }


    
}

$controlador = new Select_Controlador();
$operacion = $_POST['operacion'];

switch ($operacion) {
    case 'obtenerFactores':
        $controlador->obtenerFactores(); //http://http://www.lacorona.com.mx/fortiz/adodb/docs-adodb-es.htm
    break;
    case 'obtenerCaracteristicas':
        $id_factor = $_POST['id_factor'];
        if ($id_factor != "")
        $controlador->obtenerCaracteristicas($id_factor);
    break;
    case 'obtenerAspectos':
        $id_caracteristica = $_POST['id_caracteristica'];
        if ($id_caracteristica != "")
        $controlador->obtenerAspecto($id_caracteristica);
    break;
    case 'obtenerEvidencia':
        $id_aspecto = $_POST['id_aspecto'];
        if ($id_aspecto != "")
        $controlador->obtenerEvidencia($id_aspecto);
    break;
    case 'obtenerInstrumento':
        $id_evidencia = $_POST['id_evidencia'];
        if ($id_evidencia != "")
        $controlador->obtenerInstrumento($id_evidencia);
    break;
    case 'obtenerTipoRespuesta':
        $controlador->obtenerTipoRespuesta();
    break;
    case 'cargarGrupoInteres':
        $controlador->cargarGrupoInteres();
    break;
    case 'obtenerOpciones':
        $controlador->obtenerOpciones();
    break;
    case 'obtenerProcesos':
        $controlador->obtenerProcesos();
    break;
    case 'cargarDocumentosProceso':
        $controlador->cargarDocumentosProceso();
    break;
    case 'obtenerFactoresUnico':
        $controlador->obtenerFactoresUnico();
    break;
    case 'factores':
        $controlador->factor();
    break;
    case 'caracteristica':
        $controlador->caracteristica($_POST['id_factor']);
    break;
    case 'aspecto':
        $controlador->aspecto($_POST['id_caracteristica']);
    break;
    case 'evidencia':
        $controlador->evidencia($_POST['id_aspecto']);
    break;
    case 'porcentajeProcesos':
        $controlador->porcentajeProcesos();
    break;
    default:
    break;
    
}
?>