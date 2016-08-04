<?php
error_reporting(0);
include_once 'SAD_Seguridad_Modelo.php';
include '../BaseDatos/AdoDB.php';

class Selectores_Modelo {
	private $adoDB;
    public $seg;
    /**
     * [__construct description]
     */
	public function __construct(){
		
        $this->adoDB = new Ado(); 
        $this->seg = new Seguridad();
	}
    /**
     * [factor carga los factores]
     * @return [string] lista de factores
     */
    public function factor($valor){
        if($valor == '7' || $valor == '8'){
            $sql = 'SELECT DISTINCT(cf.`pk_factor`) , cf.`nombre`, cf.`codigo` FROM cna_factor cf, cna_caracteristica cc, cna_aspecto ca, cna_evidencia ce, cna_evidencia_grupo_interes cegi WHERE cegi.`fk_evidencia` = ce.`pk_evidencia`  AND ce.`fk_aspecto` = ca.`pk_aspecto` AND ce.estado = 1 AND ca.`fk_caracteristica` = cc.`pk_caracteristica` AND cc.`fk_factor` = cf.`pk_factor` AND cegi.`estado` = 1 AND cegi.`fk_modulo` = 5 AND cegi.`fk_grupo_interes` = "'.$valor.'" GROUP BY ce.`pk_evidencia` HAVING COUNT(ce.`pk_evidencia`) = 1 ';
        }else{
            $sql = 'SELECT * FROM cna_factor';  
        }
        $factores =  $this->runSQL($sql);
        return $factores;
    } 

    /**
     * [caracteristica obtiene las caracteristicas]
     * @param  [int] $id_factor
     * @param  [int] $valor
     * @return [int] lista de carcteristicas
     */
    public function caracteristica($id_factor, $valor){
        if($valor == '7' || $valor == '8'){
            $sql = 'SELECT DISTINCT(cc.`pk_caracteristica`) , cc.`nombre`, cc.`codigo` FROM cna_factor cf, cna_caracteristica cc, cna_aspecto ca, cna_evidencia ce, cna_evidencia_grupo_interes cegi WHERE cegi.`fk_evidencia` = ce.`pk_evidencia` AND ce.`fk_aspecto` = ca.`pk_aspecto` AND ce.estado = 1 AND ca.`fk_caracteristica` = cc.`pk_caracteristica` AND cc.`fk_factor` = "'.$id_factor.'" AND cc.`fk_factor` = cf.`pk_factor` AND cegi.`estado` = 1 AND cegi.`fk_modulo` = 5 AND cegi.`fk_grupo_interes` = "'.$valor.'" GROUP BY ce.`pk_evidencia` HAVING COUNT(ce.`pk_evidencia`) = 1 ';
        }else{
            $sql = 'SELECT * FROM cna_caracteristica WHERE fk_factor ="'.$id_factor.'"';
        }
        $caracteristica =  $this->runSQL($sql);
        return $caracteristica;
    }
    /**
     * [aspecto obtiene la lista de aspectos]
     * @param  [int] $id_caracteristica
     * @param  [int] $valor
     * @return [int] lista de aspectos
     */
    public function aspecto($id_caracteristica, $valor){
        if($valor == '7' || $valor == '8'){
            $sql = 'SELECT ca.`pk_aspecto` , ca.`nombre`, ca.`codigo` FROM cna_factor cf, cna_caracteristica cc, cna_aspecto ca, cna_evidencia ce, cna_evidencia_grupo_interes cegi WHERE cegi.`fk_evidencia` = ce.`pk_evidencia` AND ce.`fk_aspecto` = ca.`pk_aspecto` AND ce.estado = 1 AND ca.`fk_caracteristica` = "'.$id_caracteristica.'" AND ca.`fk_caracteristica` = cc.`pk_caracteristica` AND cc.`fk_factor` = cf.`pk_factor` AND cegi.`estado` = 1 AND cegi.`fk_modulo` = 5 AND cegi.`fk_grupo_interes` = "'.$valor.'" GROUP BY ce.`pk_evidencia` HAVING COUNT(ce.`pk_evidencia`) = 1 ';
        }else{
            $sql = 'SELECT * FROM cna_aspecto WHERE fk_caracteristica = "'.$id_caracteristica.'"';
        }
        $aspecto =  $this->runSQL($sql);
        return $aspecto;
    }

    /**
     * [evidencia obtiene la lista de evidencias]
     * @param  [int] $id_aspecto
     * @param  [int] $valor
     * @return [int] lista de evidencias
     */
    public function evidencia($id_aspecto, $valor){
        if($valor == '7' || $valor == '8'){
            $sql = 'SELECT ce.`pk_evidencia` , ce.`nombre`, ce.`codigo` , cegi.`fk_modulo`,cegi.`fk_grupo_interes` FROM cna_factor cf, cna_caracteristica cc, cna_aspecto ca, cna_evidencia ce, cna_evidencia_grupo_interes cegi WHERE cegi.`fk_evidencia` = ce.`pk_evidencia`  AND ce.`fk_aspecto` = "'.$id_aspecto.'" AND ce.`fk_aspecto` = ca.`pk_aspecto`  AND ce.estado = 1 AND ca.`fk_caracteristica` = cc.`pk_caracteristica` AND cc.`fk_factor` = cf.`pk_factor` AND cegi.`estado` = 1 AND cegi.`fk_modulo` = 5 AND cegi.`fk_grupo_interes` = "'.$valor.'" GROUP BY ce.`pk_evidencia` HAVING COUNT(ce.`pk_evidencia`) = 1  ';
        }else{
            $sql = 'SELECT * FROM cna_evidencia WHERE fk_aspecto = "'.$id_aspecto.'"';
        }
        $evidencia =  $this->runSQL($sql);
        return $evidencia;
    } 

    /**
     * [obtenerFactores obtiene los factores]
     * @param  [int] $grupo_interes
     * @return [int] lista de factores
     */
	public function obtenerFactores($grupo_interes){
        if ($grupo_interes == '7' || $grupo_interes == '8'){
            $sql = 'SELECT DISTINCT(cf.`pk_factor`) , cf.`nombre`, cf.`codigo` FROM cna_factor cf, cna_caracteristica cc, cna_aspecto ca, cna_evidencia ce, cna_evidencia_grupo_interes cegi WHERE cegi.`fk_evidencia` = ce.`pk_evidencia`  AND ce.`fk_aspecto` = ca.`pk_aspecto` AND ce.estado = 1 AND ca.`fk_caracteristica` = cc.`pk_caracteristica` AND cc.`fk_factor` = cf.`pk_factor` AND cegi.`estado` = 1 AND cegi.`fk_modulo` = 5 AND cegi.`fk_grupo_interes` = "'.$grupo_interes.'" GROUP BY ce.`pk_evidencia` HAVING COUNT(ce.`pk_evidencia`) = 1 ';
        }else{
            $sql = 'SELECT DISTINCT(cf.`pk_factor`) , cf.`nombre`, cf.`codigo`  FROM cna_factor cf, cna_caracteristica cc, cna_aspecto ca, cna_evidencia ce, cna_evidencia_grupo_interes cegi WHERE cegi.`fk_evidencia` = ce.`pk_evidencia`  AND ce.`fk_aspecto` = ca.`pk_aspecto` AND ce.estado = 1 AND ca.`fk_caracteristica` = cc.`pk_caracteristica` AND cc.`fk_factor` = cf.`pk_factor` AND cegi.`estado` = 1 AND cegi.`fk_modulo` = 5 GROUP BY ce.`pk_evidencia` HAVING COUNT(ce.`pk_evidencia`) > 1 ';
        }
        $factores =  $this->runSQL($sql);
        return $factores;
    }

    /**
     * [obtenerFactoresUnico obtiene factores con ciertas validaciones]
     * @return [int] lista de factores
     */
    public function obtenerFactoresUnico(){
        $sql = 'SELECT DISTINCT(cf.`pk_factor`) , cf.`nombre` , cf.`codigo` FROM cna_factor cf, cna_caracteristica cc, cna_aspecto ca, cna_evidencia ce, cna_evidencia_grupo_interes cegi WHERE cegi.`fk_evidencia` = ce.`pk_evidencia` AND ce.`fk_aspecto` = ca.`pk_aspecto` AND ca.`fk_caracteristica` = cc.`pk_caracteristica` AND cc.`fk_factor` = cf.`pk_factor` AND cegi.`estado` = 1 AND cegi.`fk_modulo` = 5 ';
        $factores =  $this->runSQL($sql);
        return $factores;
    }
    
    /**
     * [obtenerCaracteristicas obtiene la lista de caracteristicas dependiendo de un facor y un grupo interes]
     * @param  [int] $id_factor
     * @param  [int] $grupo_interes
     * @return [int] lista de caracteristicas
     */
    public function obtenerCaracteristicas($id_factor , $grupo_interes){
         if ($grupo_interes == '7' || $grupo_interes == '8'){
            $sql = 'SELECT DISTINCT(cc.`pk_caracteristica`) , cc.`nombre`, cc.`codigo` FROM cna_factor cf, cna_caracteristica cc, cna_aspecto ca, cna_evidencia ce, cna_evidencia_grupo_interes cegi WHERE cegi.`fk_evidencia` = ce.`pk_evidencia` AND ce.`fk_aspecto` = ca.`pk_aspecto` AND ce.estado = 1 AND ca.`fk_caracteristica` = cc.`pk_caracteristica` AND cc.`fk_factor` = "'.$id_factor.'" AND cc.`fk_factor` = cf.`pk_factor` AND cegi.`estado` = 1 AND cegi.`fk_modulo` = 5 AND cegi.`fk_grupo_interes` = "'.$grupo_interes.'" GROUP BY ce.`pk_evidencia` HAVING COUNT(ce.`pk_evidencia`) = 1 ';
         }else{
            $sql = 'SELECT DISTINCT(cc.`pk_caracteristica`) , cc.`nombre`, cc.`codigo` FROM cna_factor cf, cna_caracteristica cc, cna_aspecto ca, cna_evidencia ce, cna_evidencia_grupo_interes cegi WHERE cegi.`fk_evidencia` = ce.`pk_evidencia` AND ce.`fk_aspecto` = ca.`pk_aspecto` AND ca.`fk_caracteristica` = cc.`pk_caracteristica` AND cc.`fk_factor` = "'.$id_factor.'" AND cc.`fk_factor` = cf.`pk_factor` AND cegi.`estado` = 1 AND cegi.`fk_modulo` = 5 GROUP BY ce.`pk_evidencia` HAVING COUNT(ce.`pk_evidencia`) > 1';
         }
        $caracteristicas = $this->runSQL($sql);
        return $caracteristicas;
    }

    /**
     * [obtenerAspecto obtiene los aspectos dependiendo de una aracteristica]
     * @param  [type] $id_caracteristica
     * @param  [type] $grupo_interes
     * @return [type] lista de aspectos
     */
    public function obtenerAspecto($id_caracteristica, $grupo_interes){
        if ($grupo_interes == '7' || $grupo_interes == '8'){
            $sql = 'SELECT ca.`pk_aspecto` , ca.`nombre`, ca.`codigo` FROM cna_factor cf, cna_caracteristica cc, cna_aspecto ca, cna_evidencia ce, cna_evidencia_grupo_interes cegi WHERE cegi.`fk_evidencia` = ce.`pk_evidencia` AND ce.`fk_aspecto` = ca.`pk_aspecto` AND ce.estado = 1 AND ca.`fk_caracteristica` = "'.$id_caracteristica.'" AND ca.`fk_caracteristica` = cc.`pk_caracteristica` AND cc.`fk_factor` = cf.`pk_factor` AND cegi.`estado` = 1 AND cegi.`fk_modulo` = 5 AND cegi.`fk_grupo_interes` = "'.$grupo_interes.'" GROUP BY ce.`pk_evidencia` HAVING COUNT(ce.`pk_evidencia`) = 1 ';
        }else{
            $sql = 'SELECT ca.`pk_aspecto` , ca.`nombre` , ca.`codigo` FROM cna_factor cf, cna_caracteristica cc, cna_aspecto ca, cna_evidencia ce, cna_evidencia_grupo_interes cegi WHERE cegi.`fk_evidencia` = ce.`pk_evidencia` AND ce.`fk_aspecto` = ca.`pk_aspecto` AND ca.`fk_caracteristica` = "'.$id_caracteristica.'" AND ca.`fk_caracteristica` = cc.`pk_caracteristica` AND cc.`fk_factor` = cf.`pk_factor` AND cegi.`estado` = 1 AND cegi.`fk_modulo` = 5 GROUP BY ce.`pk_evidencia` HAVING COUNT(ce.`pk_evidencia`) > 1 ;';
        }
        $aspecto = $this->runSQL($sql);
        return $aspecto;
    }

    /**
     * [obtenerEvidencia obtiene la lista de evidencias segun un aspecto]
     * @param  [int] $id_aspecto
     * @param  [int] $grupo_interes
     * @return [int] lista de
     */
    public function obtenerEvidencia($id_aspecto , $grupo_interes){
        if ($grupo_interes == '7' || $grupo_interes == '8'){
            $sql = 'SELECT ce.`pk_evidencia` , ce.`nombre`, ce.`codigo` , cegi.`fk_modulo`,cegi.`fk_grupo_interes` FROM cna_factor cf, cna_caracteristica cc, cna_aspecto ca, cna_evidencia ce, cna_evidencia_grupo_interes cegi WHERE cegi.`fk_evidencia` = ce.`pk_evidencia`  AND ce.`fk_aspecto` = "'.$id_aspecto.'" AND ce.`fk_aspecto` = ca.`pk_aspecto`  AND ce.estado = 1 AND ca.`fk_caracteristica` = cc.`pk_caracteristica` AND cc.`fk_factor` = cf.`pk_factor` AND cegi.`estado` = 1 AND cegi.`fk_modulo` = 5 AND cegi.`fk_grupo_interes` = "'.$grupo_interes.'" GROUP BY ce.`pk_evidencia` HAVING COUNT(ce.`pk_evidencia`) = 1  ';
        }else{
            $sql = 'SELECT ce.`pk_evidencia` , ce.`nombre`, ce.`codigo`, cegi.`fk_modulo`,cegi.`fk_grupo_interes` FROM cna_factor cf, cna_caracteristica cc, cna_aspecto ca, cna_evidencia ce, cna_evidencia_grupo_interes cegi WHERE cegi.`fk_evidencia` = ce.`pk_evidencia`  AND ce.`fk_aspecto` = "'.$id_aspecto.'" AND ce.`fk_aspecto` = ca.`pk_aspecto` AND ca.`fk_caracteristica` = cc.`pk_caracteristica` AND cc.`fk_factor` = cf.`pk_factor` AND cegi.`estado` = 1 AND cegi.`fk_modulo` = 5 GROUP BY ce.`pk_evidencia` HAVING COUNT(ce.`pk_evidencia`) > 1;';
        }
        $evidencia = $this->runSQL($sql);
        return $evidencia;
    }
    public function obtenerEvidencia2(){
        $sql = 'SELECT * FROM cna_evidencia ';
        $evidencia = $this->runSQL($sql);
        return $evidencia;
    }

    /**
     * [obtenerInstrumento obtiene los instrumentos dependiendo de una evidencia]
     * @param  [int] $id_evidencia
     * @return [int] lista de instrumentos
     */
    public function obtenerInstrumento($id_evidencia){
        $sql = 'SELECT * FROM doc_instru_evaluacion WHERE fk_evidencia = '.$id_evidencia;
        $pregunta = $this->runSQL($sql);
        return $pregunta;
    }
    /**
     * [obtenerTipoRespuesta OBTIENE LOS TIPOS DE REPUESTA EN GENERAL]
     * @return [INT] lista de tipos de repueesta
     */
    public function obtenerTipoRespuesta(){
        $sql = 'SELECT * FROM tipo_respuesta WHERE estado = "1"';
        $tipoRespuesta = $this->runSQL($sql);
        return $tipoRespuesta;
    }
    /**
     * [cargarGrupoInteres obtiene los grupos de interes]
     * @return [int] lista de grupo interes
     */
    public function cargarGrupoInteres(){
        $sql = 'SELECT * FROM cna_grupo_interes WHERE pk_grupo_interes = 7 OR pk_grupo_interes = 8 AND  estado = 1';
        $Respuesta = $this->runSQL($sql);
        return $Respuesta;
    }
    /**
     * [obtenerOpciones lista de opciones de los tipos de repuestas]
     * @param  [int] $id_pregunta
     * @return [int] lista de opciones
     */
    public function obtenerOpciones($id_pregunta){
        $sql = 'SELECT * FROM doc_respuesta_pregunta WHERE tipo_respuesta = "'.$id_pregunta.'" AND estado = 1';
        $Respuesta = $this->runSQL($sql);
        return $Respuesta;
    }
    /**
     * [obtenerProcesos obtiene la lista de los procesos]
     * @return [int] lista de procesos
     */
    public function obtenerProcesos(){
        $sql = 'SELECT cp.* , sp.`nombre` AS nombre_programa, ss.`nombre` AS nombreSede FROM cna_proceso cp, sad_programa sp, sad_sede ss WHERE sp.`pk_programa` = cp.`fk_programa`  AND ss.`pk_sede` = cp.`fk_sede`  ';
        $pregunta = $this->runSQL($sql);
        return $pregunta;
    }
    /**
     * [cargarDocumentosProceso carga los documentos de cada proceso segun las evidencias]
     * @param  [int] $id_proceso
     * @param  [int] $evidencia
     * @param  [int] $grupo
     * @return [int] lista de documentos
     */
    public function cargarDocumentosProceso($id_proceso , $evidencia, $grupo){
        if($grupo == 1){
            $sql = 'SELECT die.`descripcion`, dd.`fk_instrueval` , dd.`pk_documento` , dd.`nombre` , dd.`url` ,dd.`fecha`, die.`fk_evidencia` , ce.`nombre`AS nombre_evidencia FROM doc_documento dd , cna_proceso cp , doc_instru_evaluacion die , cna_evidencia ce WHERE dd.fk_programa = cp.`fk_programa` AND  dd.`fk_instrueval` = die.`pk_instru_evaluacion` AND die.`fk_evidencia` = ce.`pk_evidencia` AND cp.`pk_proceso` = "'.$id_proceso.'"  AND die.`fk_evidencia` = "'.$evidencia.'" and dd.`estado` = 1 ';
        }else{
            $sql = 'SELECT die.`descripcion`, dd.`fk_instrueval` , dd.`pk_documento` , dd.`nombre` , dd.`url` ,dd.`fecha`, die.`fk_evidencia` , ce.`nombre`AS nombre_evidencia FROM doc_documento dd , cna_proceso cp , doc_instru_evaluacion die , cna_evidencia ce WHERE dd.`fk_instrueval` = die.`pk_instru_evaluacion` AND die.`fk_evidencia` = ce.`pk_evidencia` AND dd.`fk_proceso` = 0 AND die.`fk_evidencia` = "'.$evidencia.'" AND dd.`estado` = 1 ';
        }
        $pregunta = $this->runSQL($sql);
        return $pregunta;
    }
    
    /**
     * [runSQL conexion base de datos]
     * @param  [int] $sql
     * @return [int] estado 1-0
     */
    private function runSQL($sql){
        $resultado = $this->adoDB->conectarAdo($sql);
        return $resultado;
    }
}

?>