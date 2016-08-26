<?php
error_reporting(0);
session_start();
include_once 'SAD_Seguridad_Modelo.php';
include_once '../BaseDatos/AdoDB.php';

class Autoevaluacion_Modelo {

	public $id;
	public $seg;

	/**
	 * [__construct description]
	 */
	public function __construct(){

		$this->adoDB = new Ado();
		$this->seg = new Seguridad();
	}
	/**
	 * [cargarFactores carga los factores]
	 * @return como resultado nos devuele la lista de los factores
	 */
	public function cargarFactores(){
		$sql = 'SELECT * FROM cna_factor';
		$factores = $this->runSQL($sql);
		return $factores;
	}


	/**
	 * [cargarFactores carga los factores]
	 * @return como resultado nos devuele la lista de los factores
	 */
	public function cargarInformacionBasicaFactor($id){
		$sql = 'SELECT * FROM cna_factor WHERE pk_factor ="'.$id.'"';
		$resultados = $this->runSQL($sql);
		return $resultados;
	}

	/**
	 * [cargarInformacionCaracteristicas carga las caracteristicas ]
	 * @return como resultado nos devuele la lista de las caracterissticas
	 */
	public function cargarInformacionCaracteristicas($id, $pagina, $items){
		$sql = 'SELECT pk_caracteristica, nombre AS caracteristica_nombre, codigo as caracteristica_codigo FROM cna_caracteristica WHERE fk_factor = "'.$id.'" LIMIT '.($pagina * $items).', '.$items;
		$resultados = $this->runSQL($sql);
		return $resultados;
	}

	/**
	 * [cargarInformacionPreguntas carga la informacion de cada instruento de evaluacion]
	 * @param  [int] $id
	 * @param  [int] $grupo
	 * @param  [int] $proceso
	 * @return [int] devuelve el estado de la operacion si se realiazo o no
	 */
	public function cargarInformacionPreguntas($id , $grupo , $proceso){
		$SQL1 = 'SELECT pk_grupo_interes FROM cna_grupo_interes WHERE nombre = "'.$grupo.'" ';
		$resultados = $this->runSQL($SQL1);
		$nom = $resultados->GetRows();
		$s = $nom[0]['pk_grupo_interes'];
		if($proceso == 0){
			$sql = 'SELECT DISTINCT ca.`nombre` AS aspecto_nombre, ce.`codigo` AS codigo , tp.`pk_tipo_respuesta` AS tipo_respuesta, di.`pk_instru_evaluacion` AS pk_instru_evaluacion , di.`descripcion` AS pregunta , di.`porcentaje` AS porcentaje FROM cna_aspecto ca , doc_instru_evaluacion di, tipo_respuesta tp, cna_evidencia ce, cna_caracteristica cc WHERE di.`fk_evidencia` = ce.`pk_evidencia` AND di.`fk_tipo_respuesta` = tp.`pk_tipo_respuesta` AND ce.`fk_aspecto` = ca.`pk_aspecto` AND ca.`fk_caracteristica` = "'.$id.'" AND (di.`fk_grupo_interes` ="'.$s.'" OR di.`fk_grupo_interes` = 3) and  di.`fk_evidencia` = ce.`pk_evidencia` ';
		}else{
			$sql = 'SELECT DISTINCT ca.`nombre` AS aspecto_nombre, ce.`codigo` AS codigo , tp.`pk_tipo_respuesta` AS tipo_respuesta, di.`pk_instru_evaluacion` AS pk_instru_evaluacion , di.`descripcion` AS pregunta , di.`porcentaje` AS porcentaje FROM cna_aspecto ca , doc_instru_evaluacion di, tipo_respuesta tp, cna_evidencia ce, cna_caracteristica cc WHERE di.`fk_evidencia` = ce.`pk_evidencia` AND di.`fk_tipo_respuesta` = tp.`pk_tipo_respuesta` AND ce.`fk_aspecto` = ca.`pk_aspecto` AND ca.`fk_caracteristica` = "'.$id.'" AND (di.`fk_grupo_interes` ="'.$s.'" OR di.`fk_grupo_interes` = 3) and  di.`fk_evidencia` = ce.`pk_evidencia` AND di.`proceso` = "'.$proceso.'"';
		}	
		//return $sql;
		return $this->runSQL($sql);
	}

	public function cargarInformacionPreguntas_2( $grupo , $proceso, $pagina, $items){
		//echo $grupo;
		//echo $proceso;
		 $SQL1 = 'SELECT pk_grupo_interes FROM cna_grupo_interes WHERE nombre = "'.$grupo.'" ';
		 $resultados = $this->runSQL($SQL1);
		 $nom = $resultados->GetRows();
		 $s = $nom[0]['pk_grupo_interes'];

		if($proceso == 0){
			$sql = 'SELECT di.`fk_tipo_respuesta` AS tipo_respuesta, di.`pk_instru_evaluacion` AS pk_instru_evaluacion , di.`descripcion` AS pregunta , di.`porcentaje` AS porcentaje , di.`fk_factor`, di.`fk_caracteristicas`, di.`fk_evidencia`, di.`fk_grupo_interes` 
FROM doc_instru_evaluacion di
WHERE (di.`fk_grupo_interes` = 8 OR di.`fk_grupo_interes` = 3) AND di.`proceso` = 0 LIMIT '.($pagina * $items).', '.$items;
		}else{
			$sql = 'SELECT di.`fk_tipo_respuesta` AS tipo_respuesta, di.`pk_instru_evaluacion` AS pk_instru_evaluacion , di.`descripcion` AS pregunta , di.`porcentaje` AS porcentaje , di.`fk_factor`, di.`fk_caracteristicas`, di.`fk_evidencia`, di.`fk_grupo_interes` 
FROM doc_instru_evaluacion di
WHERE (di.`fk_grupo_interes` = '.$s.' OR di.`fk_grupo_interes` = 3 ) AND di.`proceso` = '.$proceso.' LIMIT '.($pagina * $items).', '.$items;
		}	
		
		//return $sql;
		return $this->runSQL($sql);
	}

	/**
	 * [cargarInformacionRespuestas carga la repuesta para cada instrumento de evaluacion]
	 * @param  [int] $id
	 * @return [int] devuelve el estado de la operacion 1 -0
	 */
	public function cargarInformacionRespuestas($id){
		$sql1 = 'SELECT porcentaje FROM doc_instru_evaluacion WHERE pk_instru_evaluacion = "'.$id.'" ';
		$porcentaje = $this->runSQL($sql1);
		$por = $porcentaje->GetRows();
		if($por[0]['porcentaje'] == 0){
			$sql = 'SELECT drp.`pk_respuestas_pregunta` AS pk_respuestas_pregunta, drp.`texto` AS texto, r.`pk_respuesta_ponderacion` AS pk_respuesta, r.`ponderacion` AS ponderacion FROM respuesta_ponderacion r, doc_respuesta_pregunta drp, doc_instru_evaluacion di WHERE di.`pk_instru_evaluacion` = "'.$id.'" AND di.`fk_grupo_respuesta` = drp.`grupo_respuesta` AND drp.`fk_respuesta_ponderacion` = r.`pk_respuesta_ponderacion`';
			return $this->runSQL($sql);
		}else{
			$sql = 'SELECT fk_tipo_respuesta FROM doc_instru_evaluacion WHERE pk_instru_evaluacion = "'.$id.'"';
			return $this->runSQL($sql);
		}
	}

	/**
	 * [cargarInformacionAdicionaldoc carga la infromacion adicional para cada instrumento de evaluacion]
	 * @return [int] devuelve el estado de la operacion 1 -0
	 */
	public function cargarInformacionAdicionaldoc($id , $usuario ,$fk_proceso){
		$sql0 = 'SELECT fk_programa FROM sad_usuario WHERE pk_usuario = "'.$usuario.'" ';
		$programa = $this->runSQL($sql0);
		$pro = $programa->GetRows();
		
		if ($fk_proceso == 0){
			$sql = 'SELECT * FROM doc_documento  WHERE fk_instrueval  = "'.$id.'" AND fk_programa = "0" AND fk_proceso = "'.$fk_proceso.'" AND tipo ="1" and estado = 1' ;
			return $this->runSQL($sql);
		}else{
			$sql1 = ' SELECT fk_sede FROM cna_proceso WHERE pk_proceso = "'.$fk_proceso.'" ';
			$resultados = $this->runSQL($sql1);
			$sede = $resultados->GetRows();
			$s = $sede[0]['fk_sede'];

			$sql = 'SELECT * FROM doc_documento  WHERE fk_instrueval  = "'.$id.'" AND fk_programa = "'.$pro[0]['fk_programa'].'" AND fk_sede = "'.$s.'" AND fk_proceso = "'.$fk_proceso.'" AND tipo="1" and estado = 1';
			return $this->runSQL($sql);
		}
	}

	/**
	 * [cargarInformacionAdicional carga la infromacion adicional para cada instrumento de evaluacion]
	 * @return [int] devuelve el estado de la operacion 1 -0
	 */
	public function cargarInformacionAdicional($id){
		$sql = 'SELECT * FROM  doc_informacion_adicional WHERE fk_instrueval = "'.$id.'"';
		return $this->runSQL($sql);
	}

	/**
	 * [cargarDocumentos carga los documentos para cada instrumento de evaluacion]
	 * @return [int] devuelve el estado de la operacion 1 -0
	 */
	public function cargarDocumentos($id , $usuario ,$fk_proceso ){
		$sql0 = 'SELECT fk_programa FROM cna_proceso WHERE pk_proceso = "'.$fk_proceso.'" ';
		$programa = $this->runSQL($sql0);
		$pro = $programa->GetRows();
		
		if ($fk_proceso == 0){
			$sql = 'SELECT * FROM doc_documento  WHERE fk_instrueval  = "'.$id.'" AND fk_programa = "0" AND fk_proceso = "'.$fk_proceso.'" AND tipo = "2"  and estado = 1 ';
			return $this->runSQL($sql);
		}else{
			$sql1 = ' SELECT fk_sede FROM cna_proceso WHERE pk_proceso = "'.$fk_proceso.'" ';
			$resultados = $this->runSQL($sql1);
			$sede = $resultados->GetRows();
			$s = $sede[0]['fk_sede'];

			$sql = 'SELECT * FROM doc_documento  WHERE fk_instrueval  = "'.$id.'" AND fk_programa = "'.$pro[0]['fk_programa'].'" AND fk_sede = "'.$s.'" AND fk_proceso = "'.$fk_proceso.'" AND tipo = "2" and estado = 1 ';
			return $this->runSQL($sql);
		}
	}

	/**
	 * [cargarInformacionFactor carga la infromacion de cada factor]
	 * @return [int] devuelve el estado de la operacion 1 -0
	 */
	public function cargarInformacionFactor($id){
		$sql = 'SELECT * FROM cna_factor WHERE pk_factor ="'.$id.'"';
		$resultados = $this->runSQL($sql);
		return $resultados;
	}

	/**
	 * [verificarProceso Veridica el proceso si se encuentra en fase 4]
	 * @return [int] devuelve el estado de la operacion 1 -0
	 */
	public function verificarProceso($id_usuario){
		 $sql = 'SELECT cp.* FROM cna_proceso cp WHERE cp.`fk_fase` = 4 AND cp.pk_proceso = "'.$_SESSION['pk_proceso'].'" AND cp.pk_proceso ';
		 //$sql = 'SELECT cp.* FROM cna_proceso cp, sad_proceso_usuario spu  WHERE /*spu.`fk_usuario` = "'.$id_usuario.'"*/ cp.`pk_proceso` = spu.`fk_proceso` AND cp.`fk_fase` = 4 AND cp.pk_proceso = "'.$_SESSION['pk_proceso'].'" and cp.pk_proceso NOT IN( SELECT fk_proceso FROM cna_resultados_evidencia WHERE fk_proceso = "'.$_SESSION['pk_proceso'].'" GROUP BY fk_proceso)';
		 $resultados = $this->runSQL($sql);
		 return $resultados;
	}

	/**
	 * [totalCaracteristicas obtener el total de caracteristicas por factor]
	 * @return [int] devuelve el estado de la operacion 1 -0
	 */
	public function totalCaracteristicas($id_factor){
		$sql = 'SELECT COUNT(*) as total FROM cna_caracteristica WHERE fk_factor  = "'.$id_factor.'" ';
		$resultados = $this->runSQL($sql);
		return $resultados;
	}

	/**
	 * [cargarRespuestasGrupo carga los tipos de repuesta dependiendo del grupo que seleccione]
	 * @return [int] devuelve el estado de la operacion 1 -0
	 */
	public function cargarRespuestasGrupo($grupo_respuesta){
		$sql = 'SELECT * FROM doc_respuesta_pregunta WHERE grupo_respuesta = "'.$grupo_respuesta.'"';
		$resultados = $this->runSQL($sql);
		return $resultados;
	}

	/**
	 * [guardarRespuesta Guarda las respuestas de un instrumento de evaluacion]
	 * @return [int] devuelve el estado de la operacion 1 -0
	 */
	public function guardarRespuesta($id_pregunta, $id_respuesta, $ponderacion, $observaciones , $pk_usuario, $fk_proceso, $tipo){
		$sql5 = 'SELECT * FROM doc_documento WHERE fk_instrueval = "'.$id_pregunta.'" ';
		$resultados = $this->runSQL($sql5);
		$res = $resultados->GetRows();
		if ($id_respuesta == 10006 ){
			$operacion = (($ponderacion/100)*4)+1;
			$ponderacion = number_format($operacion, 2);
		}
		if ($id_respuesta == 10007 ){
			$sql7 = 'SELECT porcentaje from doc_instru_evaluacion where pk_instru_evaluacion = "'.$id_pregunta.'" ';
			$resultados = $this->runSQL($sql7);
			$res2 = $resultados->GetRows();
			$operacion =  (($ponderacion/$res2[0]['porcentaje'])*4)+1;
			$ponderacion = number_format($operacion, 2);
		}

		if ( count($res) > 0 ){
			$sql1 = ' SELECT fk_programa , fk_sede FROM cna_proceso WHERE pk_proceso = "'.$fk_proceso.'" ';
			$resultados = $this->runSQL($sql1);
			$sede = $resultados->GetRows();
			$s = $sede[0]['fk_sede'];
			$p = $sede[0]['fk_programa'];
			$id_evidencia = $this->obtenerIdEvidencia($id_pregunta);
			$id_grupo_interes = $this->obtenerIdGrupoInteres($id_pregunta);
			$sql_0 = 'SELECT COUNT(*) as total, pk_respuesta_instrumento FROM doc_respuesta_instrumentos WHERE fk_instrumento = "'.$id_pregunta.'" AND fk_evidencia = "'.$id_evidencia.'" AND fk_grupo_interes = "'.$id_grupo_interes.'" AND fk_proceso = "'.$fk_proceso.'"';
			$res = $this->runSql($sql_0);
			$instrumento_existente = $res->GetRows();

			if($instrumento_existente[0]['total'] > 0){
				$pk_respuesta_instrumento = $instrumento_existente[0]['pk_respuesta_instrumento'];
				$sql_1 = 'UPDATE doc_respuesta_instrumentos SET fk_instrumento = "'.$id_pregunta.'", fk_evidencia = "'.$id_evidencia.'", fk_grupo_interes = "'.$id_grupo_interes.'",fk_usuario = "'.$pk_usuario.'"  , fk_proceso = "'.$fk_proceso.'" ,fk_programa = "'.$p.'" , fk_sede = "'.$s.'", observaciones = "'.$observaciones.'", ponderacion = "'.$ponderacion.'", respuesta = "'.$id_respuesta.'" WHERE pk_respuesta_instrumento = "'.$pk_respuesta_instrumento.'"';
				$resultado = $this->runSQL($sql_1);
			}else{
				$sql_2 = 'INSERT INTO doc_respuesta_instrumentos (fk_instrumento, fk_evidencia, fk_grupo_interes,fk_usuario, fk_proceso, fk_programa , fk_sede , observaciones, ponderacion, respuesta  ) VALUES ("'.$id_pregunta.'", "'.$id_evidencia.'", "'.$id_grupo_interes.'",  "'.$pk_usuario.'" , "'.$fk_proceso.'", "'.$p.'", "'.$s.'",  "'.$observaciones.'", "'.$ponderacion.'", "'.$id_respuesta.'" )';
				$resultado = $this->runSQL($sql_2);
			}
			return $resultado;

		}else{
			$sql6 = 'SELECT  MIN(rp.ponderacion)  FROM doc_instru_evaluacion die, doc_respuesta_pregunta drp , respuesta_ponderacion rp WHERE pk_instru_evaluacion = 2 AND die.`fk_grupo_respuesta` = drp.`grupo_respuesta` AND drp.`fk_respuesta_ponderacion` = rp.`pk_respuesta_ponderacion`; ';	
			$resultados = $this->runSQL($sql6);
			$tipo_r = $resultados->GetRows();
			$pond = ($tipo == 'numerico' ? $ponderacion : $tipo_r[0]['ponderacion']);

			$sql1 = ' SELECT fk_programa , fk_sede FROM cna_proceso WHERE pk_proceso = "'.$fk_proceso.'" ';
			$resultados = $this->runSQL($sql1);
			$sede = $resultados->GetRows();
			$s = $sede[0]['fk_sede'];
			$p = $sede[0]['fk_programa'];
			$id_evidencia = $this->obtenerIdEvidencia($id_pregunta);
			$id_grupo_interes = $this->obtenerIdGrupoInteres($id_pregunta);
			$sql_0 = 'SELECT COUNT(*) as total, pk_respuesta_instrumento FROM doc_respuesta_instrumentos WHERE fk_instrumento = "'.$id_pregunta.'" AND fk_evidencia = "'.$id_evidencia.'" AND fk_grupo_interes = "'.$id_grupo_interes.'" AND fk_proceso = "'.$fk_proceso.'"';
			$res = $this->runSql($sql_0);
			$instrumento_existente = $res->GetRows();

			if($instrumento_existente[0]['total'] > 0){
				$pk_respuesta_instrumento = $instrumento_existente[0]['pk_respuesta_instrumento'];
				$sql_1 = 'UPDATE doc_respuesta_instrumentos SET fk_instrumento = "'.$id_pregunta.'", fk_evidencia = "'.$id_evidencia.'", fk_grupo_interes = "'.$id_grupo_interes.'",fk_usuario = "'.$pk_usuario.'"  , fk_proceso = "'.$fk_proceso.'" ,fk_programa = "'.$p.'" , fk_sede = "'.$s.'", observaciones = "'.$observaciones.'", ponderacion = "'.$pond.'", respuesta = "'.$id_respuesta.'" WHERE pk_respuesta_instrumento = "'.$pk_respuesta_instrumento.'"';
				$resultado = $this->runSQL($sql_1);
			}else{
				$sql_2 = 'INSERT INTO doc_respuesta_instrumentos (fk_instrumento, fk_evidencia, fk_grupo_interes,fk_usuario, fk_proceso, fk_programa , fk_sede , observaciones, ponderacion, respuesta  ) VALUES ("'.$id_pregunta.'", "'.$id_evidencia.'", "'.$id_grupo_interes.'",  "'.$pk_usuario.'" , "'.$fk_proceso.'", "'.$p.'", "'.$s.'",  "'.$observaciones.'", "'.$pond.'", "'.$id_respuesta.'" )';
				$resultado = $this->runSQL($sql_2);
			}
			return $resultado;
		}	
		
	}

	/**
	 * [obtenerIdEvidencia obtiene el fk_eviencia de cada instrumento de evaluacion]
	 * @return [int] devuelve el estado de la operacion 1 -0
	 */
	private function obtenerIdEvidencia($id_pregunta){
		$sql = 'SELECT fk_evidencia FROM doc_instru_evaluacion WHERE pk_instru_evaluacion = "'.$id_pregunta.'"';
		$resultados = $this->runSQL($sql);
		$fk_evidencia = $resultados->GetRows();
		return $fk_evidencia[0]['fk_evidencia'];
	}

	/**
	 * [obtenerRespuestas obtiene las respuestas que ya tiene cargadas un instrumento de evaluacion]
	 * @return [int] devuelve el estado de la operacion 1 -0
	 */	
	public function obtenerRespuestas($id_pregunta , $fk_proceso){
		$sql = 'SELECT di.*,IF(di.respuesta = 10006, CEIL((di.ponderacion-1) / 4 * 100), di.ponderacion) AS respuesta_6, IF(di.respuesta = 10007, CEIL((di.ponderacion-1) / 4 * (SELECT de.porcentaje FROM doc_instru_evaluacion de WHERE de.pk_instru_evaluacion = di.`fk_instrumento`)), di.ponderacion) AS respuesta_7 FROM doc_respuesta_instrumentos di WHERE di.fk_instrumento = "'.$id_pregunta.'" AND di.fk_proceso = "'.$fk_proceso.'" ';
		$resultados = $this->runSQL($sql);
		return $resultados;
	}

	/**
	 * [obtenerIdGrupoInteres obtiene el id de los grupos de interes]
	 * @return [int] devuelve el estado de la operacion 1 -0
	 */
	private function obtenerIdGrupoInteres($id_pregunta){
		$sql = 'SELECT fk_grupo_interes FROM doc_instru_evaluacion WHERE pk_instru_evaluacion = "'.$id_pregunta.'"';
		$resultados = $this->runSQL($sql);
		$fk_grupo_interes = $resultados->GetRows();
		return $fk_grupo_interes[0]['fk_grupo_interes'];
	}

	/**
	 * [obtenerTotalInstrumentos obtine el total de instrumentos de evaluacion por proceso]
	 * @return [int] devuelve el estado de la operacion 1 -0
	 */	
	public function obtenerTotalInstrumentos($grupo, $proceso){
		$SQL1 = 'SELECT pk_grupo_interes FROM cna_grupo_interes WHERE nombre = "'.$grupo.'" ';
		$resultados = $this->runSQL($SQL1);
		$nom = $resultados->GetRows();
		$s = $nom[0]['pk_grupo_interes'];
		$sql = 'SELECT COUNT(*) as total FROM doc_instru_evaluacion  WHERE (fk_grupo_interes  = "'.$s.'" OR fk_grupo_interes  = 3) AND proceso = "'.$proceso.'"';
		$resultados = $this->runSQL($sql);
		$res = $resultados->GetRows();
		return $res[0]['total'];
	}

	/**
	 * [obtenerTotalInstrumentosInstitucional obtiene el total de instrumentod de evaluacion institucionales]
	 * @return [int] devuelve el estado de la operacion 1 -0
	 */
	public function obtenerTotalInstrumentosInstitucional($grupo){
		$SQL1 = 'SELECT pk_grupo_interes FROM cna_grupo_interes WHERE nombre = "'.$grupo.'" ';
		$resultados = $this->runSQL($SQL1);
		$nom = $resultados->GetRows();
		$s = $nom[0]['pk_grupo_interes'];
		$sql = 'SELECT COUNT(*) as total FROM doc_instru_evaluacion  WHERE (fk_grupo_interes  = 3 or fk_grupo_interes  = 8 ) and proceso = 0';
		$resultados = $this->runSQL($sql);
		$res = $resultados->GetRows();
		return $res[0]['total'];
	}

	/**
	 * [obtenerAcumuladoProceso obtiene el total de instrumentos por cada proceso]
	 * @return [int] devuelve el estado de la operacion 1 -0
	 */
	public function obtenerAcumuladoProceso($id_proceso){
		$sql1 = 'SELECT COUNT(DISTINCT dri.`pk_respuesta_instrumento`) AS totalAcu FROM doc_respuesta_instrumentos dri, doc_documento dd WHERE dri.`fk_proceso` = "'.$id_proceso.'"  AND observaciones <> "" AND dd.`fk_instrueval` = dri.`fk_instrumento` AND dd.`estado` = 1 and dri.`ponderacion` <> 1';
		$sql2 = 'SELECT COUNT(DISTINCT dri.`pk_respuesta_instrumento`) AS totalAcu FROM doc_respuesta_instrumentos dri, doc_documento dd WHERE dri.`fk_proceso` = "'.$id_proceso.'"  AND observaciones <> ""  AND dri.`ponderacion` = 1 ';
		$resultados1 = $this->runSQL($sql1);
		$res1 = $resultados1->GetRows();
		$resultados2 = $this->runSQL($sql2);
		$res2 = $resultados2->GetRows();

		$r = $res1[0]['totalAcu'];
		$r2 = $res2[0]['totalAcu'];
		$total = $r + $r2;
		return $total;
	}

	/**
	 * [porcentajeProcesos obtiene el porcentaje de cada proceso]
	 */
	public function porcentajeProcesos(){


		$sql = 'SELECT pk_proceso , nombre FROM cna_proceso';
        $pregunta = $this->runSQL($sql);
        $res = $pregunta->GetRows(); 
        $instru_programa = $this->obtenerTotalInstrumentos($_SESSION['grupos_documental']['grupoP'], $_SESSION['pk_proceso'] );
        $instru_insti = $this->obtenerTotalInstrumentosInstitucional($_SESSION['grupos_documental']['grupoI']);
        
        $datosprograma = array();
        $totalInstitucional = $this->obtenerAcumuladoProceso(0);
		$porcentajeInstitucional = round(( $totalInstitucional * 100 ) / $instru_insti);
		array_push($datosprograma, array('nombre'=>'Proceso Institucional', 'porcentaje' => $porcentajeInstitucional));

        for($i = 0; $i< count($res); $i++){
        	$dat = $this->obtenerAcumuladoProceso($res[$i]['pk_proceso']);
        	$porcentaje = round(( $dat * 100 ) / $instru_programa);
        	array_push($datosprograma, array('nombre' => $res[$i]['nombre'], 'porcentaje' => $porcentaje ));
        }
        return $datosprograma;
    }

	/**
	 * [porcentajeProcesosIndividial obtiene el porcentaje de cada proceso]
	 * @return [array] devuelve los resultados de esta operacion
	 */
    public function porcentajeProcesosIndividial(){
    	$sql = 'SELECT pk_proceso , nombre FROM cna_proceso where pk_proceso = "'.$_SESSION['pk_proceso'].'"';
        $pregunta = $this->runSQL($sql);
        $res = $pregunta->GetRows(); 
        $nombreProg = $res[0]['nombre'];


        $instru_programa = $this->obtenerTotalInstrumentos($_SESSION['grupos_documental']['grupoP']);
        $instru_insti = $this->obtenerTotalInstrumentosInstitucional($_SESSION['grupos_documental']['grupoI']);
        
        $datosprograma = array();
        $totalInstitucional = $this->obtenerAcumuladoProceso(0);

		$porcentajeInstitucional = round(( $totalInstitucional * 100 ) / $instru_insti);
		array_push($datosprograma, array('nombre'=>'Proceso Institucional', 'porcentaje' => $porcentajeInstitucional));

		$dat = $this->obtenerAcumuladoProceso($_SESSION['pk_proceso']);
        $porcentaje = round(( $dat * 100 ) / $instru_programa);
        array_push($datosprograma, array('nombre' => $nombreProg, 'porcentaje' => $porcentaje ));
        
        return $datosprograma;
    }

    public function ResultadoCompleto($fk_proceso)
    {
		$sql = 'SELECT di.`fk_caracteristicas`,di.`fk_caracteristicas_codigo`,di.`fk_factor_codigo`, di.`fk_factor`, di.`pk_instru_evaluacion`, di.`descripcion`, dr.`ponderacion`, di.`proceso`
FROM doc_instru_evaluacion di, doc_respuesta_instrumentos dr
WHERE dr.`fk_proceso` = '.$fk_proceso.' AND di.`proceso` = dr.`fk_proceso` AND di.`pk_instru_evaluacion` = dr.`fk_instrumento`';
        $pregunta = $this->runSQL($sql);
        $res = $pregunta->GetRows(); 
        return $res;
    }

	/**
	 * [consolidacionFinal consolidacion final de repuestas hacia la tabla cna_resultados_evidencia]
	 * @return [int] devuelve el estado de la operacion 1 -0
	 */
	public function consolidacionFinal($fk_proceso){
		$sql = 'SELECT di.fk_evidencia, MAX(di.fk_proceso) AS fk_proceso, ROUND((SUM(di.ponderacion) / COUNT(di.fk_evidencia)), 2) AS ponderacion, GROUP_CONCAT(DISTINCT di.observaciones ORDER BY di.fk_instrumento ASC SEPARATOR \' | \') AS observacion , de.`fk_evidencia_grupo_interes` AS fk_grupo_evidencia FROM doc_respuesta_instrumentos  di , doc_instru_evaluacion de WHERE (fk_proceso = 0 OR fk_proceso = "'.$fk_proceso.'") AND di.`fk_instrumento` = de.`pk_instru_evaluacion` GROUP BY fk_instrumento HAVING COUNT(fk_instrumento) >= 2';
		$resultados = $this->runSQL($sql);
		$res = $resultados->GetRows();


		if ( count($res) > 0){
			$resultados = $this->runSQL($sql);
			$res = $resultados->GetRows();
			$respuesta = 1;
			for($i=0; $i<count($res); $i++){
				$sql_1 = 'INSERT INTO cna_resultados_evidencia (calificacion, observacion, fk_evidencia_grupo_interes, fk_proceso ) VALUES("'.$res[$i]['ponderacion'].'", "'.$res[$i]['observacion'].'", "'.$res[$i]['fk_grupo_evidencia'].'","'.$res[$i]['fk_proceso'].'" ) ';
				if(!$this->runSQL($sql_1)){
					$respuesta = 0;
				}
			}
		}


		$SQL1 = 'SELECT pk_grupo_interes FROM cna_grupo_interes WHERE nombre = "'.$_SESSION['grupos_documental']['grupoP'].'"';
		$resultados = $this->runSQL($SQL1);
		$nom = $resultados->GetRows();

		$sql = 'SELECT di.`pk_respuesta_instrumento`, di.fk_evidencia, di.fk_proceso, ROUND((SUM(di.ponderacion) / COUNT(di.fk_evidencia)), 2) AS ponderacion, GROUP_CONCAT(DISTINCT di.observaciones ORDER BY di.fk_instrumento ASC SEPARATOR \' | \') AS observacion , de.`fk_evidencia_grupo_interes` AS fk_grupo_evidencia FROM doc_respuesta_instrumentos  di , doc_instru_evaluacion de WHERE di.fk_proceso = "'.$fk_proceso.'" AND di.`fk_instrumento` = de.`pk_instru_evaluacion` AND di.`fk_grupo_interes` = "'.$nom[0]['pk_grupo_interes'].'" GROUP BY di.fk_evidencia HAVING COUNT(fk_instrumento) = 1 ';
		$resultados = $this->runSQL($sql);
		$res = $resultados->GetRows();
		$respuesta = 1;
		for($i=0; $i<count($res); $i++){
			$sql_1 = 'INSERT INTO cna_resultados_evidencia (calificacion, observacion, fk_evidencia_grupo_interes, fk_proceso ) VALUES("'.$res[$i]['ponderacion'].'", "'.$res[$i]['observacion'].'", "'.$res[$i]['fk_grupo_evidencia'].'","'.$res[$i]['fk_proceso'].'" ) ';
			if(!$this->runSQL($sql_1)){
				$respuesta = 0;
			}
		}

		
		$SQL1 = 'SELECT pk_grupo_interes FROM cna_grupo_interes WHERE nombre = "'.$_SESSION['grupos_documental']['grupoI'].'"';
		$resultados = $this->runSQL($SQL1);
		$nom = $resultados->GetRows();

		$sql2 = 'SELECT di.`pk_respuesta_instrumento`, di.fk_evidencia, di.fk_proceso, ROUND((SUM(di.ponderacion) / COUNT(di.fk_evidencia)), 2) AS ponderacion, GROUP_CONCAT(DISTINCT di.observaciones ORDER BY di.fk_instrumento ASC SEPARATOR \' | \') AS observacion , de.`fk_evidencia_grupo_interes` AS fk_grupo_evidencia FROM doc_respuesta_instrumentos  di , doc_instru_evaluacion de WHERE di.fk_proceso = 0 AND di.`fk_instrumento` = de.`pk_instru_evaluacion` AND di.`fk_grupo_interes` = "'.$nom[0]['pk_grupo_interes'].'" GROUP BY di.fk_evidencia HAVING COUNT(fk_instrumento) = 1 ';
		$resultados2 = $this->runSQL($sql2);
		$res2 = $resultados2->GetRows();

		for($i=0; $i<count($res2); $i++){
			$sql_1 = 'INSERT INTO cna_resultados_evidencia (calificacion, observacion, fk_evidencia_grupo_interes, fk_proceso ) VALUES("'.$res2[$i]['ponderacion'].'", "'.$res2[$i]['observacion'].'", "'.$res2[$i]['fk_grupo_evidencia'].'", 1 ) ';
			if(!$this->runSQL($sql_1)){
				$respuesta = 0;
			}
		}

		$query = 'INSERT INTO doc_proceso_finalizado(fk_proceso, estado)values("'.$fk_proceso.'" , 1)';
		$consul = $this->runSQL($query);

		echo $respuesta;

	}

	/**
	 * [cargarTiposDeRespuesta carga los tipos de repuesta de un instrumento]
	 * @return [int] devuelve el estado de la operacion 1 -0
	 */
	public function cargarTiposDeRespuesta(){
		$sql = 'SELECT * FROM doc_respuesta_instrumentos WHERE fk_instrumento = "'.$id_pregunta.'" AND fk_proceso = "'.$fk_proceso.'" ';
		$resultados = $this->runSQL($sql);
		return $resultados;
	}

	/**
	 * [modificarRespuesta modifica las repuestas que se le asignaron a un instrumento por proceso]
	 * @return [int] devuelve el estado de la operacion 1 -0
	 */
	public function modificarRespuesta($pk_respuestas_pregunta, $texto, $fk_respuesta_ponderacion, $tipo_respuesta){
		$sql = 'UPDATE doc_respuesta_pregunta SET texto = "'.$texto.'", fk_respuesta_ponderacion = "'.$fk_respuesta_ponderacion.'", tipo_respuesta = "'.$tipo_respuesta.'" WHERE pk_respuestas_pregunta = "'.$pk_respuestas_pregunta.'"  ';
		$resultados = $this->runSQL($sql);
		return $resultados;
	}

	/**
	 * [eliminarTipoRespuesta elimina el tipo de respiesta de un instrumento]
	 * @return [int] devuelve el estado de la operacion 1 -0
	 */
	public function eliminarTipoRespuesta($id_grupo){
		$sql = 'UPDATE doc_respuesta_pregunta SET estado = 0 WHERE grupo_respuesta ="'.$id_grupo.'" ';
		if ($this->runSQL($sql))
			return 1; 
		else
			return 0;
	}

	/**
	 * [guardarArchivosExistentes guarda los documentos existentes cde un instrumnto de evaluacion]
	 * @return [int] devuelve el estado de la operacion 1 -0
	 */
	public function guardarArchivosExistentes($pk_documento , $pk_programa , $pk_sede , $fk_proceso){
		$sql = 'select * from doc_documento where pk_documento = "'.$pk_documento.'" ';
		$resultados = $this->runSQL($sql);
		$res2 = $resultados->GetRows();
		if ($fk_proceso == 0){
			$sql = 'INSERT INTO doc_documento (nombre, url, extension, fk_instrueval, estado , fecha , fk_usuario , fk_programa , fk_proceso , fk_sede, tipo) VALUES ("'.$res2[0]['nombre'].'" , "'.$res2[0]['url'].'" , "'.$res2[0]['extension'].'" , "'.$res2[0]['fk_instrueval'].'" , "'.$res2[0]['estado'].'" , CURDATE(), "'.$res2[0]['fk_usuario'].'", "0", "0", "0" , "2")';
			if($this->runSQL($sql)){
				return 1;
			}else{
				return 0;
			}
		}else{
			$sql = 'INSERT INTO doc_documento (nombre, url, extension, fk_instrueval, estado , fecha , fk_usuario , fk_programa , fk_proceso , fk_sede , tipo) VALUES ("'.$res2[0]['nombre'].'" , "'.$res2[0]['url'].'" , "'.$res2[0]['extension'].'" , "'.$res2[0]['fk_instrueval'].'" , "'.$res2[0]['estado'].'" , CURDATE(), "'.$res2[0]['fk_usuario'].'", "'.$res2[0]['fk_programa'].'", "'.$fk_proceso.'", "'.$res2[0]['fk_sede'].'" , "2")';
			if($this->runSQL($sql)){
				return 1;
			}else{
				return 0;
			}
		}
	}

	/**
	 * [verificarConsolidacion Veridica el si un proceso ya reliazo consoiadcion]
	 * @return [int] devuelve el estado de la operacion 1 -0
	 */
	public function verificarConsolidacion(){
		$sql = 'SELECT pk_proceso_finalizado FROM doc_proceso_finalizado WHERE fk_proceso = "'.$_SESSION['pk_proceso'].'" GROUP BY fk_proceso';
		$dato = $this->runSQL($sql);
		return $dato;
	}

	/**
	 * [runSQL funcion encargada de enviar las consultas a la clase de base de datos]
	 * @return [int] devuelve el estado de la operacion 1 -0
	 */
	private function runSQL($sql){
        $resultado = $this->adoDB->conectarAdo($sql);
        return $resultado;
    }


}
?>
