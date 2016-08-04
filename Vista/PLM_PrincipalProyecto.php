<?php

        //en este formulario se establecen los enlaces  
        //de la gestion de los proyectos
        global $objComponentes;   
        require_once("../Vista/VIS_Elementos_Vista.php");
        $objComponentes=new Elementos();
        
        
        $datos=array("id"=>"gestor");
                    
        $objComponentes->form($datos);
        
        
         
        $datos=array("tipo"=>"bloque una-columna",
                    "titulo"=>utf8_encode("Gestión de Proyectos "),
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"icon-quill");
        $objComponentes->div_bloque_principal($datos);
        
        
        
          
        $datos=array("id"=>"BTN_agregar",//(no necesario) el id que tendra el boton
                    "icono"=>"download",//(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                    "value"=>"Agregar",//(necesario) valor que mostrar el boton
                    "onclick"=>"enlace_agregar_proyecto();");// (necesario) funcion js que se ejecutara si se hace click en el boton
                    
        $objComponentes->button_icono($datos);
                
        $datos=array("id"=>"BTN_modifica",//(no necesario) el id que tendra el boton
                    "icono"=>"busy",//(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                    "value"=>"Modificar",//(necesario) valor que mostrar el boton
                    "onclick"=>"enlace_modificar_proyecto()");// (necesario) funcion js que se ejecutara si se hace click en el boton
                    
        $objComponentes->button_icono($datos);
                
                
        $datos=array("id"=>"BTN_habilita",//(no necesario) el id que tendra el boton
                    "icono"=>"key",//(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                    "value"=>"Habilitar",//(necesario) valor que mostrar el boton
                    "onclick"=>"enlace_habilita_proyecto()");// (necesario) funcion js que se ejecutara si se hace click en el boton
                    
        $objComponentes->button_icono($datos);
        
                
        $datos=array("id"=>"BTN_deshabilita",//(no necesario) el id que tendra el boton
                    "icono"=>"key",//(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                    "value"=>"Deshabilitar",//(necesario) valor que mostrar el boton
                    "onclick"=>"enlace_deshabilita_proyecto()");// (necesario) funcion js que se ejecutara si se hace click en el boton
                    
        $objComponentes->button_icono($datos);
        
        $objComponentes->cerrar_div_bloque_principal();
        $objComponentes->cerrar_form();
?>

