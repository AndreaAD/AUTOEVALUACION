<?php

class Programa{
    
    function Ver(){
        
        $conexion = new Ado();
        
        $fk_sede = $_SESSION['sad_fk_sede'];
        $fk_facultad = $_SESSION['sad_fk_facultad'];
        $fk_programa = $_SESSION['sad_fk_programa'];
        
        if($fk_sede == 1 && $fk_facultad == 1 && $fk_programa == 1){
            $cadena = " SELECT 
                            * 
                        FROM 
                            sad_programa
                        "; 
        }
        else{
            $cadena = " SELECT 
                            * 
                        FROM 
                            sad_programa
                        WHERE
                            pk_programa = $fk_programa
                        ";
        }
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    function Ver_Sede_X_Facultad($_Datos){
        
        $sede = $_Datos['sede'];
        $facultad = $_Datos['facultad'];
        
        $conexion = new Ado();
        
        $cadena = " SELECT
                        prog.*,
                        sede.nombre AS nombre_sede
                    FROM 
                        sad_programa prog,
                        sad_sede sede
                    WHERE
                        sede.pk_sede = '$sede'
                    AND
                        prog.fk_sede = '$sede'
                    AND
                        prog.fk_facultad = $facultad "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    function Ver_X_Programa($_Datos){
             
        $pk_programa = $_Datos['radio'];
        
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        * 
                    FROM 
                        sad_programa 
                    WHERE 
                        pk_programa = '$pk_programa'
                    "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    function Agregar($_Datos){
        
        $nombre = $_Datos['nombre'];
        $descripcion = $_Datos['descripcion'];
        $pk_sede = $_Datos['sede'];
        $pk_facultad = $_Datos['facultad'];
        
        $conexion = new Ado();
        
        $cadena = " INSERT INTO 
                        sad_programa 
                    	(pk_programa, 
                    	nombre, 
                    	descripcion, 
                    	estado,
                        fk_facultad,
                        fk_sede)
                	VALUES
                    	('0', 
                    	'$nombre', 
                    	'$descripcion', 
                        '1',
                    	'$pk_facultad', 
                    	'$pk_sede'
                    	)
                    "; 
        
        $conexion->conectarAdo($cadena);
        
        $mensaje = "Se a agregado correctamente el Programa : ".$nombre;
        
        return $mensaje;
        
    }
    
    function Modificar($_Datos){
        
        $pk_programa = $_Datos['pk_programa'];
        $nombre = $_Datos['nombre'];
        $descripcion = $_Datos['descripcion'];
        $pk_sede = $_Datos['sede'];
        $pk_facultad = $_Datos['facultad'];
        
        $conexion = new Ado();
        
        $cadena = " UPDATE 
                        sad_programa 
                	SET
                    	pk_programa = pk_programa , 
                    	nombre = '$nombre' , 
                    	descripcion = '$descripcion' , 
                    	estado = estado,
                        fk_facultad = '$pk_facultad',
                        fk_sede = '$pk_sede'               	
                	WHERE
                	   pk_programa = '$pk_programa'
                    "; 
        
        $conexion->conectarAdo($cadena);
        
        $mensaje = "Se a modificado correctamente el Programa : ".$nombre;
        
        return $mensaje;
        
    }
    
    function CambiarEstado($_Datos){
        
        $conexion = new Ado();
        
        $pk_programa = $_Datos['radio'];
        
        $cadena = " SELECT
                        * 
                	FROM
                	   sad_programa               	
                	WHERE
                	   pk_programa = $pk_programa "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        while(!$recordSet->EOF){
            
            $estado = $recordSet->fields['estado'];
            $nombre = $recordSet->fields['nombre'];
            
            $recordSet->MoveNext(); 
            
        }     
        
        if($estado == "1"){
        
            $cadena = " UPDATE 
                            sad_programa 
                    	SET
                        	pk_programa = pk_programa , 
                        	nombre = nombre , 
                        	descripcion = descripcion , 
                        	estado = 0 ,
                            fk_facultad = fk_facultad,
                            fk_sede = fk_sede
                    	WHERE
                    	   pk_programa = '$pk_programa' 
                        "; 
                       
        }
        else{
            $cadena = " UPDATE
                            sad_programa 
                    	SET
                        	pk_programa = pk_programa , 
                        	nombre = nombre , 
                        	descripcion = descripcion , 
                        	estado = 1 ,
                            fk_facultad = fk_facultad,
                            fk_sede = fk_sede              	
                    	WHERE
                    	   pk_programa = '$pk_programa' 
                        ";
        }
        
        $conexion->conectarAdo($cadena);        
        
        $mensaje = "Se a cambiado el estado correctamente del Programa :  ".$nombre;
        
        return $mensaje;
        
    }
    
}

?>