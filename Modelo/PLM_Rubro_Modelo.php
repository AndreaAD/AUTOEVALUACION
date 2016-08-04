<?PHP
//Clase para hacer la gestion de rubros del poai en el modulo plm
class Rubro{
    //se conecta a la clase ado
    public function conectar()
    {
        global $conexion;
        include("../BaseDatos/PLM_AdoDB.php");
        
        $conexion = new Ado();
        
    } 
    public function crearRubro($Datos){
        
        global $conexion;
        $_nombre = utf8_decode($Datos['T_nombre']);
        
        $conexion->conectarAdo();
        
        $cadena = "INSERT INTO plm_rubro_del_poai (rubro, estado) VALUES  ( '$_nombre', 1);";
        
        $conexion->Ejecutar($cadena);
        
        $conexion->Close();
	 
    }
    
    //Buscar un rubro por codigo
    public function buscarRubro($dato)
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM plm_rubro_del_poai WHERE pk_rubro = $dato ;"; //Realizamos una consulta
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $rubro[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $rubro[$i][0]=$recordSet->fields[0];
            $rubro[$i][1]=$recordSet->fields[1];
            $rubro[$i][2]=$recordSet->fields[2]; 
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $rubro; 
    }
    
    
    //Buscar un rubro por nombre
    public function buscarRubroNombre($dato)
    {
                
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM plm_rubro_del_poai WHERE rubro = '$dato' ;"; //Realizamos una consulta
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $rubro[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $rubro[$i][0]=$recordSet->fields[0];
            $rubro[$i][1]=$recordSet->fields[1];
            $rubro[$i][2]=$recordSet->fields[2]; 
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $rubro; 
    }
    
    //Busca todos lo rubros habilitados
    public function buscarRubros()
    {
        global $conexion;
        
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM plm_rubro_del_poai WHERE estado=1;"; //Realizamos una consulta
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $rubro[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $rubro[$i][0]=$recordSet->fields[0];
            $rubro[$i][1]=$recordSet->fields[1];
            $rubro[$i][2]=$recordSet->fields[2];
            $recordSet->MoveNext();
            $i++;
        }       
        
        //return $rubro; 
        return $rubro;
    }
    
    //Busca todos los rubros deshabilitados
    public function buscarRubrosDes()
    {
        global $conexion;
        
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM plm_rubro_del_poai WHERE estado=0;"; //Realizamos una consulta
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $rubro[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $rubro[$i][0]=$recordSet->fields[0];
            $rubro[$i][1]=$recordSet->fields[1];
            $rubro[$i][2]=$recordSet->fields[2];
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $rubro; 
    }
    
    //modifica rubro por codigo
     public function modRubro($Datos){
        
        global $conexion;
        
        
        $_id = $Datos['T_codigo'];
        $_nombre = utf8_decode($Datos['T_nombre']);
        
        $conexion->conectarAdo();
        
        $cadena = "UPDATE plm_rubro_del_poai SET rubro= '$_nombre' WHERE pk_rubro = $_id and estado=1;";
        
        $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
	 
    }
    
    
    //Deshabilita un rubro por codigo
     public function desRubro($Datos){
          
        global $conexion;
        $_id = $Datos['T_codigo'];
        
        
        $conexion->conectarAdo();
        
        $cadena = "UPDATE plm_rubro_del_poai SET estado=0 WHERE pk_rubro = $_id and estado=1;";
        
        $conexion->Ejecutar($cadena);
        
        $conexion->Close();
	 
    }
        
    //habilita rubro por codigo
     public function habiRubro($Datos){
          
        global $conexion;
        
        $_id = $Datos['T_codigo'];
        
        
        $conexion->conectarAdo();
        
        $cadena = "UPDATE plm_rubro_del_poai SET estado=1 WHERE pk_rubro = $_id and estado=0;";
        
        $conexion->Ejecutar($cadena);
        
        $conexion->Close();
	 
    }
}//class
?>