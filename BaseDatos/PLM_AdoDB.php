<?php

class Ado{
    
    
     public function conectarAdo(){
        
        global $bd;
        
        include('../BaseDatos/adodb5/adodb.inc.php');
        
        // $conServidor = "omzsistemas.com.co";
        // $conBaseDeDatos = "omzsiste_sia";
        // $conUsuario = "omzsiste_siauser";
        // $conClave = "siaudec2015";
        
         $conServidor = "localhost";
        $conBaseDeDatos = "omzsiste_sia";
        $conUsuario = "sia_admin";
        $conClave = "S1A_dbUser";
        
        $bd = ADONewConnection('mysql');
        $bd->debug = false;
        $bd->Connect($conServidor,$conUsuario,$conClave,$conBaseDeDatos);
        $bd->SetCharSet("utf8");
         $bd->EXECUTE("set names 'utf8'");
        return $bd;
        
    }
    
    public function Ejecutar($cadena){        
        global $bd;
        $resultado = $bd->execute($cadena);
        return $resultado;
    }
    public function Close()
    {
        global $bd;
        $bd ->Close();
    }
}

?>