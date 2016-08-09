<?php
class Elementos{
    /*----------------------------------------- ---------------------------- */
    function div_bloque_principal($_datos){
        ?><div class="bloque <?php  echo $_datos["tipo"];?>">
          <?php 
          if(isset($_datos["titulo"])){?>
              <div class="titulo-bloque <?php  echo $_datos["alignTitulo"];  ?>">
                  <h2 class="icon-<?php echo $_datos["icono"];?>"><?php  echo $_datos["titulo"];  ?></h2>
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
        ?>  <form id="<?php echo $_datos["id"]; ?>" >  <?php
        }else{
        ?>  <form>  <?php
        }
    } //form
    
    function formFile($_datos){
        if(isset($_datos["id"])){
        ?>  <form id="<?php echo $_datos["id"]; ?>" enctype="multipart/form-data">  <?php
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
        <div>
            <input type="hidden" 
                id="<?php echo $_datos["id"];?>"
                name="<?php echo $_datos["name"];?>"
                value="<?php echo $_datos["value"];?>"
            /><!--input--> 
        </div><!--controles-formulario-->
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
                    ?>  onkeypress="<?php echo $_datos["onkeypress"];?>"  <?php
                 }
                 if(isset($_datos["onkeydown"])){
                    ?>  onkeydown="<?php echo $_datos["onkeydown"];?>"  <?php
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
                if(isset($_datos["obligatorio"])){
                    ?>
                    <p id="<?php echo $_datos["obligatorio"];?>" style="color: red;"></p>
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
         if(isset($_datos["required"]) && $_datos["required"]=="on"){
            ?>  required  <?php
         }
         if(isset($_datos["disabled"]) && $_datos["disabled"]=="on"){
            ?>  disabled   <?php
         }
         if(isset($_datos["onkeypress"])){
            ?>  onkeypress="<?php echo $_datos["onkeypress"];?>"  <?php
         }
         if(isset($_datos["onkeydown"])){
            ?>  onkeydown="<?php echo $_datos["onkeydown"];?>"  <?php
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
         if(isset($_datos["obligatorio"])){
            ?>
            <p id="<?php echo $_datos["obligatorio"];?>" style="color: red;"></p>
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
        <textarea name="<?php echo $_datos["name"];?>" 
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
        ?>><?php           
         if(isset($_datos["value"])){
            echo $_datos["value"];
         } 
         ?></textarea> <!--input--> 
        <?php
         if(isset($_datos["help"]) && $_datos["help"]!=""){
            ?>
            <div class="texto-ayuda texto-izquierda">
            <i class="icon-bubbles4"></i>
            <p><?php echo $_datos["help"];?></p>
            </div><!--texto-ayuda-->
            <?php
         }
         if(isset($_datos["obligatorio"])){
            ?>
            <p id="<?php echo $_datos["obligatorio"];?>" style="color: red;"></p>
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
     
    function input_checkbox ($_datos_checkbox, $_datos){
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
        
        <input type="checkbox" id="<?php echo $checkbox;?>" name="<?php echo $_datos["name"];?>"
        value="<?php echo $valor;?>"  
        /><!--input--> 
        
        <label for="<?php echo $checkbox;?>" class="checkbox-label"></label>
            
        <?php  }  ?>
        
        </div><!--controles-formulario-->
        </div><!--grupo-controles-formulario-->
        <?php
     }//input_checkbox
     
    function input_checkbox_sql ($_datos_checkbox, $_datos){
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
        <?php  while(!$_datos_checkbox->EOF) {  ?>
            
        <div class="checkbox-<?php echo $_datos["class"];?>">
        
        <div class="control-checkbox">
        
        <input type="checkbox" id="<?php echo $_datos_checkbox->fields[$_datos["mostrar"]];?>" name="<?php echo $_datos["name"];?>"
        value="<?php echo $_datos_checkbox->fields[$_datos["valor"]];?>"         
        <?php
        if($_datos['Checked'] == "on"){
            foreach($_datos['CheckedValor'] as $elemento=>$valor){ 
                if($valor['pk_tipo_usuario'] == $_datos_checkbox->fields[$_datos["valor"]] ){
                    echo 'checked';
                } 
            }
        }
        if(isset($_datos["readonly"]) && $_datos["readonly"]=="on"){
                    ?>  readonly= "readonly" <?php
                 }
        ?>
        />
        
        <label for="<?php echo $_datos_checkbox->fields[$_datos["mostrar"]];?>" class="checkbox-label"></label>            
        
        </div><!--control-checkbox-->
        <span class="checkbox-texto"><label for="<?php echo $_datos_checkbox->fields[$_datos["mostrar"]];?>"><?php  echo $_datos_checkbox->fields[$_datos["mostrar"]];  ?></label></span>
        </div><!--checkbox-bloque-->
        
        <?php $_datos_checkbox->MoveNext(); }  ?>
        
        </div><!--controles-formulario-->
                <?php
                if(isset($_datos["obligatorio"])){
                    ?>
                    <p id="<?php echo $_datos["obligatorio"];?>" style="color: red;"></p>
                    <?php
                }
                ?> 
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
            <!--<span class="radiobutton-texto"><label for="<?php //echo $radio;?>"><?php // echo $radio;  ?></label></span>-->
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
        
        <input type="radio" id="<?php echo $_datos_radio->fields[$_datos["mostrar"]];?>" name="<?php echo $_datos["name"];?>"
        value="<?php echo $_datos_radio->fields[$_datos["valor"]];?>" 
        
        /><!--input--> 
        
        <?php
            ?>
            <label for="<?php echo $_datos_radio->fields[$_datos["mostrar"]];?>" class="radiobutton-label"></label>
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
     
     function select($_datos_select, $_datos){
        ?>
         <div class="grupo-controles-formulario">
            <label for="" class="texto-control-formulario texto-lista-desplegable"><?php echo $_datos["label"]?></label>
            <div class="controles-formulario">
                <select name="<?php echo $_datos["name"];?>" 
                <?php
                if(isset($_datos["id"])){
                    ?>
                     id="<?php echo $_datos["id"];?>"
                    <?php
                }
                ?>
                >
                <option value="0"><?php echo $_datos["name"];?></option>                    
                <?php  foreach(  $_datos_select as $dato=>$valor){  ?>
                    <option value="<?php echo $valor;?>"><?php echo $dato;?></option>            
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
                <select name="<?php echo $_datos["name"];?>" 
                <?php
                if(isset($_datos["disable"]) && $_datos["disable"] == "on"){
                ?>
                disabled
                <?php
                }
                ?>
                <?php
                if(isset($_datos["onchange"])){
                ?>
                onchange="<?php echo $_datos["onchange"];?>"
                <?php
                }
                ?>
                <?php
                if(isset($_datos["id"])){
                ?>
                id="<?php echo $_datos["id"];?>"
                <?php
                }
                ?>
                >
                <option value="0">sin seleccionar</option>
                    <?php
                    while(!$_select_sql->EOF) 
                      {
                        ?>
                        <option style='max-width:250px;' value="<?php echo $_select_sql->fields[$_datos["valor"]]?>"
                        <?php
                        if(isset($_datos["selected"]) && $_datos["selected"] == $_select_sql->fields[$_datos["valor"]]){
                        ?>
                        selected="selected"
                        <?php
                        }
                        ?>
                        ><?php echo $_select_sql->fields[$_datos["mostrar"]]?></option>            
                        <?php
                        $_select_sql->MoveNext(); 
                      }
                    ?>                
                </select>
            </div> 
                <?php
                if(isset($_datos["obligatorio"])){
                    ?>
                    <p id="<?php echo $_datos["obligatorio"];?>" style="color: red;"></p>
                    <?php
                }
                ?> 
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
                    >
                    <?php
                    if(isset($_datos["icono"])){
                        ?>
                        <i class="icon-<?php echo $_datos["icono"];?>"></i>
                        <?php
                    }
                    ?>
                    <?php  echo $_datos["value"];?>
                    </button>
          <!-- </div>  
        </div>--> 
        <?php
    } // button_normal
    
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
        <div id="<?php echo $_datos["id"];?>" class="<?php echo $_datos["tipo"]." ".$_datos["alignContenido"];?>">
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
   
    /******************************************************************************************************************/
    
    /******************************************************************************************************************/    
    /*********************** Elementos de inicio de sesion, restaurar contrase�a, cambiar contrase�a ******************/
    function div_flotante_session($_Datos){
        ?>
        <div class="<?php echo $_Datos['id']; ?>">
            <div class="principal_session">
                
                <?php
                if(isset($_Datos['form'])){
                ?>
                
                    <form id="<?php echo $_Datos['id_form']; ?>" 
                        method="post" 
                        action="<?php echo $_Datos['action_form']; ?>">
                
                <?php
                }
                ?>
                
                <section class="sesion-titulo-prueba">         
                        
                        <?php
                        if(isset($_Datos['separacion_titulo'])){
                            for($i=0; $i<$_Datos['separacion_titulo']; $i++){
                                ?>
                                <br />
                                <?php
                            }
                        }
                        ?>
                        
                        <div>
                            <h1><?php echo $_Datos['titulo']; ?></h1>
                        </div>
        <?php
    }
    
    function cerar_form_flotante_session(){
        ?>
        </form>
        <?php
    }
    
    function cerrar_div_flotante_session(){
        ?>
                </section>
            </div>
        </div>
        <?php
    }
    
    function input_text_sesion($_Datos){
        ?>
        <div>
        <input type="text"
            id="<?php echo $_Datos['id']; ?>" 
            name="<?php echo $_Datos['name']; ?>"              
            placeholder="<?php echo $_Datos['placeholder']; ?>" 
            <?php
            if(isset($_Datos['required'])){
                ?>
                required
                <?php
            }
            ?>
        />
        </div>
        <?php
    }
    
    function input_password_sesion($_Datos){
        ?>
        <div>
        <input type="password" 
            id="<?php echo $_Datos['id']; ?>" 
            name="<?php echo $_Datos['name']; ?>"              
            placeholder="<?php echo $_Datos['placeholder']; ?>" 
            <?php
            if(isset($_Datos['required'])){
                ?>
                required
                <?php
            }
            ?>
        />
        </div>
        <?php 
    }
    
    function input_submit($_Datos){
        ?>
        <input type="submit" value="<?php echo $_Datos['value']; ?>" />
        <?php
    }
    
    function div_button_normal($_datos){
        ?>
        <div>
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
                >
                <?php
                if(isset($_datos["icono"])){
                    ?>
                    <i class="icon-<?php echo $_datos["icono"];?>"></i>
                    <?php
                }
                ?>
                <?php  echo $_datos["value"];?>
            </button>
        </div> 
        <?php
    } // button_normal
    
    function etiqueta_a($_Datos){
        ?>
        <div>
            <a id="<?php echo $_Datos['id']; ?>" class="<?php echo $_Datos['icono']; ?>" href="#">
                <?php echo $_Datos['value']; ?>
            </a>
        </div>
        <?php
    }
    
    function button_a_herf($_Datos){
        ?>        
        <a href="../Vista/SAD_Generar_Excel_Seguridad.php">Exportar excel</a>
        <?php        
    }
    
    function proceso_radio_scroll(){
        ?>
        <div style="height:50%; overflow-y: scroll; margin: 0 auto;">
            <div class="grupo-controles-formulario"> 
                <div class="controles-formulario">
                    <?php if(isset($_SESSION["array_proceso"])){
                    $array_proceso = $_SESSION["array_proceso"];
                     foreach($array_proceso as $dato){ ?>
                            <div class="radiobutton-bloque">
                                
                                <div class="control-radiobutton">
                                    
                                    <input type="radio" id="<?php echo $dato['nombre_proceso'];?>" name="pk_proceso"
                                    value="<?php echo $dato['pk_proceso'];?>"
                                    <?php if($dato['pk_proceso'] == $_SESSION['pk_proceso']){?>
                                            checked="on"
                                    <?php }?>
                                    /><!--input-->     
                                    <label for="<?php echo $dato['nombre_proceso'];?>" class="radiobutton-label"></label>
                                    
                                </div><!--control-radiobutton-->
                                
                                <span class="radiobutton-texto"><label for="<?php echo $dato['nombre_proceso'];?>"><?php  echo $dato['nombre_proceso'];?></label></span>
                            
                            </div><!--radiobutton-bloque-->
                            
                    <?php }
                    } ?>                    
                </div><!--controles-formulario-->
            </div><!--grupo-controles-formulario-->
        </div>
        <?php
    }
    /******************************************************************************************************************/
    
    /******************************************************************************************************************/    
    /**************************************** Mensaje flotante para los formularios ***********************************/
    function mensaje_flotante($_Datos){
        ?>
        <div class="div-flotante-fondo" id="<?php echo $_Datos["id"];?>">
            <div class="ventana" style="width:<?php echo $_Datos["width"]."%";?>; height:<?php echo $_Datos["height"]."%";?> ; overflow-x:visible; ">
                <a href="#" class="cerrar" onclick="cerrar_div_flotante(this);">X</a>                 
                <div class="contenido">
                    <?php echo $_Datos["mensaje"];?>
                </div>
            </div>
        </div>
        <?php
    }
    
    /******************************************************************************************************************/
    
    /******************************************************************************************************************/    
    /**************************************** Tabla para buscar elementos *********************************************/
    function Buscador($_Datos, $eleTituloTabla, $eleConteTabla, $resSql){
        ?>
        <div>
            <?php
            foreach($_Datos['encabezadoTabla'] as $elemento){
                foreach($elemento as $subElemento=>$subValor){
                    echo '<label>'.$subValor.'</label>';
                    echo '<br/>';
                }
            }
            ?>
        </div>
        
        <div>
            <br />
        </div>
        
        <div>
            <?php
            if(isset($_Datos['select'])){
                if($_Datos['select_estado'] == 'on'){
                ?>
                <label><?php echo $_Datos['select_label'] ?></label>
                <select id="<?php echo $_Datos['select_nombre'] ?>" name="<?php echo $_Datos['select_nombre'] ?>">
                <?php
                while(!$_Datos['select']->EOF){ 
                    ?>
                    <option value="<?php echo $_Datos['select']->fields[$_Datos['select_pk_bd']]; ?>"><?php echo $_Datos['select']->fields[$_Datos['select_nombre_bd']]; ?></option>
                    <?php
                    $_Datos['select']->MoveNext();
                }
                ?>
                </select>
                <?php
                }
            }
            ?>
        </div>
        
        <div>
            <br />
        </div>
        
         <link rel="stylesheet" type="text/css" href="../Complementos/DataTables-1.10.12/media/css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="../Complementos/DataTables-1.10.12/media/js/jquery.dataTables.js"></script>
<table id="lista" class="display" cellspacing="0" width="100%">
    <thead>        
        <tr>
            <?php
            foreach ($eleTituloTabla as $elemento => $valor) {
                echo '<th>' . $valor . '</th>';
            }
            ?>
        </tr>
    </thead>        
    <tbody>
        <?php
        while (!$resSql->EOF) {
            echo '<tr >';

            foreach ($eleConteTabla as $elemento => $valor) {

                if ($elemento == "radio") {
                    echo '<td>&nbsp;&nbsp;';
                    echo '<input type="radio" name="radio" id="radio" value="' . $resSql->fields[$valor] . '"/>';
                    echo '</td>&nbsp;&nbsp;';
                } else if ($elemento == "check") {
                    echo '<td>&nbsp;&nbsp;';
                    echo '<input type="checkbox" name="check[]" id="check[]" value="' . $resSql->fields[$valor] . '"';

                    if (isset($_Datos['filtro_check'])) {
                        foreach ($_Datos['filtro_check'] as $filtro) {
                            if ($filtro == $resSql->fields[$valor]) {
                                echo 'checked';
                            }
                        }
                    }
                    echo '/>';
                    echo '&nbsp;&nbsp;</td>';
                } else if ($elemento == "contenido_1") {
                    echo '<td>&nbsp;&nbsp;' . $resSql->fields[$valor] . '&nbsp;&nbsp;</td>';
                } else if ($elemento == "contenido_2") {
                    echo '<td>&nbsp;&nbsp;' . $resSql->fields[$valor] . '&nbsp;&nbsp;</td>';
                } else if ($elemento == "contenido_3") {
                    echo '<td>&nbsp;&nbsp;' . $resSql->fields[$valor] . '&nbsp;&nbsp;</td>';
                } else if ($elemento == "contenido_4") {
                    echo '<td>&nbsp;&nbsp;' . $resSql->fields[$valor] . '&nbsp;&nbsp;</td>';
                } else if ($elemento == "contenido_5") {
                    echo '<td>&nbsp;&nbsp;' . $resSql->fields[$valor] . '&nbsp;&nbsp;</td>';
                } else if ($elemento == "estado") {
                    if ($resSql->fields[$valor] == "1") {
                        echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;Habilitado&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                    } else {
                        echo '<td>&nbsp;&nbsp;Deshabilitado&nbsp;&nbsp;</td>';
                    }
                } else if ($elemento == "filtro_1") {
                    foreach ($_Datos['filtro'] as $filtro => $valorFiltro) {
                        if ($valorFiltro['identificador'] == $valor) {
                            if ($valorFiltro['pk'] == $resSql->fields[$valor]) {
                                echo '<td >&nbsp;&nbsp;' . $valorFiltro['nombre'] . '&nbsp;&nbsp;</td>';
                            }
                        }
                    }
                } else if ($elemento == "filtro_2") {
                    foreach ($_Datos['filtro'] as $filtro => $valorFiltro) {
                        if ($valorFiltro['identificador'] == $valor) {
                            if ($valorFiltro['pk'] == $resSql->fields[$valor]) {
                                echo '<td >&nbsp;&nbsp;' . $valorFiltro['nombre'] . '&nbsp;&nbsp;</td>';
                            }
                        }
                    }
                } else if ($elemento == "filtro_3") {
                    foreach ($_Datos['filtro'] as $filtro => $valorFiltro) {
                        if ($valorFiltro['identificador'] == $valor) {
                            if ($valorFiltro['pk'] == $resSql->fields[$valor]) {
                                echo '<td >&nbsp;&nbsp;' . $valorFiltro['nombre'] . '&nbsp;&nbsp;</td>';
                            }
                        }
                    }
                } else if ($elemento == "filtro_4") {
                    foreach ($_Datos['filtro'] as $filtro => $valorFiltro) {
                        if ($valorFiltro['identificador'] == $valor) {
                            if ($valorFiltro['pk'] == $resSql->fields[$valor]) {
                                echo '<td >&nbsp;&nbsp;' . $valorFiltro['nombre'] . '&nbsp;&nbsp;</td>';
                            }
                        }
                    }
                } else if ($elemento == "filtro_5") {
                    foreach ($_Datos['filtro'] as $filtro => $valorFiltro) {
                        if ($valorFiltro['identificador'] == $valor) {
                            if ($valorFiltro['pk'] == $resSql->fields[$valor]) {
                                echo '<td >&nbsp;&nbsp;' . $valorFiltro['nombre'] . '&nbsp;&nbsp;</td>';
                            }
                        }
                    }
                } else if ($elemento == "filtro_1_texto_flotante") {
                    foreach ($_Datos['filtro'] as $filtro => $valorFiltro) {
                        if ($valorFiltro['identificador'] == $valor) {
                            if ($valorFiltro['pk'] == $resSql->fields[$valor]) {
                                echo '<td style="cursor: pointer;"><span title="' . $valorFiltro['texto_flotante'] . '">&nbsp;&nbsp;' . $valorFiltro['nombre'] . '&nbsp;&nbsp;</span></td>';
                            }
                        }
                    }
                } else if ($elemento == "filtro_2_texto_flotante") {
                    foreach ($_Datos['filtro'] as $filtro => $valorFiltro) {
                        if ($valorFiltro['identificador'] == $valor) {
                            if ($valorFiltro['pk'] == $resSql->fields[$valor]) {
                                echo '<td style="cursor: pointer;"><span title="' . $valorFiltro['texto_flotante'] . '">&nbsp;&nbsp;' . $valorFiltro['nombre'] . '&nbsp;&nbsp;</span></td>';
                            }
                        }
                    }
                } else if ($elemento == "filtro_3_texto_flotante") {
                    foreach ($_Datos['filtro'] as $filtro => $valorFiltro) {
                        if ($valorFiltro['identificador'] == $valor) {
                            if ($valorFiltro['pk'] == $resSql->fields[$valor]) {
                                echo '<td style="cursor: pointer;"><span title="' . $valorFiltro['texto_flotante'] . '">&nbsp;&nbsp;' . $valorFiltro['nombre'] . '&nbsp;&nbsp;</span></td>';
                            }
                        }
                    }
                } else if ($elemento == "filtro_4_texto_flotante") {
                    foreach ($_Datos['filtro'] as $filtro => $valorFiltro) {
                        if ($valorFiltro['identificador'] == $valor) {
                            if ($valorFiltro['pk'] == $resSql->fields[$valor]) {
                                echo '<td style="cursor: pointer;"><span title="' . $valorFiltro['texto_flotante'] . '">&nbsp;&nbsp;' . $valorFiltro['nombre'] . '&nbsp;&nbsp;</span></td>';
                            }
                        }
                    }
                } else if ($elemento == "filtro_5_texto_flotante") {
                    foreach ($_Datos['filtro'] as $filtro => $valorFiltro) {
                        if ($valorFiltro['identificador'] == $valor) {
                            if ($valorFiltro['pk'] == $resSql->fields[$valor]) {
                                echo '<td style="cursor: pointer;"><span title="' . $valorFiltro['texto_flotante'] . '">&nbsp;&nbsp;' . $valorFiltro['nombre'] . '&nbsp;&nbsp;</span></td>';
                            }
                        }
                    }
                }
            }

            $resSql->MoveNext(); //Nos movemos al siguiente registro
            echo '</tr>';
        }
        ?>      
    </tbody>
</table>
<script>
    $(document).ready(function () {
        $(document).ready(function () {
            $('#lista').DataTable({
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Ultimo",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });
        });
    });
</script>
  
        <div>
            <?php
            if(isset($_Datos["obligatorio"])){
                ?>
                <br />
                <p id="<?php echo $_Datos["obligatorio"];?>" style="color: red;"></p>
                <?php
            }
            ?>
        </div>
        
        <div>
            <br />
        </div>
        
        <div id="num_pag">        
        </div>
        
        <div>
            <br />
        </div>
        
        <?php
    }
    
    /******************************************************************************************************************/
    /******************************************************************************************************************/    
    /**************************************** Tabla para buscar elementos *********************************************/
    function Ponderacion($_Datos, $eleTituloTabla, $eleConteTabla, $resSql){
        ?>
        <div>
            <select name="s_paginador" id="s_paginador" onchange="paginador();" >
                <option value="10"> 10 </option>
                <option value="20"> 20 </option>
            </select>
            
            Buscar : <input name="buscador" id="buscador" type="text" onkeypress="tabla();" />            
        </div>
        <div>
            <br />
        </div>
        <div id="tabla">
            <table id="lista">
                <thead>
                    <tr>
                        <?php
                        foreach($eleTituloTabla as $elemento=>$valor){
                            echo '<th>'.$valor.'</th>';
                        }
                        ?>
                    </tr>
                </thead>    
                <tbody>
                    <?php    
                        
                    while(!$resSql->EOF){ 
                                $ponderacion = $resSql->fields['ponderacion'];                            
                            foreach($eleConteTabla as $elemento=>$valor){
                                if($elemento == "radio"){
                                    echo '<td>';
                                    echo '<input type="radio" name="radio" id="radio" value="'.$resSql->fields[$valor].'"/>';
                                    echo '</td>';
                                }
                                else if($elemento == "check"){
                                    echo '<td>';
                                    echo '<input type="checkbox" name="check[]" id="check[]" value="'.$resSql->fields[$valor].'"';                                    
                                    echo 'checked ';                                            
                                    echo 'style="display:none;" />';
                                    
                                    echo '<input type="checkbox" name="check_vista[]" id="check_vista[]" value="'.$resSql->fields[$valor].'"';                                    
                                    echo 'checked disabled="disabled"';                                            
                                    echo '/>';
                                    echo '</td>';
                                }
                                else if($elemento == "ponderacion"){
                                    echo '<td>';
                                    echo '<input type="text" name="ponderacion'.$resSql->fields[$valor].'" id="ponderacion'.$resSql->fields[$valor].'" value="'.$ponderacion.'"/>';
                                    echo '</td>';
                                }
                                else if($elemento == "letras"){
                                    echo '<td class="letras">'.$resSql->fields[$valor].'</td>';
                                }
                                else if($elemento == "letras2"){
                                    echo '<td class="letras2">'.$resSql->fields[$valor].'</td>';
                                }
                                else if($elemento == "numeros"){
                                    echo '<td class="numeros">'.$resSql->fields[$valor].'</td>';
                                }
                                else if($elemento == "estado"){
                                    if($resSql->fields[$valor] == "1"){
                                        echo '<td>Habilitado</td>';
                                    }
                                    else{
                                        echo '<td>Deshabilitado</td>'; 
                                    }
                                }
                                else if($elemento == "fecha1" || $elemento == "fecha2"){
                                    echo '<td>'.$resSql->fields[$valor].'</td>';
                                }
                                else{
                                    if(isset($_Datos['filtro'])){
                                        $entrada = 0;
                                        foreach($_Datos['filtro'] as $filtro=>$valorFiltro){
                                            if($valorFiltro['identificador'] == $valor){
                                                if($valorFiltro['pk'] == $resSql->fields[$valor]){
                                                    echo '<td >'.$valorFiltro['nombre'].'</td>';
                                                }
                                            }
                                        }
                                                                               
                                    }
                                    else{
                                        echo '<td >'.$resSql->fields[$valor].'</td>';
                                    }
                                }
                            }
                            $resSql->MoveNext(); //Nos movemos al siguiente registro
                        echo '</tr>';
                    }
                    ?>      
                </tbody>    
            </table>
        </div>
        <div>
            <?php
            if(isset($_Datos["obligatorio"])){
                ?>
                <br />
                <p id="<?php echo $_Datos["obligatorio"];?>" style="color: red;"></p>
                <?php
            }
            ?>
        </div>
        
        <div id="num_pag">        
        </div>
        
        <div>
            <br />
        </div>
        <?php
    }
    
    /******************************************************************************************************************/
    
    /**************** visualizacion para la seleccion de los factore, caracteristicas, aspectos ***********************/
    
    function Lista_FCA($datos, $datos_boton){
        ?>
        <div class="grupo-controles-formulario">
            <div style="display:block;margin-left:2.5em;" class="texto-izquierda">
                <label style="font-weight:bold;font-size:1.3em; padding-right:4em;" for="<?php echo $datos["id"];?>"><?php echo utf8_encode($datos["label"]);?></label>
        <?php
        //$this->button_normal($datos_boton);
        $this->button_solo_icono($datos_boton);
        ?>
            </div>
            <div style="display:block;width:100%;text-align:center;margin-top: 0.2em;" class="controles-formulario">
                <textarea style="width:90%;" placeholder="<?php echo $datos["placeholder"];?>" id="<?php echo $datos["id"];?>" readonly="on"><?php
                    /*if($existenDatos){
                        echo utf8_encode($idFactor.". ".$txFactor);
                    }*/
                if(isset($datos["value"])){
                    echo $datos["value"];
                }
                ?></textarea>
            </div>
        </div>
        <?php
    }
    
    /******************************************************************************************************************/
    /**/
    
     function select_url($_datos_select, $_datos){
        ?>
         <div class="grupo-controles-formulario">
            <label for="" class="texto-control-formulario texto-lista-desplegable"><?php echo $_datos["label"]?></label>
            <div class="controles-formulario">
                <select name="<?php echo $_datos["name"];?>" 
                <?php
                if(isset($_datos["disable"]) && $_datos["disable"] == "on"){
                ?>
                disabled
                <?php
                }
                ?>
                <?php
                if(isset($_datos["id"])){
                    ?>
                     id="<?php echo $_datos["id"];?>"
                    <?php
                }
                ?>
                >
                <option value="0"><?php echo $_datos["name"];?></option>                    
                <?php  
                foreach(  $_datos_select as $dato){ 
                    foreach(  $dato as $value=>$mostrar){?>
                        <option value="<?php echo $value;?>"
                        <?php
                        if(isset($_datos["selected"]) && $_datos["selected"] == $value){
                        ?>
                        selected="selected"
                        <?php
                        }
                        ?> 
                        ><?php echo $mostrar;?></option>            
                <?php       
                    }
                }   
                ?>
                      
                </select>
            </div> 
            <?php
                if(isset($_datos["obligatorio"])){
                    ?>
                    <p id="<?php echo $_datos["obligatorio"];?>" style="color: red;"></p>
                    <?php
                }
                ?> 
        </div>
        <?php
    } // select
    
    /******************************************************************************************************************/
    /**/
    function boton_sub_grupo($_datos, $_Boton_sub_Sql){
        
        while(!$_Boton_sub_Sql->EOF) 
        {
            
            ?>            
            <a class="boton-icono" onclick="AbrirSubPagina('<?php echo $_Boton_sub_Sql->fields['url']; ?>','<?php echo $_datos['pk_modulo']; ?>', '<?php echo $_datos['pk_grupo']; ?>', '<?php echo $_Boton_sub_Sql->fields['pk_sub_grupo_actividades']; ?>' );">
            <i class="<?php echo $_Boton_sub_Sql->fields['icono']; ?>"></i>
            <span class="texto-boton"><?php echo $_Boton_sub_Sql->fields['nombre']; ?></span>
            </a>           
            <?php
            $_Boton_sub_Sql->MoveNext(); 
            
        } 
        
    }
    
    function boton_act_grupo($_datos, $_Boton_act_Sql, $_Pag_menu){
         
        while(!$_Boton_act_Sql->EOF) 
        {
            
            ?>
            <a class="boton-icono" onclick="Abrir('<?php echo $_Pag_menu;?>', '<?php echo $_Boton_act_Sql->fields['url'];?>');">
            <i class="<?php echo $_Boton_act_Sql->fields['icono']; ?>"></i>
            <span class="texto-boton"><?php echo $_Boton_act_Sql->fields['nombre']; ?></span>
            </a>
            <?php
            $_Boton_act_Sql->MoveNext(); 
        
        } 
        
    } 
    
    /******************************************************************************************************************/
      
    /**/  
    function iconos($datos, $filtro){
        ?>
        <div class="grupo-controles-formulario">    
        
        <?php
            ?>
            <label for="" class="texto-control-formulario texto-grupo-radiobutton">Icono</label>
            <?php
        ?>
             
        <div class="controles-formulario">
        <?php  foreach ($datos as $nombre=>$valor){  ?>
            
            <div class="radiobutton-bloque">
            
            <div class="control-radiobutton">
            
            <?php
            
            ?>
            <input type="radio" name="icono" id="<?php echo $nombre;?>" value="<?php echo $valor;?>" 
            <?php
            if($valor==$filtro){
                ?>
                checked="on"
                <?php
            }
            ?>
            />
            
            <label for="<?php echo $valor;?>" class="radiobutton-label"></label>
            
            <?php
            
            
            ?>
            </div><!--control-radiobutton-->
            <span class="radiobutton-texto"><label for="<?php echo $nombre;?>">
            <span class="<?php echo $valor;?>"></span></label></span>
            </div><!--radiobutton-bloque-->
    
        <?php  }  ?>
        
        </div><!--controles-formulario-->
        </div><!--grupo-controles-formulario-->
        <?php
    }    
     
    /******************************************************************************************************************/
     
    /**/  
    function ventana_cargando(){
        ?>
        
        <div class="carga" id="carga">
            <h2>Cargando..</h2>
        </div>
        <?php
    }    
     
    /******************************************************************************************************************/
    
    /**/
    
    function select_sql_sub_grupo($_select_sql, $_datos){
        ?>
         <div class="grupo-controles-formulario">
            <label for="" class="texto-control-formulario texto-lista-desplegable"><?php echo $_datos["label"]?></label>
            <div class="controles-formulario">
                <select name="<?php echo $_datos["name"];?>" 
                <?php
                if(isset($_datos["disable"]) && $_datos["disable"] == "on"){
                ?>
                disabled
                <?php
                }
                ?>
                <?php
                if(isset($_datos["onchange"])){
                ?>
                onchange="<?php echo $_datos["onchange"];?>"
                <?php
                }
                ?>
                <?php
                if(isset($_datos["id"])){
                ?>
                id="<?php echo $_datos["id"];?>"
                <?php
                }
                ?>
                >
                <option value="0">sin seleccionar</option>
                <option value="1" selected="selected">Sin Sub Grupo</option>
                    <?php
                    while(!$_select_sql->EOF) 
                      {
                        if($_select_sql->fields[$_datos["valor"]]!='1'){
                            ?>
                            <option style='max-width:250px;' value="<?php echo $_select_sql->fields[$_datos["valor"]]?>"
                            <?php
                            if(isset($_datos["selected"]) && $_datos["selected"] == $_select_sql->fields[$_datos["valor"]]){
                            ?>
                            selected="selected"
                            <?php
                            }
                            ?>
                            ><?php echo $_select_sql->fields[$_datos["mostrar"]]?></option>            
                            <?php
                        }
                        $_select_sql->MoveNext(); 
                      }
                    ?>                
                </select>
            </div> 
                <?php
                if(isset($_datos["obligatorio"])){
                    ?>
                    <p id="<?php echo $_datos["obligatorio"];?>" style="color: red;"></p>
                    <?php
                }
                ?> 
        </div>
        <?php
    }//select_sql
    
    /******************************************************************************************************************/
    
    /**/    
    
    function input_text_calendario($_datos){
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
        
                <input type="text" 
                name="<?php echo $_datos["name"];?>" 
                value="<?php echo date('Y-m-d'); ?>" 
                readonly=""
                <?php 
                if(isset($_datos["id"])){
                    ?> id="<?php echo $_datos["id"];?>" <?php
                }
                if(isset($_datos["placeholder"])){
                    ?>  placeholder="<?php echo $_datos["placeholder"];?>"  <?php
                }
                if(isset($_datos["maxlength"])){
                    ?>  maxlength="<?php echo $_datos["maxlength"];?>"  <?php
                }
                if(isset($_datos["required"]) && $_datos["required"]=="on"){
                    ?>  required  <?php
                }
                if(isset($_datos["disabled"]) && $_datos["disabled"]=="on"){
                    ?>  disabled   <?php
                }
                if(isset($_datos["onkeypress"])){
                    ?>  onkeypress="<?php echo $_datos["onkeypress"];?>"  <?php
                }
                if(isset($_datos["onkeydown"])){
                    ?>  onkeydown="<?php echo $_datos["onkeydown"];?>"  <?php
                }  
                ?>
                /><!--input--> 
                
                <?php
                 /*if(isset($_datos["help"]) && $_datos["help"]!=""){
                    ?>
                    <div class="texto-ayuda texto-izquierda">
                    <i class="icon-bubbles4"></i>
                    <p><?php echo $_datos["help"];?></p>            
                    </div><!--texto-ayuda-->
                    <?php
                 }*/
                if(isset($_datos["obligatorio"])){
                    ?>
                    <p id="<?php echo $_datos["obligatorio"];?>" style="color: red;"></p>
                <div >
                <input type="button" value="Cal" onclick="<?php echo "displayCalendar(document.forms['".$_datos["formulario"]."'].".$_datos["name"];?>,'yyyy-mm-dd',this)"/>
                </div>
                
                    <?php
                }
                ?>
            </div><!--controles-formulario-->
        </div><!--grupo-controles-formulario-->        
        <?php
    }//- input_text
         
    /******************************************************************************************************************/
     
    /**/
    
    function input_checkbox_sql_multi ($_datos_checkbox, $_datos){
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
        <?php  while(!$_datos_checkbox->EOF) {  ?>
            
        <div class="checkbox-<?php echo $_datos["class"];?>">
        
        <div class="control-checkbox">
        
        <input type="checkbox" id="<?php echo $_datos_checkbox->fields[$_datos["mostrar"]];?>" name="<?php echo $_datos["name"];?>"
        value="<?php echo $_datos_checkbox->fields[$_datos["valor"]];?>"         
        <?php
        if($_datos['Checked'] == "on"){
            foreach($_datos['CheckedValor'] as $elemento=>$valor){ 
                if($valor['pk_tipo_usuario'] == $_datos_checkbox->fields[$_datos["valor"]] ){
                    echo 'checked';
                } 
            }
        }        
        if(isset($_datos["onclick"])){
            ?>  onclick="<?php echo $_datos["onclick"];?>"  <?php
        }
        if(isset($_datos["readonly"]) && $_datos["readonly"]=="on"){
                    ?>  readonly= "readonly" <?php
                 }
        ?>
        />
        
        <label for="<?php echo $_datos_checkbox->fields[$_datos["mostrar"]];?>" class="checkbox-label"></label>            
        
        </div><!--control-checkbox-->
        <span class="checkbox-texto"><label for="<?php echo $_datos_checkbox->fields[$_datos["mostrar"]];?>"><?php  echo $_datos_checkbox->fields[$_datos["mostrar"]];  ?></label></span>
        </div><!--checkbox-bloque-->
        
        <?php $_datos_checkbox->MoveNext(); }  ?>
        
        </div><!--controles-formulario-->
                <?php
                if(isset($_datos["obligatorio"])){
                    ?>
                    <p id="<?php echo $_datos["obligatorio"];?>" style="color: red;"></p>
                    <?php
                }
                ?> 
        </div><!--grupo-controles-formulario-->
        <?php
    }// input_checkbox_sql
     
    /******************************************************************************************************************/
    
    function div_programa($_Datos){
        ?>
        <div id="<?php echo $_Datos['id'];?>">
        </div>
        <?php
    }  
    
    function mensaje(){
        
        ?>
        <div><p id="parrafo" style="color: red;">Estado del Correo : </p></div>
        <div><p><br /></p></div>
        <?php
        
    }
    
    function mensaje_dato($_Datos){
        
        ?>
        <div><?php echo $_Datos; ?></div>
        <div><p><br /></p></div>
        <?php
        
    }
    
    function div_br(){
        ?>
        <div><p><br /></p></div>
        <?php
    }
    
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
    
}
?>