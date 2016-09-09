<?php
error_reporting(0);
include_once 'SAD_Seguridad_Modelo.php';
include '../BaseDatos/AdoDB.php';

class InfoAdicional_Modelo {

	public $id;
	public $nombre;
	public $url;
	public $extension;
	public $fk_instrueval;
	public $fk_usuario;
	public $estado;
	public $tipo;
	public $adoDB;
	public $seg;


	public function __construct($id = 0 , $nombre = '', $url = '', $extension = '', $fk_instrueval = 0, $estado = 0 , $fk_usuario = "", $tipo = 0){
		$this->id = 0;
		$this->nombre = $nombre;
		$this->url = $url;
		$this->extension = $extension;
		$this->fk_instrueval = $fk_instrueval;
		$this->estado = $estado;
		$this->estadom = 3;
		$this->fk_usuario = $fk_usuario;
		$this->tipo = $tipo;
		$this->adoDB = new Ado(); 
		$this->seg = new Seguridad();
	}

	public function guardar(){
		$sql1 = 'UPDATE doc_informacion_adicional SET estado = "'.$this->estadom.'" WHERE estado = "2" AND fk_instrueval = '.$this->fk_instrueval;
		$sql = 'INSERT INTO doc_informacion_adicional (nombre, url, extension, fk_instrueval, estado ,fecha, fk_usuario ) VALUES ("'.$this->nombre.'" , "'.$this->url.'" , "'.$this->extension.'" , '.$this->fk_instrueval.', '.$this->estado.' , CURDATE() , '.$this->fk_usuario.')';
		$observacion =  'Se creo informacion adicional para el instrumento de evaluacion numero : "'.$this->fk_instrueval.'" '; 
        $transaccion = "Crear Informacion Adicional";
        $this->seg->Seguridad_Enviar($observacion, $transaccion);
		$this->runSQL($sql1);
		if($this->runSQL($sql)){
			return 1;
		}else{
			return 0;
		}	
	}

	public function guardarDocumento($fk_proceso){

		if ($fk_proceso == 0){
			$sql = 'INSERT INTO doc_documento (nombre, url, extension, fk_respuesta_instrumento, estado , fecha , fk_usuario , fk_programa , fk_proceso , fk_sede, tipo) VALUES ("'.$this->nombre.'" , "'.$this->url.'" , "'.$this->extension.'" , "'.$this->fk_instrueval.'" , "'.$this->estado.'" , CURDATE(), "'.$this->fk_usuario.'", "0", "0", "0" , "'.$this->tipo.'")';
			if($this->runSQL($sql)){
				return 1;
			}else{
				return 0;
			}
		}else{
			$sql1 = ' SELECT fk_sede FROM cna_proceso WHERE pk_proceso = "'.$fk_proceso.'" ';
			$resultados = $this->runSQL($sql1);
			$sede = $resultados->GetRows();
			$s = $sede[0]['fk_sede'];
			$sql0 = 'SELECT fk_programa FROM cna_proceso WHERE pk_proceso = "'.$fk_proceso.'" ';
			//$sql0 = 'SELECT fk_programa FROM sad_usuario WHERE pk_usuario = "'.$this->fk_usuario.'" ';
			$programa = $this->runSQL($sql0);
			$pro = $programa->GetRows();
			$sql = 'INSERT INTO doc_documento (nombre, url, extension, fk_respuesta_instrumento, estado , fecha , fk_usuario , fk_programa , fk_proceso , fk_sede, tipo) VALUES ("'.$this->nombre.'" , "'.$this->url.'" , "'.$this->extension.'" , "'.$this->fk_instrueval.'" , "'.$this->estado.'" , CURDATE(), "'.$this->fk_usuario.'", "'.$pro[0]['fk_programa'].'", "'.$fk_proceso.'" , "'.$s.'", "'.$this->tipo.'" )';
			
			$observacion =  'Se creo un documento para el instrumento de evaluacion numero : "'.$this->fk_instrueval.'" '; 
	        $transaccion = "Guardar Documentos";
	        $this->seg->Seguridad_Enviar($observacion, $transaccion);
			if($this->runSQL($sql)){
				return 1;
			}else{
				return 0;
			}
		}
		
	}

	public function buscarInformacion($fk_instrueval){
		$sql = 'SELECT * FROM doc_informacion_adicional WHERE fk_instrueval = '.$this->fk_instrueval.' and estado = 1';
		$documentos = $this->runSQL($sql);
		return $documentos;
	}

	public function eliminar($id){
		$sql = 'UPDATE doc_informacion_adicional SET estado = 2 WHERE  pk_infoAdicional = '.$this->id;
		$observacion =  'Se elimino la informacion adicional de el instrumento de evaluacion numero : "'.$this->fk_instrueval.'" '; 
	    $transaccion = "Eliminar Informacion Adicional";
	    $this->seg->Seguridad_Enviar($observacion, $transaccion);
		if($this->runSQL($sql)){
		 	return 1;
		}else{
			return 0;
		}
	}

	public function consultar(){
		$sql = 'UPDATE doc_informacion_adicional SET descripcion = "'.$this->descripcion.'" WHERE pk_instru_evaluacion = '.$this->id;
		return $this->runSQL($sql);
		// if($this->runSQL($sql)){
		// 	return 1;
		// }else{
		// 	return 0;
		// }
	}

	public function obtenerIdDocumento($nombre){
		$sql = 'SELECT pk_documento FROM doc_documento WHERE nombre = "'.$nombre.'"';
		return $this->runSQL($sql);
	}

	public function eliminarDoc($id_documento){
		$sql = 'UPDATE doc_documento SET estado = 0 WHERE pk_documento = "'.$id_documento.'" ';
		$observacion =  'Se elimino el documento con id : "'.$id_documento.'" '; 
	    $transaccion = "Eliminar Documento";
	    $this->seg->Seguridad_Enviar($observacion, $transaccion);
		if($this->runSQL($sql)){
		 	return 1;
		}else{
			return 0;
		}
	}

	public function cargarDocumentosEmergente($id_instru, $sesion, $fk_usuario){
		$sql0 = 'SELECT fk_programa FROM sad_usuario WHERE pk_usuario = "'.$fk_usuario.'" ';
		$programa = $this->runSQL($sql0);
		$pro = $programa->GetRows();
		$sql1 = 'SELECT fk_sede FROM sad_programa WHERE pk_programa = "'.$pro[0]['fk_programa'].'" ';
		$sede = $this->runSQL($sql1);
		$s = $sede->GetRows();

		if($sesion == 0){
			$sql = 'SELECT * FROM doc_documento WHERE fk_instrueval = "'.$id_instru.'" AND (fk_proceso = 0) AND fk_programa = "0" AND estado = 1 and tipo = 2';
		}else{
			$sql = 'SELECT dc.* FROM doc_documento dc WHERE NOT EXISTS (SELECT * FROM doc_documento dd WHERE dd.`fk_instrueval` = "'.$id_instru.'" AND dd.`fk_proceso` = "'.$sesion.'" AND dd.`nombre` = dc.`nombre`) AND dc.`fk_instrueval` = "'.$id_instru.'" AND (dc.`fk_proceso` <> "0" AND dc.`fk_proceso` <> "'.$sesion.'") AND dc.`fk_programa` = "'.$pro[0]['fk_programa'].'" AND dc.`fk_sede` = "'.$s[0]['fk_sede'].'" AND dc.`estado` = 1 and dc.estado = 2 ';
		}
		$documentos = $this->runSQL($sql);
		return $documentos;
	}

	private function runSQL($sql){
        $resultado = $this->adoDB->conectarAdo($sql);
        return $resultado;
    }
}
?>