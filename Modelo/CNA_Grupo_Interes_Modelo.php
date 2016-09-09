<?php

class Grupo_Interes {

    function getAllSubgrupo_interes($id_grupointeres) {
        require_once("../BaseDatos/AdoDB.php");
        $conDB = new Ado();

        $sql = "SELECT * FROM cna_subgrupo_interes where fk_grupo_interes = {$id_grupointeres} AND estado = 1";
        $res = $conDB->conectarAdo($sql);
        return $res;
    }
    
     function alcance_grupo_interes($id_grupointeres) {
        require_once("../BaseDatos/AdoDB.php");
        $conDB = new Ado();
        $sql = "SELECT
                        alcance.pk_alcance_autoevaluacion
                FROM
                        cna_alcance_autoevaluacion alcance
                JOIN cna_grupo_interes grupo_interes ON grupo_interes.fk_alcance_autoevaluacion = alcance.pk_alcance_autoevaluacion
                WHERE
                grupo_interes.pk_grupo_interes = '{$id_grupointeres}'";
        $res = $conDB->conectarAdo($sql);
        return $res->fields[0];
    }

    function Archivo_Evidencia_X_Grupo_Interes($Datos) {

        $conexion = new Ado();

        $archivo = $Datos;

        require_once('../PHPExcel/Classes/PHPExcel.php');
        require_once('../PHPExcel/Classes/PHPExcel/Reader/Excel2007.php');

        // Cargando la hoja de c�lculo

        $objReader = new PHPExcel_Reader_Excel2007();
        $objPHPExcel = $objReader->load($archivo);
        $objFecha = new PHPExcel_Shared_Date();
        // Asignar hoja de excel activa        
        $objPHPExcel->setActiveSheetIndex(0);

        // Llenamos el arreglo con los datos  del archivo xlsx

        for ($i = 2; $i <= 500; $i++) {
            $_DATOS_EXCEL[$i - 1]['tipo'] = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $_DATOS_EXCEL[$i - 1]['modulo'] = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
            $_DATOS_EXCEL[$i - 1]['grupo interes'] = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
            $_DATOS_EXCEL[$i - 1]['codigo'] = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
        }

        //recorremos el arreglo multidimensional        
        //para ir recuperando los datos obtenidos        
        //del excel e ir insertandolos en la BD

        foreach ($_DATOS_EXCEL as $campo => $valor) {

            if ($valor['tipo'] == 'GA') {

                $conexion = new Ado();

                $modulo = $valor['modulo'];
                $grupo_interes = $valor['grupo interes'];
                $codigo = $valor['codigo'];

                $cadena = "SELECT * FROM cna_grupo_interes WHERE nombre = '$grupo_interes' ";
                $resSqlModCons = $conexion->conectarAdo($cadena);

                if (!$resSqlModCons->EOF) {

                    while (!$resSqlModCons->EOF) {
                        $fk_grupo_interes = $resSqlModCons->fields['pk_grupo_interes'];
                        $resSqlModCons->MoveNext();
                    }
                } else {

                    $cadena = " INSERT INTO 
                                    cna_grupo_interes 
                                	(pk_grupo_interes, 
                                	nombre, 
                                	descripcion, 
                                	estado)
                            	VALUES
                                	(NULL, 
                                	'$grupo_interes', 
                                	descripcion, 
                                	'1');";

                    $conexion->conectarAdo($cadena);

                    $cadena = "SELECT * FROM cna_grupo_interes WHERE nombre = '$grupo_interes' ";
                    $resSqlGru = $conexion->conectarAdo($cadena);

                    while (!$resSqlGru->EOF) {
                        $fk_grupo_interes = $resSqlGru->fields['pk_grupo_interes'];
                        $resSqlGru->MoveNext();
                    }
                }

                $cadena = "SELECT * FROM sad_modulos WHERE nombre LIKE '%$modulo%' ";
                $resSqlModCons = $conexion->conectarAdo($cadena);

                if (!$resSqlModCons->EOF) {

                    while (!$resSqlModCons->EOF) {
                        $fk_modulo = $resSqlModCons->fields['pk_modulo'];
                        $resSqlModCons->MoveNext();
                    }
                }

                $cadena = "SELECT * FROM cna_evidencia WHERE codigo = '$codigo' ";
                $resSqlModCons = $conexion->conectarAdo($cadena);

                if (!$resSqlModCons->EOF) {

                    while (!$resSqlModCons->EOF) {
                        $fk_evidencia = $resSqlModCons->fields['pk_evidencia'];
                        $resSqlModCons->MoveNext();
                    }
                }

                $cadena = " SELECT 
                                * 
                            FROM 
                                cna_evidencia_grupo_interes 
                            WHERE 
                                    fk_grupo_interes = '$fk_grupo_interes'
                                AND
                                    fk_evidencia = '$fk_evidencia'
                                AND
                                    fk_modulo = '$fk_modulo';";

                $resSqlModCons = $conexion->conectarAdo($cadena);

                if (!$resSqlModCons->EOF) {


                    $cadena = " UPDATE 
                                    cna_evidencia_grupo_interes 
                            	SET
                                    pk_evidencia_grupo_interes = pk_evidencia_grupo_interes , 
                                    fk_grupo_interes = fk_grupo_interes , 
                                    fk_evidencia = fk_evidencia , 
                                    fk_modulo = fk_modulo , 
                                    estado = '1'                	
                            	WHERE
                                        fk_grupo_interes = '$fk_grupo_interes'
                                    AND
                                        fk_evidencia = '$fk_evidencia'
                                    AND
                                        fk_modulo = '$fk_modulo';";

                    $conexion->conectarAdo($cadena);
                } else {

                    $cadena = " INSERT INTO 
                                    cna_evidencia_grupo_interes 
                                   (pk_evidencia_grupo_interes, 
                                	fk_grupo_interes, 
                                	fk_evidencia, 
                                	fk_modulo, 
                                	estado)
                                VALUES
                                	('pk_evidencia_grupo_interes', 
                                	'$fk_grupo_interes', 
                                	'$fk_evidencia', 
                                	'$fk_modulo', 
                                	'1');";

                    $conexion->conectarAdo($cadena);
                }
            }
        }
    }

    function AgregarArchivo($Datos) {

        $conexion = new Ado();

        $ruta = "../Archivos/";

        $estado = "off";

        $cadena = " SELECT 
                        * 
                    FROM 
                        cna_proceso; ";

        $resSql = $conexion->conectarAdo($cadena);

        while (!$resSql->EOF) {

            if ($resSql->fields['fk_fase'] != "1") {
                $estado = "on";
            }

            $resSql->MoveNext();
        }

        if ($estado == "off") {

            foreach ($Datos as $key) {
                if ($key['error'] == UPLOAD_ERR_OK) {//Verificamos si se subio correctamente
                    $nombre = $key['name']; //Obtenemos el nombre del archivo
                    $temporal = $key['tmp_name']; //Obtenemos el nombre del archivo temporal
                    //echo $key['tmp_name'];
                    $tamano = ($key['size'] / 1000) . "Kb"; //Obtenemos el tama�o en KB
                    move_uploaded_file($temporal, $ruta . $nombre); //Movemos el archivo temporal a la ruta especificada
                    //El echo es para que lo reciba jquery y lo ponga en el div "cargados"   

                    $this->Archivo_Evidencia_X_Grupo_Interes($ruta . $nombre);
                } else {
                    echo $key['error']; //Si no se cargo mostramos el error
                }
            }

            $mensaje = "Archivo subido correctamente : " . $key['name'];
        } else {

            $mensaje = "Existe un proceso que esta en uso actualmente";
        }

        return $mensaje;
    }

    function Ver() {

        $conexion = new Ado();

        $cadena = " SELECT 
                        * 
                    FROM 
                        cna_grupo_interes
                    ";

        $recordSet = $conexion->conectarAdo($cadena);

        return $recordSet;
    }

    function Ver_Evidencia_X_Grupo_Interes($datos) {

        $pk_grupo_interes = $datos['radio'];
        $modulo = $datos['modulo'];

        $conexion = new Ado();

        $cadena = " SELECT 
                        * 
                    FROM 
                        cna_evidencia_grupo_interes 
                    WHERE 
                            fk_grupo_interes = '$pk_grupo_interes'
                        AND
                            estado = 1
                        AND
                            fk_modulo = '$modulo'";

        $recordSet = $conexion->conectarAdo($cadena);

        return $recordSet;
    }

    function Ver_Solo_Evidencia_X_Grupo_Interes($datos) {

        $pk_grupo_interes = $datos['pk_grupo_interes'];
        $modulo = $datos['modulo'];

        $conexion = new Ado();

        $cadena = " SELECT 
                        * 
                    FROM 
                        cna_evidencia_grupo_interes 
                    WHERE 
                            fk_grupo_interes = '$pk_grupo_interes'
                        AND
                            estado = 1
                        AND
                            fk_modulo = '$modulo'";

        $recordSet = $conexion->conectarAdo($cadena);

        return $recordSet;
    }

    function Ver_Solo_X_Grupo_Interes($datos) {

        $pk_grupo_interes = $datos['pk_grupo_interes'];

        $conexion = new Ado();

        $cadena = " SELECT 
                        * 
                    FROM 
                        cna_grupo_interes 
                    WHERE 
                        pk_grupo_interes = '$pk_grupo_interes'
                    ";

        $recordSet = $conexion->conectarAdo($cadena);

        return $recordSet;
    }

    function Ver_X_Grupo_Interes($datos) {

        $pk_grupo_interes = $datos['radio'];

        $conexion = new Ado();

        $cadena = " SELECT 
                        * 
                    FROM 
                        cna_grupo_interes 
                    WHERE 
                        pk_grupo_interes = '$pk_grupo_interes'
                    ";

        $recordSet = $conexion->conectarAdo($cadena);

        return $recordSet;
    }

    function Agregar_Evidencia_X_Grupo_Interes($_Datos) {

        $fk_grupo_interes = $_Datos['pk_grupo_interes'];
        $fk_modulo = $_Datos['modulo'];

        $conexion = new Ado();

        $estado = "off";

        $cadena = " SELECT 
                        * 
                    FROM 
                        cna_proceso; ";

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
                            cna_grupo_interes 
                    	WHERE
                    	   pk_grupo_interes = '$fk_grupo_interes' "; //Realizamos una consulta

            $sqlResUsu = $conexion->conectarAdo($cadena);

            while (!$sqlResUsu->EOF) {

                $nombre = $sqlResUsu->fields['nombre'];

                $sqlResUsu->MoveNext();
            }

            $cadena = " UPDATE 
                            cna_evidencia_grupo_interes 
                    	SET
                            pk_evidencia_grupo_interes = pk_evidencia_grupo_interes , 
                            fk_grupo_interes = fk_grupo_interes , 
                            fk_evidencia = fk_evidencia , 
                            fk_modulo = fk_modulo , 
                            estado = '0'                	
                    	WHERE
                            fk_grupo_interes = '$fk_grupo_interes';";

            $conexion->conectarAdo($cadena);


            foreach ($_Datos['check'] as $fk_evidencia) {

                $estado = "off";

                $cadena = " SELECT
                                * 
                            FROM 
                                cna_evidencia_grupo_interes 
                        	WHERE
                                    fk_grupo_interes = '$fk_grupo_interes'
                                AND
                                    fk_evidencia = '$fk_evidencia'
                                AND
                                    fk_modulo = '$fk_modulo';";

                $sqlResUsu = $conexion->conectarAdo($cadena);


                while (!$sqlResUsu->EOF) {

                    if ($sqlResUsu->fields['pk_evidencia_grupo_interes'] > 0) {
                        $estado = "on";
                    }

                    $sqlResUsu->MoveNext();
                }

                if ($estado == "on") {

                    $cadena = " UPDATE 
                                    cna_evidencia_grupo_interes 
                            	SET
                                    pk_evidencia_grupo_interes = pk_evidencia_grupo_interes , 
                                    fk_grupo_interes = fk_grupo_interes , 
                                    fk_evidencia = fk_evidencia , 
                                    fk_modulo = fk_modulo , 
                                    estado = 1                	
                            	WHERE
                                        fk_grupo_interes = '$fk_grupo_interes'
                                    AND
                                        fk_evidencia = '$fk_evidencia'
                                    AND
                                        fk_modulo = '$fk_modulo';";

                    $conexion->conectarAdo($cadena);
                } else {

                    $cadena = " INSERT INTO cna_evidencia_grupo_interes 
                                	(pk_evidencia_grupo_interes, 
                                	fk_grupo_interes, 
                                	fk_evidencia, 
                                	fk_modulo,
                                    estado)
                            	VALUES
                                	('0', 
                                	'$fk_grupo_interes', 
                                	'$fk_evidencia', 
                                	'$fk_modulo',
                                    '1');
                                ";

                    $conexion->conectarAdo($cadena);
                }
            }

            $mensaje = "Se a agregado correctamente la evidencias al grupo de interes : " . $nombre;
        } else {

            $mensaje = "Existe un proceso que esta en uso actualmente";
        }

        return $mensaje;
    }

    function Agregar($_Datos) {

        $nombre = $_Datos['nombre'];
        $descripcion = $_Datos['descripcion'];

        $conexion = new Ado();

        $estado = "off";

        $cadena = " SELECT 
                        * 
                    FROM 
                        cna_proceso; ";

        $resSql = $conexion->conectarAdo($cadena);

        while (!$resSql->EOF) {

            if ($resSql->fields['fk_fase'] != "1") {
                $estado = "on";
            }

            $resSql->MoveNext();
        }

        if ($estado == "off") {

            $cadena = " INSERT INTO 
                            cna_grupo_interes 
                        	(pk_grupo_interes, 
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

            $mensaje = "Se a agregado correctamente el grupo de interes : " . $nombre;
        } else {

            $mensaje = "Existe un proceso que esta en uso actualmente";
        }

        return $mensaje;
    }

    function Modificar($_Datos) {

        $pk_grupo_interes = $_Datos['pk_grupo_interes'];
        $nombre = $_Datos['nombre'];
        $descripcion = $_Datos['descripcion'];

        $conexion = new Ado();

        $estado = "off";

        $cadena = " SELECT 
                        * 
                    FROM 
                        cna_proceso; ";

        $resSql = $conexion->conectarAdo($cadena);

        while (!$resSql->EOF) {

            if ($resSql->fields['fk_fase'] != "1") {
                $estado = "on";
            }

            $resSql->MoveNext();
        }

        if ($estado == "off") {

            $cadena = " UPDATE 
                            cna_grupo_interes
                    	SET
                        	pk_grupo_interes = pk_grupo_interes , 
                        	nombre = '$nombre' , 
                        	descripcion = '$descripcion' ,
                            estado = estado           	
                    	WHERE
                    	   pk_grupo_interes = '$pk_grupo_interes'
                        ";

            $conexion->conectarAdo($cadena);

            $mensaje = "Se a modificado correctamente el grupo de interes : " . $nombre;
        } else {

            $mensaje = "Existe un proceso que esta en uso actualmente";
        }

        return $mensaje;
    }

    function CambiarEstado($_Datos) {

        $conexion = new Ado();

        $pk_grupo_interes = $_Datos['radio'];

        $estado = "off";

        $cadena = " SELECT 
                        * 
                    FROM 
                        cna_proceso; ";

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
                    	   cna_grupo_interes               	
                    	WHERE
                    	   pk_grupo_interes = $pk_grupo_interes ";

            $recordSet = $conexion->conectarAdo($cadena);

            while (!$recordSet->EOF) {

                $estado = $recordSet->fields['estado'];
                $nombre = $recordSet->fields['nombre'];

                $recordSet->MoveNext();
            }

            if ($estado == "1") {

                $cadena = " UPDATE 
                                cna_grupo_interes 
                        	SET
                            	pk_grupo_interes = pk_grupo_interes , 
                            	nombre = nombre , 
                            	descripcion = descripcion , 
                            	estado = 0                     	
                        	WHERE
                        	   pk_grupo_interes = '$pk_grupo_interes' 
                            ";
            } else {
                $cadena = " UPDATE
                                cna_grupo_interes 
                        	SET
                            	pk_grupo_interes = pk_grupo_interes , 
                            	nombre = nombre , 
                            	descripcion = descripcion , 
                            	estado = 1                	
                        	WHERE
                        	   pk_grupo_interes = '$pk_grupo_interes' 
                            ";
            }

            $conexion->conectarAdo($cadena);

            $mensaje = "Se a cambiado el estado correctamente al grupo de interes : " . $nombre;
        } else {

            $mensaje = "Existe un proceso que esta en uso actualmente";
        }

        return $mensaje;
    }

}

?>
