<?php
class AlcanceAdministrativos{
    public function getAllalcances(){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        
        $sql="SELECT * FROM enc_alcance_administrativo";
        $rsDatos=$conDB->conectarAdo($sql);
        return $rsDatos;
    }
}

?>