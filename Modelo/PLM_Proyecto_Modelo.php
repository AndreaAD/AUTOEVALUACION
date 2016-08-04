<?PHP

//$_SESSION["pk_proceso"]=1;
class Proyecto{
    //Crea una coneccion ala base plm y crea un area responsable
    public function conectar()
    {
        global $conexion;
        include("../BaseDatos/PLM_AdoDB.php");
        
        $conexion = new Ado();
    }
    public function crearProyecto($Datos){
        
        global $conexion;
        
        $_nombre = utf8_decode($Datos['T_nombre']);
        $_pk_proceso = ($_SESSION["pk_proceso"]);                
        $conexion->conectarAdo();
        
        $cadena = "INSERT INTO plm_proyecto (nombre,fk_proceso, estado) VALUES  ( '$_nombre',$_pk_proceso, 1);";
        
        $conexion->Ejecutar($cadena);
        
        $conexion->Close();
    }
    
    //Buscar un area por codigo
    public function buscarProyecto($dato)
    {
        global $conexion;
        $conexion->conectarAdo();
        $_pk_proceso = $_SESSION["pk_proceso"]; 
        
        $cadena = "SELECT * FROM plm_proyecto WHERE pk_proyecto = $dato and fk_proceso = $_pk_proceso;"; //Realizamos una consulta
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $proyecto[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $proyecto[$i][0]=$recordSet->fields[0];
            $proyecto[$i][1]=$recordSet->fields[1];
            $proyecto[$i][2]=$recordSet->fields[2]; 
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $proyecto; 
    }
    
    //Buscar un area por nombre
    public function buscarProyectoNombre($dato)
    {
        global $conexion;
        
        $conexion->conectarAdo();
        $_pk_proceso = $_SESSION["pk_proceso"]; 
        
        $cadena = "SELECT * FROM plm_proyecto WHERE nombre = '$dato' and fk_proceso = $_pk_proceso ;"; //Realizamos una consulta
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $proyecto[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $proyecto[$i][0]=$recordSet->fields[0];
            $proyecto[$i][1]=$recordSet->fields[1];
            $proyecto[$i][2]=$recordSet->fields[2]; 
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $proyecto; 
    }
    
    //busca todos los proyectos habilitados
    public function buscarProyectos()
    {
        global $conexion;
        
        $conexion->conectarAdo();
        
        
        $_pk_proceso = $_SESSION["pk_proceso"];
        
        $cadena = "SELECT * FROM plm_proyecto WHERE estado=1 and fk_proceso = $_pk_proceso;"; //Realizamos una consulta
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $proyecto[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $proyecto[$i][0]=$recordSet->fields[0];
            $proyecto[$i][1]=$recordSet->fields[1];
            $proyecto[$i][2]=$recordSet->fields[2];
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $proyecto; 
    }
    
    
    //busca todos los proyectos dehabilitados
    public function buscarProyectoDes()
    {
        global $conexion;
        
        $conexion->conectarAdo();
        
        $_pk_proceso = $_SESSION["pk_proceso"];
        $cadena = "SELECT * FROM plm_proyecto WHERE estado=0 and fk_proceso=$_pk_proceso;"; //Realizamos una consulta
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $proyecto[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $proyecto[$i][0]=$recordSet->fields[0];
            $proyecto[$i][1]=$recordSet->fields[1];
            $proyecto[$i][2]=$recordSet->fields[2];
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $proyecto; 
    }
    
    //modifica un proyecto
     public function modProyecto($Datos){
        
        
        $_id = $Datos['T_codigo'];
        $_nombre = utf8_decode($Datos['T_nombre']);
        $_pk_proceso = $_SESSION["pk_proceso"];
        global $conexion;
        
        $conexion->conectarAdo();
        
        $cadena = "UPDATE plm_proyecto SET nombre= '$_nombre' WHERE pk_proyecto = $_id and estado=1 and fk_proceso =$_pk_proceso;";
        
        $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
	 
    }
    
    //deshabilita un proyecto
     public function desProyecto($Datos){
          
        global $conexion;
        $_id = $Datos['T_codigo'];
                
        $conexion->conectarAdo();
        
        $_pk_proceso = $_SESSION["pk_proceso"];
        
        $cadena = "UPDATE plm_proyecto SET estado=0 WHERE pk_proyecto = $_id and estado=1 and fk_proceso =$_pk_proceso;";
        
        $conexion->Ejecutar($cadena);
        
        $conexion->Close();
	 
    }
    
    //hailita un proyecto
     public function habiProyecto($Datos){
     
        
        $_id = $Datos['T_codigo'];
        
        global $conexion;
        
        $conexion->conectarAdo();
        
        $_pk_proceso = $_SESSION["pk_proceso"];
        $cadena = "UPDATE plm_proyecto SET estado=1 WHERE pk_proyecto = $_id and estado=0 and fk_proceso =$_pk_proceso;";
        
        $conexion->Ejecutar($cadena);
        
        $conexion->Close();
	 
    }
}//class
?>