<?php
require_once("elementos_vista.php");
$objComp=new Elementos();
$datos=array("id"=>"ventana-evidencias",// (necesario) id de la ventana
            "titulo"=>"Lista de Evidencias", //(no necesario) titulo que tendra la ventana
            "alignTitulo"=>"texto-izquierda",// (no necesario - si no se pone se alinea a la izquierda por defecto) alineacion del titulo
            "ancho"=>"80",//(necesario) ancho en porcentaje que tendra la ventana emergente valores entre 10 y 95
            "alto"=>"60",// (necesario) alto en porcentaje que tendra la ventana valor entre 10 y 90
            "alignContenido"=>"texto-centro",// (no necesario - si no se pone se aliena al centro por defeccto) alienacion del contenido
            "des"=>"5" // desplazamiento de la ventana con respecto a la parte superior porcentaje de 0 a 100
            );
$objComp->bloque_div_flotante($datos);
if($rsDatos!= null){
?>
<p>Seleccione una Caracteristica de la tabla para ver los aspectos asociados.</p>
<?php
$objComp->linea_separador(90);
?>
<div class="contenedor-tabla80">
    <table>
    <th style="width: 10%;">ID</th>
    <th style="width: 75%;">NOMBRE</th>
    <th style="width: 15%;"> </th>
<?php
while(!$rsDatos->EOF) //Mientras no estemos al final de RecordSet
{
    ?><tr>
      <td><?php echo $rsDatos->fields[0];?></td>
      <td id="texto"><?php echo utf8_encode($rsDatos->fields[1]);?></td>
      <td><input type="hidden" id="id" value="<?php echo $rsDatos->fields[0];?>"/><a href="#" onclick="enc_seleccionarTabla(this,'ENC_listaEvidencias_controlador.php','evidencia','#ventana-evidencias');">Seleccionar</a></td>
      </tr>
    <?php
   $rsDatos->MoveNext(); //Nos movemos al siguiente registro
}
$rsDatos->Close();
?>
    </table>
</div>
<?php
}else{
    ?>
    <p>Seleccione primero un aspecto.</p>
    <?php
}
$objComp->cerrar_div_bloque_principal();
?>