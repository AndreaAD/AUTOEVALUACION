<?php

class Inicio_Model {
    //se conecta a la clase ado
    public function conectar()
    {
        global $conexion;
        include("../BaseDatos/PLM_AdoDB_Inicio.php");
        
        $conexion = new PLM_Ado();
        
    }
    //busca la cantidad de actibidades
    public function buscarActividades($intProceso) {
        
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "SELECT 'Numero de Actividades de mejoramiento', count(*) FROM plm_actividades WHERE fk_proceso = $intProceso;";
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $proceso[][] = array();
       
        $i=0;
        while(!$recordSet->EOF) {        
            $proceso[$i][0]=$recordSet->fields[0];
            $proceso[$i][1]=$recordSet->fields[1];
            $recordSet->MoveNext();
            $i++;
        }
        return $proceso; 
    }
    
    
       //busca la calificacion de un factor
    function buscaCalFac($intIdProce)
    {
        global $conexion;
        $conexion->conectarAdo();
        $cadena = "SELECT A.nombre, B.calificacion 
                    FROM cna_factor A, plm_factor_proceso B 
                    WHERE A.pk_factor = B.fk_factor AND B.fk_proceso = $intIdProce;";
              
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();   
        
        
        $arrFactor[][]=array();
        $i=0;
        while(!$recordSet->EOF)
        {        
            $arrFactor[$i][0]=$recordSet->fields[0];
            $arrFactor[$i][1]=$recordSet->fields[1];
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $arrFactor;         
    }
}
    
?>