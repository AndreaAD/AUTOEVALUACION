

<?php if ($faseProceso != 3) {
    ?>
    <div class="aletra-fase">
        <p>Este proceso se encuentra fuera de la fase de creacion, no podra realizar cambios en esta seccion.</p>
        <p>Para realizar cambios asegurese de estar en la fase correcta.</p>
    </div>
    <?php
}

require_once("elementos_vista.php");
$objComp = new Elementos();

if ($faseProceso == 3) {

    $datos = array("id" => "bloque-crear-modificar", ///(necesario) id que tendra el div que contendra nuevos elementos
        "tipo" => "una-columna", //(necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
        "alignContenido" => "texto-centro"); //(necesario) alineacion del contenido del div {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
    $objComp->bloque_div_normal($datos);

    $datos = array(
        "tipo" => "una-columna", // (necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
        "titulo" => "Creacion de Pregunta por {$nombre_proceso}", // (no necesario) titulo del bloque
        "alignTitulo" => "texto-izquierda", //  (necesario si se pone titulo) alienacion del titulo {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
        "alignContenido" => "texto-centro", //(necesario) alineacion del contenido del div
        "icono" => "pencil2"); // (necesario si se pone titulo) icono que aparece al lado del titulo

    $objComp->div_bloque_principal($datos);
    $objComp->form(array("id" => "crearPregunta"));
    ?>
    <br><br>
    <link rel="stylesheet" type="text/css" href="../Complementos/DataTables-1.10.12/media/css/jquery.dataTables.css">
    <script type="text/javascript" language="javascript" src="../Complementos/DataTables-1.10.12/media/js/jquery.dataTables.js"></script>

    <div class="contenedor-tabla100">
        <table id="lista" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <?php
                    foreach ($encabezado as $key => $value) {
                        echo '<th>' . $value . '</th>';
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($tipo_proceso == 1) {
                    foreach ($listado as $key => $value) {
                        echo '<tr>
                            <td><input type="checkbox" name="caracteristica[]" onclick="validar_check(' . $value['pk_caracteristica'] . ')" value="' . $value['pk_caracteristica'] . '"></td>
                            <td>' . $value['codigo'] . '</td>
                            <td>' . $value['nombre'] . '</td>
                            <td>' . $value['descripcion'] . '</td>
                            <td>' . $value['nombre_factor'] . '</td>
                        </tr>';
                    }
                } else if ($tipo_proceso == 2) {
                    foreach ($listado as $key => $value) {
                        echo '<tr>
                            <td><input type="checkbox" name="aspecto[]" onclick="validar_check(' . $value['pk_aspecto'] . ')" value="' . $value['pk_aspecto'] . '"></td>
                            <td>' . $value['codigo'] . '</td>
                            <td>' . $value['nombre'] . '</td>
                            <td>' . $value['nombre_factor'] . '</td>
                            <td>' . $value['nombre_caracteristica'] . '</td>
                        </tr>';
                    }
                }
                ?>
            </tbody>
        </table>
        <input name="vista_check" type="hidden" readonly="" id="vista_check">
        <input name="tipo_proceso" type="hidden" readonly="" id="tipo_proceso" value="<?php echo $tipo_proceso; ?>">
        <?php
        $datos = array(
            "class" => "grande",
            "value" => "Asignar Pregunta",
            "icono" => "none",
            "onclick" => "visualizar_banco()"
        );
        $objComp->button_normal($datos);
        $datos = array(
            "class" => "grande",
            "value" => "Crear Pregunta",
            "icono" => "none",
            "onclick" => "crear_pregunta()"
        );
        $objComp->button_normal($datos);
        ?>
        <div id="banco_preguntas">
            <table id="lista_preguntas" class="display" cellspacing="0">
                <thead>
                    <tr>
                        <?php
                        foreach ($encabezado_preguntas as $key => $value) {
                            echo '<th>' . $value . '</th>';
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($banco_preguntas as $key => $value) {
                        echo '<tr>
                            <td><input type="radio" id="pk_pregunta" name="pk_pregunta" value="' . $value['pk_pregunta'] . '"></td>
                            <td>' . $value['texto'] . '</td>
                        </tr>';
                    }
                    ?>
                </tbody>
            </table><br><br>
            <div class="grupo-controles-formulario">
                <label for="" class="texto-control-formulario">Grupo de interes:</label>
                <div class="controles-formulario" id="respuestas-contenido">
                    <?php
                    $grupo_institucional = '';
                    $grupo_normal = '';
                    foreach ($rsDatosGrupos as $key => $value) {
                        if ($value['institucional'] == 0) {
                            $grupo_normal.= '<p><input type="checkbox" onclick="visible(0)" name="grupo_interes[]" value="' . $value['pk_grupo_interes'] . '">' . $value['nombre'] . '</input></p>';
                        } else {
                            $grupo_institucional.= '<p><input type="checkbox" onclick="visible(1)" name="grupo_interes[]" value="' . $value['pk_grupo_interes'] . '">' . $value['nombre'] . '</input></p>';
                        }
                    }
                    echo '<div id="grupo_normal">';
                    echo $grupo_normal;
                    echo '</div><br>';
                    echo '<div id="grupo_institucional">';
                    echo $grupo_institucional;
                    echo '</div>';
                    ?>
                </div><!--controles-formulario-->        
            </div>
            <?php
            $datos = array(
                "class" => "grande", //(necesario) tama�o del boton puede ser {grande,mediano,small}
                "value" => "Guardar Pregunta", //(necesario) valor que mostrar el boton
                "icono" => "none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                "onclick" => "enc_guardar_encuesta_generica()"// (necesario) funcion js que se ejecutara si se hace click en el boton
            );
            $objComp->button_normal($datos);
            ?>
        </div>
        <div id="preguntas_manuales">
            <?php
            $datos = array(
                "id" => "hidden", //(no necesario) define el id que tendra el campo
                "name" => "idPregunta", // (necesario) define el name que tendra el campo
                "value" => ""); // (necesario) El atributo value especifica el valor de un elemento            
            $objComp->input_hidden($datos);
            $datos = array(
                "id" => "textarea-pregunta", // (no necesario) define el id que tendra el campo
                "name" => "textoPregunta", // (necesario) define el name del campo
                "label" => "Texto de la pregunta", //(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
                "placeholder" => "Escriba aqui la pregunta", //(no necesario) El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                "help" => "En este espacio debe redactar la pregunta que desea que aparesca."//Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
            );
            $objComp->textarea($datos);

            $datos = array(
                "id" => "cantidad-respuestas", // (no necesario) id que tendra el select
                "name" => "cantidadRespuestas", // (necesario) nombre que tendra el select
                "label" => "Cantidad de respuestas", //(necesario - si se omite queda como si se pasara vacio) el nombre que se mostrara
                "textodefault" => "Seleccione una cantidad",
                "onchange" => "enc_selectCantidadRespuesta(this)"
            );

            $objComp->select($rsCantidadRes, $datos);

            $datos = array("id" => "bloque-respuestas-principal", ///(necesario) id que tendra el div que contendra nuevos elementos
                "tipo" => "una-columna", //(necesario) tama�o del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
                "alignContenido" => "texto-centro"); //(necesario) alineacion del contenido del div {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
            $objComp->bloque_div_normal($datos);

            $datos = array(
                "id" => "tipo-respuesta", //(no necesario)el id que tendra el select
                "name" => "tipoRespuesta", // (necesario) nombre que tendra el select
                "textodefault" => "Seleccione una cantidad primero",
                "label" => "Tipo de respuesta", //(necesario - si se omite queda como si se pasara vacio)el nombre que se mostrara
                "onchange" => "enc_selectTipoRespuesta(this)",
                "disable" => "on"
            );
            $datos_select = array();
            $objComp->select($datos_select, $datos);
            ?>
            <div class="grupo-controles-formulario">
                <label for="" class="texto-control-formulario">Respuestas</label>
                <div class="controles-formulario" id="respuestas-contenido">
                    <p style="padding-top: 0.5em;">Seleccione primero una cantidad de respuestas, luego seleccione un tipo de respuesta.</p>
                </div><!--controles-formulario-->        
            </div><!--grupo-controles-formulario-->
            <?php
            $objComp->cerrar_bloque_div_normal();
            ?>
            <div class="grupo-controles-formulario">
                <label for="" class="texto-control-formulario">Grupo de interes:</label>
                <div class="controles-formulario" id="respuestas-contenido">
                    <?php
                    $grupo_institucional = '';
                    $grupo_normal = '';
                    foreach ($rsDatosGrupos as $key => $value) {
                        if ($value['institucional'] == 0) {
                            $grupo_normal.= '<p><input type="checkbox" onclick="visible(0)" name="grupo_interes[]" value="' . $value['pk_grupo_interes'] . '">' . $value['nombre'] . '</input></p>';
                        } else {
                            $grupo_institucional.= '<p><input type="checkbox" onclick="visible(1)" name="grupo_interes[]" value="' . $value['pk_grupo_interes'] . '">' . $value['nombre'] . '</input></p>';
                        }
                    }
                    echo '<div id="grupo_normal">';
                    echo $grupo_normal;
                    echo '</div><br>';
                    echo '<div id="grupo_institucional">';
                    echo $grupo_institucional;
                    echo '</div>';
                    ?>
                </div><!--controles-formulario-->        
            </div>

            <?php
            $datos = array(
                "class" => "grande", //(necesario) tama�o del boton puede ser {grande,mediano,small}
                "value" => "Guardar Pregunta", //(necesario) valor que mostrar el boton
                "icono" => "none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                "onclick" => "enc_guardar_encuesta_generica()"// (necesario) funcion js que se ejecutara si se hace click en el boton
            );
            $objComp->button_normal($datos);
            ?>
        </div><?php
        $datos = array("id" => "bloque-dinamico", ///(necesario) id que tendra el div que contendra nuevos elementos
            "tipo" => "una-columna", //(necesario) tama�o del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "alignContenido" => "texto-centro"); //(necesario) alineacion del contenido del div {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
        $objComp->bloque_div_normal($datos);
        $objComp->cerrar_bloque_div_normal();
        $objComp->cerrar_form();
        $objComp->cerrar_div_bloque_principal();
        $objComp->cerrar_bloque_div_normal();
        ?>
        <script>
            $("#preguntas_manuales").hide();
            $("#banco_preguntas").hide();
            function visualizar_banco() {
                $("#preguntas_manuales").hide();
                $("#banco_preguntas").show();
            }
            function crear_pregunta() {
                $("#preguntas_manuales").show();
                $("#banco_preguntas").hide();
            }
            function visible(valor_institucional) {
                if (valor_institucional == 0) {
                    $("#grupo_normal").show();
                    $("#grupo_institucional").hide();
                } else {
                    $("#grupo_normal").hide();
                    $("#grupo_institucional").show();
                }

            }
            function enc_guardar_encuesta_generica(opcion, institucional) {
                if (opcion == null) {
                    opcion = "guardar";
                }
                if (institucional == null) {
                    institucional = "normal";
                }
                var msjerrores = "";
                var error = false;
                var txPregunta = $("#crearPregunta #textarea-pregunta").val();
                var pk_pregunta = $("#crearPregunta #pk_pregunta").val();
                if (txPregunta == "" && pk_pregunta == "") {
                    msjerrores += "- El texto de la pregunta no puede ir vacio.<br>";
                    error = true;
                }
                var generico = $("#crearPregunta #vista_check").val();
                if (generico == "") {
                    msjerrores += "Debe seleccionar al menos una caracteristica o aspecto<br>";
                    error = true;
                }
                var cantRes = $("#crearPregunta #cantidad-respuestas").val();
                if (cantRes == 0 && pk_pregunta == "") {
                    msjerrores += "- Debe seleccionar una cantidad de respuestas.<br>";
                    error = true;
                }
                var tipoRes = $("#crearPregunta #tipo-respuesta").val();
                if (tipoRes == 0 && pk_pregunta == "") {
                    msjerrores += "- Debe seleccionar un tipo de respuesta.<br>";
                    error = true;
                }
                var txResErr = 0;
                $("#crearPregunta #textoRespuesta").each(function (i) {
                    if ($(this).val() == "") {
                        txResErr++;
                    }
                });
                if (txResErr > 0 && pk_pregunta == "") {
                    msjerrores += "- Los textos de las respuestas no pueden estar vacios.<br>";
                    error = true;
                }
                if (!error) {
                    var url = "";
                    if (opcion == "guardar") {
                        url = '../Controlador/ENC_guardarPreguntaGenerica.php';
                    } else {
                        if (opcion == "modificar") {
                            url = '../Controlador/ENC_guardarModificacionPregunta_controlador.php';
                        }
                    }
                    var datosPregunta = $("#crearPregunta").serialize();
                    var checkboxValues = "";
                    $('input[name="grupo_interes[]"]:checked').each(function () {
                        checkboxValues += $(this).val() + ",";
                    });
                    checkboxValues = checkboxValues.substring(0, checkboxValues.length - 1);
                    //alert(datosPregunta);
                    $.ajax({
                        url: url,
                        type: 'post',
                        dataType: 'html',
                        data: datosPregunta,
                        success: function (data) {
                            $("#bloque-dinamico").html(data);
                            $("#ventana-info").fadeToggle();
                        }
                    });

                } else {
                    msjerrores = "Se han encontrado errores:<br><br>" + msjerrores;
                    $.ajax({
                        url: '../Controlador/ENC_ventanaEmergente_controlador.php',
                        type: 'post',
                        dataType: 'html',
                        data: {"texto": msjerrores},
                        success: function (data) {
                            $('#bloque-dinamico').html(data);
                            $("#ventana-error").fadeToggle();
                        }
                    });
                }
            }
            function seleccionar_todo() {
                for (i = 0; i < document.formulario.elements.length; i++)
                    if (document.formulario.elements[i].type == "checkbox")
                        document.formulario.elements[i].checked = 1
                crear_array_check();
            }
            function deseleccionar_todo() {
                for (i = 0; i < document.formulario.elements.length; i++)
                    if (document.formulario.elements[i].type == "checkbox")
                        document.formulario.elements[i].checked = 0
                crear_array_check();
            }
            function validar_check(valor) {
                var num = valor.toString();
                if ($("#vista_check").val() == '') {
                    checkboxValues = num + ',';
                } else {
                    checkboxValues = $("#vista_check").val() + ',' + num + ',';
                }

                //eliminamos la última coma.
                checkboxValues = checkboxValues.substring(0, checkboxValues.length - 1);

                $("#vista_check").val(checkboxValues);
            }
            function crear_array_check() {
                var checkboxValues = $("#vista_check").val();
                $('input[name="check[]"]:checked').each(function () {

                    checkboxValues += $(this).val() + ",";


                });
                //eliminamos la última coma.

                $("#vista_check").val(checkboxValues);
            }
            crear_array_check();
            $('#lista').DataTable({
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Ultimo",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });
            $('#lista_preguntas').DataTable({
                "bAutoWidth": false,
                "aoColumns": [
                    {sWidth: "5px"},
                    {sWidth: "500px"}
                ],
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Ultimo",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });
        </script>
    <?php } ?>