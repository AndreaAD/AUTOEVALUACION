<?php

class Caracteristica{
    
    function Ver(){
                
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        * 
                    FROM 
                        cna_caracteristica
                    "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    function Ver_X_Estado(){
                
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        * 
                    FROM 
                        cna_caracteristica
                    WHERE
                        estado = 1
                    "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    function Ver_Ambito(){
                
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        * 
                    FROM 
                        cna_ambito
                    "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    function Agregar_Ambito_X_Caracteristica($_Datos){
           
        $pk_ambito = $_Datos['pk_ambito'];
        
        $conexion = new Ado();
        
        $estado = "off";

        $cadena = " SELECT 
                        * 
                    FROM 
                        cna_proceso; ";
        
        $resSql = $conexion->conectarAdo($cadena);
        
        while(!$resSql->EOF){
            
            if($resSql->fields['fk_fase'] != "1"){
                $estado = "on";
            }
            
            $resSql->MoveNext();
        }
        
        if($estado == "off"){
            
            foreach($_Datos['check'] as $pk_caracteristica){
                 
            $cadena = " UPDATE 
                            cna_caracteristica 
                    	SET
                        	pk_caracteristica = pk_caracteristica , 
                        	nombre = nombre , 
                        	descripcion = descripcion , 
                        	estado = estado ,
                            fk_factor = fk_factor,
                            fk_ambito = '$pk_ambito'  
                    	WHERE
                    	   pk_caracteristica = '$pk_caracteristica'
                        "; 
            
            $conexion->conectarAdo($cadena);
            
            }
            
            $mensaje = "Se a modificado el ambito";
        
        }
        else{
            
            $mensaje = "Existe un proceso que esta en uso actualmente";
            
        }
          
        return $mensaje;
        
    }
    
    function Ver_X_Factor($datos){
        
        $pk_factor = $datos;
        
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        * 
                    FROM 
                        cna_caracteristica
                    WHERE 
                        fk_factor = '$pk_factor'
                    "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    function Ver_X_Caracteristica($datos){
             
        $pk_caracteristica = $datos['radio'];
        
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        carac.*,
                        fact.nombre AS nombre_factor
                    FROM 
                        cna_caracteristica carac,
                        cna_factor fact
                    WHERE 
                            carac.pk_caracteristica = '$pk_caracteristica'
                        AND
                            carac.fk_factor = fact.pk_factor
                    "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    function Agregar($_Datos){
        
        $nombre = $_Datos['nombre'];
        $descripcion = $_Datos['descripcion'];
        $fk_factor = $_SESSION["cna_idfactor"];
        
        $conexion = new Ado();
        
        $estado = "off";

        $cadena = " SELECT 
                        * 
                    FROM 
                        cna_proceso; ";
        
        $resSql = $conexion->conectarAdo($cadena);
        
        while(!$resSql->EOF){
            
            if($resSql->fields['fk_fase'] != "1"){
                $estado = "on";
            }
            
            $resSql->MoveNext();
        }
        
        if($estado == "off"){
            
            $cadena = " INSERT INTO 
                            cna_caracteristica 
                        	(pk_caracteristica, 
                        	nombre, 
                        	descripcion, 
                        	estado,
                            fk_factor,
                            fk_ambito)
                    	VALUES
                        	('0', 
                        	'$nombre', 
                        	'$descripcion', 
                        	'1',
                            '$fk_factor',
                            '4')
                        "; 
            
            $conexion->conectarAdo($cadena);
            
            $_SESSION["cna_idaspecto"] = null;
            $_SESSION["cna_idcaracteristica"] = null;
            $_SESSION["cna_idfactor"] = null;
            
            $mensaje = "Se a agregado correctamente la nueva caracteristica : ".$nombre;
        
        }
        else{
            
            $mensaje = "Existe un proceso que esta en uso actualmente";
            
        }
        
        return $mensaje;
        
    }
    
    function Modificar($_Datos){
        
        $pk_caracteristica = $_Datos['pk_caracteristica'];
        $nombre = $_Datos['nombre'];
        $descripcion = $_Datos['descripcion'];
        $fk_factor = $_SESSION["cna_idfactor"];
        
        $conexion = new Ado();
        
        $estado = "off";

        $cadena = " SELECT 
                        * 
                    FROM 
                        cna_proceso; ";
        
        $resSql = $conexion->conectarAdo($cadena);
        
        while(!$resSql->EOF){
            
            if($resSql->fields['fk_fase'] != "1"){
                $estado = "on";
            }
            
            $resSql->MoveNext();
        }
        
        if($estado == "off"){
            
            $cadena = " UPDATE 
                            cna_caracteristica 
                    	SET
                        	pk_caracteristica = pk_caracteristica , 
                        	nombre = '$nombre' , 
                        	descripcion = '$descripcion' , 
                        	estado = estado ,
                            fk_factor = '$fk_factor' ,
                            fk_ambito = fk_ambito 
                    	WHERE
                    	   pk_caracteristica = '$pk_caracteristica'
                        "; 
            
            $conexion->conectarAdo($cadena);
            
            $mensaje = "Se a modificado correctamente la caracteristica : ".$nombre;
        
        }
        else{
            
            $mensaje = "Existe un proceso que esta en uso actualmente";
            
        }
        
        return $mensaje;
        
    }
    
    function CambiarEstado($_Datos){
        
        $conexion = new Ado();
        
        $pk_caracteristica = $_Datos['radio'];
        
        $estado = "off";

        $cadena = " SELECT 
                        * 
                    FROM 
                        cna_proceso; ";
        
        $resSql = $conexion->conectarAdo($cadena);
        
        while(!$resSql->EOF){
            
            if($resSql->fields['fk_fase'] != "1"){
                $estado = "on";
            }
            
            $resSql->MoveNext();
        }
        
        if($estado == "off"){
            
            $cadena = " SELECT
                            * 
                    	FROM
                    	   cna_caracteristica               	
                    	WHERE
                    	   pk_caracteristica = $pk_caracteristica "; 
            
            $recordSet = $conexion->conectarAdo($cadena);
            
            while(!$recordSet->EOF){
                
                $estado = $recordSet->fields['estado'];
                $nombre = $recordSet->fields['nombre'];
                
                $recordSet->MoveNext(); 
                
            }     
            
            if($estado == "1"){
            
                $cadena = " UPDATE 
                                cna_caracteristica 
                        	SET
                            	pk_caracteristica = pk_caracteristica , 
                            	nombre = nombre , 
                            	descripcion = descripcion , 
                            	estado = 0 ,
                                fk_factor = fk_factor ,
                                fk_ambito = fk_ambito 
                        	WHERE
                        	   pk_caracteristica = '$pk_caracteristica' 
                            "; 
                           
            }
            else{
                $cadena = " UPDATE
                                cna_caracteristica 
                        	SET
                            	pk_caracteristica = pk_caracteristica , 
                            	nombre = nombre , 
                            	descripcion = descripcion , 
                            	estado = 1 ,
                                fk_factor = fk_factor ,
                                fk_ambito = fk_ambito          	
                        	WHERE
                        	   pk_caracteristica = '$pk_caracteristica' 
                            ";
            }
            
            $conexion->conectarAdo($cadena);        
            
            $mensaje = "Se a cambiado correctamente el estado de la caracteristica : ".$nombre;
        
        }
        else{
            
            $mensaje = "Existe un proceso que esta en uso actualmente";
            
        }
        
        return $mensaje;
        
    }
    
}

?>