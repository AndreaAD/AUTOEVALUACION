<?php

session_start();

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'guardar':{
            
            lineasBasicas();
            
            $modelo = new Proceso();
        
            $mensaje = $modelo->Agregar($_POST);
            
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

    $pk_sede = $_POST['sede'];
    
    $pk_facultad = $_POST['facultad'];
    
    if($_POST['sede'] != 0 && $_POST['facultad'] != 0){
                       
        $claMod = new Programa();
        $resSqlPrograma = $claMod->Ver_Sede_X_Facultad($_POST);
        
        ?>
        <option value="0">sin seleccionar</option>
        <?php
        
        while(!$resSqlPrograma->EOF){
            
            ?>
            <option value="<?php echo $resSqlPrograma->fields['pk_programa'];?>"><?php echo $resSqlPrograma->fields['nombre'];?></option>
            <?php
            
            $resSqlPrograma->MoveNext();
        }
        
    }
    else{        
            
        $claMod = new Programa();
        $resSqlPrograma = $claMod->Ver();
        
        ?>
        <option value="0">sin seleccionar</option>
        <?php
        
        while(!$resSqlPrograma->EOF){
            
            ?>
            <option value="<?php echo $resSqlPrograma->fields['pk_programa'];?>"><?php echo $resSqlPrograma->fields['nombre'];?></option>
            <?php
            
            $resSqlPrograma->MoveNext();
        }                        
            
    }
    
}

function vista(){  
    
    lineasBasicas();
    
    global $mensaje;
    
    $claMod = new Sede();
    $resSqlSede = $claMod->Ver();
    $pk_sede = "0";
    
    $claMod = new Facultad();
    $resSqlFacultad = $claMod->Ver();
    $pk_facultad = "0";
    
    $claMod = new Programa();
    $resSqlPrograma = $claMod->Ver();
    $strEstadoPrograma = "off";
    
    require_once("../Vista/CNA_Agregar_Proceso_Vista.php");
}

?>