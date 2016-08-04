<?php
class Factores {
    
    public function getAllFactores(){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        
        $sql="SELECT pk_factor,nombre,codigo FROM cna_factor WHERE pk_factor in (Select fk_factor from cna_caracteristica where pk_caracteristica in (select fk_caracteristica from cna_aspecto where pk_aspecto in (select fk_aspecto from cna_evidencia where pk_evidencia in (select fk_evidencia from cna_evidencia_grupo_interes where fk_modulo=6 AND estado=1))))";
        $rsDatos=$conDB->conectarAdo($sql);
        return $rsDatos;
    }
    
}
?>