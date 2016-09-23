<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Autoevaluacion - Udec</title>
        <!--<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="icon" type="image/ico" href="../imagenes/favicon.ico" />
        <link href="../Css/iconos-style.css" rel="stylesheet" type="text/css"> 
        <link href="../Css/estilo-base.css" rel="stylesheet" type="text/css"> 

        <script src="../Complementos/jquery-ui-1.12.1.custom/external/jquery/jquery.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../Complementos/jquery-ui-1.12.1.custom/jquery-ui.css">
        <script src="../Complementos/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
        <script src="../Js/color_fondo.js" type="text/javascript"></script>  
        <script src="../Js/backgroundControl.js" type="text/javascript"></script> 
        <script src="../Js/plm.js" type="text/javascript"></script> 

        <script src="../Js/SAD_Js.js" type="text/javascript"></script>
        <script src="../Js/Encuestas.js" type="text/javascript"></script>
        <script src="../Js/Chart.js" type="text/javascript"></script>


        <link type="text/css" rel="stylesheet" href="../Css//dhtmlgoodies_calendar.css?random=20051112" media="screen"/>
        <script type="text/javascript" src="../Js/dhtmlgoodies_calendar.js?random=20060118"></script>

        <script type="text/javascript">
            function DiferenciaFechas(formulario, valor) {

                var d1 = new Date(formulario.theDate.value);
                var d2 = new Date(formulario.theDate3.value);

                //Obtiene dia, mes y año  
                var t2 = d2.getTime();
                var t1 = d1.getTime();
                var dias = parseInt((t2 - t1) / (24 * 3600 * 1000));

                formulario.dias.value = dias;
                formulario.total.value = dias * valor;

            }
        </script>

        <style type="text/css">
            .carga{
                display: none;
                position: absolute;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: black;
                opacity: 0.5;
                z-index: 9999;
            }
            .carga h2{
                font-size: 24px;
                color:white;
                margin: 30% 50%;
            }
            .bloque > .titulo-bloque{
                background-color: rgba(0,120,0,1);
            }
            .boton-icono:hover{
                background-color: rgba(0,180,0,1);
            }
            .control-checkbox > input[type="checkbox"]:checked + .checkbox-label{
                background-color:rgba(0,180,0,1); 
            }
            .control-radiobutton > input[type="radio"]:checked + .radiobutton-label{ 
                background-color:rgba(0,180,0,1); 
            }
            input[type="button"],
            input[type="submit"],
            input[type="reset"],
            button[type="reset"],
            button[type="button"],
            button[type="submit"],
            button,
            a.boton-normal{
                background-image: linear-gradient(to top,rgba(0,150,0,1),rgba(0,100,0,1));
            }
            input[type="button"]:hover,
            input[type="submit"]:hover,
            input[type="reset"]:hover,
            button[type="reset"]:hover,
            button[type="button"]:hover,
            button[type="submit"]:hover,
            button:hover,
            a.boton-normal:hover{
                background-image: linear-gradient(to bottom,transparent,transparent);
                /*background-image: linear-gradient(to bottom,rgba(0,180,180,1),rgba(0,250,250,1));*/
                background-color: rgb(0,180,0);
            }
            input[type="button"]:active,
            input[type="submit"]:active,
            input[type="reset"]:active,
            button[type="reset"]:active,
            button[type="button"]:active,
            button[type="submit"]:active,
            button:active,
            a.boton-normal:active{
                /*background-image: linear-gradient(to bottom,transparent,transparent);*/
                box-shadow: inset 0px 2px 2px 1px rgba(0,0,0,0.5);
                background-color: rgb(200,200,200);
                border-radius: 8px;
            }
            button.boton-solo-icono:active{
                box-shadow: inset 0px 2px 2px 1px rgba(0,0,0,0.5);
                background-color: rgb(200,200,200);
                border-radius: 1px;
            }
            .boton-icono{
                border:2px solid rgb(0,180,0);   
            }
            .boton-icono:active{
                background-color:rgb(200,200,200);
            }
            .grupo-controles-formulario .controles-formulario input[type="text"] + .texto-ayuda i:hover,
            .grupo-controles-formulario .controles-formulario input[type="password"] + .texto-ayuda i:hover,
            .grupo-controles-formulario .controles-formulario textarea + .texto-ayuda i:hover{
                background-color:rgb(50,150,50);
            }
            select option:nth-child(2n){
                background-color: rgba(180,180,180,0.6);
                color:rgb(0,0,0);
            }
            table th{
                background-color: rgba(0,120,0,1);
            }
            table tr:nth-child(2n+1){
                background-color: rgba(0,120,0,0.2);
            }
        </style>
    </head> 
    <body>
        <!--div id="fondo-general" class="fondo-general"-->
        <div id="fondo-titulo">
            <div id="fondotriangulos" class="fondo">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <polygon id="poly1" points="" fill="#b8d19c"/>
                <polygon id="poly2" points="" fill="#009045"/>
                <polygon id="poly3" points="" fill="#006b33"/>
                <polygon id="poly4" points="" fill="#b8d19c"/>
                <polygon id="poly5" points="" fill="#07c555"/>
                <polygon id="poly6" points="" fill="#009045"/>
                <polygon id="poly7" points="" fill="#49ad3b"/>
                </svg>
            </div>
            <div id="tramafondo" class="trama">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                   <!--<image id="escudoudec" x="0" y="0" width="200px" height="200px" xlink:href="../imagenes/ESCUDO_UDEC.png">
                     <title>Escudo Udec</title>
                   </image>-->
                </svg>
            </div>
            <div id="titulo-pagina" class="titulo-pagina">
                <img class="udec" alt="Udec" title="Udec" src="../imagenes/ESCUDO_UDEC_ORIGINAL.png"/>
                <h1>SISTEMA DE INFORMACI&Oacute;N DE AUTOEVALUACI&Oacute;N</h1>
                <img class="colombia" alt="Colombia" title="Udec" src="../imagenes/Escudo_de_Colombia.png"/>
            </div>
        </div>
        <!--/fondo-general-->
        <?php $objComponentes = new Elementos(); ?>  
        <!-- ********************************************************************************************* -->
        <!-- ************************************* Iniciar Sesion **************************************** -->
        <?php
        /////////////////////////////////div y form de inicio de sesion///////////////////////////////////////        
        $datos = array(
            "id" => "inicio-sesion-flotante",
            "titulo" => "Inicio de Sesion",
            "form" => "on",
            "id_form" => "formumario_session",
            "action_form" => "../Controlador/VIS_Index_Controlador.php"
        );
        $objComponentes->div_flotante_session($datos);

        /////////////////////////////////Etiqueta a///////////////////////////////////////////////////        
        $datos = array(
            "id" => "Estado_Session",
            "name" => "Estado_Session",
            "value" => "loguearse"
        );
        $objComponentes->input_hidden($datos);

        ///////////////////////////input text//////////////////////////////
        $datos = array(
            "id" => "username",
            "name" => "usuario",
            "placeholder" => "Usuario",
            "required" => "on"
        );

        $objComponentes->input_text_sesion($datos);

        ///////////////////////////input password/////////////////////////
        $datos = array(
            "id" => "password",
            "name" => "clave",
            "placeholder" => "Contrase&ntilde;a",
            "required" => "on"
        );

        $objComponentes->input_password_sesion($datos);

        /////////////////////////////////input submit/////////////////////////////////////////////////// 
        $datos = array(
            "value" => "Inicio Sesion"
        );
        $objComponentes->input_submit($datos);

        /////////////////////////////////input button///////////////////////////////////////////////////        
        $datos = array(
            "id" => "cancelar_cerrar_session",
            "class" => "pequeño",
            "value" => "Cancelar",
            "onclick" => "CancelarDatosLoggin('../Controlador/VIS_Index_Controlador.php');"
        );
        $objComponentes->button_normal($datos);

        /////////////////////////////////Etiqueta a///////////////////////////////////////////////////        
        $datos = array(
            "id" => "restaurar_clave",
            "icono" => "icon-folder-open",
            "value" => "Restaurar Contrase&ntilde;a"
        );
        $objComponentes->etiqueta_a($datos);

        $objComponentes->cerar_form_flotante_session();

        $objComponentes->cerrar_div_flotante_session();
        ?>

        <!-- ********************************************************************************************* -->
        <!-- ************************************** Cerrar Sesion **************************************** -->             
        <?php
        ///////////////////////div de Herramientas cerrar sesion y cambio de clave/////////////////////////////        
        $datos = array(
            "id" => "cerrar-sesion-flotante",
            "titulo" => "Herramientas"
        );
        $objComponentes->div_flotante_session($datos);

        /////////////////////////////////input button///////////////////////////////////////////////////        
        $datos = array(
            "id" => "cambiar_clave", //(no necesario) el id que tendra el boton
            "class" => "small", //(necesario) tamaño del boton puede ser {grande,mediano,small}
            "value" => "Cambiar Contrase&ntilde;a"//(necesario) valor que mostrar el boton
        );
        $objComponentes->div_button_normal($datos);

        /////////////////////////////////input button///////////////////////////////////////////////////        
        $datos = array(
            "id" => "button", //(no necesario) el id que tendra el boton
            "class" => "small", //(necesario) tamaño del boton puede ser {grande,mediano,small}
            "value" => "Cerrar Sesion", //(necesario) valor que mostrar el boton
            "onclick" => "CerrarLoggin('../Controlador/VIS_Cerrar_Session_Controlador.php');"// (necesario) funcion js que se ejecutara si se hace click en el boton
        );
        $objComponentes->div_button_normal($datos);

        /////////////////////////////////input button///////////////////////////////////////////////////        
        $datos = array(
            "id" => "cancelar_cerrar_session", //(no necesario) el id que tendra el boton
            "class" => "small", //(necesario) tamaño del boton puede ser {grande,mediano,small}
            "value" => "Cancelar", //(necesario) valor que mostrar el boton
            "onclick" => "CancelarDatosLoggin('../Controlador/VIS_Index_Controlador.php');"// (necesario) funcion js que se ejecutara si se hace click en el boton
        );
        $objComponentes->div_button_normal($datos);


        $objComponentes->cerrar_div_flotante_session($datos);
        ?>   
        <!-- ********************************************************************************************* -->

        <!-- ********************************************************************************************* -->
        <!-- ******************************* Restaurar Contraseña **************************************** -->
        <?php
        ////////////////////////////////div y form de restaurar contraseña////////////////////////////////////        
        $datos = array(
            "id" => "restaurar-clave-flotante",
            "titulo" => "Restaurar Contrase&ntilde;a",
            "form" => "on",
            "id_form" => "formumario_clave",
            "action_form" => "../Controlador/VIS_Index_Controlador.php",
            "separacion_titulo" => "2"
        );
        $objComponentes->div_flotante_session($datos);

        /////////////////////////////////Etiqueta a///////////////////////////////////////////////////        
        $datos = array(
            "id" => "Estado_Session",
            "name" => "Estado_Session",
            "value" => "restaurarClave"
        );
        $objComponentes->input_hidden($datos);

        ///////////////////////////input text//////////////////////////////
        $datos = array(
            "id" => "username",
            "name" => "correo",
            "placeholder" => "Correo Electronico",
            "required" => "on"
        );

        $objComponentes->input_text_sesion($datos);

        /////////////////////////////////input submit/////////////////////////////////////////////////// 
        $datos = array(
            "value" => "Restaurar Contrase&ntilde;a"
        );
        $objComponentes->input_submit($datos);

        /////////////////////////////////input button///////////////////////////////////////////////////        
        $datos = array(
            "id" => "cancelar_cerrar_session",
            "class" => "pequeño",
            "value" => "Cancelar",
            "onclick" => "CancelarDatosLoggin('../Controlador/VIS_Index_Controlador.php');"
        );
        $objComponentes->button_normal($datos);

        $objComponentes->cerar_form_flotante_session();

        $objComponentes->cerrar_div_flotante_session();
        ?>
        <!-- ********************************************************************************************* -->

        <!-- ********************************************************************************************* -->
        <!-- ********************************* Cambiar Contraseña **************************************** -->
        <?php
        ////////////////////////////////div y form de cambair contraseña//////////////////////////////////////        
        $datos = array(
            "id" => "cambiar-clave-flotante",
            "titulo" => "Cambiar Contrase&ntilde;a",
            "form" => "on",
            "id_form" => "formumario_clave",
            "action_form" => "../Controlador/VIS_Index_Controlador.php"
        );
        $objComponentes->div_flotante_session($datos);

        /////////////////////////////////Etiqueta a///////////////////////////////////////////////////        
        $datos = array(
            "id" => "Estado_Session",
            "name" => "Estado_Session",
            "value" => "modificarClave"
        );
        $objComponentes->input_hidden($datos);

        ///////////////////////////input password/////////////////////////
        $datos = array(
            "id" => "password",
            "name" => "clave_actual",
            "placeholder" => "Contrase&ntilde;a Actual",
            "required" => "on"
        );

        $objComponentes->input_password_sesion($datos);

        ///////////////////////////input password/////////////////////////
        $datos = array(
            "id" => "password",
            "name" => "clave_nueva",
            "placeholder" => "Contrase&ntilde;a Nueva",
            "required" => "on"
        );

        $objComponentes->input_password_sesion($datos);

        ///////////////////////////input password/////////////////////////
        $datos = array(
            "id" => "password",
            "name" => "clave_confirmar",
            "placeholder" => "Confirmar Contrase&ntilde;a",
            "required" => "on"
        );

        $objComponentes->input_password_sesion($datos);
        /////////////////////////////////input submit/////////////////////////////////////////////////// 
        $datos = array(
            "value" => "Cambiar Contrase&ntilde;a"
        );
        $objComponentes->input_submit($datos);

        /////////////////////////////////input button///////////////////////////////////////////////////        
        $datos = array(
            "id" => "cancelar_cerrar_session",
            "class" => "pequeño",
            "value" => "Cancelar",
            "onclick" => "CancelarDatosLoggin('../Controlador/VIS_Index_Controlador.php');"
        );
        $objComponentes->button_normal($datos);

        $objComponentes->cerar_form_flotante_session();

        $objComponentes->cerrar_div_flotante_session();
        ?>
        <!-- ********************************************************************************************* -->
        <!-- ************************************** Cambio de Proceso************************************* -->             
        <?php
        ///////////////////////div de Herramientas cerrar sesion y cambio de clave/////////////////////////////        
        $datos = array(
            "id" => "cambiar-proceso-flotante",
            "titulo" => "Cambio de Proceso",
            "form" => "on",
            "id_form" => "formumario_proceso",
            "action_form" => "../Controlador/VIS_Index_Controlador.php"
        );
        $objComponentes->div_flotante_session($datos);

        /////////////////////////////////Etiqueta a///////////////////////////////////////////////////        
        $datos = array(
            "id" => "Estado_Session",
            "name" => "Estado_Session",
            "value" => "filtrar"
        );
        $objComponentes->input_hidden($datos);

        /////////////////////////////////Radio de los Procesos///////////////////////////////////////////
        $objComponentes->proceso_radio_scroll();

        /////////////////////////////////input submit/////////////////////////////////////////////////// 
        $datos = array(
            "value" => "Cambiar Proceso"
        );
        $objComponentes->input_submit($datos);

        /////////////////////////////////input button///////////////////////////////////////////////////        
        $datos = array(
            "id" => "cancelar_cerrar_session", //(no necesario) el id que tendra el boton
            "class" => "small", //(necesario) tamaño del boton puede ser {grande,mediano,small}
            "value" => "Cancelar", //(necesario) valor que mostrar el boton
            "onclick" => "CancelarDatosLoggin('../Controlador/VIS_Index_Controlador.php');"// (necesario) funcion js que se ejecutara si se hace click en el boton
        );
        $objComponentes->div_button_normal($datos);

        $objComponentes->cerrar_div_flotante_session($datos);
        ?>       
        <!-- ********************************************************************************************* -->

        <!-- ********************************************************************************************* -->
        <!-- ************************** nombre apellido y rol del usuario logueado *********************** -->  
        <!--/fondo-inicio-sesion-flotante-->
        <div class="principal-pagina pos-z-top">
            <div class="barra-menu pos-z-top">

                <div class="datos-usuario">
                    <?php if (isset($_SESSION['pk_usuario'])) { ?>
                        <div class="info-basica">                    
                            <span class="datos-usuario-nombre"><?php echo $_SESSION['nombre_usuario'] ?></span>
                            <span class="datos-usuario-apellido"><?php echo $_SESSION['apellido_usuario'] ?></span>
                            <span class="datos-usuario-rol"><?php echo $_SESSION['nombre_rol'] ?></span>
                            <span class="datos-usuario-rol"><?php echo @$_SESSION['nombre_proceso'] ?></span>    
                            <span class="datos-usuario-rol"><?php echo @$_SESSION['nombre_fase'] ?></span>                
                        </div>
                        <div class="botones-usuario">
                            <ul>
                                <li><a id="cerrar_session" class="icon-switch salir" href="#"></a></li>
                                <li><a id="" class="icon-cog config" href="#"></a></li>
                                <li><a id="cambiar_proceso" class="icon-spinner3 config" href="#"></a></li>
                            </ul>
                        </div>
                    <?php } else {
                        ?>
                        <div class="inicio-sesion-boton">
                            <a id="inicio-flotante" class="" href="#"><i class="icon-enter"></i>Iniciar Sesion</a>
                        </div>
                    <?php } ?>            
                </div>
                <!--/datos-usuario-->
                <div class="menu-modulos">
                    <ul>
                        <?php
                        if (isset($_SESSION['datos_menu'])) {
                            foreach ($_SESSION['datos_menu'] as $i) {
                                echo "<li>";
                                foreach ($i as $clave => $valor) {
                                    if ($clave == "nombre") {
                                        ?>
                                        <div class="modulo-base una-linea-menu"><span><?php echo $valor; ?></span><a class="desplegar-menu icon-minus" href="#"></a><p></p></div><!--/modulo-base-->
                                        <div class="sub-menu-modulo mostrar">
                                            <ul>
                                                <?php
                                            }
                                            if ($clave == "color") {
                                                ?>
                                                <li><input type="hidden" name="color-modulo" id="color-modulo" value="<?php echo $valor; ?>"/></li>
                                                <?php
                                            }
                                            if ($clave == "pk_modulo") {
                                                $pk_modulo = $valor;
                                            }
                                            if ($clave == "opciones") {
                                                foreach ($valor as $opcion) {
                                                    $texto = $opcion["nombre"];
                                                    $url = $opcion["url"];
                                                    $id = $opcion["id"];
                                                    $icono = $opcion["icono"];
                                                    $pk_grupo = $opcion["pk_grupo"];
                                                    $pk_sub_grupo = "1";
                                                    ?>
                                                    <li><a id="<?php echo $id; ?>" href="<?php echo $url . "?pk_modulo=" . $pk_modulo . "&pk_grupo=" . $pk_grupo . "&pk_sub_grupo=" . $pk_sub_grupo; ?>" onclick="AbrirPagina('<?php echo $url; ?>', '<?php echo $pk_modulo; ?>', '<?php echo $pk_grupo; ?>', '<?php echo $pk_sub_grupo; ?>');"><?php echo $texto; ?></a></li>
                                                    <?php
                                                }
                                            }
                                        }
                                        echo "</ul>";
                                        echo "</div>";
                                        echo "</li>";
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <!--/menu-modulos-->
                </div>
                <!--/barra-menu-->
                <!--<div class="barra-navegacion pos-z-top">
                  <ul>
                    <li><a id="inicio-flotante" class="icon-key2 sesion" href="#">Iniciar Sesion</a></li>
                    <li><a class="icon-folder-open" class="icon-pencil2" href="#">Configuracion</a></li>
                    <li><a class="icon-home salir" href="#">Salir</a></li>
                  </ul>
                </div>-->
                <!--/barra-navegacion-->
                <div class="panel-contenido pos-z-top">


                    <!--<div class="principal-panel-contenido texto-centro" style="overflow-x:auto; overflow-y:visible;">-->
                    <div class="principal-panel-contenido texto-izquierda" style="overflow-x:visible; overflow-y:visible;">
                        <div id="ventana_sub_contenido"></div>
                        <?php if (isset($_SESSION['pk_usuario'])) {
                            ?>
                            <div class="cuerpo-bloque texto-centro">

                            </div>

                            <?php
                            require_once("../Vista/VIS_Navegador_Index.php");
                        } else {
                            ?>
                            <!--===========AQUI INFORMACION=================-->
                            <div style="margin-top: 50px; margin-left: 50px;"> <h1 style="font-size:25px; color:#005425; text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;">AUTOEVALUACI&Oacute;N Y ACREDITACI&Oacute;N</h1>


                                <p>La Universidad de Cundinamarca  presenta  bajo los esquemas propuestos el libro de Lineamientos de Autoevaluaci&oacute;n y Acreditaci&oacute;n, la sintetizai&oacute;n de los avances, resultados y experiencias del proceso de Autoevaluaci&oacute;n.</p>
                                <center><img src="../imagenes/banner-acreditacion.jpg" alt="" width="800" heigth="750"/></center>

                                <h2 style="font-size:20px; color:#005425;">Pol&iacute;tica  en Autoevaluaci&oacute;n y Acreditaci&oacute;n:</h2>
                                <center>
                                    <div style="background-color: #1c4d35; color:#fff; display:inline-block;"  >  &quot;La Evaluaci&oacute;n, eje del aseguramiento de la calidad <br>en la din&aacute;mica académica institucional para lograr la excelencia&quot;.</div>
                                </center>

                                <p style="font-size:20px; color:#005425;">Documentos de consulta</p>

                                <div style=" ">
                                    <ul> 
                                        <li><a style="font-size:12px; color:#8b8a8a; hover-color:red;" target="_blank" href="../Documentos/Interfaz/MEN_Decreto1295-2010.pdf">Registro Calificado, oferta y desarrollo de programas académicos de educación superior, Decreto 1295 de 2010 MEN.</a></li>
                                        <li><a style="font-size:12px; color:#8b8a8a; hover-color:red;" target="_blank" href="../Documentos/Interfaz/Lineamientos-acreditacion-CNA-2013.pdf">Lineamientos para la Acreditación de Programas Académicos, 2013- CNA.</a></li>
                                        <li><a style="font-size:12px; color:#8b8a8a; hover-color:red;" target="_blank" href="../Documentos/Interfaz/Acuerdo_02_2012-condiciones-iniciales-CESU.pdf">Apreciación de condiciones iniciales de acreditación de programas académicos, Acuerdo 02 de 2012 - CESU</a></li>
                                        <li><a style="font-size:12px; color:#8b8a8a; hover-color:red;" target="_blank" href="../Documentos/Interfaz/LINEAMIENTOS-SIGNIFICATIVOS-AUTOEVALUACION-MC.pdf">Lineamientos significativos de la autoevaluación para el mejoramiento continúo UDEC.</a></li>
                                        <li><a style="font-size:12px; color:#8b8a8a; hover-color:red;" target="_blank" href="../Documentos/Interfaz/DIRECCIONAMIENT-ESTRATEGICO-AUTOEVALUACION-ACREDITACION.pdf">Direccionamiento estratégico en autoevaluación UDEC.</a></li>
                                        <li><a style="font-size:12px; color:#8b8a8a; hover-color:red;" target="_blank" href="../Documentos/Interfaz/procedimiento-autoevaluacion.pdf">Procedimiento de autoevaluación para programas académicos UDEC</a></li>
                                    </ul> 
                                </div>                                
                            </div> 
                            <!--============================-->     


                            <?php
                            require_once("../Modelo/ENC_gruposInteres_modelo.php");
                            $objGrupoInteres = new GruposInteres();
                            $rsGrupos = $objGrupoInteres->getAllGrupos();
                            //require_once("elementos_vista.php");
                            $objComp = new Elementos();
                            $datos = array("tipo" => "una-columna", // (necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
                                "titulo" => "Seleccione un grupo de interes", // (no necesario) titulo del bloque
                                "alignTitulo" => "texto-izquierda", //  (necesario si se pone titulo) alienacion del titulo {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
                                "alignContenido" => "texto-izquierda", //(necesario) alineacion del contenido del div
                                "icono" => "tree"); // (necesario si se pone titulo) icono que aparece al lado del titulo
                            $objComp->div_bloque_principal($datos);
                            ?>

                            <p>Su opinión es importante para nosotros, por favor seleccione el grupo al que usted pertenezca y suministre los datos necesarios para comenzar con la encuesta.</p>
                            <p>Recuerde que la encuesta es totalmente anónima. Gracias por su opinión </p>
                            <br />

                            <div style="-moz-column-count:2; -webkit-column-count:2; column-count:2;"><?php while (!$rsGrupos->EOF) { ?><span style="padding-bottom:1.5em; display:block;"><?php
                                        $datos = array(
                                            "icono" => "upload", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                                            "onclick" => "enc_mostrarEncuesta(this," . $rsGrupos->fields[0] . ");"); // (necesario) funcion js que se ejecutara si se hace click en el boton
                                        $objComp->button_solo_icono($datos);
                                        echo ucfirst($rsGrupos->fields[1]);
                                        ?>
                                    </span> <?php
                                    $rsGrupos->MoveNext();
                                }
                                ?></div><?php
                            $objComp->cerrar_div_bloque_principal();

                            $datos = array("id" => "ventana-encuesta", ///(necesario) id que tendra el div que contendra nuevos elementos
                                "tipo" => "una-columna", //(necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
                                "alignContenido" => "texto-centro"); //(necesario) alineacion del contenido del div {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
                            $objComp->bloque_div_normal($datos);
                            $objComp->cerrar_bloque_div_normal();
                        }
                        ?>
                    </div>
                    <div id="bloque_encuestas" class="principal-panel-sub-contenido" style="overflow-x:visible; overflow-y:visible;">

                    </div>

                    <div class="carga" id="carga">
                        <h2><img src="../imagenes/cargando.gif" alt="HTML5 Icon" style="width:128px;height:128px"/>
                            Cargando..</h2>
                    </div>
                </div>
                <!--/panel-contenido-->
            </div>
            <!--/principal-pagina-->
            <div class="ir-arriba">
                <a class="icon-arrow-up" onclick="subir();"></a>
            </div>  
    </body>
</html>