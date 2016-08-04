
<?php
           
$objComponentes=new Elementos();
             
    $datos=array("id"=>"formulario");// (no-necesario) id del formulario
    
    $objComponentes->form($datos);
     
    $datos=array("tipo"=>"una-columna-centro-medio",// (necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
                "titulo"=>$strNombreBuscador, // (no necesario) titulo del bloque
                "alignTitulo"=>"texto-izquierda", //  (necesario si se pone titulo) alienacion del titulo {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
                "alignContenido"=>"texto-centro", //(necesario) alineacion del contenido del div
                "icono"=>"pencil2"); // (necesario si se pone titulo) icono que aparece al lado del titulo
                
    $objComponentes->div_bloque_principal($datos);
        
        ///////////////////////////input hidden//////////////////////////////
        $datos=array(
                    "id"=>"pk_usuario", //(no necesario) define el id que tendra el campo
                    "name"=>"pk_usuario", // (necesario) define el name que tendra el campo
                    "value"=>$pk_cabeza);// (necesario) El atributo value especifica el valor de un elemento                        
                    
        $objComponentes->input_hidden($datos);
        ?>
        <p>Buscar : <input name="search_string" id="search_string" type="text" onkeypress="tabla();" /></p>
<br />
<table id="personas">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Edad</th>
            <th>Teléfono</th>
        </tr>
    </thead>    
    <tbody>
        <?php
                while(!$resSql->EOF) //Mientras no estemos al final de RecordSet
                  {
                    echo '<tr>';
                    echo '<td ><input type="checkbox" name="checkbox[]" id="'.$resSql->fields['pk_usuario'].'" 
                                value="'.$resSql->fields['pk_usuario'].'"'; 
                                
                    echo '/></td>';
                    echo '<td class="nombre">'.mb_convert_encoding($resSql->fields['nombre'], "UTF-8").'</td>';
                    echo '<td class="edad">'.mb_convert_encoding($resSql->fields['estado'], "UTF-8").'</td>';
                    echo '</tr>';
                    
                    $resSql->MoveNext(); //Nos movemos al siguiente registro
                  }
                ?>      
    </tbody>    
</table>

        <?php
        ///////////////////////////input hidden//////////////////////////////
        $datos=array(
                    "id"=>"T_Estado", //(no necesario) define el id que tendra el campo
                    "name"=>"T_Estado", // (necesario) define el name que tendra el campo
                    "value"=>"");// (necesario) El atributo value especifica el valor de un elemento                        
                    
        $objComponentes->input_hidden($datos);
        
        /////////////////////////////////input button///////////////////////////////////////////////////        
        $datos = array(
                    "id"=>"seleccionar",//(no necesario) el id que tendra el boton
                    "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                    "value"=>$strNombreBoton,//(necesario) valor que mostrar el boton
                    "onclick"=>$strFuncion// (necesario) funcion js que se ejecutara si se hace click en el boton
                    );
        $objComponentes->button_normal($datos);
        
    $objComponentes->cerrar_div_bloque_principal();

$objComponentes->cerrar_form();

?>