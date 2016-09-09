<style>
    #myProgress {
        position: relative;
        width: 100%;
        height: 30px;
        background-color: grey;
    }
    #myBar {
        position: absolute;
        width: 1%;
        height: 100%;
        background-color: green;
    }
    /* If you want the label inside the progress bar */
    #label {
        text-align: center; /* If you want to center it */
        line-height: 30px; /* Set the line-height to the same as the height of the progress bar container, to center it vertically */
        color: white;
    }
    .alert {
    padding: 20px;
    background-color: #61b161; /* Red */
    color: white;
    margin-bottom: 15px;
}

/* The close button */
.closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
}

/* When moving the mouse over the close button */
.closebtn:hover {
    color: black;
}
</style>
<?php
session_start();
require_once("../Modelo/ENC_consolidarInformacion_modelo.php");
$id_proceso = $_SESSION['pk_proceso'];
$opcion = $_GET['opcion'];
if ($opcion == 'ponderacion_automatica') {
    calcular_ponderacion_automatica($id_proceso);
    echo '<div id="myProgress">
            <div id="myBar">
              <div id="label">10%</div>
            </div>
          </div>';
    echo '<br>';
    echo '<div class="alert" id="alerta">
            <span class="closebtn" onclick="this.parentElement.style.display=&apos;none;&apos;">&times;</span>
            Se ha cargado automaticamente la ponderacion
          </div>';
}

if ($opcion == 'visualizar_resultados_ponderacion') {
    ponderar_caracteristicas_encuestas($id_proceso);
}

function ponderar_caracteristicas_encuestas($id_proceso) {

    /*
     * CALCULO DE LA PONDERACION POR CARACTERISTICA
     */
    $factor_bruto = array();
    $factor_neto = array();
    $objConsolidacion = new Consolidacion();
    $cna_pregunta = $objConsolidacion->Aspectos_Encuesta($id_proceso, 'fk_caracteristica');
    //print_r($cna_pregunta);die();
    $valor_aspecto = array();
    foreach ($cna_pregunta as $key => $value) {
        $preguntas = $objConsolidacion->Preguntas_CNA($value['fk_caracteristica'], null, null);
        $promedio = 0;
        $maximo = 0;
        //echo '<pre>';print_r($preguntas);die();
        foreach ($preguntas as $key2 => $value2) {
            //echo $value2['pk_pregunta'].'-';
            $promedio += $objConsolidacion->Promedio_Ponderacion_Pregunta($value2['pk_pregunta']);
            $maximo+= $objConsolidacion->Maximo_Ponderacion_Pregunta($value2['pk_pregunta']);
        }
        //$promedio = $promedio / sizeof($preguntas);
        $valor_aspecto[$value['fk_caracteristica']] = $promedio / $maximo;
        //echo 'Caracteristica: ' . $value['fk_caracteristica'] . '=' . $valor_aspecto . '<br>';
    }
    $factor = $objConsolidacion->CNA_Factor();

    foreach ($factor as $key => $value) {
        $caracteristica = $objConsolidacion->CNA_Factor_Caracteristica($value['pk_factor']);
        $ponderacion_factor = $objConsolidacion->CNA_Factor_Ponderacion_Proceso($value['pk_factor'], $id_proceso) * 100;
        $factor_bruto[$value['pk_factor']] = 0;
        foreach ($caracteristica as $key2 => $value2) {
            $factor_bruto[$value['pk_factor']]+=@$valor_aspecto[$value2['pk_caracteristica']];
        }
        $factor_neto[$value['pk_factor']] = ($factor_bruto[$value['pk_factor']] / $caracteristica->_numOfRows) * $ponderacion_factor;
    }
    print_r($factor_neto);
}

function ponderar_aspectos_encuestas($id_proceso) {

    /*
     * CALCULO DE LA PONDERACION POR ASPECTOS
     */
//traer aspectos que fueron utilizados y en que preguntas
    $objConsolidacion = new Consolidacion();
    $aspectos_pregunta = $objConsolidacion->Aspectos_Encuesta($id_proceso);
    foreach ($aspectos_pregunta as $key => $value) {
        $preguntas = $objConsolidacion->Preguntas_CNA(null, $value['fk_aspecto'], null);
        $promedio = 0;
        $maximo = 0;
        //echo '<pre>';print_r($preguntas);die();
        foreach ($preguntas as $key2 => $value2) {
            //echo $value2['pk_pregunta'].'-';
            $promedio += $objConsolidacion->Promedio_Ponderacion_Pregunta($value2['pk_pregunta']);
            $maximo+= $objConsolidacion->Maximo_Ponderacion_Pregunta($value2['pk_pregunta']);
        }
        //$promedio = $promedio / sizeof($preguntas);
        $valor_aspecto = $promedio / $maximo;
        echo 'Aspecto: ' . $value['fk_aspecto'] . '=' . $valor_aspecto . '<br>';
    }
}

function calcular_ponderacion_automatica($id_proceso) {
    /*
     * PONDERACION AUTOMATICA
     */
    $objConsolidacion = new Consolidacion();
    $evidencias_sistemas = $objConsolidacion->Obtener_ElementoCNA_Ponderados('evidencia.pk_evidencia', 'fk_evidencia', $id_proceso);
    $aspectos_sistemas = $objConsolidacion->Obtener_ElementoCNA_Ponderados('aspecto.pk_aspecto', 'fk_aspecto', $id_proceso);
    $caracteristica_sistemas = $objConsolidacion->Obtener_ElementoCNA_Ponderados('caracteristica.pk_caracteristica', 'fk_caracteristica', $id_proceso);
    $factor_sistemas = $objConsolidacion->Obtener_ElementoCNA_Ponderados('factor.pk_factor', 'fk_factor', $id_proceso);

    /*
     * CALCULO DE EVIDENCIAS
     */
    if ($evidencias_sistemas->_numOfRows > 0) {
        $evidencias = $objConsolidacion->Obtener_ElementoCNA_Faltantes('evidencia.pk_evidencia', 'fk_evidencia', $id_proceso, false);
        foreach ($evidencias as $key => $value) {
            $valor_existencia = $objConsolidacion->Cantidad_Porcentual_Existente('fk_evidencia', 'pk_evidencia', 'pk_aspecto', $value['pk_aspecto'], $id_proceso);
            $cantidad_faltante = $objConsolidacion->Cantidad_elementos_faltantes('fk_evidencia', 'pk_evidencia', 'pk_aspecto', $value['pk_aspecto'], $id_proceso);
            $valor_ponderacion_insertar = (1 - $valor_existencia) / $cantidad_faltante;
            $objConsolidacion->Agregar_ponderacion_proceso($id_proceso, null, null, null, $value['pk_evidencia'], $valor_ponderacion_insertar);
        }
    } else {
        $evidencias = $objConsolidacion->Obtener_ElementoCNA_Faltantes('evidencia.pk_evidencia', 'fk_evidencia', $id_proceso);
        foreach ($evidencias as $key => $value) {
            $valor_evidencia = $objConsolidacion->Valor_PonderacionEvidencia_Automatica($value['pk_aspecto']);
            $objConsolidacion->Agregar_ponderacion_proceso($id_proceso, null, null, null, $value['pk_evidencia'], $valor_evidencia);
        }
    }
    /*
     * CALCULO DE ASPECTOS
     */
    if ($aspectos_sistemas->_numOfRows > 0) {
        $aspectos = $objConsolidacion->Obtener_ElementoCNA_Faltantes('pk_aspecto', 'fk_aspecto', $id_proceso, false);
        foreach ($aspectos as $key => $value) {
            $valor_existencia = $objConsolidacion->Cantidad_Porcentual_Existente('fk_aspecto', 'pk_aspecto', 'pk_caracteristica', $value['pk_caracteristica'], $id_proceso);
            $cantidad_faltante = $objConsolidacion->Cantidad_elementos_faltantes('fk_aspecto', 'pk_aspecto', 'pk_caracteristica', $value['pk_caracteristica'], $id_proceso);
            // echo 'tengo= '.$valor_existencia.' faltan '.$cantidad_faltante.'<br>';
            $valor_ponderacion_insertar = (1 - $valor_existencia) / $cantidad_faltante;
            $objConsolidacion->Agregar_ponderacion_proceso($id_proceso, null, null, $value['pk_aspecto'], null, $valor_ponderacion_insertar);
        }
    } else {
        $aspectos = $objConsolidacion->Obtener_ElementoCNA_Faltantes('aspecto.pk_aspecto', 'fk_aspecto', $id_proceso);
        foreach ($aspectos as $key => $value) {
            $valor_aspecto = $objConsolidacion->Valor_PonderacionAspecto_Automatica($value['pk_caracteristica']);
            $objConsolidacion->Agregar_ponderacion_proceso($id_proceso, null, null, $value['pk_aspecto'], null, $valor_aspecto);
        }
    }
    /*
     * CALCULO DE CARACTERISTICAS
     */
    if ($caracteristica_sistemas->_numOfRows > 0) {
        $caracteristica = $objConsolidacion->Obtener_ElementoCNA_Faltantes('pk_caracteristica', 'fk_caracteristica', $id_proceso);
        foreach ($caracteristica as $key => $value) {
            $valor_existencia = $objConsolidacion->Cantidad_Porcentual_Existente('fk_caracteristica', 'pk_caracteristica', 'pk_factor', $value['pk_factor'], $id_proceso);
            $cantidad_faltante = $objConsolidacion->Cantidad_elementos_faltantes('fk_caracteristica', 'pk_caracteristica', 'pk_factor', $value['pk_factor'], $id_proceso);
            //  echo 'tengo= '.$valor_existencia.' faltan '.$cantidad_faltante.'<br>';
            $valor_ponderacion_insertar = (1 - $valor_existencia) / $cantidad_faltante;
            $objConsolidacion->Agregar_ponderacion_proceso($id_proceso, null, $value['pk_caracteristica'], null, null, $valor_ponderacion_insertar);
        }
    } else {
        $caracteristicas = $objConsolidacion->Obtener_ElementoCNA_Faltantes('caracteristica.pk_caracteristica', 'fk_caracteristica', $id_proceso);
        foreach ($caracteristicas as $key => $value) {
            $valor_caracteristica = $objConsolidacion->Valor_PonderacionCaracteristica_Automatica($value['pk_factor']);
            $objConsolidacion->Agregar_ponderacion_proceso($id_proceso, null, $value['pk_caracteristica'], null, null, $valor_caracteristica);
        }
    }
    /*
     * CALCULO DE FACTORES
     */
    if ($factor_sistemas->_numOfRows > 0) {
        $factor = $objConsolidacion->Obtener_ElementoCNA_Faltantes('pk_factor', 'fk_factor', $id_proceso, false);
        foreach ($factor as $key => $value) {
            $valor_existencia = $objConsolidacion->Cantidad_Porcentual_Existente('fk_factor', 'pk_factor', null, null, $id_proceso);
            $cantidad_faltante = $objConsolidacion->Cantidad_elementos_faltantes('fk_factor', 'pk_factor', null, null, $id_proceso);
            //echo 'tengo= '.$valor_existencia.' faltan '.$cantidad_faltante.'<br>';
            $valor_ponderacion_insertar = (1 - $valor_existencia) / $cantidad_faltante;
            $objConsolidacion->Agregar_ponderacion_proceso($id_proceso, $value['pk_factor'], null, null, null, $valor_ponderacion_insertar);
        }
    } else {
        $factor = $objConsolidacion->Obtener_ElementoCNA_Faltantes('factor.pk_factor', 'fk_factor', $id_proceso);
        foreach ($factor as $key => $value) {
            $valor_factor = $objConsolidacion->Valor_PonderacionFactor_Automatica();
            $objConsolidacion->Agregar_ponderacion_proceso($id_proceso, $value['pk_factor'], null, null, null, $valor_factor);
        }
    }
}
?>
<script>
    $("#alerta").hide();
    var elem = document.getElementById("myBar");
    var width = 10;
    var id = setInterval(frame, 80);
    function frame() {
        if (width >= 100) {
            clearInterval(id);
            $("#alerta").show();
        } else {
            width++;
            elem.style.width = width + '%';
            document.getElementById("label").innerHTML = width * 1 + '%';
        }
    }

</script>
