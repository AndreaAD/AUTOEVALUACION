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
        if($_POST['pregunta'] != "" && $_POST['evidencia'] != "" &&  $_POST['tipoRespuesta'] != ""  && $_POST['opcionesRespuesta']  != "" && $_POST['proceso'] != "" ){
            $arregloGrupo = $_POST['grupoInteres'];
             $guardo = 1;
            if ( count($arregloGrupo) == 1)
                $grupoInteres = $arregloGrupo[0]['value'];
            else
                $grupoInteres = 3; 

            $this->instrumento->grupo =  $grupoInteres;
            $this->instrumento->pregunta = $_POST['pregunta'];
            $this->instrumento->evidencia = $_POST['evidencia'];
            $this->instrumento->tipoRespuesta = $_POST['tipoRespuesta'];
            $this->instrumento->opcionRespuesta = $_POST['opcionesRespuesta'];

            $arregloProceso = $_POST['proceso'];
            for($i =0; $i<count($arregloProceso); $i++){
                $guardo = $this->instrumento->guardar($_POST['suboperacion'] , $arregloProceso[$i]['value'] );
            }
            echo $guardo;   
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
    default:

    break;
}
?>


    