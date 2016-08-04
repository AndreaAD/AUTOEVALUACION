<?php

class Rol{
    
    function Ver(){
                
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        * 
                    FROM 
                        sad_rol
                    "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    function Ver_X_Rol($datos){
             
        $pk_rol = $datos['radio'];
        
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        * 
                    FROM 
                        sad_rol 
                    WHERE 
                        pk_rol = '$pk_rol'
                    "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    function Ver_X_Pk_Rol($datos){
             
        $pk_rol = $datos['pk_rol'];
        
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        * 
                    FROM 
                        sad_rol 
                    WHERE 
                        pk_rol = '$pk_rol'
                    "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    function Agregar($_Datos){
        
        $nombre = $_Datos['nombre'];
        $descripcion = $_Datos['descripcion'];
        
        $conexion = new Ado();
        
        $cadena = " INSERT INTO 
                        sad_rol 
                    	(pk_rol, 
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
        
        $mensaje = "Se a agregado el nuevo rol correctamente con el nombre ".$nombre;
        
        return $mensaje;
        
    }
    
    function Modificar($_Datos){
        
        $pk_rol = $_Datos['pk_rol'];
        $nombre = $_Datos['nombre'];
        $descripcion = $_Datos['descripcion'];
        
        $conexion = new Ado();
        
        $cadena = " UPDATE 
                        sad_rol 
                	SET
                    	pk_rol = pk_rol , 
                    	nombre = '$nombre' , 
                    	descripcion = '$descripcion' , 
                    	estado = estado                	
                	WHERE
                	   pk_rol = '$pk_rol'
                    "; 
        
        $conexion->conectarAdo($cadena);
        
        $mensaje = "Se a modificado el rol correctamente con el nombre ".$nombre;
        
        return $mensaje;
        
    }
    
    function CambiarEstado($_Datos){
        
        $conexion = new Ado();
        
        $pk_rol = $_Datos['radio'];
        
        $cadena = " SELECT
                        * 
                	FROM
                	   sad_rol               	
                	WHERE
                	   pk_rol = $pk_rol "; 
        
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
                        	descripcion = descripcion , 
                        	estado = 0                	
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
    
    public function Agregar_Actividad_Rol($_Datos){
        
        $conexion = new Ado();
        
        $pk_rol = $_Datos['pk_rol'];
                
        $cadena = " SELECT
                        * 
                    FROM 
                        sad_rol 
                	WHERE
                	   pk_rol = '$pk_rol' "; //Realizamos una consulta
        
        $sqlResUsu = $conexion->conectarAdo($cadena);
        
        while(!$sqlResUsu->EOF) {
            
            $nombre = $sqlResUsu->fields['nombre'];     
            
            $sqlResUsu->MoveNext();
            
            }
                
        $cadena = " DELETE 
                    FROM 
                        sad_rol_actividades 
                	WHERE
                	   fk_rol = '$pk_rol' "; //Realizamos una consulta
        
        $conexion->conectarAdo($cadena);
        
        foreach($_Datos['check'] as $pk_actividad){
            
            $cadena = " INSERT INTO sad_rol_actividades 
                        	(fk_actividades, fk_rol)
                    	VALUES
                    	   ('$pk_actividad', '$pk_rol')"; //Realizamos una consulta
            
            $conexion->conectarAdo($cadena);
            
        };
     
        $mensaje = "Se a agregado correctamente las actividades al rol ".$nombre;
        
        return $mensaje;
           
    }
    
    public function Agregar_Usuario_Rol($_Datos){
        
        $conexion = new Ado();
        
        $pk_rol = $_Datos['pk_rol'];
                
        $cadena = " SELECT
                        * 
                    FROM 
                        sad_rol 
                	WHERE
                	   pk_rol = '$pk_rol' "; //Realizamos una consulta
        
        $sqlResUsu = $conexion->conectarAdo($cadena);
        
        while(!$sqlResUsu->EOF) {
            
            $nombre = $sqlResUsu->fields['nombre'];     
            
            $sqlResUsu->MoveNext();
            
            }
                
        $cadena = " UPDATE 
                        sad_usuario 
                	SET
                    	pk_usuario = pk_usuario , 
                    	cedula = cedula , 
                    	nombre = nombre , 
                    	apellido = apellido , 
                    	correo = correo , 
                    	usuario = usuario , 
                    	clave = clave , 
                    	estado = estado , 
                    	fk_rol = '1' , 
                    	fk_programa = fk_programa                	
                	WHERE
                        fk_rol = '$pk_rol'; "; //Realizamos una consulta
        
        $conexion->conectarAdo($cadena);
        
        foreach($_Datos['check'] as $pk_usuario){
            
            $cadena = " UPDATE 
                            sad_usuario 
                    	SET
                        	pk_usuario = pk_usuario , 
                        	cedula = cedula , 
                        	nombre = nombre , 
                        	apellido = apellido , 
                        	correo = correo , 
                        	usuario = usuario , 
                        	clave = clave , 
                        	estado = estado , 
                        	fk_rol = '$pk_rol' , 
                        	fk_programa = fk_programa                	
                    	WHERE
                            pk_usuario = '$pk_usuario';"; //Realizamos una consulta
            
            $conexion->conectarAdo($cadena);
            
        };
     
        $mensaje = "Se a agregado correctamente los usuarios al rol ".$nombre;
        
        return $mensaje;
           
    }
    
}

?>