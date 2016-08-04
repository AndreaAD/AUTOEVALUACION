<style type="text/css">
         .lista-seleccionar{
            /*background-color:#eeeeee;*/
            background-color:#FAFAFA;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            margin:0px;
            border-style:dashed;
            border-width:0px 0px 1px 0px;
            border-color: #000;
            cursor:pointer;
        }
        .lista-seleccionar:first-child{
            border-style:dashed;
            border-width:1px 0px 1px 0px;
            border-color: #000;
        }
        .lista-seleccionar:hover{
            background-color: #bbbbbb;
        }
        .titulo-ventana{
            font-size:1.2rem;
            font-weight: 600;
        }
</style>
<?php
require_once("elementos_vista.php");
$objComp=new Elementos();
$datos=array("id"=>"ventana-factores",// (necesario) id de la ventana
            "titulo"=>"Lista de Factores", //(no necesario) titulo que tendra la ventana
            "alignTitulo"=>"texto-izquierda",// (no necesario - si no se pone se alinea a la izquierda por defecto) alineacion del titulo
            "ancho"=>"80",//(necesario) ancho en porcentaje que tendra la ventana emergente valores entre 10 y 95
            "alto"=>"60",// (necesario) alto en porcentaje que tendra la ventana valor entre 10 y 90
            "alignContenido"=>"texto-centro",// (no necesario - si no se pone se aliena al centro por defeccto) alienacion del contenido
            "des"=>"5" // desplazamiento de la ventana con respecto a la parte superior porcentaje de 0 a 100
            );
$objComp->bloque_div_flotante($datos);
?>
<p class="titulo-ventana">SELECCIONE UN FACTOR</p>
<?php
//$objComp->linea_separador(90);
?>
<ul style="list-style: none; text-align:left;">   
<?php
while(!$rsDatos->EOF)
{
    ?>
    <li class="lista-seleccionar" >
        <input type="hidden" id="id" value="<?php echo $rsDatos->fields[0];?>"/>
        <p id="texto" style="border:0px; margin: 0px; padding:0px;" onclick="enc_seleccionarTabla(this,'ENC_listaFactores_controlador.php','factor','#ventana-factores');"> <?php echo $rsDatos->fields[2].' '.(ucfirst(strtolower($rsDatos->fields[1])));?>
        </p> 
    </li>
    <?php
   $rsDatos->MoveNext(); //Nos movemos al siguiente registro
}
$rsDatos->Close();
?>
</ul>
<?php
$objComp->cerrar_bloque_div_flotante();
?>