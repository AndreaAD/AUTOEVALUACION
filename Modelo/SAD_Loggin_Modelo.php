<?php

class Loggin{
    
    public function Ver($datos){
        
        $Usuario = $datos['usuario'];
        $Clave = $datos['clave'];

        $pass_actual = crypt($Clave, '$1$rasmusle$');
               
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        usu.*, 
                        rol.nombre AS rol_nombre,
                        por_usu.fk_proceso AS pk_proceso,
                        pro.nombre AS nombre_proceso,
                        pro.fk_fase AS pk_fase,
			            fase.nombre AS nombre_fase,
                        pk_sede AS fk_sede,
                        pk_facultad AS fk_facultad
                    FROM 
                        (sad_usuario usu, 
                        sad_rol rol,
                        sad_sede sede,
                        sad_facultad facu,
			            cna_proceso pro,
			            cna_fase fase,
                        sad_programa prog)
                    LEFT JOIN
                            sad_proceso_usuario por_usu
                        ON  
                                por_usu.fk_usuario = usu.pk_usuario
                            AND
                                pro.pk_proceso = por_usu.fk_proceso
                    WHERE
                            usu.usuario = '$Usuario' 
                        AND
                            usu.clave = '$pass_actual' 
                        AND 
                            usu.fk_rol = rol.pk_rol
                        AND
			                pro.fk_fase = fase.pk_fase
                        AND
                            usu.fk_programa = prog.pk_programa
                        AND
                            prog.fk_sede = sede.pk_sede
                        AND
                            prog.fk_facultad = facu.pk_facultad"; 
        
        $recordSet = $conexion->conectarAdo($cadena);

        $_SESSION['estado'] = 'off';
        
        $datos_proceso = array();
        
        while(!$recordSet->EOF) {

            if($recordSet->fields['usuario'] != ''){
                            
                $datos_menu = array();
                
                $datos_grupo = array();
                
                $datos_modulos = array();
                
                $datos_actividad = array();
                
                $_SESSION['pk_usuario'] = $recordSet->fields['pk_usuario'];
                $_SESSION['nombre_usuario'] = $recordSet->fields['nombre'];
                $_SESSION['apellido_usuario'] = $recordSet->fields['apellido'];
                
                $_SESSION['nombre_rol'] = $recordSet->fields['rol_nombre'];
                
                $_SESSION['sad_fk_sede'] = $recordSet->fields['fk_sede'];
                $_SESSION['sad_fk_facultad'] = $recordSet->fields['fk_facultad'];
                $_SESSION['sad_fk_programa'] = $recordSet->fields['fk_programa'];
                
                //esta variable de session para el modulo documental
                $_SESSION['grupos_documental'] = array('grupoP' => 'Equipo del Programa' , 'grupoI' => 'Equipo Institucional');
                
                if($recordSet->fields['pk_proceso'] != null){
                    
                    $datos_proceso[] = array(   "pk_proceso"=>$recordSet->fields['pk_proceso'],
                                                "nombre_proceso"=>$recordSet->fields['nombre_proceso'],
                                                "pk_fase" => $recordSet->fields['pk_fase'],
                                                "nombre_fase" => $recordSet->fields['nombre_fase']);
                       
                    $_SESSION['array_proceso'] = $datos_proceso;
                         
                    $_SESSION['pk_proceso'] = $recordSet->fields['pk_proceso'];
                    
                    $_SESSION['pk_fase'] = $recordSet->fields['pk_fase'];
                       
                    $_SESSION['nombre_proceso'] = $recordSet->fields['nombre_proceso'];
                    
                    $_SESSION['nombre_fase'] = $recordSet->fields['nombre_fase'];
                    
                    $_SESSION['estado'] = 'on';
                    
                }
                
                $_SESSION['pk_rol'] = $recordSet->fields['fk_rol'];
                
                $pk_rol = $_SESSION['pk_rol'];
                $pk_usuario = $_SESSION['pk_usuario'];
                       
                $cadena = " SELECT  
                            	modu.pk_modulo, modu.nombre, modu.icono, modu.color, modu.codigo
                            FROM 	
                            	sad_grupos_actividades gru_act,
                            	sad_modulos modu,
                            	sad_rol_actividades rol_act,
                            	sad_actividades act
                            WHERE
                            	rol_act.fk_rol = $pk_rol
                            AND
                            	act.pk_actividades = rol_act.fk_actividades
                            AND		
                            	gru_act.pk_grupos_actividades = act.fk_grupos_actividades
                            AND 
                                act.fk_grupos_actividades = gru_act.pk_grupos_actividades
                            AND 
                                gru_act.fk_modulo = modu.pk_modulo
                            AND      
                            	act.estado = 1
                            AND
                            	gru_act.estado = 1
                            AND
                            	modu.estado = 1
                            
                            UNION
                            
                            SELECT  
                            	modu.pk_modulo, modu.nombre, modu.icono, modu.color, modu.codigo
                            FROM 			
                            	
                            	sad_grupos_actividades gru_act,
                            	sad_modulos modu,
                            	sad_usuario_actividad usu_act,
                            	sad_actividades act
                            	
                            WHERE
                            	usu_act.fk_usuario = $pk_usuario
                            AND
                            	act.pk_actividades = usu_act.fk_actividades
                            AND		
                            	gru_act.pk_grupos_actividades = act.fk_grupos_actividades
                            AND 
                                act.fk_grupos_actividades = gru_act.pk_grupos_actividades
                            AND 
                                gru_act.fk_modulo = modu.pk_modulo
                            AND      
                            	act.estado = 1
                            AND
                            	gru_act.estado = 1
                            AND
                            	modu.estado = 1	
                            	
                            ORDER BY
                            	codigo";
                
                $Res_Modulos = $conexion->conectarAdo($cadena);
                
                if($Res_Modulos != null){
                
                    while(!$Res_Modulos->EOF){
                        
                        $datos_modulos[] = array(
                                            "nombre"=>$Res_Modulos->fields['nombre'],
                                            "pk_modulo"=>$Res_Modulos->fields['pk_modulo'],
                                            "icono"=>$Res_Modulos->fields['icono'],
                                            "color"=>$Res_Modulos->fields['color']
                                            );
                        
                        $Res_Modulos->MoveNext();
                        
                        }
                        
                }
                
                foreach($datos_modulos as $datos){
                    
                    $datos_grupo = array();
                    
                    $pk_modulo = $datos['pk_modulo'];
                        
                    $cadena = " SELECT  
                                	gru_act.*
                                FROM 			
                                	
                                	sad_grupos_actividades gru_act,
                                	sad_modulos modu,
                                	sad_rol_actividades rol_act,
                                	sad_actividades act
                                	
                                WHERE
                                	rol_act.fk_rol = $pk_rol
                                AND
                                	act.pk_actividades = rol_act.fk_actividades
                                AND		
                                	gru_act.pk_grupos_actividades = act.fk_grupos_actividades
                                AND	   
                                	gru_act.fk_modulo = $pk_modulo
                                AND      
                                	act.estado = 1
                                AND
                                	gru_act.estado = 1
                                AND
                                	modu.estado = 1
                                
                                UNION
                                
                                SELECT  
                                	gru_act.*
                                FROM 			
                                	
                                	sad_grupos_actividades gru_act,
                                	sad_modulos modu,
                                	sad_usuario_actividad usu_act,
                                	sad_actividades act
                                	
                                WHERE
                                	usu_act.fk_usuario = $pk_usuario
                                AND
                                	act.pk_actividades = usu_act.fk_actividades
                                AND		
                                	gru_act.pk_grupos_actividades = act.fk_grupos_actividades
                                AND	   
                                	gru_act.fk_modulo = $pk_modulo
                                AND      
                                	act.estado = 1
                                AND
                                	gru_act.estado = 1
                                AND
                                	modu.estado = 1	
                                	
                                ORDER BY
                                	codigo";
                
                    $Res_Grupo = $conexion->conectarAdo($cadena);
                        
                    while(!$Res_Grupo->EOF){
                        
                        $datos_grupo[] = array(
                                        "nombre"=>$Res_Grupo->fields['nombre'],
                                        "id"=>"BTN_controles",
                                        "pk_grupo"=>$Res_Grupo->fields['pk_grupos_actividades'],
                                        "url"=>$Res_Grupo->fields['url'],
                                        "icono"=>"icon 2"
                                        );
                        
                        $Res_Grupo->MoveNext();
                        }
                    $datos_menu[] = array(
                            "nombre"=>$datos['nombre'],
                            "color"=>$datos['color'],
                            "icono"=>$datos['icono'],
                            "pk_modulo"=>$datos['pk_modulo'],
                            "opciones"=>$datos_grupo      
                        );
                        
                }
                
            }
            
            $recordSet->MoveNext(); 
            
            $_SESSION['datos_menu'] = $datos_menu;
            // var_dump($datos_menu[0]['opciones']);
            // exit();
        
        }  
        
        if(isset($_SESSION['datos_menu'])){
            
            if($_SESSION['estado'] == 'off'){
                
                $pk_usuario = $_SESSION['pk_usuario'];
                
                $cadena = " SELECT 
                            	pro.pk_proceso AS pk_proceso,
                            	pro.nombre AS nombre_proceso,
                            	pro.fk_fase AS pk_fase,
                            	fase.nombre AS nombre_fase
                            FROM 
                            	cna_proceso pro,
                            	cna_fase fase
                            WHERE
                            	pro.fk_fase = fase.pk_fase ";
            
                $recordSet = $conexion->conectarAdo($cadena);
                    
                while(!$recordSet->EOF){
                                        
                    $datos_proceso[] = array(   "pk_proceso"=>$recordSet->fields['pk_proceso'],
                                                "nombre_proceso"=>$recordSet->fields['nombre_proceso'],
                                                "pk_fase" => $recordSet->fields['pk_fase'],
                                                "nombre_fase" => $recordSet->fields['nombre_fase']);
                    
                    $_SESSION['array_proceso'] = array();
                    
                    $_SESSION['array_proceso'] = $datos_proceso;
                         
                    $_SESSION['pk_proceso'] = $recordSet->fields['pk_proceso'];
                    
                    $_SESSION['pk_fase'] = $recordSet->fields['pk_fase'];
                            
                    $_SESSION['nombre_proceso'] = $recordSet->fields['nombre_proceso'];
                    
                    $_SESSION['nombre_fase'] = $recordSet->fields['nombre_fase'];
                            
                    $recordSet->MoveNext();
                }
                
            }
            
        }
              
                   
    }
    
}
?>