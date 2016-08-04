<?php

session_start();

$opcion=$_REQUEST["opcion"];

if($opcion=="pagina"){
    
    require_once("../BaseDatos/AdoDB.php");
    
    require_once("../Vista/VIS_Elementos_Vista.php");
    
    require_once("../Modelo/CNA_Aspecto_Modelo.php");
    
    $objAspectos=new Aspecto();
    
    if(isset($_SESSION["cna_idcaracteristica"])){
        $rsDatos=$objAspectos->Ver_X_Caracteristica($_SESSION["cna_idcaracteristica"]);
    }else{
        $rsDatos=null;
    }
    
    require_once("../Vista/VIS_Lista_Aspectos_Vista.php");
    
}else{
    if($opcion=="guardarId"){
        $_SESSION["cna_idaspecto"]=$_REQUEST["id"];
        //$_SESSION["enc_idfactor"]=null;
        //$_SESSION["enc_idcaracteristica"]=null;
        //$_SESSION["enc_idaspecto"]=null;
        $_SESSION["cna_idevidencia"]=null;
    }
}
?>