<?php
$datos=array(
            "tipo"=>"una-columna",// (necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "titulo"=>"Modificar pregunta", // (no necesario) titulo del bloque
            "alignTitulo"=>"texto-izquierda", //  (necesario si se pone titulo) alienacion del titulo {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
            "alignContenido"=>"texto-centro", //(necesario) alineacion del contenido del div
            "icono"=>"table"); // (necesario si se pone titulo) icono que aparece al lado del titulo
$objComp->div_bloque_principal($datos);
$objComp->form(array("id"=>"crearPregunta"));
$datos=array(
            "id"=>"hidden", //(no necesario) define el id que tendra el campo
            "name"=>"idPregunta", // (necesario) define el name que tendra el campo
            "value"=>$pkPregunta);// (necesario) El atributo value especifica el valor de un elemento  
$objComp->input_hidden($datos);

$datos=array(
            "id"=>"hidden", //(no necesario) define el id que tendra el campo
            "name"=>"institucional", // (necesario) define el name que tendra el campo
            "value"=>"1");// (necesario) El atributo value especifica el valor de un elemento            
$objComp->input_hidden($datos);

$datos=array(
            "id"=>"textarea-pregunta",// (no necesario) define el id que tendra el campo
            "name"=>"textoPregunta", // (necesario) define el name del campo
            "label"=>"Texto de la pregunta",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
            "placeholder"=>"Escriba aqui la pregunta",//(no necesario) El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
            "help"=>"En este espacio debe redactar la pregunta que desea que aparesca.",//Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
            "value"=>utf8_decode($textoPregunta)
            );
$objComp->textarea($datos);

$datos = array(
            "id"=>"cantidad-respuestas",// (no necesario) id que tendra el select
            "name"=>"cantidadRespuestas", // (necesario) nombre que tendra el select
            "label"=>"Cantidad de respuestas",//(necesario - si se omite queda como si se pasara vacio) el nombre que se mostrara
            "textodefault"=>"Seleccione una cantidad",
            "onchange"=>"enc_selectCantidadRespuesta(this)"
            );
$objComp->select($rsCantidadRes,$datos,$cantidadRespuestas);

$datos=array("id"=>"bloque-respuestas-principal",///(necesario) id que tendra el div que contendra nuevos elementos
            "tipo"=>"una-columna", //(necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "alignContenido"=>"texto-centro");//(necesario) alineacion del contenido del div {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
$objComp->bloque_div_normal($datos);

$datos = array(
            "id"=>"tipo-respuesta",//(no necesario)el id que tendra el select
            "name"=>"tipoRespuesta",// (necesario) nombre que tendra el select
            "textodefault"=>"Seleccione un tipo",
            "label"=>"Tipo de respuesta",//(necesario - si se omite queda como si se pasara vacio)el nombre que se mostrara
            "onchange"=>"enc_selectTipoRespuesta(this)"
            );
$objComp->select($arrayTipoRespuestas,$datos,$pkTipoRespuesta);
?>
    <div class="grupo-controles-formulario">
        <label for="" class="texto-control-formulario">Respuestas</label>
        <div class="controles-formulario" id="respuestas_contenido">
        <?php
        //for($i=0;$i<$cantidadRespuestas;$i++){
        foreach($rsDatosRespuestas as $fila){
            ?>
            <div style="width:100%; height:100%; display:block; clear:both; margin-bottom:5.5em;">
                    <div style="display:inline-block;width:60%;float:left; margin-right:3em;">
                        <textarea style="width:100%; height:60px; overflow-y:auto;" id="textoRespuesta" name="textoRespuesta[]"><?php echo $fila[1];?></textarea>
                    </div>
                    <div style="display:inline-block; float:left; width:20%; text-align:center;">
                        <span>Valor</span>
                        <select name="ponderacion[]" style="width:100%;">
                                <?php
                                foreach($rsDatosPonderacion as $datosPonderacion) //Mientras no estemos al final de RecordSet
                                {
                                    ?><option style="display:block;" 
                                    value="<?php echo $datosPonderacion[0];?>"
                                    <?php
                                     if($datosPonderacion[0]==$fila[2]){
                                        ?> selected <?php
                                     }
                                    ?>
                                    >
                                    <?php echo $datosPonderacion[1];?>
                                    </option><?php
                                }
                                ?>
                    </select>
                    </div>
                </div>
                <?php
        }
        ?>
        </div><!--controles-formulario-->        
    </div><!--grupo-controles-formulario-->
<?php

$objComp->cerrar_bloque_div_normal();

$datos = array(
        "name"=>"gruposInteres",//(necesario) name del grupo al que pertenecen los checkbox
        "label"=>"Grupos de Interes",//(necesario - si se omite queda como si se pasara vacio)el nombre que se mostrara
        "class"=>"bloque",//(necesario) decir como queremos que se muestre los elementos {lista,bloque}
        "valor"=>"pk_grupo_interes",//(necesario) el valor que tendra cada elemento segun la consulta sql
        "mostrar"=>"nombre"// (necesario) el valor a msotrar de cada elemnto segun la consulta sql
        );
$objComp->input_checkbox_sql ($rsGruposInteres,$datos,$arrayGruposInteres);

$objComp->linea_separador(80);

$datos = array(
        "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
        "value"=>"Guardar Modificaciones",//(necesario) valor que mostrar el boton
        "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
        "onclick"=>"enc_guardarPregunta('modificar','institucional');"// (necesario) funcion js que se ejecutara si se hace click en el boton
        );
$objComp->button_normal($datos);

$datos = array(
        "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
        "value"=>"Cancelar",//(necesario) valor que mostrar el boton
        "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
        "onclick"=>"enc_cancelarModificar('institucional');"// (necesario) funcion js que se ejecutara si se hace click en el boton
        );
$objComp->button_normal($datos);

$datos=array("id"=>"bloque-dinamico",///(necesario) id que tendra el div que contendra nuevos elementos
            "tipo"=>"una-columna", //(necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "alignContenido"=>"texto-centro");//(necesario) alineacion del contenido del div {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
$objComp->bloque_div_normal($datos);

$objComp->cerrar_bloque_div_normal();
$objComp->cerrar_form();
$objComp->cerrar_div_bloque_principal();
?>