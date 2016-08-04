<ul>
<?php
//print_r($rsDatos->fields);
foreach($rsDatos as $fila){
    ?>
    <li>
    <input type="hidden" id="id_proceso" value="<?php echo $fila[0];?>"/>
    <a href="#" onclick="enviarProceso(this);">
    <?php
    echo $fila[0].'/'.$fila[1].'/'.$fila[2].'/'.$fila[3].'/'.$fila[4].'/'.$fila[5];  
    ?>
    </a>
    </li>
    <?php
   // $rsDatos->MoveNext(); //Nos movemos al siguiente registro
}
//$rsDatos->Close();
?>
</ul>
<br />
<ul>
<?php
foreach($rsDatos as $fila){
    ?>
    <li>
    <input type="hidden" id="id_proceso" value="<?php echo $fila[0];?>"/>
    <a href="#" onclick="enviarProcesoPublicar(this);">
    <?php
    echo $fila[0].'/'.$fila[1].'/'.$fila[2].'/'.$fila[3].'/'.$fila[4].'/'.$fila[5];  
    ?>
    </a>
    </li>
    <?php
   // $rsDatos->MoveNext(); //Nos movemos al siguiente registro
}
?>
</ul>