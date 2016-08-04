<?php
class Elementos{
    /*----------------------------------------- ---------------------------- */
    function div_bloque_principal($_datos){
        ?><div class="bloque <?php  echo $_datos["tipo"];?>">
          <?php 
          if(isset($_datos["titulo"])){?>
              <div class="titulo-bloque <?php  echo $_datos["alignTitulo"];  ?>">
                  <h2 class="icon-<?php echo $_datos["icono"];?>"><?php  echo utf8_encode($_datos["titulo"]);  ?></h2>
              </div><!--/titulo-bloque-->
          <?php 
          }
          ?>
          <div class="cuerpo-bloque <?php  echo $_datos["alignContenido"]; ?>">
        <?php
    }
    
    function cerrar_div_bloque_principal(){
        ?> 
          </div><!--/cuerpo-bloque-->
        </div><!-- bloque -->  
        <?php
    } //cerrar_div_bloque_principal
    
    function form($_datos){
        if(isset($_datos["id"])){
        ?>  <form id="<?php echo $_datos["id"]; ?>">  <?php
        }else{
        ?>  <form>  <?php
        }
    } //form
    
    function cerrar_form(){
        ?>  </form>  <?php
    } //cerrar_form
    /*--------------------------------------------------------------------------------*/
    function input_hidden($_datos){
        ?>
        <div class="grupo-controles-formulario">
            <div class="controles-formulario">
                <input 
                    type="hidden" 
                    <?php 
                    if(isset($_datos["id"])){?>
                        id="<?php echo $_datos["id"];?>"
                    <?php }?>
                    name="<?php echo $_datos["name"];?>"
                    value="<?php echo $_datos["value"];?>"
                    /><!--input--> 
            </div><!--controles-formulario-->
        </div><!--grupo-controles-formulario-->
        <?php
     }//- input_hidden
     
    function input_text($_datos){
        ?>
        <div class="grupo-controles-formulario">
        <?php
        if(isset($_datos["label"])){
            if(isset($_datos["id"])){
            ?>
            <label for="<?php echo $_datos["id"];?>" class="texto-control-formulario"><?php echo $_datos["label"];?></label>
            <?php
            }else{
            ?>
            <label class="texto-control-formulario"><?php echo $_datos["label"];?></label>
            <?php
            }
        }else{
            if(isset($_datos["id"])){
            ?>
            <label for="<?php echo $_datos["id"];?>" class="texto-control-formulario"></label>
            <?php
            }else{
            ?>
            <label class="texto-control-formulario"></label>
            <?php
            }
        }
        ?>
        <div class="controles-formulario">
        <input type="text" name="<?php echo $_datos["name"];?>" 
        <?php 
        if(isset($_datos["id"])){
        ?>
            id="<?php echo $_datos["id"];?>"
         <?php
         }
         if(isset($_datos["placeholder"])){
            ?>  placeholder="<?php echo $_datos["placeholder"];?>"  <?php
         }
         if(isset($_datos["maxlength"])){
            ?>  maxlength="<?php echo $_datos["maxlength"];?>"  <?php
         }
         if(isset($_datos["value"])){
            ?>  value="<?php echo $_datos["value"];?>"  <?php
         }
         if(isset($_datos["readonly"]) && $_datos["readonly"]=="on"){
            ?>  readonly  <?php
         }
         if(isset($_datos["disabled"]) && $_datos["disabled"]=="on"){
            ?>  disabled  <?php
         }
         if(isset($_datos["required"]) && $_datos["required"]=="on"){
            ?>  required  <?php
         }
         if(isset($_datos["onkeypress"])){
            ?>  onkeypress="<?php $_datos["onkeypress"];?>"  <?php
         }
         if(isset($_datos["onkeydown"])){
            ?>  onkeydown="<?php $_datos["onkeydown"];?>"  <?php
         }
        ?>
        /><!--input--> 
        <?php
         if(isset($_datos["help"]) && $_datos["help"]!=""){
            ?>
            <div class="texto-ayuda texto-izquierda">
            <i class="icon-bubbles4"></i>
            <p><?php echo $_datos["help"];?></p>
            </div><!--texto-ayuda-->
            <?php
         }
        ?>
        </div><!--controles-formulario-->
        </div><!--grupo-controles-formulario-->
        <?php
     }//- input_text
     
    function input_password($_datos){
        ?>
        <div class="grupo-controles-formulario">
        <?php
        if(isset($_datos["label"])){
            if(isset($_datos["id"])){
            ?>
            <label for="<?php echo $_datos["id"];?>" class="texto-control-formulario"><?php echo $_datos["label"];?></label>
            <?php
            }else{
            ?>
            <label class="texto-control-formulario"><?php echo $_datos["label"];?></label>
            <?php
            }
        }else{
            if(isset($_datos["id"])){
            ?>
            <label for="<?php echo $_datos["id"];?>" class="texto-control-formulario"></label>
            <?php
            }else{
            ?>
            <label for="" class="texto-control-formulario"></label>
            <?php
            }
        }
        ?>
        <div class="controles-formulario">
        <input type="password" name="<?php echo $_datos["name"];?>"
         <?php 
        if(isset($_datos["id"])){
        ?>
            id="<?php echo $_datos["id"];?>"
         <?php
         }
         if(isset($_datos["placeholder"])){
            ?>  placeholder="<?php echo $_datos["placeholder"];?>"  <?php
         }
         if(isset($_datos["maxlength"])){
            ?>  maxlength="<?php echo $_datos["maxlength"];?>"  <?php
         }
         if(isset($_datos["disabled"]) && $_datos["disabled"]=="on"){
            ?>  disabled  <?php
         }
         if(isset($_datos["required"]) && $_datos["required"]=="on"){
            ?>  required  <?php
         }
         if(isset($_datos["onkeypress"])){
            ?>  onkeypress="<?php $_datos["onkeypress"];?>"  <?php
         }
         if(isset($_datos["onkeydown"])){
            ?>  onkeydown="<?php $_datos["onkeydown"];?>"  <?php
         }
        ?>
        /><!--input--> 
        <?php
         if(isset($_datos["help"]) && $_datos["help"]!=""){
            ?>
            <div class="texto-ayuda texto-izquierda">
            <i class="icon-bubbles4"></i>
            <p><?php echo $_datos["help"];?></p>
            </div><!--texto-ayuda-->
            <?php
         }
        ?>
        </div><!--controles-formulario-->
        </div><!--grupo-controles-formulario-->
        <?php
     }// input_password
     
    function textarea($_datos){
        ?>
        <div class="grupo-controles-formulario">
        <?php
        if(isset($_datos["label"])){
            if(isset($_datos["id"])){
            ?>
            <label for="<?php echo $_datos["id"];?>" class="texto-control-formulario"><?php echo utf8_encode($_datos["label"]);?></label>
            <?php
            }else{
            ?>
            <label class="texto-control-formulario"><?php echo utf8_encode($_datos["label"]);?></label>
            <?php
            }
        }else{
            if(isset($_datos["id"])){
            ?>
            <label for="<?php echo $_datos["id"];?>" class="texto-control-formulario"></label>
            <?php
            }else{
            ?>
             <label for="" class="texto-control-formulario"></label>
            <?php
            }
        }
        ?>
        <div class="controles-formulario">
        <textarea 
        <?php if(isset($_datos["enviarArray"]) && $_datos["enviarArray"]=="on"){?>
            name="<?php echo $_datos["name"]."[]";?>" 
        <?php
        }else{?>
            name="<?php echo $_datos["name"];?>" 
        <?php
        }
        if(isset($_datos["id"])){ 
        ?>
         id="<?php echo $_datos["id"];?>"
        <?php
         }
         if(isset($_datos["placeholder"])){
            ?>  placeholder="<?php echo utf8_encode($_datos["placeholder"]);?>"  <?php
         }
         if(isset($_datos["maxlength"])){
            ?>  maxlength="<?php echo $_datos["maxlength"];?>"  <?php
         }
         
         if(isset($_datos["readonly"]) && $_datos["readonly"]=="on"){
            ?>  readonly  <?php
         }
         if(isset($_datos["disabled"]) && $_datos["disabled"]=="on"){
            ?>  disabled  <?php
         }
         if(isset($_datos["required"]) && $_datos["required"]=="on"){
            ?>  required  <?php
         }
         if(isset($_datos["onkeypress"])){
            ?>  onkeypress="<?php $_datos["onkeypress"];?>"  <?php
         }
         if(isset($_datos["onkeydown"])){
            ?>  onkeydown="<?php $_datos["onkeydown"];?>"  <?php
         }
        ?>
        ><?php
        if(isset($_datos["value"])){
            echo utf8_encode($_datos["value"]);
        }?></textarea> <!--input--> 
        <?php
         if(isset($_datos["help"]) && $_datos["help"]!=""){
            ?>
            <div class="texto-ayuda texto-izquierda">
            <i class="icon-bubbles4"></i>
            <p><?php echo utf8_encode($_datos["help"]);?></p>
            </div><!--texto-ayuda-->
            <?php
         }
        ?>
        </div><!--controles-formulario-->
        </div><!--grupo-controles-formulario-->
        <?php
     }// textarea
    
    function input_file($_datos){
        ?>
        <div class="grupo-controles-formulario">
        <?php 
        if(isset($_datos["label"])){
            if(isset($_datos["id"])){
            ?>
            <label for="<?php echo $_datos["id"]; ?>" class="texto-control-formulario texto-grupo-radiobutton"><?php echo $_datos["label"];?></label>
            <?php
            }else{
            ?>
            <label for="" class="texto-control-formulario texto-grupo-radiobutton"><?php echo $_datos["label"]; ?></label>
            <?php
            }
        }else{
            if(isset($_datos["id"])){
            ?>
            <label for="<?php echo $_datos["id"];?>" class="texto-control-formulario texto-grupo-radiobutton"></label>
            <?php
            }else{
            ?>
            <label for="" class="texto-control-formulario texto-grupo-radiobutton"></label>
            <?php    
            }
        }
        ?>
            <div class="controles-formulario">
                  <input type="file" name="<?php echo $_datos["name"]; ?>" 
                  <?php
                  if(isset($_datos["id"])){
                  ?>
                   id="<?php echo $_datos['id'];?>"
                  <?php
                  }
                  if(isset($_datos["required"]) && $_datos["required"]=="on"){
                    ?>  required  <?php
                    }
                    ?>
                  />
            </div>  
        </div>
        <?php
    }
    
    function input_checkbox ($_datos_checkbox, $_datos,$_checked=array()){
        ?>
        <div class="grupo-controles-formulario">    
        <?php
        if(isset($_datos["label"])){
            ?>
            <label for="" class="texto-control-formulario texto-grupo-checkbox"><?php echo $_datos["label"];?></label>
            <?php
        }else{
            ?>
            <label for="" class="texto-control-formulario texto-grupo-checkbox"></label>
            <?php
        }
        ?>
        <div class="controles-formulario">
        <?php  foreach(  $_datos_checkbox as $checkbox=>$valor){?>
            
        <div class="checkbox-<?php echo $_datos["class"];?>">
        
        <div class="control-checkbox">
        
        <input type="checkbox" id="<?php echo $checkbox;?>" name="<?php echo $_datos["name"]."[]";?>"
        value="<?php echo $valor;?>"  
         <?php
        $count=count($_checked);
        if($count>0){
            foreach($_checked as $val){
                if($valor==$val){
                    ?>checked<?php
                }
            }
        }
        ?>
        /><!--input--> 
        
        <label for="<?php echo $checkbox;?>" class="checkbox-label"></label>
            
        
        </div><!--control-checkbox-->
        <span class="checkbox-texto"><label for="<?php echo $checkbox; ?>"><?php  echo $checkbox;  ?></label></span>
        </div><!--checkbox-bloque-->
        
        <?php  }  ?>
        
        </div><!--controles-formulario-->
        </div><!--grupo-controles-formulario-->
        <?php
     }//input_checkbox
     
    function input_checkbox_sql ($_datos_checkbox, $_datos,$_checked=array()){
        ?>
        <div class="grupo-controles-formulario"> 
        
        <?php
        if(isset($_datos["label"])){
            ?>
            <label for="" class="texto-control-formulario texto-grupo-checkbox"><?php echo $_datos["label"];?></label>
            <?php
        }else{
            ?>
            <label for="" class="texto-control-formulario texto-grupo-checkbox"></label>
            <?php
        }
        ?>
               
        <div class="controles-formulario">
        <?php  foreach($_datos_checkbox as $fila) {  ?>
            
        <div class="checkbox-<?php echo $_datos["class"];?>">
        
        <div class="control-checkbox">
        
        <input type="checkbox" id="<?php echo $fila[$_datos["mostrar"]];?>" name="<?php echo $_datos["name"]."[]";?>"
        value="<?php echo $fila[$_datos["valor"]];?>" 
        <?php
        $count=count($_checked);
        if($count>0){
            foreach($_checked as $val){
                if($fila[$_datos["valor"]]==$val[0]){
                    ?>checked<?php
                }
            }
        }
        ?>
        /><!--input--> 
        
        <?php
            ?>
            <label for="<?php echo $fila[$_datos["mostrar"]];?>" class="checkbox-label"></label>
            <?php
        ?>
        
        </div><!--control-checkbox-->
        <span class="checkbox-texto"><label for="<?php echo $fila[$_datos["mostrar"]];?>"><?php  echo $fila[$_datos["mostrar"]];?></label></span>
        </div><!--checkbox-bloque-->
        
        <?php //$_datos_checkbox->MoveNext(); 
        }  ?>
        
        </div><!--controles-formulario-->
        </div><!--grupo-controles-formulario-->
        <?php
     }// input_checkbox_sql
     
    function input_radio($_datos_radio, $_datos){
        ?>
        <div class="grupo-controles-formulario">    
        
        <?php
        if(isset($_datos["label"])){
            ?>
            <label for="" class="texto-control-formulario texto-grupo-radiobutton"><?php echo $_datos["label"];?></label>
            <?php
        }else{
            ?>
            <label for="" class="texto-control-formulario texto-grupo-radiobutton"></label>
            <?php
        }
        ?>
             
        <div class="controles-formulario">
        <?php  foreach(  $_datos_radio as $radio=>$valor){  ?>
            
        <div class="radiobutton-<?php echo $_datos["class"];?>">
        
        <div class="control-radiobutton">
        
        <input type="radio" id="<?php echo $radio;?>" name="<?php echo $_datos["name"];?>"
        value="<?php echo $valor;?>"  
        /><!--input--> 
        
        <label for="<?php echo $radio;?>" class="radiobutton-label"></label>
            
        
        </div><!--control-radiobutton-->
        <span class="radiobutton-texto"><label for="<?php echo $radio;?>"><?php  echo $radio;  ?></label></span>
        </div><!--radiobutton-bloque-->
        
        <?php  }  ?>
        
        </div><!--controles-formulario-->
        </div><!--grupo-controles-formulario-->
        <?php
     }
     
    function input_radio_sql ($_datos_radio, $_datos){
        ?>
        <div class="grupo-controles-formulario"> 
        
        <?php
        if(isset($_datos["label"])){
            ?>
            <label for="" class="texto-control-formulario texto-grupo-radiobutton"><?php echo $_datos["label"];?></label>
            <?php
        }else{
            ?>
            <label for="" class="texto-control-formulario texto-grupo-radiobutton"></label>
            <?php
        }
        ?>
               
        <div class="controles-formulario">
        <?php  while(!$_datos_radio->EOF) {  ?>
            
        <div class="<?php echo $_datos["class"];?>">
        
        <div class="control-radiobutton">
        
        <input type="radio" id="<?php echo $_datos_radio->fields[$_datos["mostrar"]].$_datos_radio->fields[$_datos["valor"]];?>" name="<?php echo $_datos["name"];?>"
        value="<?php echo $_datos_radio->fields[$_datos["valor"]];?>" 
        
        /><!--input--> 
        
        <?php
            ?>
            <label for="<?php echo $_datos_radio->fields[$_datos["mostrar"]].$_datos_radio->fields[$_datos["valor"]];?>" class="radiobutton-label"></label>
            <?php
        ?>
        
        </div><!--control-radiobutton-->
        <span class="radiobutton-texto"><label for="<?php echo $_datos_radio->fields[$_datos["mostrar"]];?>"><?php  echo $_datos_radio->fields[$_datos["mostrar"]];?></label></span>
        </div><!--radiobutton-bloque-->
        
        <?php $_datos_radio->MoveNext(); }  ?>
        
        </div><!--controles-formulario-->
        </div><!--grupo-controles-formulario-->
        <?php
     }
     
     function select($_datos_select, $_datos,$_selected=-1){
        ?>
         <div class="grupo-controles-formulario">
            <label for="" class="texto-control-formulario texto-lista-desplegable"><?php echo $_datos["label"]?></label>
            <div class="controles-formulario">
                <select 
                <?php if(isset($_datos["enviarArray"]) && $_datos["enviarArray"]=="on"){?>
                     name="<?php echo $_datos["name"]."[]";?>"
                <?php
                }else{?>
                     name="<?php echo $_datos["name"];?>"
                <?php
                }?>
                onchange="<?php echo $_datos["onchange"]?>"
                <?php
                if(isset($_datos["id"])){
                    ?>
                     id="<?php echo $_datos["id"];?>"
                    <?php
                }
                if(isset($_datos["disable"]) && $_datos["disable"]=="on"){
                    ?>disabled<?php
                }
                ?>
                >
                <option value="0"><?php echo $_datos["textodefault"];?></option>                    
                <?php  foreach(  $_datos_select as $dato=>$valor){  ?>
                    <option value="<?php echo $valor;?>"
                    <?php
                    if($_selected!=-1){
                        if($valor==$_selected){
                            ?>selected<?php
                        }
                    }
                    ?>
                    ><?php echo $dato;?></option>            
                <?php  }   ?>       
                </select>
            </div>  
        </div>
        <?php
    } // select
    
    function select_sql($_select_sql, $_datos){
        ?>
         <div class="grupo-controles-formulario">
            <label for="" class="texto-control-formulario texto-lista-desplegable"><?php echo $_datos["label"]?></label>
            <div class="controles-formulario">
            <select 
                <?php if(isset($_datos["enviarArray"]) && $_datos["enviarArray"]=="on"){?>
                     name="<?php echo $_datos["name"]."[]";?>"
                <?php
                }else{?>
                     name="<?php echo $_datos["name"];?>"
                <?php
                }?>
                onchange="<?php echo $_datos["onchange"]?>" 
                <?php
                if(isset($_datos["id"])){
                ?>
                id="<?php echo $_datos["id"];?>"
                <?php
                }
                ?>
                >
                    <option value="0"><?php echo $_datos["textodefault"];?></option>
                    <?php
                    while(!$_select_sql->EOF) 
                      {
                        ?>
                        <option value="<?php echo $_select_sql->fields[$_datos["valor"]]?>"><?php echo $_select_sql->fields[$_datos["mostrar"]]?></option>            
                        <?php
                        $_select_sql->MoveNext(); 
                      }
                    ?>                
                </select>
            </div>  
        </div>
        <?php
    }//select_sql
    
    function button_link($_datos){
        ?>
       <!-- <div class="grupo-controles-formulario">
            <div class="controles-formulario">-->
                <a class="boton-normal boton-<?php  echo $_datos["class"];?>" 
                    <?php
                    if(isset($_datos["id"])){
                    ?>
                    id="<?php echo $_datos["id"];?>"
                    <?php
                    }
                    if(isset($_datos["onclick"])){
                    ?>  onclick="<?php echo $_datos["onclick"];?>"  <?php
                    }
                    ?>
                    >
                    <i class="icon-<?php  echo $_datos["icono"];?>"></i>
                    <?php  echo $_datos["value"];  ?>
                </a>
           <!-- </div>  
        </div> -->
        <?php
    } //button_link
    
    function button_normal($_datos){
        ?>
        <!--<div class="grupo-controles-formulario">
            <div class="controles-formulario">-->
                <button class="boton-<?php  echo $_datos["class"];?>" 
                    <?php
                    if(isset($_datos["id"])){
                        ?>
                        id="<?php echo $_datos["id"];?>"
                        <?php
                    }
                    if(isset($_datos["reset"]) && $_datos["reset"]=="on"){
                        ?>
                        type="reset"
                        <?php   
                    }else{
                        ?>
                        type="button"
                        <?php  
                    }
                    if(!(isset($_datos["reset"])) || $_datos["reset"]!="on"){
                        if(isset($_datos["onclick"])){
                        ?>  onclick="<?php echo $_datos["onclick"];?>"  <?php
                        }
                    }
                    ?>
                    ><i class="icon-<?php echo $_datos["icono"];?>"></i><?php  echo $_datos["value"];?>
                    </button>
          <!-- </div>  
        </div>--> 
        <?php
    } // button_normal
    
    function button_solo_icono($_datos){
        ?>
                <button class="boton-solo-icono" 
                    <?php
                    if(isset($_datos["id"])){
                        ?>
                        id="<?php echo $_datos["id"];?>"
                        <?php
                    }
                    if(isset($_datos["reset"]) && $_datos["reset"]=="on"){
                        ?>
                        type="reset"
                        <?php   
                    }else{
                        ?>
                        type="button"
                        <?php  
                    }
                    if(!(isset($_datos["reset"])) || $_datos["reset"]!="on"){
                        if(isset($_datos["onclick"])){
                        ?>  onclick="<?php echo $_datos["onclick"];?>"<?php
                        }
                    }
                    ?>
                    ><i class="icon-<?php echo $_datos["icono"];?>"></i>
                    </button>
        <?php
    } // button_solo_icono
    
    function button_icono($_datos){
        ?>
        <a class="boton-icono" href="#" 
        <?php
        if(isset($_datos["id"])){
            ?>
            id="<?php echo $_datos["id"]?>"
            <?php
        }
        ?>
        onclick="<?php echo $_datos["onclick"];?>"><i class="icono icon-<?php echo $_datos["icono"];?>"></i><span class="texto-boton"><?php echo $_datos["value"];?></span></a>
    <?php
    }// button_icono
    
    function bloque_div_normal($_datos){
        ?>
        <div id="<?php echo $_datos["id"];?>" class="bloque-normal <?php echo $_datos["tipo"]." ".$_datos["alignContenido"];?>">
        <?php
    }//bloque_div_normal
    
    function cerrar_bloque_div_normal(){
        ?></div><?php
    }// cerrar_bloque_div_normal
    
    function linea_separador($_ancho){
        ?><div class="liena-separador" style="width:<?php echo $_ancho."%"; ?>;"></div><?php
    }// linea_separador
    
    function bloque_div_flotante($_datos){
        if(!isset($_datos["alignTitulo"])){
            $_datos["alignTitulo"]="texto-izquierda";
        }
        if(!isset($_datos["alignContenido"])){
            $_datos["alignContenido"]="texto-centro";
        }
        ?>
        <div class="div-flotante-fondo" id="<?php echo $_datos["id"];?>"> 
           <div class="bloque-cerrar" style="background-color:red;
                    display:block;
                width:<?php 
              if($_datos["ancho"]=="auto"){
                        echo "auto";
                    }else{
                        echo $_datos["ancho"]."%";
                    }?>;
                    margin:<?php echo $_datos["des"]."%";?> auto;">
           <a href="#" class="cerrar" onclick="cerrar_div_flotante(this);">X</a>
           </div>
          <div class="ventana <?php echo $_datos["alignTitulo"];?>" 
          style="width:<?php 
              if($_datos["ancho"]=="auto"){
                        echo "auto";
                    }else{
                        echo $_datos["ancho"]."%";
                    }
              ?>; 
                height:<?php 
                if($_datos["alto"]=="auto"){
                    echo "auto";
                }else{
                    echo $_datos["alto"]."%";
                }
                ?>;
                overflow-x:hidden;
                overflow-y:auto;
                margin:<?php echo $_datos["des"]."%";?> auto;">
           
            <div class="contenido <?php echo $_datos["alignContenido"];?>">
        <?php
    }// bloque_div_flotante
    
    function cerrar_bloque_div_flotante(){
        ?>
        </div><!-- contenido -->
        <div style="clear: both;"></div>
        </div> <!-- ventana -->
        </div> <!-- div-flotante-fondo -->
        <?php
    }// cerrar_bloque_div_flotante
    
    
}

?>