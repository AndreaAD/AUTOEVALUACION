<?php 
    //$var1 = escapeshellcmd($v1);
    //$var2 = escapeshellcmd($v2); //...y as� con cuanta variable m�s le queramos pasar
    $orden = system( "php prueba.php >>out.txt 2>>error.txt &" );
?>