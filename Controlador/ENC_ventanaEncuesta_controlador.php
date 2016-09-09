<?php session_start();
// obtenemos la opcion es decir un identificador para saber que es lo que debe procesar y devolver 
// la pagina
$opcion=$_REQUEST["opcion"];
// segun la opcion comenzamos
switch($opcion){
    case "base":
        // obtenenmos el grupo de interes que seleccionaron
        $idGrupoInteres=$_REQUEST["idgrupo"];
        //guardamos en una variable de sesion el grupo de interes
        $_SESSION["enc_pkGrupoInteres"]=$idGrupoInteres;
        // incluimos los modelos necesarios
        require_once("../Modelo/ENC_procesos_modelo.php");
        require_once("../Modelo/ENC_sedes_modelo.php");
        require_once("../Modelo/ENC_programas_modelo.php");
        require_once("../Modelo/ENC_encuesta_modelo.php");
        require_once("../Modelo/ENC_cargoDirectivo_modelo.php");
        require_once("../Modelo/ENC_alcanceAdministrativos_modelo.php");
        // objeto para controlar las sedes
        $objSedes = new Sedes();
        // objeto para controlar las encuestas
        $objEncuestas = new Encuesta();
        // solicitamos los datos basicos de la encuesta segun el grupo de interes
        // es decir titulo, descripcion e intrucciones
        $rsDatosEncuesta=$objEncuestas->getDatosEncuesta($idGrupoInteres);
        // solicitamos todas las sedes
        $rsDatosSedes=$objSedes->getAllSedes();
        // objeto para controlar los cargos de directivos
        $objCargosDiretivos=new CargosDirectivos();
        // solicitamos todos los cargos de directivos
        $rsCargos=$objCargosDiretivos->getAllCargosDirectivos();
        // si el grupo de interes es 5
        if($idGrupoInteres==5){
            // objeto de alcance de administrativos
            $objAlcandeAdmin=new AlcanceAdministrativos();
            // obtenemos la lista de alcance de los administrativos
            $rsAlcanceAdmin=$objAlcandeAdmin->getAllalcances();
        }
        break;
    case "programa":
        $idSede=$_REQUEST["idSede"];
        require_once("../Modelo/ENC_programas_modelo.php");
        $objProgramas=new Programas();
        $rsDatosProgramas=$objProgramas->getProgramasSede($idSede);
        break;
    case "programasFacultad":
        $idSede=$_REQUEST["idSede"];
        require_once("../Modelo/ENC_programas_modelo.php");
        $objProgramas=new Programas();
        $datosProgramasFacultades=$objProgramas->getProgramasFacultadSede($idSede);
        break;
    case "listaPrcocesos":
        $idSede=$_REQUEST["idSede"];
        require_once("../Modelo/ENC_programas_modelo.php");
        $objProgramas=new Programas();
        $datosProgramas=$objProgramas->getProgramasProcesoSede($idSede);
        break;
    case "preguntas":
        $idGrupoInteres=$_SESSION["enc_pkGrupoInteres"];
        require_once("../Modelo/ENC_procesos_modelo.php");
        require_once("../Modelo/ENC_encuesta_modelo.php");
        require_once("../Modelo/ENC_preguntas_modelo.php");
        require_once("../Modelo/ENC_respuestas_modelo.php");
        $objProcesos=new Procesos();
        $objEncuestas=new Encuesta();
        $objPreguntas=new Preguntas();
        $objRespuestas=new Respuestas();
        //================ Estudiantes, Profesores, Graduados ==============================================//
        if($idGrupoInteres==1 || $idGrupoInteres==2 || $idGrupoInteres==4){
            $idPrograma=$_REQUEST["programa"];
            $idSede=$_REQUEST["sede"];
            $idProceso=$objProcesos->existeProceso($idPrograma,$idSede);
            $idEncuesta=$objEncuestas->existeEncuesta($idProceso,$idGrupoInteres);
            $rsDatosPreguntas=$objPreguntas->getPreguntasEncuestaGeneral($idProceso,$idGrupoInteres,$idEncuesta);
        }
        //================ Funcionarios Administrativos ==============================================//
        if($idGrupoInteres==5){
            $alcanceAdministrativo=$_REQUEST["alcance"];
            $idSede=$_REQUEST["sede"];
            $idProceso=0;
            $idEncuesta=$objEncuestas->existeEncuestaInstitucional($idGrupoInteres);
            $rsDatosPreguntas=$objPreguntas->getPreguntasEncuestaInsitucional($idGrupoInteres,$idEncuesta);
        }
        //================ Directivos Academicos ==============================================//
        if($idGrupoInteres==3){
            $idSede=$_REQUEST["sede"];
            $idCargo=$_REQUEST["cargo"];
            $idProgramaFacultad=$_REQUEST["programaFacultad"];
            $tipo=$_REQUEST['tipo'];
            $idProceso=0;
            $idEncuesta=$objEncuestas->existeEncuestaInstitucional($idGrupoInteres);
            $rsDatosPreguntas=$objPreguntas->getPreguntasEncuestaInsitucional($idGrupoInteres,$idEncuesta);
          }
        //=============== Empleadores y demas =================================================//
        if($idGrupoInteres==6){
            $idSede=$_REQUEST["sede"];
            $programas=$_REQUEST["programas"];
            $idProceso=0;
            //$rsProgramas=$objProcesos->getDatosProgramasSede($idSede);
            $idEncuesta=$objEncuestas->existeEncuestaInstitucional($idGrupoInteres);
            $rsDatosPreguntas=$objPreguntas->getPreguntasEncuestaInsitucional($idGrupoInteres,$idEncuesta);
        }
        break;
}
require_once("../Vista/elementos_vista.php");
$objComp=new Elementos();
require_once("../Vista/ENC_ventanaEncuesta_vista.php");?>