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
    echo 'entre1';
    switch($_REQUEST['H_opcion']){
        
         case 'obserCarac':{
            //se muestran las observaciones de las caracter�sticas
            //
			 $glo_objViewAnali->mostrarInfo($_SESSION["plm_facultad"],$_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
                       
            
            $arrFactor = $glo_objModelAnali->buscaFactorCod($_SESSION["PLM_IdFactor"]);
            $glo_objViewAnali->mostrarTablaDinamic($arrFactor, "Factor",$_SESSION["plm_cal_fac"]);
            
            
            $arrFactor = $glo_objModelAnali->buscaCaractCod($_SESSION["PLM_IdCarac"]);
            $glo_objViewAnali->mostrarTablaDinamic($arrFactor, "Caracter�stica",$_SESSION["plm_cal_car"]);
           
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
			
			//*****Concatena las observaciones de los aspectos de una caracter�stica
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
			//** fin de la concatenaci�n
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
            
            
            //muestra el historial de la caracter�stica
            $arrFactor = $glo_objModelAnali->buscaCaractCod($_SESSION["PLM_IdCarac"]);
            $glo_objViewAnali->mostrarTablaDinamic($arrFactor, "Caracter�stica",$_SESSION["plm_cal_car"]);
            
            
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
            //se muestra el an�lisis de ls escala cualitativa de los aspectos
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
            
            //se muestra la informaci�n del proceso actual
            $glo_objViewAnali->mostrarInfo($_SESSION["plm_facultad"],$_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
            
            //se muestra la escala cualitatica de todos los acpectos
            $glo_objViewAnali->analisisEscala($arrEscala,"An�lisis de la Escala Cualitativa por Aspecto","AtrasEvi();","graficaGrupoInt",$arrAspec,"Nivel de Cumplimiento por aspectos", "Aspectos");
             
         }break;
         case 'VerAnalisisCarac':{
            //se muestra el an�lisis de la escala cualitativa por caracter�stica
            
            $arrCarac[][]=array();
            $arrEscala[][]=array();
            $arrEscala = $glo_objModelAnali->mostrarEscala();
            // se trae la escala de la caracter�stica
            $arrCarac = $glo_objModelAnali->mostrarCaractProcesoEscala( $_SESSION["pk_proceso"], $_SESSION["PLM_IdFactor"]);
            // se muestra la informaci�n del proceso actual
            $glo_objViewAnali->mostrarInfo($_SESSION["plm_facultad"],$_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
            
            
            $arrFactor = $glo_objModelAnali->buscaFactorCod($_SESSION["PLM_IdFactor"]);
            //se muestra el historial del factor
            $glo_objViewAnali->mostrarTablaDinamic($arrFactor, "Factor",$_SESSION["plm_cal_fac"]);
            
            
            $glo_objViewAnali->analisisEscala($arrEscala,"An�lisis de la Escala Cualitativa por Caracter�stica","AtrasAspec();","buscarEvi",$arrCarac,"Nivel de Cumplimiento por caracter�sticas", "Caracter�sticas");
             
               
         }break;
         
         case'VerAnalisisFac':{
            
            //se muestra el an�lisis de la escala cualitativa de los factores
             
            $arrEscala[][]=array();
            $arrFactores[][]=array();
            
            $arrEscala = $glo_objModelAnali->mostrarEscala();
            //se trae la escala cualitativa de los factores
            $arrFactores = $glo_objModelAnali->mostrarFactorProcesoEscala( $_SESSION["pk_proceso"]);
            
            $glo_objViewAnali->mostrarInfo($_SESSION["plm_facultad"],$_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
                        
            $glo_objViewAnali->analisisEscala($arrEscala,"An�lisis de la Escala Cualitativa por Factor","AtrasCarac();", "escalaFactor",$arrFactores, "Nivel de Cumplimiento por factores", "Factores");
            
         }break;
        
         case 'guardarAnalisis':{
             //guarda el an�lisis de la caracter�stica
            $glo_objModelAnali->guardaAnalisisCarac($_SESSION["PLM_IdCarac"],$_SESSION["PLM_IdFactor"],$_POST["TA_analisis"],$_POST["TA_fortaleza"],$_POST["TA_debilidad"], $_SESSION["pk_proceso"]);
            
            $glo_objViewAnali->mensaje("Proceso Exitoso!!!");
            $glo_objViewAnali->botonAtras("pagAtrasAspec()","buscarEvi");
			
        }break;
                
        case 'AddAnalisis':{
            
            //lo que se quiere es agregar un an�lisis a la caracter�stica seleccionada 
            $arrIdFac[] = array();
            $cont=-1;
            
            if(isset($_REQUEST['select']))
            {
                $arrIdFac[0] = $_REQUEST['select'];
                $_SESSION["PLM_IdCarac"] = $arrIdFac[0];
                $cont=0;
            }
            else if(isset($_SESSION["PLM_IdCarac"]))
			{
				$cont=0;
			}
            if($cont != -1)
            {     
                //traemos el codigo d ela caracter�stica a la cual se le debe agragar el an�lisis
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
                        $_SESSION["plm_cal_car"] = 0;
                    }
                }
                
                //se muestra la informaci�n del proceso actual
                $glo_objViewAnali->mostrarInfo($_SESSION["plm_facultad"],$_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
                
                //mostramos el historial del factor
                $arrFactor = $glo_objModelAnali->buscaFactorCod($_SESSION["PLM_IdFactor"]);
                $glo_objViewAnali->mostrarTablaDinamic($arrFactor, "Factor", $_SESSION["plm_cal_fac"]);
    
                //mostramos el historial del la caracter�stica
                $arrFactor = $glo_objModelAnali->buscaCaractCod($_SESSION["PLM_IdCarac"]);
                $glo_objViewAnali->mostrarTablaDinamic($arrFactor, "Caracter�stica",$_SESSION["plm_cal_car"]);
				
				
				$glo_objViewAnali->mostrarAnalisis();
            }
            else if($cont == -1)
            {
                $glo_objViewAnali->mensaje("Debe seleccionar una caracter�stica !!!");
            }
        }break;
        
        case 'verGraficaFac':{
            //mostramos la infortmaci�n del proceso actual
            $glo_objViewAnali->mostrarInfo($_SESSION["plm_facultad"],$_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
            
            //mostramos la gr�fica de los factores
            $arrFacGrap = $glo_objModelAnali ->buscaCalFac($_SESSION["pk_proceso"]);
            $glo_objViewAnali ->mostGrafCarac($arrFacGrap,"Gr�fica De Factores", "AtrasCarac();");
            
           
            
        }break;
        case 'verGraficaCarac':{
            // en este caso lo que hacermos es mostrar la gr�fica de caracter�sticas
            
            //mostramos la informaci�n del proceso 
            $glo_objViewAnali->mostrarInfo($_SESSION["plm_facultad"],$_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
            //traemos la caracteristica y su calificaci�n
            $arrCaracGrap = $glo_objModelAnali ->buscaCalCarac($_SESSION["PLM_IdFactor"],$_SESSION["pk_proceso"]);
		
            //mostramos el historial del factor
            $arrFactor = $glo_objModelAnali->buscaFactorCod($_SESSION["PLM_IdFactor"]);
            $glo_objViewAnali->mostrarTablaDinamic($arrFactor, "Factor",$_SESSION["plm_cal_fac"]);
            
            //mostramos la gr�fica de las caracter�sticas
            $glo_objViewAnali ->mostGrafCarac($arrCaracGrap,"Gr�fica De Caracter�sticas", "AtrasGrafCarac();");
            
        }break;
        case 'verGraficaAspec':{
                        
            //muestra la informaci�n del proceso actual
            $glo_objViewAnali->mostrarInfo($_SESSION["plm_facultad"],$_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
            
            //lo que se quiere hacer es traer al c�digo de los aspectos en la variable de sesi�n "plm_id"
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
            $glo_objViewAnali->mostrarTablaDinamic($arrFactor, "Caracter�stica",$_SESSION["plm_cal_car"]);
                    
            
            //muestra la grafica de la calificaci�n de los aspectos
            $glo_objViewAnali ->mostGrafCarac($arrAspecGrap,"Gr�fica De Aspectos", "AtrasGrafAspec();");
            
        }break;
       
        case 'buscarCaract':{
            
            //muestra las caracter�sticas, con la calificaci�n, la ponderaci�n y la escala cualitativa
            
            $temp=0;
            if(isset($_SESSION["PLM_IdCarac"]))
            {
                unset($_SESSION["PLM_IdCarac"]);
            }
            if(isset($_SESSION["PLM_IdAspec"]))
            {
                unset($_SESSION["PLM_IdAspec"]);                
            }
            if(isset($_SESSION["PLM_IdEvi"]))
            {
                unset($_SESSION["PLM_IdEvi"]);                
            }
            
            
            if(isset($_SESSION["PLM_IdFactor"]))
            {
                $cont=0;
            }
            else
            {
                //captura el codigo del factor seleccionado
                $arrIdFac[] = array();
                $intF = $_POST['H_contFac'];
                $cont=-1;
                
                if(isset($_REQUEST['select']))
                {
                    $arrIdFac[0] = $_REQUEST['select'];
                    $_SESSION["PLM_IdFactor"] = $arrIdFac[0];
                    $cont=1;
                }             

            }
            if($cont==-1)
            {
                $glo_objViewAnali->mensaje("No seleccion�, ning�n factor!!!");
            }
            else
            {                           
                //muestra la informaci�n del proceso actual
                $glo_objViewAnali->mostrarInfo($_SESSION["plm_facultad"],$_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
                                       
                //busca las caracter�sticas de un factor 
                $arrCarac = $glo_objModelAnali->buscarCarac($_SESSION["PLM_IdFactor"], $_SESSION["pk_proceso"]);
                $arrCalCarac[][] = array();
                $arrEscaCarac[][]=array();
                
                if(($arrCarac[0][0]))
                {                    
                   $arrCalCarac=calCarac($arrCarac);
                   if(($arrCalCarac[0][0]))
                   {
                       if($temp != 2 )
                       {
                            for($i=0; $i<count($arrCalCarac); $i++)
                            {
                                $arrEscaCarac[$i][0] = $arrCalCarac[$i][0];
                                $floCal=$arrCalCarac[$i][1];
                                $glo_objModelAnali->guardaCalCarac($arrCalCarac[$i][0], $arrCalCarac[$i][1],$_SESSION["pk_proceso"]);
                                
                                $floCal = str_replace(",",".",$floCal);
                                
                                if( $glo_objModelAnali-> buscaEscala($floCal))
                                {
                                    $arrEscaCarac[$i][1] = $glo_objModelAnali-> buscaEscala($floCal);
                                }
                                else
                                {
                                    //este mensaje se muestra cuando la calificaci�n no esta en el rango de la escala
                                    $arrEscaCarac[$i][1] ="No est� en el rango de la escala!";
                                }
                            }                    
                        }
                    }
                    else
                    {
                        $temp=4;
                    }
					
					
                    //lo que se quiere es traer la calificaci�n de un factor, en
                    //la variable de sessi�n "plm_cal_fac"
                    if(isset($_SESSION["plm_cal_fac"]))
                    {
                    }
                    else
                    {
                        $i=0;
						$aux=0;
                        while(isset($_SESSION["plm_id".$i]))
                        {
                            if($_SESSION["plm_id".$i] == $_SESSION["PLM_IdFactor"])
                            {
                                $_SESSION["plm_cal_fac"]=$_SESSION["plm_cal".$i]; 
								$aux=1;						
                                break;                               
                            }
                            $i++;
                        }
                        
                        if($aux==0)
                        {
                            $_SESSION["plm_cal_fac"]=0;
                        }
                    }
                    
                    $arrFactor = $glo_objModelAnali->buscaFactorCod($_SESSION["PLM_IdFactor"]);
                    $arrPondeCarac = $glo_objModelAnali->buscaPondeCarac($_SESSION["PLM_IdFactor"], $_SESSION["pk_proceso"]);
                    
                    $glo_objViewAnali->mostrarTablaDinamic($arrFactor, "Factor",$_SESSION["plm_cal_fac"]);
                    $glo_objViewAnali->mostrarCaract($arrCarac,$arrCalCarac,$arrEscaCarac, $arrPondeCarac);     
                    
                                   
                }
                else
                {
                    $glo_objViewAnali->mensaje("NO HAY CARACTER�STICAS REGISTRADAS !");
                }
                if($temp==4)
                {
                    $glo_objViewAnali->mensaje("NO HAY ASPECTOS REGISTRADOS !");
                }
                if($temp==2)
                {
                    $glo_objViewAnali->mensaje("NO HAY EVIDENCIAS REGISTRADAS !");
                }
                if($temp==3)
                {
                    $glo_objViewAnali->mensaje("NO HAY GRUPOS DE INTER�S REGISTRADOS !");
                }
            }
        }break;   
        case 'buscarAspec':{     
            
            //busca y muestra el c�digo, la calificaci�n, ponderaci�n y escala 
            // de todos loes aspectos de una caracter�stica
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
                //guarda el c�digo de la caracter�stica seleccionada
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
                $glo_objViewAnali->mensaje("No seleccion�, ninguna caracter�stica!!!");
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
                
                //muestra el historial de una caracter�stica
                $arrFactor = $glo_objModelAnali->buscaCaractCod($_SESSION["PLM_IdCarac"]);
                $glo_objViewAnali->mostrarTablaDinamic($arrFactor, "Caracter�stica",$_SESSION["plm_cal_car"]);
                  
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
                        
                        // muestra los aspectos con toda la informaci�n
                        $glo_objViewAnali->mostrarAspec($arrAspec,$arrCalAspec,$arrObAspec,$arrEscaAsp);
                    }
                }
                
                if($temp==2)
                {
                    $glo_objViewAnali->mensaje("NO HAY EVIDENCIAS REGISTRADAS !");
                }
                if($temp==3)
                {
                    $glo_objViewAnali->mensaje("NO HAY GRUPOS DE INTER�S REGISTRADOS !");
                }
            }
            
        }break;
        case 'buscarEvi':{     
            
            //busca y muestra las evidencias con la calificac�on, ponderaci�n, escala, c�digo
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
                $glo_objViewAnali->mensaje("No seleccion�, ning�n Aspecto!!!");
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
                
                //muestra el historial de la caracter�stica
                $arrFactor = $glo_objModelAnali->buscaCaractCod($_SESSION["PLM_IdCarac"]);
                $glo_objViewAnali->mostrarTablaDinamic($arrFactor, "Caracter�stica",$_SESSION["plm_cal_car"]);
                
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
                    $glo_objViewAnali->mensaje("NO HAY GRUPOS DE INTER�S REGISTRADOS !");   
                }
            }
        }break;
        case 'graficaGrupoInt':{     
            
            //gr�fica de los grupos de interes
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
                
                
                //va mostrando el historial de la caracter�stica
                $arrFactor = $glo_objModelAnali->buscaCaractCod($_SESSION["PLM_IdCarac"]);
                $glo_objViewAnali->mostrarTablaDinamic($arrFactor, "Caracter�stica",$_SESSION["plm_cal_car"]);
                
                //va mostrando el historial del aspecto
                $arrFactor = $glo_objModelAnali->buscaAspecCod($_SESSION["PLM_IdAspec"]);
                $glo_objViewAnali->mostrarTablaDinamic($arrFactor, "Aspecto",$_SESSION["plm_cal_asp"]);
                
                
                
                //va mostrando el historial de la evidencia
                $arrFactor = $glo_objModelAnali->buscaEvidCod($_SESSION["PLM_IdEvi"]);
                $glo_objViewAnali->mostrarTablaDinamic($arrFactor, "Evidencia",$_SESSION["plm_cal_evi"]);
                
                //busca la calificaci�n del grupo de interes
                $arrGrupos = $glo_objModelAnali->buscaCaliGruInte($_SESSION["PLM_IdEvi"],$_SESSION["pk_proceso"]);
                
                if($arrGrupos[0][0])
                {
                    $glo_objViewAnali->mostrarGraficaGrupos($arrGrupos);
                }
                else
                {
                    $glo_objViewAnali->mensaje("NO HAY GRUPOS DE INTER�S REGISTRADOS !");
                }
            }
            
        }break;
              
                
        default:{
            
        }break;
    }
}
else
{ 
    //si no detecta el componente h_opci�n, 
    //entra aqui , donde muestra la informaci�n del proceso
    // y una tabla con todos los factores y sus calificaciones
    //su escala con la ponderaci�n
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

        require_once('../Modelo/PLM_PrincipalAnalisis_Modelo.php');
        $instancia  = new Analisis;

        foreach ($arrFactor as &$value) {
            $arrCarac =  $instancia->listaCaracteristicasProceso($value[0]);
            foreach ($arrCarac as &$caracteristica){
                
                $datos =  $instancia->obtenerDatosPonderacion($caracteristica[0], $_SESSION["pk_proceso"]);

                foreach ($datos as &$resultado) {
                    foreach ($resultado as &$resultado2) {
                        var_dump(count($resultado2));
                        exit();
                    }
                }
            }
        }

        // for($i=0; $i<count($arrFactor); $i++)
        // {
        //     $arrCarac = $glo_objModelAnali->buscarCarac($arrFactor[$i][0],$_SESSION["pk_proceso"]);
            
        //     // $arrPondeCarac =$glo_objModelAnali->buscaPondeCarac($arrFactor[$i][0],$_SESSION["pk_proceso"]);
        //     // $arrCalCarac[][] = array();
        //     // $floCal =0;
            
        //     //     $arrCalCarac=calCarac($arrCarac);
        //     //     for($j=0; $j<count($arrCalCarac); $j++)
        //     //     {
        //     //         if(isset($arrCalCarac[$j][0]))
        //     //         {
        //     //             if(isset($arrPondeCarac[$j][0]))
        //     //             {                      
        //     //                 if($temp!=5)
        //     //                 {
        //     //                     if($arrCalCarac[$j][0]==$arrPondeCarac[$j][0])
        //     //                     {
        //     //                         $floCal +=  ($arrCalCarac[$j][1]*$arrPondeCarac[$j][2])/100;  
        //     //                     }
        //     //                 }   
        //     //             }
        //     //         }
        //     //     }
        //     //     //va calculando la calificaci�n de cada factor
        //     //     $arrCalFactor[$i][1]=$floCal;           
        //     //     $arrCalFactor[$i][0]=$arrFactor[$i][0]; 
                
         
        // }

        // echo '<pre>';
        // var_dump($arrCarac);
        // exit();


        // if(($arrCalFactor[0][0]))
        // {
        //    $arrEscaFac[][]=array();
        //    if($temp != 2 )
        //    {
        //         $arrEscaFac[][]=array();
        //         for($i=0; $i<count($arrCalFactor); $i++)
        //         {
        //             if(isset( $arrCalFactor[$i][0]))
        //             {
        //                 $arrEscaFac[$i][0] = $arrCalFactor[$i][0];
        //                 $floCal=$arrCalFactor[$i][1];
        //                 $glo_objModelAnali-> guardaCalFac($arrCalFactor[$i][0], $floCal,$_SESSION["pk_proceso"]);
                        
        //                 $floCal = str_replace(",",".",$floCal);
                        
        //                 if( $glo_objModelAnali-> buscaEscala($floCal))
        //                 {
        //                     $arrEscaFac[$i][1] = $glo_objModelAnali-> buscaEscala($floCal);
        //                 }
        //                 else
        //                 {
        //                     // este mensaje sale cuando la calificaci�n no esta en el rango de la escala
        //                     $arrEscaFac[$i][1] ="No est� en el rango de la escala!"; 
        //                 }
        //             }
        //         }                    
        //     }
        // }
        // else
        // {
        //     $glo_objViewAnali->mensaje("NO HAY FACTORES REGISTRADOS !");
        // }
        // if($temp==4)
        // {
        //     $glo_objViewAnali->mensaje("NO HAY ASPECTOS REGISTRADOS !");
        // }
        // if($temp==2)
        // {
        //     $glo_objViewAnali->mensaje("NO HAY EVIDENCIAS REGISTRADAS !");
        // }
        // if($temp==3)
        // {
        //     $glo_objViewAnali->mensaje("NO HAY GRUPOS DE INTER�S REGISTRADOS !");
        // } 
        // if($temp==5)
        // {
        //     $glo_objViewAnali->mensaje("LAS CARACTE�STICAS NO ESTAN PONDERADAS !");
        // }                
        
        // if($temp==0)
        // {
        //     $glo_objViewAnali ->mostrarFac($arrFactor,$arrCalFactor, $arrEscaFac);
            
            
        // }
    }
    else
    {
        $glo_objViewAnali->mensaje("NO HAY PROCESOS PARA CONSOLIDAR!");
    }
}

//funcion que calcula la calificaccion de cada evidencia
//se recibe un array de los c�digos de las 
//evidencia y retorna uno con los c�digos y las
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
//recibe los c�digos de los aspectos 
//y retorna un array de dosposiciones 
//un con el codigo del aspecto y otro 
//con la calificaci�n
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

//recibe un array con los c�digos de las caracter�sticas
//calcula la calificaci�n de cada caracter�stica
// y los retorna en un array de dos posiciones 
//la primera el c�digo d ela caracteristica y la segunda la
//calificaci�n 
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

//se establece la relaci�n con los conponentes de
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