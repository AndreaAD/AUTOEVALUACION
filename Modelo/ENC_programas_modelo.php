<?php
class Programas{
    /* Devolvemos los programas de acuerdo a la sede que se le envia
       retorno: recordSet */
    public function getProgramasSede($_idSede){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        $sql="SELECT pk_programa,nombre,fk_facultad FROM sad_programa WHERE fk_sede=".$_idSede." AND estado=1";
        $rsDatos=$conDB->conectarAdo($sql);
        return $rsDatos;
    }
    
    /* Devolvemos una lista de facultades y programas segun la sede
       retorno: array */
    public function getProgramasFacultadSede($_idSede){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        $sql="SELECT pk_programa,nombre FROM sad_programa WHERE fk_sede=".$_idSede." AND estado=1";
        $rsDatosProgramas=$conDB->conectarAdo($sql);
        $sql="SELECT pk_facultad,nombre FROM sad_facultad WHERE estado=1";
        $rsDatosFacultades=$conDB->conectarAdo($sql);
        $datosTotales=array();
        foreach($rsDatosProgramas as $programa){
            $programa['tipo']=1;
            $datosTotales[]=$programa;
        }
        foreach($rsDatosFacultades as $facultad){
            $facultad['tipo']=2;
            $datosTotales[]=$facultad;
        }
        return $datosTotales;
    }
    
    /* Devolvemos los programas que tengan un proceso activo y en fase (4) captura de datos deacuerdo a la sede enviada a la funcion
       retorno: recordSet */
    public function getProgramasProcesoSede($_idSede){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        $sql="SELECT pro.pk_programa,pro.nombre FROM sad_programa as pro, cna_proceso as proc WHERE pro.pk_programa=proc.fk_programa AND pro.fk_sede=".$_idSede." AND proc.fk_sede=".$_idSede." AND proc.fk_fase=4";
        $rsProgramas=$conDB->conectarAdo($sql);
        return $rsProgramas;
    }
}
?>