       
<?php
$objComponentes = new Elementos();

$datos = array("id" => "formulario"); // (no-necesario) id del formulario

$objComponentes->form($datos);

$datos = array("tipo" => $strTipoColumna, // (necesario) tama�o del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
    "titulo" => $strNombreBuscador, // (no necesario) titulo del bloque
    "alignTitulo" => "texto-izquierda", //  (necesario si se pone titulo) alienacion del titulo {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
    "alignContenido" => "texto-centro", //(necesario) alineacion del contenido del div
    "icono" => "pencil2"); // (necesario si se pone titulo) icono que aparece al lado del titulo

$objComponentes->div_bloque_principal($datos);

///////////////////////////input hidden//////////////////////////////
$datos = array(
    "id" => $strNombreHidden, //(no necesario) define el id que tendra el campo
    "name" => $strNombreHidden,
    "value" => $strValorHidden
);

$objComponentes->input_hidden($datos);

///////////////////////////input hidden//////////////////////////////
$datos = array(
    "id" => $strNombreHiddenSec, //(no necesario) define el id que tendra el campo
    "name" => $strNombreHiddenSec,
    "value" => $strValorHiddenSec
);

$objComponentes->input_hidden($datos);

///////////////////////////input hidden//////////////////////////////
$datos = array(
    "id" => $strNombreHiddenTer, //(no necesario) define el id que tendra el campo
    "name" => $strNombreHiddenTer,
    "value" => $strValorHiddenTer
);

$objComponentes->input_hidden($datos);

///////////////////////////input button filtro check//////////////////////////////
if (isset($filtro_check)) {
    $datos = array(
        "id" => "seleccionar", //(no necesario) el id que tendra el boton
        "class" => "grande", //(necesario) tama�o del boton puede ser {grande,mediano,small}
        "value" => "Ver solo los chequeados", //(necesario) valor que mostrar el boton
        "onclick" => "FiltrarCheck('$url_filtro_check', 'filtrar_check');"// (necesario) funcion js que se ejecutara si se hace click en el boton
    );
    $objComponentes->button_normal($datos);
}

///////////////////////////input button filtro no-check//////////////////////////////
if (isset($filtro_no_check)) {
    $datos = array(
        "id" => "seleccionar", //(no necesario) el id que tendra el boton
        "class" => "grande", //(necesario) tama�o del boton puede ser {grande,mediano,small}
        "value" => "Ver los no chequeados", //(necesario) valor que mostrar el boton
        "onclick" => "FiltrarCheck('$url_filtro_check', 'filtrar_no_check');"// (necesario) funcion js que se ejecutara si se hace click en el boton
    );
    $objComponentes->button_normal($datos);
}

///////////////////////////input button filtro todo//////////////////////////////
if (isset($filtro_todo)) {
    $datos = array(
        "id" => "seleccionar", //(no necesario) el id que tendra el boton
        "class" => "grande", //(necesario) tama�o del boton puede ser {grande,mediano,small}
        "value" => "Ver Todos", //(necesario) valor que mostrar el boton
        "onclick" => "FiltrarCheck('$url_filtro_check', 'filtrar_todo');"// (necesario) funcion js que se ejecutara si se hace click en el boton
    );
    $objComponentes->button_normal($datos);
}

///////////////////////////input hidden//////////////////////////////
$datos = array(
    "id" => $strNombreHiddenSec, //(no necesario) define el id que tendra el campo
    "name" => $strNombreHiddenSec,
    "value" => $strValorHiddenSec
);

$objComponentes->input_hidden($datos);

//////////////////////////////////////////////////////////////////////
$datos = array(
    "id" => "tabla", //(no necesario) define el id que tendra el campo
    "name" => "tabla",
    "encabezadoTabla" => $encabezadoTabla,
    "obligatorio" => $obligatorio_tabla,
    "filtro_check" => $datosFiltroCheck,
    "filtro" => $datosFiltro,
    "select" => $datosSelect,
    "select_estado" => $estadoSelect,
    "select_nombre" => $nombreSelect,
    "select_label" => $labelSelect,
    "select_pk_bd" => $pkSelect,
    "select_nombre_bd" => $nombreSelectBD
);
?><br><br>
<link rel="stylesheet" type="text/css" href="../Complementos/DataTables-1.10.12/media/css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="../Complementos/DataTables-1.10.12/media/js/jquery.dataTables.js"></script>
<table id="example" class="display" cellspacing="0" width="100%">
    <thead>        
        <tr>
            <?php
            foreach ($eleTituloTabla as $elemento => $valor) {
                echo '<th>' . $valor . '</th>';
            }
            ?>
        </tr>
    </thead>        
    <tbody>
        <?php
        while (!$resSql->EOF) {
            echo '<tr >';

            foreach ($eleConteTabla as $elemento => $valor) {

                if ($elemento == "radio") {
                    echo '<td>&nbsp;&nbsp;';
                    echo '<input type="radio" name="radio" id="radio" value="' . $resSql->fields[$valor] . '"/>';
                    echo '</td>&nbsp;&nbsp;';
                } else if ($elemento == "check") {
                    echo '<td>&nbsp;&nbsp;';
                    echo '<input type="checkbox" name="check[]" id="check[]" value="' . $resSql->fields[$valor] . '"';

                    if (isset($_Datos['filtro_check'])) {
                        foreach ($_Datos['filtro_check'] as $filtro) {
                            if ($filtro == $resSql->fields[$valor]) {
                                echo 'checked';
                            }
                        }
                    }
                    echo '/>';
                    echo '&nbsp;&nbsp;</td>';
                } else if ($elemento == "contenido_1") {
                    echo '<td>&nbsp;&nbsp;' . $resSql->fields[$valor] . '&nbsp;&nbsp;</td>';
                } else if ($elemento == "contenido_2") {
                    echo '<td>&nbsp;&nbsp;' . $resSql->fields[$valor] . '&nbsp;&nbsp;</td>';
                } else if ($elemento == "contenido_3") {
                    echo '<td>&nbsp;&nbsp;' . $resSql->fields[$valor] . '&nbsp;&nbsp;</td>';
                } else if ($elemento == "contenido_4") {
                    echo '<td>&nbsp;&nbsp;' . $resSql->fields[$valor] . '&nbsp;&nbsp;</td>';
                } else if ($elemento == "contenido_5") {
                    echo '<td>&nbsp;&nbsp;' . $resSql->fields[$valor] . '&nbsp;&nbsp;</td>';
                } else if ($elemento == "estado") {
                    if ($resSql->fields[$valor] == "1") {
                        echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;Habilitado&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                    } else {
                        echo '<td>&nbsp;&nbsp;Deshabilitado&nbsp;&nbsp;</td>';
                    }
                } else if ($elemento == "filtro_1") {
                    foreach ($_Datos['filtro'] as $filtro => $valorFiltro) {
                        if ($valorFiltro['identificador'] == $valor) {
                            if ($valorFiltro['pk'] == $resSql->fields[$valor]) {
                                echo '<td >&nbsp;&nbsp;' . $valorFiltro['nombre'] . '&nbsp;&nbsp;</td>';
                            }
                        }
                    }
                } else if ($elemento == "filtro_2") {
                    foreach ($_Datos['filtro'] as $filtro => $valorFiltro) {
                        if ($valorFiltro['identificador'] == $valor) {
                            if ($valorFiltro['pk'] == $resSql->fields[$valor]) {
                                echo '<td >&nbsp;&nbsp;' . $valorFiltro['nombre'] . '&nbsp;&nbsp;</td>';
                            }
                        }
                    }
                } else if ($elemento == "filtro_3") {
                    foreach ($_Datos['filtro'] as $filtro => $valorFiltro) {
                        if ($valorFiltro['identificador'] == $valor) {
                            if ($valorFiltro['pk'] == $resSql->fields[$valor]) {
                                echo '<td >&nbsp;&nbsp;' . $valorFiltro['nombre'] . '&nbsp;&nbsp;</td>';
                            }
                        }
                    }
                } else if ($elemento == "filtro_4") {
                    foreach ($_Datos['filtro'] as $filtro => $valorFiltro) {
                        if ($valorFiltro['identificador'] == $valor) {
                            if ($valorFiltro['pk'] == $resSql->fields[$valor]) {
                                echo '<td >&nbsp;&nbsp;' . $valorFiltro['nombre'] . '&nbsp;&nbsp;</td>';
                            }
                        }
                    }
                } else if ($elemento == "filtro_5") {
                    foreach ($_Datos['filtro'] as $filtro => $valorFiltro) {
                        if ($valorFiltro['identificador'] == $valor) {
                            if ($valorFiltro['pk'] == $resSql->fields[$valor]) {
                                echo '<td >&nbsp;&nbsp;' . $valorFiltro['nombre'] . '&nbsp;&nbsp;</td>';
                            }
                        }
                    }
                } else if ($elemento == "filtro_1_texto_flotante") {
                    foreach ($_Datos['filtro'] as $filtro => $valorFiltro) {
                        if ($valorFiltro['identificador'] == $valor) {
                            if ($valorFiltro['pk'] == $resSql->fields[$valor]) {
                                echo '<td style="cursor: pointer;"><span title="' . $valorFiltro['texto_flotante'] . '">&nbsp;&nbsp;' . $valorFiltro['nombre'] . '&nbsp;&nbsp;</span></td>';
                            }
                        }
                    }
                } else if ($elemento == "filtro_2_texto_flotante") {
                    foreach ($_Datos['filtro'] as $filtro => $valorFiltro) {
                        if ($valorFiltro['identificador'] == $valor) {
                            if ($valorFiltro['pk'] == $resSql->fields[$valor]) {
                                echo '<td style="cursor: pointer;"><span title="' . $valorFiltro['texto_flotante'] . '">&nbsp;&nbsp;' . $valorFiltro['nombre'] . '&nbsp;&nbsp;</span></td>';
                            }
                        }
                    }
                } else if ($elemento == "filtro_3_texto_flotante") {
                    foreach ($_Datos['filtro'] as $filtro => $valorFiltro) {
                        if ($valorFiltro['identificador'] == $valor) {
                            if ($valorFiltro['pk'] == $resSql->fields[$valor]) {
                                echo '<td style="cursor: pointer;"><span title="' . $valorFiltro['texto_flotante'] . '">&nbsp;&nbsp;' . $valorFiltro['nombre'] . '&nbsp;&nbsp;</span></td>';
                            }
                        }
                    }
                } else if ($elemento == "filtro_4_texto_flotante") {
                    foreach ($_Datos['filtro'] as $filtro => $valorFiltro) {
                        if ($valorFiltro['identificador'] == $valor) {
                            if ($valorFiltro['pk'] == $resSql->fields[$valor]) {
                                echo '<td style="cursor: pointer;"><span title="' . $valorFiltro['texto_flotante'] . '">&nbsp;&nbsp;' . $valorFiltro['nombre'] . '&nbsp;&nbsp;</span></td>';
                            }
                        }
                    }
                } else if ($elemento == "filtro_5_texto_flotante") {
                    foreach ($_Datos['filtro'] as $filtro => $valorFiltro) {
                        if ($valorFiltro['identificador'] == $valor) {
                            if ($valorFiltro['pk'] == $resSql->fields[$valor]) {
                                echo '<td style="cursor: pointer;"><span title="' . $valorFiltro['texto_flotante'] . '">&nbsp;&nbsp;' . $valorFiltro['nombre'] . '&nbsp;&nbsp;</span></td>';
                            }
                        }
                    }
                }
            }

            $resSql->MoveNext(); //Nos movemos al siguiente registro
            echo '</tr>';
        }
        ?>      
    </tbody>
</table>
<script>
    $(document).ready(function () {
        $(document).ready(function () {
            $('#example').DataTable({
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
        });
    });
</script>
<?php
///////////////////////////input hidden//////////////////////////////
$datos = array(
    "id" => "T_Estado", //(no necesario) define el id que tendra el campo
    "name" => "T_Estado", // (necesario) define el name que tendra el campo
    "value" => ""); // (necesario) El atributo value especifica el valor de un elemento                        

$objComponentes->input_hidden($datos);

/////////////////////////////////input button///////////////////////////////////////////////////        

if (isset($boton_a_herf)) {
    $objComponentes->button_a_herf($datos);
} else {
    $datos = array(
        "id" => "seleccionar", //(no necesario) el id que tendra el boton
        "class" => "grande", //(necesario) tama�o del boton puede ser {grande,mediano,small}
        "value" => $strNombreBoton, //(necesario) valor que mostrar el boton
        "onclick" => $strFuncion// (necesario) funcion js que se ejecutara si se hace click en el boton
    );
    $objComponentes->button_normal($datos);
}

///////////////////////////////ventana Emergente//////////////////////////////////////////////        
$datos = array("id" => "ventana-error", // (necesario) id de la ventana
    "ancho" => "30", //(necesario) ancho en porcentaje que tendra la ventana emergente valores entre 10 y 95
    "alto" => "auto", // (necesario) alto en porcentaje que tendra la ventana valor entre 10 y 90
    "alignContenido" => "texto-centro", // (no necesario - si no se pone se aliena al centro por defeccto) alienacion del contenido
    "des" => "5" // desplazamiento de la ventana con respecto a la parte superior porcentaje de 0 a 100
);

$objComponentes->bloque_div_flotante($datos);

echo $mensaje;

$objComponentes->cerrar_bloque_div_flotante();

$objComponentes->cerrar_div_bloque_principal();

$objComponentes->cerrar_form();
?>


