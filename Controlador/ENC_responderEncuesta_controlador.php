<?php
require_once("../Modelo/ENC_gruposInteres_modelo.php");
$objGrupoInteres=new GruposInteres();
$rsGrupos=$objGrupoInteres->getAllGrupos();
require_once("../Vista/ENC_responderEncuesta_vista.php");
?>