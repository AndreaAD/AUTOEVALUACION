<?php 
    //$var1 = escapeshellcmd($v1);
    //$var2 = escapeshellcmd($v2); //...y así con cuanta variable más le queramos pasar
    $orden = system( "php prueba.php >>out.txt 2>>error.txt &" );
?>