<?php
session_start();
session_destroy();
require_once("../BaseDatos/AdoDB.php");
$conDB=new Ado();
$conDB->conectarAdo();
$sql="select p.pk_proceso, p.nombre,p.fecha_inicio,sp.nombre,s.nombre,f.nombre from cna_proceso as p, cna_fase as f,sad_programa as sp, sad_sede as s where sp.pk_programa=p.fk_programa and s.pk_sede=p.fk_sede and f.pk_fase=p.fk_fase";
$rsDatos=$conDB->Ejecutar($sql);
$rsDatos=$rsDatos->GetArray();
/*print_r($rsDatos->GetRows());*/
echo "sistema de enlace a modulo de encuestas";
require_once("../Vista/ENC_listaProcesos_vista.php");
?>