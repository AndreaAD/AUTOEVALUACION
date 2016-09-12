$(function(e){

    var pagina = 1; 
    var items = 4;
    var num_paginas = 0;
    var div_emergente = $('#div_emergente');
    var _divOculto = $("#div_contenido_completo");

    var cargarRespuestas = function(){
        $("#div_contenido_completo div.pregunta").each(function(i, e){
            var _id_pregunta =  $(this).data('rel-pregunta');
            var proceso =  $(this).data('rel-proceso');
            $.ajax({
                url: '../Controlador/DOC_Autoevaluacion_Controlador.php',
                method: 'post',
                dataType:'json',
                async: false,
                data: {
                    operacion: 'obtenerRespuestas',
                    id_pregunta: _id_pregunta,
                    proceso: proceso,
                },
                success:  function (data) {

                    if(data.length > 0){
                        if(data[0].respuesta == 10006){
                            $('div.pregunta[data-rel-pregunta="'+_id_pregunta+'"] input[data-role="respuesta"]').val(data[0].respuesta_6);
                        }else if( data[0].respuesta == 10007 ){
                            $('div.pregunta[data-rel-pregunta="'+_id_pregunta+'"] input[data-role="respuesta"]').val(data[0].respuesta_7);
                        }else{
                            $('div.pregunta[data-rel-pregunta="'+_id_pregunta+'"] select[data-role="respuesta"]').find('option[data-id="'+data[0].respuesta+'"]').attr('selected' , 'selected');
                        }
                        $('div.pregunta[data-rel-pregunta="'+_id_pregunta+'"] textarea[data-role="observaciones"]').val(data[0].observaciones);
                    }
                }
            });
        });
    }

    var obtenerPorcentaje = function(){
        $.ajax({
            url: '../Controlador/DOC_Autoevaluacion_Controlador.php',
            method: 'post',
            dataType:'json',
            async: false,
            data: {
                operacion: 'obtenerPorcentaje',
                idgrupo: $('input[name="grupoI"]').val()
            },
            success:  function (data){
                var porcentaje = 0;
                if(data.institucional == 0)
                    porcentaje = data.porcentaje_programa;
                else
                    porcentaje = data.porcentaje_institucional;

                $('#progreso-total .principal').text(porcentaje+"%");
                $('#progreso-total .progreso ').css('width', porcentaje+'%');

                if(data.estado == 1 && data.institucional == 0){
                    $('#emergentefinal').find('.emergente > div[data-role="contenido"]').html('<div id="titulo_final" class="row"><p class="mensaje_principal">Ha diligenciado todas las preguntas satisfactoriamente para finalizar esta etapa de click <a href="#" id="finalizar_etapa">aquí</a></p></div>');
                    $('#emergentefinal').fadeIn();
                    /*$('#titulo_final').remove();
                    var mensaje = '<div id="titulo_final" class="row">';
                        mensaje += '<div class="titulo alerta">';
                            mensaje += '<h4>Mensaje</h4>';
                        mensaje += '</div>';
                        mensaje += '<div><p class="mensaje_principal">Ha diligenciado todas las preguntas satisfactoriamente para finalizar esta etapa de click <a href="#" id="finalizar_etapa">aquí</a></p></div>';
                        mensaje += '</div>';
                    _divOculto.prepend(mensaje);*/
                }else{
                    /*$('#titulo_final').remove();*/
                }

            }
        });
    }


    var verificarPendientes = function(){

        $("#div_contenido_completo div.pregunta").each(function(i, e){
            var select = $(this).find('select[data-role="respuesta"]');
            var archivos = $(this).find('.file-uploader table.archivos');
            var textarea = $(this).find('textarea[data-role="observaciones"]');
            
            if(select.val() == 0){
                select.closest('.validador').find('label').addClass('pendiente');
            }else{
                select.closest('.validador').find('label').removeClass('pendiente');
            }

            if(archivos.find('tr').length < 1){
                archivos.closest('.validador').find('label').addClass('pendiente');
            }else{
                archivos.closest('.validador').find('label').removeClass('pendiente');
            }

            if(textarea.val() == ''){
                textarea.closest('.validador').find('label').addClass('pendiente');
            }else{
                textarea.closest('.validador').find('label').removeClass('pendiente');
            }
        });     
    }




    var cargarControlador = function(_pagina){
        $.ajax({
            url: '../Controlador/DOC_Autoevaluacion_Controlador.php',
            method: 'post',
            dataType:'json',
            async: false,
            data: {
                operacion: 'cargarInformacionFactor',
                alcance:  $("input[name='alcance']").val(),
                items: items,
                pagina: _pagina,
            },
            success:  function (data) {
                console.dir(data);

                var div_procesos = $('#div_procesos');
                var lista_ids_preguntas = [];
                var lista_nombres_preguntas = [];
                var proc = [];
                var proc_x_pregunta = [];
                var html = '';


                $.each( data, function( key, value ) {
                     $.each( value, function( key_2, value_2 ) {
                        $.each( value_2, function( key_3, value_3 ) {
                            if(key_3 == 'pk_instru_evaluacion'){

                                if( lista_ids_preguntas.indexOf(value_3) == -1 ){
                                    lista_ids_preguntas.push(value_3);
                                    lista_nombres_preguntas.push(value_2['pregunta']);
                                }
                        
                                proc.push(value_2);
                            }

                        });
                    });
                });

                if(proc.length > 0){
                    for( var m=0; m<lista_ids_preguntas.length; m++){

                        html += '<div class="row" >';
                            html += '<div class="titulo">';
                                html += '<h4>'+lista_nombres_preguntas[m]+'</h4>';
                            html += '</div>';
                            proc_x_pregunta = [];
                            for( var i=0; i<proc.length; i++){

                                if( proc_x_pregunta.indexOf(proc[i].fk_proceso) == -1 ){
                                    proc_x_pregunta.push(proc[i].fk_proceso);
                                }

                                if(proc[i].pk_instru_evaluacion == lista_ids_preguntas[m]){
                                    html += '<div class="proceso_div pregunta" data-rel-pregunta="'+proc[i].pk_respuesta_instrumento+'" data-rel-proceso="'+proc[i].fk_proceso+'" style="width:99%;padding:5px;display:inline-block;    font-size: 13px;    margin: 10px;">';
                                        html += '<div class="accordion">'+proc[i].nombre_proceso+'</div>';
                                        html += '<div class="panel"><br>';

                                            if(proc[i].respuestas.length == 1 ){
                                                    if (proc[i].respuestas[0].fk_tipo_respuesta == 6){
                                                        html += '<label>Seleccione el porcentaje</label>';
                                                        html += '<input type="number" min="1" max="100" name="respuesta-porc" data-role="respuesta" data-tipo="numero" data-id-tipo-respuesta="10006">';
                                                        html += '<span style="font-size: 10px; margin-left: 5px;">El maximo para la escala porcentual es: ' +proc[i].porcentaje+' </span>';
                                                    }
                                                    if (proc[i].respuestas[0].fk_tipo_respuesta == 7){
                                                        html += '<label>Seleccione el valor ideal </label>';
                                                        html += '<input type="number" min="1" max="100" name="respuesta-porc" data-role="respuesta" data-tipo="numero" data-id-tipo-respuesta="10007">';
                                                        html += '<span>El maximo valor ideal es: ' +proc[i].porcentaje+' </span>';
                                                    }
                                            }else{
                                                html += '<div class="validador">';
                                                    html += '<label>Seleccione la respuesta</label>';
                                                    html += '<select data-role="respuesta" data-tipo="selector" style="    width: 100% !important;    height: 30px !important;    min-width: 30px !important;">';
                                                    html += '<option data-id="0" value="0"></option>';
                                                        for( var k = 0; k<proc[i].respuestas.length; k++){
                                                            html += '<option data-id="'+proc[i].respuestas[k].pk_respuestas_pregunta+'" value="'+proc[i].respuestas[k].ponderacion+'">'+proc[i].respuestas[k].texto+'</option>';
                                                        }
                                                    html += '</select>';
                                                html += '</div>';
                                            }
                                            html += '<div class="validador">';
                                                html += '<br><label data-role="doc">Seleccione el(los) documento(s) que sustentan su respuesta</label>';
                                                html += '<div class="file-uploader" data-rel="'+proc[i].pk_respuesta_instrumento+'" data-proceso="'+proc[i].fk_proceso+'">';
                                                    html += '<input type="file"><a href="#" data-op="cargar_doc" data-rel="'+proc[i].pk_respuesta_instrumento+'"  data-proceso="'+proc[i].fk_proceso+'" class="subir">Cargar</a><br>';
                                                    //html += '<div class="progress-bar"><div class="progreso"></div></div>';
                                                    html += '<div class="table">';
                                                        if(proc[i].documentos.length > 0){
                                                            html += '<table class="archivos">';
                                                                for(var k = 0; k<proc[i].documentos.length; k++){
                                                                    html += '<tr data-id="'+proc[i].documentos[k].pk_documento+'"><td><a  href="'+proc[i].documentos[k].url+'" target="_blank">'+proc[i].documentos[k].nombre+'</a></td><td><a href="#" data-role="borrar">eliminar</a></td></tr>';
                                                                }
                                                            html += '</table>';
                                                        }else{
                                                            html += '<table class="archivos">';
                                                            html += '</table>';
                                                        }
                                                    html += '</div>';
                                                    // if ($('input[name="grupoI"]').val() == "Equipo del Programa"){
                                                    //     html += '<a href="#" data-role="nuevosArchivos" data-id-instru="'+proc[i].pk_instru_evaluacion+'" class="subir_nuevos">Archivos de procesos anteriores</a>';
                                                    // }
                                                html += '</div>';
                                            html += '</div>';
                                            html += '<div class="validador">';
                                                html += '<label>Recomendaciones</label>';
                                                html += '<textarea data-role="observaciones"></textarea>';
                                            html += '</div>';


                                        html += '</div>';
                                    html += '</div>';
                                }
                            }

                        //     if(proc.length > 0){
                        //         html += '<div class="div_varios_documentos">';
                        //             html += '<label class="label_varios_doc">Si ud desea cargar algún documento, que aplique para todos los procesos de autoevaluación, puede ingresar aqui. </label>';
                        //             html += '<div class="file-uploader" style="margin-left:16px;" >';
                        //                 html += '<input id="fileupload" type="file" name="files[]"  multiple>';
                        //                 //<input id="fileupload" type="file" name="files[]" data-url="server/php/" multiple>
                        //                 //html += '<input name="files[]" type="file" data-role="subir_multiples" multiple data-rel="'+lista_ids_preguntas[m]+'" data-proceso="'+proc_x_pregunta+'">&nbsp;&nbsp;<a href="#" data-op="cargar_doc_todos" class="subir" style="color: #cc0000; font-size:12px;">Cargar</a><br>';
                        //                 html += '<input type="hidden" id="lista_procesos" value="'+lista_ids_preguntas[m]+'">';
                        //                 html += '<input type="hidden" id="pregunta_ind" value="'+proc_x_pregunta+'">';
                        //                 //html += '<div class="progress-bar"><div class="progreso"></div></div>';
                        //                 // html += '<div class="table">';
                        //                 //     if(proc[i].documentos.length > 0){
                        //                 //         html += '<table class="archivos">';
                        //                 //             for(var m = 0; m<proc[i].documentos.length; m++){
                        //                 //                 html += '<tr data-id="'+proc[i].documentos[m].pk_documento+'"><td><a  href="'+proc[i].documentos[m].url+'" target="_blank">'+proc[i].documentos[m].nombre+'</a></td><td><a href="#" data-role="borrar">eliminar</a></td></tr>';
                        //                 //             }
                        //                 //         html += '</table>';
                        //                 //     }else{
                        //                 //         html += '<table class="archivos">';
                        //                 //         html += '</table>';
                        //                 //     }
                        //                 // html += '</div>';
                        //                 // if ($('input[name="grupoI"]').val() == "Equipo del Programa"){
                        //                 //     html += '<a href="#" data-role="nuevosArchivos" data-id-instru="'+proc[i].pk_instru_evaluacion+'" class="subir_nuevos">Archivos de procesos anteriores</a>';
                        //                 // }
                        //             html += '<br><br>';
                        //             html += '</div>';
                        //         html += '</div>'; 
                        //     }
                        // html += '</div>';


                    }

                }else{
                    html += 'En el momento no cuenta con instrumentos de evaluación generados, para diligenciar información';
                }


                div_procesos.html(html);
            },complete: function(){
                cargarRespuestas();
                // verificarPendientes();
                // obtenerPorcentaje();
                _divOculto.removeClass('hide');
            }
        });
    }

    var guardarRespuestasPreguntas = function(){
        var respuestas = new Array();
        
        $("#div_contenido_completo div.pregunta").each(function(i, e){
            var tipo = $(this).find('[data-role="respuesta"]').attr('data-tipo');
            if(tipo == 'selector'){
                respuestas.push({
                    id_pregunta: $(this).data('rel-pregunta'),
                    id_proceso: $(this).data('rel-proceso'),
                    id_respuesta: $(this).find('select[data-role="respuesta"] option:selected').data('id'),
                    ponderacion: $(this).find('select[data-role="respuesta"]').val(),
                    observaciones: $(this).find('textarea[data-role="observaciones"]').val(),
                    tipo: 'normales'
                });
            }else if(tipo == 'numero'){
                respuestas.push({
                    id_pregunta: $(this).data('rel-pregunta'),
                    id_proceso: $(this).data('rel-proceso'),
                    id_respuesta: $(this).find('input[data-role="respuesta"]').data('id-tipo-respuesta'),
                    ponderacion: $(this).find('input[data-role="respuesta"]').val(),
                    observaciones: $(this).find('textarea[data-role="observaciones"]').val(),
                    tipo: 'numerico'
                });
            }
        });
        
        $.ajax({
            url: '../Controlador/DOC_Autoevaluacion_Controlador.php',
            method: 'post',
            dataType:'json',
            async: false,
            data: {
                operacion: 'guadarRespuestas',
                idgrupo: $('input[name="grupoI"]').val(),
                respuestas: respuestas
            },
            success:  function (data) {
                
                console.log(data);
                //verificarPendientes();
                //obtenerPorcentaje();
            }
        });
    }


    var cargarPaginador = function(){
        $.ajax({
            url: '../Controlador/DOC_Autoevaluacion_Controlador.php',
            method: 'post',
            dataType:'json',
            async: false,
            data:{
                operacion: 'obtenerTotalInstrumentos2',
            },
            success:function (data){
                var lista_ids_preguntas = [];

                $.each( data, function( key, value ) {
                     $.each( value, function( key_2, value_2 ) {
                        $.each( value_2, function( key_3, value_3 ) {
                            if(key_3 == 'pk_instru_evaluacion'){

                                if( lista_ids_preguntas.indexOf(value_3) == -1 ){
                                    lista_ids_preguntas.push(value_3);
                                }
                            }

                        });
                    });
                });


                num_paginas = lista_ids_preguntas.length / items;
                $('div[data-role="paginador"]').empty();
                for (var i = 0; i < num_paginas; i++) {
                    $('div[data-role="paginador"]').append('<a href="#" data-rel="'+i+'" class="'+(i == 0 ? 'active' : '')+'">'+(i+1)+'</a>');
                }
                $('div[data-role="paginador"]').prepend('<input type="button" value="Guardar">');
            }
        });
    }

    $('#div_contenido_completo').delegate('a[data-role="borrar"]', 'click', function(e){
        var id = $(this).closest('tr').data('id');
        var tr = $(this).closest('tr');
        $.ajax({
            url: '../Controlador/DOC_InfoAdicional_Controlador.php',
            method: 'post',
            dataType:'json',
            async: false,
            data: {
                operacion: 'eliminarDocumentos',
                id_documento: id
            },
            success:  function (data) {
                if (data == '1'){
                    tr.remove();
                }
            }
        });
        e.preventDefault();
    });


    div_emergente.delegate('input[data-role="agregar_archivos"]','click', function(e){
        $('input[name="checkboxArchivos[]"]:checked').each(function(e){
            var tr = $(this).closest('tr');
            $.ajax({
                url: '../Controlador/DOC_Autoevaluacion_Controlador.php',
                type:  'post',
                dataType:'json',
                async: false,
                data:{
                    operacion: "guardarArchivosExistentes",
                    pk_documento: tr.data('pk_documento'),
                    programa: tr.data('programa'),
                    sede: tr.data('sede')
                },
                success:  function (data) {
                    if(data == 1){

                    }else{

                    }
                }
            });
        });
        var pag = $('#paginador .active').data('rel');
        if(pag == ''){
            pag = 0;
        }
        cargarControlador(pag, $("input[name='grupoI']").val());
        div_emergente.css('display','none');
        e.preventDefault();
    });
    
        /**
     * cargar lista de archivos para un instrumento
     * @param  {[type]} e [description]
     * @return {[type]}   [description]
     */
    $('#div_contenido_completo').delegate('a[data-role="nuevosArchivos"]', 'click', function(e){
        var id = $(this).data('id-instru');
        var seccion = $('input[name="grupoI"]').val();
        $.ajax({
            url: '../Controlador/DOC_InfoAdicional_Controlador.php',
            method: 'post',
            dataType:'json',
            async: false,
            data: {
                operacion: 'cargarDocumentosEmergente',
                id_instru: id,
                seccion: seccion
            },
            success:  function (data) {
                if(data == 0){
                    div_emergente.find('.emergente > div[data-role="contenido"]').html('<p>No existen documentos anteriores para este instrumento. </p>');
                    div_emergente.find('.emergente > div[data-role="botones"]').html('');
                    div_emergente.css('display','block');
                    /*recargartablarespuestas();*/
                }else{
                    var lista = '<div class="row">';
                        lista += '<table class="archivos_emergente" data-role="archivos_existentes"><tr><td>Archivo</td><td>Descargar</td><td>Seleccionar</td></tr>'
                            for(var i = 0; i < data.length; i++){
                                lista += '<tr data-pk_documento="'+data[i].pk_documento+'" data-programa="'+data[i].fk_programa+'" data-sede="'+data[i].fk_sede+'" ><td><a href="#" data-id="'+data[i].pk_documento+'">'+data[i].fecha+' | '+data[i].nombre+'</a></td><td><a href="'+data[i].url+'" target="_blank" style="color:#f00;">Descargar</a></td><td><input type="checkbox" name="checkboxArchivos[]" value="'+data[i].pk_documento+'" /></td></tr>';
                            }
                        lista += '</table>';
                    lista += '</div>';
                    div_emergente.find('.emergente > div[data-role="contenido"]').html(lista);
                    div_emergente.find('.emergente > div[data-role="botones"]').html('<input type="button" id="agregar_archivos_existentes" data-role="agregar_archivos" value="Agregar" />');
                    div_emergente.css('display','block');
                }   
            }
        });
        e.preventDefault();
    });


	cargarControlador(0);
    cargarPaginador();

    $('div[data-role="paginador"]').delegate('a', 'click', function(e){
        var pag = $(this).data('rel');
        $('div[data-role="paginador"] a').each(function(i,e){
            $(this).removeClass('active');
        });
        guardarRespuestasPreguntas();
        cargarControlador(pag);
        $(this).addClass('active');
        e.preventDefault();
    });

    $('div[data-role="paginador"]').delegate('input[type="button"]', 'click', function(e){
        guardarRespuestasPreguntas();
    });



});