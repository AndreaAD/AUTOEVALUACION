<?php
        //en este formulario se muestran todos los botones 
        //para la administración de las consultas 
        
        global $objComponentes;   
        require_once("../Vista/VIS_Elementos_Vista.php");
        $objComponentes=new Elementos();
        
    
        
        $datos=array("id"=>"principal");
                    
        $objComponentes->form($datos);
        $datos=array(
                "id"=>"H_opcion",//define el nombre que tendra el campo
                "name"=>"H_opcion",//define el nombre que tendra el campo
                "value"=>"ver_factor",//El atributo value especifica el valor de un elemento
                );
                
        $objComponentes->input_hidden($datos);
        
        $datos=array("tipo"=>"bloque una-columna",
                    "titulo"=>"".utf8_encode("Consultar Actividades de Mejoramiento"),
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"pencil2");
        $objComponentes->div_bloque_principal($datos);
        
        
        
        ?>
        
        
        <br />
        <br />  
        <a id="BTN_actividad" class="boton-icono" onclick="enlace_buscar_poractividad();" ><i class="icono icon-download"></i><span class="texto-boton">Por Actividades</span></a>
        <a id="BTN_carac" class="boton-icono" onclick="enlace_buscar_por_carac();" ><i class="icono icon-busy"></i><span class="texto-boton"><?php echo utf8_encode("Por Características");?></span></a>
        <a id="BTN_proces" class="boton-icono" onclick="enlace_buscar_por_proceso();" ><i class="icono icon-busy"></i><span class="texto-boton">Por proceso</span></a>
        <!--<a id="BTN_proces" class="boton-icono" onclick="enlace_analisis_procesos();" ><i class="icono icon-busy"></i><span class="texto-boton">Analisis de procesos</span></a>-->
        <!--<a id="BTN_modifica" class="boton-icono" onclick="enlace_modificar_plm();" ><i class="icono icon-cog"></i><span class="texto-boton">Por Factores</span></a>--!>
        
        
        <!--</a><a id="BTN_caracteristica" class="boton-icono" onclick="enlace_buscar_porcaracteristica();" ><i class="icono icon-busy"></i><span class="texto-boton">Por Características</span></a>--!>
    
        <!--<a id="BTN_factor" class="boton-icono" onclick="enlace_buscar_porfactor();" ><i class="icono icon-quill"></i><span class="texto-boton">Consultar</span></a>--!>

        <?php
        
        $objComponentes->cerrar_div_bloque_principal();
        
        $objComponentes->cerrar_form();     
?>


 
