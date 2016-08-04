<?PHP
//Clase para hacer la gestion del plan de mejoramiento
class Plan {
    //se conecta a la clase ado
    public function conectar()
    {
        global $conexion;
        include("../BaseDatos/PLM_AdoDB_Inicio.php");
        
        $conexion = new PLM_Ado();
        
    }
    
    
    //inserta una actividad de mejoramiento
    public function crearActividad($Datos){
        
        global $conexion;
        $_caracteristica = $Datos['T_caracteristica'];
        $_calificacion = $Datos['T_puntaje'];
        $_ambito = $Datos['T_ambito'];
        $_fortalezas = $Datos['T_fortaleza'];
        $_debilidades = $Datos['T_debilidad'];
        $_causas = $Datos['T_causa'];
        $_proyecto = $Datos['S_proyecto'];
        $_objetivo = $Datos['T_objetivo'];
        $_acciones = $Datos['T_acciones'];
        $_area = $Datos['S_area'];
        $_area2 = $Datos['S_area2'];
        $_metas = $Datos['T_metas'];
        $_indicador = $Datos['T_indicador'];
        $_inicial = $Datos['T_fechainicio'];
        $_final = $Datos['T_fechafin'];
        $_recursos = $Datos['S_recurso'];
        
        if($_recursos=="SI")
        {
            $_valor1 = $Datos['T_valor1'];
            $_valor2 = $Datos['T_valor2'];
            $_valor3 = $Datos['T_valor3'];
            
        }
        else
        {
            $_valor1 = 0;
            $_valor2 = 0;
            $_valor3 = 0;
            
        }
        $_rubro = $Datos['S_rubro'];
		$_proceso=$_SESSION["pk_proceso"];
        
        include("../BaseDatos/PLM_AdoDB_Inicio.php");
        
        $conexion = new PLM_Ado();
        
        $conexion->conectarAdo();
        
        $cadena = "INSERT INTO plm_actividades(fk_caracteristica, calificacion, fk_ambito, fortalezas, debilidades, 
                causas, fk_proyecto, objetivo, acciones, fk_area, fk_area2, metas, indicador, f_inicial, f_final,
                recursos, valor1, valor2, valor3, fk_rubro, fk_proceso) VALUES ($_caracteristica, $_calificacion, $_ambito,
                '$_fortalezas', '$_debilidades', '$_causas', '$_proyecto', '$_objetivo', '$_acciones', $_area, $_area2, 
                '$_metas', '$_indicador', '$_inicial', '$_final', '$_recursos', $_valor1, $_valor2, $_valor3, $_rubro,$_proceso);";
        
        
        $conexion->Ejecutar($cadena);
        
        $conexion->Close();
	 
    }
    
    //busca los factores activados
    public function buscarFactores() {
        
        global $conexion;
		
		$conexion->conectarAdo();     
        $cadena = "SELECT pk_factor, nombre, codigo FROM cna_factor WHERE estado = 1;"; //Realizamos una consulta
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        return ($recordSet); 
    }
    
    //busca las actividades de los proyectos para, hacer los calculos
    //y generar el proyecto de inversión 
    public function buscarproyectoi() {
        
        global $conexion;
        $_proceso=$_SESSION["pk_proceso"];        
        
        $conexion->conectarAdo();
        
        $cadena = "
					SELECT c.nombre, a.acciones, a.objetivo, b.rubro, a.valor1, a.valor2, a.valor3 
					FROM plm_actividades a, plm_rubro_del_poai b, plm_proyecto c
					WHERE a.fk_rubro = b.pk_rubro AND a.fk_proceso = $_proceso AND a.fk_proyecto = c.pk_proyecto;"; //Realizamos una consulta
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $proyectoi[][] = array();
        $i=0;
        
        while(!$recordSet->EOF) {        
            $proyectoi[$i][0]=$recordSet->fields[0];
            $proyectoi[$i][1]=$recordSet->fields[1];
            $proyectoi[$i][2]=$recordSet->fields[2];
            $proyectoi[$i][3]=$recordSet->fields[3];
            $proyectoi[$i][4]=$recordSet->fields[4];
            $proyectoi[$i][5]=$recordSet->fields[5];
            $proyectoi[$i][6]=$recordSet->fields[6];
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $proyectoi; 
    }
    
    //busca factores por código
    public function buscarFactorById($dato, $conexion) {
        
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM cna_factor WHERE pk_factor = $dato;"; //Realizamos una consulta
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $factor[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $factor[$i][0]=$recordSet->fields[0];
            $factor[$i][1]=$recordSet->fields[1];
            $factor[$i][2]=$recordSet->fields[2];
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $factor; 
    }
    
    //busca las características de un factor
    public function buscarCaracteristicasFactor($factor, $conexion) {
        
        $conexion->conectarAdo();
        
        $cadena = "SELECT pk_caracteristica, nombre, codigo FROM cna_caracteristica WHERE estado = 1 AND fk_factor = $factor;"; //Realizamos una consulta
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        return $recordSet; 
    }
    
    //buca una caractrística por código
    public function buscarCaracteristicaById($dato, $conexion) {
        
        $conexion->conectarAdo();
		
        
        $cadena = "SELECT A.pk_caracteristica, A.nombre, B.pk_ambito ,B.nombre 
                    FROM cna_caracteristica A, cna_ambito B
                    WHERE A.pk_caracteristica = $dato AND B.pk_ambito = A.fk_ambito;"; //Realizamos una consulta
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $caracteristica[][] = array();
        $i=0;
        
        while(!$recordSet->EOF) {        
            $caracteristica[$i][0]=$recordSet->fields[0];
            $caracteristica[$i][1]=$recordSet->fields[1];
            $caracteristica[$i][2]=$recordSet->fields[2];
            $caracteristica[$i][3]=$recordSet->fields[3];
            $recordSet->MoveNext();
            $i++;
        }
        return $caracteristica;
    }
    
    
    //busca ambitos de responsabilidad
    public function buscarAmbitos($conexion) {
        
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM plm_ambito;";
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $ambito[][] = array();
        $i=0;
        
        while(!$recordSet->EOF) {        
            $ambito[$i][0]=$recordSet->fields[0];
            $ambito[$i][1]=$recordSet->fields[1];
            $ambito[$i][2]=$recordSet->fields[2];
            $recordSet->MoveNext();
            $i++;
        }       
        return $ambito; 
    }
    
    //busca los rubros activos
    public function buscarRubros($conexion) {
        
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM plm_rubro_del_poai WHERE estado = 1;";
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $rubro[][] = array();
        $i=0;
        
        while(!$recordSet->EOF) {        
            $rubro[$i][0]=$recordSet->fields[0];
            $rubro[$i][1]=$recordSet->fields[1];
            $rubro[$i][2]=$recordSet->fields[2];
            $recordSet->MoveNext();
            $i++;
        }
        return $rubro; 
    }
    
    
    //busca áreas habilitadas
    public function buscarAreas($conexion) {
        
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM plm_area WHERE estado = 1;";
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $rubro[][] = array();
        $i=0;
        
        while(!$recordSet->EOF) {        
            $rubro[$i][0]=$recordSet->fields[0];
            $rubro[$i][1]=$recordSet->fields[1];
            $rubro[$i][2]=$recordSet->fields[2];
            $recordSet->MoveNext();
            $i++;
        }
        return $rubro; 
    }
    
    //busca el consolidado de una característica 
    // por código de la característica y proceso
    public function buscarConsolidadoCaracteristica($caracteristica, $conexion) {
        
		$_proceso=$_SESSION["pk_proceso"];
		
        $conexion->conectarAdo();
        
        $cadena = "SELECT calificacion, fortaleza, debilidad, analisis 
			FROM plm_caracteristica_proceso 
			WHERE fk_caracteristica = $caracteristica
				AND fk_proceso = $_proceso"; //Realizamos una consulta
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $consolidado[][] = array();
        $i=0;
        
        while(!$recordSet->EOF) {        
            $consolidado[$i][0]=$recordSet->fields[0];
            $consolidado[$i][1]=$recordSet->fields[1];
            $consolidado[$i][2]=$recordSet->fields[2];
            $consolidado[$i][3]=$recordSet->fields[3];
            $recordSet->MoveNext();
            $i++;
        }       
        return $consolidado; 
    }
    
    //Buscar un rubro por código
    public function buscarRubro($dato)
    {
        include("../BaseDatos/PLM_AdoDB_Inicio.php");
        
        $conexion = new PLM_Ado();
        
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
    
    //Busca todos los rubros deshabilitados
    public function buscarRubrosDes()
    {
        include("../BaseDatos/PLM_AdoDB_Inicio.php");
        
        $conexion = new PLM_Ado();
        
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
    
    //Buscar actividades de mejoramiento
    public function buscarPlan()
    {
        global $conexion;
		$_pk_proceso = $_SESSION["pk_proceso"];       
        
        $conexion->conectarAdo();
        
		
		
        
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
    
    
    //Buscar actividades de mejoramiento por caracteristica
    public function buscarPlanCarac( $intCarac)
    {
        global $conexion;
		$_proceso = $_SESSION["pk_proceso"];       
        
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM plm_actividades WHERE fk_proceso = $_proceso AND fk_caracteristica = $intCarac;"; //Realizamos una consulta
        
        $recordSet = $conexion->Ejecutar($cadena);
       
       
        return $recordSet; 
    }   
    //Buscar actividades de mejoramiento por caracteristica
    public function buscarProyecto($_proceso)
    {
        global $conexion;       
        
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM plm_proyecto WHERE fk_proceso = $_proceso;"; //Realizamos una consulta
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        return $recordSet; 
    }   
    
    
    
    
    //Buscar actividades de mejoramiento por caracteristica
    public function buscarPlanProceso( $_proceso)
    {
        global $conexion;     
        
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM plm_actividades WHERE fk_proceso = $_proceso;"; //Realizamos una consulta
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $plan[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $plan[$i][0]=$recordSet->fields[0];
            $plan[$i][1]=$recordSet->fields[1];
            $plan[$i][2]=$recordSet->fields[2];
            $plan[$i][3]=$recordSet->fields[3];
            $plan[$i][4]=$recordSet->fields[4];
            $plan[$i][5]=$recordSet->fields[5];
            $plan[$i][6]=$recordSet->fields[6];
            $plan[$i][7]=$recordSet->fields[7];
            $plan[$i][8]=$recordSet->fields[8];
            $plan[$i][9]=$recordSet->fields[9];
            $plan[$i][10]=$recordSet->fields[10];
            $plan[$i][11]=$recordSet->fields[11];
            $plan[$i][12]=$recordSet->fields[12];
            $plan[$i][13]=$recordSet->fields[13];
            $plan[$i][14]=$recordSet->fields[14];
            $plan[$i][15]=$recordSet->fields[15];
            $plan[$i][16]=$recordSet->fields[16];
            $plan[$i][17]=$recordSet->fields[17];
            $plan[$i][18]=$recordSet->fields[18];
            $plan[$i][19]=$recordSet->fields[19];
            $plan[$i][20]=$recordSet->fields[20];
            $plan[$i][21]=$recordSet->fields[21];
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $plan; 
    }   
    //Buscar actividades de mejoramiento por codigo
    public function buscarPlanes($dato, $conexion)
    {
	$_proceso=$_SESSION["pk_proceso"];
        $conexion->conectarAdo();
        
        $cadena = "SELECT A.pk_actividad,
						C.nombre,
						A.calificacion,
						B.nombre,
						A.fortalezas,
						A.debilidades,
						A.causas,
						F.nombre,
						A.objetivo,
						A.acciones,
						D.area,
						E.area,
						A.metas,
						A.indicador,
						A.f_inicial,
						A.f_final,
						A.recursos,
						A.valor1,
						A.valor2,
						A.valor3,
						R.rubro 
					FROM plm_actividades A, cna_caracteristica C, plm_ambito B, plm_area D, plm_area E, plm_rubro_del_poai R, plm_proyecto F
                    WHERE A.fk_caracteristica = C.pk_caracteristica AND A.fk_ambito = B.pk_ambito 
					AND A.fk_area = D.pk_area AND A.fk_area2 = E.pk_area AND A.fk_rubro = R.pk_rubro AND A.fk_proyecto = F.pk_proyecto
					AND A.fk_proceso = $_proceso AND F.pk_proyecto=$dato"; //Realizamos una consulta
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $plan[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $plan[$i][0]=$recordSet->fields[0];
            $plan[$i][1]=$recordSet->fields[1];
            $plan[$i][2]=$recordSet->fields[2];
            $plan[$i][3]=$recordSet->fields[3];
            $plan[$i][4]=$recordSet->fields[4];
            $plan[$i][5]=$recordSet->fields[5];
            $plan[$i][6]=$recordSet->fields[6];
            $plan[$i][7]=$recordSet->fields[7];
            $plan[$i][8]=$recordSet->fields[8];
            $plan[$i][9]=$recordSet->fields[9];
            $plan[$i][10]=$recordSet->fields[10];
            $plan[$i][11]=$recordSet->fields[11];
            $plan[$i][12]=$recordSet->fields[12];
            $plan[$i][13]=$recordSet->fields[13];
            $plan[$i][14]=$recordSet->fields[14];
            $plan[$i][15]=$recordSet->fields[15];
            $plan[$i][16]=$recordSet->fields[16];
            $plan[$i][17]=$recordSet->fields[17];
            $plan[$i][18]=$recordSet->fields[18];
            $plan[$i][19]=$recordSet->fields[19];
            $plan[$i][20]=$recordSet->fields[20];
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $plan; 
    }
    
    //busca las actividades de una caracteristica y un proyecto
    public function buscarActividad($id_carac,$id_proyec,$conexion)
    {
	$_proceso=$_SESSION["pk_proceso"];
        $conexion->conectarAdo();
        
        $cadena = "SELECT A.pk_actividad,
						C.nombre,
						A.calificacion,
						B.nombre,
						A.fortalezas,
						A.debilidades,
						A.causas,
						F.nombre,
						A.objetivo,
						A.acciones,
						D.area,
						E.area,
						A.metas,
						A.indicador,
						A.f_inicial,
						A.f_final,
						A.recursos,
						A.valor1,
						A.valor2,
						A.valor3,
						R.rubro 
					FROM plm_actividades A, cna_caracteristica C, plm_ambito B, plm_area D, plm_area E, plm_rubro_del_poai R, plm_proyecto F
                    WHERE A.fk_caracteristica = C.pk_caracteristica AND A.fk_ambito = B.pk_ambito 
					AND A.fk_area = D.pk_area AND A.fk_area2 = E.pk_area AND A.fk_rubro = R.pk_rubro AND A.fk_proyecto = F.pk_proyecto
					AND A.fk_proceso = $_proceso AND F.pk_proyecto=$id_proyec AND A.fk_caracteristica =$id_carac;"; //Realizamos una consulta
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        
        return $recordSet; 
    }
    
    //Buscar actividades de mejoramiento por código y característica
    public function buscarPlanesCarac($_pk_proyecto,$id_carac, $conexion)
    {
	$_proceso=$_SESSION["pk_proceso"];
        $conexion->conectarAdo();
        
        $cadena = "SELECT A.pk_actividad,
						C.nombre,
						A.calificacion,
						B.nombre,
						A.fortalezas,
						A.debilidades,
						A.causas,
						F.nombre,
						A.objetivo,
						A.acciones,
						D.area,
						E.area,
						A.metas,
						A.indicador,
						A.f_inicial,
						A.f_final,
						A.recursos,
						A.valor1,
						A.valor2,
						A.valor3,
						R.rubro 
					FROM plm_actividades A, cna_caracteristica C, plm_ambito B, plm_area D, plm_area E, plm_rubro_del_poai R, plm_proyecto F
                    WHERE A.fk_caracteristica = C.pk_caracteristica AND A.fk_ambito = B.pk_ambito 
					AND A.fk_area = D.pk_area AND A.fk_area2 = E.pk_area AND A.fk_rubro = R.pk_rubro AND A.fk_proyecto = F.pk_proyecto
					AND A.fk_proceso = $_proceso AND F.pk_proyecto=$_pk_proyecto AND A.fk_caracteristica= $id_carac"; //Realizamos una consulta
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $plan[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $plan[$i][0]=$recordSet->fields[0];
            $plan[$i][1]=$recordSet->fields[1];
            $plan[$i][2]=$recordSet->fields[2];
            $plan[$i][3]=$recordSet->fields[3];
            $plan[$i][4]=$recordSet->fields[4];
            $plan[$i][5]=$recordSet->fields[5];
            $plan[$i][6]=$recordSet->fields[6];
            $plan[$i][7]=$recordSet->fields[7];
            $plan[$i][8]=$recordSet->fields[8];
            $plan[$i][9]=$recordSet->fields[9];
            $plan[$i][10]=$recordSet->fields[10];
            $plan[$i][11]=$recordSet->fields[11];
            $plan[$i][12]=$recordSet->fields[12];
            $plan[$i][13]=$recordSet->fields[13];
            $plan[$i][14]=$recordSet->fields[14];
            $plan[$i][15]=$recordSet->fields[15];
            $plan[$i][16]=$recordSet->fields[16];
            $plan[$i][17]=$recordSet->fields[17];
            $plan[$i][18]=$recordSet->fields[18];
            $plan[$i][19]=$recordSet->fields[19];
            $plan[$i][20]=$recordSet->fields[20];
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $plan; 
    }
    
    //modifica actividad de mejoramiento por codigo
     public function modPlan($Datos){
        
        
        $_id = $Datos['T_codigo'];
        $_caracteristica = $Datos['T_caracteristica'];
        $_calificacion = $Datos['T_calificacion'];
        $_ambito = $Datos['S_ambito']; 
        $_fortalezas = $Datos['T_fortalezas'];
        $_debilidades = $Datos['T_debilidades'];
        $_causas = $Datos['T_causas'];
        $_proyecto = $Datos['T_proyecto'];
        $_area = $Datos['S_area'];
        $_inicial = $Datos['T_fechaini'];
        $_final = $Datos['T_fechafin'];
        $_recursos = $Datos['S_recurso'];
        $_valor = $Datos['T_valor'];
        $_rubro = $Datos['S_rubro'];
                
        include("../BaseDatos/PLM_AdoDB.php");
        $_proceso=$SESSION["pk_proceso"];
        $conexion = new Ado();
        
        $conexion->conectarAdo();
        
        $cadena = "UPDATE plm_actividades SET fk_ambito = '$_ambito', proyecto = '$_proyecto', fk_area = '$_area', f_inicial = '$_inicial', f_final = '$_final', recursos = '$_recursos', valor = '$_valor', fk_rubro = '$_rubro' 
					WHERE pk_actividad = $_id AND fk_proceso = $_proceso; ";
        
        $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
	 
    }
    
    
    //buscar el proceso en la base cna
    function buscarProceso($intIdProceso, $intIdUsuario)
    {
        global $conexion;
        include("../BaseDatos/PLM_AdoDB_Inicio.php");
        
        $conexion = new PLM_Ado();
        
        $conexion->conectarAdo();

		 
        $cadena = "                          
                    SELECT G.nombre, C.nombre, B.nombre, A.fecha_inicio, CONCAT( E.nombre,' ', E.apellido) AS nombre
                    FROM cna_proceso A, sad_sede B, sad_programa C, cna_fase D,
                         sad_usuario E, sad_proceso_usuario F, sad_facultad G, sad_usuario_tipo_usuario H, sad_tipo_usuario I
                    WHERE A.pk_proceso = $intIdProceso AND
                          A.fk_programa = C.pk_programa  AND
                          A.fk_sede = B.pk_sede AND
                          D.pk_fase = A.fk_fase AND 
                          D.pk_fase = 6 AND
                          E.pk_usuario = F.fk_usuario  AND
                          A.pk_proceso = F.fk_proceso AND
                          E.fk_programa = C.pk_programa AND
                          G.pk_facultad = C.fk_facultad AND
                          E.pk_usuario = H.fk_usuario AND
                          H.fk_tipo_usuario = I.pk_tipo_usuario AND
                          I.pk_tipo_usuario = 4  ;";
						  
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $proce[] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $proce[0]=$recordSet->fields[0];
            $proce[1]=$recordSet->fields[1];
            $proce[2]=$recordSet->fields[2]; 
            $proce[3]=$recordSet->fields[3];
            $proce[4]=$recordSet->fields[4];
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $proce;    
    }
    //busca los procesos que han terminado
    function buscarProcesosTermina($intIdUsuario)
    {
        global $conexion;
        include("../BaseDatos/PLM_AdoDB_Inicio.php");
        
        $conexion = new PLM_Ado();
        
        $conexion->conectarAdo();

        $cadena = "                          
                    SELECT A.pk_proceso, A.nombre, A.fecha_inicio, A.fecha_fin, A.descripcion, A.observacion 
                    FROM cna_proceso A, sad_usuario B, cna_fase C, sad_proceso_usuario D
                    WHERE B.pk_usuario = $intIdUsuario AND
                    A.fk_fase = C.pk_fase AND
                    D.fk_proceso = A.pk_proceso AND
                    D.fk_usuario = B.pk_usuario AND 
                    A.pk_proceso = D.fk_proceso AND 
                    C.pk_fase = 6;"; 
        
         $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $proce[] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $proce[$i][0]=$recordSet->fields[0];
            $proce[$i][1]=$recordSet->fields[1];
            $proce[$i][2]=$recordSet->fields[2]; 
            $proce[$i][3]=$recordSet->fields[3];
            $proce[$i][4]=$recordSet->fields[4]; 
            $proce[$i][5]=$recordSet->fields[5]; 
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $proce;
    }
	
	//busca los proyectos de un proceso
    public function buscarProyectos($_pk_proceso)
    {
        global $conexion;
        
        $conexion->conectarAdo();
        
        
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
    
}//class
?>