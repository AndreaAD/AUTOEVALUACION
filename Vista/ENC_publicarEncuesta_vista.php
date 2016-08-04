<?php
//header('Content-Type: text/html; charset=UTF-8');
$datos=array("tipo"=>"una-columna",
            "titulo"=>"Información basica de encuestas", 
            "alignTitulo"=>"texto-izquierda", 
            "alignContenido"=>"texto-centro", 
            "icono"=>"pencil2"); 
$objComp->div_bloque_principal($datos);
?>
<p>Seleccione un grupo de interes para editar los textos basicos que apareceran como son el titulo, descripci&oacute;n e intrucciones de la encuesta.</p>
 <div style="text-align: left; margin-top:2rem;">
<?php
foreach($rsDatosGrupos as $fila){
?>
  <a class="boton-icono" href="#" 
  onclick="<?php echo "enc_datosPublicar(this,".$fila[0].");";?>"><i class="icono icon-<?php echo "pencil2";?>"></i><span class="texto-boton"><?php echo ucfirst($fila[1]);?></span></a>
  <?php  
  }
?>
</div> 