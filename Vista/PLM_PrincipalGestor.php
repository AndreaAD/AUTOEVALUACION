<?php
        
        //se establecen todos los botones de el administrador de áreas
        
        global $objComponentes;   
        require_once("../Vista/VIS_Elementos_Vista.php");
        $objComponentes=new Elementos();
        
        
        $datos=array("id"=>"gestor");
                    
        $objComponentes->form($datos);
        
        
         
        $datos=array("tipo"=>"bloque una-columna",
                    "titulo"=>"Principal Gestor",
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"pencil2");
        $objComponentes->div_bloque_principal($datos);
        
                
        $datos=array("id"=>"button",//(no necesario) el id que tendra el boton
                    "icono"=>"download",//(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                    "value"=>"Gestor de Rubros",//(necesario) valor que mostrar el boton
                    "onclick"=>"EnviarRubro()");// (necesario) funcion js que se ejecutara si se hace click en el boton
                    
        $objComponentes->button_icono($datos);
                
        $datos=array("id"=>"button",//(no necesario) el id que tendra el boton
                    "icono"=>"busy",//(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                    "value"=>utf8_encode("Gestor de Áreas"),//(necesario) valor que mostrar el boton
                    "onclick"=>"EnviarArea()");// (necesario) funcion js que se ejecutara si se hace click en el boton
                    
        $objComponentes->button_icono($datos);
                
                
        $datos=array("id"=>"button",//(no necesario) el id que tendra el boton
                    "icono"=>"quill",//(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                    "value"=>"Gestor de Escalas",//(necesario) valor que mostrar el boton
                    "onclick"=>"EnviarEscala()");// (necesario) funcion js que se ejecutara si se hace click en el boton
                    
        $objComponentes->button_icono($datos);
        
        
        $datos=array("id"=>"button",//(no necesario) el id que tendra el boton
                    "icono"=>"key",//(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                    "value"=>"Gestor de Proyetos",//(necesario) valor que mostrar el boton
                    "onclick"=>"EnviarProyecto()");// (necesario) funcion js que se ejecutara si se hace click en el boton
                    
        $objComponentes->button_icono($datos);
                
                
        
        $objComponentes->cerrar_div_bloque_principal();
        $objComponentes->cerrar_form();
        
?>

