<?php
class Sedes{
    /* Devolvemos todas las sedes
       retorno: recordSet */
    public function getAllSedes(){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        
        $sql="SELECT pk_sede,nombre,descripcion FROM sad_sede WHERE estado=1";
        $rsDatos=$conDB->conectarAdo($sql);
        return $rsDatos;
    }
    
}
?>