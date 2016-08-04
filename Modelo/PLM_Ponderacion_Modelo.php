<?php
class PonderaModelo
{
    //funcion para conectarse a la base dedatos
    function conectar()
    {
        global $conexion;
        include("../BaseDatos/PLM_AdoDB.php");
        
        $conexion = new Ado();
        
    }
    
    //musca las razones habilitadas
    function buscarRazon($pk_proceso, $pk_factor)
    {
         global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "SELECT razon FROM plm_factor_proceso WHERE fk_proceso= $pk_proceso and fk_factor = $pk_factor;"; 
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $strRazon = "";
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $strRazon=$recordSet->fields[0];
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $strRazon; 
    }
    //busca un proceso de una ususario
    function buscarProceso($intIdProceso, $intIdUsuario)
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "                          
                    SELECT G.nombre, C.nombre, B.nombre, A.fecha_inicio, CONCAT( E.nombre,' ', E.apellido) AS nombre
                    FROM cna_proceso A, sad_sede B, sad_programa C, cna_fase D,
                         sad_usuario E, sad_proceso_usuario F, sad_facultad G, sad_usuario_tipo_usuario H, sad_tipo_usuario I
                    WHERE A.pk_proceso = $intIdProceso AND
                          A.fk_programa = C.pk_programa  AND
                          A.fk_sede = B.pk_sede AND
                          D.pk_fase = A.fk_fase AND 
                          D.pk_fase = 5 AND
                          E.pk_usuario = F.fk_usuario  AND
                          A.pk_proceso = F.fk_proceso AND
                          E.fk_programa = C.pk_programa AND
                          G.pk_facultad = C.fk_facultad AND
                          E.pk_usuario = H.fk_usuario AND
                          H.fk_tipo_usuario = I.pk_tipo_usuario AND
                          I.pk_tipo_usuario = 4  ;";
                          
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $proce[] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $proce[0]=$recordSet->fields[0];
            $proce[1]=$recordSet->fields[1];
            $proce[2]=$recordSet->fields[2]; 
            $proce[3]=$recordSet->fields[3]; 
            $proce[4]=$recordSet->fields[4];
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $proce;    
    }
    
    
    //busca los factores
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
            $factor[$i][5]=$recordSet->fields[5]; 
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $factor; 
    } 
    
    //busca factor por código
    function buscaFactorCod($intIdfac)
    {        
        
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM cna_factor WHERE estado = 1 and pk_factor= $intIdfac;"; 
        
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
    
    //buscar las caracteristicas de un factor de la base de datos CNA
    function buscarCarac($intIdFac, $intIdProce)
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "SELECT 
         A.pk_caracteristica, A.nombre, A.descripcion, A.codigo
         FROM cna_caracteristica A 
         WHERE A.estado = 1 AND A.fk_factor = $intIdFac ;"; 
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $carac[][] = array();
        $i=0;
            while(!$recordSet->EOF)
            {        
                $carac[$i][0]=$recordSet->fields[0];
                $carac[$i][1]=$recordSet->fields[1];
                $carac[$i][2]=$recordSet->fields[2]; 
                $carac[$i][3]=$recordSet->fields[3]; 
                $recordSet->MoveNext();
                $i++;
            }       
        
        
        return $carac; 
    }
    
    //guarda el análisis causal 
    function guardarCalCarac($intIdProceso,$intIdFactor, $intIdCarac,$floPondeCarac)
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "INSERT INTO plm_caracteristica_proceso
                  (fk_caracteristica, fk_proceso, ponderacion, fortaleza, debilidad, analisis, fk_factor) 
                  VALUES ($intIdCarac, $intIdProceso, $floPondeCarac, '','', '', $intIdFactor);"; 
        
        $conexion->Ejecutar($cadena);
        
        $conexion->Close();
    }
    
    //modifica una catacterística y su calificación 
    function modCalCarac($intIdProceso,$intIdFactor, $intIdCarac,$floPondeCarac)
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "
                UPDATE plm_caracteristica_proceso 
            	SET
                
            	ponderacion = $floPondeCarac
            	
            	WHERE
            	fk_caracteristica = $intIdCarac  AND
                fk_proceso = $intIdProceso AND
                fk_factor = $intIdFactor;";
        $conexion->Ejecutar($cadena);
        
        $conexion->Close();
    }
    
    //guarada la razón de un factor
    function guardarRazFac($intIdProceso,$intIdFactor,$strRazon)
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "INSERT INTO plm_factor_proceso
                  (fk_factor, fk_proceso, razon) 
                  VALUES ($intIdFactor, $intIdProceso, '$strRazon');"; 
        
        $conexion->Ejecutar($cadena);
        
        $conexion->Close();
    }
    
    //modifica la razón de un factor
    function modificarRazFac($intIdProceso,$intIdFactor,$strRazon)
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena ="UPDATE plm_factor_proceso
                  SET 
                  razon = '$strRazon'
                  WHERE 
                  fk_proceso = $intIdProceso AND 
                  fk_factor = $intIdFactor;";
        
        
        $conexion->Ejecutar($cadena);
        
        $conexion->Close();
    }
    
    //busca la razón de un factor
    function buscarRazFac($intIdProceso,$intIdFactor)
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM plm_factor_proceso WHERE fk_factor = $intIdFactor AND fk_proceso = $intIdProceso;"; 
    
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $fac[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $fac[$i][0]=$recordSet->fields[0];
            $fac[$i][1]=$recordSet->fields[1];
            $fac[$i][2]=$recordSet->fields[2]; 
            $fac[$i][3]=$recordSet->fields[3]; 
            $fac[$i][4]=$recordSet->fields[4]; 
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $fac; 
    }
    
    //busca la calificación de una característica
    function buscarCalCarac($intIdProceso,$intIdFactor, $intIdCarac)
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM plm_caracteristica_proceso WHERE fk_caracteristica = $intIdCarac AND fk_proceso = $intIdProceso AND fk_factor = $intIdFactor;"; 
    
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $carac[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $carac[$i][0]=$recordSet->fields[0];
            $carac[$i][1]=$recordSet->fields[1];
            $carac[$i][2]=$recordSet->fields[2]; 
            $carac[$i][3]=$recordSet->fields[3]; 
            $carac[$i][4]=$recordSet->fields[4]; 
            $carac[$i][5]=$recordSet->fields[5]; 
            $carac[$i][6]=$recordSet->fields[6]; 
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $carac; 
    }
    
    //modifica la calificación de una característica  
    function modificarCalCarac($intIdProceso,$intIdFactor, $intIdCarac,$floPondeCarac)
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "UPDATE plm_caracteristica_proceso    
                  SET
                  ponderacion = $floPondeCarac
                  WHERE  
                  fk_caracteristica = $intIdCarac AND
                  fk_factor = $intIdFactor AND
                  fk_proceso = $intIdProceso;"; 
                  
        $conexion->Ejecutar($cadena);
        
        $conexion->Close();
    }
       
    
    //muestra las razones de un factor
    function traerRazon($intIdProce, $intIdFactor)
    {        
        
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "SELECT B.razon
                FROM cna_factor A, plm_factor_proceso B 
                WHERE A.pk_factor = B.fk_factor AND B.fk_proceso = $intIdProce AND
                A.pk_factor = $intIdFactor;"; 
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $factor[] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $factor[$i]=$recordSet->fields[0];
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $factor; 
    }
    
    //busca las ponderaciones de las caracteristicas de un factor
    function buscarCaracPonde($intIdFactor, $intIdProce)
    {
        global $conexion;
        $conexion->conectarAdo();
        $cadena = "SELECT A.pk_caracteristica, B.ponderacion 
                    FROM cna_caracteristica A, plm_caracteristica_proceso B 
                    WHERE A.pk_caracteristica = B.fk_caracteristica AND B.fk_proceso = $intIdProce AND
                    A.fk_factor = $intIdFactor AND A.fk_factor = B.fk_factor ORDER BY  A.pk_caracteristica ASC;";
              
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