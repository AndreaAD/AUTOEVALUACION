<?php

session_start();

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'guardar':{
            
            lineasBasicas();
            
            $modelo = new Sub_Grupo();
        
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
    
    require_once("../Modelo/SAD_Sub_Grupo_Modelo.php");
    require_once("../Modelo/SAD_Grupo_Modulos_Modelo.php");
    require_once("../Modelo/SAD_Modulo_Modelo.php");
        
}

function filtrar(){
    
    lineasBasicas();
    
    $mensaje = "";    
    
    $claMod = new Grupo_Modulos();
    $sqlSubGrupo = $claMod->Ver_X_Modulo($_POST);
    
    ?>
    <option value="0">sin seleccionar</option>
    <?php
    
    while(!$sqlSubGrupo->EOF){
        
        ?>
        <option value="<?php echo $sqlSubGrupo->fields['pk_grupos_actividades'];?>"><?php echo $sqlSubGrupo->fields['nombre'];?></option>
        <?php
        
        $sqlSubGrupo->MoveNext();
    }   
    
}

function vista(){  
    
    lineasBasicas();
    
    global $mensaje;

    $claMod = new Modulo();
    $resSqlRol = $claMod->Ver();
    
    $claMod = new Grupo_Modulos();
    $sqlGrupo = $claMod->Ver();
    
    $sqlRol = 'vacio';
    
    require_once("../Vista/SAD_Agregar_Sub_Grupo_Vista.php");
}

?>