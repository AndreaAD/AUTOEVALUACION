<?php

session_start();
// obtenemos la opcion es decir un identificador para saber que es lo que debe procesar y devolver 
// la pagina
$opcion = $_REQUEST["opcion"];
// segun la opcion comenzamos
switch ($opcion) {
    case "base":
        // obtenenmos el grupo de interes que seleccionaron
        $idGrupoInteres = $_REQUEST["idgrupo"];
        //guardamos en una variable de sesion el grupo de interes
        $_SESSION["enc_pkGrupoInteres"] = $idGrupoInteres;
        // incluimos los modelos necesarios
        require_once("../Modelo/ENC_procesos_modelo.php");
        require_once("../Modelo/CNA_Grupo_Interes_Modelo.php");
        require_once("../Modelo/ENC_sedes_modelo.php");
        require_once("../Modelo/ENC_programas_modelo.php");
        require_once("../Modelo/ENC_encuesta_modelo.php");
        require_once("../Modelo/ENC_cargoDirectivo_modelo.php");
        require_once("../Modelo/ENC_alcanceAdministrativos_modelo.php");

        $objSedes = new Sedes();
        $objEncuestas = new Encuesta();
        $objGrupoInteres = new Grupo_Interes();

        $rs_subgrupo_interes = $objGrupoInteres->getAllSubgrupo_interes($idGrupoInteres);
        // solicitamos los datos basicos de la encuesta segun el grupo de interes
        // es decir titulo, descripcion e intrucciones
        $rsDatosEncuesta = $objEncuestas->getDatosEncuesta($idGrupoInteres);
        // solicitamos todas las sedes
        $rsDatosSedes = $objSedes->getAllSedes();
        // objeto para controlar los cargos de directivos
        $objCargosDiretivos = new CargosDirectivos();
        // solicitamos todos los cargos de directivos
        $rsCargos = $objCargosDiretivos->getAllCargosDirectivos();
        // si el grupo de interes es 5
        if ($idGrupoInteres == 5) {
            // objeto de alcance de administrativos
            $objAlcandeAdmin = new AlcanceAdministrativos();
            // obtenemos la lista de alcance de los administrativos
            $rsAlcanceAdmin = $objAlcandeAdmin->getAllalcances();
        }
        break;
    case "programa":
        $idSede = $_REQUEST["idSede"];
        require_once("../Modelo/ENC_programas_modelo.php");
        $objProgramas = new Programas();
        $rsDatosProgramas = $objProgramas->getProgramasSede($idSede);
        break;
    case "programasFacultad":
        $idSede = $_REQUEST["idSede"];
        require_once("../Modelo/ENC_programas_modelo.php");
        $objProgramas = new Programas();
        $datosProgramasFacultades = $objProgramas->getProgramasFacultadSede($idSede);
        break;
    case "listaPrcocesos":
        $idSede = $_REQUEST["idSede"];
        require_once("../Modelo/ENC_programas_modelo.php");
        $objProgramas = new Programas();
        $datosProgramas = $objProgramas->getProgramasProcesoSede($idSede);
        break;
    case "preguntas":
        $idGrupoInteres = $_SESSION["enc_pkGrupoInteres"];
        require_once("../Modelo/ENC_procesos_modelo.php");
        require_once("../Modelo/ENC_encuesta_modelo.php");
        require_once("../Modelo/ENC_preguntas_modelo.php");
        require_once("../Modelo/ENC_respuestas_modelo.php");
        $objProcesos = new Procesos();
        $objEncuestas = new Encuesta();
        $objPreguntas = new Preguntas();
        $objRespuestas = new Respuestas();
        $idCargo = $_REQUEST["cargo"];
        $sede = $_REQUEST["sede"];
        $programa = $_REQUEST["programa"];
        $facultad = $_REQUEST["facultad"];
        if ($idCargo == '') {
            if ($programa != '') {
                $idCargo = 3;
            }
            if ($sede != '') {
                $idCargo = 4;
            }
        }
        switch ($idCargo) {
            case 1://traer todas las encuestas de la universidad
                $encuestas_activas = $objEncuestas->get_Encuestas_Activas($idGrupoInteres);
                break;
            case 2://traer todas las encuestas de la facultad
                $encuestas_activas = $objEncuestas->get_Encuestas_Activas($idGrupoInteres, null, $facultad);
                break;
            case 3://traer todas las encuestas del programa
                $encuestas_activas = $objEncuestas->get_Encuestas_Activas($idGrupoInteres, $programa);
                break;
            case 4:////traer todas las encuestas de la sede
                $encuestas_activas = $objEncuestas->get_Encuestas_Activas($idGrupoInteres, null, null, $sede);

                break;
        }
        $grupo_encuestas = '';
        foreach ($encuestas_activas as $key => $value) {
            if ($key == 0) {
                $grupo_encuestas.=$value['pk_encuesta'];
            } else {
                $grupo_encuestas.=',' . $value['pk_encuesta'];
            }
            $preguntas_encuesta[$value['pk_encuesta']] = $objEncuestas->get_Preguntas_Encuestas($value['pk_encuesta']);
            foreach ($preguntas_encuesta[$value['pk_encuesta']] as $key2 => $value2) {
                $respuestas_encuesta[$value['pk_encuesta']][$value2['pk_pregunta']] = $objEncuestas->get_Respuestas_Preguntas($value2['pk_pregunta']);
            }
        }
        $grupo_preguntas = $objEncuestas->get_Preguntas_GrupoInteres($idGrupoInteres,$grupo_encuestas);
        foreach ($grupo_preguntas as $key => $value) {
            $respuestas[$value['pk_pregunta']] = $objEncuestas->get_Respuestas_Preguntas($value['pk_pregunta']);
        }
}
require_once("../Vista/elementos_vista.php");
$objComp = new Elementos();
require_once("../Vista/ENC_ventanaEncuesta_vista.php");
?>