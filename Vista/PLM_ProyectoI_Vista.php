<?php
class ProyectoIView {
    //muestra la información de un proceso, en especifico
    function mostrarInfo($strFacultad, $strPrograma, $strSede, $strDirector, $strAnio)
    {
        
        global $objComponentes;
        $this->elementos();
        
        $datos=array("tipo"=>"bloque una-columna",
                    "titulo"=>utf8_encode("Información"),
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"icon-quill");
        $objComponentes->div_bloque_principal($datos);
        
        ?>
        
        <table >
        <th style="width: 50%;"><?php echo utf8_encode("Facultad"); ?></th>
        <th style="width: 50%;"><?php echo utf8_encode("Programa Académico"); ?></th>
        <th style="width: 50%;">Sede/ Seccional</th>
        <th style="width: 50%;">Nombre del Director/ <?php echo utf8_encode("coordinador académico"); ?></th>
        <th style="width: 50%;"><?php echo utf8_encode("Año"); ?></th>
        <tr>
            <td><?php echo ($strFacultad);?></td>
            <td><?php echo ($strPrograma);?></td>
            <td><?php echo ($strSede);?></td>
            <td><?php echo ($strDirector);?></td>
            <td><?php echo $strAnio;?></td>
        </tr>
        </table>
        
        <?php
        
        $objComponentes->cerrar_div_bloque_principal();
    }
    //muesta mensaje sde advertencia 
    function mensaje($strMensaje)
    {
        
        global $objComponentes;
        $this->elementos();
        
        
        $datos=array("tipo"=>"bloque una-columna",
                    "titulo"=>"MENSAJE DE ADVERTENCIA !!!",
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"icon-quill");
        $objComponentes->div_bloque_principal($datos);
        echo "<br />";
        echo "<br />";
        echo "<h3>";
        echo utf8_encode($strMensaje);
        echo "</h3>";
        $objComponentes->cerrar_div_bloque_principal();
    }
    
    //se establece un objeto a elementos vista principal
    function elementos()
    {
        global $objComponentes;   
        require_once("../Vista/VIS_Elementos_Vista.php");
        $objComponentes=new Elementos();
        
    }
    
    //se imprimen los proyectos de inversión 
    // y se crea una tabla con los datos
    public function Imprimevalor($proyectoi) {
    ?>
        
        
        <br />
        <form id="proyecto_inv" name="proyecto_inv" method="post" >
            <input type="hidden" id="H_opcion" name="H_opcion" value="ver_proyecto" />
     
            <div class="bloque una-columna-centro-medio" style="width:95%"> 
              <div class="titulo-bloque texto-izquierda">
                  <h2 class="icon-quill"><?php echo utf8_encode("Proyecto de Inversión");?></h2>
              </div>
              <br />
              <?php
              if($proyectoi[0][0])
              {
              ?>
                <table border="0" align="center">
                    <tr>
                        <td>
                            <b> Nombre del proyecto </b>
                        </td>
                        <td>
                            <b> Planteamiento del problema </b>
                        </td>
                        <td>
                            <b> Objetivo General </b>
                        </td>
                        <td>
                            <b> Rubro del P.O.A.I </b>
                        </td>
                        <td>
                            <b> Inversion 2015 </b>
                        </td>
                        <td>
                            <b> Inversion 2016 </b>
                        </td>
                        <td>
                            <b> Inversion 2017 </b>
                        </td>
                    </tr>
                            <?php
                            $cont1 = 0;
                            $cont2 = 0;
                            $cont3 = 0;
                            for($i=0; $i<count($proyectoi); $i++)
                            {
                                ?>
                                <tr>
                                <td> <?php echo $proyectoi[$i][0];?> </td>
                                <td> <?php echo $proyectoi[$i][1];?> </td>
                                <td> <?php echo $proyectoi[$i][2];?> </td>
                                <td> <?php echo $proyectoi[$i][3];?> </td>
                                <td> $ <?php echo number_format($proyectoi[$i][4]);?> </td>
                                <td> $ <?php echo number_format($proyectoi[$i][5]);?> </td>
                                <td> $ <?php echo number_format($proyectoi[$i][6]);?> </td>
                                <?php $cont1 = $cont1 + $proyectoi[$i][4];?>
                                <?php $cont2 = $cont2 + $proyectoi[$i][5];?>
                                <?php $cont3 = $cont3 + $proyectoi[$i][6];?>
                                </tr>
                                <?php
                            }
                            ?>
                    <tr>
                        <td>
                            <b> </b>
                        </td>
                        <td>
                            <b> </b>
                        </td>
                        <td>
                            <b> </b>
                        </td>
                        <td>
                            <b> TOTALES </b>
                        </td>
                        <td>
                            <b> <?php echo number_format($cont1);?> </b>
                        </td>
                        <td>
                            <b> <?php echo number_format($cont2);?> </b>
                        </td>
                        <td>
                            <b> <?php echo number_format($cont3);?> </b>
                        </td>
                    </tr>
                     </table>
              <?php
              }
              else
              {
              ?>
                <h3>No hay actividades de mejoramiento!!</h3>
              <?php
              }
              ?>
            </div>
        </form>
        <?php    
    }
 }