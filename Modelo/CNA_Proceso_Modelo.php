<?php

class Proceso {

    function Ver() {
        require_once("../BaseDatos/AdoDB.php");
        $conexion = new Ado();

        $fk_sede = $_SESSION['sad_fk_sede'];
        $fk_facultad = $_SESSION['sad_fk_facultad'];
        $fk_programa = $_SESSION['sad_fk_programa'];

        if ($fk_sede == 1 && $fk_facultad == 1 && $fk_programa == 1) {

            $cadena = " SELECT 
                        * 
                    FROM 
                        cna_proceso
                    ";

            $recordSet = $conexion->conectarAdo($cadena);
        } else {


            $cadena = " SELECT 
                        * 
                    FROM 
                        cna_proceso
		    WHERE  
                        fk_programa = '$fk_programa'
                    ";

            $recordSet = $conexion->conectarAdo($cadena);
        }

        return $recordSet;
    }

    function Ver_Proceso_Unico($id_proceso) {
        $conexion = new Ado();
            $cadena = " SELECT
                                cp.*, sp.nombre AS nombre_programa,
                                ss.nombre AS nombre_sede
                        FROM
                                cna_proceso cp
                        JOIN sad_programa sp ON sp.pk_programa = cp.fk_programa
                        JOIN sad_sede ss ON ss.pk_sede = sp.fk_sede
                        AND cp.fk_fase <> '1' 
                        AND cp.pk_proceso = {$id_proceso}
                    ";

        $recordSet = $conexion->conectarAdo($cadena);
        return $recordSet;
    }

    function Ver_Procesos() {
        require_once("../BaseDatos/AdoDB.php");
        $conexion = new Ado();

        $fk_sede = $_SESSION['sad_fk_sede'];
        $fk_facultad = $_SESSION['sad_fk_facultad'];
        $fk_programa = $_SESSION['sad_fk_programa'];

        if ($fk_sede == 1 || $fk_facultad == 1 || $fk_programa == 1) {

            $cadena = " SELECT
                                cp.*, sp.nombre AS nombre_programa,
                                ss.nombre AS nombre_sede
                        FROM
                                cna_proceso cp
                        JOIN sad_programa sp ON sp.pk_programa = cp.fk_programa
                        JOIN sad_sede ss ON ss.pk_sede = sp.fk_sede
                        AND cp.fk_fase <> '1'
                    ";
        } else {


            $cadena = " SELECT
                                cp.*, sp.nombre AS nombre_programa,
                                ss.nombre AS nombre_sede
                        FROM
                                cna_proceso cp
                        JOIN sad_programa sp ON sp.pk_programa = cp.fk_programa
                        JOIN sad_sede ss ON ss.pk_sede = sp.fk_sede
                        AND cp.fk_fase <> '1 
                        AND sp.pk_programa = {$fk_programa}";
        }
        $recordSet = $conexion->conectarAdo($cadena);
        return $recordSet;
    }

    function Ver_X_Proceso($datos) {

        $pk_proceso = $datos['radio'];

        $conexion = new Ado();

        $cadena = " SELECT 
                        proc.*, 
                        facu.pk_facultad
                    FROM 
                        cna_proceso proc,
                        sad_programa prog,
                        sad_facultad facu 
                    WHERE 
                            proc.pk_proceso = '$pk_proceso'
                        AND
                            prog.pk_programa = proc.fk_programa
                        AND
                            prog.fk_facultad = facu.pk_facultad
                    ";

        $recordSet = $conexion->conectarAdo($cadena);

        return $recordSet;
    }

    function Ver_X_Pk_Proceso($datos) {

        $pk_proceso = $datos['pk_proceso'];

        $conexion = new Ado();

        $cadena = " SELECT 
                        proc.*, 
                        facu.pk_facultad
                    FROM 
                        cna_proceso proc,
                        sad_programa prog,
                        sad_facultad facu 
                    WHERE 
                            proc.pk_proceso = '$pk_proceso'
                        AND
                            prog.pk_programa = proc.fk_programa
                        AND
                            prog.fk_facultad = facu.pk_facultad
                    ";

        $recordSet = $conexion->conectarAdo($cadena);

        return $recordSet;
    }

    function Agregar($_Datos) {

        $nombre = $_Datos['nombre'];
        $fecha_inicio = $_Datos['fechaI'];
        $fecha_fin = $_Datos['fechaF'];
        $descripcion = $_Datos['descripcion'];
        $observacion = $_Datos['observacion'];
        $fk_programa = $_Datos['programa'];
        $fk_sede = $_Datos['sede'];

        $conexion = new Ado();

        $estado = "off";

        $cadena = " SELECT 
                        * 
                    FROM 
                        cna_proceso 
                    WHERE 
                        fk_sede = $fk_sede 
                    AND 
                        fk_programa = $fk_programa ";

        $resSql = $conexion->conectarAdo($cadena);

        while (!$resSql->EOF) {

            if ($resSql->fields['fk_fase'] != "1") {
                $estado = "on";
            }

            $resSql->MoveNext();
        }

        if ($estado == "off") {

            $cadena = " SELECT 
                            * 
                        FROM 
                            cna_proceso_institucional 
                        WHERE
                            estado = 1";

            $resSql = $conexion->conectarAdo($cadena);

            while (!$resSql->EOF) {

                $fecha_proceso_institucional = $resSql->fields['fecha'];
                $proceso_institucional = $resSql->fields['pk_proceso_institucional'];

                $resSql->MoveNext();
            }

            $ano = date("Y");

            if ($fecha_proceso_institucional == $ano) {
                
            } else {
                $cadena = " UPDATE 
                                cna_proceso_institucional 
                        	SET
                            	pk_proceso_institucional = pk_proceso_institucional , 
                            	nombre = nombre , 
                            	fecha = fecha , 
                            	estado = '0'";

                $conexion->conectarAdo($cadena);

                $cadena = " INSERT INTO omzsiste_sia.cna_proceso_institucional 
                            	(pk_proceso_institucional, 
                            	nombre, 
                            	fecha, 
                            	estado)
                        	VALUES
                            	(NULL, 
                            	'proceso institucional $ano', 
                            	'$ano', 
                            	'1'); ";

                $conexion->conectarAdo($cadena);

                $cadena = " SELECT 
                                * 
                            FROM 
                                cna_proceso_institucional ";

                $resSql = $conexion->conectarAdo($cadena);

                while (!$resSql->EOF) {

                    $proceso_institucional = $resSql->fields['pk_proceso_institucional'];

                    $resSql->MoveNext();
                }
            }

            $cadena = " INSERT INTO 
                            cna_proceso
                        	(pk_proceso, 
                            nombre, 
                            fecha_inicio, 
                            fecha_fin, 
                            descripcion, 
                            observacion, 
                            fk_fase, 
                            fk_programa, 
                            fk_sede,    	
    			            fk_proceso_institucional)
                    	VALUES
                        	(NULL, 
                        	'$nombre', 
                            '$fecha_inicio', 
                            '$fecha_fin', 
                            '$descripcion', 
                            '$observacion', 
                            '3', 
                            '$fk_programa', 
                            '$fk_sede',
    			            '$proceso_institucional')
                            ";

            $conexion->conectarAdo($cadena);

            $mensaje = "Se a agregado correctamente el proceso : " . $nombre;
        } else {

            $mensaje = "Ya existe un proceso y esta abierto";
        }
        return $mensaje;
    }

    function Agregar_Multi($_Datos) {

        $nombre = $_Datos['nombre'];
        $fecha_inicio = $_Datos['fechaIM'];
        $fecha_fin = $_Datos['fechaFM'];
        $descripcion = $_Datos['descripcion'];
        $observacion = $_Datos['observacion'];

        $mensaje = '';

        $conexion = new Ado();

        $estado = "off";

        foreach ($_Datos['pk_sede'] as $fk_sede) {
            foreach ($_Datos['programa'] as $fk_programa) {

                $cadena = " SELECT
                                prog.*,
                                sede.nombre AS nombre_sede
                            FROM 
                                sad_programa prog,
                                sad_sede sede
                            WHERE
                                sede.pk_sede = '$fk_sede'
                            AND
                                prog.fk_sede = '$fk_sede'
                            AND
                                prog.pk_programa = '$fk_programa'";

                $resSqlSedePrograma = $conexion->conectarAdo($cadena);

                while (!$resSqlSedePrograma->EOF) {

                    if ($resSqlSedePrograma->fields['pk_programa'] != "1") {

                        $nombre_programa = $resSqlSedePrograma->fields['nombre'];
                        $nombre_sede = $resSqlSedePrograma->fields['nombre_sede'];

                        $cadena = " SELECT 
                                        * 
                                    FROM 
                                        cna_proceso 
                                    WHERE 
                                        fk_sede = $fk_sede 
                                    AND 
                                        fk_programa = $fk_programa ";

                        $resSql = $conexion->conectarAdo($cadena);

                        while (!$resSql->EOF) {

                            if ($resSql->fields['fk_fase'] != "1") {
                                $estado = "on";
                            }

                            $resSql->MoveNext();
                        }

                        if ($estado == "off") {

                            $cadena = " SELECT 
                                            * 
                                        FROM 
                                            cna_proceso_institucional 
                                        WHERE
                                            estado = 1";

                            $resSql = $conexion->conectarAdo($cadena);

                            while (!$resSql->EOF) {

                                $fecha_proceso_institucional = $resSql->fields['fecha'];
                                $proceso_institucional = $resSql->fields['pk_proceso_institucional'];

                                $resSql->MoveNext();
                            }

                            $ano = date("Y");

                            if ($fecha_proceso_institucional == $ano) {
                                
                            } else {
                                $cadena = " UPDATE 
                                                cna_proceso_institucional 
                                        	SET
                                            	pk_proceso_institucional = pk_proceso_institucional , 
                                            	nombre = nombre , 
                                            	fecha = fecha , 
                                            	estado = '0'";

                                $conexion->conectarAdo($cadena);

                                $cadena = " INSERT INTO omzsiste_sia.cna_proceso_institucional 
                                            	(pk_proceso_institucional, 
                                            	nombre, 
                                            	fecha, 
                                            	estado)
                                        	VALUES
                                            	(NULL, 
                                            	'proceso institucional $ano', 
                                            	'$ano', 
                                            	'1'); ";

                                $conexion->conectarAdo($cadena);

                                $cadena = " SELECT 
                                                * 
                                            FROM 
                                                cna_proceso_institucional ";

                                $resSql = $conexion->conectarAdo($cadena);

                                while (!$resSql->EOF) {

                                    $proceso_institucional = $resSql->fields['pk_proceso_institucional'];

                                    $resSql->MoveNext();
                                }
                            }

                            $cadena = " INSERT INTO 
                                            cna_proceso
                                        	(pk_proceso, 
                                            nombre, 
                                            fecha_inicio, 
                                            fecha_fin, 
                                            descripcion, 
                                            observacion, 
                                            fk_fase, 
                                            fk_programa, 
                                            fk_sede,    	
                    			            fk_proceso_institucional)
                                    	VALUES
                                        	(NULL, 
                                        	'$nombre - $nombre_sede - $nombre_programa', 
                                            '$fecha_inicio', 
                                            '$fecha_fin', 
                                            '$descripcion', 
                                            '$observacion', 
                                            '3', 
                                            '$fk_programa', 
                                            '$fk_sede',
                    			            '$proceso_institucional')
                                            ";

                            $conexion->conectarAdo($cadena);



                            $mensaje = $mensaje . "<br />Se a agregado correctamente el proceso : " . $nombre . " - " . $nombre_sede . " - " . $nombre_programa;
                        } else {

                            $mensaje = $mensaje . "<br />Ya existe un proceso y esta abierto : " . $nombre_sede . " - " . $nombre_programa;
                        }
                    }

                    $resSqlSedePrograma->MoveNext();
                }
            }
        }
        return $mensaje;
    }

    function Modificar($_Datos) {

        $pk_proceso = $_Datos['pk_proceso'];
        $nombre = $_Datos['nombre'];
        $fecha_inicio = $_Datos['fechaI'];
        $fecha_fin = $_Datos['fechaF'];
        $descripcion = $_Datos['descripcion'];
        $observacion = $_Datos['observacion'];
        $fk_fase = $_Datos['fase'];
        $fk_programa = $_Datos['programa'];
        $fk_sede = $_Datos['sede'];

        $conexion = new Ado();

        $cadena = " UPDATE 
                        cna_proceso 
                	SET
                    	pk_proceso = pk_proceso,
                        nombre = '$nombre',
                        fecha_inicio = '$fecha_inicio',
                        fecha_fin = '$fecha_fin',
                        descripcion = '$descripcion',
                        observacion = '$observacion',
                        fk_fase = '$fk_fase',
                        fk_programa = '$fk_programa',
                        fk_sede = '$fk_sede'           	
                	WHERE
                	   pk_proceso = '$pk_proceso'
                    ";

        $conexion->conectarAdo($cadena);

        $mensaje = "Se a modificado correctamente el proceso : " . $nombre;

        return $mensaje;
    }

    function CambiarEstado($_Datos) {

        $conexion = new Ado();

        $fase = $_Datos['fase'];

        foreach ($_Datos['check'] as $pk_proceso) {

            $cadena = " UPDATE 
                            cna_proceso 
                        SET
                            pk_proceso = pk_proceso , 
                            nombre = nombre , 
                            fecha_inicio = fecha_inicio , 
                            fecha_fin = fecha_fin , 
                            descripcion = descripcion , 
                            observacion = observacion , 
                            fk_fase = '$fase' , 
                            fk_programa = fk_programa , 
                            fk_sede = fk_sede                       
                        WHERE
                            pk_proceso = '$pk_proceso' ;";

            $conexion->conectarAdo($cadena);
        };

        $mensaje = "Se ha modificado correctamente el Proceso";

        return $mensaje;
    }

    function Agregar_Proceso_Usuario($_Datos) {

        $conexion = new Ado();

        $pk_proceso = $_Datos['pk_proceso'];

        $cadena = " SELECT
                        * 
                    FROM 
                        cna_proceso 
                	WHERE
                	   pk_proceso = '$pk_proceso' "; //Realizamos una consulta

        $sqlResUsu = $conexion->conectarAdo($cadena);

        while (!$sqlResUsu->EOF) {

            $nombre = $sqlResUsu->fields['nombre'];

            $sqlResUsu->MoveNext();
        }

        $cadena = " DELETE 
                    FROM 
                        sad_proceso_usuario 
                	WHERE
                	   fk_proceso = '$pk_proceso' "; //Realizamos una consulta

        $conexion->conectarAdo($cadena);

        foreach ($_Datos['check'] as $pk_usuario) {

            $cadena = " INSERT INTO sad_proceso_usuario 
                        	(fk_proceso, fk_usuario)
                    	VALUES
                    	   ('$pk_proceso', '$pk_usuario')"; //Realizamos una consulta

            $conexion->conectarAdo($cadena);
        };

        $mensaje = "Se a agregado correctamente los usuarios al proceso : " . $nombre;

        return $mensaje;
    }

}

?>