<?php

session_start();

if (isset($_SESSION['pk_usuario'])){
      
    //echo '<SCRIPT LANGUAGE="javascript">location.href = "../Controlador/VIS_Index_Controlador.php";</SCRIPT>';

}
else{
      
    echo '<SCRIPT LANGUAGE="javascript">location.href = "../Controlador/VIS_Index_Controlador.php";</SCRIPT>';

}

require_once("../Vista/VIS_Elementos_Vista.php");

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'guardar':{
            
            require_once("../BaseDatos/AdoDB.php");
    
            require_once('../Modelo/SAD_Usuario_Modelo.php');
            
            $modelo = new Usuario();
        
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
    
    require_once("../BaseDatos/AdoDB.php");
    
    require_once("../Modelo/SAD_Rol_Modelo.php");
    require_once("../Modelo/SAD_Sede_Modelo.php");
    require_once("../Modelo/SAD_Facultad_Modelo.php");
    require_once("../Modelo/SAD_Programa_Modelo.php");
    require_once("../Modelo/SAD_Tipo_Usuario_Modelo.php");
        
}

function vista(){  
    
    lineasBasicas();
    
    global $mensaje;
    
    $claMod = new Rol();
    $resSqlRol = $claMod->Ver();
    
    $claMod = new Sede();
    $resSqlSede = $claMod->Ver();
    $pk_sede = "0";
                   
    $claMod = new Facultad();
    $resSqlFacultad = $claMod->Ver();
    $pk_facultad = "0";
                   
    $claMod = new Programa();
    $resSqlPrograma = $claMod->Ver();
    $strEstadoPrograma = "off";
                    
    $claMod = new Tipo_Usuario();
    $resSqlTipo = $claMod->Ver();
    
    require_once("../Vista/SAD_Agregar_Usuario_Vista.php");
}

function filtrar(){
    
    lineasBasicas();
    
    $mensaje = "";

        $fk_sede_actual = $_SESSION['sad_fk_sede'];
        $fk_facultad_actual = $_SESSION['sad_fk_facultad'];
        $fk_programa_actual = $_SESSION['sad_fk_programa'];

if($fk_sede_actual == 1 && $fk_facultad_actual == 1 && $fk_programa_actual == 1){    
  
    if($_POST['sede'] > 1 && $_POST['facultad'] > 1){
                       
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
    else if($_POST['sede'] == 1 && $_POST['facultad'] > 1){
                       
        $claMod = new Programa();
        $resSqlPrograma = $claMod->Ver_Sede_X_Facultad($_POST);
        
        ?>
        <option value="0">sin seleccionar</option>
        <option value="1">sin programa</option>
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

function mensaje($mensajeRec){
    
    lineasBasicas();
    
    $mensaje = $mensajeRec;
    
    $claMod = new Rol();
    $resSqlRol = $claMod->Ver();
    
    $claMod = new Sede();
    $resSqlSede = $claMod->Ver();
    $pk_sede = "0";
    
    $claMod = new Facultad();
    $resSqlFacultad = $claMod->Ver();
    $pk_facultad = "0";
    
    $claMod = new Programa();
    $resSqlPrograma = $claMod->Ver();
    $strEstadoPrograma = "on";
                    
    $claMod = new Tipo_Usuario();
    $resSqlTipo = $claMod->Ver();
        
    require_once("../Vista/SAD_Agregar_Usuario_Vista.php");
}

?>