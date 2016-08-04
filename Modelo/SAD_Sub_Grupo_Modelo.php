<?php

class Sub_Grupo{
      
    public function Ver(){
        
        $conexion = new Ado();
        
        $cadena = " SELECT 	
                        *
                    FROM 
                    	sad_sub_grupo_actividades; "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
       
    public function Ver_X_Grupo($_Datos){
        
        $fk_grupo = $_Datos['fk_grupo'];
        
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        *
                    FROM 
                        sad_sub_grupo_actividades
                    WHERE
                        fk_grupos_actividades = '$fk_grupo'"; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
     
    public function Ver_X_Sub_Grupo($_Datos){
        
        $pk_sub_grupo = $_Datos['radio'];
        
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        *
                    FROM 
                        sad_sub_grupo_actividades
                    WHERE
                        pk_sub_grupo_actividades = '$pk_sub_grupo'"; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    public function Ver_Sub_Grupo_X_Actividad($_Datos){
        
        $pk_actividad = $_Datos['radio'];
        
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        *
                    FROM 
                        sad_actividades
                    WHERE
                        pk_actividades = '$pk_actividad'"; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        while(!$recordSet->EOF){
            
            $fk_grupo = $recordSet->fields['fk_sub_grupo_actividades'];
            
            $recordSet->MoveNext();
            
        }
        
        $cadena = " SELECT 
                        *
                    FROM 
                        sad_sub_grupo_actividades
                    WHERE
                        pk_sub_grupo_actividades = '$fk_grupo'"; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    function Agregar($Datos){
        
        $nombre = $Datos['nombre'];
        $fk_modulo = $Datos['fk_modulo'];
        $fk_grupo = $Datos['fk_grupo'];
        $url = $Datos['url'];
        $icono = $Datos['icono'];
        
        $conexion = new Ado();
        
        //SELECT MAX(codigo) FROM sad_grupos_actividades WHERE fk_modulo=1
        $cadena = " SELECT 
                        MAX(codigo) AS codigo 
                    FROM 
                        sad_sub_grupo_actividades 
                    WHERE 
                            fk_modulo = '$fk_modulo'
                        AND
                            fk_grupos_actividades = '$fk_grupo';";
        
        $resSql = $conexion->conectarAdo($cadena);
        
        while(!$resSql->EOF){
            
            $codigo = $resSql->fields['codigo'];
            
            $resSql->MoveNext();
            
        }
        
        $codigo += 1;
        
        
        $cadena = " INSERT INTO 
                        sad_sub_grupo_actividades 
                    	(pk_sub_grupo_actividades, 
                    	nombre, 
                    	url, 
                    	icono, 
                    	estado, 
                    	fk_modulo, 
                    	fk_grupos_actividades, 
                    	codigo)
                    VALUES
                    	(NULL, 
                    	'$nombre', 
                    	'$url', 
                    	'$icono', 
                    	'1', 
                    	'$fk_modulo', 
                    	'$fk_grupo', 
                    	'$codigo');"; 
        
        $conexion->conectarAdo($cadena);
        
        $mensaje = "Se a agregado el nuevo Sub Grupo correctamente con el nombre ".$nombre;
        
        return $mensaje;
        
    }
    
    function CambiarEstado($Datos){
              
        $pk_sub_grupo = $Datos['radio'];
        
        $conexion = new Ado();
        
        $cadena = " SELECT
                        * 
                	FROM
                	   sad_sub_grupo_actividades               	
                	WHERE
                	   pk_sub_grupo_actividades = $pk_sub_grupo "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        while(!$recordSet->EOF){
            
            $estado = $recordSet->fields['estado'];
            
            $recordSet->MoveNext(); 
            
            }     
        
        if($estado == "1"){
        
            $cadena = " UPDATE sad_sub_grupo_actividades 
                    	SET
                        	pk_sub_grupo_actividades = pk_sub_grupo_actividades, 
                        	nombre = nombre, 
                        	url = url, 
                        	icono = icono, 
                        	estado = 0, 
                        	fk_modulo = fk_modulo,
                            fk_grupos_actividades = fk_grupos_actividades, 
                        	codigo = codigo                       	
                        WHERE
                        	pk_sub_grupo_actividades = '$pk_sub_grupo' ; "; 
                       
        }
        else{
            $cadena = " UPDATE sad_sub_grupo_actividades 
                    	SET
                            pk_sub_grupo_actividades = pk_sub_grupo_actividades, 
                            nombre = nombre, 
                        	url = url, 
                        	icono = icono, 
                        	estado = 1, 
                        	fk_modulo = fk_modulo,
                            fk_grupos_actividades = fk_grupos_actividades, 
                        	codigo = codigo                       	
                       WHERE
                        	pk_sub_grupo_actividades = '$pk_sub_grupo' ; "; 
        }
        
        $conexion->conectarAdo($cadena);
        
        $mensaje = "Se cambiado correctamente el estado del Sub Grupo";
        
        return $mensaje;
        
    }
    
    function Modificar($Datos){
              
        $pk_sub_grupo = $Datos['pk_sub_grupo'];
           
        $nombre = $Datos['nombre'];           
        $url = $Datos['url'];
        $icono = $Datos['icono'];
        $fk_modulo = $Datos['fk_modulo'];
        $fk_grupo = $Datos['fk_grupo'];
      
        $conexion = new Ado();
        
        $cadena = " UPDATE sad_sub_grupo_actividades 
                	SET
                        pk_sub_grupo_actividades = pk_sub_grupo_actividades, 
                        nombre = '$nombre', 
                    	url = '$url', 
                    	icono = '$icono', 
                    	estado = estado, 
                    	fk_modulo = '$fk_modulo',
                        fk_grupos_actividades = '$fk_grupo', 
                    	codigo = codigo                       	
                    WHERE
                    	pk_sub_grupo_actividades = '$pk_sub_grupo' ; "; 
        
        $conexion->conectarAdo($cadena);
                
        $mensaje = "Se modificado correctamente el Sub Grupo";
        
        return $mensaje;
        
    }
          
                
}
?>