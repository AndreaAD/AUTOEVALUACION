
<?php
error_reporting(0);
session_start();
include '../Modelo/PLM_Plan_Modelo.php';

class Planes_Controlador {

    public function __construct(){
        $this->planes = new Plan;
    }

    public function guardar_objetivo(){

        $resultados = $this->planes->guardar_objetivo($_POST['proceso'],$_POST['nombre'], $_POST['factor'], $_POST['fecha_inicio'], $_POST['fecha_fin'], $_POST['peso'], $_POST['indicador'], $_POST['responsable'], $_POST['cargo'], $_POST['meta'], $_POST['descripcion'], $_POST['recursos'], $_POST['evidencias']);
        echo json_encode($resultados);

    }

    public function consultar_plan(){
        $resultados = $this->planes->consultar_plan($_POST['proceso'], $_POST['factor']);
        echo json_encode($resultados);
    }

    public function cargar_tabla_plan(){
        $resultados = $this->planes->cargar_tabla_plan($_POST['proceso']);
        echo json_encode($resultados);
    }

    public function lista_programas(){
        $resultados = $this->planes->lista_programas($_POST['sede'],$_POST['facultad'])->GetRows();
        echo json_encode($resultados);
    }    

    public function historico_plm(){
        $resultados = $this->planes->historico_plm($_POST['sede'],$_POST['facultad'],$_POST['programa']);
        echo json_encode($resultados);
    }

}

$controlador = new Planes_Controlador;
$_operacion = $_POST['operacion'];

switch ($_operacion) {
    case 'guardar_objetivo':
        $controlador->guardar_objetivo();
    break;
    case 'consultar_plan':
        $controlador->consultar_plan();
    break;    
    case 'cargar_tabla_plan':
        $controlador->cargar_tabla_plan();
    break;
    case 'lista_programas':
        $controlador->lista_programas();
    break;    
    case 'historico_plm':
        $controlador->historico_plm();
    break;
    default:

    break;
    
}
?>


    