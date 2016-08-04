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
</style>
<?php
//header('Content-Type: text/html; charset=ISO-8859-1');
switch($opcion){
    case "base":
        $datos=array("id"=>"respuestas-encuesta-form");
        $objComp->form($datos);
        $datos=array("id"=>"encuesta-solucion",// (necesario) id de la ventana
                "ancho"=>"90",//(necesario) ancho en porcentaje que tendra la ventana emergente valores entre 10 y 95
                "alto"=>"95",// (necesario) alto en porcentaje que tendra la ventana valor entre 10 y 90
                "alignContenido"=>"texto-centro",
                "des"=>"2.5" 
                );
        $objComp->bloque_div_flotante($datos);
        ?><h1 style="font-size: 1.4rem; background-color: rgba(100,100,100,0.8); color:rgb(255,255,255); padding:1rem 0rem 1rem 0rem;"><?php  echo strtoupper($rsDatosEncuesta->fields[0]);?></h1>
        <div style="text-align:justify;">
            <p><?php  echo ucfirst($rsDatosEncuesta->fields[1]);?></p>
            <p><?php  echo ucfirst($rsDatosEncuesta->fields[2]);?></p>
            <div>
            <?php
            //========================== datos estudiantes ================================================//
            if($idGrupoInteres==1){
                ?>
                <p>Por favor seleccione la sede/seccional en la cual Usted estudia.</p>
                <select name="sede" onchange="enc_ajaxSelect(this,'programa','../Controlador/ENC_ventanaEncuesta_controlador.php','programa');">
                    <option value="0">Ninguna</option>
                    <?php
                    foreach($rsDatosSedes as $sede){
                        ?><option value="<?php echo $sede[0];?>"><?php echo ucfirst($sede[1]);?></option><?php
                    }
                    ?>
                </select>
                <p>Por favor seleccione el PROGRAMA DE FORMACI&Oacute;N que Usted estudia.</p>
                <select name="programa" onchange="<?php //echo "enc_traerPreguntas(this)";?>">
                    <option value="0">Ninguna</option>
                </select>
                <?php
            }
            //====================== datos docente ===============================================//
            if($idGrupoInteres==2){
                ?>
                <p>Por favor seleccione la Sede/Seccional en la cual Usted es docente</p>
                <select name="sede" onchange="enc_ajaxSelect(this,'programa','../Controlador/ENC_ventanaEncuesta_controlador.php','programa');">
                    <option value="0">Ninguna</option>
                    <?php
                    foreach($rsDatosSedes as $sede){
                        ?><option value="<?php echo $sede[0];?>"><?php echo ucfirst($sede[1]);?></option><?php
                    }
                    ?>
                </select>
                <p>Por favor seleccione el PROGRAMA DE FORMACIÓN en el cual Usted es docente.</p>
                <p>Si dirige asignaturas en varios programas o es un docente de áreas transversales, por favor seleccione el programa en que más horas dirige o el que mejor conozca</p>
                <select name="programa" onchange="<?php //echo "enc_traerPreguntas(this)";?>">
                    <option value="0">Ninguna</option>
                </select>
                <?php
            }
            //====================== Datos directivo academico ===============================================//
            if($idGrupoInteres==3){
                ?>
                <p>Seleccione la sede/seccional en la que Usted labora.</p>
                <select name="sede" onchange="enc_ajaxSelect(this,'programaFacultad','../Controlador/ENC_ventanaEncuesta_controlador.php','programasFacultad');">
                    <option value="0">Ninguna</option>
                    <?php
                    foreach($rsDatosSedes as $sede){
                        ?><option value="<?php echo $sede[0];?>"><?php echo ucfirst($sede[1]);?></option><?php
                    }
                    ?>
                </select>
                <p>Seleccione su cargo como directivo académico.</p>
                <p>Actividades misionales como directivo de uno o varios programas de la institución.</p>
                <select name="cargo" onchange="<?php //echo "seleccionFactorPrograma(this)";?>">
                  <?php
                    if($rsCargos->RecordCount()!=0){
                     ?><option value="0">Seleccione un cargo</option><?php
                        foreach($rsCargos as $cargo){
                            ?><option value="<?php echo $cargo[0];?>"><?php echo ucfirst($cargo[1]);?></option><?php
                        }
                    }else{
                        ?><option value="0">Ningun hay ningun cargo</option><?php
                    }?>
                </select>
                <p>Si su cargo es Decano o Director/coordinador de programa, seleccione la facultad o programa respectivos</p>
                <p>En caso de ser otro cargo, seleccione "No aplica"</p>
                <select name="programaFacultad" onchange="<?php //echo "enc_seleccionFactorPrograma(this);";?>">
                    <option value="0">Ninguna</option>
                </select>
                <?php   
             }
            //========================== datos Graduados ================================================//
            if($idGrupoInteres==4){
                ?>
                <p>Por favor seleccione la sede/seccional en la cual Usted estudió.</p>
                <select name="sede" onchange="enc_ajaxSelect(this,'programa','../Controlador/ENC_ventanaEncuesta_controlador.php','programa');">
                    <option value="0">Ninguna</option>
                    <?php
                    foreach($rsDatosSedes as $sede){
                        ?><option value="<?php echo $sede[0];?>"><?php echo ucfirst($sede[1]);?></option><?php
                    }
                    ?>
                </select>
                <p>Por favor seleccione el PROGRAMA DE FORMACIÓN que Usted estudió</p>
                <select name="programa" onchange="<?php //echo "enc_traerPreguntas(this)";?>">
                    <option value="0">Ninguna</option>
                </select>
                <?php
            }   
            //========================== datos FUNCIONARIOS ADMINISTRATIVOS =====================================//
            if($idGrupoInteres==5){
                ?>
                <p>Seleccione la sede o seccional de la Universidad de Cundinamarca en la cual usted labora.</p>
                <select name="sede" onchange="">
                    <option value="0">Ninguna</option>
                    <?php
                    foreach($rsDatosSedes as $sede){
                        ?><option value="<?php echo $sede[0];?>"><?php echo ucfirst($sede[1]);?></option><?php
                    }
                    ?>
                </select>
                <p>Señale por favor el alcance del cargo en el que Usted labora</p>
                <p>Señale si sus actividades y resposanbilidades aplican solo para la sede/seccional o para toda la institución</p>
                <select name="alcance" onchange="<?php //echo "enc_traerPreguntas(this)";?>">
                    <option value="0"></option>
                     <?php
                    foreach($rsAlcanceAdmin as $alcance){
                        ?><option value="<?php echo $alcance[0];?>"><?php echo ucfirst($alcance[1]);?></option><?php
                    }
                    ?>
                </select>
                <?php
            }   
            //========================== DATOS EMPLEADORES =====================================//
            if($idGrupoInteres==6){
                ?>
                <p>Seleccione la sede/seccional del programa o programas que se evalúan</p>
                <p>No importa si el empleador/institución se encuentra en otra ciudad diferente a las sedes/seccionales de la UDEC</p>
                <select name="sede" onchange="enc_listarProcesosSede(this);">
                    <option value="0">Ninguna</option>
                    <?php
                    foreach($rsDatosSedes as $sede){
                        ?><option value="<?php echo $sede[0];?>"><?php echo ucfirst($sede[1]);?></option><?php
                    }
                    ?>
                </select>
                <p>Seleccione los programas a los cuales desea aplicar la encuesta:</p>
                <div id="lista_programas">
                <p>Seleccione una sede.</p>
                </div>
                <?php
            }   
            ?>
            </div>
        </div>
        <?php
        $objComp->linea_separador(80);
        $datos=array("id"=>"seccion-preguntas",
                "tipo"=>"una-columna", 
                "alignContenido"=>"texto-centro");
        $objComp->bloque_div_normal($datos);
        ?><?php
        $datos = array(
                        "id"=>"button",// (no necesario)el id que tendra el boton
                        "class"=>"mediano",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                        "value"=>"Traer Preguntas",//(necesario) valor que mostrar el boton
                        "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                        "onclick"=>"enc_traerPreguntas(this);"
                        );      
        $objComp->button_link($datos);
        $objComp->cerrar_bloque_div_normal();
        
        $datos=array("id"=>"bloque-dinamico",
                "tipo"=>"una-columna", 
                "alignContenido"=>"texto-centro");
        $objComp->bloque_div_normal($datos);
        $objComp->cerrar_bloque_div_normal();
        
        $objComp->cerrar_bloque_div_flotante();        
        $objComp->cerrar_form();
        break;
    //****************************************** opcion PROGRAMA ***********************************************///
    case "programa":
        if($rsDatosProgramas->RecordCount()!=0){
             ?><option value="0">Seleccione un programa</option><?php
            foreach($rsDatosProgramas as $programa){
                ?><option value="<?php echo $programa[0];?>"><?php echo ucfirst($programa[1]);?></option><?php
            }
        }else{
            ?><option value="0">Ningun programa para esa sede</option><?php
        }
        break;
    //****************************************** opcion PROGRAMAS y FACULTADES ***********************************///
    case "programasFacultad":
        if(count($datosProgramasFacultades)!=0){
             ?><option value="-1">No aplica<input type="radio" name="tipo" value="-1" checked="on"/></option><?php
            foreach($datosProgramasFacultades as $programa){
                ?><option value="<?php echo $programa[0];?>" onmousedown="enc_seleccionFactorPrograma(this);" ><?php echo ucfirst($programa[1]);?><input type="radio" name="tipo" value="<?php echo $programa['tipo'];?>"/></option><?php
            }
        }else{
            ?><option value="0">Ningun programa o facultad</option><?php
        }
        break;
    case "listaPrcocesos":
        if($datosProgramas->RecordCount()!=0){
        ?><ul><?php
        foreach($datosProgramas as $programa){
            ?><li><input type="checkbox" name="programas[]" value="<?php echo $programa[0];?>"/><?php echo $programa[1];?></li>
            <?php
        }
        ?></ul><?php
        }else{
            ?><h1>No hay programas activos para esa sede.</h1><?php
        }
        break;
    //****************************************** opcion PREGUNTAS ***********************************************///
    case "preguntas":
        ?>
        <div style="margin-top: 0rem; margin-left:-1rem; -moz-column-count:1; -webkit-column-count:1; column-count:1;">
        <input type="hidden" name="grupoInteres" value="<?php echo $idGrupoInteres;?>"/>
        <?php if(isset($idProceso)){
           ?><input type="hidden" name="idProceso" value="<?php echo $idProceso;?>"/>
        <?php
        }
        if((isset($idProceso) && $idEncuesta!=-1) || ($idProceso!=-1 && $idEncuesta!=-1)){
            if($rsDatosPreguntas->RecordCount()!=0){
                $numPregunta=1;
                foreach($rsDatosPreguntas as $pregunta){
                    ?><div style="text-align: left; padding-bottom:1rem;padding-top:1rem; padding-left:1rem; padding-right:1rem;" class="contenedor-pregunta">
                    <input type="hidden" name="idPregunta[]" value="<?php echo $pregunta[0];?>"/>
                    <p style="margin-top:0rem;"><span style="font-weight:bold;"><?php echo "(".$numPregunta.") ";?></span><?php echo $pregunta[1];?></p>
                    <?php
                        $rsDatosRespuestas=$objRespuestas->getDatosRespuestasSolucionEncuesta($pregunta[0]);
                        $identificador='A';
                        foreach($rsDatosRespuestas as $respuesta){
                            ?><p style="margin-left:1.5rem; margin-bottom: 0rem;"><span style="font-weight:bold;"><?php echo "(".$identificador.")";?></span><input type="radio" name="<?php echo "respuesta".$pregunta[0];?>" value="<?php echo $respuesta[0];?>"/><?php 
                                echo $respuesta[1];
                                $identificador++;
                            ?></p><?php
                        }
                    ?>
                    </div><?php 
                    $numPregunta++;  
                }
                ?><br /><?php
                $datos = array(
                        "id"=>"button",// (no necesario)el id que tendra el boton
                        "class"=>"mediano",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                        "value"=>"Enviar",//(necesario) valor que mostrar el boton
                        "icono"=>"box-add", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                        "onclick"=>"enc_enviarEncuestaSolucion(this);"
                        );      
                    $objComp->button_icono($datos);
            }else{
                echo "NO HAY ENCUESTA ACTIVA EN ESTE MOMENTO."; 
                ?><br /><?php
                $datos = array(
                        "id"=>"button",// (no necesario)el id que tendra el boton
                        "class"=>"mediano",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                        "value"=>"Traer Preguntas",//(necesario) valor que mostrar el boton
                        "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                        "onclick"=>"enc_traerPreguntas(this);"
                        );      
                $objComp->button_link($datos);
            }
        }else{
            echo "NO HAY ENCUESTA ACTIVA EN ESTE MOMENTO."; 
            ?><br /><?php
            $datos = array(
                        "id"=>"button",// (no necesario)el id que tendra el boton
                        "class"=>"mediano",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                        "value"=>"Traer Preguntas",//(necesario) valor que mostrar el boton
                        "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                        "onclick"=>"enc_traerPreguntas(this);"
                        );      
            $objComp->button_link($datos);
        }
        ?></div>
        <?php
        break;
}

?>