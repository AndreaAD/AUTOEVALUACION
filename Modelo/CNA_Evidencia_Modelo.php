<?php

class Evidencia {

    function Agregar($_Datos) {

        $nombre = $_Datos['nombre'];
        $descripcion = $_Datos['descripcion'];
        $pk_aspecto = $_SESSION["cna_idaspecto"];

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
                            cna_evidencia 
                        	(pk_evidencia, 
                        	nombre, 
                        	descripcion, 
                        	estado,
                            fk_aspecto)
                    	VALUES
                        	('0', 
                        	'$nombre', 
                        	'$descripcion', 
                        	'1',
                            '$pk_aspecto')
                        ";

            $conexion->conectarAdo($cadena);

            $_SESSION["cna_idaspecto"] = null;
            $_SESSION["cna_idcaracteristica"] = null;
            $_SESSION["cna_idfactor"] = null;

            $mensaje = "Se a agregado correctamente la nueva evidencia : " . $nombre;
        } else {

            $mensaje = "Existe un proceso que esta en uso actualmente";
        }

        return $mensaje;
    }

    function Ver() {

        $conexion = new Ado();

        $cadena = " SELECT 
                        evid.* ,
                        fact.pk_factor AS fk_factor,
                        cara.pk_caracteristica AS fk_caracteristica
                    FROM 
                        cna_evidencia evid,
                        cna_aspecto aspe,
                        cna_caracteristica cara,
                        cna_factor fact
                    WHERE 
                            aspe.pk_aspecto = evid.fk_aspecto
                        AND
                            aspe.fk_caracteristica = cara.pk_caracteristica
                        AND
                            cara.fk_factor = fact.pk_factor
                    ";

        $recordSet = $conexion->conectarAdo($cadena);

        return $recordSet;
    }

    public function get_Evidencia_Proceso($id_proceso) {
        $conexion = new Ado();
        $cadena = " SELECT
                            fk_evidencia
                    FROM
                            enc_pregunta_cna_evidencia
                    WHERE
                            fk_proceso = '{$id_proceso}'
                    ";
        $recordSet = $conexion->conectarAdo($cadena);
        return $recordSet;
    }

    function Ver_X_Grupo_Interes_Check($_Datos) {

        $conexion = new Ado();

        $modulo = $_Datos['modulo'];
        $grupo_interes = $_Datos['pk_grupo_interes'];

        $cadena = " SELECT 
                        evid.* ,
                        fact.pk_factor AS fk_factor,
                        cara.pk_caracteristica AS fk_caracteristica
                    FROM 
                        (cna_evidencia evid,
                        cna_aspecto aspe,
                        cna_caracteristica cara,
                        cna_factor fact)
                    INNER JOIN
                        cna_evidencia_grupo_interes evi_gru
                    ON
                            evi_gru.fk_evidencia = evid.pk_evidencia
                        AND
                            evi_gru.fk_grupo_interes = $grupo_interes
                        AND
                            evi_gru.fk_modulo = $modulo
                        AND
                            evi_gru.estado = 1
                    WHERE 
                            aspe.pk_aspecto = evid.fk_aspecto
                        AND
                            aspe.fk_caracteristica = cara.pk_caracteristica
                        AND
                            cara.fk_factor = fact.pk_factor
                    ";

        $recordSet = $conexion->conectarAdo($cadena);

        return $recordSet;
    }

    function Ver_X_Grupo_Interes_No_Check($_Datos) {

        $conexion = new Ado();

        $modulo = $_Datos['modulo'];
        $grupo_interes = $_Datos['pk_grupo_interes'];

        $cadena = " SELECT 	
                        evid.* ,
                        fact.pk_factor AS fk_factor,
                        cara.pk_caracteristica AS fk_caracteristica
                    FROM 
                        cna_evidencia evid,
                        cna_aspecto aspe,
                        cna_caracteristica cara,
                        cna_factor fact
                    WHERE
                            aspe.pk_aspecto = evid.fk_aspecto
                        AND
                            aspe.fk_caracteristica = cara.pk_caracteristica
                        AND
                            cara.fk_factor = fact.pk_factor
                        AND
                            evid.pk_evidencia NOT IN(SELECT 
                                                        evid_gru.fk_evidencia 
                                                    FROM 
                                                        cna_evidencia_grupo_interes evid_gru
                                                    WHERE 
                                                            evid_gru.fk_modulo = $modulo 
                                                        AND 
                                                            evid_gru.fk_grupo_interes = $grupo_interes
                                                        AND 
                                                            evid_gru.estado = 1)";

        $recordSet = $conexion->conectarAdo($cadena);

        return $recordSet;
    }

    function Ver_X_Evidencia($datos) {

        $pk_evidencia = $datos['radio'];

        $conexion = new Ado();

        $cadena = " SELECT 
                        evid.* ,
                        cara.nombre AS nombre_caracteristica,
                        fact.nombre AS nombre_factor,
                        aspe.nombre AS nombre_aspecto,
                        fact.pk_factor AS fk_factor,
                        cara.pk_caracteristica AS fk_caracteristica
                    FROM 
                        cna_evidencia evid,
                        cna_aspecto aspe,
                        cna_caracteristica cara,
                        cna_factor fact
                    WHERE 
                            evid.pk_evidencia = '$pk_evidencia'
                        AND
                            aspe.pk_aspecto = evid.fk_aspecto
                        AND
                            aspe.fk_caracteristica = cara.pk_caracteristica
                        AND
                            cara.fk_factor = fact.pk_factor
                    ";

        $recordSet = $conexion->conectarAdo($cadena);

        return $recordSet;
    }

    function Modificar($_Datos) {

        $pk_evidencia = $_Datos['pk_evidencia'];
        $nombre = $_Datos['nombre'];
        $descripcion = $_Datos['descripcion'];
        $fk_factor = $_SESSION["cna_idaspecto"];

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
                            cna_evidencia 
                    	SET
                        	pk_evidencia = pk_evidencia , 
                        	nombre = '$nombre' , 
                        	descripcion = '$descripcion' , 
                        	estado = estado ,
                            fk_aspecto = '$fk_factor'  
                    	WHERE
                    	   pk_evidencia = '$pk_evidencia'
                        ";

            $conexion->conectarAdo($cadena);

            $nombre = utf8_encode($nombre);

            $mensaje = "Se a modificado correctamente la evidencia: " . $nombre;
        } else {

            $mensaje = "Existe un proceso que esta en uso actualmente";
        }

        return $mensaje;
    }

    function CambiarEstado($_Datos) {

        $conexion = new Ado();

        $pk_evidencia = $_Datos['radio'];

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
                    	   cna_evidencia               	
                    	WHERE
                    	   pk_evidencia = $pk_evidencia ";

            $recordSet = $conexion->conectarAdo($cadena);

            while (!$recordSet->EOF) {

                $estado = $recordSet->fields['estado'];
                $nombre = $recordSet->fields['nombre'];

                $recordSet->MoveNext();
            }

            if ($estado == "1") {

                $cadena = " UPDATE 
                                cna_evidencia 
                        	SET
                            	pk_evidencia = pk_evidencia , 
                            	nombre = nombre , 
                            	descripcion = descripcion , 
                            	estado = 0 ,
                                fk_aspecto = fk_aspecto  
                        	WHERE
                                pk_evidencia = '$pk_evidencia' 
                            ";
            } else {
                $cadena = " UPDATE 
                                cna_evidencia 
                        	SET
                            	pk_evidencia = pk_evidencia , 
                            	nombre = nombre , 
                            	descripcion = descripcion , 
                            	estado = 1 ,
                                fk_aspecto = fk_aspecto  
                        	WHERE
                                pk_evidencia = '$pk_evidencia' 
                            ";
            }

            $conexion->conectarAdo($cadena);

            $mensaje = "Se a cambiado correctamente el estado de la evidencia : " . $nombre;
        } else {

            $mensaje = "Existe un proceso que esta en uso actualmente";
        }

        return $mensaje;
    }

}

?>