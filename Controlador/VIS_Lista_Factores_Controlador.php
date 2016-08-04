<?php

session_start();

$opcion=$_REQUEST["opcion"];

if($opcion=="pagina"){
    
    require_once("../BaseDatos/AdoDB.php");
    
    require_once("../Vista/VIS_Elementos_Vista.php");
    
    require_once("../Modelo/CNA_Factor_Modelo.php");
    
    $objFactores=new Factor();
    $rsDatos=$objFactores->Ver();
    
    require_once("../Vista/VIS_Lista_Factores_Vista.php");
    
}else{
    if($opcion=="guardarId"){
        $_SESSION["cna_idfactor"]=$_REQUEST["id"];
        //$_SESSION["enc_idfactor"]=null;
        $_SESSION["cna_idcaracteristica"]=null;
        $_SESSION["cna_idaspecto"]=null;
        $_SESSION["cna_idevidencia"]=null;
    }
}
?>