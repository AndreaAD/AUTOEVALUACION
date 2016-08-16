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
        "tipo" => "una-columna", //(necesario) tama�o del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
        "alignContenido" => "texto-centro"); //(necesario) alineacion del contenido del div {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
    $objComp->bloque_div_normal($datos);

    $datos = array(
        "tipo" => "una-columna", // (necesario) tama�o del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
        "titulo" => "Construir Encuestas del Proceso", // (no necesario) titulo del bloque
        "alignTitulo" => "texto-izquierda", //  (necesario si se pone titulo) alienacion del titulo {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
        "alignContenido" => "texto-centro", //(necesario) alineacion del contenido del div
        "icono" => "pencil2"); // (necesario si se pone titulo) icono que aparece al lado del titulo
    $objComp->div_bloque_principal($datos);
    ?>
    <br>
    <link rel="stylesheet" type="text/css" href="../Complementos/DataTables-1.10.12/media/css/jquery.dataTables.css">
    <script type="text/javascript" language="javascript" src="../Complementos/DataTables-1.10.12/media/js/jquery.dataTables.js"></script>
    <div class="contenedor-tabla100">
        <table id="lista" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Seleccionar</th>
                    <th>Nombre</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Programa</th>
                    <th>Sede</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($listado_procesos_disponibles as $key => $value) {
                    echo ' <tr>
                            <td><input type="radio" name="ir" onclick="activar_encuesta(' . $value['pk_proceso'] . ',&apos;' . $value['nombre_programa'] . '&apos;)" value="' . $value['pk_proceso'] . '"></td>
                            <td>' . $value['nombre'] . '</td>
                            <td>' . $value['fecha_inicio'] . '</td>
                            <td>' . $value['fecha_fin'] . '</td>
                            <td>' . $value['nombre_programa'] . '</td>
                            <td>' . $value['nombre_sede'] . '</td>
                        </tr>';
                }
                ?>
            </tbody>
        </table>
        <?php
        $datos = array("id" => "bloque-dinamico", ///(necesario) id que tendra el div que contendra nuevos elementos
            "tipo" => "una-columna", //(necesario) tama�o del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "alignContenido" => "texto-centro"); //(necesario) alineacion del contenido del div {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
        $objComp->bloque_div_normal($datos);

        $objComp->cerrar_bloque_div_normal();
        ?>
        <script>
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

            function activar_encuesta(id_proceso, programa) {
                var confirmacion = confirm("¿Esta Seguro que desea activar las encuestas del programa " + programa + "?");
                if (confirmacion) {
                    url = '../Controlador/ENC_job_generico.php';
                    $.ajax({
                        url: url,
                        type: 'post',
                        dataType: 'html',
                        data: {id_proceso: id_proceso},
                        success: function (data) {
                            if(data==''){
                                alert('Se ha Construido la encuesta Correctamente!!');
                            }else{
                                alert('Esta encuesta ya habia sido construida!!');
                            }
                            
                        }
                    });
                }
            }
        </script>
        <?php
        $objComp->cerrar_bloque_div_normal();
        $objComp->cerrar_div_bloque_principal();
    }
    ?>