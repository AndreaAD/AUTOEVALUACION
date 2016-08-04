<?php
class ModPlanView
{
    //se meustra una lista de planes de mejoramiento para luego ser modificados
    public function buscaPlan($plan)
    {
        ?>
        <br />
        <br />
        <form id="buscar_plan" name="buscar_plan" method="post" >
            <input type="hidden" id="H_opcion" name="H_opcion" value="ver_plan" />
            
            <div class="bloque una-columna-centro-medio" style="width:70%">
              <div class="titulo-bloque texto-izquierda">
                  <h2 class="icon-quill">Modificar Actividad de mejoramiento</h2>
              </div>
              <br />
              <?php
              if($plan[0][0])
              {
              
              ?>
                <table border="0" align="center">
                     <tr>
                        <td>
                            <label>Actividad</label>   
                        </td>
                        <td>
                            <select name="S_plan">
                            <?php
                            for($i=0; $i<count($plan); $i++)
                            {
                                ?>
                                <option value="<?php echo $plan[$i][0];?>"> <?php echo $plan[$i][7];?> </option>
                                <?php
                            }
                            ?>
                            </select>
                        </td>
                     </tr>
                     <tr>
                        <td>
                            <input type="button" value="Buscar" id="B_buscar" onclick="busca2();" />
                        </td>
                     </tr>
                </table>
              <?php
              }
              else
              {
              ?>
                <h3>No hay actividades de mejoramiento creadas!</h3>
              <?php
              }
              ?>
            </div>
        </form>
        <?php    
    }
    
    
    // des pues de seleccionar un plan de mejoramiento se procede a modificarlos
    public function imprime($arrPlan, $ambitos, $areas, $rubros)
    {
        
    ?>
          
    <form id="guardar_plan2" name="guardar" method="post">
        <input type="hidden" id="H_opcion" name="H_opcion" value="modificar_plan"  />
          <div class="bloque una-columna-centro-medio" style="width:95%"> 
              <div class="titulo-bloque texto-izquierda">
                  <!--</a><h2 class="icon-quill">Proyecto de Inversión</h2>--!>
              </div>
              <br />
                <table border="0" align="center">
                    <tr>
                        <td>
                            <b> Facultad </b>
                        </td>
                        <td>
                            <b> Programa </b>
                        </td>
                        <td>
                            <b> Sede </b>
                        </td>
                        <td>
                            <b> Nombre de Director </b>
                        </td>
                        <td>
                            <b> Fecha </b>
                        </td>
                    </tr>
                        <tr>
                            <td> <?php echo utf8_encode("Ingeniería");?> </td>
                            <td> <?php echo "Sistemas";?> </td>
                            <td> <?php echo "Facatativá";?></td>
                            <td> <?php echo "Jaime Parra";?> </td>
                            <td> <?php echo "2010-01-01";?> </td>
                        </tr>
                     </table>
            </div>
        <br /> 
        <div class="bloque una-columna-centro-medio">
          <div class="titulo-bloque texto-izquierda">
              <h2 class="icon-quill">Modificar Actividad de mejoramiento</h2>
          </div>
          <br />
        <table border="0" align="center"> 
            <?php
            
            if($arrPlan[0][0])
            {
            ?>
             <tr>         
                <td>
                    <label>Código</label>   
                </td>
                <td>
                    <input type="hidden" id="T_codigo" name="T_codigo" value="<?php echo $arrPlan[0][0];?>"  size="30" /><?php echo $arrPlan[0][0];?>
                </td>
             </tr>
             <tr>         
                <td>
                    <label>Caracteristica</label>   
                </td>
                <td>
                    <input type="hidden" id="T_caracteristica" name="T_caracteristica" value="<?php echo $arrPlan[0][0];?>"  size="30" /><?php echo $arrPlan[0][1];?>
                </td>
             </tr>
             <tr>
                <td>
                    <label>Calificación</label>
                </td>
                <td>
                    <input type="hidden" id="T_calificacion" name="T_calificacion" value="<?php echo $arrPlan[0][2];?>"  size="30" /><?php echo $arrPlan[0][2];?>
                </td>
             </tr>
             <tr>
                <td>
                    <label>Ámbito</label> 
                </td>
                <td>
                    <select name="S_ambito"  style= "width: 200px;">
                        <?php
                        
                            
                        for($i=0; $i<count($ambitos); $i++)
                        {
                           /* if($arrPlan[0][3]!=$ambitos[$i][1])
                            {*/
                                ?>
                                <option value="<?php echo $ambitos[$i][0];?>"> <?php echo $ambitos[$i][1];?> </option>
                                <?php
                            /*}
                            else
                            {   
                                ?>
                                    <option value="<?php echo $ambitos[$i][0];?>"> <?php echo $arrPlan[0][3];?> </option>
                                <?php
                            }*/
                        }
                        
                        ?>
                    </select>
                </td>
             </tr>
             <tr>         
                <td>
                    <label>Fortalezas</label>   
                </td>
                <td>
                    <input type="hidden" id="T_fortalezas" name="T_fortalezas" value="<?php echo $arrPlan[0][4];?>"  size="30" /><?php echo $arrPlan[0][4];?>
                </td>
             </tr>
             <tr>
                <td>
                    <label>Debilidades</label> 
                </td>
                <td>
                    <input type="hidden" id="T_debilidades" name="T_debilidades" value="<?php echo $arrPlan[0][5];?>"  size="30" /><?php echo $arrPlan[0][5];?>
                </td>
             </tr>
             <tr>
                <td>
                    <label>Causas</label>
                </td>
                <td>
                    <input type="hidden" id="T_causas" name="T_causas" value="<?php echo $arrPlan[0][6];?>"  size="30" /><?php echo $arrPlan[0][6];?>
                </td>
             </tr>
             <tr>
                <td>
                    <label>Proyecto</label> 
                </td>
                <td>
                    <input type="text" id="T_proyecto" name="T_proyecto" value="<?php echo $arrPlan[0][7];?>"  size="30" />
                </td>
             </tr>
             <tr>         
                <td>
                    <label>Área</label>   
                </td>
                <td>
                    <select name="S_area" style= "width: 200px;">
                        <?php
                        for($i=0; $i<count($areas); $i++)
                        {
                            ?>
                            <option value="<?php echo $areas[$i][0];?>"> <?php echo $areas[$i][1];?> </option>
                            <?php
                        }
                        ?>
                    </select>
                </td>
             </tr>
             <tr>
                <td>
                    <label>Fecha Inicial</label> 
                </td>
                <td>
                    <input type="text" id="T_fechaini" name="T_fechaini" value="<?php echo $arrPlan[0][9];?>"  size="30" />
                </td>
             </tr>
             <tr>
                <td>
                    <label>Fecha Final</label>
                </td>
                <td>
                    <input type="text" id="T_fechafin" name="T_fechafin" value="<?php echo $arrPlan[0][10];?>"  size="30" />
                </td>
             </tr>
             <tr>
                <td>
                    <label>Recursos adicionales</label> 
                </td>
                <td>
                    <select name="S_recurso" style= "width: 200px;">
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                    </select>
                </td>
             </tr>
             <tr>         
                <td>
                    <label>Valor</label>   
                </td>
                <td>
                    <input type="text" id="T_valor" name="T_valor" value="<?php echo $arrPlan[0][12];?>"  size="30" />
                </td>
             </tr>
             <tr>
                <td>
                    <label>Rubro</label> 
                </td>
                <td>
                    <select name="S_rubro" style= "width: 200px;">
                        <?php
                        for($i=0; $i<count($rubros); $i++)
                        {
                            ?>
                            <option value="<?php echo $rubros[$i][0];?>"> <?php echo $rubros[$i][1];?> </option>
                            <?php
                        }
                        ?>
                    </select>
                </td>
             </tr>
             <tr>
                <td>
                    <input type="button" value="Modificar" id="B_guardar" onclick="modplan();" />
                </td>
                <td>
                    <input type="button" value="Atrás" id="B_atras_plan" onclick="js_atras_plan();" />
                </td>
             </tr>
             <?php
              }
                 else
                {
                    ?>
                    <tr>
                        <td>La actividad NO se encuentra</td>
                    </tr>
                    <?php
                }
            ?>
        </table>
        </div>
    </form>
    <?php
    }
    }
    
    ?>