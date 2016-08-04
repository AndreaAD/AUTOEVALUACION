<?php
    if(isset($_REQUEST['sede'])){
        if(isset($_REQUEST['empleadores'])){
            require_once("../Modelo/ENC_programas_modelo.php");
            $objProgramas=new Programas();
            $datosProgramas=$objProgramas->getProgramasProcesoSede($_REQUEST['sede']);
            if($datosProgramas->RecordCount()!=0){
               echo '<ul>';
               foreach($datosProgramas as $programa){
                    ?><li><input type="checkbox" name="programas[]" value="<?php echo $programa[0];?>"/><?php echo $programa[1];?></li>
                    <?php
                }
                echo '</ul>';
            }else{
                ?><span>No</span><?php
            }
        }else{
             require_once("../Modelo/ENC_programas_modelo.php");
             $objProgramas=new Programas();
             $rsProgramas=$objProgramas->getProgramasSede($_REQUEST['sede'])->GetArray();
             foreach($rsProgramas as $programa){
                echo '<option value="'.$programa[0].'">'.$programa[1].' </option>';
             }
        } 
    }else{
?>
<!DOCTYPE html>
<html lang="es">
  <head>
  <script src="../Js/jquery.min.2.1.1.js" type="text/javascript"></script>
<style>
#bloque-grupo{
    border:1px solid black;
    margin:10px;    
    padding:10px;
    display:inline-block;   
}

#bloque-grupo ul{
    list-style: none;
    margin:0;
    padding:0;
}
</style>
<script type="text/javascript">
    $( document ).ajaxStart(function() {
        $('#log').html('<h1>Procesando......</h1>');
    });
    
    $( document ).ajaxStop(function(){
        $('#log').html('<h1>Fin</h1>');
    });
    
    function programaSede(_this){
        var _cont=_this;
        $.ajax({
            url:   '../Controlador/ENC_solucionarEncuestasBot.php',
            type:  'post',
            dataType:'html',
            data: {'sede':$(_cont).val()},
            success:  function (data) {
                $(_cont).parent().parent().find('select[name=programa]').html(data);
            }
       });
    }
    function procesoPograma(_this){
        var _cont=_this;
        $.ajax({
            url:   '../Controlador/ENC_solucionarEncuestasBot.php',
            type:  'post',
            dataType:'html',
            data: {'sede':$(_cont).val(),'empleadores':true},
            success:  function (data) {
                $('#programasEmpleadores').html(data);
                }
            
       });
    }
    
    function estudiantes(){
        var cantidad=$('#estudiantes').find('input[name=cantidad]').val();
        estudiantes_ajax(cantidad,1);
    }
    
    function estudiantes_ajax(cant,i){
        $.ajax({
            url:   '../Controlador/ENC_procesarBot.php',
            type:  'post',
            dataType:'html',
            data: $('#estudiantes').serialize(),
            success:  function (data) {
                $('#log').html('<h1>Procesado :'+i+'</h1>');
                $('#resultados').append('<hr><span>encuesta '+i+' =</span>'+data);
                i++;
                if(i<=cant){
                    estudiantes_ajax(cant,i);
                }
            }
       });
    }
    function docentes(){
       var cantidad=$('#profesores').find('input[name=cantidad]').val();
       docentes_ajax(cantidad,1);
    }
    function docentes_ajax(cant,i){
         $.ajax({
            url:   '../Controlador/ENC_procesarBot.php',
            type:  'post',
            dataType:'html',
            data: $('#profesores').serialize(),
            success:  function (data) {
                $('#log').html('<h1>Procesado :'+i+'</h1>');
                $('#resultados').append('<hr><span>encuesta '+i+' =</span>'+data);
                i++;
                if(i<=cant){
                    docentes_ajax(cant,i);
                }
            }
       });
    }
    function graduados(){
       var cantidad=$('#graduados').find('input[name=cantidad]').val();
       graduados_ajax(cantidad,1);
    }
    function graduados_ajax(cant,i){
        $.ajax({
            url:   '../Controlador/ENC_procesarBot.php',
            type:  'post',
            dataType:'html',
            data: $('#graduados').serialize(),
            success:  function (data) {
               $('#log').html('<h1>Procesado :'+i+'</h1>');
                $('#resultados').append('<hr><span>encuesta '+i+' =</span>'+data);
                i++;
                if(i<=cant){
                    graduados_ajax(cant,i);
                }
            }
       });
    }
    function administrativos(){
        var cantidad=$('#administrativos').find('input[name=cantidad]').val();
        ajax_administrativos(cantidad,1);
    }
    function ajax_administrativos(cant,i){
        $.ajax({
            url:   '../Controlador/ENC_procesarBot.php',
            type:  'post',
            dataType:'html',
            data: $('#administrativos').serialize(),
            success:  function (data) {
                $('#log').html('<h1>Procesado :'+i+'</h1>');
                $('#resultados').append('<hr><span>encuesta '+i+' =</span>'+data);
                i++;
                if(i<=cant){
                    ajax_administrativos(cant,i);
                }
            }
       });
    }
    function empleadores(){
        var cantidad=$('#empleadores').find('input[name=cantidad]').val();
        empleadores_ajax(cantidad,1);
    }
    function empleadores_ajax(cant,i){
        $.ajax({
            url:   '../Controlador/ENC_procesarBot.php',
            type:  'post',
            dataType:'html',
            data: $('#empleadores').serialize(),
            success:  function (data) {
                $('#log').html('<h1>Procesado :'+i+'</h1>');
                $('#resultados').append('<hr><span>encuesta '+i+' =</span>'+data);
                i++;
                if(i<=cant){
                    empleadores_ajax(cant,i);
                }
            }
       });
    }
    function reset(){
        $('#resultados').html('');
    }
</script>
  </head> 
  <body>
<h1>SISTEMA DE LLENADO DE ENCUESTAS</h1>
<?php
    require_once('../Modelo/ENC_gruposInteres_modelo.php');
    require_once("../Modelo/ENC_cargoDirectivo_modelo.php");
    require_once("../Modelo/ENC_alcanceAdministrativos_modelo.php");
    require_once("../Modelo/ENC_sedes_modelo.php");
    require_once("../Modelo/ENC_programas_modelo.php");
    $objGrupos=new GruposInteres();
    $objCargoDirectibos=new CargosDirectivos();
    $objAlcandeAdmin=new AlcanceAdministrativos();
    $objSedes=new Sedes();
    //$objProgramas=new Programas();
    $rsGrupos=$objGrupos->getAllGrupos()->GetArray();
    $rsCargos=$objCargoDirectibos->getAllCargosDirectivos()->GetArray();
    $rsAlcanceAdmin=$objAlcandeAdmin->getAllalcances()->GetArray();
    //$rsProgramas=$objProgramas->getProgramasSede()->GetArray();
    $rsSedes=$objSedes->getAllSedes()->GetArray();
    //****************************** Estudiantes **************
    echo '<div id="bloque-grupo">';
    echo '<form id="estudiantes">';
    echo '<input type="hidden" name="grupo" value="'.$rsGrupos[0][0].'"/>';
    echo '<h2>'.$rsGrupos[0][1].'</h2>';
    echo '<ul>';
    echo '<li> Sede</li>';
    echo '<li>';
    echo '<select name="sede" onChange="programaSede(this);">';
    foreach($rsSedes as $sede){
        echo '<option value="'.$sede[0].'">'.$sede[1].' </option>';
    }
    echo '</select>';
    echo '</li>';
    echo '<li> Programa</li>';
    echo '<li>';
    echo '<select name="programa">';
    echo '</select>';
    echo '</li>';
    echo '<li> cantidad de encuestas:</li>';
    echo '<li><input type="text" name="cantidad"/> </li>';
    echo '</ul>';
    echo '<input  type="button" value="procesar" onclick="estudiantes();"/>';
    echo '</form>';
    echo '</div>';
    //******************************* Profesores *************
    echo '<div id="bloque-grupo">';
    echo '<form id="profesores">';
    echo '<input type="hidden" name="grupo" value="'.$rsGrupos[1][0].'"/>';
    echo '<h2>'.$rsGrupos[1][1].'</h2>';
    echo '<ul>';
    echo '<li> Sede</li>';
    echo '<li>';
    echo '<select name="sede" onChange="programaSede(this);">';
    foreach($rsSedes as $sede){
        echo '<option value="'.$sede[0].'">'.$sede[1].' </option>';
    }
    echo '</select>';
    echo '</li>';
    echo '<li> Programa</li>';
    echo '<li>';
    echo '<select name="programa">';
    echo '</select>';
    echo '</li>';
    echo '<li> cantidad de encuestas:</li>';
    echo '<li><input type="text" name="cantidad"/> </li>';
    echo '</ul>';
    echo '<input  type="button" value="procesar" onclick="docentes();"/>';
    echo '</form>';
    echo '</div>';
    //*********************************** Directivos Academicos ********
    /*echo '<div id="bloque-grupo">';
    echo '<form id="directivos">';
    echo '<input type="hidden" name="grupo" value="'.$rsGrupos[2][0].'"/>';
    echo '<h2>'.$rsGrupos[2][1].'</h2>';
    echo '<ul>';
    echo '<li> Sede</li>';
    echo '<li>';
    echo '<select name="sede">';
    foreach($rsSedes as $sede){
        echo '<option value="'.$sede[0].'">'.$sede[1].' </option>';
    }
    echo '</select>';
    echo '</li>';
    echo '<li> Programa</li>';
    echo '<li>';
    echo '<select name="programa">';
    echo '</select>';
    echo '</li>';
    echo '<li> cantidad de encuestas:</li>';
    echo '<li><input type="text" name="cantidad"/> </li>';
    echo '</ul>';
    echo '<input  type="button" value="procesar" onclick=""/>';
    echo '</form>';
    echo '</div>';*/
    //********************************** Graduados *********
    echo '<div id="bloque-grupo">';
    echo '<form id="graduados">';
    echo '<input type="hidden" name="grupo" value="'.$rsGrupos[3][0].'"/>';
    echo '<h2>'.$rsGrupos[3][1].'</h2>';
    echo '<ul>';
    echo '<li> Sede</li>';
    echo '<li>';
    echo '<select name="sede" onChange="programaSede(this);">';
    foreach($rsSedes as $sede){
        echo '<option value="'.$sede[0].'">'.$sede[1].' </option>';
    }
    echo '</select>';
    echo '</li>';
    echo '<li> Programa</li>';
    echo '<li>';
    echo '<select name="programa">';
    echo '</select>';
    echo '</li>';
    echo '<li> cantidad de encuestas:</li>';
    echo '<li><input type="text" name="cantidad"/> </li>';
    echo '</ul>';
    echo '<input  type="button" value="procesar" onclick="graduados();"/>';
    echo '</form>';
    echo '</div>';
    //********************************** Administrativos *********
    echo '<div id="bloque-grupo">';
    echo '<form id="administrativos">';
    echo '<input type="hidden" name="grupo" value="'.$rsGrupos[4][0].'"/>';
    echo '<h2>'.$rsGrupos[4][1].'</h2>';
    echo '<ul>';
    echo '<li> Sede</li>';
    echo '<li>';
    echo '<select name="sede">';
    foreach($rsSedes as $sede){
        echo '<option value="'.$sede[0].'">'.$sede[1].' </option>';
    }
    echo '</select>';
    echo '</li>';
    echo '<li>';
    echo '<li> Alcance administrativo</li>';
    echo '<li>';
    echo '<select name="alcance" onChange="">';
    foreach($rsAlcanceAdmin as $alcance){
        echo '<option value="'.$alcance[0].'">'.$alcance[1].' </option>';
    }
    echo '</select>';
    echo '</li>';
    echo '<li> cantidad de encuestas:</li>';
    echo '<li><input type="text" name="cantidad"/> </li>';
    echo '</ul>';
    echo '<input  type="button" value="procesar" onclick="administrativos();"/>';
    echo '</form>';
    echo '</div>';
    //********************************* Empleadores **********
    echo '<div id="bloque-grupo">';
    echo '<form id="empleadores">';
    echo '<input type="hidden" name="grupo" value="'.$rsGrupos[5][0].'"/>';
    echo '<h2>'.$rsGrupos[5][1].'</h2>';
    echo '<ul>';
    echo '<li> Sede</li>';
    echo '<li>';
    echo '<select name="sede" onChange="procesoPograma(this);">';
    foreach($rsSedes as $sede){
        echo '<option value="'.$sede[0].'">'.$sede[1].' </option>';
    }
    echo '</select>';
    echo '</li>';
    echo '<li> Programas</li>';
    echo '<li>';
    echo '<ul id="programasEmpleadores"></ul>';
    echo '</li>';
    echo '<li> cantidad de encuestas:</li>';
    echo '<li><input type="text" name="cantidad"/> </li>';
    echo '</ul>';
    echo '<input  type="button" value="procesar" onclick="empleadores();"/>';
    echo '</form>';
    echo '</div>';
    //*******************************************
?>
<input  type="button" value="reset" onclick="reset();"/>
<hr />
<div id="log"></div>
<div id="resultados"></div>
</body>
</html>

<?php
}
?>



