<?php

$objComponentes=new Elementos();

$datos=array("id"=>"emergente1",// (necesario) id de la ventana
            "titulo"=>"Ventana emergente de prueba", //(no necesario) titulo que tendra la ventana
            "alignTitulo"=>"texto-izquierda",// (no necesario - si no se pone se alinea a la izquierda por defecto) alineacion del titulo
            "ancho"=>"50",//(necesario) ancho en porcentaje que tendra la ventana emergente valores entre 10 y 90
            "alignContenido"=>"texto-centro");// (no necesario - si no se pone se aliena al centro por defeccto) alienacion del contenido
$objComponentes->bloque_div_flotante($datos);

$datos=array("id"=>"form1");// (no-necesario) id del formulario

$objComponentes->cerrar_bloque_div_flotante();

?>