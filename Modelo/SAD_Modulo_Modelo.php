<?php

class Modulo{
    
    function AgregarModulo($Datos){
              
        
        $conexion = new Ado();
        
        $archivo = $Datos;
        
        require_once('../PHPExcel/Classes/PHPExcel.php');        
        require_once('../PHPExcel/Classes/PHPExcel/Reader/Excel2007.php');
        
        // Cargando la hoja de cálculo
        
        $objReader = new PHPExcel_Reader_Excel2007();
        
        $objPHPExcel = $objReader->load($archivo);
        
        $objFecha = new PHPExcel_Shared_Date();
        
        // Asignar hoja de excel activa
        
        $objPHPExcel->setActiveSheetIndex(0);
        
        // Llenamos el arreglo con los datos  del archivo xlsx
        
        for ($i=2;$i<=1000;$i++){
        
            $_DATOS_EXCEL[$i-1]['tipo'] = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
            
            $_DATOS_EXCEL[$i-1]['nombre'] = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
            
            $_DATOS_EXCEL[$i-1]['descripcion'] = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
            
            $_DATOS_EXCEL[$i-1]['url']= $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
            
            $_DATOS_EXCEL[$i-1]['color']= $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
            
            $_DATOS_EXCEL[$i-1]['icono']= $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
            
            $_DATOS_EXCEL[$i-1]['estado']= $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
            
            $_DATOS_EXCEL[$i-1]['codigo']= $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue();
            
        }
        
        //recorremos el arreglo multidimensional        
        //para ir recuperando los datos obtenidos        
        //del excel e ir insertandolos en la BD
        
        foreach($_DATOS_EXCEL as $campo => $valor){
            
            if($valor['tipo']=='M'){
                
                $nombre =  utf8_decode($valor['nombre']);
                $descripcion =  utf8_decode($valor['descripcion']);
                $url = $valor['url'];
                $color = $valor['color'];
                $icono = $valor['icono'];
                $estado = $valor['estado'];
                $codigo =  $valor['codigo'];
                
                $cadena = "SELECT * FROM sad_modulos WHERE nombre = '$nombre' ";
                $resSqlModCons = $conexion->conectarAdo($cadena);
                
                if(!$resSqlModCons->EOF){
                    
                    while(!$resSqlModCons->EOF) 
                      {
                        $pk_modulo = $resSqlModCons->fields['pk_modulo']; 
                        $resSqlModCons->MoveNext(); 
                      }
                }
                else{
                    
                    $cadena = "INSERT INTO sad_modulos 
                               VALUES 
                                (NULL,'$nombre','$descripcion','$url','$color','$icono','$estado','$codigo')"; 
                    $conexion->conectarAdo($cadena);             
                    
                    $cadena = "SELECT * FROM sad_modulos WHERE nombre = '$nombre' ";
                    $resSqlMod = $conexion->conectarAdo($cadena);
                    
                    while(!$resSqlMod->EOF) 
                      {
                        $pk_modulo = $resSqlMod->fields['pk_modulo']; 
                        $resSqlMod->MoveNext(); 
                      }
                                        
                }
                    
            }
            
            if($valor['tipo']=='G'){
                
                $nombre =  utf8_decode($valor['nombre']);
                $descripcion =  utf8_decode($valor['descripcion']);
                $url = $valor['url'];
                $color = $valor['color'];
                $icono = $valor['icono'];
                $estado = $valor['estado'];
                $codigo =  $valor['codigo'];
                $cadena = "SELECT * FROM sad_grupos_actividades WHERE nombre = '$nombre' ";
                $resSqlGrucons = $conexion->conectarAdo($cadena);
                
                if(!$resSqlGrucons->EOF){
                    
                    $pk_sub_grupo = '1';
                    
                    while(!$resSqlGrucons->EOF) 
                      {
                        $pk_grupo = $resSqlGrucons->fields['pk_grupos_actividades']; 
                        $resSqlGrucons->MoveNext(); 
                      }  
                      
                }
                else{
                    
                    $pk_sub_grupo = '1';
                    
                    $cadena = "INSERT INTO sad_grupos_actividades 
                               VALUES 
                                (NULL,'$nombre','$url','$icono','$estado',$pk_modulo,$codigo)"; 
                                
                    $conexion->conectarAdo($cadena);   
                    
                    $cadena = "SELECT * FROM sad_grupos_actividades WHERE nombre = '$nombre' ";
                    $resSqlGru = $conexion->conectarAdo($cadena);
                    
                    while(!$resSqlGru->EOF) 
                      {
                        $pk_grupo = $resSqlGru->fields['pk_grupos_actividades']; 
                        $resSqlGru->MoveNext(); 
                      }  
                      
                }  
                
            }
            
            if($valor['tipo']=='S'){
                
                $nombre =  utf8_decode($valor['nombre']);
                $descripcion =  utf8_decode($valor['descripcion']);
                $url = $valor['url'];
                $color = $valor['color'];
                $icono = $valor['icono'];
                $estado = $valor['estado'];
                $codigo =  $valor['codigo'];
                
                $cadena = "SELECT * FROM sad_sub_grupo_actividades WHERE nombre = '$nombre' ";
                $resSqlSubCons = $conexion->conectarAdo($cadena);
                
                if(!$resSqlSubCons->EOF){
                    
                    while(!$resSqlSubCons->EOF) 
                      {
                        $pk_sub_grupo = $resSqlSubCons->fields['pk_sub_grupo_actividades']; 
                        $resSqlSubCons->MoveNext(); 
                      } 
                      
                }
                else{
                    
                    $cadena = "INSERT INTO sad_sub_grupo_actividades 
                               VALUES 
                                (0,'$nombre','$url','$icono','$estado',$pk_modulo,$pk_grupo,$codigo)"; 
                                
                    $conexion->conectarAdo($cadena);   
                    
                    $cadena = "SELECT * FROM sad_sub_grupo_actividades WHERE nombre = '$nombre' ";
                    $resSqlSub = $conexion->conectarAdo($cadena);
                    
                    while(!$resSqlSub->EOF) 
                      {
                        $pk_sub_grupo = $resSqlSub->fields['pk_sub_grupo_actividades']; 
                        $resSqlSub->MoveNext(); 
                      }   
                }
                
            }
            
            if($valor['tipo']=='A'){
                
                $nombre =  utf8_decode($valor['nombre']);
                $descripcion =  utf8_decode($valor['descripcion']);
                $url = $valor['url'];
                $color = $valor['color'];
                $icono = $valor['icono'];
                $estado = $valor['estado'];
                $codigo =  $valor['codigo'];
                
                $cadena = "SELECT * FROM sad_actividades WHERE nombre = '$nombre' ";
                $resSqlAct = $conexion->conectarAdo($cadena);
                
                if(!$resSqlAct->EOF){
                    
                }
                else{
                    
                    $cadena = "INSERT INTO sad_actividades    
                               VALUES 
                                (0,'$nombre','$descripcion','$url','$icono','$estado',$pk_grupo,$pk_sub_grupo,$codigo)"; 
                             
                    $conexion->conectarAdo($cadena);
                    
                }
                
            }    
        
        }

        $mensaje = 'Archivo subido correctamente : '.$archivo;
        
        return $mensaje;
    }
    
    function AgregarArchivo($Datos){
        
        $ruta="../Archivos/";
        
    	foreach ($Datos as $key) {
    		if($key['error'] == UPLOAD_ERR_OK ){//Verificamos si se subio correctamente
    			$nombre = $key['name'];//Obtenemos el nombre del archivo
    			$temporal = $key['tmp_name']; //Obtenemos el nombre del archivo temporal
                //echo $key['tmp_name'];
    			$tamano= ($key['size'] / 1000)."Kb"; //Obtenemos el tamaño en KB
    			move_uploaded_file($temporal, $ruta . $nombre); //Movemos el archivo temporal a la ruta especificada
    			//El echo es para que lo reciba jquery y lo ponga en el div "cargados"   
                                 
                $mensaje = $this->AgregarModulo($ruta.$nombre);  
        
                return $mensaje;          			
    		}else{
    			echo $key['error']; //Si no se cargo mostramos el error
    		}
    	}        
        
    }
    
    function Ver(){
                
        $conexion = new Ado();
        
        $cadena = "SELECT * FROM sad_modulos"; 
        
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
        
        $mensaje = "Se a agregado el nuevo modulo correctamente con el nombre ".$nombre;
        
        return $mensaje;
        
    }
    
    function CambiarEstado($Datos){
              
        $pk_modulo = $Datos['radio'];
        
        $conexion = new Ado();
        
        $cadena = " SELECT
                        * 
                	FROM
                	   sad_modulos               	
                	WHERE
                	   pk_modulo = $pk_modulo "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        while(!$recordSet->EOF){
            
            $estado = $recordSet->fields['estado'];
            
            $recordSet->MoveNext(); 
            
            }     
        
        if($estado == "1"){
        
            $cadena = " UPDATE sad_modulos 
                    	SET
                    	   pk_modulo = pk_modulo , 
                    	   nombre = nombre , 
                    	   descripcion = descripcion , 
                    	   url = url , 
                    	   color = color , 
                    	   icono = icono ,
                           estado = 0  , 
	                       codigo = codigo             	
                    	WHERE
                    	   pk_modulo = $pk_modulo "; 
                       
        }
        else{
            $cadena = " UPDATE sad_modulos 
                    	SET
                    	   pk_modulo = pk_modulo , 
                    	   nombre = nombre , 
                    	   descripcion = descripcion , 
                    	   url = url , 
                    	   color = color , 
                    	   icono = icono ,
                           estado = 1  , 
	                       codigo = codigo             	
                    	WHERE
                    	   pk_modulo = $pk_modulo ";
        }
        
        $conexion->conectarAdo($cadena);
        
        $mensaje = "Se a cambiado correctamente el estado del modulo. ";
        
        return $mensaje;
        
    }
    
    function Modificar($Datos){
              
        $pk_modulo = $Datos['pk_modulo'];
           
        $nombre = $Datos['nombre'];           
        $descripcion = $Datos['descripcion'];
        $url = $Datos['url'];
      
        $conexion = new Ado();
        
        $cadena = " UPDATE sad_modulos 
                	SET
                	   pk_modulo = pk_modulo , 
                	   nombre = '$nombre' , 
                	   descripcion = '$descripcion' , 
                	   url = '$url' , 
                	   color = color , 
                	   icono = icono ,
                       estado = estado , 
                       codigo = codigo              	
                	WHERE
                	   pk_modulo = $pk_modulo "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        $mensaje = "Se a modificado el modulo correctamente con el nombre ".$nombre;
        
        return $mensaje;
        
    }
    
    function Ver_X_Modulo($Datos){
        
        $pk_modulo = $Datos['radio'];
    
        $conexion = new Ado();
        
        $cadena = "SELECT * FROM sad_modulos WHERE pk_modulo = $pk_modulo"; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
            
    }
    
    function Ver_Modulo_X_Pk($Datos){
        
        $pk_modulo = $Datos['modulo'];
    
        $conexion = new Ado();
        
        $cadena = "SELECT * FROM sad_modulos WHERE pk_modulo = $pk_modulo"; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
            
    }
    
}
?>