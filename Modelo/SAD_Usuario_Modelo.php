<?php

require_once("../Modelo/SAD_Seguridad_Modelo.php");
require_once("../Modelo/SAD_Correo_Modelo.php");

class Usuario{
    
    public function GenerarClave($length = 8){
        
        $string = "";
        $possible = "0123456789bcdfghjkmnpqrstvwxyz";
        $i = 0;
        
        while ($i < $length) {
            $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
            $string .= $char;
            $i++;
        }
        
        return $string;
    }
    
    public function GenerarUsuario($nombre, $apellido, $cont){
        
        $usuario = "";
        
        for ($i=0; $i<strlen($nombre); $i=$i+1){
            if($i>0){
                if($nombre[$i] != ' '){
                    $usuario = $usuario.$nombre[$i];
                }
                if($nombre[$i] == ' '){
                    $i = strlen($nombre);
                }
            }
            else{
                if($nombre[$i] != ' '){
                    $usuario = $usuario.$nombre[$i];
                }
            }
        }
        
        for ($j=0; $j<strlen($apellido); $j=$j+1){
            if($apellido[$j] != ' '){
                $usuario = $usuario.$apellido[$j];
                $j = strlen($apellido);
            }
        }
        
        if($cont > 0){
            $usuario = $usuario.$cont;
        }
        
        return $usuario;
        
    }
    
    public function AgregarActividadUsuario($_Datos){
        
        $conexion = new Ado();
        
        $pk_usuario = $_Datos['pk_usuario'];
                
        $cadena = " SELECT
                        * 
                    FROM 
                        sad_usuario 
                	WHERE
                	   pk_usuario = '$pk_usuario' "; //Realizamos una consulta
        
        $sqlResUsu = $conexion->conectarAdo($cadena);
        
        while(!$sqlResUsu->EOF) {
            
            $nombre = $sqlResUsu->fields['nombre'];            
            $apellido = $sqlResUsu->fields['apellido'];
            
            $sqlResUsu->MoveNext();
            
            }
                
        $cadena = " DELETE 
                    FROM 
                        sad_usuario_actividad 
                	WHERE
                	   fk_usuario = '$pk_usuario' "; //Realizamos una consulta
        
        $conexion->conectarAdo($cadena);
        $lista_actividades = explode(",", $_Datos['vista_check']);
        foreach ($lista_actividades as $key => $value) {
            $i=$key+1;
            while($i<=sizeof($lista_actividades)){
                if($lista_actividades[$i]==$value){
                    unset($lista_actividades[$i],$lista_actividades[$key]);
                    $i=sizeof($lista_actividades);
                }
                $i++;
            }
        }

        
        foreach($lista_actividades as $pk_actividad){
            
            $cadena = " INSERT INTO sad_usuario_actividad 
                        	(fk_actividades, fk_usuario)
                    	VALUES
                    	   ('$pk_actividad', '$pk_usuario')"; //Realizamos una consulta
            
            $conexion->conectarAdo($cadena);
            
        };
     
        $mensaje = "Se a agregado correctamente las actividades al usuario ".$nombre." ".$apellido;
        
        return $mensaje;
           
    }
    
    public function Ver_X_Proceso($_Datos){
        
        $pk_proceso = $_Datos['radio'];
        
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        pro_usu.* 
                    FROM 
                        sad_proceso_usuario pro_usu
                    WHERE
                        pro_usu.fk_proceso = $pk_proceso
                    "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    public function Ver_Pk_Usuario_X_Proceso($_Datos){
        
        $pk_proceso = $_Datos['pk_proceso'];
        
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        pro_usu.* 
                    FROM 
                        sad_proceso_usuario pro_usu
                    WHERE
                        pro_usu.fk_proceso = $pk_proceso
                    "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    public function Ver_X_Usuario_Check($_Datos){
        
        $conexion = new Ado();
        
        $pk_proceso = $_Datos['pk_proceso'];
        
        $fk_sede = $_SESSION['sad_fk_sede'];
        $fk_facultad = $_SESSION['sad_fk_facultad'];
        $fk_programa = $_SESSION['sad_fk_programa'];
        
        if($fk_sede == 1 && $fk_facultad == 1 && $fk_programa == 1){
            $cadena = " SELECT 
                            usu.* ,                            
                            prog.fk_sede,
                            prog.fk_facultad
                        FROM 
                            (sad_usuario usu,
                            sad_programa prog)
                        INNER JOIN
                            sad_proceso_usuario pro_usu
                        ON
                            pro_usu.fk_usuario = usu.pk_usuario
                        AND
                            pro_usu.fk_proceso = $pk_proceso
                        WHERE
                            prog.pk_programa = usu.fk_programa
                            "; 
        }
        else{
            $cadena = " SELECT 
                            usu.*,
                            prog.fk_sede,
                            prog.fk_facultad
                        FROM 
                            (sad_usuario usu,
                            sad_programa prog)
                        INNER JOIN
                            sad_proceso_usuario pro_usu
                        ON
                            pro_usu.fk_usuario = usu.pk_usuario
                        AND
                            pro_usu.fk_proceso = $pk_proceso
                        WHERE  
                            fk_programa = '$fk_programa' 
                        AND
                            prog.pk_programa = '$fk_programa'
                        ";
        }
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    public function Ver_X_Usuario_No_Check($_Datos){
        
        $conexion = new Ado();
        
        $pk_proceso = $_Datos['pk_proceso'];
        
        $fk_sede = $_SESSION['sad_fk_sede'];
        $fk_facultad = $_SESSION['sad_fk_facultad'];
        $fk_programa = $_SESSION['sad_fk_programa'];
        
        if($fk_sede == 1 && $fk_facultad == 1 && $fk_programa == 1){
            $cadena = " SELECT 
                            usu.* ,                            
                            prog.fk_sede,
                            prog.fk_facultad
                        FROM 
                            sad_usuario usu,
                            sad_programa prog                        
                        WHERE
                                prog.pk_programa = usu.fk_programa
                            AND
				                usu.pk_usuario NOT IN(  SELECT 
                                                            pro_usu.fk_usuario
                                                        FROM 
                                                            sad_proceso_usuario pro_usu
                                                        WHERE 
							                                 pro_usu.fk_proceso = $pk_proceso)"; 
        }
        else{
            $cadena = " SELECT 
                            usu.*,
                            prog.fk_sede,
                            prog.fk_facultad
                        FROM 
                            (sad_usuario usu,
                            sad_programa prog)
                        INNER JOIN
                            sad_proceso_usuario pro_usu
                        ON
                            pro_usu.fk_usuario = usu.pk_usuario
                        AND
                            pro_usu.fk_proceso = $pk_proceso
                        WHERE  
                            fk_programa = '$fk_programa' 
                        AND
                            prog.pk_programa = '$fk_programa'
                        AND
			                usu.pk_usuario NOT IN(  SELECT 
                                                        pro_usu.fk_usuario
                                                    FROM 
                                                        sad_proceso_usuario pro_usu
                                                    WHERE 
						                                 pro_usu.fk_proceso = $pk_proceso)";
        }
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    public function Ver_X_Rol($_Datos){
        
        $pk_rol = $_Datos['radio'];
        
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        usu.* 
                    FROM 
                        sad_usuario usu
                    WHERE
                        usu.fk_rol = $pk_rol
                    "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    public function Ver_X_Pk_Rol($_Datos){
        
        $pk_rol = $_Datos['pk_rol'];
        
        $conexion = new Ado();
        
        $cadena = " SELECT 
                        usu.* 
                    FROM 
                        sad_usuario usu
                    WHERE
                        usu.fk_rol = $pk_rol
                    "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    public function Ver(){
        
        $conexion = new Ado();
        
        $fk_sede = $_SESSION['sad_fk_sede'];
        $fk_facultad = $_SESSION['sad_fk_facultad'];
        $fk_programa = $_SESSION['sad_fk_programa'];
        
        if($fk_sede == 1 && $fk_facultad == 1 && $fk_programa == 1){
            $cadena = " SELECT 
                            usu.* ,                            
                            prog.fk_sede,
                            prog.fk_facultad
                        FROM 
                            sad_usuario usu,
                            sad_programa prog
                        WHERE
                            prog.pk_programa = usu.fk_programa
                            "; 
        }
        else{
            $cadena = " SELECT 
                            usu.*,
                            prog.fk_sede,
                            prog.fk_facultad
                        FROM 
                            sad_usuario usu,
                            sad_programa prog
                        WHERE  
                            fk_programa = '$fk_programa' 
                        AND
                            prog.pk_programa = '$fk_programa'
                        ";
        }
        
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    public function Ver_X_Proceso_sede($datos){
        
        $conexion = new Ado();
        
        $proceso = $datos['radio'];
        
        $cadena = " SELECT 
                        * 
                    FROM 
                        cna_proceso
                    WHERE
                        pk_proceso = '$proceso'
                        ";
                            
        $resSql = $conexion->conectarAdo($cadena);
        
        while(!$resSql->EOF){
            
            $programa = $resSql->fields['fk_programa'];
            
            $resSql->MoveNext();
        }
        
        $fk_sede = $_SESSION['sad_fk_sede'];
        $fk_facultad = $_SESSION['sad_fk_facultad'];
        $fk_programa = $_SESSION['sad_fk_programa'];
        
        if($fk_sede == 1 && $fk_facultad == 1 && $fk_programa == 1){
            $cadena = " SELECT 
                            usu.* ,                            
                            prog.fk_sede,
                            prog.fk_facultad
                        FROM 
                            sad_usuario usu,
                            sad_programa prog
                        WHERE
                            prog.pk_programa = usu.fk_programa
                        AND
                            usu.fk_programa = '$programa'
                            "; 
        }
        else{
            $cadena = " SELECT 
                            usu.*,
                            prog.fk_sede,
                            prog.fk_facultad
                        FROM 
                            sad_usuario usu,
                            sad_programa prog
                        WHERE  
                            fk_programa = '$fk_programa' 
                        AND
                            prog.pk_programa = '$fk_programa'
                        ";
        }
        
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        return $recordSet;
        
    }
    
    function RestaurarClave($Datos){
        
        $conexion = new Ado();
        
        $Correo = $Datos['correo'];
        
        $pk_usuario = 0;
        
        $cadena = " SELECT
                        *
                    FROM 
                        sad_usuario                 	               	
                	WHERE
                	   correo = '$Correo' ;"; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
          
        if(!$recordSet->EOF){    
            
            while(!$recordSet->EOF) {
                
                $pk_usuario = $recordSet->fields['pk_usuario'];
                $Nombre = $recordSet->fields['nombre'];
                $Apellido = $recordSet->fields['apellido'];
                $Usuario = $recordSet->fields['usuario'];
                
                $recordSet->MoveNext();
                
                }
            

            $Clave = $this->GenerarClave();

            echo $Clave;
            //exit();

            $pass = crypt($Clave, '$1$rasmusle$');
            
            $conexion = new Ado();
            
            $cadena = " UPDATE 
                            sad_usuario 
                    	SET
                        	pk_usuario = pk_usuario , 
                        	cedula = cedula , 
                        	nombre = nombre , 
                        	apellido = apellido , 
                        	correo = correo , 
                        	usuario = usuario , 
                        	clave = '$pass' , 
                        	estado = estado , 
                        	fk_rol = fk_rol , 
                        	fk_programa = fk_programa                	
                    	WHERE
                    	   pk_usuario = '$pk_usuario' ;"; 
            
            $conexion->conectarAdo($cadena);

            //exit();
            
            $Modelo_Cor = new Correo();
            
            $Modelo_Cor->Enviar_Correo($Nombre, $Apellido, $Correo, $Usuario, $Clave);
            
        }
        

      // echo '<SCRIPT LANGUAGE="javascript">location.href = "../Controlador/VIS_Cerrar_Session_Controlador.php";</SCRIPT>';

          
    }
    
    function ModificarClave($datos){
        
        $clave_actual = $datos['clave_actual'];
        $clave_nueva = $datos['clave_nueva'];        
        $pk_usuario = $_SESSION['pk_usuario'];
        
        $pass_actual = crypt($clave_actual, '$1$rasmusle$');

        $pass_nuevo = crypt($clave_nueva, '$1$rasmusle$');

        $conexion = new Ado();
        
        $cadena = " UPDATE 
                        sad_usuario 
                	SET
                    	pk_usuario = pk_usuario , 
                    	cedula = cedula , 
                    	nombre = nombre , 
                    	apellido = apellido , 
                    	correo = correo , 
                    	usuario = usuario , 
                    	clave = '$pass_nuevo' , 
                    	estado = estado , 
                    	fk_rol = fk_rol , 
                    	fk_programa = fk_programa	 
                    WHERE 
                        clave = '$pass_actual'
                        AND  pk_usuario = '$pk_usuario'
                    "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        echo '<SCRIPT LANGUAGE="javascript">location.href = "../Controlador/VIS_Cerrar_Session_Controlador.php";</SCRIPT>';
                
    }
    
    public function Agregar($datos){
        
        global $mensaje;
    
        $Nombre = $datos['nombre'];
        $Apellido = $datos['apellido'];
        $Correo = $datos['correo'];
        $Cedula = $datos['cedula'];
        $Estado = 1;
        $Rol = $datos['rol'];
        $Programa = $datos['programa'];        
        
        $Usuario = $this->GenerarUsuario($Nombre, $Apellido, "0");
        $Clave = $this->GenerarClave();
        
        $pass = crypt($Clave, '$1$rasmusle$');
        
        $conexion = new Ado();        
        
        $cadena = " SELECT
                        *
                    FROM 
                        sad_usuario                 	               	
                	WHERE
                        cedula = '$Cedula'
                        "; 
        
        $resSqlFiltro = $conexion->conectarAdo($cadena);
                
        $Estado_Rep = "on";
        
        while(!$resSqlFiltro->EOF) {
            if($resSqlFiltro->fields['pk_usuario'] != "" || $resSqlFiltro->fields['pk_usuario'] != " "){
                $Estado_Rep = "off";
                
            }
            
            $resSqlFiltro->MoveNext();
            
        }
        
        if($Estado_Rep == "on"){
            
            $cadena = " SELECT
                            *
                        FROM 
                            sad_usuario                 	               	
                    	WHERE
                            usuario LIKE '$Usuario%' 
                            "; 
            
            $recordSet = $conexion->conectarAdo($cadena);
            
            $cont = 0;
            
            while(!$recordSet->EOF) {
                
                $cont = $cont + 1;
                
                $recordSet->MoveNext();
                
                }
            
            if($cont > 0){
                $cont = $cont+1;
            }
            
            $Usuario = $this->GenerarUsuario($Nombre, $Apellido, $cont);
            
            $cadena = " INSERT INTO 
                            sad_usuario
                            (pk_usuario, cedula, nombre, apellido, correo, usuario, clave, estado, fk_rol, fk_programa) 
                        VALUE 
                            (0, '$Cedula', '$Nombre', '$Apellido', '$Correo', '$Usuario', '$pass', '$Estado', '$Rol', '$Programa')
                        "; 
            
            $conexion->conectarAdo($cadena);
            
            $cadena = " SELECT
                            *
                        FROM 
                            sad_usuario                 	               	
                    	WHERE
                                cedula = '$Cedula' 
                            AND
                                usuario = '$Usuario'
                            "; 
            
            $resSqlPkUsuario = $conexion->conectarAdo($cadena);
            
            while(!$resSqlPkUsuario->EOF) {
                
                $pk_usuario = $resSqlPkUsuario->fields['pk_usuario'];
                
                $resSqlPkUsuario->MoveNext();
                
                }            
            
            foreach($datos['pk_tipo_usuario'] as $pk_tipo_usuario){
                
                $cadena = " INSERT INTO sad_usuario_tipo_usuario 
                            	(fk_tipo_usuario, fk_usuario)
                        	VALUES
                            	('$pk_tipo_usuario', '$pk_usuario')"; //Realizamos una consulta
                
                $conexion->conectarAdo($cadena);
                
            }   
            
            $Modelo_Cor = new Correo();
            
            $mensaje = $Modelo_Cor->Enviar_Correo($Nombre, $Apellido, $Correo, $Usuario, $Clave);
            
            $Modelo_Seg = new Seguridad();
            
            $observacion =  "Se creo un nuevo usuario con el nombre de : ".$Nombre." ".$Apellido.
                            " con el correo : ".$Correo.
                            " en el programa : ".$Programa;
                            
            $transaccion = "crear usuario";
            
            $Modelo_Seg->Seguridad_Enviar($observacion, $transaccion);
             
        }        
        else{
            $mensaje = "<h2> Ya existe un usuario con la misma cedula.</h2>";
        }
            
        
        return $mensaje; 
    }
    
    function Modificar($_Datos){
        
        $conexion = new Ado();        
        
        $pk_usuario = $_Datos['pk_usuario'];
        $fk_programa = $_Datos['programa'];
        $fk_rol = $_Datos['rol'];
        $correo = $_Datos['correo'];
        $apellido = $_Datos['apellido'];
        $nombre = $_Datos['nombre'];
        $cedula = $_Datos['cedula'];
        
        $cadena = " UPDATE 
                        sad_usuario 
                	SET
                    	pk_usuario = pk_usuario , 
                    	cedula = '$cedula' , 
                    	nombre = '$nombre' , 
                    	apellido = '$apellido' , 
                    	correo = '$correo' , 
                    	usuario = usuario , 
                    	clave = clave , 
                    	estado = estado , 
                    	fk_rol = '$fk_rol' , 
                    	fk_programa = '$fk_programa'                	
                	WHERE
                	   pk_usuario = '$pk_usuario'
                    ";
        
        $conexion->conectarAdo($cadena);
        
        $cadena = " DELETE FROM 
                        sad_usuario_tipo_usuario 
                	WHERE
                	   fk_usuario = $pk_usuario
                    ";
        
        $conexion->conectarAdo($cadena);
        
        foreach($_Datos['pk_tipo_usuario'] as $pk_tipo_usuario){
            
            $cadena = " INSERT INTO sad_usuario_tipo_usuario 
                        	(fk_tipo_usuario, fk_usuario)
                    	VALUES
                        	('$pk_tipo_usuario', '$pk_usuario')"; //Realizamos una consulta
            
            $conexion->conectarAdo($cadena);
            
        }       
        
        $mensaje = "Se a modificado correctamente al usuario ".$nombre." ".$apellido;
        
        return $mensaje;
        
    }
    
    function CambiarEstado($_Datos){
        
        $conexion = new Ado();
        
        $pk_usuario = $_Datos['radio'];
        
        $cadena = " SELECT
                        * 
                	FROM
                	   sad_usuario               	
                	WHERE
                	   pk_usuario = $pk_usuario "; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        while(!$recordSet->EOF){
            
            $estado = $recordSet->fields['estado'];
            $nombre = $recordSet->fields['nombre'];
            $apellido = $recordSet->fields['apellido'];
            
            $recordSet->MoveNext(); 
            
        }     
        
        if($estado == "1"){
        
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
                        	estado = 0 , 
                        	fk_rol = fk_rol , 
                        	fk_programa = fk_programa                    	
                    	WHERE
                    	   pk_usuario = $pk_usuario ; "; 
                       
        }
        else{
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
                        	estado = 1 , 
                        	fk_rol = fk_rol , 
                        	fk_programa = fk_programa                    	
                    	WHERE
                    	   pk_usuario = $pk_usuario ; ";
        }
        
        $conexion->conectarAdo($cadena);        
        
        $mensaje = "Se a cambiado el estado correctamente al usuario ".$nombre." ".$apellido;
        
        return $mensaje;
        
    }
    
    function Ver_X_Usuario($_Datos){
        
        $conexion = new Ado();
        
        $pk_usuario = $_Datos['radio'];
        
        $cadena = " SELECT
                        usu.*, 
                        sede.pk_sede, 
                        sede.nombre as nombre_sede,
                        fac.pk_facultad,
                        fac.nombre as nombre_facultad,
                        prog.nombre as nombre_programa
                	FROM
                	   sad_usuario usu,
                       sad_sede sede,
                       sad_facultad fac,
                       sad_programa prog               	
                	WHERE
                            usu.pk_usuario = $pk_usuario 
                        AND
                            prog.pk_programa = usu.fk_programa
                        AND
                            prog.fk_sede = sede.pk_sede
                        AND
                            prog.fk_facultad = fac.pk_facultad"; 
        
        $recordSet = $conexion->conectarAdo($cadena);
        
        $arrayDatos = array();
        
        while(!$recordSet->EOF){
            
            $arrayDatos[] = array(
                            "pk_usuario"=>$recordSet->fields['pk_usuario'],
                            "cedula"=>$recordSet->fields['cedula'],
                            "nombre"=>$recordSet->fields['nombre'],
                            "apellido"=>$recordSet->fields['apellido'],
                            "correo"=>$recordSet->fields['correo'],
                            "fk_rol"=>$recordSet->fields['fk_rol'],
                            "fk_programa"=>$recordSet->fields['fk_programa'],
                            "pk_sede"=>$recordSet->fields['pk_sede'],
                            "nombre_sede"=>$recordSet->fields['nombre_sede'],
                            "pk_facultad"=>$recordSet->fields['pk_facultad'],
                            "nombre_facultad"=>$recordSet->fields['nombre_facultad'],
                            "nombre_programa"=>$recordSet->fields['nombre_programa']
                            );
            
            $recordSet->MoveNext();
        }
        
        return $arrayDatos;
        
    }
    
    function Ver_X_Pk_Usuario($_Datos){
        
        $conexion = new Ado();
        
        $pk_usuario = $_Datos['pk_usuario'];
        
        $cadena = " SELECT
                        usu.*, 
                        sede.pk_sede, 
                        sede.nombre as nombre_sede,
                        fac.pk_facultad,
                        fac.nombre as nombre_facultad,
                        prog.nombre as nombre_programa
                	FROM
                	   sad_usuario usu,
                       sad_sede sede,
                       sad_facultad fac,
                       sad_programa prog               	
                	WHERE
                            usu.pk_usuario = $pk_usuario 
                        AND
                            prog.pk_programa = usu.fk_programa
                        AND
                            prog.fk_sede = sede.pk_sede
                        AND
                            prog.fk_facultad = fac.pk_facultad"; 

        $recordSet = $conexion->conectarAdo($cadena);
        
        $arrayDatos = array();
        
        while(!$recordSet->EOF){
            
            $arrayDatos[] = array(
                            "pk_usuario"=>$recordSet->fields['pk_usuario'],
                            "cedula"=>$recordSet->fields['cedula'],
                            "nombre"=>$recordSet->fields['nombre'],
                            "apellido"=>$recordSet->fields['apellido'],
                            "correo"=>$recordSet->fields['correo'],
                            "fk_rol"=>$recordSet->fields['fk_rol'],
                            "fk_programa"=>$recordSet->fields['fk_programa'],
                            "pk_sede"=>$recordSet->fields['pk_sede'],
                            "nombre_sede"=>$recordSet->fields['nombre_sede'],
                            "pk_facultad"=>$recordSet->fields['pk_facultad'],
                            "nombre_facultad"=>$recordSet->fields['nombre_facultad'],
                            "nombre_programa"=>$recordSet->fields['nombre_programa']
                            );
            
            $recordSet->MoveNext();
        }
        
        return $arrayDatos;
        
    }
    
}
?>