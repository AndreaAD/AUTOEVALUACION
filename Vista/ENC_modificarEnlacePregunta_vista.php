<style type="text/css">
    .titulo-ventana{
        display: block;
        font-size:1.2rem;
        background-color:#007800;
        color:white;
        padding:0.5rem 0 0.5rem 0;
        margin:1rem 0rem 0rem 0rem;
    }
    .bloque-datos{
        text-align: left;
        margin: 0rem 1.2rem 1.2rem 1.2rem;
    }
</style>

<?php
$datos=array("id"=>"ventana-gruposInteres",// (necesario) id de la ventana
            "ancho"=>"80",//(necesario) ancho en porcentaje que tendra la ventana emergente valores entre 10 y 95
            "alto"=>"auto",// (necesario) alto en porcentaje que tendra la ventana valor entre 10 y 90
            "alignContenido"=>"texto-centro",// (no necesario - si no se pone se aliena al centro por defeccto) alienacion del contenido
            "des"=>"5" // desplazamiento de la ventana con respecto a la parte superior porcentaje de 0 a 100
            );
$objComp->bloque_div_flotante($datos);
?>
<h2 class="titulo-ventana">PREGUNTA SELECCIONADA</h2>
<div class="bloque-datos">
<p><?php  echo $rsDatosPreg->fields[1]; ?></p>
<p style="font-weight:600;">Respuestas:</p>
<?php
    $num='A';
    foreach($rsRespuestas as $respuesta){
        ?>
        <p><?php  echo '('.$num.') '.$respuesta[1]; $num++;?></p>
    <?php
    }
    $objComp->form(array("id"=>"datos-grupos"));
    $datos=array(
            "id"=>"hidden", //(no necesario) define el id que tendra el campo
            "name"=>"idPregunta", // (necesario) define el name que tendra el campo
            "value"=>$idPregunta);// (necesario) El atributo value especifica el valor de un elemento        
    $objComp->input_hidden($datos);
    $objComp->linea_separador(90);
    $datos = array(
        "name"=>"gruposInteres",//(necesario) name del grupo al que pertenecen los checkbox
        "label"=>"Grupos de Interes:",//(necesario - si se omite queda como si se pasara vacio)el nombre que se mostrara
        "class"=>"bloque",//(necesario) decir como queremos que se muestre los elementos {lista,bloque}
        "valor"=>"pk_grupo_interes",//(necesario) el valor que tendra cada elemento segun la consulta sql
        "mostrar"=>"nombre"// (necesario) el valor a msotrar de cada elemnto segun la consulta sql
        );
    $objComp->input_checkbox_sql ($rsDatosGrupos,$datos,$rsGruposPregunta);
    $objComp->cerrar_form();
    ?>
    </div>
    <?php
    $datos = array(
        "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
        "value"=>"Guardar Cambios",//(necesario) valor que mostrar el boton
        "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
        "onclick"=>"enc_guardarEnlacePreguntas(this);"// (necesario) funcion js que se ejecutara si se hace click en el boton
        );
    $objComp->button_normal($datos);
    $datos = array(
        "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
        "value"=>"Cancelar",//(necesario) valor que mostrar el boton
        "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
        "onclick"=>"enc_aceptarEmergente(this);"// (necesario) funcion js que se ejecutara si se hace click en el boton
        );
    $objComp->button_normal($datos);
    $objComp->cerrar_bloque_div_flotante();
?>