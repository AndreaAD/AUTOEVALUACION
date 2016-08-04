<?php

session_start();

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'guardar':{
            
            lineasBasicas();
            
            $modelo = new Proceso();
        
            $mensaje = $modelo->Agregar_Multi($_POST);
            
            vista();
            
        }break;
        
        case 'filtrar':{
            
            filtrar();            
            
        }break;
        
        default:{            
            vista();            
        }break;
    }
}
else{
    vista();
}

function lineasBasicas(){
    
    require_once("../Vista/VIS_Elementos_Vista.php");

    require_once("../BaseDatos/AdoDB.php");
    
    require_once("../Modelo/CNA_Proceso_Modelo.php");
    require_once("../Modelo/CNA_Fase_Modelo.php");
    
    require_once("../Modelo/SAD_Sede_Modelo.php");
    require_once("../Modelo/SAD_Facultad_Modelo.php");
    require_once("../Modelo/SAD_Programa_Modelo.php");
}

function filtrar(){
    
    lineasBasicas();
    
    $mensaje = "";
    
    $datos_impresion = array();
    
    if(isset($_POST['pk_sede']) != 0 && isset($_POST['pk_facultad']) != 0){
        
        foreach($_POST['pk_sede'] as $sede){
            foreach($_POST['pk_facultad'] as $facultad){
                $datos = array("sede"=>$sede, "facultad"=>$facultad); 
                           
                $claMod = new Programa();
                $resSqlPrograma = $claMod->Ver_Sede_X_Facultad($datos);
                
                while(!$resSqlPrograma->EOF){
                    $datos_impresion[] = array( "pk_programa"=>$resSqlPrograma->fields['pk_programa'],
                                                "nombre"=>$resSqlPrograma->fields['nombre'],
                                                "nombre_sede"=>$resSqlPrograma->fields['nombre_sede'],);
                    $resSqlPrograma->MoveNext();
                }
                
            }
        }
        ?>
        <div class="grupo-controles-formulario"> 
        
            <label for="" class="texto-control-formulario texto-grupo-checkbox">Programas</label>
             
        <div class="controles-formulario">
        <?php
        foreach($datos_impresion as $titulo){
            ?>            
            <div class="checkbox-bloque">
            
            <div class="control-checkbox">
            <input type="checkbox" id="<?php echo $titulo['nombre'].$titulo['nombre_sede'];?>" name="programa[]"
            value="<?php echo $titulo['pk_programa'];?>" />
            
            <label for="<?php echo $titulo['nombre'].$titulo['nombre_sede'];?>" class="checkbox-label"></label>            
            
            </div><!--control-checkbox-->
            <span class="checkbox-texto"><label for="<?php echo $titulo['nombre'].$titulo['nombre_sede'];?>"><?php echo $titulo['nombre'].' - '.$titulo['nombre_sede'];?></label></span>
            </div><!--checkbox-bloque-->
            <?php
        }
        ?>
        </div><!--controles-formulario-->
                
        <p id="obligatorio_programa" style="color: red;"></p>
                    
        </div><!--grupo-controles-formulario-->        
        <?php   
            
    }
    
}

function vista(){  
    
    lineasBasicas();
    
    global $mensaje;
    
    $datos_impresion;
    
    $claMod = new Sede();
    $resSqlSede = $claMod->Ver();
    $pk_sede = "0";
    
    $claMod = new Facultad();
    $resSqlFacultad = $claMod->Ver();
    $pk_facultad = "0";
    
    $claMod = new Programa();
    $resSqlPrograma;// = $claMod->Ver();
    $strEstadoPrograma = "off";
    
    require_once("../Vista/CNA_Agregar_Multi_Procesos_Vista.php");
}

?>