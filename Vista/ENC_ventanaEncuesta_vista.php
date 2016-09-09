<style type="text/css">
    .contenedor-pregunta{
        background-color:rgba(230,230,230,0.8);
        margin:0rem;
        padding:0rem;
        border:0rem;
    }
    .contenedor-pregunta:nth-child(2n){
        background-color:rgba(155,155,155,0.8);
    }
    /* The side navigation menu */
    .sidenav {
        height: 100%; /* 100% Full-height */
        width: 0; /* 0 width - change this with JavaScript */
        position: fixed; /* Stay in place */
        z-index: 1; /* Stay on top */
        top: 0;
        left: 0;
        background-color: #c3c3c3; /* Black*/
        overflow-x: hidden; /* Disable horizontal scroll */
        padding-top: 60px; /* Place content 60px from the top */
        transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
    }

    /* The navigation menu links */
    .sidenav a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 25px;
        color: #818181;
        display: block;
        transition: 0.3s
    }

    /* When you mouse over the navigation links, change their color */
    .sidenav a:hover, .offcanvas a:focus{
        color: #f1f1f1;
    }

    /* Position and style the close button (top right corner) */
    .sidenav .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
    }

    /* Style page content - use this if you want to push the page content to the right when you open the side navigation */
    #main {
        transition: margin-left .5s;
        padding: 20px;
    }

    /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
    @media screen and (max-height: 450px) {
        .sidenav {padding-top: 15px;}
        .sidenav a {font-size: 18px;}
    }
    /* Style the buttons that are used to open and close the accordion panel */
    div.accordion {
        background-color: #eee !important;
        color: #444 !important;
        cursor: pointer !important;
        padding: 18px !important;
        width: 90% !important;
        text-align: left !important;
        border: none !important;
        outline: none !important;
        transition: 0.4s !important;
        background-image: none !important;
    }

    /* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
    div.accordion.active, button.accordion:hover {
        background-color: #ddd !important;
    }

    /* Style the accordion panel. Note: hidden by default */
    div.panel {
        padding: 0 18px;
        background-color: white;
        padding: 1px;
        display: none;
    }

    /* The "show" class is added to the accordion panel when the user clicks on one of the buttons. This will show the panel content */
    div.panel.show {
        display: block;
    }
</style>
<?php
//header('Content-Type: text/html; charset=ISO-8859-1');
switch ($opcion) {
    case "base":
        $datos = array("id" => "respuestas-encuesta-form");
        $objComp->form($datos);
        $datos = array("id" => "encuesta-solucion", // (necesario) id de la ventana
            "ancho" => "80", //(necesario) ancho en porcentaje que tendra la ventana emergente valores entre 10 y 95
            "alto" => "95", // (necesario) alto en porcentaje que tendra la ventana valor entre 10 y 90
            "alignContenido" => "texto-centro",
            "des" => "2.5"
        );
        $objComp->bloque_div_flotante($datos);
        ?>
        <input type="hidden" value="metodo_pregunta" name="metodo_encuesta"/>
        <h1 style="font-size: 1.4rem; background-color: rgba(100,100,100,0.8); color:rgb(255,255,255); padding:1rem 0rem 1rem 0rem;"><?php echo strtoupper($rsDatosEncuesta->fields[0]); ?></h1>
        <div style="text-align:justify;">
            <p><?php echo ucfirst($rsDatosEncuesta->fields[1]); ?></p>
            <p><?php echo ucfirst($rsDatosEncuesta->fields[2]); ?></p>
            <div>
                <?php
                $alcance = $objGrupoInteres->alcance_grupo_interes($idGrupoInteres);
                //====================== Alcance para Programa ===============================================//
                if ($alcance == 4) {
                    require_once("../Modelo/ENC_encuesta_modelo.php");
                    $objEncuesta = new Encuesta();
                    $resultado = $objEncuesta->get_Encuestas_Activas($idGrupoInteres);
                    echo '<p>Programas de la institución:</p>';
                    echo '<select name="programa">';
                    foreach ($resultado as $key => $value) {
                        echo '<option value ="' . $value['pk_programa'] . '">' . $value['nombre_programa'] . ' de ' . $value['nombre_sede'] . '</option>';
                    }
                    echo '</select>';
                }
                //====================== Alcance Para aquellos que tienen subgrupo ===============================================//
                if ($alcance == 5) {
                    ?>
                    <p>Seleccione su cargo como directivo académico.</p>
                    <p>Actividades misionales como directivo de uno o varios programas de la institución.</p>
                    <select name="cargo">
                        <?php
                        if ($rs_subgrupo_interes->_numOfRows != 0) {
                            ?><option value="0" >Seleccione un cargo</option><?php
                            foreach ($rs_subgrupo_interes as $cargo) {
                                switch ($cargo['fk_alcance_autoevaluacion']) {
                                    case 1://todo
                                        echo '<option value="' . $cargo['fk_alcance_autoevaluacion'] . '">' . $cargo['nombre_subgrupo'] . '</option>';
                                        break;
                                    case 2://facultad
                                        echo '<option onclick="traer_alcance(' . $cargo['fk_alcance_autoevaluacion'] . ',' . $idGrupoInteres . ')" value="' . $cargo['fk_alcance_autoevaluacion'] . '">' . $cargo['nombre_subgrupo'] . '</option>';
                                        break;
                                    case 3://programa
                                        echo '<option onclick="traer_alcance(' . $cargo['fk_alcance_autoevaluacion'] . ',' . $idGrupoInteres . ')" value="' . $cargo['fk_alcance_autoevaluacion'] . '">' . $cargo['nombre_subgrupo'] . '</option>';
                                        break;
                                    case 4://sede
                                        echo '<option onclick="traer_alcance(' . $cargo['fk_alcance_autoevaluacion'] . ',' . $idGrupoInteres . ')" value="' . $cargo['fk_alcance_autoevaluacion'] . '">' . $cargo['nombre_subgrupo'] . '</option>';
                                        break;
                                }
                                if ($cargo['fk_alcance_autoevaluacion'] == '1') {
                                    
                                }
                                ?><?php
                            }
                        } else {
                            ?><option value="0">No hay ningun cargo</option><?php }
                        ?>
                    </select>                
                    <?php
                }
                //====================== Alcance Para Sede ===============================================//
                if ($alcance == 2) {
                    require_once("../Modelo/ENC_encuesta_modelo.php");
                    $objEncuesta = new Encuesta();
                    $DatosEncuestas = $objEncuesta->get_Encuestas_Activas($idGrupoInteres);
                    echo '<p>Sedes de la institución:</p>';
                    echo '<select name="sede">';
                    foreach ($DatosEncuestas as $key => $value) {
                        echo '<option value="' . $value['pk_sede'] . '" onclick="enc_traerPreguntas()">' . $value['nombre_sede'] . '</option>';
                    }
                    echo '</select>';
                }
                ?>
                <div id='contenedor_alcance'></div>
            </div>
        </div>
        <?php
        $objComp->linea_separador(80);
        $datos = array("id" => "seccion-preguntas",
            "tipo" => "una-columna",
            "alignContenido" => "texto-centro");
        $objComp->bloque_div_normal($datos);
        ?><?php
        $datos = array(
            "id" => "button", // (no necesario)el id que tendra el boton
            "class" => "small", //(necesario) tama�o del boton puede ser {grande,mediano,small}
            "value" => "Traer Preguntas", //(necesario) valor que mostrar el boton
            "icono" => "box-add", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
            "onclick" => "enc_traerPreguntas(this);"
        );
        $objComp->button_icono($datos);
        $objComp->cerrar_bloque_div_normal();

        $datos = array("id" => "bloque-dinamico",
            "tipo" => "una-columna",
            "alignContenido" => "texto-centro");
        $objComp->bloque_div_normal($datos);
        $objComp->cerrar_bloque_div_normal();

        $objComp->cerrar_bloque_div_flotante();
        break;
    //****************************************** opcion PROGRAMA ***********************************************///
    case "programa":
        if ($rsDatosProgramas->RecordCount() != 0) {
            ?><option value="0">Seleccione un programa</option><?php
            foreach ($rsDatosProgramas as $programa) {
                ?><option value="<?php echo $programa[0]; ?>"><?php echo ucfirst($programa[1]); ?></option><?php
            }
        } else {
            ?><option value="0">Ningun programa para esa sede</option><?php
        }
        break;
    //****************************************** opcion PROGRAMAS y FACULTADES ***********************************///
    case "programasFacultad":
        if (count($datosProgramasFacultades) != 0) {
            ?><option value="-1">No aplica<input type="radio" name="tipo" value="-1" checked="on"/></option><?php
            foreach ($datosProgramasFacultades as $programa) {
                ?><option value="<?php echo $programa[0]; ?>" onmousedown="enc_seleccionFactorPrograma(this);" ><?php echo ucfirst($programa[1]); ?><input type="radio" name="tipo" value="<?php echo $programa['tipo']; ?>"/></option><?php
            }
        } else {
            ?><option value="0">Ningun programa o facultad</option><?php
        }
        break;
    case "listaPrcocesos":
        if ($datosProgramas->RecordCount() != 0) {
            ?><ul><?php
                foreach ($datosProgramas as $programa) {
                    ?><li><input type="checkbox" name="programas[]" value="<?php echo $programa[0]; ?>"/><?php echo $programa[1]; ?></li>
                <?php
            }
            ?></ul><?php
        } else {
            ?><h1>No hay programas activos para esa sede.</h1><?php
        }
        break;
    //****************************************** opcion PREGUNTAS ***********************************************///
    case "preguntas":
        ?>        
        <input type="hidden" id="respuesta_1"/>
        <div id="main" style="margin-top: 0rem; margin-left:-1rem; -moz-column-count:1; -webkit-column-count:1; column-count:1;">
            <input type="hidden" name="grupoInteres" value="<?php echo $idGrupoInteres; ?>"/>
            <?php if (isset($idProceso)) {
                ?><input type="hidden" name="idProceso" value="<?php echo $idProceso; ?>"/>
                <?php
            }
            if ($encuestas_activas->_numOfRows > 0) {
                foreach ($grupo_preguntas as $key => $pregunta_grupo) {
                    $numero_pregunta = $key + 1;
                    ?>
                    <div style="text-align: left; padding-bottom:1rem;padding-top:1rem; padding-left:1rem; padding-right:1rem;" class="contenedor-pregunta">
                        <p style="margin-top:0rem;"><span style="font-weight:bold;"><?php echo "(" . $numero_pregunta . ") "; ?></span><?php echo $pregunta_grupo['texto']; ?></p>
                        <?php
                        $identificador = 'A';
                        foreach ($respuestas[$pregunta_grupo['pk_pregunta']] as $key_res => $respuesta) {
                            echo '<p style="margin-left:1.5rem; margin-bottom: 0rem;">
                               <span style="font-weight:bold;">(' . $identificador . ') </span>' .
                            $respuesta['texto'] . '</p>';
                            $identificador++;
                        }
                        ?>
                        <div style="cursor:pointer" align='right'><span onclick="openNav('<?php echo $key; ?>')">Responder</span></div>
                    </div>
                    <br>        
                    <div id="mySidenav_<?php echo $key ?>" class="sidenav">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav('<?php echo $key; ?>')">&times;</a>
                        <?php
                        //print_r($pregunta['pk_pregunta']);print_r($encuesta);
                        foreach ($encuestas_activas as $key2 => $encuestas) {
                            ?>
                            <div onclick="acordion()" class="accordion"><?php echo $encuestas['nombre_programa'] . '-' . $encuestas['nombre_sede'] ?></div>
                            <div class="panel">
                                <?php
                                $identificador = 'A';
                                $contador = 0;$relacion=0;
                                foreach ($preguntas_encuesta[$encuestas['pk_encuesta']] as $key_2 => $pregunta) {
                                    if ($pregunta['pk_banco_pregunta'] == $pregunta_grupo['pk_banco_pregunta']) {
                                        foreach ($respuestas_encuesta[$encuestas['pk_encuesta']][$pregunta['pk_pregunta']] as $key_3 => $respuesta) {
                                            echo '(' . $identificador . ') ' . '<input type="radio" name="respuesta_encuesta_' . $encuestas['pk_encuesta'] . '_' . $pregunta['pk_pregunta'] . '" value=' . $respuesta['pk_respuesta_pregunta'] . '>';
                                            $identificador++;
                                        }
                                    } else {
                                        $contador++;
                                    }
                                    $relacion++;
                                }
                            //    echo $contador.' de '.$relacion;
                                if ($contador == $relacion) {
                                    echo '<p>Para este programa no se responde esta pregunta</p>';
                                }
                                ?>
                            </div>

                <?php } ?>

                    </div>

                    <?php
                }
                ?>
                <br /><?php
                $datos = array(
                    "id" => "button", // (no necesario)el id que tendra el boton
                    "class" => "small", //(necesario) tama�o del boton puede ser {grande,mediano,small}
                    "value" => "Enviar", //(necesario) valor que mostrar el boton
                    "icono" => "box-add", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                    "onclick" => "enc_enviarEncuestaSolucion(this);"
                );
                $objComp->button_icono($datos);
            } else {
                echo "NO HAY ENCUESTA ACTIVA EN ESTE MOMENTO.";
                ?><br />


                <?php
                $datos = array(
                    "id" => "button", // (no necesario)el id que tendra el boton
                    "class" => "small", //(necesario) tama�o del boton puede ser {grande,mediano,small}
                    "value" => "Traer Preguntas", //(necesario) valor que mostrar el boton
                    "icono" => "box-add", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                    "onclick" => "enc_traerPreguntas(this);"
                );
                $objComp->button_icono($datos);
            }
            $objComp->cerrar_form();
            ?></div>
        <?php
        break;
}
?>
<script>
    function acordion() {
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].onclick = function () {
                this.classList.toggle("active");
                this.nextElementSibling.classList.toggle("show");
            }
        }
    }

    function traer_alcance(id_alcance, grupo_interes) {
        $.ajax({
            url: '../Vista/ENC_Caja_Respuestas_Vista.php',
            type: 'post',
            dataType: 'html',
            data: {"id_alcance": id_alcance, 'grupo_interes': grupo_interes},
            success: function (data) {
                $('#contenedor_alcance').html(data);
            }
        });
    }
    /* Set the width of the side navigation to 250px */
    function openNav(id_div) {
        document.getElementById("mySidenav_" + id_div).style.width = "250px";
        document.getElementById("main").style.marginLeft = "100px";
    }

    /* Set the width of the side navigation to 0 */
    function closeNav(id_div) {
        document.getElementById("mySidenav_" + id_div).style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
    }
</script>