<style type="text/css">
    .contenedor{
        border:1px dashed black;
        padding-bottom:1rem;
        margin-bottom:1rem;
    }
    .contenedor h1{
        font-weight: 400;
    }
</style>
<?php if($faseProceso!=4){
    ?>
    <div class="aletra-fase">
    <p>Este proceso se encuentra fuera de la fase de 'captura de datos', no podra exportar encuestas sino hasta esa fase.</p>
    </div>
<?php }
$datos=array("tipo"=>"una-columna-centro",
            "titulo"=>"EXPORTAR ENCUESTA",
            "alignTitulo"=>"texto-izquierda",
            "alignContenido"=>"texto-centro",
            "icono"=>"pencil2"); 
$objComp->div_bloque_principal($datos);
foreach($rsGruposInteres as $grupo){
    ?>
    <div class="contenedor">
        <h1><?php echo strtoupper($grupo['nombre']);?></h1>
        <div>
            <?php $datos = array(
                    "class"=>"mediano",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                    "value"=>"Exportar a PDF",//(necesario) valor que mostrar el boton
                    "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                    "onclick"=>"enc_exportarEncuestaPdf(".$grupo['pk_grupo_interes'].",".$idProceso.");"// (necesario) funcion js que se ejecutara si se hace click en el boton
                    );
                if($faseProceso==4){
                    $objComp->button_link($datos);
                }
            /*$datos = array(
                    "class"=>"mediano",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                    "value"=>"Exportar a EXCEL",//(necesario) valor que mostrar el boton
                    "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                    "onclick"=>"enc_exportarEncuestaExel(".$grupo['pk_grupo_interes'].",".$idProceso.");"// (necesario) funcion js que se ejecutara si se hace click en el boton
                    );
            $objComp->button_link($datos);*/ ?>
        </div>
    </div>
    <?php
}
$objComp->cerrar_div_bloque_principal();

?>