<?PHP
class Area{
    //Crea una coneccion ala base plm y crea un area responsable
    public function conectar()
    {
        global $conexion;
        include("../BaseDatos/PLM_AdoDB.php");
        
        $conexion = new Ado();
    }
    public function crearArea($Datos){
        
        global $conexion;
        
        $_nombre = utf8_decode($Datos['T_nombre']);
                
        $conexion->conectarAdo();
        
        $cadena = "INSERT INTO plm_area (area, estado) VALUES  ( '$_nombre', 1);";
        
        $conexion->Ejecutar($cadena);
        
        $conexion->Close();
    }
    
    //Buscar un area por codigo
    public function buscarArea($dato)
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM plm_area WHERE pk_area = $dato ;"; //Realizamos una consulta
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $area[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $area[$i][0]=$recordSet->fields[0];
            $area[$i][1]=$recordSet->fields[1];
            $area[$i][2]=$recordSet->fields[2]; 
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $area; 
    }
    
    //Buscar un area por nombre
    public function buscarAreaNombre($dato)
    {
        global $conexion;
        
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM plm_area WHERE area = '$dato' ;"; //Realizamos una consulta
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $area[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $area[$i][0]=$recordSet->fields[0];
            $area[$i][1]=$recordSet->fields[1];
            $area[$i][2]=$recordSet->fields[2]; 
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $area; 
    }
    
    //busca todas las areas habilitadas
    public function buscarAreas()
    {
        global $conexion;
        
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM plm_area WHERE estado=1;"; //Realizamos una consulta
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $area[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $area[$i][0]=$recordSet->fields[0];
            $area[$i][1]=$recordSet->fields[1];
            $area[$i][2]=$recordSet->fields[2];
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $area; 
    }
    
    
    //busca todas las areas dehabilitadas
    public function buscarAreaDes()
    {
        global $conexion;
        
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM plm_area WHERE estado=0;"; //Realizamos una consulta
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $area[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $area[$i][0]=$recordSet->fields[0];
            $area[$i][1]=$recordSet->fields[1];
            $area[$i][2]=$recordSet->fields[2];
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $area; 
    }
    //modifica un area
     public function modArea($Datos){
        
        
        $_id = $Datos['T_codigo'];
        $_nombre = utf8_decode($Datos['T_nombre']);
        
        global $conexion;
        
        $conexion->conectarAdo();
        
        $cadena = "UPDATE plm_area SET area= '$_nombre' WHERE pk_area = $_id and estado=1;";
        
        $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
	 
    }
    
    //deshabilita un area
     public function desArea($Datos){
          
        global $conexion;
        $_id = $Datos['T_codigo'];
        
        
        $conexion->conectarAdo();
        
        $cadena = "UPDATE plm_area SET estado=0 WHERE pk_area = $_id and estado=1;";
        
        $conexion->Ejecutar($cadena);
        
        $conexion->Close();
	 
    }
    
    //hailita un area
     public function habiArea($Datos){
     
        
        $_id = $Datos['T_codigo'];
        
        global $conexion;
        
        $conexion->conectarAdo();
        
        $cadena = "UPDATE plm_area SET estado=1 WHERE pk_area = $_id and estado=0;";
        
        $conexion->Ejecutar($cadena);
        
        $conexion->Close();
	 
    }
}//class
?>