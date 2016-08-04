<?php

class Grupo_Modulos{
    
    public function Ver_Sub_X_Gru($pk_modulo, $pk_grupo){
        
        $conexion = new Ado();
        
        $pk_rol = $_SESSION['pk_rol'];
        $pk_usuario = $_SESSION['pk_usuario'];
        
        $cadena = " SELECT 
                        sub_gru.* 
                    FROM 
                        sad_modulos modu,
                        sad_actividades act, 
                        sad_sub_grupo_actividades sub_gru, 
                        sad_grupos_actividades gru_act,
                        sad_usuario usu, 
                        sad_rol rol,
                        sad_rol_actividades rol_act   
                    WHERE
    					rol_act.fk_rol = $pk_rol 
    				AND
					   rol_act.fk_actividades = act.pk_actividades
					AND
                        act.fk_grupos_actividades = $pk_grupo
                    AND 
                        rol.estado = 1
                    AND 
                        act.fk_grupos_actividades = gru_act.pk_grupos_actividades
                    AND
                        act.fk_sub_grupo_actividades = sub_gru.pk_sub_grupo_actividades
                    AND 
                        gru_act.fk_modulo = modu.pk_modulo
                    AND 
                        act.estado = 1
                        
                    UNION
                    
                    SELECT 
                        sub_gru.* 
                    FROM 
                        sad_modulos modu,
                        sad_actividades act, 
                        sad_sub_grupo_actividades sub_gru, 
                        sad_grupos_actividades gru_act,
                        sad_usuario usu, 
                        sad_rol rol,
                        sad_usuario_actividad usu_act       
                    WHERE
    					usu_act.fk_usuario = $pk_usuario
    				AND
					   usu_act.fk_actividades = act.pk_actividades
					AND
                        act.fk_grupos_actividades = $pk_grupo
                    AND 
                        usu.estado = 1 
                    AND 
                        act.fk_grupos_actividades = gru_act.pk_grupos_actividades
                    AND
                        act.fk_sub_grupo_actividades = sub_gru.pk_sub_grupo_actividades
                    AND 
                        gru_act.fk_modulo = modu.pk_modulo
                    AND 
                        act.estado = 1
                    GROUP BY
                        codigo 
                        ";
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    function Ver_Nom_Sub_X_Gru($pk_modulo, $pk_grupo){
        
        $conexion = new Ado();
        
        $pk_rol = $_SESSION['pk_rol'];
        $pk_usuario = $_SESSION['pk_usuario'];
        
        $cadena = " SELECT 
                        modu.nombre as nombre_modulo,
                        gru_act.nombre as nombre_grupo 
                    FROM 
                        sad_modulos modu,
                        sad_actividades act, 
                        sad_sub_grupo_actividades sub_gru, 
                        sad_grupos_actividades gru_act,
                        sad_usuario usu, 
                        sad_rol rol,
    					sad_rol_actividades rol_act
    				WHERE
    					rol_act.fk_rol = $pk_rol
                    AND 
                        act.fk_grupos_actividades = $pk_grupo
                    AND 
                        rol_act.fk_actividades = act.pk_actividades 
                    AND 
                        rol.estado = 1
                    AND 
                        act.fk_grupos_actividades = gru_act.pk_grupos_actividades
                    AND
                        act.fk_sub_grupo_actividades = sub_gru.pk_sub_grupo_actividades
                    AND 
                        gru_act.fk_modulo = modu.pk_modulo
                    AND 
                        act.estado = 1
                    
                    UNION
                    
    				SELECT 
                        modu.nombre as nombre_modulo,
                        gru_act.nombre as nombre_grupo 
                    FROM 
                        sad_modulos modu,
                        sad_actividades act, 
                        sad_sub_grupo_actividades sub_gru, 
                        sad_grupos_actividades gru_act,
                        sad_usuario usu, 
                        sad_rol rol,
    					sad_usuario_actividad usu_act
    				WHERE
    					usu_act.fk_usuario = $pk_usuario 
                    AND 
                        act.fk_grupos_actividades = $pk_grupo
                    AND 
                        usu_act.fk_actividades = act.pk_actividades
                    AND 
                        usu.estado = 1
                    AND 
                        act.fk_grupos_actividades = gru_act.pk_grupos_actividades
                    AND
                        act.fk_sub_grupo_actividades = sub_gru.pk_sub_grupo_actividades
                    AND 
                        gru_act.fk_modulo = modu.pk_modulo
                    AND 
                        act.estado = 1
                        
                        ";
                        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
        
    public function Ver_Act_X_Gru($pk_modulo, $pk_grupo, $pk_sub_grupo){
        
        $conexion = new Ado();
        
        $pk_rol = $_SESSION['pk_rol'];
        $pk_usuario = $_SESSION['pk_usuario'];
        
        $cadena = " SELECT 
                        act.* 
                    FROM 
                        sad_modulos modu,
                        sad_actividades act, 
                        sad_sub_grupo_actividades sub_gru, 
                        sad_grupos_actividades gru_act,
                        sad_usuario usu, 
                        sad_rol rol,
    					sad_rol_actividades rol_act
    				WHERE
    					rol_act.fk_rol = $pk_rol
                    AND
                        act.fk_grupos_actividades = $pk_grupo
                    AND 
                        rol_act.fk_actividades = act.pk_actividades 
                    AND 
                        rol.estado = 1
                    AND 
                        act.fk_grupos_actividades = gru_act.pk_grupos_actividades
                    AND
                        act.fk_sub_grupo_actividades = sub_gru.pk_sub_grupo_actividades
                    AND 
                        gru_act.fk_modulo = modu.pk_modulo
                    AND 
                        act.estado = 1
                    AND
                        act.fk_sub_grupo_actividades = $pk_sub_grupo
                        
                    UNION
                        
    				SELECT 
                        act.* 
                    FROM 
                        sad_modulos modu,
                        sad_actividades act, 
                        sad_sub_grupo_actividades sub_gru, 
                        sad_grupos_actividades gru_act,
                        sad_usuario usu, 
                        sad_rol rol,
    					sad_usuario_actividad usu_act
    				WHERE 
    					usu_act.fk_usuario = $pk_usuario
                    AND
                        act.fk_grupos_actividades = $pk_grupo
                    AND 
                        usu_act.fk_actividades = act.pk_actividades
                    AND 
                        usu.estado = 1
                    AND 
                        act.fk_grupos_actividades = gru_act.pk_grupos_actividades
                    AND
                        act.fk_sub_grupo_actividades = sub_gru.pk_sub_grupo_actividades
                    AND 
                        gru_act.fk_modulo = modu.pk_modulo
                    AND 
                        act.estado = 1
                    AND
                        act.fk_sub_grupo_actividades = $pk_sub_grupo
                        
                    ORDER BY
                        codigo   
                    "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    public function Ver_Nom_Act_X_Gru($pk_modulo, $pk_grupo, $pk_sub_grupo){
        
        $conexion = new Ado();
        
        $pk_rol = $_SESSION['pk_rol'];
        $pk_usuario = $_SESSION['pk_usuario'];
        
        $cadena = " SELECT 
                        modu.nombre as nombre_modulo,
                        gru_act.nombre as nombre_grupo,
                        sub_gru.nombre as nombre_sub 
                    FROM 
                        sad_modulos modu,
                        sad_actividades act, 
                        sad_sub_grupo_actividades sub_gru, 
                        sad_grupos_actividades gru_act,
                        sad_usuario usu, 
                        sad_rol rol,
    					sad_rol_actividades rol_act
    				WHERE
    					rol_act.fk_rol = $pk_rol
                    AND 
                        act.fk_grupos_actividades = $pk_grupo
                    AND 
                        rol_act.fk_actividades = act.pk_actividades 
                    AND 
                        rol.estado = 1
                    AND 
                        act.fk_grupos_actividades = gru_act.pk_grupos_actividades
                    AND
                        act.fk_sub_grupo_actividades = sub_gru.pk_sub_grupo_actividades
                    AND 
                        gru_act.fk_modulo = modu.pk_modulo
                    AND 
                        act.estado = 1
                    AND
                        act.fk_sub_grupo_actividades = $pk_sub_grupo
                      
                    UNION  
                        
    				SELECT 
                        modu.nombre as nombre_modulo,
                        gru_act.nombre as nombre_grupo,
                        sub_gru.nombre as nombre_sub 
                    FROM 
                        sad_modulos modu,
                        sad_actividades act, 
                        sad_sub_grupo_actividades sub_gru, 
                        sad_grupos_actividades gru_act,
                        sad_usuario usu, 
                        sad_rol rol,
    					sad_usuario_actividad usu_act
    				WHERE
    					usu_act.fk_usuario = $pk_usuario
                    AND
                        act.fk_grupos_actividades = $pk_grupo
                    AND 
                        usu_act.fk_actividades = act.pk_actividades
                    AND 
                        usu.estado = 1
                    AND 
                        act.fk_grupos_actividades = gru_act.pk_grupos_actividades
                    AND
                        act.fk_sub_grupo_actividades = sub_gru.pk_sub_grupo_actividades
                    AND 
                        gru_act.fk_modulo = modu.pk_modulo
                    AND 
                        act.estado = 1
                    AND
                        act.fk_sub_grupo_actividades = $pk_sub_grupo
                          
                    "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
     
    public function Ver(){
        
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        *
                    FROM 
                        sad_grupos_actividades "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
       
    public function Ver_X_Modulo($Datos){
        
        $modulo = $Datos['fk_modulo'];
        
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        *
                    FROM 
                        sad_grupos_actividades
                    WHERE
                        fk_modulo = '$modulo'"; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
        
    public function Ver_X_Grupo($Datos){
        
        $pk_grupo = $Datos['radio'];
        
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        *
                    FROM 
                        sad_grupos_actividades
                    WHERE
                        pk_grupos_actividades = '$pk_grupo'"; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
      
    function Agregar($Datos){
        
        $nombre = $Datos['nombre'];
        $modulo = $Datos['fk_modulo'];
        $url = $Datos['url'];
        
        $conexion = new Ado();
        
        //SELECT MAX(codigo) FROM sad_grupos_actividades WHERE fk_modulo=1
        $cadena = " SELECT 
                        MAX(codigo) AS codigo 
                    FROM 
                        sad_grupos_actividades 
                    WHERE 
                        fk_modulo = '$modulo';";
        
        $resSql = $conexion->conectarAdo($cadena);
        
        while(!$resSql->EOF){
            
            $codigo = $resSql->fields['codigo'];
            
            $resSql->MoveNext();
            
        }
        
        $codigo += 1;
        
        
        $cadena = " INSERT INTO 
                        sad_grupos_actividades 
                    	(pk_grupos_actividades, 
                    	nombre, 
                    	url, 
                    	icono, 
                    	estado, 
                    	fk_modulo, 
                    	codigo)
                    VALUES
                    	(NULL, 
                    	'$nombre', 
                    	'$url', 
                    	'sin icono', 
                    	'1', 
                    	'$modulo', 
                    	'$codigo');"; 
        
        $conexion->conectarAdo($cadena);
        
        $mensaje = "Se a agregado el nuevo Grupo correctamente con el nombre ".$nombre;
        
        return $mensaje;
        
    }
    
    function CambiarEstado($Datos){
              
        $pk_grupo = $Datos['radio'];
        
        $conexion = new Ado();
        
        $cadena = " SELECT
                        * 
                	FROM
                	   sad_grupos_actividades               	
                	WHERE
                	   pk_grupos_actividades = $pk_grupo "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        while(!$recordSet->EOF){
            
            $estado = $recordSet->fields['estado'];
            
            $recordSet->MoveNext(); 
            
            }     
        
        if($estado == "1"){
        
            $cadena = " UPDATE sad_grupos_actividades 
                    	SET
                        	pk_grupos_actividades = pk_grupos_actividades, 
                        	nombre = nombre, 
                        	url = url, 
                        	icono = icono, 
                        	estado = 0, 
                        	fk_modulo = fk_modulo, 
                        	codigo = codigo                       	
                        WHERE
                        	pk_grupos_actividades = '$pk_grupo' ; "; 
                       
        }
        else{
            $cadena = " UPDATE sad_grupos_actividades 
                    	SET
                            pk_grupos_actividades = pk_grupos_actividades, 
                        	nombre = nombre, 
                        	url = url, 
                        	icono = icono, 
                        	estado = 1 , 
                        	fk_modulo = fk_modulo, 
                        	codigo = codigo                       	
                       WHERE
                        	pk_grupos_actividades = '$pk_grupo' ; "; 
        }
        
        $conexion->conectarAdo($cadena);
        
        $mensaje = "Se cambiado correctamente el estado del Grupo";
        
        return $mensaje;
        
    }
     
    function Modificar($Datos){
              
        $pk_grupo = $Datos['pk_grupo'];
           
        $nombre = $Datos['nombre'];           
        $url = $Datos['url'];
        $fk_modulo = $Datos['fk_modulo'];
      
        $conexion = new Ado();
        
        $cadena = " UPDATE sad_grupos_actividades 
                	SET
                	    pk_grupos_actividades = pk_grupos_actividades, 
                        nombre = '$nombre', 
                    	url = '$url', 
                    	icono = icono, 
                    	estado = estado , 
                    	fk_modulo = '$fk_modulo', 
                    	codigo = codigo                       	
                   WHERE
                    	pk_grupos_actividades = '$pk_grupo' ;"; 
        
        $conexion->conectarAdo($cadena);
                
        $mensaje = "Se modificado correctamente el Grupo";
        
        return $mensaje;
        
    }
          
}

?>