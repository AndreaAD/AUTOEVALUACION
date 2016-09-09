<br>

<?php
$id_alcance = $_POST['id_alcance'];
$grupo_interes = $_POST['grupo_interes'];
switch ($id_alcance) {
    case 2://facultad
        require_once("../Modelo/ENC_encuesta_modelo.php");
        $objEncuesta = new Encuesta();
        $DatosEncuestas = $objEncuesta->get_Facultad_Encuesta($grupo_interes);
        echo '<p>Facultades de la institución:</p>';
        echo '<select name="facultad">';
        foreach ($DatosEncuestas as $key => $value) {
            echo '<option value="'.$value['pk_facultad'].'">' . $value['nombre_facultad'] . '</option>';
        }
        echo '</select>';
        break;
    case 3://programa
        require_once("../Modelo/ENC_encuesta_modelo.php");
        $objEncuesta = new Encuesta();
        $resultado = $objEncuesta->get_Encuestas_Activas($grupo_interes);
        echo '<p>Programas de la institución:</p>';
        echo '<select name="programa">';
        foreach ($resultado as $key => $value) {
            echo '<option value ="' . $value['pk_programa'] . '">' . $value['nombre_programa'] . ' de ' . $value['nombre_sede'] . '</option>';
        }
        echo '</select>';
        break;
    case 4://sede
        require_once("../Modelo/ENC_encuesta_modelo.php");
        $objEncuesta = new Encuesta();
        $DatosEncuestas = $objEncuesta->get_Encuestas_Activas($grupo_interes);
        echo '<p>Sedes de la institución:</p>';
        echo '<select name="sede">';
        foreach ($DatosEncuestas as $key => $value) {
            echo '<option value="'.$value['pk_sede'].'">' . $value['nombre_sede'] . '</option>';
        }
        echo '</select>';
        break;

    default:
        break;
}
