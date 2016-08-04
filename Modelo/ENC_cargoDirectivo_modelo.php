<?php
class CargosDirectivos{
    
    public function getAllCargosDirectivos(){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        
        $sql="SELECT pk_cargo_directivo,cargo FROM enc_cargo_directivo;";
        $res=$conDB->conectarAdo($sql);
        return $res;
    }
}
?>