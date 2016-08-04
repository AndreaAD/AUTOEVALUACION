<?php

class Seguridad{
    
    public function Seguridad_Enviar($observacion, $transaccion){
        
        ini_set('date.timezone','America/Bogota');
         
        $conexion = new Ado();        
        
        $ip = "00.000.000.000";
        $mac = '00:00:00:00';
        
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
		  $ip = $_SERVER['HTTP_CLIENT_IP'];
		
    	if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    	
    	$ip = $_SERVER['REMOTE_ADDR'];
        
        $fecha = date("Y-m-d H:i:s");
        
        $usuario = $_SESSION['pk_usuario'];
        
        $cadena = " SELECT
                        *
                    FROM
                        sad_tipo_transaccion
                    WHERE
                        nombre = '$transaccion';"; //Realizamos una consulta
        
        $ResSql = $conexion->conectarAdo($cadena);
        
        while(!$ResSql->EOF){
                        
            $fk_tipo_transaccion = $ResSql->fields['pk_tipo_transaccion'];
            
            $ResSql->MoveNext();
            
        }
        
        $cadena = " INSERT INTO sad_seguridad 
	                   (pk_seguridad, fecha, usuario, observacion, ip, mac, fk_tipo_transaccion)
                    VALUES
	                   (null, '$fecha', '$usuario', '$observacion', '$ip', '$mac', '$fk_tipo_transaccion');"; //Realizamos una consulta
        
        $conexion->conectarAdo($cadena);
        
    }
    
    function Ver(){
        
        $conexion = new Ado();        
        
        $cadena = " SELECT
                        *
                    FROM
                        sad_seguridad;"; //Realizamos una consulta
        
        $ResSql = $conexion->conectarAdo($cadena);
        
        return $ResSql;
        
    }
    
    function Ver_Transaccion(){
        
        $conexion = new Ado();        
        
        $cadena = " SELECT
                        *
                    FROM
                        sad_tipo_transaccion;"; //Realizamos una consulta
        
        $ResSql = $conexion->conectarAdo($cadena);
        
        return $ResSql;
        
    }
    
    function Exportar_Excel(){
        
        $conexion = new Ado();        
        
        $cadena = " SELECT
                        *
                    FROM
                        sad_seguridad;"; //Realizamos una consulta
        
        $ResSql = $conexion->conectarAdo($cadena);
        
    }
    
}

?>