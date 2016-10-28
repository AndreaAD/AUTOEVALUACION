<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../Complementos/DataTables-1.10.12/media/css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="../Complementos/DataTables-1.10.12/media/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="../Css/DOC_Estilos.css">
<script type="text/javascript" src="../Js/DOC_SelectoresIndex.js"></script>
<script>
    $(function(e){
        $('#tabla_ponderacion_factor').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
        $('#tabla_ponderacion_caracteristica').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
    })


</script>
<div class="bloque una-columna">
    <div class="titulo-bloque texto-izquierda">
        <h2 class="icon-quill">Resultados</h2>
    </div>
    <div class="div_formularios">
        <div class="row">
            <h1>Ponderación por factor</h1><br><br>
        </div> 
        <div class="row" style="width:96%;">
            <div class="col-md-12">
                <table id="tabla_ponderacion_factor" class="display select" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Ponderación</th>
                            <th>Resultado</th>
                            <th>Cumplimiento</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <br><h1>Ponderación por caracteristica</h1><br><br>
        </div> 
        <div class="row" style="width:96%;">
            <div class="col-md-12">
                <table id="tabla_ponderacion_caracteristica" class="display select" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Factor</th>
                            <th>Nombre</th>
                            <th>Ponderación</th>
                            <th>Resultado</th>
                            <th>Cumplimiento</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>