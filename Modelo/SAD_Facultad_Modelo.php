<?php

class Facultad{
    
    function Ver(){
                
        $conexion = new Ado();
        
        $fk_sede = $_SESSION['sad_fk_sede'];
        $fk_facultad = $_SESSION['sad_fk_facultad'];
        $fk_programa = $_SESSION['sad_fk_programa'];
        
        if($fk_sede == 1 && $fk_facultad == 1 && $fk_programa == 1){
            $cadena = " SELECT 
                            * 
                        FROM 
                            sad_facultad
                        "; 
        }
        else{
            $cadena = " SELECT 
                            * 
                        FROM 
                            sad_facultad
                        WHERE
                            pk_facultad = $fk_facultad
                        ";
        }
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    function Ver_X_Facultad($_Datos){
              
        $pk_facultad = $_Datos['radio'];
          
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        * 
                    FROM 
                        sad_facultad               	
                	WHERE
                	   pk_facultad = '$pk_facultad'
                    "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    function Agregar($_Datos){
        
        $nombre = $_Datos['nombre'];
        $descripcion = $_Datos['descripcion'];
        
        $conexion = new Ado();
        
        $cadena = " INSERT INTO 
                        sad_facultad 
                    	(pk_facultad, 
                    	nombre, 
                    	descripcion, 
                    	estado)
                	VALUES
                    	('0', 
                    	'$nombre', 
                    	'$descripcion', 
                    	'1')
                    "; 
        
        $conexion->conectarAdo($cadena);
        
        $mensaje = "Se a agregado correctamente la nueva facultad : ".$nombre;
        
        return $mensaje;
        
    }
    
    function Modificar($_Datos){
        
        $pk_facultad = $_Datos['pk_facultad'];
        $nombre = $_Datos['nombre'];
        $descripcion = $_Datos['descripcion'];
        
        $conexion = new Ado();
        
        $cadena = " UPDATE 
                        sad_facultad 
                	SET
                    	pk_facultad = pk_facultad , 
                    	nombre = '$nombre' , 
                    	descripcion = '$descripcion' , 
                    	estado = estado                	
                	WHERE
                	   pk_facultad = '$pk_facultad'
                    "; 
        
        $conexion->conectarAdo($cadena);
        
        $mensaje = "Se a modificado correctamente la facultad : ".$nombre;
        
        return $mensaje;
        
    }
    
    function CambiarEstado($_Datos){
        
        $conexion = new Ado();
        
        $pk_facultad = $_Datos['radio'];
        
        $cadena = " SELECT
                        * 
                	FROM
                	   sad_facultad               	
                	WHERE
                	   pk_facultad = $pk_facultad "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        while(!$recordSet->EOF){
            
            $estado = $recordSet->fields['estado'];
            $nombre = $recordSet->fields['nombre'];
            
            $recordSet->MoveNext(); 
            
        }     
        
        if($estado == "1"){
        
            $cadena = " UPDATE 
                            sad_facultad 
                    	SET
                        	pk_facultad = pk_facultad , 
                        	nombre = nombre , 
                        	descripcion = descripcion , 
                        	estado = 0                	
                    	WHERE
                    	   pk_facultad = '$pk_facultad' 
                        "; 
                       
        }
        else{
            $cadena = " UPDATE
                            sad_facultad 
                    	SET
                        	pk_facultad = pk_facultad , 
                        	nombre = nombre , 
                        	descripcion = descripcion , 
                        	estado = 1                	
                    	WHERE
                    	   pk_facultad = '$pk_facultad' 
                        ";
        }
        
        $conexion->conectarAdo($cadena);        
        
        $mensaje = "Se a cambiado el estado correctamente de la facultad : ".$nombre;
        
        return $mensaje;
        
    }
    
}  
  
?>