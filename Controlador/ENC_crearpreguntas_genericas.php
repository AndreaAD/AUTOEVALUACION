<?php
session_start();
// verificamos que exista la variable de sesion con la evidencia y el proceso 
// si no existen se devueleve a seleccion de evidencia

if (isset($_SESSION["pk_proceso"])) {
    // Extraer el pk de proceso y la evidencia que se selecciono de las variables de sesion
    $idProceso = $_SESSION["pk_proceso"];

    // verificamos que el id del proceso y la evidencia no sea nulo
    if ($idProceso != null) {
        // incluimos los modelos

        require_once("../Modelo/ENC_preguntas_modelo.php");

        require_once("../Modelo/ENC_tipoRespuesta_modelo.php");
        require_once("../Modelo/ENC_respuestas_modelo.php");

        require_once("../Modelo/ENC_gruposInteres_modelo.php");

        $tipo_proceso = $_GET['tipo'];
        switch ($tipo_proceso) {
            case 1:
                require_once("../Modelo/ENC_caracteristicas_modelo.php");
                $objCaracteristica = new Caracteristicas();
                $listado = $objCaracteristica->getCaracteristicasAll();
                $nombre_proceso = 'Caracteristica';
                $encabezado = array('Seleccionar', 'Codigo', 'Nombre', 'Descripción', 'Factor');
                break;
            case 2:
                require_once("../Modelo/ENC_aspectos_modelo.php");
                $objAspectos = new Aspectos();
                $listado = $objAspectos->getAspectosAll();
                $nombre_proceso = 'Aspecto';
                $encabezado = array('Seleccionar', 'Codigo', 'Nombre', 'Factor', 'Caracteristica');
                break;
        }
        
        $encabezado_preguntas = array('Seleccionar', 'Pregunta');
        $objTipoRes = new TiposRespuesta();
        $rsCantidadRes = $objTipoRes->getCantidadRespuestas();

        $objRespuestas = new Respuestas();

        $objGruposInteres = new GruposInteres();
        $rsDatosGrupos = $objGruposInteres->getGruposEncuestas();
        
        $objPreguntas = new Preguntas();
        $banco_preguntas = $objPreguntas->get_preguntas();

        $faseProceso = $_SESSION['pk_fase'];
        require_once("../Vista/ENC_crearpreguntas_genericas_vista.php");
    } else {
        ?><script type="text/javascript"> window.location = '../Controlador/VIS_Index_Controlador.php';</script><?php
    }
} else {
    ?><script type="text/javascript"> window.location = '../Controlador/VIS_Index_Controlador.php';</script><?php
}
?>