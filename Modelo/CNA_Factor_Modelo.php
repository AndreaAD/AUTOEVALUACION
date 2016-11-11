<?php

class Factor {

    function Agregar_Factor($Datos) {

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

        for ($i = 2; $i <= 1000; $i++) {

            $_DATOS_EXCEL[$i - 1]['tipo'] = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();

            $_DATOS_EXCEL[$i - 1]['codigo'] = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();

            $_DATOS_EXCEL[$i - 1]['nombre'] = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();

            $_DATOS_EXCEL[$i - 1]['descripcion'] = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();

            $_DATOS_EXCEL[$i - 1]['estado'] = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
        }

        //recorremos el arreglo multidimensional        
        //para ir recuperando los datos obtenidos        
        //del excel e ir insertandolos en la BD

        foreach ($_DATOS_EXCEL as $campo => $valor) {

            if ($valor['tipo'] == 'Fa') {

                $nombre = $valor['nombre'];
                $codigo = $valor['codigo'];
                $estado = $valor['estado'];
                $descripcion = $valor['descripcion'];

                $cadena = "SELECT * FROM cna_factor WHERE codigo = '$codigo' ";
                $resSqlModCons = $conexion->conectarAdo($cadena);

                if (!$resSqlModCons->EOF) {

                    while (!$resSqlModCons->EOF) {
                        $fk_factor = $resSqlModCons->fields['pk_factor'];
                        $resSqlModCons->MoveNext();
                    }
                } else {

                    $cadena = "INSERT INTO 
                                cna_factor 
                            VALUES 
                                (NULL,
                                '$nombre', 
                                '$descripcion', 
                                '$estado', 
                                '0', 
                                '$codigo'
                                );";

                    $conexion->conectarAdo($cadena);

                    $cadena = "SELECT * FROM cna_factor WHERE codigo = '$codigo' ";
                    $resSqlMod = $conexion->conectarAdo($cadena);

                    while (!$resSqlMod->EOF) {
                        $fk_factor = $resSqlMod->fields['pk_factor'];
                        $resSqlMod->MoveNext();
                    }
                }
            }

            if ($valor['tipo'] == 'Ca') {

                $nombre = $valor['nombre'];
                $codigo = $valor['codigo'];
                $estado = $valor['estado'];
                $descripcion = $valor['descripcion'];

                $cadena = "SELECT * FROM cna_caracteristica WHERE codigo = '$codigo' ";
                $resSqlModCons = $conexion->conectarAdo($cadena);

                if (!$resSqlModCons->EOF) {

                    while (!$resSqlModCons->EOF) {
                        $fk_caracteristica = $resSqlModCons->fields['pk_caracteristica'];
                        $resSqlModCons->MoveNext();
                    }
                } else {

                    $cadena = "INSERT INTO 
                                cna_caracteristica 
                        	VALUES
                            	(NULL, 
                            	'$nombre', 
                            	'$descripcion', 
                            	'$estado', 
                            	'$fk_factor', 
                            	'$codigo');";

                    $conexion->conectarAdo($cadena);

                    $cadena = "SELECT * FROM cna_caracteristica WHERE codigo = '$codigo' ";
                    $resSqlMod = $conexion->conectarAdo($cadena);

                    while (!$resSqlMod->EOF) {
                        $fk_caracteristica = $resSqlMod->fields['pk_caracteristica'];
                        $resSqlMod->MoveNext();
                    }
                }
            }

            if ($valor['tipo'] == 'As') {

                $nombre = $valor['nombre'];
                $codigo = $valor['codigo'];
                $estado = $valor['estado'];
                $descripcion = $valor['descripcion'];

                $cadena = "SELECT * FROM cna_aspecto WHERE codigo = '$codigo' ";
                $resSqlModCons = $conexion->conectarAdo($cadena);

                if (!$resSqlModCons->EOF) {

                    while (!$resSqlModCons->EOF) {
                        $fk_aspecto = $resSqlModCons->fields['pk_aspecto'];
                        $resSqlModCons->MoveNext();
                    }
                } else {

                    $cadena = "INSERT INTO 
                                cna_aspecto             	
                        	VALUES
                            	(NULL, 
                            	'$nombre', 
                            	'$descripcion', 
                            	'$estado', 
                            	'$fk_caracteristica', 
                            	'$codigo');";

                    $conexion->conectarAdo($cadena);

                    $cadena = "SELECT * FROM cna_aspecto WHERE codigo = '$codigo' ";
                    $resSqlMod = $conexion->conectarAdo($cadena);

                    while (!$resSqlMod->EOF) {
                        $fk_aspecto = $resSqlMod->fields['pk_aspecto'];
                        $resSqlMod->MoveNext();
                    }
                }
            }

            if ($valor['tipo'] == 'Ev') {

                $nombre = $valor['nombre'];
                $codigo = $valor['codigo'];
                $estado = $valor['estado'];
                $descripcion = $valor['descripcion'];

                $cadena = "SELECT * FROM cna_evidencia WHERE codigo = '$codigo' ";
                $resSqlModCons = $conexion->conectarAdo($cadena);

                if (!$resSqlModCons->EOF) {
                    
                } else {

                    $cadena = "INSERT INTO 
                                cna_evidencia 
                        	VALUES
                            	(NULL, 
                            	'$nombre', 
                            	'$descripcion', 
                            	'$estado', 
                            	'$fk_aspecto', 
                            	'$codigo');";

                    $conexion->conectarAdo($cadena);

                    $cadena = "SELECT * FROM cna_evidencia WHERE codigo = '$codigo' ";
                    $resSqlMod = $conexion->conectarAdo($cadena);
                }
            }
        }
    }

    function Agregar_Archivo($Datos) {

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

                    $this->Agregar_Factor($ruta . $nombre);
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

    public function CNA_Factor_Ponderacion_Proceso($pk_factor, $pk_proceso) {
        $conDB = new Ado();
        $sql = "SELECT
                    ponderacion_porcentual
                FROM
                    cna_proceso_ponderacion
                WHERE
                    fk_proceso = {$pk_proceso} AND
                    fk_factor = {$pk_factor}";
        $res = $conDB->conectarAdo($sql);
        return $res->fields['ponderacion_porcentual'];
    }

    function Insertar_Sintesis_Factor($sintesis, $factor, $proceso) {

        $conexion = new Ado();
        $sql = "SELECT
                    *
                FROM
                    cna_sintesis_misional
                WHERE
                    fk_proceso = {$proceso} AND
                    fk_factor = {$factor}";
        $res = $conexion->conectarAdo($sql);
        if ($res->_numOfRows == 0) {
            $cadena = "INSERT INTO `cna_sintesis_misional` (`fk_factor`, `fk_proceso`, `sintesis`) VALUES ('{$factor}', '{$proceso}', '{$sintesis}')";
        } else {
            $cadena = "UPDATE `cna_sintesis_misional` SET `sintesis`='{$sintesis}' WHERE (fk_proceso='{$proceso}' AND fk_factor='{$factor}')";
        }
        $recordSet = $conexion->conectarAdo($cadena);
        return $recordSet;
    }

    function Ver() {

        $conexion = new Ado();

        $cadena = " SELECT 
                        * 
                    FROM 
                        cna_factor
                    ";

        $recordSet = $conexion->conectarAdo($cadena);

        return $recordSet;
    }

    function Ver_Sintesis_Proceso($fk_factor) {

        $conexion = new Ado();

        $cadena = " SELECT 
                        * 
                    FROM 
                        cna_sintesis_misional
                    WHERE 
                        fk_proceso = '{$_SESSION['pk_proceso']}'  AND fk_factor = '{$fk_factor}'
                    ";
        $recordSet = $conexion->conectarAdo($cadena);
        return $recordSet->fields['sintesis'];
    }

    function Ver_Factor_Ponderacion() {

        $conexion = new Ado();

        $cadena = "SELECT
                            *
                    FROM
                            cna_factor f
                    JOIN cna_proceso_ponderacion p ON p.fk_factor = f.pk_factor
                    WHERE
                    p.fk_proceso = '{$_SESSION['pk_proceso']}'";

        $recordSet = $conexion->conectarAdo($cadena);

        return $recordSet;
    }

    function Ver_Habilitados() {
        $conexion = new Ado();
        $cadena = " SELECT
                            factor.*, tipo.nombre AS tipo_ponderacion
                    FROM
                            cna_factor factor
                    JOIN cna_tipo_ponderacion tipo ON tipo.pk_tipo_ponderacion = factor.fk_tipo_ponderacion
                    WHERE
                            factor.estado = 1;";
        $recordSet = $conexion->conectarAdo($cadena);
        return $recordSet;
    }

    function Ver_TipoPonderacion() {
        $conexion = new Ado();
        $cadena = " SELECT
                        *
                    FROM
                        cna_tipo_ponderacion";
        $recordSet = $conexion->conectarAdo($cadena);
        return $recordSet;
    }

    function Ver_ponderacion_factor($fk_factor) {
        $conexion = new Ado();
        $cadena = "SELECT
                            *
                    FROM
                            cna_proceso_ponderacion ponderacion
                    WHERE
                    ponderacion.fk_proceso = '{$_SESSION['pk_proceso']}'
                    AND ponderacion.fk_factor = '{$fk_factor}'";
        $recordSet = $conexion->conectarAdo($cadena);
        return $recordSet;
    }

    function Ver_X_Factor($datos) {

        $pk_factor = $datos['radio'];

        $conexion = new Ado();

        $cadena = " SELECT 
                        * 
                    FROM 
                        cna_factor 
                    WHERE 
                        pk_factor = '$pk_factor'
                    ";

        $recordSet = $conexion->conectarAdo($cadena);

        return $recordSet;
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
                            cna_factor 
                        	(pk_factor, 
                        	nombre, 
                        	descripcion, 
                        	estado,
                            ponderacion)
                    	VALUES
                        	('0', 
                        	'$nombre', 
                        	'$descripcion', 
                        	'1',
                            '0')
                        ";

            $conexion->conectarAdo($cadena);

            $nombre = $nombre;

            $mensaje = "Se a agregado correctamente el nuevo factor : " . $nombre;
        } else {

            $mensaje = "Existe un proceso que esta en uso actualmente";
        }
        return $mensaje;
    }

    function Modificar($_Datos) {

        $pk_factor = $_Datos['pk_factor'];
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
                            cna_factor 
                    	SET
                        	pk_factor = pk_factor , 
                        	nombre = '$nombre' , 
                        	descripcion = '$descripcion' , 
                        	estado = estado ,
                            ponderacion = ponderacion  
                    	WHERE
                    	   pk_factor = '$pk_factor'
                        ";

            $conexion->conectarAdo($cadena);

            $nombre = $nombre;

            $mensaje = "Se a modificado correctamente el factor : " . $nombre;
        } else {

            $mensaje = "Existe un proceso que esta en uso actualmente";
        }

        return $mensaje;
    }

    function Agregar_Ponderacion($_Datos, $listado_factor) {
        $conexion = new Ado();
        $cadena = " SELECT 
                        * 
                    FROM cna_proceso WHERE fk_fase = '3'";
        $procesos_construccion = $conexion->conectarAdo($cadena);
        foreach ($procesos_construccion as $key => $value) {
            $cadena = " SELECT 
                        * 
                    FROM 
                        cna_proceso_ponderacion
                    WHERE
                    fk_proceso = '{$value['pk_proceso']}'";

            $resultado = $conexion->conectarAdo($cadena);
            if ($resultado->_numOfRows == 0) {
                foreach ($listado_factor as $pk_factor) {
                    $ponderacion = $_Datos['ponderacion_' . $pk_factor['pk_factor']];
                    $ponderacion = $ponderacion / 100;
                    $tipo_ponderacion = $_Datos['tipo_ponderacion_' . $pk_factor['pk_factor']];
                    $justificacion_ponderacion = $_Datos['justificacion_factor_' . $pk_factor['pk_factor']];
                    $cadena = "INSERT INTO cna_proceso_ponderacion (
                                    fk_proceso,
                                    fk_factor,
                                    ponderacion_porcentual,
                                    justificacion,
                                    fk_tipo_ponderacion
                                     
                            )
                            VALUES
                                    ('{$value['pk_proceso']}', '{$pk_factor['pk_factor']}', '$ponderacion','{$justificacion_ponderacion}','{$tipo_ponderacion}')";
                    $conexion->conectarAdo($cadena);
                    echo $cadena.'<br>';
                }
            } else {
                foreach ($listado_factor as $pk_factor) {
                    $ponderacion_factor = $_Datos['ponderacion_' . $pk_factor['pk_factor']];
                    $tipo_ponderacion = $_Datos['tipo_ponderacion_' . $pk_factor['pk_factor']];
                    $justificacion_ponderacion = $_Datos['justificacion_factor_' . $pk_factor['pk_factor']];
                    $ponderacion = $ponderacion_factor / 100;
                    $cadena = "UPDATE cna_proceso_ponderacion
                            SET 
                            ponderacion_porcentual = '{$ponderacion}',
                            fk_tipo_ponderacion='{$tipo_ponderacion}',
                            justificacion = '{$justificacion_ponderacion}'
                            WHERE
                            fk_factor = {$pk_factor['pk_factor']} AND fk_proceso = '{$value['pk_proceso']}'";
                    $conexion->conectarAdo($cadena);
                }
            }

            foreach ($_Datos['check'] as $pk_factor) {
                $pomderacion = $_Datos['ponderacion' . $pk_factor];
                $cadena = " UPDATE 
                                cna_factor 
                        	SET
                            	pk_factor = pk_factor , 
                            	nombre = nombre , 
                            	descripcion = descripcion , 
                            	estado = estado ,
                                ponderacion = '$pomderacion' 
                        	WHERE
                        	   pk_factor = '$pk_factor'
                            ";
                $conexion->conectarAdo($cadena);
            }
        }
die();
        $mensaje = "Se a agregado correctamente la ponderacion a los factores.";
        return $mensaje;
    }

    function CambiarEstado($_Datos) {

        $conexion = new Ado();

        $pk_factor = $_Datos['radio'];

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
                    	   cna_factor               	
                    	WHERE
                    	   pk_factor = $pk_factor ";

            $recordSet = $conexion->conectarAdo($cadena);

            while (!$recordSet->EOF) {

                $estado = $recordSet->fields['estado'];
                $nombre = $recordSet->fields['nombre'];

                $recordSet->MoveNext();
            }

            if ($estado == "1") {

                $cadena = " UPDATE 
                                cna_factor 
                        	SET
                            	pk_factor = pk_factor , 
                            	nombre = nombre , 
                            	descripcion = descripcion , 
                            	estado = 0 ,
                                ponderacion = ponderacion  
                        	WHERE
                        	   pk_factor = '$pk_factor' 
                            ";
            } else {
                $cadena = " UPDATE
                                cna_factor 
                        	SET
                            	pk_factor = pk_factor , 
                            	nombre = nombre , 
                            	descripcion = descripcion , 
                            	estado = 1 ,
                                ponderacion = ponderacion          	
                        	WHERE
                        	   pk_factor = '$pk_factor' 
                            ";
            }

            $conexion->conectarAdo($cadena);

            $mensaje = "Se a cambiado correctamente el estado del factor : " . $nombre;
        } else {

            $mensaje = "Existe un proceso que esta en uso actualmente";
        }

        return $mensaje;
    }

}

?>