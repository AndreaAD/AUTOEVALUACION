<?php

class Actividad{
        
    public function Ver(){
        
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        act.*,
                        modu.nombre AS nombre_modulo
                    FROM 
                        sad_actividades act,
                        sad_modulos modu,
                        sad_grupos_actividades gru_act
                    WHERE
                            act.fk_grupos_actividades = gru_act.pk_grupos_actividades
                        AND
                            gru_act.fk_modulo = modu.pk_modulo
                    "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
          
    public function Ver_Actividades_Check($_Datos){
        
        $pk_usuario = $_Datos['pk_usuario'];
        
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        act.*,
                        modu.nombre AS nombre_modulo
                    FROM 
                        (sad_actividades act,
                        sad_modulos modu,
                        sad_grupos_actividades gru_act)
        			INNER JOIN
        			     sad_usuario_actividad usu_act
        			ON
        			     usu_act.fk_usuario = $pk_usuario
        		  	AND
        			     usu_act.fk_actividades = act.pk_actividades
                    WHERE
                            act.fk_grupos_actividades = gru_act.pk_grupos_actividades
                        AND
                            gru_act.fk_modulo = modu.pk_modulo
                    "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
      
    public function Ver_Actividades_No_Check($_Datos){
        
        $pk_usuario = $_Datos['pk_usuario'];
        
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        act.*,
                        modu.nombre AS nombre_modulo
                    FROM 
                        sad_actividades act,
                        sad_modulos modu,
                        sad_grupos_actividades gru_act
                    WHERE
                            act.fk_grupos_actividades = gru_act.pk_grupos_actividades
                        AND
                            gru_act.fk_modulo = modu.pk_modulo
                        AND
                            act.pk_actividades NOT IN(  SELECT 
                                                            usu_act.fk_actividades
                                                        FROM 
                                                            sad_usuario_actividad usu_act
                                                        WHERE 
							                                 usu_act.fk_usuario = $pk_usuario
                            							AND
                            			                     usu_act.fk_actividades = act.pk_actividades)"; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
      
    public function Ver_Actividades_X_Pk_Usuario($_Datos){
        
        $pk_usuario = $_Datos['pk_usuario'];
        
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        act.*,
                        modu.nombre AS nombre_modulo
                    FROM 
                        sad_actividades act,
                        sad_modulos modu,
                        sad_grupos_actividades gru_act
                    WHERE
                            act.fk_grupos_actividades = gru_act.pk_grupos_actividades
                        AND
                            gru_act.fk_modulo = modu.pk_modulo
                    "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    public function Ver_X_Usuario($_Datos){
        
        $pk_usuario = $_Datos['radio'];
        
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        usu_act.*,
                        act.nombre as nombre_actividad,
                        act.estado as estado_actividad,
                        usu.nombre as nombre_usuario,
                        usu.apellido as apellido_usuario,
                        sede.nombre as nombre_sede,
                        pro.nombre as nombre_programa,
                        modu.nombre as nombre_modulo
                    FROM 
                        sad_actividades act, 
                        sad_usuario usu, 
                        sad_grupos_actividades gru_act, 
                        sad_modulos modu,
                        sad_sede sede, 
                        sad_programa pro,
                        sad_usuario_actividad usu_act
                    WHERE
                            usu_act.fk_usuario = $pk_usuario
            			AND 
                            usu.pk_usuario = $pk_usuario
            			AND
                            usu.fk_programa = pro.pk_programa
            			AND 
                            pro.fk_sede = sede.pk_sede
            			AND  
                            usu_act.fk_actividades = act.pk_actividades
            			AND 
                            act.fk_grupos_actividades = gru_act.pk_grupos_actividades
            			AND 
                            gru_act.fk_modulo = modu.pk_modulo"; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
      
    public function Ver_X_Pk_Usuario($_Datos){
        
        $pk_usuario = $_Datos['pk_usuario'];
        
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        usu_act.*,
                        act.nombre as nombre_actividad,
                        act.estado as estado_actividad,
                        usu.nombre as nombre_usuario,
                        usu.apellido as apellido_usuario,
                        sede.nombre as nombre_sede,
                        pro.nombre as nombre_programa,
                        modu.nombre as nombre_modulo
                    FROM 
                        sad_actividades act, 
                        sad_usuario usu, 
                        sad_grupos_actividades gru_act, 
                        sad_modulos modu,
                        sad_sede sede, 
                        sad_programa pro,
                        sad_usuario_actividad usu_act
                    WHERE
                            usu_act.fk_usuario = $pk_usuario
            			AND 
                            usu.pk_usuario = $pk_usuario
            			AND
                            usu.fk_programa = pro.pk_programa
            			AND 
                            pro.fk_sede = sede.pk_sede
            			AND  
                            usu_act.fk_actividades = act.pk_actividades
            			AND 
                            act.fk_grupos_actividades = gru_act.pk_grupos_actividades
            			AND 
                            gru_act.fk_modulo = modu.pk_modulo"; 
//
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
        
    public function Ver_X_Rol($_Datos){
        
        $pk_rol = $_Datos['radio'];
        
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        rol_act.*,
                        act.nombre AS nombre_actividad,
                        act.estado AS estado_actividad,
                        usu.nombre AS nombre_usuario,
                        usu.apellido AS apellido_usuario,
                        sede.nombre AS nombre_sede,
                        pro.nombre AS nombre_programa,
                        modu.nombre AS nombre_modulo
                    FROM 
                        sad_actividades act, 
                        sad_usuario usu, 
                        sad_grupos_actividades gru_act, 
                        sad_modulos modu,
                        sad_sede sede, 
                        sad_programa pro,
                        sad_rol_actividades rol_act
                    WHERE
                            rol_act.fk_rol =  $pk_rol
            			AND 
                            usu.fk_programa = pro.pk_programa
            			AND 
                            pro.fk_sede = sede.pk_sede
            			AND  
                            rol_act.fk_actividades = act.pk_actividades
            			AND 
                            act.fk_grupos_actividades = gru_act.pk_grupos_actividades
            			AND 
                            gru_act.fk_modulo = modu.pk_modulo
                        GROUP BY
                            rol_act.fk_actividades"; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
          
    public function Ver_X_Pk_Rol($_Datos){
        
        $pk_rol = $_Datos['pk_rol'];
        
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        rol_act.*,
                        act.nombre AS nombre_actividad,
                        act.estado AS estado_actividad,
                        usu.nombre AS nombre_usuario,
                        usu.apellido AS apellido_usuario,
                        sede.nombre AS nombre_sede,
                        pro.nombre AS nombre_programa,
                        modu.nombre AS nombre_modulo
                    FROM 
                        sad_actividades act, 
                        sad_usuario usu, 
                        sad_grupos_actividades gru_act, 
                        sad_modulos modu,
                        sad_sede sede, 
                        sad_programa pro,
                        sad_rol_actividades rol_act
                    WHERE
                            rol_act.fk_rol =  $pk_rol
            			AND 
                            usu.fk_programa = pro.pk_programa
            			AND 
                            pro.fk_sede = sede.pk_sede
            			AND  
                            rol_act.fk_actividades = act.pk_actividades
            			AND 
                            act.fk_grupos_actividades = gru_act.pk_grupos_actividades
            			AND 
                            gru_act.fk_modulo = modu.pk_modulo
                        GROUP BY
                            rol_act.fk_actividades"; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
     
    function Agregar($Datos){
        
        $nombre = $Datos['nombre'];
        $descripcion = $Datos['descripcion'];
        $url = $Datos['url'];
        
        $conexion = new Ado();
        
        //SELECT MAX(codigo) FROM sad_grupos_actividades WHERE fk_modulo=1
        $cadena = "SELECT MAX(codigo) AS codigo FROM sad_modulos;";
        
        $resSql = $conexion->conectarAdo($cadena);
        
        while(!$resSql->EOF){
            
            $codigo = $resSql->fields['codigo'];
            
            $resSql->MoveNext();
            
        }
        
        $codigo += 1;
        
        
        $cadena = " INSERT INTO 
                        sad_modulos 
                    	(pk_modulo, 
                    	nombre, 
                    	descripcion, 
                    	url, 
                    	color, 
                    	icono, 
                    	estado,
                        codigo)
                	VALUES
                    	(NULL, 
                    	'$nombre', 
                    	'$descripcion', 
                    	'$url', 
                    	'FFFFFF', 
                    	'sin icono', 
                    	1,
                        $codigo);"; 
        
        $conexion->conectarAdo($cadena);
        
        $mensaje = "Se a agregado la nuevo actividad correctamente con el nombre ".$nombre;
        
        return $mensaje;
        
    }
    
    function CambiarEstado($Datos){
              
        $pk_actividad = $Datos['radio'];
        
        $conexion = new Ado();
        
        $cadena = " SELECT
                        * 
                	FROM
                	   sad_actividades               	
                	WHERE
                	   pk_actividades = $pk_actividad "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        while(!$recordSet->EOF){
            
            $estado = $recordSet->fields['estado'];
            
            $recordSet->MoveNext(); 
            
            }     
        
        if($estado == "1"){
        
            $cadena = " UPDATE sad_actividades 
                    	SET
                        	pk_actividades = pk_actividades , 
                        	nombre = nombre , 
                        	descripcion = descripcion , 
                        	url = url , 
                        	icono = icono , 
                        	estado = 0 , 
                        	fk_grupos_actividades = fk_grupos_actividades , 
                        	fk_sub_grupo_actividades = fk_sub_grupo_actividades , 
                        	codigo = codigo                        	
                        WHERE
                        	pk_actividades = '$pk_actividad' ; "; 
                       
        }
        else{
            $cadena = " UPDATE sad_actividades 
                    	SET
                    	   pk_actividades = pk_actividades , 
                        	nombre = nombre , 
                        	descripcion = descripcion , 
                        	url = url , 
                        	icono = icono , 
                        	estado = 1 , 
                        	fk_grupos_actividades = fk_grupos_actividades , 
                        	fk_sub_grupo_actividades = fk_sub_grupo_actividades , 
                        	codigo = codigo                        	
                        WHERE
                        	pk_actividades = '$pk_actividad' ; ";
        }
        
        $conexion->conectarAdo($cadena);
        
        $mensaje = "Se cambiado correctamente el estado de la Actividad";
        
        return $mensaje;
        
    }
    
    function Modificar($Datos){
              
        $pk_actividad = $Datos['pk_actividad'];
           
        $nombre = $Datos['nombre'];           
        $descripcion = $Datos['descripcion'];
        $url = $Datos['url'];
        $icono = $Datos['icono'];
        $fk_grupo = $Datos['fk_grupo'];
        $fk_sub_grupo = $Datos['fk_sub_grupo'];
      
        $conexion = new Ado();
        
        $cadena = " UPDATE sad_actividades 
                	SET
                    	pk_actividades = pk_actividades , 
                    	nombre = '$nombre' , 
                    	descripcion = '$descripcion' , 
                    	url = '$url' , 
                    	icono = '$icono' , 
                    	estado = estado , 
                    	fk_grupos_actividades = '$fk_grupo' , 
                    	fk_sub_grupo_actividades = '$fk_sub_grupo' , 
                    	codigo = codigo
                	WHERE
                	   pk_actividades = '$pk_actividad' ;"; 
        
        $conexion->conectarAdo($cadena);
                 
        $mensaje = "Se modificado correctamente la Actividad";
        
        return $mensaje;
        
    }
    
    function Ver_X_Actividad($Datos){
        
        $pk_actividad = $Datos['radio'];
    
        $conexion = new Ado();
        
        $cadena = "SELECT * FROM sad_actividades WHERE pk_actividades = $pk_actividad"; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
            
    }
         
}
    
?>