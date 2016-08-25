<?php
session_start();
error_reporting(0);
include_once 'SAD_Seguridad_Modelo.php';
include '../BaseDatos/AdoDB.php';

class InstruEval_Modelo {
	public $id;
	public $pregunta;
	public $evidencia;
	public $tipoRespuesta;
	public $nuevaPregunta;
	public $id_evidencia;
	public $opcionRespuesta;
	public $grupo;
	public $adoDB;
	public $seg;
	public $factor;
	public $porcentaje;
	public $caracteristicas;
	public $aspectos;
	public $evidencias;
	public $proceso;

	/**
	 * [__construct description]
	 * @param integer $id
	 * @param string  $pregunta
	 * @param integer $evidencia
	 * @param integer $tipoRespuesta
	 * @param integer $opcionRespuesta
	 * @param string  $nuevaPregunta
	 * @param string  $grupo
	 */
	public function __construct($id = 0 , $pregunta = '', $evidencia = 0, $tipoRespuesta = 0 , $opcionRespuesta = 0 ,$nuevaPregunta = '' , $grupo = '', $porcentaje = 0, $factor = 0, $caracteristicas = 0, $aspectos = 0, $evidencias = 0 ){
		$this->id = 0;
		$this->pregunta = $pregunta;
		$this->evidencia = $evidencia;
		$this->tipoRespuesta= $tipoRespuesta;
		$this->opcionRespuesta= $opcionRespuesta;
		$this->nuevaPregunta= $nuevaPregunta;
		$this->grupo= $grupo;
		$this->porcentaje = $porcentaje;
		$this->factor = $factor;
		$this->caracteristicas = $caracteristicas;
		$this->aspectos = $aspectos;
		$this->evidencias = $evidencias;
		$this->proceso = $proceso;



		$this->adoDB = new Ado(); 
		$this->seg = new Seguridad();
	}

	/**
	 * [guardar guarda los instrumentos de evaluacion]
	 * @param  [int] $suboperacion
	 * @param  [int] $proceso
	 * @return [int] estado 1-0
	 */
	public function guardar($suboperacion , $proceso){

		$sql1 = 'SELECT pk_evidencia_grupo_interes FROM cna_evidencia_grupo_interes WHERE fk_evidencia = "'.$this->evidencia.'" ';
		$resultados = $this->runSQL($sql1);
		$fk_grupo_interes_eidencia = $resultados->GetRows();
		$fk = $fk_grupo_interes_eidencia[0]['pk_evidencia_grupo_interes'];
		$sqlinsert = "";
		if($suboperacion == "guardar_con_texto"){
			$sqlinsert = 'INSERT INTO doc_instru_evaluacion (descripcion, fk_evidencia, fk_grupo_respuesta , fk_grupo_interes  , fk_tipo_respuesta , fk_evidencia_grupo_interes, porcentaje ,proceso ,estado, fk_factor, fk_caracteristicas, fk_aspectos, fk_evidencias) VALUES ("'.$this->pregunta.'" , "'.$this->evidencia.'", " ", "'.$this->grupo.'" , "'.$this->tipoRespuesta.'" , "'.$fk.'", "'.$this->opcionRespuesta.'", "'.$proceso.'" ,1, "'.$this->factor.'","'.$this->caracteristicas.'","'.$this->aspectos.'","'.$this->evidencia.'"  )';
		}else{
			$sqlinsert = 'INSERT INTO doc_instru_evaluacion (descripcion, fk_evidencia, fk_grupo_respuesta , fk_grupo_interes  , fk_tipo_respuesta , fk_evidencia_grupo_interes, porcentaje ,proceso, estado, fk_factor, fk_caracteristicas, fk_aspectos, fk_evidencias) VALUES ("'.$this->pregunta.'" , "'.$this->evidencia.'", "'.$this->opcionRespuesta.'", "'.$this->grupo.'" , "'.$this->tipoRespuesta.'" , "'.$fk.'", 0 , "'.$proceso.'" ,1, "'.$this->factor.'","'.$this->caracteristicas.'","'.$this->aspectos.'","'.$this->evidencia.'" )';
		}


		$observacion =  'Se creo un instrumento de evaluacion para la evidencia numero : "'.$this->evidencia.'" '; 
        $transaccion = "Crear Instrumentos";
        $this->seg->Seguridad_Enviar($observacion, $transaccion);
		if($this->runSQL($sqlinsert)){
			return 1;
		}else{
			return 0;
		}
	}

	public function guardarInstruCarac()
	{
		$sqlinsert = 'INSERT INTO doc_instru_evaluacion (descripcion, fk_grupo_respuesta , fk_grupo_interes  , fk_tipo_respuesta , fk_evidencia_grupo_interes, porcentaje ,proceso, estado, fk_factor, fk_caracteristicas, fk_aspectos, fk_evidencia) VALUES ("'.$this->pregunta.'" , "'.$this->opcionRespuesta.'", "'.$this->grupo.'" , "'.$this->tipoRespuesta.'" ,0, "'.$this->porcentaje.'", "'.$this->proceso.'" ,1, "'.$this->factor.'","'.$this->caracteristicas.'","'.$this->aspectos.'","'.$this->evidencias.'" )';

		
		$observacion =  'Se creo un instrumento de evaluacion '; 
        $transaccion = "Crear Instrumentos";
        $this->seg->Seguridad_Enviar($observacion, $transaccion);
		if($this->runSQL($sqlinsert)){
			return 1;
		}else{
			return 0;
		}
	}
	/**
	 * [eliminar elimina los instrumentos de evaluacion]
	 * @return [int] estado 1-0
	 */
	public function eliminar(){
		$sql = 'UPDATE doc_instru_evaluacion SET estado = 0 WHERE pk_instru_evaluacion = '.$this->id.' ';
		$observacion =  'Se modifico el estado a  0 el instrumento de evaluacion numero : "'.$this->id.'" '; 
        $transaccion = "deshabilitar Instrumentos";
        $this->seg->Seguridad_Enviar($observacion, $transaccion);
		if($this->runSQL($sql)){
			return 1;
		}else{
			return 0;
		}
	}

	/**
	 * [modificar modifica los instrumentos de evaluacion]
	 * @param  [int] $proceso
	 * @return [int] estado 1-0
	 */
	public function modificar($proceso){
		$sql = 'UPDATE doc_instru_evaluacion SET descripcion = "'.$this->pregunta.'",fk_evidencia ="'.$this->evidencia.'" , fk_grupo_respuesta = "'.$this->opcionRespuesta.'" , fk_grupo_interes ="'.$this->grupo.'" , fk_tipo_respuesta = "'.$this->tipoRespuesta.'"  WHERE pk_instru_evaluacion = '.$this->id.' ';
		/*$observacion =  'Se elimino el instrumento de evaluacion numero : "'.$this->id.'" '; 
        $transaccion = "Eliminar Instrumentos";
        $this->seg->Seguridad_Enviar($observacion, $transaccion);*/
		if($this->runSQL($sql)){
			return 1;
		}else{
			return 0;
		}
	}
	/**
	 * [cargarinstrumento carga la lista de instrumentos deevaluacion por evidencia]
	 * @param  [int] $id_evidencia
	 * @return [int] retorna los resultados
	 */
	public function cargarinstrumento($id_evidencia){
		$sql = 'SELECT * FROM doc_instru_evaluacion WHERE fk_evidencia = "'.$id_evidencia.'" AND estado = 1 '; 
		$resul = $this->runSQL($sql);
		return $resul;
		
	}
	
	/**
	 * [verificarfase verifica la fase de un proceso dependiendo del usuario]
	 * @param  [int] $usuario
	 * @return [int] retorna los resultados
	 */
	public function verificarfase($usuario){
		$sql = 'SELECT cp.`fk_fase` FROM sad_proceso_usuario  su, cna_proceso  cp WHERE su.fk_usuario = "'.$usuario.'" AND su.`fk_proceso` = cp.`pk_proceso` '; 

		$resul = $this->runSQL($sql);
		return $resul;
	}

	public function listaProcesos(){
		$sql = 'SELECT * from cna_proceso where estado = 1'; 
		$resul = $this->runSQL($sql);
		return $resul;
	}

	
	/**
	 * [checkprogramas obtiene la lista de procesos que esten en fase 3]
	 * @return [int] resultados obtenidos
	 */
	public function checkprogramas(){
		$sql = 'SELECT pk_proceso , nombre , fk_fase FROM cna_proceso where fk_fase = 3'; 
		$resul = $this->runSQL($sql);
		return $resul;
	}

	public function checkprogramasConstruccion(){
		$sql = 'SELECT cp.`nombre`, cp.`fk_fase`, cp.`pk_proceso`, cf.nombre as nombre_fase FROM sad_proceso_usuario spu, cna_proceso cp, cna_fase cf WHERE spu.`fk_usuario` = '.$_SESSION["pk_usuario"].' AND spu.`fk_proceso` = cp.`pk_proceso` AND cp.fk_fase = cf.pk_fase AND cp.`fk_fase` = 3 order by cp.fk_fase'; 
		$resul = $this->runSQL($sql);
		return $resul;
	}

	public function buscarFactores(){
		$sql = 'select * from cna_factor';
		$resul = $this->runSQL($sql);
		return $resul;
	}	

	public function buscarCaract($pk_factor){
		$sql = 'select * from cna_caracteristica where fk_factor = '.$pk_factor;
		$resul = $this->runSQL($sql);
		return $resul;
	}

	public function buscarAspecto($pk_caracteristica)
	{
		$sql = 'select * from cna_aspecto where fk_caracteristica = '.$pk_caracteristica;
		$resul = $this->runSQL($sql);
		return $resul;
	}	

	public function buscarEVidencia($pk_aspecto)
	{
		$sql = 'select * from cna_evidencia where fk_aspecto = '.$pk_aspecto;
		$resul = $this->runSQL($sql);
		return $resul;
	}	

	/**
	 * [runSQL cnexiona  la base de datos]
	 * @param  [string] $sql
	 * @return [int] resukltados obtenidos
	 */
	private function runSQL($sql){
        $resultado = $this->adoDB->conectarAdo($sql);
        return $resultado;
    }
}


?>