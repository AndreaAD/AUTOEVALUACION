<script src="../Complementos/jquery-ui-1.12.1.custom/external/jquery/jquery.js" type="text/javascript"></script>
<link rel="stylesheet" href="../Complementos/jquery-ui-1.12.1.custom/jquery-ui.css">
<script src="../Complementos/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="../Complementos/DataTables-1.10.12/media/css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="../Complementos/DataTables-1.10.12/media/js/jquery.dataTables.js"></script>
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
?>
<input type="hidden" name="T_Estado" value="guardar"/>
<table id="lista" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <?php
            echo '<th>#</th>';
            echo '<th>Nombre</th>';
            echo '<th>Estado</th>';
            echo '<th>Ponderacion</th>';
            echo '<th>Tipo</th>';
            echo '<th>Justificacion</th>';
            echo '<th>Ponderacion Caracteristicas</th>';
            ?>
        </tr>
    </thead>    
    <tbody>
        <?php
        foreach ($resSql as $key => $value) {
            $tipo_ponderacion_factor = $ponderacion[$value['pk_factor']]->fields['fk_tipo_ponderacion'];
            $estado = ($value['estado'] == '1') ? 'Activo' : 'Inactivo';
            echo '<tr>
                    <td>' . $value['codigo'] . '</td>
                    <td>' . $value['nombre'] . '</td>
                    <td>' . $estado . '</td>
                    <td><input name="ponderacion_' . $value['pk_factor'] . '" type="text" value="' . $ponderacion[$value['pk_factor']]->fields['ponderacion_porcentual'] * 100 . '"/></td>
                    <td><select name="tipo_ponderacion_' . $value['pk_factor'] . '">';
            foreach ($tipo_ponderacion as $key2 => $value2) {
                //echo $ponderacion. ' - '. $value2['pk_tipo_ponderacion'];
                $checked = ($tipo_ponderacion_factor == $value2['pk_tipo_ponderacion']) ? 'selected' : '';
                echo '<option ' . $checked . ' value=' . $value2['pk_tipo_ponderacion'] . '>' . $value2['nombre'] . '</option>';
            }

            echo '</select></td>';
            echo '<td><textarea name="justificacion_factor_' . $value['pk_factor'] . '" cols="50" rows="3">' . $ponderacion[$value['pk_factor']]->fields['justificacion'] . '</textarea></td>';
            echo '<td><button type="button" class="boton-solo-icono" onclick="ponderacion_caracteristicas(' . $value['pk_factor'] . ')"><i class="icon icon-pencil2"></i></button></td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>
<div id="dialogo" title="Ponderacion de Factores">
    <p>Se ha cambiado correctamente la ponderacion de los factores</p>
</div>

<?php
/////////////////////////////////input button///////////////////////////////////////////////////        
echo '<input type="button" id="enviar" value="Aceptar">';

$objComponentes->cerrar_div_bloque_principal();
$objComponentes->cerrar_form();
?>
<script>

    $("#dialogo").dialog({
        autoOpen: false,
        show: {
            effect: "blind",
            duration: 1000
        },
        hide: {
            effect: "explode",
            duration: 1000
        }
    });
    $("#enviar").click(function () {
        var datos = $("#formulario").serialize();
        $.ajax({
            url: 'CNA_Agregar_Ponderacion_Factor_Controlador.php',
            type: 'post',
            dataType: 'html',
            data: datos,
            success: function (data) {
                $("#dialogo").dialog("open");
                $('.principal-panel-sub-contenido').html(data);
            }
        });
    });

    function ponderacion_caracteristicas(id_factor) {
        $.ajax({
            url: 'CNA_Controlador.php',
            type: 'post',
            dataType: 'html',
            data: {pk_factor: id_factor, opcion: 'ver_ponderacion_caracteristicas'},
            success: function (data) {
                $('.principal-panel-sub-contenido').html(data);
            }
        });
    }

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

</script>