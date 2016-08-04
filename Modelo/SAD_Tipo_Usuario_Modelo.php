<?php

class Tipo_Usuario{
    
    function Ver(){
                
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        * 
                    FROM 
                        sad_tipo_usuario
                    "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    function Ver_X_Tipo_Usuario($_Datos){
                
        $conexion = new Ado();
        
        $pk_tipo_usuario = $_Datos['radio'];
        
        $cadena = " SELECT 
                        * 
                    FROM 
                        sad_tipo_usuario
                    WHERE
                        pk_tipo_usuario = '$pk_tipo_usuario'
                    "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    function Ver_X_Usuario($_Datos){
             
        $conexion = new Ado();
        
        $pk_usuario = $_Datos['radio'];
        
        $cadena = " SELECT 
                        tip_usu.* 
                    FROM 
                        sad_tipo_usuario tip_usu,
                        sad_usuario_tipo_usuario usu_tip
                    WHERE
                            usu_tip.fk_usuario = $pk_usuario
                        AND
                            usu_tip.fk_tipo_usuario = tip_usu.pk_tipo_usuario
                    "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        $arrayDatos = array();
        
        while(!$recordSet->EOF){
            
            $arrayDatos[] = array(
                            "pk_tipo_usuario"=>$recordSet->fields['pk_tipo_usuario'],
                            "nombre"=>$recordSet->fields['nombre']
                            );
            
            $recordSet->MoveNext();
        }
        
        return $arrayDatos;       
        
    }
    
    function Agregar($_Datos){
        
        $nombre = $_Datos['nombre'];
        $descripcion = $_Datos['descripcion'];
        
        $conexion = new Ado();
        
        $cadena = " INSERT INTO 
                        sad_tipo_usuario 
                        (pk_tipo_usuario,  
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
        
        $mensaje = "Se a agregado el nuevo Tipo de Usuario correctamente con el nombre ".$nombre;
        
        return $mensaje;
        
    }
    
    function CambiarEstado($_Datos){
        
        $conexion = new Ado();
        
        $pk_tipo_usuario = $_Datos['radio'];
        
        $cadena = " SELECT
                        * 
                    FROM 
                        sad_tipo_usuario               	
                	WHERE
                	   pk_tipo_usuario = $pk_tipo_usuario "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        while(!$recordSet->EOF){
            
            $estado = $recordSet->fields['estado'];
            $nombre = $recordSet->fields['nombre'];
            
            $recordSet->MoveNext(); 
            
        }     
        
        if($estado == "1"){
        
            $cadena = " UPDATE 
                            sad_tipo_usuario 
                    	SET
                        	pk_tipo_usuario = pk_tipo_usuario , 
                        	nombre = nombre , 
                        	descripcion = descripcion , 
                        	estado = 0                	
                    	WHERE
                    	   pk_tipo_usuario = '$pk_tipo_usuario' 
                        "; 
                       
        }
        else{
            $cadena = " UPDATE
                            sad_tipo_usuario  
                    	SET
                        	pk_tipo_usuario = pk_tipo_usuario , 
                        	nombre = nombre , 
                        	descripcion = descripcion , 
                        	estado = 1                	
                    	WHERE
                    	   pk_tipo_usuario = '$pk_tipo_usuario' 
                        ";
        }
        
        $conexion->conectarAdo($cadena);        
        
        $mensaje = "Se a cambiado el estado correctamente al Tipo de Usuario ".$nombre;
        
        return $mensaje;
        
    }
    
    function Modificar($_Datos){
        
        $pk_tipo_usuario = $_Datos['pk_tipo_usuario'];
        $nombre = $_Datos['nombre'];
        $descripcion = $_Datos['descripcion'];
        
        $conexion = new Ado();
        
        $cadena = " UPDATE 
                        sad_tipo_usuario 
                	SET
                    	pk_tipo_usuario = pk_tipo_usuario, 
                    	nombre = '$nombre' , 
                    	descripcion = '$descripcion' , 
                    	estado = estado                	
                	WHERE
                	   pk_tipo_usuario = '$pk_tipo_usuario'
                    "; 
        
        $conexion->conectarAdo($cadena);
        
        $mensaje = "Se a modificado el tipo de usuario correctamente con el nombre ".$nombre;
        
        return $mensaje;
        
    }
    
}

?>