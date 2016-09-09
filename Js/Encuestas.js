function enc_subMenu(_this,_url){
    $.ajax({
        url:   _url,
        type:  'post',
        dataType:'html',
        data: {},
        success:  function (data) {
                    $('#bloque-submenu').html(data);
        }
   });
   return false;
}

function enc_cargarNuevaPagina(_this,_url){
    $.ajax({
        url:   _url,
        type:  'post',
        dataType:'html',
        data: {},
        success:  function (data) {
                    $('.principal-panel-sub-contenido').html(data);
        }
   });
   return false;
}

function enc_cargarSeleccionEvidencia(_this,_url,_destino,_titulo){
    $.ajax({
        url:   _url,
        type:  'post',
        dataType:'html',
        data: {"url":_destino,"titulo":_titulo},
        success:  function (data) {
                    $('.principal-panel-sub-contenido').html(data);
        }
   });
   return false;
}

function enc_aceptarEmergente(_elemento){
    var padre=$(_elemento).parent().parent().parent();
    $(padre).fadeToggle();
    return false;
}

function enc_listaEmergente(_this,url,idVentana){
    $.ajax({
            url:   url,
            type:  'post',
            dataType:'html',
            data: {"opcion":"pagina"},
            success:  function (data) {
                        $('#bloque-dinamico').html(data);
                        $(idVentana).fadeToggle();
            }
       });
       return false;
}

function enc_seleccionarTabla(_this,url,fuente,idVentana){
    var id=$(_this).parent().find("#id").val();
    var texto=$(_this).parent().find("#texto").html();
    //texto=texto;
    var textarea="#texto-"+fuente;
    $.ajax({
        url:   url,
        type:  'post',
        dataType:'html',
        data: {id:id,"opcion":"guardarId"},
        success:  function (data){
                    $(textarea).val(texto);
                    $(idVentana).fadeToggle();
                    switch(textarea){
                        case "#texto-factor":
                            $("#texto-caracteristica").val("");
                            $("#texto-aspecto").val("");
                            $("#texto-evidencia").val("");
                            break;
                        case "#texto-caracteristica":
                            $("#texto-aspecto").val("");
                            $("#texto-evidencia").val("");
                            break;
                        case "#texto-aspecto":
                            $("#texto-evidencia").val("");
                            break;
                        case "#texto-evidencia":
                            break;
                    }
        }
   });
   return false;
}

function enc_verPreguntas(_this,_url){
    var msjerrores="";
    var error=false;
    if($("#texto-factor").val()==""){
        msjerrores+="- Debe seleccionar un factor.<br>";
        error=true;
    }else{
        var factor=$("#texto-factor").val();
    }
    if($("#texto-caracteristica").val()==""){
        msjerrores+="- Debe seleccionar una caracteristica.<br>";
        error=true;
    }else{
        var caracteristica=$("#texto-caracteristica").val();
    }
    if($("#texto-aspecto").val()==""){
        msjerrores+="- Debe seleccionar un aspecto.<br>";
        error=true;
    }else{
        var aspecto=$("#texto-aspecto").val();
    }
    if($("#texto-evidencia").val()==""){
        msjerrores+="- Debe seleccionar una evidencia.<br>";
        error=true;
    }else{
        var evidencia=$("#texto-evidencia").val();
    }
    if(!error){
        $.ajax({
                url:   _url,
                type:  'post',
                dataType:'html',
                data: {"factor":factor,"caracteristica":caracteristica,"aspecto":aspecto,"evidencia":evidencia},
                success:  function (data){
                            $('.principal-panel-sub-contenido').html(data);
                            $("#tabla-preguntas").focus();
                }
           });
    }else{
        msjerrores="Se han encontrado errores:<br><br>"+msjerrores;
        $.ajax({
                url:   '../Controlador/ENC_ventanaEmergente_controlador.php',
                type:  'post',
                dataType:'html',
                data: {"texto":msjerrores},
                success:  function (data){
                            $('#bloque-dinamico').html(data);
                            $("#ventana-error").fadeToggle();
                }
           });
    }
    return false;
}

function enc_selectCantidadRespuesta(_this){
    var cantidad=$(_this).val();
    if(cantidad!=0){
    //alert("Seleccion:"+$(_this).val());
        $.ajax({
            url:   '../Controlador/ENC_tipoRespuesta_controlador.php',
            type:  'post',
            dataType:'html',
            data: {"cantidad":cantidad},
            success:  function (data) {
                        $('#bloque-respuestas-principal').html(data);
            }
       });
   }else{ 
        $("#respuestas-contenido").html("<p style=\"padding-top:0.5em;\">Seleccione primero una cantidad de respuestas, luego seleccione un tipo de respuesta.</p>");
   }
}

function enc_selectTipoRespuesta(_this){
    var idTipo=$(_this).val();
    //alert("Seleccion:"+idTipo);
    if(idTipo!=0){
        $.ajax({
            url:   '../Controlador/ENC_tipoRespuesta_controlador.php',
            type:  'post',
            dataType:'html',
            data: {"tipo":idTipo},
            success:  function (data) {
                    $('select[name*="ponderacion"]').each(function(i){
                        $(this).html(data);
                    });
                    $('#div-ideal').remove();
            }
       });
       $.ajax({
            url:   '../Controlador/ENC_tipoRespuesta_controlador.php',
            type:  'post',
            dataType:'html',
            data: {"ideal":idTipo},
            success:  function (data) {
                    $('.grupo-controles-formulario:last-child').before(data);
            }
       });
   }else{
       $('select[name*="ponderacion"]').each(function(i){
            $(this).html("<option style=\"display:block;\" value=\"0\">Sin tipo</option>");
        });      
   }
}

function enc_guardarPregunta(opcion,institucional){
    if(opcion==null){
        opcion="guardar";
    }
    if(institucional==null){
        institucional="normal";
    }
    var msjerrores="";
    var error=false;
    var txPregunta=$("#crearPregunta #textarea-pregunta").val();
    if(txPregunta==""){
        msjerrores+="- El texto de la pregunta no puede ir vacio.<br>";
        error=true;
    }    
    var cantRes=$("#crearPregunta #cantidad-respuestas").val();
    if(cantRes==0){
        msjerrores+="- Debe seleccionar una cantidad de respuestas.<br>";
        error=true;
    }
    var tipoRes=$("#crearPregunta #tipo-respuesta").val();
    if(tipoRes==0){
        msjerrores+="- Debe seleccionar un tipo de respuesta.<br>";
        error=true;
    }
    var txResErr=0;
    $("#crearPregunta #textoRespuesta").each(function(i){
        if($(this).val()==""){
            txResErr++;
        }
    });
    if(txResErr>0){
        msjerrores+="- Los textos de las respuestas no pueden estar vacios.<br>";
        error=true;
    } 
    /*if(opcion=="guardarInstitucional"){
        var contGrupos=0;
        $("#crearPregunta input[type=checkbox]:checked").each(function(i){
            contGrupos++;
        });
        if(contGrupos==0){
            msjerrores+="- Debe Seleccionar un grupo de interes como minimo.\n";
            error=true;
        }
    }*/
    if(!error){
        var factor=$("#texto-factor").text();
        var caracteristica=$("#texto-caracteristica").text();
        var aspecto=$("#texto-aspecto").text();
        var evidencia=$("#texto-evidencia").text();
        var url="";
        if(opcion=="guardar"){
            url='../Controlador/ENC_guardarPregunta_controlador.php';
        }else{
            if(opcion=="modificar"){
                url='../Controlador/ENC_guardarModificacionPregunta_controlador.php';
            }
        }
        var datosPregunta=$("#crearPregunta").serialize();
        //alert(datosPregunta);
        $.ajax({
            url:   url,
            type:  'post',
            dataType:'html',
            data: datosPregunta,
            success:  function (data) {
                    $("#bloque-dinamico").html(data);
                    $("#ventana-info").fadeToggle();
                    //alert("Pregunta Guardada satisfactoriamente.");
                    //enc_actualizarGuardarPregutna();
                    //enc_cancelarModificar(institucional);
            }
        });
        /*$.ajax({
            url:   '../Controlador/ENC_crearPreguntas_controlador.php',
            type:  'post',
            dataType:'html',
            data: {"factor":factor,"caracteristica":caracteristica,"aspecto":aspecto,"evidencia":evidencia},
            success:  function (data){
                        $('.principal-panel-sub-contenido').html(data);
            }
       });*/
    }else{
        msjerrores="Se han encontrado errores:<br><br>"+msjerrores;
        $.ajax({
            url:   '../Controlador/ENC_ventanaEmergente_controlador.php',
            type:  'post',
            dataType:'html',
            data: {"texto":msjerrores},
            success:  function (data){
                        $('#bloque-dinamico').html(data);
                        $("#ventana-error").fadeToggle();
            }
       });
    }
}
function enc_actualizarGuardarPregutna(){
    var factor=$("#texto-factor").text();
    var caracteristica=$("#texto-caracteristica").text();
    var aspecto=$("#texto-aspecto").text();
    var evidencia=$("#texto-evidencia").text();
    $.ajax({
            url:   '../Controlador/ENC_crearPreguntas_controlador.php',
            type:  'post',
            dataType:'html',
            data: {"factor":factor,"caracteristica":caracteristica,"aspecto":aspecto,"evidencia":evidencia},
            success:  function (data){
                    $('.principal-panel-sub-contenido').html(data);
            }
   });
   return false;
}
function enc_modificarPregunta(_this,opcion){
    if(opcion==null){
        opcion="normal";
    }
    var idPregunta=$(_this).parent().parent().find("#id").text();
    var url="";
    if(opcion=="normal"){
        url='../Controlador/ENC_modificarPregunta_controlador.php';
    }else{
        if(opcion=="institucional"){
            url='../Controlador/ENC_modificarPreguntaInstitucional_controlador.php';
        }
    }
    //alert("modificar: "+idPregunta);
    $.ajax({
            url:   url,
            type:  'post',
            dataType:'html',
            data: {"idPregunta":idPregunta},
            success:  function (data) {
                    $('#bloque-crear-modificar').html(data);
                    //$('#textarea-pregunta').focus();
            }
       });
    return false;
}

function enc_cancelarModificar(opcion){
    if(opcion==null){
        opcion="normal";
    }
    var factor=$("#texto-factor").text();
    var caracteristica=$("#texto-caracteristica").text();
    var aspecto=$("#texto-aspecto").text();
    var evidencia=$("#texto-evidencia").text();
    var url="";
    if(opcion=="normal"){
        url= '../Controlador/ENC_crearPreguntas_controlador.php';
    }else{
        if(opcion=="institucional"){
            url= '../Controlador/ENC_encuestaCargosInstitucionales_controlador.php';
        }
    }
    $.ajax({
            url:   url,
            type:  'post',
            dataType:'html',
            data: {"factor":factor,"caracteristica":caracteristica,"aspecto":aspecto,"evidencia":evidencia},
            success:  function (data){
                        $('.principal-panel-sub-contenido').html(data);
                        $("#tabla-preguntas").focus();
                        
            }
       });
       return false;
}

function enc_mostarOcultarRespuestas(_this){
     $(_this).next().slideToggle();
     if($(_this).text()=="(Ver respuestas)"){
        $(_this).text("(Ocultar respuestas)");
     }else{
        $(_this).text("(Ver respuestas)");
     }
    return false;
}

function enc_modificarEnlacesGruposInteres(_this){
    var idPregunta=$(_this).parent().parent().find("#id").text();
    //alert("modificar: "+idPregunta);
    $.ajax({
            url:   '../Controlador/ENC_modificarEnlacePregunta_controlador.php',
            type:  'post',
            dataType:'html',
            data: {"idpregunta":idPregunta},
            success:  function (data) {
                    $('#bloque-dinamico').html(data);
                    $('#ventana-gruposInteres').fadeToggle();
            }
       });
    return false;
}

function enc_guardarEnlacePreguntas(_this){
    //var idPregunta=$(_this).parent().parent().find("#id").text();
    var datosGrupos=$("#datos-grupos").serialize();
    //alert(datosGrupos);
    $.ajax({
        url:   '../Controlador/ENC_guardarEnlacePregunta_controlador.php',
        type:  'post',
        dataType:'html',
        data: datosGrupos,
        success:  function (data) {
                $('#bloque-dinamico').html(data);
                $('#ventana-gruposInteres').fadeToggle();
                $('#ventana-info').fadeToggle();
        }
   });
    return false;
}

function enc_procesarEncuesta(_this,_opcion,_idGrupoInt){
    switch(_opcion){
        case "guardar":
            var txTitulo=$('#titulo').val();
            var txDescri=$('#descripcion').val();
            var txInstrucciones=$('#instrucciones').val();
            $.ajax({
                url:   'ENC_guardarDatosEncuesta_controlador.php',
                type:  'post',
                dataType:'html',
                data:{"opcion":_opcion,"idGrupo":_idGrupoInt,"titulo":txTitulo,"descripcion":txDescri,"instrucciones":txInstrucciones},
                success:  function (data) {
                        $('#bloque-dinamico').html(data);
                        $('#ventana-info').fadeToggle();
                }
           });
           break;
    }
   return false;
}

function enc_aceptarEmergenteUrl(_this,_url){
    var padre=$(_this).parent().parent().parent(); 
    $.ajax({
        url:   _url,
        type:  'post',
        dataType:'html',
        data: {},
        success:  function (data) {
            $(padre).fadeToggle();
            $('.principal-panel-sub-contenido').html(data);
        }
   });
}

function enc_aceptarCrearPregunta(_this,_url){
    var padre=$(_this).parent().parent().parent(); 
    var factor=$("#texto-factor").text();
    var caracteristica=$("#texto-caracteristica").text();
    var aspecto=$("#texto-aspecto").text();
    var evidencia=$("#texto-evidencia").text();
    $.ajax({
        url:   _url,
        type:  'post',
        dataType:'html',
        data: {"factor":factor,"caracteristica":caracteristica,"aspecto":aspecto,"evidencia":evidencia},
        success:  function (data) {
            $(padre).fadeToggle();
            $('.principal-panel-sub-contenido').html(data);
        }
   });
}

function enc_mostrarEncuesta(_this,_idGrupo){
    $.ajax({
        url:   '../Controlador/ENC_ventanaEncuesta_controlador.php',
        type:  'post',
        dataType:'html',
        data: {"opcion":"base","idgrupo":_idGrupo},
        success:  function (data) {
            $('#ventana-encuesta').html(data);
            $('#encuesta-solucion').fadeToggle();
        }
   });
}

function enc_ajaxSelect(_this,_idSelectDestino,_url,_opcion){
    var seleccion=$(_this).val();
    $(_this).attr('disable','on');
    _idSelectDestino="select[name="+_idSelectDestino+"]";
    //alert(seleccion);
    $.ajax({
        url:   _url,
        type:  'post',
        dataType:'html',
        data: {"opcion":_opcion,"idSede":seleccion},
        success:  function (data) {
            $(_idSelectDestino).html(data);
        }
   });
}

function enc_traerPreguntas(_this){
    var datos=$("#respuestas-encuesta-form").serialize();
    //var idPrograma=$(_this).val();
    //var idSede=$("select[name=sede]").val();
    //if(idPrograma!=0){
        datos+="&opcion=preguntas";
        //alert(datos);
        $.ajax({
            url:   '../Controlador/ENC_ventanaEncuesta_controlador.php',
            type:  'post',
            dataType:'html',
            data: datos,
            success:  function (data) {
                $("#seccion-preguntas").html(data);
            }
       });
  // }else{
        //$("#seccion-preguntas").html("");
   //}
}

function enc_enviarEncuestaSolucion(_this){
    var datos=$("#respuestas-encuesta-form").serialize();
    //alert(datos);
    $.ajax({
        url:   '../Controlador/ENC_enviarEncuestaRespuestas_controlador.php',
        type:  'post',
        dataType:'html',
        data: datos,
        success:  function (data) {
            $('#bloque-dinamico').html(data);
            $('#ventana-mensaje').fadeToggle();
        }
   });
}


function enc_seleccionFactorPrograma(_this){
    //alert($(_this).attr("value"));
    //alert($(_this).find('input[type=\'radio\']').attr('value'));
    $(_this).find('input[type=\'radio\']').attr('checked',true);
}

function enc_listarProcesosSede(_this){
    var idsede=$(_this).val();
     $.ajax({
        url:   '../Controlador/ENC_ventanaEncuesta_controlador.php',
        type:  'post',
        dataType:'html',
        data: {"opcion":"listaPrcocesos","idSede":idsede},
        success:  function (data) {
            $('#lista_programas').html(data);
        }
   });
}

//************************************************************************************//
function enviarProceso(_this){
    var idProceso=$(_this).parent().find("#id_proceso").val();
    $.ajax({
            url:   '../Controlador/ENC_seleccionEvidencia_controlador.php',
            type:  'post',
            dataType:'html',
            data: {"idProceso":idProceso},
            success:  function (data) {
                        $('.principal-panel-sub-contenido').html(data);
            }
       });
       return false;
}

function enviarProcesoPublicar(_this){
    var idProceso=$(_this).parent().find("#id_proceso").val();
    $.ajax({
            url:   '../Controlador/ENC_publicarEncuesta_controlador.php',
            type:  'post',
            dataType:'html',
            data: {"idProceso":idProceso},
            success:  function (data) {
                        $('.principal-panel-sub-contenido').html(data);
            }
       });
       return false;
}

function enc_regresar(_url,_destino,_titulo){
    $.ajax({
        url:   _url,
        type:  'post',
        dataType:'html',
        data: {"url":_destino,"titulo":_titulo},
        success:  function (data) {
                    $('.principal-panel-sub-contenido').html(data);
        }
   });
   return false;
}

function enc_datosPublicar(_this,idGrupo){
    $.ajax({
        url:   '../Controlador/ENC_datosPublicar_controlador.php',
        type:  'post',
        dataType:'html',
        data: {"idGrupo":idGrupo},
        success:  function (data) {
                    $('.principal-panel-sub-contenido').html(data);
        }
   });
   return false;
}

function enc_vistaPreviaPublicar(_this,_idVentana,_idProceso,_idGrupo){
    var idVentana="#"+_idVentana;
    var txTitulo=$("#titulo").val();
    var txDescripcion=$("#descripcion").val();
    var txInstrucciones=$("#instrucciones").val();
    $.ajax({
        url:   '../Controlador/ENC_preguntasPublicar_controlador.php',
        type:  'post',
        dataType:'html',
        data: {"idProceso":_idProceso,"idGrupo":_idGrupo,"titulo":txTitulo,"descripcion":txDescripcion,"instrucciones":txInstrucciones},
        success:  function (data){
                    $('#bloque-dinamico').html(data);
                    $(idVentana).fadeToggle();
        }
   });
}

function enc_ventanaEstadoPregunta(_this){
    var idPregunta=$(_this).parent().parent().find("#id").text();
    //alert("modificar: "+idPregunta);
    $.ajax({
            url:   '../Controlador/ENC_eliminarDeshabilitar_controlador.php',
            type:  'post',
            dataType:'html',
            data: {"id":idPregunta},
            success:  function (data) {
                    $('#bloque-deshabilitar-eliminar').html(data);
                    $('#ventana-deshabilitar-eliminar').fadeToggle();
            }
       });
    return false;
}

function enc_cambarEstadoPregunta(id,estado){
 $.ajax({
        url:   '../Controlador/ENC_eliminarConfirmacion_controlador.php',
        type:  'post',
        dataType:'html',
        data: {'id':id,'estado':estado,'opcion':'estado'},
        success:  function (data) {
                $('#ventana-deshabilitar-eliminar').fadeToggle();
                $('#bloque-deshabilitar-eliminar').html(data);
                $('#ventana-confirmar').fadeToggle();
                //enc_actualicarEliminarDeshabilitar();
        }
   });
   return false;
}

function enc_eliminarPregunta(id){
 $.ajax({
        url:   '../Controlador/ENC_eliminarConfirmacion_controlador.php',
        type:  'post',
        dataType:'html',
        data: {'id':id,'opcion':'eliminar'},
        success:  function (data) {
                $('#ventana-deshabilitar-eliminar').fadeToggle();
                $('#bloque-deshabilitar-eliminar').html(data);
                $('#ventana-confirmar').fadeToggle(function(){
                    //enc_actualicarEliminarDeshabilitar();
                });
                
        }
   });
   return false;
}
function enc_actualicarEliminarDeshabilitar(_this){
    var factor=$("#texto-factor").text();
    var caracteristica=$("#texto-caracteristica").text();
    var aspecto=$("#texto-aspecto").text();
    var evidencia=$("#texto-evidencia").text();
    $.ajax({
            url:   '../Controlador/ENC_eliminarDeshabilitar_controlador.php',
            type:  'post',
            dataType:'html',
            data: {"factor":factor,"caracteristica":caracteristica,"aspecto":aspecto,"evidencia":evidencia},
            success:  function (data){
                    var padre=$(_this).parent().parent().parent();
                    $(padre).fadeToggle();
                    $('.principal-panel-sub-contenido').html(data);
            }
   });
   return false;  
    
}
function enc_exportarEncuestaPdf(_idGrupo,_idProceso){
    /*$.ajax({
        url:   '../Controlador/ENC_exportarEncuestas_controlador.php',
        type:  'post',
        data: {'idGrupo':_idGrupo,'idProceso':_idProceso},
        success:  function (data) {
                window.open(data,'_blank');
        }
   });
   /*.ajax({
        type: "POST",
        processData: false,
        url: "aaaa.p?name=pdf",
        data: inputxml,
        contentType: "application/xml; charset=utf-8",
        success: function(data)
        {
            var iframe = $('<iframe>');
            iframe.attr('src','/pdf/yourpdf.pdf?options=first&second=here');
            $('#targetDiv').append(iframe);
        }
    });*/
   url='../Controlador/ENC_exportarEncuestas_controlador.php?idGrupo='+_idGrupo+'&idProceso='+_idProceso;
   window.open(url,'_blank');
   return false;
}
function enc_informeDetallado(_this){
    var elem=_this;
    var grupo=$(elem).find('#grupo').val();
    //alert(grupo);
    $.ajax({
        url:   '../Controlador/ENC_informeDetallado_controlador.php',
        type:  'post',
        dataType:'html',
        data: {'idGrupo':grupo},
        success:  function (data) {
                $('#seccion-informe-general').slideToggle(300);
                $('#seccion-informe-detallado').html(data);
                $('#seccion-informe-detallado').slideToggle();
        }
   });
   return false;
}

function enc_resumenDetallado(_this){
    var elem=_this;
    var grupo=$(elem).find('#grupo').val();
    //alert(grupo);
    $.ajax({
        url:   '../Controlador/ENC_resumenEncuestasDetallado_controlador.php',
        type:  'post',
        dataType:'html',
        data: {'idGrupo':grupo},
        success:  function (data) {
                $('.principal-panel-sub-contenido').html(data);
        }
   });
   return false;
}
function enc_volverResultados(_this){
    $('#seccion-informe-detallado').slideToggle(300);
    $('#seccion-informe-detallado').html('');
    $('#seccion-informe-general').slideToggle(300);
}

function enc_modificarTipoPregunta(_this,idTipo){
    //alert(idtipo);
    $.ajax({
        url:   '../Controlador/ENC_administrarTipoPregunta_controlador.php',
        type:  'post',
        dataType:'html',
        data: {'idTipo':idTipo},
        success:  function (data) {
                $('#bloque-dinamico').html(data);
                $('#modificar-tipo-pregunta').fadeToggle();
        }
   });
   return false;
}

function enc_guardarModificacionTipoPregunta(_this){
    //alert($('#datos').serialize()+'&guardar=1');
    $.ajax({
        url:   '../Controlador/ENC_administrarTipoPregunta_controlador.php',
        type:  'post',
        dataType:'html',
        data: $('#datos').serialize()+'&guardar=1',
        success:  function (data) {
                $('#modificar-tipo-pregunta').fadeToggle();
                enc_cargarNuevaPagina(this,'../Controlador/ENC_administrarTipoPregunta_controlador.php');
                //$('#bloque-dinamico').html(data);
        }
   });
   return false;
}