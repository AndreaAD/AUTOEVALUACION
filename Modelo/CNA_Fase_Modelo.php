<?php

class Fase{
    
    function Ver(){
                
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        * 
                    FROM 
                        cna_fase
                    "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    function Ver_X_Fase($datos){
             
        $pk_fase = $datos['radio'];
        
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        * 
                    FROM 
                        cna_fase 
                    WHERE 
                        pk_fase = '$pk_fase'
                    "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    function Agregar($_Datos){
        
        $nombre = $_Datos['nombre'];
        $descripcion = $_Datos['descripcion'];
        
        $conexion = new Ado();
        
        $cadena = " INSERT INTO 
                        cna_fase 
                    	(pk_fase, 
                        nombre, 
                        descripcion)
                	VALUES
                    	('0', 
                    	'$nombre', 
                    	'$descripcion')
                    "; 
        
        $conexion->conectarAdo($cadena);
        
        $mensaje = "Se a agregado correctamente la fase : ".$nombre;
        
        return $mensaje;
        
    }
    
    function Modificar($_Datos){
        
        $pk_fase = $_Datos['pk_fase'];
        $nombre = $_Datos['nombre'];
        $descripcion = $_Datos['descripcion'];
        
        $conexion = new Ado();
        
        $cadena = " UPDATE 
                        cna_fase 
                	SET
                    	pk_fase = pk_fase , 
                    	nombre = '$nombre' , 
                    	descripcion = '$descripcion'            	
                	WHERE
                	   pk_fase = '$pk_fase'
                    "; 
        
        $conexion->conectarAdo($cadena);
        
        $mensaje = "Se a modificado correctamente la fase : ".$nombre;
        
        return $mensaje;
        
    }
    
    function CambiarEstado($_Datos){
        
        $conexion = new Ado();
        
        $pk_fase = $_Datos['radio'];
        
        $cadena = " SELECT
                        * 
                	FROM
                	   cna_fase               	
                	WHERE
                	   pk_fase = $pk_fase "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        while(!$recordSet->EOF){
            
            $estado = $recordSet->fields['estado'];
            $nombre = $recordSet->fields['nombre'];
            
            $recordSet->MoveNext(); 
            
        }     
        
        if($estado == "1"){
        
            $cadena = " UPDATE 
                            sad_rol 
                    	SET
                        	pk_rol = pk_rol , 
                        	nombre = nombre , 
                        	descripcion = descripcion               	
                    	WHERE
                    	   pk_rol = '$pk_rol' 
                        "; 
                       
        }
        else{
            $cadena = " UPDATE
                            sad_rol 
                    	SET
                        	pk_rol = pk_rol , 
                        	nombre = nombre , 
                        	descripcion = descripcion , 
                        	estado = 1                	
                    	WHERE
                    	   pk_rol = '$pk_rol' 
                        ";
        }
        
        $conexion->conectarAdo($cadena);        
        
        $mensaje = "Se a cambiado el estado correctamente al rol ".$nombre;
        
        return $mensaje;
        
    }
    
}
?>
