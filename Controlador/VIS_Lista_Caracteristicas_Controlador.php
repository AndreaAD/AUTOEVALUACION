<?php

session_start();

$opcion=$_REQUEST["opcion"];

if($opcion=="pagina"){
    
    require_once("../BaseDatos/AdoDB.php");
    
    require_once("../Vista/VIS_Elementos_Vista.php");
    
    require_once("../Modelo/CNA_Caracteristica_Modelo.php");
    
    $objCaracteristica=new Caracteristica();
    
    if(isset($_SESSION["cna_idfactor"])){
        $rsDatos=$objCaracteristica->Ver_X_Factor($_SESSION["cna_idfactor"]);
    }else{
        $rsDatos=null;
    }
    
    require_once("../Vista/VIS_Lista_Caracteristicas_Vista.php");
    
}else{
    if($opcion=="guardarId"){
        $_SESSION["cna_idcaracteristica"]=$_REQUEST["id"];
        //$_SESSION["enc_idfactor"]=null;
        //$_SESSION["enc_idcaracteristica"]=null;
        $_SESSION["cna_idaspecto"]=null;
        $_SESSION["cna_idevidencia"]=null;
    }
}
?>