<?php

 global $glo_objViewAnali, $glo_objModelAnali, $temp;
 $temp =0;
 session_start();
//$_SESSION["pk_proceso"]=1;
//$_SESSION["pk_usuario"]=9;

mainGeneral();
jsGeneral();

//se detecta el componente h_opcion
//para asi ir a cada caso de uso
if(isset($_REQUEST['H_opcion']))
{
    switch($_REQUEST['H_opcion']){
        
         case 'obserCarac':{
            //se muestran las observaciones de las características
            //
			 $glo_objViewAnali->mostrarInfo($_SESSION["plm_facultad"],$_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
                       
            
            $arrFactor = $glo_objModelAnali->buscaFactorCod($_SESSION["PLM_IdFactor"]);
            $glo_objViewAnali->mostrarTablaDinamic($arrFactor, "Factor",$_SESSION["plm_cal_fac"]);
            
            
            $arrFactor = $glo_objModelAnali->buscaCaractCod($_SESSION["PLM_IdCarac"]);
            $glo_objViewAnali->mostrarTablaDinamic($arrFactor, "Característica",$_SESSION["plm_cal_car"]);
           
		   if(isset($_SESSION["plm_cal_car"]))
			{
			}
			else
			{
				$i=0;
				while(isset($_SESSION["plm_id".$i]))
				{
					if($_SESSION["plm_id".$i] == $_SESSION["PLM_IdCarac"])
					{
						$_SESSION["plm_cal_car"]=$_SESSION["plm_cal".$i];  
						break;                              
					}
					$i++;
				}
			}
			
			//*****Concatena las observaciones de los aspectos de una característica
			$arrAspec = $glo_objModelAnali->buscarAspecto($_SESSION["PLM_IdCarac"]);
			if(($arrAspec[0][0]))
			{
				for($n=0; $n<count($arrAspec); $n++)
				{
					$arrEvi = $glo_objModelAnali->buscarEvi($arrAspec[$n][0], $_SESSION["pk_proceso"]);
					$arrObAspec[][]=array();
					if(($arrEvi[0][0]))
					{
						$intIdEvi=0;
						$arrObEvi[]= array();
						
						for($i=0; $i<count($arrEvi); $i++)
						{
							if(($arrEvi[$i][0]))
							{
								$intIdEvi = $arrEvi[$i][0];
								
								$arrGrupo = $glo_objModelAnali ->buscaCaliGruInte($intIdEvi,$_SESSION["pk_proceso"]);
								if(($arrGrupo[0][0]))
								{                                  
									$cont=0;
									$strObser="";
									for($j=0; $j<count($arrGrupo); $j++)
									{
										if(($arrGrupo[$j][4]))
										{
											if( $arrGrupo[$j][4] == $arrEvi[$i][0])
											{
												$cont++; 
												$strObser = $strObser.$arrGrupo[$j][5];                                                    
											}
										}
									}
									$arrObEvi[$i]= $strObser;                                       
								}
							}                         
						}
						
						$strObserAspec="";
						$cont3=0;							
						
						for($m=0; $m<count($arrObEvi); $m++)
						{
							if(($arrObEvi[$m]))
							{
								$strObserAspec = $strObserAspec."<br>".$arrObEvi[$m]."</br>";
							}
						}                            
						$arrObAspec[$n][0]=$arrAspec[$n][5];
						$arrObAspec[$n][1]=$arrAspec[$n][1];
						$arrObAspec[$n][2]=$strObserAspec;
					}                                                       
				}
			}
			//** fin de la concatenación
			$glo_objViewAnali -> verObserCarac($arrObAspec);
		 }break;
         case 'mostrarObserva':{       
            //muestra las observaciones concatenadas por aspecto
			$arrIdAspec[] = array();
            $intA = $_POST['H_contAspec'];
            $glo_objViewAnali->mostrarInfo($_SESSION["plm_facultad"],$_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
                       
            //muestra el historial del factor
            $arrFactor = $glo_objModelAnali->buscaFactorCod($_SESSION["PLM_IdFactor"]);
            $glo_objViewAnali->mostrarTablaDinamic($arrFactor, "Factor",$_SESSION["plm_cal_fac"]);
            
            
            //muestra el historial de la característica
            $arrFactor = $glo_objModelAnali->buscaCaractCod($_SESSION["PLM_IdCarac"]);
            $glo_objViewAnali->mostrarTablaDinamic($arrFactor, "Característica",$_SESSION["plm_cal_car"]);
            
            
            $cont=-1;
            if(isset($_REQUEST['select']))
            {
                $arrIdAspec[0] = $_REQUEST['select'];
                $_SESSION["PLM_IdAspec"] = $arrIdAspec[0];
                $cont=1;
            }
            
            if(isset($_SESSION["PLM_IdAspec"]))
            {
                // se muestra las observaciones de un acpecto
                $glo_objViewAnali->mostrarObserva($_SESSION["plm_observacion".$_SESSION["PLM_IdAspec"]]);
            }
            else
            {
                $glo_objViewAnali->mensaje("Debe seleccionar un aspecto!!!");
                $glo_objViewAnali->botonAtras("atrasObserCarac()","observa");
                
            }
         }break;         
         case 'VerAnalisisAspec':{
            //se muestra el análisis de ls escala cualitativa de los aspectos
            $arrAspec[][]=array();
            
             $arrEscala[][]=array();
            $arrEscala = $glo_objModelAnali->mostrarEscala();
            
            
            //se calcula el porcentaje de cumplimiento de los aspectos
            $i=0;
            while(isset($_SESSION["plm_id".$i]))
            {
               
               $arrAspec[$i][0]=$_SESSION["plm_nombre".$i];
               $arrAspec[$i][1]=$_SESSION["plm_esca".$i];
               if(((($_SESSION["plm_cal".$i]-1)/4)*100)<0)
               {
                $arrAspec[$i][2]="0";                
               }
               else
               {
                $arrAspec[$i][2]=sprintf('%.2f',((($_SESSION["plm_cal".$i]-1)/4)*100));
               }
               $i++;
            }
            
            //se muestra la información del proceso actual
            $glo_objViewAnali->mostrarInfo($_SESSION["plm_facultad"],$_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
            
            //se muestra la escala cualitatica de todos los acpectos
            $glo_objViewAnali->analisisEscala($arrEscala,"Análisis de la Escala Cualitativa por Aspecto","AtrasEvi();","graficaGrupoInt",$arrAspec,"Nivel de Cumplimiento por aspectos", "Aspectos");
             
         }break;
         case 'VerAnalisisCarac':{
            //se muestra el análisis de la escala cualitativa por característica
            
            $arrCarac[][]=array();
            $arrEscala[][]=array();
            $arrEscala = $glo_objModelAnali->mostrarEscala();
            // se trae la escala de la característica
            $arrCarac = $glo_objModelAnali->mostrarCaractProcesoEscala( $_SESSION["pk_proceso"], $_SESSION["PLM_IdFactor"]);
            // se muestra la información del proceso actual
            $glo_objViewAnali->mostrarInfo($_SESSION["plm_facultad"],$_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
            
            
            $arrFactor = $glo_objModelAnali->buscaFactorCod($_SESSION["PLM_IdFactor"]);
            //se muestra el historial del factor
            $glo_objViewAnali->mostrarTablaDinamic($arrFactor, "Factor",$_SESSION["plm_cal_fac"]);
            
            
            $glo_objViewAnali->analisisEscala($arrEscala,"Análisis de la Escala Cualitativa por Característica","AtrasAspec();","buscarEvi",$arrCarac,"Nivel de Cumplimiento por características", "Características");
             
               
         }break;
         
         case'VerAnalisisFac':{
            
            //se muestra el análisis de la escala cualitativa de los factores
             
            $arrEscala[][]=array();
            $arrFactores[][]=array();
            
            $arrEscala = $glo_objModelAnali->mostrarEscala();
            //se trae la escala cualitativa de los factores
            $arrFactores = $glo_objModelAnali->mostrarFactorProcesoEscala( $_SESSION["pk_proceso"]);
            
            $glo_objViewAnali->mostrarInfo($_SESSION["plm_facultad"],$_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
                        
            $glo_objViewAnali->analisisEscala($arrEscala,"Análisis de la Escala Cualitativa por Factor","AtrasCarac();", "escalaFactor",$arrFactores, "Nivel de Cumplimiento por factores", "Factores");
            
         }break;
        
         case 'guardarAnalisis':{
             //guarda el análisis de la característica
            $glo_objModelAnali->guardaAnalisisCarac($_GET["PLM_IdCarac"],$_GET["PLM_IdFactor"],$_GET["TA_analisis"],$_GET["TA_fortaleza"],$_GET["TA_debilidad"], $_SESSION["pk_proceso"]);
            
            $glo_objViewAnali->mensaje("Proceso Exitoso!!!");
            //$glo_objViewAnali->botonAtras("pagAtrasAspec()","buscarEvi");
			
        }break;
                
        case 'AddAnalisis':{
                $Característica = $_GET['id_carac'];

                $valor = $glo_objModelAnali->buscarPkCaracteristicaProceso($Característica, $_SESSION["pk_proceso"]);
                $valor_pk = $valor[0]['pk_caracteristica_proceso'];
                $valor_carac = $valor[0]['fk_caracteristica'];
                $valor_fac = $valor[0]['fk_factor'];
                require_once("../Vista/PLM_NuevoAnalisis_Vista.php");
        }break;
        
        case 'verGraficaFac':{
            //mostramos la infortmación del proceso actual
            // $glo_objViewAnali->mostrarInfo($_SESSION["plm_facultad"],$_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
            
            //mostramos la gráfica de los factores
            $arrFacGrap = $glo_objModelAnali ->buscaCalFac($_SESSION["pk_proceso"]);
            $glo_objViewAnali ->mostGrafCarac($arrFacGrap, 0,"Gráfica De Factores", "AtrasCarac();");
            
           
            
        }break;
        case 'verGraficaCarac':{
            // en este caso lo que hacermos es mostrar la gráfica de características
            $factor = $_GET['factor'];
            //mostramos la información del proceso 
            $glo_objViewAnali->mostrarInfo($_SESSION["plm_facultad"],$_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
            //traemos la caracteristica y su calificación
            $arrCaracGrap = $glo_objModelAnali ->buscaCalCarac($factor,$_SESSION["pk_proceso"]);
		            
            //mostramos la gráfica de las características
            $glo_objViewAnali ->mostGrafCarac($arrCaracGrap,$factor,"Gráfica De Características", "AtrasGrafCarac();");
            
        }break;
        case 'verGraficaAspec':{
                        
            //muestra la información del proceso actual
            $glo_objViewAnali->mostrarInfo($_SESSION["plm_facultad"],$_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
            
            //lo que se quiere hacer es traer al código de los aspectos en la variable de sesión "plm_id"
			$arrAspecGrap[][]=array();
			$i=0;
			while(isset($_SESSION["plm_id".$i]))
			{
				$arrAspecGrap[$i][0]=$_SESSION["plm_id2".$i];
				$arrAspecGrap[$i][1]=$_SESSION["plm_cal".$i];
				$i++;
			}
			
            //muestra el historial del factor
            $arrFactor = $glo_objModelAnali->buscaFactorCod($_SESSION["PLM_IdFactor"]);
            $glo_objViewAnali->mostrarTablaDinamic($arrFactor, "Factor",$_SESSION["plm_cal_fac"]);
            
            //muestra el historial de la caracteristica
            $arrFactor = $glo_objModelAnali->buscaCaractCod($_SESSION["PLM_IdCarac"]);
            $glo_objViewAnali->mostrarTablaDinamic($arrFactor, "Característica",$_SESSION["plm_cal_car"]);
                    
            
            //muestra la grafica de la calificación de los aspectos
            $glo_objViewAnali ->mostGrafCarac($arrAspecGrap,"Gráfica De Aspectos", "AtrasGrafAspec();");
            
        }break;
       
        case 'buscarCaract':{       

            $factor = $_REQUEST['id_factor'];

            global $glo_objViewAnali, $glo_objModelAnali, $arrFactor, $temp;
        
            $temp=0;
                    
            if(isset($_SESSION["PLM_IdFactor"]))
            {
                unset($_SESSION["PLM_IdFactor"]);                
            }
            
            $arrInfo = $glo_objModelAnali->buscarProceso($_SESSION["pk_proceso"],$_SESSION["pk_usuario"]);

            

            if(isset($arrInfo[0][0]))
            {

                $_SESSION["plm_facultad"]=$arrInfo[0];
                $_SESSION["plm_programa"]=$arrInfo[1];
                $_SESSION["plm_sede"]=$arrInfo[2];
                $_SESSION["plm_director"]=$arrInfo[4];
                $_SESSION["plm_periodo"]=$arrInfo[3];
                
            
                $glo_objViewAnali->mostrarInfo($_SESSION["plm_facultad"], $_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);

                //busca todos los factores
                $arrFactor[][]=array();
                $arrFactor = $glo_objModelAnali->buscaFactor();
                $floCal = 0;
                $temp=0;
                $arrCalFactor[][]=array();
                $arrCarac[] =array();
                $arrAspectos[] =array();
                $datos[] =array();
                $resultados_tabla =array();

                require_once('../Modelo/PLM_PrincipalAnalisis_Modelo.php');
                $instancia  = new Analisis;

                    $arrCarac =  $instancia->listaCaracteristicasProceso($factor);
                    foreach ($arrCarac as &$caracteristica){
                        $datos =  $instancia->obtenerDatosPonderacion($caracteristica[0], $_SESSION["pk_proceso"]);
                        $factor_ = $instancia->buscarFactor_($factor);

                        $datos_ponderacion_caracteristica =  $instancia->obtenerPonderacionCaracteristica($caracteristica[0], $_SESSION["pk_proceso"]);


                        $escala_cualitativa =  $instancia->obtenerEscalaCualitativa();

                        $tamaño = count($datos);
                        $promedio1 = 0;
                        $promedio2 = 0;
                        $promedio_modulo5 = 0;
                        $promedio_modulo6 = 0;
                        $promedio = 0;

                        if($tamaño == 0){
                            $glo_objViewAnali->mensaje("EL PROCESO ACTUAL NO SE HA CONSOLIDADO!");

                        }else if($tamaño == 1){

                            $promedio = $datos[0]['calificacion'];
                            if($datos[0]['fk_modulo'] == 5){
                                $promedio_modulo5 = $promedio;
                            }else{
                                $promedio_modulo6 = $promedio;
                            }


                            $porcentaje_cumplimiento = ( $promedio * 100 ) / ( $datos_ponderacion_caracteristica[0]['ponderacion_porcentual'] * 100 );

                        }else if($tamaño == 2){

                            $promedio1 = $datos[0]['calificacion'] != NULL ? $datos[0]['calificacion']  : 0 ;
                            $promedio2 = $datos[1]['calificacion'] != NULL ? $datos[1]['calificacion']  : 0 ;

                            if($datos[0]['fk_modulo'] == 5){
                                $promedio_modulo5 = $promedio1;
                            }else{
                                $promedio_modulo6 = $promedio1;
                            }


                            if($datos[1]['fk_modulo'] == 5){
                                $promedio_modulo5 = $promedio2;
                            }else{
                                $promedio_modulo6 = $promedio2;
                            }

                            $resultados_promedio = $promedio1 + $promedio2;
                            $promedio = $resultados_promedio / 2;


                            $porcentaje_cumplimiento = ( $promedio * 100 ) / ( $datos_ponderacion_caracteristica[0]['ponderacion_porcentual'] * 100 );

                        }   


                        $p = $promedio * 10 ;
                        $p_2 = $p / 2;

                        $consulta_escala = $instancia->ConsultarEscala($p_2);

                        //$promedio = number_format ($promedio ,2);

                        $resultados_carc = array(
                            'caracteristica_id' => $caracteristica['pk_caracteristica'],
                            'factor' => $factor_[0][5],
                            'pk_factor' => $factor_[0][0],
                            'nombre' => $factor_[0][1],
                            'caracteristica' => $caracteristica['codigo'],
                            'ponderacion_porcentual' => $datos_ponderacion_caracteristica[0]['ponderacion_porcentual'] * 100,
                            'valor_modulo_5' => $promedio_modulo5,
                            'valor_modulo_6' => $promedio_modulo6,
                            'promedio' => $promedio  * 100,
                            'porcentaje_cumplimiento' => number_format($porcentaje_cumplimiento *100, 2),
                            'escala' => $consulta_escala[0][0],
                        );


                        $pond_porcentual_db = $datos_ponderacion_caracteristica[0]['ponderacion_porcentual'] * 100;
                        $prom_db = $promedio * 100;

                        $consulta = $instancia->BuscarPonderacionCaracteristicaPlm($factor_[0][0],$caracteristica['pk_caracteristica'], $_SESSION["pk_proceso"]);
                        if($consulta[0] > 0){
                            $consulta = $instancia->GuardarPonderacionCaracteristicaPlm($factor_[0][0],$_SESSION["pk_proceso"], $caracteristica['pk_caracteristica'], $pond_porcentual_db, $prom_db, 2);
                        }else{
                            $consulta = $instancia->GuardarPonderacionCaracteristicaPlm($factor_[0][0],$_SESSION["pk_proceso"], $caracteristica['pk_caracteristica'],$pond_porcentual_db , $prom_db, 1);
                        }

                        array_push($resultados_tabla, $resultados_carc);

                    }
                require_once("../Vista/PLM_AnalisisResultados_Vista.php");
            }
        }break;   
        case 'buscarAspec':{     
            
            //busca y muestra el código, la calificación, ponderación y escala 
            // de todos loes aspectos de una característica
            $temp=0;
            if(isset($_SESSION["PLM_IdAspec"]))
            {
                unset($_SESSION["PLM_IdAspec"]);                
            }
            if(isset($_SESSION["PLM_IdEvi"]))
            {
                unset($_SESSION["PLM_IdEvi"]);                
            }
            
            if(isset($_SESSION["PLM_IdCarac"]))
            {
                $cont=0;
            }
            else
            {
                //guarda el código de la característica seleccionada
                $arrIdCarac[] = array();
                $intF = $_POST['H_contCarac'];
                
                $cont=-1;                
                if(isset($_REQUEST['select']))
                {
                    $arrIdCarac[0] = $_REQUEST['select'];
                    $_SESSION["PLM_IdCarac"] = $arrIdCarac[0];
                    $cont=1;
                }
                
                
            }
            
            if($cont==-1)
            {
                $glo_objViewAnali->mensaje("No seleccionó, ninguna característica!!!");
            }
            else
            {               
                $glo_objViewAnali->mostrarInfo($_SESSION["plm_facultad"],$_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
            
                
                if(isset($_SESSION["plm_cal_car"]))
                {
                }
                else
                {
                    $i=0;
					$aux=0;
                    while(isset($_SESSION["plm_id".$i]))
                    {
                        if($_SESSION["plm_id".$i] == $_SESSION["PLM_IdCarac"])
                        {
                            $_SESSION["plm_cal_car"]=$_SESSION["plm_cal".$i];  
							$aux=1;
                            break;                              
                        }
                        $i++;
                    }
                    
                    if($aux==0)
                    {
                        $_SESSION["plm_cal_car"]=0;
                    }
                }
                //muestra el historial de un factor
                $arrFactor = $glo_objModelAnali->buscaFactorCod($_SESSION["PLM_IdFactor"]);
                $glo_objViewAnali->mostrarTablaDinamic($arrFactor, "Factor", $_SESSION["plm_cal_fac"]);
                
                //muestra el historial de una característica
                $arrFactor = $glo_objModelAnali->buscaCaractCod($_SESSION["PLM_IdCarac"]);
                $glo_objViewAnali->mostrarTablaDinamic($arrFactor, "Característica",$_SESSION["plm_cal_car"]);
                  
                $temp=0;
                
                $arrCalAspec[][] = array();
                $arrAspec = $glo_objModelAnali->buscarAspecto($_SESSION["PLM_IdCarac"]);
                if(($arrAspec[0][0]))
                {
                    for($n=0; $n<count($arrAspec); $n++)
                    {
                        $arrEvi = $glo_objModelAnali->buscarEvi($arrAspec[$n][0], $_SESSION["pk_proceso"]);
                        $arrObAspec[][]=array();
                        if(($arrEvi[0][0]))
                        {
                            $intIdEvi=0;
                            $arrCalEvi[][] = array();
                            $arrObEvi[]= array();
                            //calcula la calificacion final de una evidencia
                            for($i=0; $i<count($arrEvi); $i++)
                            {
                                if(($arrEvi[$i][0]))
                                {
                                    $intIdEvi = $arrEvi[$i][0];
                                    
                                    $arrGrupo = $glo_objModelAnali ->buscaCaliGruInte($intIdEvi,$_SESSION["pk_proceso"]);
                                    if(($arrGrupo[0][0]))
                                    {                                                                
                                        $arrCalEvi[$i][0] = $intIdEvi;
                                        
                                        $cont=0;
                                        $intCalEvi=0;
                                        $strObser="";
                                        for($j=0; $j<count($arrGrupo); $j++)
                                        {
                                            if(($arrGrupo[$j][4]))
                                            {
                                                if( $arrGrupo[$j][4] == $arrEvi[$i][0])
                                                {
                                                        $cont++;
                                                        $intCalEvi += $arrGrupo[$j][3];   
                                                        $strObser = $strObser.$arrGrupo[$j][5];
                                                    
                                                }
                                            }
                                        }
                                        $intCalEvi = ($intCalEvi / $cont);                                                                   
                                        $arrCalEvi[$i][1]=$intCalEvi;
                                        $arrObEvi[$i]= $strObser;
                                        
                                    }
                                }                         
                            }
                            
                            $intCalAspec=0;
                            $strObserAspec="";
                            $cont3=0;
                            for($k=0; $k<count($arrCalEvi); $k++)
                            {
                                if(($arrCalEvi[$k][0]))
                                {
                                    $intCalAspec +=$arrCalEvi[$k][1]; 
                                    $cont3++;  
                                }
                            }                
                            if($cont3!=0)
                            {
                                $intCalAspec = $intCalAspec/$cont3;
                            }
                            for($m=0; $m<count($arrObEvi); $m++)
                            {
                                if(($arrObEvi[$m]))
                                {
                                    $strObserAspec = $strObserAspec."<br>".$arrObEvi[$m]."</br>";
                                }
                            }
                            
                            $arrCalAspec[$n][0]=$arrAspec[$n][0];
                            $arrCalAspec[$n][1]=$intCalAspec;
                            $arrObAspec[$n][0]=$arrAspec[$n][0];
                            $arrObAspec[$n][1]=$strObserAspec;
                        }        
                                               
                    }
                    if($temp!=2)
                    {
                        $arrEscaAsp[][]=array();
                        for($i=0; $i<count($arrCalAspec); $i++)
                        {
                            if(($arrCalAspec[0][0]))
                            {
                                $arrEscaAsp[$i][0] = $arrCalAspec[$i][0];
                                $floCal=$arrCalAspec[$i][1];
                                
                                $floCal = str_replace(",",".",$floCal);
                                
                                if( $glo_objModelAnali-> buscaEscala($floCal))
                                {
                                    $arrEscaAsp[$i][1] = $glo_objModelAnali-> buscaEscala($floCal);
                                }
                                else
                                {
                                    $arrEscaAsp[$i][1] ="No esta en el rango de la escala!";
                                }
                            }
                        }
                        
                        // muestra los aspectos con toda la información
                        $glo_objViewAnali->mostrarAspec($arrAspec,$arrCalAspec,$arrObAspec,$arrEscaAsp);
                    }
                }
                
                if($temp==2)
                {
                    $glo_objViewAnali->mensaje("NO HAY EVIDENCIAS REGISTRADAS !");
                }
                if($temp==3)
                {
                    $glo_objViewAnali->mensaje("NO HAY GRUPOS DE INTERÉS REGISTRADOS !");
                }
            }
            
        }break;
        case 'buscarEvi':{     
            
            //busca y muestra las evidencias con la calificacíon, ponderación, escala, código
            $temp=0;
            
            if(isset($_SESSION["PLM_IdEvi"]))
            {
                unset($_SESSION["PLM_IdEvi"]);                
            }
            
            
            if(isset($_SESSION["PLM_IdAspec"]))
            {
                $cont=0;
            }
            else
            {
                $arrIdAspec[] = array();
                $intA = $_POST['H_contAspec'];
                
                $cont=-1;
                if(isset($_REQUEST['select']))
                {
                    $arrIdAspec[0] = $_REQUEST['select'];
                    $_SESSION["PLM_IdAspec"] = $arrIdAspec[0];
                    $cont=1;
                }
            }
             
            if($cont==-1)
            {
                $glo_objViewAnali->mensaje("No seleccionó, ningún Aspecto!!!");
            }
            else
            {     
                //se debe conectar a la BD porque no se puede 
                // hacer dos veces el mismo referenciado
                
                $glo_objViewAnali->mostrarInfo($_SESSION["plm_facultad"],$_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
                
                                 
                if(isset($_SESSION["plm_cal_asp"]))
                {
                }
                else
                {
                    $i=0;
					$aux=0;
                    while(isset($_SESSION["plm_id".$i]))
                    {
                        if($_SESSION["plm_id".$i] == $_SESSION["PLM_IdAspec"])
                        {
                            $_SESSION["plm_cal_asp"]=$_SESSION["plm_cal".$i];  
							$aux=1;
                            break;                              
                        }
                        $i++;
                    }
                    
                    if($aux==0)
                    {
                        $_SESSION["plm_cal_asp"]=0;
                    }
                }
                
                //muestra el historial del factor
                $arrFactor = $glo_objModelAnali->buscaFactorCod($_SESSION["PLM_IdFactor"]);
                $glo_objViewAnali->mostrarTablaDinamic($arrFactor, "Factor",$_SESSION["plm_cal_fac"]);
                
                //muestra el historial de la característica
                $arrFactor = $glo_objModelAnali->buscaCaractCod($_SESSION["PLM_IdCarac"]);
                $glo_objViewAnali->mostrarTablaDinamic($arrFactor, "Característica",$_SESSION["plm_cal_car"]);
                
                //muestra el historial del aspecto
                $arrFactor = $glo_objModelAnali->buscaAspecCod($_SESSION["PLM_IdAspec"]);
                $glo_objViewAnali->mostrarTablaDinamic($arrFactor, "Aspecto",$_SESSION["plm_cal_asp"]);
                
                
                $temp=0;
                $arrEvi = $glo_objModelAnali->buscarEvi($_SESSION["PLM_IdAspec"],$_SESSION["pk_proceso"]);
                if(($arrEvi[0][0]))
                {
                   $arrCalEvi = calEvi($arrEvi);
                   if(($arrCalEvi[0][0]))
                   {
                        $glo_objViewAnali->mostrarEvi($arrEvi, $arrCalEvi,$_POST);                    
                   }
                   else
                   {
                    $temp =2;
                   }
                }
                else
                {
                    $glo_objViewAnali->mensaje("NO HAY EVIDENCIAS REGISTRADAS !");   
                }
                if($temp==2)
                {
                    $glo_objViewAnali->mensaje("NO HAY GRUPOS DE INTERÉS REGISTRADOS !");   
                }
            }
        }break;
        case 'graficaGrupoInt':{     
            
            //gráfica de los grupos de interes
            $temp=0;
            if(isset($_SESSION["PLM_IdEvi"]))
            {
                $cont=0;
            }
            else
            {
                $arrIdEvi[] = array();
                $intE = $_POST['H_contEvi'];
                
                $cont=-1;                
                if(isset($_REQUEST['select']))
                {
                    $arrIdEvi[0] = $_REQUEST['select'];
                    $_SESSION["PLM_IdEvi"] = $arrIdEvi[0];
                    $cont=1;
                }
                
            }
            if($cont!=-1)
            {
            
                //se debe conectar a la BD porque no se puede 
                // hacer dos veces el mismo referenciado
                $glo_objViewAnali->mostrarInfo($_SESSION["plm_facultad"],$_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
                  
                if(isset($_SESSION["plm_cal_evi"]))
                {
                }
                else
                {
                    $i=0;
					$aux=0;
                    while(isset($_SESSION["plm_id".$i]))
                    {
                        if($_SESSION["plm_id".$i] == $_SESSION["PLM_IdEvi"])
                        {
                            $_SESSION["plm_cal_evi"]=$_SESSION["plm_cal".$i];  
							$aux=1;
                            break;                              
                        }
                        $i++;
                    }
					
					if($aux==0)
					{
						$_SESSION["plm_cal_evi"]=0;
					}
					
                }
                //va mostrando el historial del factor
                $arrFactor = $glo_objModelAnali->buscaFactorCod($_SESSION["PLM_IdFactor"]);
                $glo_objViewAnali->mostrarTablaDinamic($arrFactor, "Factor",$_SESSION["plm_cal_fac"]);
                
                
                //va mostrando el historial de la característica
                $arrFactor = $glo_objModelAnali->buscaCaractCod($_SESSION["PLM_IdCarac"]);
                $glo_objViewAnali->mostrarTablaDinamic($arrFactor, "Característica",$_SESSION["plm_cal_car"]);
                
                //va mostrando el historial del aspecto
                $arrFactor = $glo_objModelAnali->buscaAspecCod($_SESSION["PLM_IdAspec"]);
                $glo_objViewAnali->mostrarTablaDinamic($arrFactor, "Aspecto",$_SESSION["plm_cal_asp"]);
                
                
                
                //va mostrando el historial de la evidencia
                $arrFactor = $glo_objModelAnali->buscaEvidCod($_SESSION["PLM_IdEvi"]);
                $glo_objViewAnali->mostrarTablaDinamic($arrFactor, "Evidencia",$_SESSION["plm_cal_evi"]);
                
                //busca la calificación del grupo de interes
                $arrGrupos = $glo_objModelAnali->buscaCaliGruInte($_SESSION["PLM_IdEvi"],$_SESSION["pk_proceso"]);
                
                if($arrGrupos[0][0])
                {
                    $glo_objViewAnali->mostrarGraficaGrupos($arrGrupos);
                }
                else
                {
                    $glo_objViewAnali->mensaje("NO HAY GRUPOS DE INTERÉS REGISTRADOS !");
                }
            }
            
        }break;
              
                
        default:{
            
        }break;
    }
}
else
{ 
    global $glo_objViewAnali, $glo_objModelAnali, $arrFactor, $temp;
    
    $temp=0;
            
    if(isset($_SESSION["PLM_IdFactor"]))
    {
        unset($_SESSION["PLM_IdFactor"]);                
    }
    
    $arrInfo = $glo_objModelAnali->buscarProceso($_SESSION["pk_proceso"],$_SESSION["pk_usuario"]);
    if(isset($arrInfo[0][0]))
    {
        $_SESSION["plm_facultad"]=$arrInfo[0];
        $_SESSION["plm_programa"]=$arrInfo[1];
        $_SESSION["plm_sede"]=$arrInfo[2];
        $_SESSION["plm_director"]=$arrInfo[4];
        $_SESSION["plm_periodo"]=$arrInfo[3];
        
    
        $glo_objViewAnali->mostrarInfo($_SESSION["plm_facultad"], $_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);

        //busca todos los factores
        $arrFactor[][]=array();
        $arrFactor = $glo_objModelAnali->buscaFactor();
        $floCal = 0;
        $temp=0;
        $arrCalFactor[][]=array();
        $arrCarac[] =array();
        $arrAspectos[] =array();
        $datos[] =array();
        $resultados_tabla[] =array();

        require_once('../Modelo/PLM_PrincipalAnalisis_Modelo.php');
        $instancia  = new Analisis;

        foreach ($arrFactor as &$value) {
            $arrCarac =  $instancia->listaCaracteristicasProceso($value[0]);
            foreach ($arrCarac as &$caracteristica){
                $datos =  $instancia->obtenerDatosPonderacion($caracteristica[0], $_SESSION["pk_proceso"]);
                $tamaño = count($datos);
                $promedio1 = 0;
                $promedio2 = 0;
                $promedio_modulo5 = 0;
                $promedio_modulo6 = 0;
                $promedio = 0;

                if($tamaño == 0){
                    // $promedio  = 0.00;
                    // $promedio_modulo5 = 0.00;
                    // $promedio_modulo6 = 0.00;
                    $glo_objViewAnali->mensaje("EL PROCESO ACTUAL NO SE HA CONSOLIDADO!");

                }else if($tamaño == 1){

                    $promedio = $datos[0]['calificacion'];
                    if($datos[0]['fk_modulo'] == 5){
                        $promedio_modulo5 = $promedio;
                    }else{
                        $promedio_modulo6 = $promedio;
                    }

                }else if($tamaño == 2){

                    $promedio1 = $datos[0]['calificacion'] != NULL ? $datos[0]['calificacion']  : 0 ;
                    $promedio2 = $datos[1]['calificacion'] != NULL ? $datos[1]['calificacion']  : 0 ;

                    if($datos[0]['fk_modulo'] == 5){
                        $promedio_modulo5 = $promedio1;
                    }else{
                        $promedio_modulo6 = $promedio1;
                    }


                    if($datos[1]['fk_modulo'] == 5){
                        $promedio_modulo5 = $promedio2;
                    }else{
                        $promedio_modulo6 = $promedio2;
                    }

                    $resultados_promedio = $promedio1 + $promedio2;
                    $promedio = $resultados_promedio / 2;

                }

                //$promedio = number_format ($promedio ,2);

                $resultados_carc = array(
                    'factor' => $value[5],
                    'caracteristica' => $caracteristica['codigo'],
                    'valor_modulo_5' => $promedio_modulo5,
                    'valor_modulo_6' => $promedio_modulo6,
                    'promedio' => $promedio,
                    'caracteristica_id' => $caracteristica['pk_caracteristica']
                );

                array_push($resultados_tabla, $resultados_carc);

            }

        }
        require_once("../Vista/PLM_AnalisisResultados_Vista.php");
    }
    else
    {
        $glo_objViewAnali->mensaje("NO HAY PROCESOS PARA CONSOLIDAR!");
    }
}

//funcion que calcula la calificaccion de cada evidencia
//se recibe un array de los códigos de las 
//evidencia y retorna uno con los códigos y las
//calificaciones
function calEvi($arrEvi)
{
    global  $glo_objModelAnali, $temp;
     $intIdEvi=0;
    $arrCalEvi[][] = array();
    $temp=0;
    //calcula la calificacion final de una evidencia
    for($i=0; $i<count($arrEvi); $i++)
    {
        $intIdEvi = $arrEvi[$i][0];
        $arrCalEvi[$i][0] = $intIdEvi;
        $arrGrupo = $glo_objModelAnali ->buscaCaliGruInte($intIdEvi,$_SESSION["pk_proceso"]);
        if(($arrGrupo[0][0]))
        {
            $cont=0;
            $intCalEvi=0;
            for($j=0; $j<count($arrGrupo); $j++)
            {
                if( $arrGrupo[$j][4] == $arrEvi[$i][0])
                {
                    if($arrGrupo[$j][3] != 0 | $arrGrupo[$j][3] != null)
                    {
                        $cont++;
                        $intCalEvi += $arrGrupo[$j][3];   
                    }
                }
            }
            $intCalEvi = ($intCalEvi / $cont);
            $arrCalEvi[$i][1]=$intCalEvi;
        }          
        else
        { 
            $arrCalEvi[$i][1]=0;
        }
    }
    return $arrCalEvi;
}

//calcula la calificacion de un aspecto 
//recibe los códigos de los aspectos 
//y retorna un array de dosposiciones 
//un con el codigo del aspecto y otro 
//con la calificación
function calAspec($arrAspec)
{
    global $glo_objModelAnali, $temp;
    $arrCalAspec[][]=array(); 
    $temp=0;
    for($n=0; $n<count($arrAspec); $n++)
    {
        $arrEvi[][]=array();
        $arrCalEvi[][]=array();
        $arrEvi = $glo_objModelAnali->buscarEvi($arrAspec[$n][0],$_SESSION["pk_proceso"]);
        if(($arrEvi[0][0]))
        {
           
            $arrCalEvi = calEvi($arrEvi);
            if(($arrCalEvi[0][0]))
            {
                $intCalAspec=0;
                for($k=0; $k<count($arrCalEvi); $k++)
                {
                    $intCalAspec +=$arrCalEvi[$k][1];        
                }                
                $intCalAspec = $intCalAspec/count($arrCalEvi);
                                                   
                $arrCalAspec[$n][0]=$arrAspec[$n][0];
                $arrCalAspec[$n][1]=$intCalAspec;
            }
            else
            {              
                $temp=3;
            }
        }
        else   
        {          
        }     
    } 
    return $arrCalAspec;
}

//recibe un array con los códigos de las características
//calcula la calificación de cada característica
// y los retorna en un array de dos posiciones 
//la primera el código d ela caracteristica y la segunda la
//calificación 
function calCarac($arrCarac)
{
    global $glo_objModelAnali, $temp;
    $arrCalCarac[][]=array();
    $temp=0;
    for($l=0; $l<count($arrCarac); $l++)
    {
        $temp=0;
                           
        $arrCalAspec[][] = array();
        $arrAspec[][] = array();
        $arrAspec = $glo_objModelAnali->buscarAspecto($arrCarac[$l][0]);
        if(($arrAspec[0][0]))
        {
            $arrCalAspec = calAspec($arrAspec);
            if(($arrCalAspec[0][0]))
            {
                if($temp!=2  & $temp != 3)
                {
                    $intCalCarac=0;
                    for($k=0; $k<count($arrCalAspec); $k++)
                    {
                        $intCalCarac +=$arrCalAspec[$k][1];
                    }                
                    $intCalCarac = $intCalCarac/count($arrCalAspec);
                    $arrCalCarac[$l][0]=$arrCarac[$l][0];
                    $arrCalCarac[$l][1]=$intCalCarac;                                
                }
            }
        }
   }
   
   return $arrCalCarac;
}


//aqui se hace la referencia a las clases modelo y vista
//para poder tener acceso a la base de datos y a la interface
function mainGeneral(){
    global $glo_objViewAnali, $glo_objModelAnali;
    
    include('../Modelo/PLM_PrincipalAnalisis_Modelo.php');
    include('../Vista/PLM_PrincipalAnalisis_Vista.php'); 
    
    $glo_objViewAnali = new AnalisisFactor();
    $glo_objModelAnali = new  Analisis(); 
    $glo_objModelAnali->conectar(); 
}

//se establece la relación con los conponentes de
//la interface y las funciones de jquery
function jsGeneral(){
    ?>
    <script src="../Js/PLM_Analisis.js" type="text/javascript"></script>  
    <script src="../Js/PLM_paginador.js" type="text/javascript"></script> 
    <script src="../Js/chart.min.js" type="text/javascript"></script>
    <script src="../Js/Chart.js" type="text/javascript"></script>   
    <link rel="stylesheet" href="../Css/PLM_Estilos.css"/> 
    <?php
}
?>