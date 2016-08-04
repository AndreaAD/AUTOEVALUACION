<?php
class Util{
    /* Genera un codigo alearotio que se esta usando para identificacion de campos en la base de datos */
    public static function getCodigoAleatorio(){
        $an = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $su = strlen($an) - 1;
        return substr($an, mt_rand(0, $su), 1).
                substr($an, mt_rand(0, $su), 1).
                substr($an, mt_rand(0, $su), 1).
                substr($an, mt_rand(0, $su), 1).
                substr($an, mt_rand(0, $su), 1).
                substr($an, mt_rand(0, $su), 1).
                substr($an, mt_rand(0, $su), 1).
                substr($an, mt_rand(0, $su), 1).
                substr($an, mt_rand(0, $su), 1).
                substr($an, mt_rand(0, $su), 1);
    }
}
?>