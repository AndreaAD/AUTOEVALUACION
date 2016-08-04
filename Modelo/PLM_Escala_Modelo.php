<?php
class Escala
{
    //conecta a la base de datos
    function conectar()
    {
        global $conexion;
        include("../BaseDatos/PLM_AdoDB.php");
        $conexion = new Ado();    
    }
    
    //selecciona la escala por nombre
    function buscarEcalaNombre($nombre)
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM plm_escala_cualitativa
                    WHERE escala = '$nombre'  AND estado = 1 
                          ;"; 
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $esca[][] = array();
        $i=0;
        while(!$recordSet->EOF)
        {        
            $esca[$i][0]=$recordSet->fields[0];
            $esca[$i][1]=$recordSet->fields[0];
            $esca[$i][2]=$recordSet->fields[0];
            $esca[$i][3]=$recordSet->fields[0];
            $esca[$i][4]=$recordSet->fields[0];
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $esca;  
    }
    
    //crea una escala
    function crearEscala($datos)
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $_escala=($_POST["T_escala"]);
        $_valor_ini=$_POST["T_valorIni"];
        $_valor_fin=$_POST["T_valorFin"];
        $_concepto=($_POST["T_concepto"]);
        
        
        $cadena = "INSERT INTO plm_escala_cualitativa
                    (escala, valor_ini, valor_fin, concepto, estado)
                    VALUES 
                    ('$_escala',$_valor_ini,$_valor_fin,'$_concepto',1);"; 
        
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
    }
    
    //modifica una escala
    function modEscala($datos)
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $_idEsca=$_POST["H_idEsca"];
        $_escala=($_POST["T_escala"]);
        $_valor_ini=$_POST["T_valorIni"];
        $_valor_fin=$_POST["T_valorFin"];
        $_concepto=($_POST["T_concepto"]);
        
        
        $cadena = "UPDATE plm_escala_cualitativa SET
                    escala = '$_escala', valor_ini=$_valor_ini, valor_fin = $_valor_fin, concepto='$_concepto', estado=1
                    WHERE pk_escala = $_idEsca ;"; 
        
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
    }
    
    //busca las escalas habilitadas
    function buscarEcala()
    {
         global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM plm_escala_cualitativa
                    WHERE  estado = 1 
                          ;"; 
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $esca[][] = array();
        $i=0;
        while(!$recordSet->EOF)
        {        
            $esca[$i][0]=$recordSet->fields[0];
            $esca[$i][1]=$recordSet->fields[1];
            $esca[$i][2]=$recordSet->fields[2];
            $esca[$i][3]=$recordSet->fields[3];
            $esca[$i][4]=$recordSet->fields[4];
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $esca; 
    } 
    

//busca las escalas deshabilitadas
    function buscarEcalaDeshabi()
    {
         global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM plm_escala_cualitativa
                    WHERE  estado = 0 
                          ;"; 
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $esca[][] = array();
        $i=0;
        while(!$recordSet->EOF)
        {        
            $esca[$i][0]=$recordSet->fields[0];
            $esca[$i][1]=$recordSet->fields[1];
            $esca[$i][2]=$recordSet->fields[2];
            $esca[$i][3]=$recordSet->fields[3];
            $esca[$i][4]=$recordSet->fields[4];
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $esca; 
    } 
    //habilita escala
    
    function habilitaEscala($intIdEsca)
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "UPDATE plm_escala_cualitativa SET
                     estado=1
                    WHERE pk_escala = $intIdEsca ;"; 
        
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
    }
    
    
    //deshabilita una escala
    function desHabilitaEscala($_idEsca)
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "UPDATE plm_escala_cualitativa SET
                     estado = 0
                    WHERE pk_escala = $_idEsca ;"; 
        
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
    }
    //busca una escala por codigo
    function buscarEcalaId($intIdEsca)
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM plm_escala_cualitativa
                    WHERE  estado = 1 AND pk_escala = $intIdEsca
                          ;"; 
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $esca[][] = array();
        $i=0;
        while(!$recordSet->EOF)
        {        
            $esca[$i][0]=$recordSet->fields[0];
            $esca[$i][1]=$recordSet->fields[1];
            $esca[$i][2]=$recordSet->fields[2];
            $esca[$i][3]=$recordSet->fields[3];
            $esca[$i][4]=$recordSet->fields[4];
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $esca; 
    }
    
    //busca la escala por id
    function buscarEcalaIdDes($intIdEsca)
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM plm_escala_cualitativa
                    WHERE  estado = 0 AND pk_escala = $intIdEsca
                          ;"; 
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $esca[][] = array();
        $i=0;
        while(!$recordSet->EOF)
        {        
            $esca[$i][0]=$recordSet->fields[0];
            $esca[$i][1]=$recordSet->fields[1];
            $esca[$i][2]=$recordSet->fields[2];
            $esca[$i][3]=$recordSet->fields[3];
            $esca[$i][4]=$recordSet->fields[4];
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $esca; 
    }
    
}

?>