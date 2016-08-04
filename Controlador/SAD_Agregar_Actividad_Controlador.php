<?php

session_start();

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'guardar':{
            
            lineasBasicas();
            
            $modelo = new Actividades();
        
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
    
    require_once("../Modelo/SAD_Actividades_Modelo.php");
    require_once("../Modelo/SAD_Grupo_Modulos_Modelo.php");
    require_once("../Modelo/SAD_Sub_Grupo_Modelo.php");
        
}

function filtrar(){
    
    lineasBasicas();
    
    $mensaje = "";    
    
    $claMod = new Sub_Grupo();
    $sqlSubGrupo = $claMod->Ver_X_Grupo($_POST);
    
    ?>
    <option value="0">sin seleccionar</option>
    <option value="1">sin Sub Grupo</option>
    <?php
    
    while(!$sqlSubGrupo->EOF){
        
        ?>
        <option value="<?php echo $sqlSubGrupo->fields['pk_sub_grupo_actividades'];?>"><?php echo $sqlSubGrupo->fields['nombre'];?></option>
        <?php
        
        $sqlSubGrupo->MoveNext();
    }   
    
}

function vista(){  
    
    lineasBasicas();
    
    global $mensaje;
    
    $claMod = new Grupo_Modulos();
    $resSqlRol = $claMod->Ver();

    $modelo = new Sub_Grupo();    
    $sqlSubGrupo = $modelo->Ver();
       
    require_once("../Vista/SAD_Agregar_Actividad_Vista.php");
}

?>