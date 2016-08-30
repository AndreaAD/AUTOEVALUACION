<?php
error_reporting(0);
session_start();
include '../Modelo/DOC_InstruEval_Modelo.php';

class InstruEval_Controlador {
    private $instrumento;

    /**
     * [__construct description]
     */
    public function __construct(){
        $this->instrumento = new InstruEval_Modelo;
    }

    /**
     * [guardarInstrumento Guarda los nuevos instrumentos de de evaluacion cada uno con su tipo de respuesta y evidencia]
     * @return [int] [Estado que indica que resultado se obtuvo de la operacion]
     */
    public function guardarInstrumento(){
        if($_POST['pregunta'] != "" && $_POST['evidencia'] != "" &&  $_POST['tipoRespuesta'] != ""  && $_POST['opcionesRespuesta']  != "" ){


             $arregloGrupo = $_POST['grupoInteres'];
            //  $guardo = 1;
            // if ( count($arregloGrupo) == 1)
                 $grupoInteres = $arregloGrupo[0]['value'];
            // else
            //     $grupoInteres = 3; 

            $this->instrumento->grupo =  $grupoInteres;
            $this->instrumento->pregunta = $_POST['pregunta'];
            $this->instrumento->factor = $_POST['factor'];
            $this->instrumento->factor_codigo = $_POST['factor_codigo'];
            $this->instrumento->caracteristicas = $_POST['caracteristicas'];
            $this->instrumento->caracteristicas_codigo = $_POST['caracteristicas_codigo'];
            $this->instrumento->aspectos = $_POST['aspectos'];
            $this->instrumento->aspectos_codigo = $_POST['aspectos_codigo'];
            $this->instrumento->evidencia = $_POST['evidencia'];
            $this->instrumento->evidencia_codigo = $_POST['evidencia_codigo'];
            $this->instrumento->tipoRespuesta = $_POST['tipoRespuesta'];
            $this->instrumento->opcionRespuesta = $_POST['opcionesRespuesta'];
            
            $this->instrumento->opc = $_POST['opc'];

            // if($grupoInteres == 8)
            // {
            //     $guardo = $this->instrumento->guardar($_POST['suboperacion'] , 0 );
            // }else if($grupoInteres == 7){
            //     $arregloProceso = $_POST['proceso'];
            //     for($i =0; $i<count($arregloProceso); $i++){
            //         $this->instrumento->guardar($_POST['suboperacion'] , $arregloProceso[$i]['value'] );
            //     }
            // }else if($grupoInteres == 3){
            //     $this->instrumento->guardar($_POST['suboperacion'] , 0 );
            //     $arregloProceso = $_POST['proceso'];
            //     for($i =0; $i<count($arregloProceso); $i++){
            //         $this->instrumento->guardar($_POST['suboperacion'] , $arregloProceso[$i]['value'] );
            //     }
            // }

            $guardo = $this->instrumento->guardar($_POST['suboperacion']);

            echo 1;   
        }else{
            echo 2;
        }  
    }

    /**
     * [eliminarInstrumento Elimina los instrumentos de evaluacion]
     * @return [int] [Estado que indica que resultado se obtuvo de la operacion]
     */
    public function eliminarInstrumento(){
        if($_POST['preguntaEliminar'] != ""){
            $this->instrumento->id = $_POST['preguntaEliminar'];
            echo $this->instrumento->eliminar();
        }else{
            echo 2; 
        } 
    }

    /**
     * [modificarInstrumento Modifica los instrumentos de evaluacion]
     * @return [int] [Estado que indica que resultado se obtuvo de la operacion]
     */
    public function modificarInstrumento(){
        if($_POST['pregunta'] != "" && $_POST['evidencia'] != "" &&  $_POST['tipoRespuesta'] != ""  && count($_POST['grupoInteres']) > 0  && $_POST['opcionesRespuesta']  != "" ){
            $arregloGrupo = $_POST['grupoInteres'];
            $guardo = 1;
            if ( count($arregloGrupo) == 1)
                $grupoInteres = $arregloGrupo[0]['value'];
            else
                $grupoInteres = 3;  

            $this->instrumento->grupo =  $grupoInteres;
            $this->instrumento->id = $_POST['id_pregunta'];
            $this->instrumento->pregunta = $_POST['pregunta'];
            $this->instrumento->evidencia = $_POST['evidencia'];
            $this->instrumento->tipoRespuesta = $_POST['tipoRespuesta'];
             $this->instrumento->opcionRespuesta = $_POST['opcionesRespuesta'];

            $arregloProceso = $_POST['proceso'];
            for($i =0; $i<count($arregloProceso); $i++){
                $guardo = $this->instrumento->modificar($arregloProceso[$i]['value'] );

            }

            echo 1;
        }else{
            echo 2; 
        } 
    }

    /**
     * [cargarInstrumento CArga los instrumentos de evaluacion dependiendo de una evidencia que le enviamos como parametro]
     * @return  [json] array codificado en json con los instrumentos de evaluacin
     */
    public function cargarInstrumento(){
        $evidencia=  $_POST['evidencia'];
        echo json_encode($this->instrumento->cargarinstrumento($evidencia)->GetRows());
    }

    /**
     * [verificarfase Verifica la fase en la que e encuentra un proceso dependiendo de un usuario]
     * @return  [json] array codificado en json con los resultados obtenidos
     */
    public function verificarfase(){
        echo json_encode($this->instrumento->verificarfase($_SESSION['pk_usuario'])->GetRows());
    }

    /**
     * [checkprogramas Carga los checkbox con la lista de los programas que se encuentras en fase de construccion]
     * @return  [json] array codificado en json con los resultados obtenidos
     */
    public function checkprogramas(){
        echo json_encode($this->instrumento->checkprogramas()->GetRows());
    }

    public function checkprogramasConstruccion(){
        echo json_encode($this->instrumento->checkprogramasConstruccion()->GetRows());
    }

    public function CargarInstrumentos(){
        $grupo = $_POST['grupo'];
        echo json_encode($this->instrumento->CargarInstrumentos($grupo)->GetRows());
    }

    public function ListarCna(){
        $cna = array();
        $factores = $this->instrumento->buscarFactores()->GetRows();
        $cna =  $factores;
        foreach ($cna as &$factor) {
            $caracteristicas = $this->instrumento->buscarCaract($factor['pk_factor'])->GetRows();
            $factor['caracteristicas'] = $caracteristicas;

            foreach ($factor['caracteristicas'] as &$caracteristica) 
            {
                //$factor['caracteristicas'][] = $caracteristica;
                $factor['lista_caracteristicas'][] = $caracteristica['pk_caracteristica'];
                $factor['lista_caracteristicas_codigos'][] = $caracteristica['codigo'];
                $aspectos = $this->instrumento->buscarAspecto($caracteristica['pk_caracteristica'])->GetRows();

                $caracteristica['aspectos'] = $aspectos;
                foreach ($caracteristica['aspectos'] as &$aspecto) {
                    $caracteristica['lista_aspectos'][] = $aspecto['pk_aspecto'];
                    $evidencias = $this->instrumento->buscarEVidencia($aspecto['pk_aspecto'])->GetRows();
                    $aspecto['evidencias'] = $evidencias;
                    foreach ($aspecto['evidencias'] as &$evidencia) {
                        $aspecto['lista_evidencias'][] = $evidencia['pk_evidencia'];
                    }
                }
            }

        }
       
        echo json_encode($cna);
        //echo json_encode($this->instrumento->ListarCna()->GetRows());
    }

    public function GuardarInstrumentoCaracteristica(){


        if($_POST['operacion'] != "" && $_POST['grupo_interes'] != "" &&  $_POST['instrumento'] != ""  && $_POST['tipo_respuesta']  != ""  && $_POST['ids'] != "" ){
            
            
            $arregloGrupo = $_POST['grupo_interes'];
            // $guardo = 1;
            // $grupo_interes = '';
            // if( count($arregloGrupo) == 1){
                $grupoInteres = $arregloGrupo[0]['value'];
            // }else{
            //     $grupoInteres = 3;
            // }

            $this->instrumento->grupo =  $grupoInteres;
            $this->instrumento->opc =  $_POST['opc'];
            $this->instrumento->pregunta = $_POST['instrumento'];
            $this->instrumento->tipoRespuesta = $_POST['tipo_respuesta'];
            $this->instrumento->opcionRespuesta = $_POST['opciones_respuesta'];
            $this->instrumento->porcentaje = $_POST['porcentaje'] ? $_POST['porcentaje'] : 0 ;


            $array = json_decode($_POST['ids']);

            // if($grupoInteres == 8)
            // {
                $this->instrumento->factor =  '';
                $this->instrumento->factor_codigo =  '';
                $this->instrumento->caracteristicas = '';
                $this->instrumento->caracteristicas_codigo = '';
                foreach( $array  as $r){
                    $this->instrumento->factor .=  $r->factor.'|';
                    $this->instrumento->factor_codigo .=  $r->factor_codigo.'|';
                    $this->instrumento->caracteristicas .=  $r->caracteristica.'|';
                    $this->instrumento->caracteristicas_codigo .=  $r->caracteristica_codigo.'|';
                    
                }
                $this->instrumento->guardarInstruCarac();

            // }else if($grupoInteres == 7){
            //     $procesos = $_POST['procesos'];
            //     foreach ($procesos as &$value) {
            //         $this->instrumento->factor =  '';
            //         $this->instrumento->factor_codigo =  '';
            //         $this->instrumento->caracteristicas = '';
            //         $this->instrumento->caracteristicas_codigo = '';
            //         foreach( $array  as $r){
            //             $this->instrumento->factor .=  $r->factor.'|';
            //             $this->instrumento->factor_codigo .=  $r->factor_codigo.'|';
            //             $this->instrumento->caracteristicas .=  $r->caracteristica.'|';
            //             $this->instrumento->caracteristicas_codigo .=  $r->caracteristica_codigo.'|';
                        
            //         }
            //         $this->instrumento->proceso =  $value['value'];
            //         $this->instrumento->guardarInstruCarac();  
            //     }
            // }else if($grupoInteres == 3){
            //     $procesos = $_POST['procesos'];
            //     foreach ($procesos as &$value) {
            //         $this->instrumento->factor =  '';
            //         $this->instrumento->factor_codigo =  '';
            //         $this->instrumento->caracteristicas = '';
            //         $this->instrumento->caracteristicas_codigo = '';
            //         foreach( $array  as $r){
            //             $this->instrumento->factor .=  $r->factor.'|';
            //             $this->instrumento->factor_codigo .=  $r->factor_codigo.'|';
            //             $this->instrumento->caracteristicas .=  $r->caracteristica.'|';
            //             $this->instrumento->caracteristicas_codigo .=  $r->caracteristica_codigo.'|';
            //             $this->instrumento->proceso =  $value['value'];
                        
            //         }
            //         $this->instrumento->guardarInstruCarac(); 
            //     }
            //     $this->instrumento->proceso =  0;
            //     $this->instrumento->guardarInstruCarac();  

            // }        

            echo 1;
        }else{
             echo 2;
         }
    }

}

$controlador = new InstruEval_Controlador;
$_operacion = $_POST['operacion'];



/*echo $_SESSION['pk_usuario'].'-';
echo $_SESSION['nombre_usuario'].'-';
echo $_SESSION['apellido_usuario'].'-';
echo $_SESSION['nombre_rol'].'-';
echo $_SESSION['pk_proceso'];*/


switch ($_operacion) {
    case 'crearInstrumento':
        $controlador->guardarInstrumento();
    break;
    case 'eliminarInstrumento':        
        $controlador->eliminarInstrumento();
    break;
    case 'modificarInstrumento':
        $controlador->modificarInstrumento();
    break;
    case 'cargarInstrumento':
        $controlador->cargarInstrumento();
    break;
    case 'cargarGrupoInteres':
        $controlador->cargarGrupoInteres();
    break;
    case 'verificarfase':
        $controlador->verificarfase();
    break;
    case 'checkprogramas':
        $controlador->checkprogramas();
    break;
    case 'checkprogramasConstruccion':
        $controlador->checkprogramasConstruccion();
    break;
    case 'ListarCna':
        $controlador->ListarCna();
    break;
    case 'GuardarInstrumentoCaracteristica':
        $controlador->GuardarInstrumentoCaracteristica();
    break;    
    case 'CargarInstrumentos':
        $controlador->CargarInstrumentos();
    break;
    default:

    break;
}
?>


    