<?php

class Actividades{
        
    public function Ver(){
        
        $conexion = new Ado();
        
        $cadena = " SELECT * FROM sad_actividades"; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
       
    public function FiltrarUsuario($_Datos){
        
        $pk_usuario = $_Datos['pk_usuario_radio'];
        
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
                            2 = usu.pk_usuario
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
     
    function Agregar($Datos){
        
        $nombre = $Datos['nombre'];
        $descripcion = $Datos['descripcion'];
        $url = $Datos['url'];
        $icono = $Datos['icono'];
        $fk_grupo = $Datos['fk_grupo'];
        $fk_sub_grupo = $Datos['fk_sub_grupo'];
        
        $conexion = new Ado();
        
        //SELECT MAX(codigo) FROM sad_grupos_actividades WHERE fk_modulo=1
        $cadena = " SELECT 
                        MAX(codigo) AS codigo 
                    FROM 
                        sad_actividades
                    WHERE
                            fk_grupos_actividades = '$fk_grupo'
                        AND
                            fk_sub_grupo_actividades = '$fk_sub_grupo';";
        
        $resSql = $conexion->conectarAdo($cadena);
        
        while(!$resSql->EOF){
            
            $codigo = $resSql->fields['codigo'];
            
            $resSql->MoveNext();
            
        }
        
        $codigo += 1;
        
        $cadena = " INSERT INTO 
                        sad_actividades 
                    	(pk_actividades, 
                    	nombre, 
                    	descripcion, 
                    	url, 
                    	icono, 
                    	estado, 
                    	fk_grupos_actividades, 
                    	fk_sub_grupo_actividades, 
                    	codigo)
                    VALUES
                    	(NULL, 
                    	'$nombre', 
                    	'$descripcion', 
                    	'$url', 
                    	'$icono', 
                    	'1', 
                    	'$fk_grupo', 
                    	'$fk_sub_grupo', 
                    	'$codigo');"; 
        
        $conexion->conectarAdo($cadena);
        
        $mensaje = "Se a agregado la nuevo actividad correctamente con el nombre ".$nombre;
        
        return $mensaje;
        
    }
          
}
    
?>