<?php
class HistoricosFactorModel
{
    function conectar()
    {
        global $conexion;
        include("../BaseDatos/PLM_AdoDB.php");
        
        $conexion = new Ado();   
    }
    //busca solo los procesos consedidos a este usuario
    //y solo los procesos cerrados  
    function buscarProcesos($_idUsuario)
    {
        global $conexion;
        $conexion->conectarAdo();
       
        $cadena = " SELECT A.pk_proceso, A.nombre, A.fecha_inicio, A.fecha_fin, A.descripcion, A.observacion 
                    FROM cna_proceso A, sad_usuario B, cna_fase C, sad_proceso_usuario D
                    WHERE B.pk_usuario = $_idUsuario AND
                    A.fk_fase = C.pk_fase AND
                    D.fk_proceso = A.pk_proceso AND
                    D.fk_usuario = B.pk_usuario AND 
                    A.pk_proceso = D.fk_proceso AND 
                    C.pk_fase = 1;"; 
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $proce[] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $proce[$i][0]=$recordSet->fields[0];
            $proce[$i][1]=$recordSet->fields[1];
            $proce[$i][2]=$recordSet->fields[2]; 
            $proce[$i][3]=$recordSet->fields[3];
            $proce[$i][4]=$recordSet->fields[4]; 
            $proce[$i][5]=$recordSet->fields[5]; 
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $proce;    
    }
    
    //busca todos los factores existentes
    function buscaFactor()
    {
        
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM cna_factor WHERE estado = 1 ;"; 
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $factor[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $factor[$i][0]=$recordSet->fields[0];
            $factor[$i][1]=$recordSet->fields[1];
            $factor[$i][2]=$recordSet->fields[2]; 
            $factor[$i][3]=$recordSet->fields[3]; 
            $factor[$i][4]=$recordSet->fields[4]; 
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $factor; 
    }
    
    //busca los factores  y su calificacion de un proceso en especifico
    function buscaProceCal( $Id_proceso )
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "SELECT A.fk_factor, A.calificacion, B.fecha_inicio, B.nombre, C.nombre, B.pk_proceso
                   FROM plm_factor_proceso A, cna_proceso B, sad_sede C
                   WHERE A.fk_proceso = B.pk_proceso AND
                         B.pk_proceso = $Id_proceso AND C.pk_sede = B.fk_sede;"; 
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $factor[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $factor[$i][0]=$recordSet->fields[0];
            $factor[$i][1]=$recordSet->fields[1];
            $factor[$i][2]=$recordSet->fields[2];
            $factor[$i][3]=$recordSet->fields[3];
            $factor[$i][4]=$recordSet->fields[4];
            $factor[$i][5]=$recordSet->fields[5];
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $factor; 
    }
    
}


?>