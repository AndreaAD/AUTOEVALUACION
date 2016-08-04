<?php

class Sede{
    
    function Ver(){
                
        $conexion = new Ado();
        
        $fk_sede = $_SESSION['sad_fk_sede'];
        $fk_facultad = $_SESSION['sad_fk_facultad'];
        $fk_programa = $_SESSION['sad_fk_programa'];
        
        if($fk_sede == 1 && $fk_facultad == 1 && $fk_programa == 1){
            $cadena = " SELECT 
                            * 
                        FROM 
                            sad_sede
                        "; 
        }
        else{
            $cadena = " SELECT 
                            * 
                        FROM 
                            sad_sede
                        WHERE
                            pk_sede = $fk_sede;
                        "; 
        }
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    function Ver_X_Sede($_Datos){
              
        $pk_sede = $_Datos['radio'];
          
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        * 
                    FROM 
                        sad_sede               	
                	WHERE
                	   pk_sede = '$pk_sede'
                    "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    function Agregar($_Datos){
        
        $nombre = $_Datos['nombre'];
        $descripcion = $_Datos['descripcion'];
        
        $conexion = new Ado();
        
        $cadena = " INSERT INTO 
                        sad_sede 
                    	(pk_sede, 
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
        
        $mensaje = "Se a agregado correctamente la nueva sede : ".$nombre;
        
        return $mensaje;
        
    }
    
    function Modificar($_Datos){
        
        $pk_sede = $_Datos['pk_sede'];
        $nombre = $_Datos['nombre'];
        $descripcion = $_Datos['descripcion'];
        
        $conexion = new Ado();
        
        $cadena = " UPDATE 
                        sad_sede 
                	SET
                    	pk_sede = pk_sede , 
                    	nombre = '$nombre' , 
                    	descripcion = '$descripcion' , 
                    	estado = estado                	
                	WHERE
                	   pk_sede = '$pk_sede'
                    "; 
        
        $conexion->conectarAdo($cadena);
        
        $mensaje = "Se a modificado correctamente la sede : ".$nombre;
        
        return $mensaje;
        
    }
    
    function CambiarEstado($_Datos){
        
        $conexion = new Ado();
        
        $pk_sede = $_Datos['radio'];
        
        $cadena = " SELECT
                        * 
                	FROM
                	   sad_sede               	
                	WHERE
                	   pk_sede = $pk_sede "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        while(!$recordSet->EOF){
            
            $estado = $recordSet->fields['estado'];
            $nombre = $recordSet->fields['nombre'];
            
            $recordSet->MoveNext(); 
            
        }     
        
        if($estado == "1"){
        
            $cadena = " UPDATE 
                            sad_sede 
                    	SET
                        	pk_sede = pk_sede , 
                        	nombre = nombre , 
                        	descripcion = descripcion , 
                        	estado = 0                	
                    	WHERE
                    	   pk_sede = '$pk_sede' 
                        "; 
                       
        }
        else{
            $cadena = " UPDATE
                            sad_sede 
                    	SET
                        	pk_sede = pk_sede , 
                        	nombre = nombre , 
                        	descripcion = descripcion , 
                        	estado = 1                	
                    	WHERE
                    	   pk_sede = '$pk_sede' 
                        ";
        }
        
        $conexion->conectarAdo($cadena);        
        
        $mensaje = "Se a cambiado el estado correctamente de la sede : ".$nombre;
        
        return $mensaje;
        
    }
    
}  
  
?>