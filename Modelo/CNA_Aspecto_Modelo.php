<?php

class Aspecto{
    
    function Ver(){
        
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        aspe.*,
                        fact.pk_factor AS fk_factor
                    FROM 
                        cna_aspecto aspe,
                        cna_caracteristica cara,
                        cna_factor fact
                    WHERE 
                            aspe.fk_caracteristica = cara.pk_caracteristica
                        AND
                            cara.fk_factor = fact.pk_factor
                    "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    function Ver_X_Caracteristica($_Datos){
        
        $pk_caracteristica = $_Datos;
        
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        * 
                    FROM 
                        cna_aspecto
                    WHERE 
                        fk_caracteristica = '$pk_caracteristica'
                    "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    function Ver_X_Aspecto($_Datos){
        
        $pk_aspecto = $_Datos['radio'];
        
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        aspe.*,
                        cara.nombre AS nombre_caracteristica,
                        fact.nombre AS nombre_factor,
                        fact.pk_factor AS fk_factor
                    FROM 
                        cna_aspecto aspe,
                        cna_caracteristica cara,
                        cna_factor fact
                    WHERE 
                            aspe.pk_aspecto = '$pk_aspecto'
                        AND
                            aspe.fk_caracteristica = cara.pk_caracteristica
                        AND
                            cara.fk_factor = fact.pk_factor
                    "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    function Agregar($_Datos){
        
        $nombre = $_Datos['nombre'];
        $descripcion = $_Datos['descripcion'];
        $pk_caracteristica = $_SESSION["cna_idcaracteristica"];
        
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
                            cna_aspecto 
                        	(pk_aspecto, 
                        	nombre, 
                        	descripcion, 
                        	estado,
                            fk_caracteristica)
                    	VALUES
                        	('0', 
                        	'$nombre', 
                        	'$descripcion', 
                        	'1',
                            '$pk_caracteristica')
                        "; 
            
            $conexion->conectarAdo($cadena);
            
            $_SESSION["cna_idaspecto"] = null;
            $_SESSION["cna_idcaracteristica"] = null;
            $_SESSION["cna_idfactor"] = null;
            
            $mensaje = "Se a agregado correctamente el nuevo aspecto : ".$nombre;
        
        }
        else{
            
            $mensaje = "Existe un proceso que esta en uso actualmente";
            
        }
        
        return $mensaje;
        
    }
    
    function Modificar($_Datos){
        
        $pk_aspecto = $_Datos['pk_aspecto'];
        $nombre = $_Datos['nombre'];
        $descripcion = $_Datos['descripcion'];
        $fk_caracteristica = $_SESSION["cna_idcaracteristica"];
        
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
                            cna_aspecto 
                    	SET
                        	pk_aspecto = pk_aspecto , 
                        	nombre = '$nombre' , 
                        	descripcion = '$descripcion' , 
                        	estado = estado ,
                            fk_caracteristica = '$fk_caracteristica'  
                    	WHERE
                            pk_aspecto = '$pk_aspecto'
                        "; 
            
            $conexion->conectarAdo($cadena);
            
            $mensaje = "Se a modificado correctamente el aspecto : ".$nombre;
        
        }
        else{
            
            $mensaje = "Existe un proceso que esta en uso actualmente";
            
        }
        
        return $mensaje;
        
    }
    
    function CambiarEstado($_Datos){
        
        $conexion = new Ado();
        
        $pk_aspecto = $_Datos['radio'];
        
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
                    	   cna_aspecto               	
                    	WHERE
                    	   pk_aspecto = $pk_aspecto "; 
            
            $recordSet = $conexion->conectarAdo($cadena);
            
            while(!$recordSet->EOF){
                
                $estado = $recordSet->fields['estado'];
                $nombre = $recordSet->fields['nombre'];
                
                $recordSet->MoveNext(); 
                
            }     
            
            if($estado == "1"){
            
                $cadena = " UPDATE 
                                cna_aspecto 
                        	SET
                            	pk_aspecto = pk_aspecto , 
                            	nombre = nombre , 
                            	descripcion = descripcion , 
                            	estado = 0 ,
                                fk_caracteristica = fk_caracteristica  
                        	WHERE
                                pk_aspecto = '$pk_aspecto' 
                            "; 
                           
            }
            else{
                $cadena = " UPDATE 
                                cna_aspecto 
                        	SET
                            	pk_aspecto = pk_aspecto , 
                            	nombre = nombre , 
                            	descripcion = descripcion , 
                            	estado = 1 ,
                                fk_caracteristica = fk_caracteristica  
                        	WHERE
                                pk_aspecto = '$pk_aspecto' 
                            ";
            }
            
            $conexion->conectarAdo($cadena);        
            
            $mensaje = "Se a cambiado correctamente el estado del aspecto : ".$nombre;
        
        }
        else{
            
            $mensaje = "Existe un proceso que esta en uso actualmente";
            
        }
        
        return $mensaje;
        
    }
    
}
?>