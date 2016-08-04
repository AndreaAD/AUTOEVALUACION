<?php
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
	public function __construct($id = 0 , $pregunta = '', $evidencia = 0, $tipoRespuesta = 0 , $opcionRespuesta = 0 ,$nuevaPregunta = '' , $grupo = ''){
		$this->id = 0;
		$this->pregunta = $pregunta;
		$this->evidencia = $evidencia;
		$this->tipoRespuesta= $tipoRespuesta;
		$this->opcionRespuesta= $opcionRespuesta;
		$this->nuevaPregunta= $nuevaPregunta;
		$this->grupo= $grupo;

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
			$sqlinsert = 'INSERT INTO doc_instru_evaluacion (descripcion, fk_evidencia, fk_grupo_respuesta , fk_grupo_interes  , fk_tipo_respuesta , fk_evidencia_grupo_interes, porcentaje ,proceso ,estado) VALUES ("'.$this->pregunta.'" , "'.$this->evidencia.'", " ", "'.$this->grupo.'" , "'.$this->tipoRespuesta.'" , "'.$fk.'", "'.$this->opcionRespuesta.'", "'.$proceso.'" ,1)';
		}else{
			$sqlinsert = 'INSERT INTO doc_instru_evaluacion (descripcion, fk_evidencia, fk_grupo_respuesta , fk_grupo_interes  , fk_tipo_respuesta , fk_evidencia_grupo_interes, porcentaje ,proceso, estado) VALUES ("'.$this->pregunta.'" , "'.$this->evidencia.'", "'.$this->opcionRespuesta.'", "'.$this->grupo.'" , "'.$this->tipoRespuesta.'" , "'.$fk.'", 0 , "'.$proceso.'" ,1)';
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
		//$sql = 'SELECT cp.`fk_fase` FROM sad_proceso_usuario  su, cna_proceso  cp WHERE su.fk_usuario = "'.$usuario.'" AND su.`fk_proceso` = cp.`pk_proceso` '; 
		//$resul = $this->runSQL($sql);
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