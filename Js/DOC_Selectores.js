function updateDataTableSelectAllCtrl(table){
   var $table             = table.table().node();
   var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
   var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
   var chkbox_select_all  = $('thead input[name="select_all"]', $table).get(0);

   // If none of the checkboxes are checked
   if($chkbox_checked.length === 0){
      chkbox_select_all.checked = false;
      if('indeterminate' in chkbox_select_all){
         chkbox_select_all.indeterminate = false;
      }

   // If all of the checkboxes are checked
   } else if ($chkbox_checked.length === $chkbox_all.length){
      chkbox_select_all.checked = true;
      if('indeterminate' in chkbox_select_all){
         chkbox_select_all.indeterminate = false;
      }

   // If some of the checkboxes are checked
   } else {
      chkbox_select_all.checked = true;
      if('indeterminate' in chkbox_select_all){
         chkbox_select_all.indeterminate = true;
      }
   }
}


$(function(e){

    var rows_selected = {};
    var seccion = $('input[name="_section"]').val();
    var cambio_estado = $('input[name="cambio_estado"]').val();
    var link_factor = $('#A_factor');
    var link_caracteristica = $('#A_caracteristica');
    var link_aspecto = $('#A_aspecto');
    var link_evidencia = $('#A_evidencia');
    var link_evidencia2 = $('#A_evidencia2');
    var link_instrumento = $('#A_instrumento');
    var link_procesos = $('#A_procesos');
    var link_tipoprocesos = $('#A_tipoprocesos');
    var check_grupo = $('#C_grupoInteres');

    var div_emergente = $('#div_emergente');
    var div_checkbox = $('#div_chechbox');
    var _id_factor = 0;
    var _id_caracteristica = 0;
    var _id_aspecto = 0;
    var _id_evidencia = 0;
    var _id_instrumento = 0;
    var tabla_guardar = $('#tabla_agregar');
    var tabla_guardar_info = $('#tabla_agregar_info');
    var $S_tipoRespuesta = $('select[name="S_tipoRespuesta"]');

    var tabla_agregar_documentos = $('#tabla_agregar_documentos');
        
    var tabla_tipo_respuestas = $('#tabla_tipo_respuestas');
    var _divOculto = $("#div_contenido_completo");
    var pagina = 1; 
    var items = 4;
    var num_paginas = 0;

    var _B_nuevoproceso = $("#B_nuevoProceso");
    var _div = $("#contenido_factores");
    var _tablainformacion = $("#tablaInfo");


    /**
     * [cerrarEmergente cierra las ventanas emergentes]
     * @param  {[type]} e [description]
     * @return {[type]}   [description]
     */
    var cerrarEmergente = function(e){
        div_emergente.css('display','none');
        e.preventDefault();
    }

    /**
     * [ocultar_emergente ocultar ventana emergente]
     * @return {[type]} [description]
     */
    var ocultar_emergente = function(){
        setTimeout(function(){ div_emergente.fadeOut("slow"); },2000)
    }

    /**
     * [Asignar evento a la x para cerrar la ventana emergente]
     * @param  {[type]} e [description]
     * @return {[type]}   [description]
     */
    $('#emergentefinal').find('.emergente span[data-rol="cerrar"]').on('click', function(e){
        $('#emergentefinal').css('display','none');
        e.preventDefault();
    });

    /**
     * [cargartablaInstrumentos2 cargar los instrumento de evaluacion en una tabla]
     * @param  {[type]} e [description]
     * @return {[type]}   [description]
     */
    var cargartablaInstrumentos2 = function(e){
        $.ajax({
            url: '../Controlador/DOC_InstruEval_Controlador.php',
            type:  'post',
            async: false,
            dataType:'json',
            data:{
                operacion: "cargarInstrumento",
                evidencia: $("input[name='evidencia']").val(),
            },
            success:  function (data) {
                if(data == 0){
                    tabla_guardar.html("");
                }else{
                    var lista ="<tr><th>Instrumento</th><th>Proceso</th><th></th><th></th></tr>";
                    for(var i = 0; i < data.length; i++){
                        lista += '<tr data-evidencia ="'+data[i].fk_evidencia+'" data-tipo="'+data[i].fk_tipo_respuesta+'" data-id="'+data[i].pk_instru_evaluacion+'"><td data-td="descripcion">'+data[i].descripcion+'</td><td data-td="proceso">'+data[i].proceso+'</td><td><a  data-role="modificar" href="#" >Modificar</a></td><td><a data-role="eliminar" href="#" >Eliminar</a></td></tr>';
                    }
                    tabla_guardar.html(lista);
                    tabla_guardar.fadeIn();  
                }           
            }
        });
    }

    /**
     * [cargarInfoAdicional2 cargar ingformacion adicional en una tabla]
     * @param  {[type]} e [description]
     * @return {[type]}   [description]
     */
    var cargarInfoAdicional2 = function(e){
        $.ajax({
            url: '../Controlador/DOC_InfoAdicional_Controlador.php',
            type:  'post',
            async: false,
            dataType:'json',
            data:{
                operacion: "cargarInfoAdicional",
                pregunta: $("input[name='instrumento']").val()
            },
            success:  function (data) {
                if (data.length > 0){
                    tabla_guardar_info.html("");
                    var lista ="<tr><th>Informacion</th><th>Deshabilitar</th><th>Descargar</th></tr>";
                    for(var i = 0; i < data.length; i++){
                        lista += '<tr  data-id="'+data[i].pk_infoAdicional+'"><td data-td="descripcion2">'+data[i].nombre+'</td><td><a  data-evento="eliminar" href="#" >Deshabilitar</a></td><td><a target="_blank" href="'+data[i].url+'"> Descargar </a></td></tr>';
                    }
                    tabla_guardar_info.html(lista);      
                }else{
                    tabla_guardar_info.html("");
                }               
            }
        });
    }

    /**
     * [cargarInfoAdicional cargar informacion adicional en una tabla]
     * @param  {[type]} e [description]
     * @return {[type]}   [description]
     */
    var cargarInfoAdicional = function(e){
        $.ajax({
            url: '../Controlador/DOC_InfoAdicional_Controlador.php',
            type:  'post',
            async: false,
            dataType:'json',
            data:{
                operacion: "cargarInfoAdicional",
                pregunta: $("input[name='instrumento']").val()
            },
            success:  function (data) {
                if (data.length > 0){
                    tabla_guardar_info.html("");
                    var lista ="<tr><th>Informacion</th><th>Descargar</th><th>Eliminar</th></tr>";
                    for(var i = 0; i < data.length; i++){
                        lista += '<tr  data-id="'+data[i].pk_infoAdicional+'"><td data-td="descripcion2">'+data[i].nombre+'</td><td><a  data-evento="eliminar" href="#" >Eliminar</a></td><td><a target="_blank" href="'+data[i].url+'"> Descargar </a></td></tr>';
                    }
                    tabla_guardar_info.html(lista);      
                }else{
                    tabla_guardar_info.html("");
                }       
            }
        });
    }

    /**
     * [cargarCheckGrupos cargar checkbox con los grupos de interes]
     * @return {[type]} [description]
     */
    var cargarCheckGrupos = function(){
        $.ajax({
            url: '../Controlador/DOC_Selector_Controlador.php',
            type:  'post',
            async: false,
            dataType:'json',
            data:{
                operacion: "cargarGrupoInteres"
            },
            success:  function (data) {
                var lista ="";
                for(var i = 0; i < data.length; i++){
                    lista += '<input type="radio" class="check" name="grupoInteres[]" value="'+data[i].pk_grupo_interes+'">'+data[i].nombre+' ';
                }
                div_checkbox.html(lista);           
            }
        });
    }

    /**
     * [evento al hacer click sobre un factor en la emergente]
     * @param  {[type]} e [description]
     * @return {[type]}   [description]
     */
    link_factor.on('click', function(e){
        div_emergente.find('.emergente > div[data-role="contenido"]').html("");
        var check = $('input[name="grupoInteres[]"]').serializeArray();

        if( seccion == 'infoAdicional' || seccion == 'intru_evaluacion'){
            if ( check.length == 0){
                div_emergente.find('.emergente > div[data-role="contenido"]').html('<p>Selecione un grupo de interés </p>');
            }else{
                $.ajax({
                    url: '../Controlador/DOC_Selector_Controlador.php',
                    method: 'post',
                    dataType:'json',
                    async: false,
                    data: {
                        operacion: 'obtenerFactores',
                        grupoInteres : $('input[name="grupoInteres[]"]').serializeArray()
                    },
                    success:  function (data) { 
                        var lista = '<div class="row"><ul class="selector" data-rel="factor">';
                        for(var i = 0; i < data.length; i++){
                            lista += '<li><a href="#" data-codigo="'+data[i].codigo+'"  data-id="'+data[i].pk_factor+'">'+data[i].codigo+'. '+data[i].nombre+'</a></li>';
                        }
                        lista += "</ul></div>";
                        div_emergente.find('.emergente > div[data-role="contenido"]').html(lista);
                    }
                });
            }
            div_emergente.css('display','block');   
        }else{
            if(seccion == "consultas_programa"){
                valor = 7;
            }else if(  seccion == "consultas_institucional" ){
                valor = 8;
            }else{
                valor = "";
            }
            $.ajax({
                url: '../Controlador/DOC_Selector_Controlador.php',
                method: 'post',
                dataType:'json',
                async: false,
                data: {
                    operacion: 'factores',
                    valor : valor
                },
                success:  function (data) { 
                    var lista = '<div class="row"><ul class="selector" data-rel="factor">';
                    for(var i = 0; i < data.length; i++){
                        lista += '<li><a href="#" data-id="'+data[i].pk_factor+'">'+data[i].codigo+'. '+data[i].nombre+'</a></li>';
                    }
                    lista += "</ul></div>";
                    div_emergente.find('.emergente > div[data-role="contenido"]').html(lista);
                }
            });
        }
        div_emergente.css('display','block');   
    });
    
    /**
     * evento al hacer click sobre una caracteristica en la ventane emergente
     * @param  {[type]} e [description]
     * @return {[type]}   [description]
     */
    link_caracteristica.on('click', function(e){
        if(_id_factor == 0){
            div_emergente.find('.emergente > div[data-role="contenido"]').html('<p>Seleccione un factor antes de seleccionar una característica</p>');
        }else{
            if( seccion == 'infoAdicional' || seccion == 'intru_evaluacion'){
                $.ajax({
                    url: '../Controlador/DOC_Selector_Controlador.php',
                    method: 'post',
                    dataType: 'json',
                    async: false,
                    data: {
                        operacion: 'obtenerCaracteristicas',
                        id_factor: _id_factor,
                        grupoInteres : $('input[name="grupoInteres[]"]').serializeArray()
                    },
                    success: function (data) {
                        var lista = '<div class="row"><ul class="selector" data-rel="caracteristica">';
                        for(var i = 0; i < data.length; i++){
                            
                            lista += '<li><a href="#" data-codigo="'+data[i].codigo+'" data-id="'+data[i].pk_caracteristica+'">'+data[i].codigo+'. '+data[i].nombre+'</a></li>';
                        }
                        lista += "</ul></div>";
                        div_emergente.find('.emergente > div[data-role="contenido"]').html(lista);
                    }
                });
            }else{
                if(seccion == "consultas_programa"){
                    valor = 7;
                }else if(  seccion == "consultas_institucional" ){
                    valor = 8;
                }else{
                    valor = "";
                }
                $.ajax({
                    url: '../Controlador/DOC_Selector_Controlador.php',
                    method: 'post',
                    dataType: 'json',
                    async: false,
                    data: {
                        operacion: 'caracteristica',
                        id_factor: _id_factor,
                        valor : valor
                    },
                    success: function (data) {
                        var lista = '<div class="row"><ul class="selector" data-rel="caracteristica">';
                        for(var i = 0; i < data.length; i++){
                            
                            lista += '<li><a href="#" data-id="'+data[i].pk_caracteristica+'">'+data[i].codigo+'. '+data[i].nombre+'</a></li>';
                        }
                        lista += "</ul></div>";
                        div_emergente.find('.emergente > div[data-role="contenido"]').html(lista);
                    }
                });
            }
        }
        div_emergente.css('display','block');
    });
    
    /**
     * evento al hacer click sobre un aspecto en la ventane emergente
     * @param  {[type]} e [description]
     * @return {[type]}   [description]
     */
    link_aspecto.on('click', function(e){
        if(_id_caracteristica == 0){
            div_emergente.find('.emergente > div[data-role="contenido"]').html('<p>Seleccione una característica antes de seleccionar un aspecto</p>');
        }else{
            if( seccion == 'infoAdicional' || seccion == 'intru_evaluacion'){
                $.ajax({
                    url: '../Controlador/DOC_Selector_Controlador.php',
                    method: 'post',
                    dataType: 'json',
                    async: false,
                    data: {
                        operacion: 'obtenerAspectos',
                        id_caracteristica: _id_caracteristica,
                        grupoInteres : $('input[name="grupoInteres[]"]').serializeArray()

                    },
                    success: function (data) {
                        var lista = '<div class="row"><ul class="selector" data-rel="aspecto">';
                        for(var i = 0; i < data.length; i++){
                            
                            lista += '<li><a href="#" data-codigo="'+data[i].codigo+'" data-id="'+data[i].pk_aspecto+'">'+data[i].codigo+'. '+data[i].nombre+'</a></li>';
                        }
                        lista += "</ul></div>";
                        div_emergente.find('.emergente > div[data-role="contenido"]').html(lista);
                    }
                });
            }else{
                if(seccion == "consultas_programa"){
                    valor = 7;
                }else if(  seccion == "consultas_institucional" ){
                    valor = 8;
                }else{
                    valor = "";
                }
                $.ajax({
                    url: '../Controlador/DOC_Selector_Controlador.php',
                    method: 'post',
                    dataType: 'json',
                    async: false,
                    data: {
                        operacion: 'aspecto',
                        id_caracteristica: _id_caracteristica,
                        valor : valor

                    },
                    success: function (data) {
                        var lista = '<div class="row"><ul class="selector" data-rel="aspecto">';
                        for(var i = 0; i < data.length; i++){
                            
                            lista += '<li><a href="#" data-id="'+data[i].pk_aspecto+'">'+data[i].codigo+'. '+data[i].nombre+'</a></li>';
                        }
                        lista += "</ul></div>";
                        div_emergente.find('.emergente > div[data-role="contenido"]').html(lista);
                    }
                });
            }
        }
        div_emergente.css('display','block');
    });
    
    /**
     * evento al hacer click sobre una evidencia en la ventane emergente
     * @param  {[type]} e [description]
     * @return {[type]}   [description]
     */
    link_evidencia.on('click', function(e){
        if(_id_aspecto == 0){
            div_emergente.find('.emergente > div[data-role="contenido"]').html('<p>Seleccione un aspecto antes de seleccionar una evidencia</p>');
        }else{
            if( seccion == 'infoAdicional' || seccion == 'intru_evaluacion'){
                $.ajax({
                    url: '../Controlador/DOC_Selector_Controlador.php',
                    method: 'post',
                    dataType: 'json',
                    async: false,
                    data: {
                        operacion: 'obtenerEvidencia',
                        id_aspecto: _id_aspecto,
                        grupoInteres : $('input[name="grupoInteres[]"]').serializeArray()
                    },
                    success: function (data) {
                        /*cargartablaProcesos();*/
                        var lista = '<div class="row"><ul class="selector" data-rel="evidencia">';
                        for(var i = 0; i < data.length; i++){
                            
                            lista += '<li><a href="#" data-codigo="'+data[i].codigo+'" data-id="'+data[i].pk_evidencia+'">'+data[i].codigo+'. '+data[i].nombre+'</a></li>';
                        }
                        lista += "</ul></div>";
                        div_emergente.find('.emergente > div[data-role="contenido"]').html(lista);
                    }
                });
            }else{
                if(seccion == "consultas_programa"){
                    valor = 7;
                }else if(  seccion == "consultas_institucional" ){
                    valor = 8;
                }else{
                    valor = "";
                }
                $.ajax({
                    url: '../Controlador/DOC_Selector_Controlador.php',
                    method: 'post',
                    dataType: 'json',
                    async: false,
                    data: {
                        operacion: 'evidencia',
                        id_aspecto: _id_aspecto,
                        valor : valor
                    },
                    success: function (data) {
                        var lista = '<div class="row"><ul class="selector" data-rel="evidencia">';
                        for(var i = 0; i < data.length; i++){
                            
                            lista += '<li><a href="#" data-id="'+data[i].pk_evidencia+'">'+data[i].codigo+'. '+data[i].nombre+'</a></li>';
                        }
                        lista += "</ul></div>";
                        div_emergente.find('.emergente > div[data-role="contenido"]').html(lista);
                    }
                });
            }
        }
        div_emergente.css('display','block');
        e.preventDefault();
        return false;
    });
    
    /**
     * evento al hacer click sobre un instrumento en la ventane emergente
     * @param  {[type]} e [description]
     * @return {[type]}   [description]
     */
    link_instrumento.on('click', function(e){
        if(_id_evidencia == 0){
            div_emergente.find('.emergente > div[data-role="contenido"]').html('<p>Seleccione una evidencia antes de seleccionar un instrumento</p>');
        }else{
            $.ajax({
                url: '../Controlador/DOC_Selector_Controlador.php',
                method: 'post',
                dataType: 'json',
                async: false,
                data: {
                    operacion: 'obtenerInstrumento',
                    id_evidencia: _id_evidencia

                },
                success: function (data) {
                    var lista = '<div class="row"><ul class="selector" data-rel="instrumento">';
                    for(var i = 0; i < data.length; i++){
                        
                        lista += '<li><a href="#" data-id="'+data[i].pk_instru_evaluacion+'">'+data[i].descripcion+'</a></li>';
                    }
                    lista += "</ul></div>";
                    div_emergente.find('.emergente > div[data-role="contenido"]').html(lista);
                }
            });
        }
        div_emergente.css('display','block');
    });
    
    /**
     * [muestra una emergente con los procesos actuales para seleccionar]
     * @param  {[type]} e [description]
     * @return {[type]}   [description]
     */
    link_procesos.on('click', function(e){
        /*if(_id_tipoprocesos == 0){
            div_emergente.find('.emergente > div[data-role="contenido"]').html('<p>Seleccione una tipo de proceso antes de seleccionar un proceso</p>');
        }else{*/
        $.ajax({
                url: '../Controlador/DOC_Selector_Controlador.php',
                method: 'post',
                dataType: 'json',
                async: false,
                data: {
                    operacion: 'obtenerProcesos'

                },
                success: function (data) {
                    var lista = '<div class="row"><ul class="selector" data-rel="procesos">';
                    for(var i = 0; i < data.length; i++){
                        
                        lista += '<li><a href="#" data-id="'+data[i].pk_proceso+'">Sede:'+data[i].nombreSede+' - '+data[i].nombre+' </a></li>';
                    }
                    lista += "</ul></div>";
                    div_emergente.find('.emergente > div[data-role="contenido"]').html(lista);
                }
            });
        //}
        div_emergente.css('display','block');
    });
    
    /**
     * gestiona el contenido de la emergente de acuerdo a las opciones seleccionadas anteriormente
     * @param  {[type]} e [description]
     * @return {[type]}   [description]
     */
    link_tipoprocesos.on('click', function(e){
        var lista = '<div class="row"><ul class="selector" data-rel="tipoProceso">';
        lista += '<li><a href="#" data-id="1">Documentos institucionales</a></li>';
        lista += '<li><a href="#" data-id="2">Documentos de programas</a></li>';
        lista += "</ul></div>";
        div_emergente.find('.emergente > div[data-role="contenido"]').html(lista);
        div_emergente.css('display','block');
    });

    div_emergente.delegate('.selector a', 'click', function(e){
        var rel = $(this).closest('.selector').data('rel');
        var id = $(this).data('id');
        var codigo = $(this).data('codigo');
        var descripcion = $(this).text();
        $('#'+rel).text(descripcion);
        switch(rel){
            case 'factor':
                _id_factor = id;
                _codigo_factor = codigo;
                $("input[name='grupoInt']").val();
                $("input[name='factor']").val(_id_factor);
                $("input[name='factor_codigo']").val(_codigo_factor);
                _id_caracteristica = 0;
                $("input[name='caracteristica']").val("");
                _id_aspecto = 0;
                $("input[name='aspecto']").val("");
                _id_evidencia = 0;
                $("input[name='evidencia']").val("");
                _id_instrumento = 0;
                $('#caracteristica').text("");
                $('#aspecto').text("");
                $('#evidencia').text("");
                _id_instrumento = 0;
                $("input[name='instrumento']").val("");
                $('#instrumento').text("");
                tabla_guardar.html("");
                tabla_guardar_info.html("");
                tabla_agregar_documentos.html("");
                $('#men_err').html("");
            break;
            case 'caracteristica':
                _id_caracteristica = id;
                _codigo_caracteristica = codigo;
                $("input[name='caracteristica']").val(_id_caracteristica);
                $("input[name='caracteristica_codigo']").val(_codigo_caracteristica);
                _id_aspecto = 0;
                $("input[name='aspecto']").val("");
                _id_evidencia = 0;
                $("input[name='evidencia']").val("");
                _id_instrumento = 0;
                $('#aspecto').text("");
                $('#evidencia').text("");
                tabla_guardar_info.html("");
                _id_instrumento = 0;
                $("input[name='instrumento']").val("");
                $('#instrumento').text("");
                tabla_guardar.html("");
                tabla_agregar_documentos.html("");
                $('#men_err').html("");
            break;
            case 'aspecto':
                _id_aspecto = id;
                 _codigo_aspecto = codigo;
                $("input[name='aspecto']").val(_id_aspecto);
                $("input[name='aspecto_codigo']").val(_codigo_aspecto);
                _id_evidencia = 0;
                $("input[name='evidencia']").val("");
                _id_instrumento = 0;
                $('#evidencia').text("");
                _id_instrumento = 0;
                $("input[name='instrumento']").val("");
                $('#instrumento').text("");
                tabla_guardar.html("");
                tabla_guardar_info.html("");
                $('#men_err').html("");
            break;
            case 'evidencia':
                _id_evidencia = id;
                 _codigo_evidencia = codigo;
                $("input[name='evidencia']").val(_id_evidencia);
                $("input[name='evidencia_codigo']").val(_codigo_evidencia);
                _id_instrumento = 0;
                _id_instrumento = 0;
                $("input[name='instrumento']").val("");
                $('#instrumento').text("");
                tabla_guardar_info.html("");
                if ( seccion == 'intru_evaluacion'){
                    // checkprogramas();
                    // if($('#lab_pro').text() == 'No hay procesos en fase de contruccion'){
                        
                    // }else{
                    //     cargartablaInstrumentos2();
                    // }
                }
                
                if (seccion == 'infoAdicional'){
                    cargartablaInstrumentos2();
                }
                cargartablaProcesos();
                tabla_guardar_info.html("");
            break;
            case 'instrumento':
                _id_instrumento = id;
                $("input[name='instrumento']").val(_id_instrumento);
                cargarInfoAdicional2();
            break;
            case 'procesos':
                _id_procesos = id;
                $("input[name='proceso']").val(_id_procesos);
                _id_factor = id;
                $("input[name='factor']").val("");
                _id_caracteristica = 0;
                $("input[name='caracteristica']").val("");
                _id_aspecto = 0;
                $("input[name='aspecto']").val("");
                _id_evidencia = 0;
                $("input[name='evidencia']").val("");
                _id_instrumento = 0;
                $('#caracteristica').text("");
                $('#aspecto').text("");
                $('#evidencia').text("");
                /*cargartablaProcesos();*/
                tabla_agregar_documentos.html("");
            break;
            case 'tipoProceso':
                _id_tipoprocesos = id;
                $("input[name='tipo_procesos']").val(_id_tipoprocesos);
                /*cargartablaProcesos();*/
                _id_factor = id;
                $("input[name='factor']").val(_id_factor);
                _id_caracteristica = 0;
                $("input[name='caracteristica']").val("");
                _id_aspecto = 0;
                $("input[name='aspecto']").val("");
                _id_evidencia = 0;
                $("input[name='evidencia']").val("");
                _id_instrumento = 0;
                $('#caracteristica').text("");
                $('#aspecto').text("");
                $('#evidencia').text("");
            break;
            
        }
        cerrarEmergente(e);
    });

    
    /**
     * [cargarInformacionFactor cargar la descripcion de un factor]
     * @return {[type]} [description]
     */
    var cargarInformacionFactor = function(){
        $.ajax({
            url: '../Controlador/DOC_Autoevaluacion_Controlador.php',
            method: 'post',
            dataType:'json',
            async: false,
            data: {
                operacion: 'cargarInformacionBasicaFactor',
                idFactor : $("input[name='factor']").val()
            },
            success:  function (data) {
                if(data > 0)
                    _divOculto.html('<div class="row"><div class="titulo"><h2>'+data[0]['nombre']+'</h2></div></div><div class="row"><div class="titulo"><h3>'+data[0]['descripcion']+'</h3></div></div>');
                else
                    _divOculto.html("");
            },complete: function(){
                _divOculto.removeClass('hide');
            }
        });
    }

    /**
     * [obtenerPorcentaje obtener porcentaje completado de un proceso]
     * @return {[type]} [description]
     */
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
    
    /**
     * [cargarControlador carga instrumentos de evaluacion paginados en el formuario]
     * @param  {[int]} _pagina [pagina]
     * @param  {[int]} _grupo  [id del grupo]
     * @return {[type]}         [description]
     */
    var cargarControlador = function(_pagina, _grupo){
        $.ajax({
            url: '../Controlador/DOC_Autoevaluacion_Controlador.php',
            method: 'post',
            dataType:'json',
            async: false,
            data: {
                operacion: 'cargarInformacionFactor',
                idgrupo: $('input[name="grupoI"]').val(),
                idFactor:  $("input[name='factor']").val(),
                items: items,
                pagina: _pagina,
                grupo: _grupo
            },
            success:  function (data) {
                _divOculto.html("");
                var lista = '';
                var form = '<form>';
                for(var i = 0; i<data.length; i++){
                    form += '<div class="row">';
                        // form += '<div class="titulo">';
                            // form += '<h4>'+data[i].caracteristica_codigo+'.'+data[i].caracteristica_nombre+'</h4>';
                        // form += '</div>';
                            form += '<div class="pregunta" data-rel-pregunta="'+data[i].pk_instru_evaluacion+'">';
                                form += '<div>';
                                    form += '<p class="titulo_pregunta">'+data[i].pregunta+'</p>';
                                form += '</div>';
                                if(data[i].respuestas.length == 1 ){
                                    if (data[i].respuestas[0].fk_tipo_respuesta == 6){
                                        form += '<label>Seleccione el porcentaje</label>';
                                        form += '<input type="number" min="1" max="100" name="respuesta-porc" data-role="respuesta" data-tipo="numero" data-id-tipo-respuesta="10006">';
                                        form += '<span style="font-size: 10px; margin-left: 5px;">El maximo para la escala porcentual es: ' +data[i].porcentaje+' </span>';
                                    }
                                    if (data[i].respuestas[0].fk_tipo_respuesta == 7){
                                        form += '<label>Seleccione el valor ideal </label>';
                                        form += '<input type="number" min="1" max="100" name="respuesta-porc" data-role="respuesta" data-tipo="numero" data-id-tipo-respuesta="10007">';
                                        form += '<span>El maximo valor ideal es: ' +data[i].porcentaje+' </span>';
                                    }
                                }else{
                                    form += '<div class="validador">';
                                        form += '<label>Seleccione la respuesta</label>';
                                        form += '<select data-role="respuesta" data-tipo="selector">';
                                        form += '<option data-id="0" value="0"></option>';
                                            for( var k = 0; k<data[i].respuestas.length; k++){
                                                form += '<option data-id="'+data[i].respuestas[k].pk_respuestas_pregunta+'" value="'+data[i].respuestas[k].ponderacion+'">'+data[i].respuestas[k].texto+'</option>';
                                            }
                                        form += '</select>';
                                    form += '</div>';
                                }
                                
                                if(data[i].informacion.length > 0){
                                form += '<div>';
                                    form += '<label>Es recomendado diligenciar la informacion adicional</label>';
                                    form += '<div class="table">';
                                        form += '<table class="archivos">';
                                            for(var l = 0; l<data[i].informacion.length; l++){
                                                form += '<tr>';
                                                form += '<td><a class="file" href="'+data[i].informacion[l].url+'" target="_blank">'+data[i].informacion[l].nombre+'</a></td>';
                                                form += '</tr>';
                                            }
                                        form += '</table>';
                                    form += '</div>';
                                form += '</div>';
                                }
                                form += '<div class="validador">';
                                    form += '<label>Seleccione el(los) documento(s) de informacion adicional que sustentan su respuesta</label>';
                                    form += '<div class="file-uploader" data-rel="'+data[i].pk_instru_evaluacion+'">';
                                        form += '<input type="file"><a href="#" data-op="cargar_info" data-rel="'+data[i].pk_instru_evaluacion+'" class="subir">Cargar</a><br>';
                                        form += '<div class="progress-bar"><div class="progresoinfo"></div></div>';
                                        form += '<div class="table">';
                                            if(data[i].informacionadicional.length > 0){
                                                form += '<table class="info">';
                                                    for(var t = 0; t<data[i].informacionadicional.length; t++){
                                                        form += '<tr data-id="'+data[i].informacionadicional[t].pk_documento+'"><td><a  href="'+data[i].informacionadicional[t].url+'" target="_blank">'+data[i].informacionadicional[t].nombre+'</a></td><td><a href="#" data-role="borrar">eliminar</a></td></tr>';
                                                    }
                                                form += '</table>';
                                            }else{
                                                form += '<table class="info">';
                                                form += '</table>';
                                            }
                                        form += '</div>';
                                    form += '</div>';
                                form += '</div>';
                                form += '<div class="validador">';
                                    form += '<label data-role="doc">Seleccione el(los) documento(s) que sustentan su respuesta</label>';
                                    form += '<div class="file-uploader" data-rel="'+data[i].pk_instru_evaluacion+'">';
                                        form += '<input type="file"><a href="#" data-op="cargar_doc" data-rel="'+data[i].pk_instru_evaluacion+'" class="subir">Cargar</a><br>';
                                        form += '<div class="progress-bar"><div class="progreso"></div></div>';
                                        form += '<div class="table">';
                                            if(data[i].documentos.length > 0){
                                                form += '<table class="archivos">';
                                                    for(var m = 0; m<data[i].documentos.length; m++){
                                                        form += '<tr data-id="'+data[i].documentos[m].pk_documento+'"><td><a  href="'+data[i].documentos[m].url+'" target="_blank">'+data[i].documentos[m].nombre+'</a></td><td><a href="#" data-role="borrar">eliminar</a></td></tr>';
                                                    }
                                                form += '</table>';
                                            }else{
                                                form += '<table class="archivos">';
                                                form += '</table>';
                                            }
                                        form += '</div>';
                                        if ($('input[name="grupoI"]').val() == "Equipo del Programa"){
                                            form += '<a href="#" data-role="nuevosArchivos" data-id-instru="'+data[i].pk_instru_evaluacion+'" class="subir_nuevos">Archivos de procesos anteriores</a>';
                                        }
                                    form += '</div>';
                                form += '</div>';
                                form += '<div class="validador">';
                                    form += '<label>Recomendaciones</label>';
                                    form += '<textarea data-role="observaciones"></textarea>';
                                form += '</div>';
                            form += '</div>';

                    form += '</div">';
                }
                form += '</form>';
                _divOculto.html(form);
            },complete: function(){
                cargarRespuestas();
                verificarPendientes();
                obtenerPorcentaje();
                _divOculto.removeClass('hide');
            }
        });
    }

    /**
     * [cargarPaginador gestiona paginador de instrumentos de evaluacion]
     * @return {[type]} [description]
     */
    var cargarPaginador = function(){
        $.ajax({
            url: '../Controlador/DOC_Autoevaluacion_Controlador.php',
            method: 'post',
            dataType:'json',
            async: false,
            data:{
                operacion: 'obtenerTotalInstrumentos',
                seccion :  $("input[name='_section']").val()
            },
            success:function (data){
                num_paginas = data / items;
                $('div[data-role="paginador"]').empty();
                for (var i = 0; i < num_paginas; i++) {
                    $('div[data-role="paginador"]').append('<a href="#" data-rel="'+i+'" class="'+(i == 0 ? 'active' : '')+'">'+(i+1)+'</a>');
                }
                $('div[data-role="paginador"]').prepend('<input type="button" value="Guardar">');
            }
        });
    }

    /**
     * [evento cerrar de la ventana emergente]
     * @param  {[type]} e [description]
     * @return {[type]}   [description]
     */
    div_emergente.find('.emergente span[data-rol="cerrar"]').on('click', function(e){
        div_emergente.css('display','none');
        e.preventDefault();
    });

    /**
     * [cargarRespuestas description]
     * @return {[type]} [description]
     */
    var cargarRespuestas = function(){
        $("#div_contenido_completo div.pregunta").each(function(i, e){
            var _id_pregunta =  $(this).data('rel-pregunta');
            $.ajax({
                url: '../Controlador/DOC_Autoevaluacion_Controlador.php',
                method: 'post',
                dataType:'json',
                async: false,
                data: {
                    operacion: 'obtenerRespuestas',
                    idgrupo: $('input[name="grupoI"]').val(),
                    id_pregunta: _id_pregunta
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

    /**
     * [eventos al cambiar los selectores para obtener el valor minimo de una respuesta para solicitar documento de sustentacion]
     * @param  {[type]} e [description]
     * @return {[type]}   [description]
     */
    $("#div_contenido_completo").delegate('select[data-role="respuesta"]', 'change', function(e){
        var op = $(this).find('option');
        var menor = 10000000; // si no nunca entrea el if en linea.
        op.each(function(i, e){
            var valores = $(this).val();
            menor = valores != 0 && valores < menor ? valores : menor;
        });
        if( $(this).val() == menor ){
            $(this).closest('div.pregunta').find('label[data-role="doc"]').addClass('negadoPendiente');
        }
    });

    /**
     * [verificarPendientes busca preguntas pendientes por responder]
     * @return {[type]} [description]
     */
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

    /**
     * [guardarRespuestasPreguntas guarda las respuestas de las preguntas]
     * @return {[type]} [description]
     */
    var guardarRespuestasPreguntas = function(){
        var respuestas = new Array();
        
        $("#div_contenido_completo div.pregunta").each(function(i, e){
            var tipo = $(this).find('[data-role="respuesta"]').attr('data-tipo');
            if(tipo == 'selector'){
                respuestas.push({
                    id_pregunta: $(this).data('rel-pregunta'),
                    id_respuesta: $(this).find('select[data-role="respuesta"] option:selected').data('id'),
                    ponderacion: $(this).find('select[data-role="respuesta"]').val(),
                    observaciones: $(this).find('textarea[data-role="observaciones"]').val(),
                    tipo: 'normales'
                });
            }else if(tipo == 'numero'){
                respuestas.push({
                    id_pregunta: $(this).data('rel-pregunta'),
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
                verificarPendientes();
                obtenerPorcentaje();
            }
        });
    }

    /**
     * [cargartablaProcesos carga tabla con los procesos actuales]
     * @param  {[type]} e [description]
     * @return {[type]}   [description]
     */
    var cargartablaProcesos = function(e){
        var _grupo = 0;
        if(seccion == 'consultas_programa'){
            _grupo = 1;
        }else{
            _grupo = 2;
        }
        $.ajax({
            url: '../Controlador/DOC_Selector_Controlador.php',
            type:  'post',
            async: false,
            dataType:'json',
            data:{
                operacion: "cargarDocumentosProceso",
                proceso: $("input[name='proceso']").val(),
                evidencia: $("input[name='evidencia']").val(),
                _grupo : _grupo
            },
            success:  function (data){
                $('#men_err').html("");
                tabla_agregar_documentos.html("");
                if(data.length == 0){
                    //$('#men_err').html('<p>Esta evidencia no tiene documentos actualmente</p>');
                }else{
                    tabla_agregar_documentos.html("");
                    for(var j = 0; j < data.length; j++){
                        var lista ='<tr><td  colspan="2"><span>Evidencia :</span> '+data[j].nombre_evidencia+'</td></tr>';
                          lista +='<tr><td  colspan="2"><span>Instrumento evaluacion : </span>'+data[j].descripcion+'</td></tr>';
                        for(var i = 0; i < data.length; i++){
                            lista += '<tr><td>'+data[i].nombre+'</td><td><a target="_blank" href="'+data[i].url+'"> Descargar </a></td></tr>';
                        }
                    }
                    tabla_agregar_documentos.html(lista);
                    tabla_agregar_documentos.fadeIn();
                }       
            }
        });
    }

    $('input[name="grupoInteres[]"]').on('click' , function(){
        $("input[name='factor']").val("");
        $("input[name='caracteristica']").val("");
        $("input[name='aspecto']").val("");
        $("input[name='evidencia']").val("");
        $('#factor').text("");
        $('#caracteristica').text("");
        $('#aspecto').text("");
        $('#evidencia').text("");
    });

    if(seccion == 'autoevaluacion_programa'){
        /**
         * [verificarProceso verifica que exista un proceso disponible]
         * @return {[type]} [description]
         */
        var verificarProceso = function (){
            $.ajax({
                url: '../Controlador/DOC_Autoevaluacion_Controlador.php',
                method: 'post',
                dataType:'json',
                async: false,
                data: {
                    operacion: 'verificarProcesos'
                },
                success:  function (data) {
                    if (data.resultados > 0) {
                        $('#nombre_proceso').text(data.proceso[0].nombre);
                    }else{
                        $('#div_procesos_verificados').css('display','none');
                        div_emergente.find('.emergente > div[data-role="contenido"]').html('<p>No existe un proceso actualmente o no se encuentra en la fase de captura de datos</p>');
                        div_emergente.css('display','block');
                    }
                },
                complete: function(){
                }
            });
        }

        /**
         * [verificarConsolidacion verifica que no se le haya realziado una consolidacion al proceso]
         * @return {[type]} [description]
         */
        var verificarConsolidacion = function(){
            $.ajax({
                url: '../Controlador/DOC_Autoevaluacion_Controlador.php',
                method: 'post',
                dataType:'json',
                async: false,
                data: {
                    operacion: 'verificarConsolidacion'
                },
                success:  function (data) {
                    if ($.isArray(data) && data.length > 0) {
                        div_emergente.find('.emergente > div[data-role="contenido"]').html('<p>Para este proceso ya se realizo consolidación</p>');
                        div_emergente.css('display','block');
                        $('#div_procesos_verificados').html('');
                    }else{
                        
                    }
                },
                complete: function(){
                }
            });
        }

        verificarProceso();
        verificarConsolidacion();
    }

        $('div[data-role="paginador"]').delegate('a', 'click', function(e){
        var pag = $(this).data('rel');
        $('div[data-role="paginador"] a').each(function(i,e){
            $(this).removeClass('active');
        });
        guardarRespuestasPreguntas();
        cargarControlador(pag, $("input[name='grupoI']").val());
        $(this).addClass('active');
        e.preventDefault();
    });

    /**
     * [eventos sobre los botones del paginador]
     * @param  {[type]} e [description]
     * @return {[type]}   [description]
     */
    $('div[data-role="paginador"]').delegate('input[type="button"]', 'click', function(e){
        guardarRespuestasPreguntas();
    });

    /**
     * [evento click boton finalizar etapa para realizar consolidacion]
     * @param  {[type]} e [description]
     * @return {[type]}   [description]
     */
    
    $('#emergentefinal').delegate('#finalizar_etapa', 'click', function(e){
        $.ajax({
            url: '../Controlador/DOC_Autoevaluacion_Controlador.php',
            method: 'post',
            dataType:'json',
            async: false,
            data: {
                operacion: 'consolidacionFinal'
            },
            success:  function (data) {
                if (data == 1) {
                    AbrirPagina('../Controlador/SAD_Grupo_Modulos_Controlador.php', '5', '17', '1' );
                }
            },
            complete: function(){
                
            }
        });
        e.preventDefault();
    });

        /**
     * agregar archivos nuevos para sutenta respuesta
     * @param  {[type]} e [description]
     * @return {[type]}   [description]
     */
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
    
        /**
     * [cargarSelectTipoRespuesta cargar selector con los tipos de respuesta existentes]
     * @return {[type]} [description]
     */
    var cargarSelectTipoRespuesta = function(){
        $.ajax({
            url: '../Controlador/DOC_Selector_Controlador.php',
            method: 'post',
            dataType:'json',
            async: false,
            data: {
                operacion: 'obtenerTipoRespuesta'
            },
            success:  function (data) {
                $('select[name="S_tipoRespuesta"]').append('<option value="0">Seleccionar</option>');
                for(var i = 0; i < data.length; i++){
                    var opcion = '';
                    $('select[name="S_tipoRespuesta"]').append('<option value="'+data[i].pk_tipo_respuesta+'">'+data[i].descripcion+'</option>');
                }
            }
        });
    }

    /* funciones para cargar instrumentos de evaluacion */

    
    var recargartablarespuestas = function (){
        $.ajax({
            url: '../Controlador/DOC_Selector_Controlador.php',
            method: 'post',
            dataType: 'json',
            async: false,
            data: {
                operacion: 'obtenerOpciones',
                id_respuesta : $('#tipo-respuesta').val()
            },
            success: function (data) {
                if(data.length > 0){
                    var lista ='<tr><th colspan="3">Tipo de respuesta</th></tr>';
                    for(var i = 0; i < data.length; i++){
                        lista += '<tr data-rel ="'+data[i].id_grupo+'" ><td >'+data[i].opciones+'</td><td><a data-role="modificar-respuestas" href="#" >Modificar</a></td><td><a data-role="eliminar-respuestas" href="#" >Eliminar</a></td></tr>';
                    }
                    $('#tabla_tipo_respuestas').html(lista);
                    $('#tabla_tipo_respuestas').fadeIn();
                }else{
                    $('#tabla_tipo_respuestas').html("");
                }
            }
        });
    }

    /**
     * [eliminar un tipo de respuesta]
     * @param  {[type]} e [description]
     * @return {[type]}   [description]
     */
    div_emergente.delegate('a[data-eliminar-tipo]','click', function(e){
        if($(this).data('eliminar-tipo') == "si"){
            $.ajax({
                url: '../Controlador/DOC_Autoevaluacion_Controlador.php',
                type:  'post',
                dataType:'json',
                data:{
                    operacion: "eliminarTipoRespuesta",
                    tipoEliminar: $('input[name="id_pregunta"]').val()
                },
                success:  function (data) {
                    if(data == 1){
                        recargartablarespuestas();
                        div_emergente.find('.emergente > div[data-role="contenido"]').html('<p>El tipo de respuesta se eliminó satisfactoriamente</p>');
                        div_emergente.css('display','block');
                    }else if(data == 0){
                        div_emergente.find('.emergente > div[data-role="contenido"]').html('<p>No se elimino el tipo de respuesta</p>');
                    }
                }
            }); 
        }
        div_emergente.css('display','none');
        e.preventDefault(); 
    });

    /**
     * [tabla_tipo_respuestas cargar tabla con los tipos de respuesta]
     * @return {[type]} [description]
     */
    var tabla_tipo_respuestas = function (){
        $.ajax({
            url: '../Controlador/DOC_Selector_Controlador.php',
            method: 'post',
            dataType: 'json',
            async: false,
            data: {
                operacion: 'obtenerOpciones',
                id_respuesta : $('#tipo-respuesta').val()
            },
            success: function (data) {
                if(data.length > 0){
                    var lista ='<tr><th colspan="3">Tipo de respuesta</th></tr>';
                    for(var i = 0; i < data.length; i++){
                        lista += '<tr data-rel ="'+data[i].id_grupo+'" ><td >'+data[i].opciones+'</td><td><a data-role="modificar-respuestas" href="#" >Modificar</a></td><td><a data-role="eliminar-respuestas" href="#" >Eliminar</a></td></tr>';
                    }
                    $('#tabla_tipo_respuestas').html(lista);
                    $('#tabla_tipo_respuestas').fadeIn();
                }
            }
        });
    }
    
    /**
     * [borrar docuemtnos de un instrumento de evaluacion]
     * @param  {[type]} e [description]
     * @return {[type]}   [description]
     */
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

    $('#modificar_tipo').attr('disabled',true);

        /**
     * [modificar opciones de respuesta]
     * @param  {[type]} e [description]
     * @return {[type]}   [description]
     */
    $('#tabla_tipo_respuestas').delegate('a[data-role="modificar-respuestas"]', 'click', function(e){
        $('#modificar_tipo').attr('disabled',false);
        var grupo_respuesta = $(this).closest('tr').data('rel');
        $.ajax({
            url: '../Controlador/DOC_Autoevaluacion_Controlador.php',
            method: 'post',
            dataType:'json',
            async: false,
            data: {
                operacion: 'cargarRespuestasGrupo',
                grupo_respuesta: grupo_respuesta
            },
            success: function(data){
                $("#respuestas-contenido").attr('data-grupo', data[0].grupo_respuesta);
                $('#respuestas-contenido textarea[name="textoRespuesta[]"]').each(function(i, e){
                    $(this).attr('data-pk', data[i].pk_respuestas_pregunta);
                    $(this).val(data[i].texto);

                    var select = $('#respuestas-contenido select[name="ponderacion[]"]')[i];
                    $(select).attr('data-pk', data[i].pk_respuestas_pregunta);
                    $(select).val(data[i].fk_respuesta_ponderacion);
                });
            }
        });
        e.preventDefault();
    });
    /**
     * eliminar opciones de respuesta
     * @param  {[type]} e [description]
     * @return {[type]}   [description]
     */
    $('#tabla_tipo_respuestas').delegate('a[data-role="eliminar-respuestas"]', 'click', function(e){
        var id_tipo = $(this).closest('tr').data('rel');
        var desc = $(this).closest('tr').find('td[data-td="descripcion"]').text();
        var texto = '<p>Esta seguro que desea eliminar el tipo de pregunta: "'+desc+'"</p>';
        $('input[name="id_pregunta"]').val(id_tipo);
        texto += '<a data-eliminar-tipo="si" href="#"> Si </a><a data-eliminar-tipo="no" href="#"> No </a>';
        div_emergente.find('.emergente > div[data-role="contenido"]').html(texto);
        div_emergente.css('display','block');
        /*recargartablarespuestas();*/
        e.preventDefault();
    });



    $('#modificar_tipo').on('click', function(){
        var respuestas = new Array();
        $('#respuestas-contenido textarea[name="textoRespuesta[]"]').each(function(i, e){
            ponderacion = $('#respuestas-contenido select[data-pk="'+$(this).data('pk')+'"]');
            respuestas.push({
                pk_respuestas_pregunta: $(this).data('pk'),
                texto: $(this).val(),
                fk_respuesta_ponderacion: ponderacion.val(),
                tipo_respuesta: $('#tipo-respuesta').val()
            });
        });

        $.ajax({
            url: '../Controlador/DOC_Autoevaluacion_Controlador.php',
            method: 'post',
            dataType:'json',
            async: false,
            data: {
                operacion: 'modificarRespuesta',
                respuestas: respuestas          
            },
            success: function(data){
                recargartablarespuestas();
            },
            complete: function(data){
                $('#modificar_tipo').attr('disabled',true);
                $('#respuestas-contenido textarea[name="textoRespuesta[]"]').each(function(i, e){
                    $(this).val('');
                });
            }
        }); 
    });
    if( seccion == 'intru_evaluacion'){
        cargarCheckGrupos();
        cargarSelectTipoRespuesta();
    }

    if( seccion == 'infoAdicional'){
        cargarCheckGrupos();
    }

    	/**
	 * [checkprogramas Agrega un checkbox con os procesos que hay actuamente]
	 */
	var checkprogramas = function(e){
		$.ajax({
	        url: '../Controlador/DOC_InstruEval_Controlador.php',
	        type:  'post',
	        async: false,
	        dataType:'json',
	        data:{
	        	operacion: "checkprogramas"
			},
	        success:  function (data) {
                return false;
	           if(data == 0){
	                div_emergente.find('.emergente > div[data-role="contenido"]').html('<p>No existen procesos en fase de construcción</p>');
                    div_emergente.css('display','block');
                    $('#contenido_instru').css('display','none');
                    $('#lab_pro').html('No hay procesos en fase de contruccion');
                    $('#B_guardarInstru').css('display','none'); 
                    $('#B_modificarInstru').css('display','none');
                    $('#tabla_agregar').css('display','none');
	           }else{
	               $('#checkbox_programas').html('');
    	        	$('#checkbox_programas').append('<input type="checkbox" name="todo" value="">todos<br>');
    	        	for(var i=0; i<data.length; i++){
    	        		$('#checkbox_programas').append('<input type="checkbox" name="procesos[]" value="'+data[i].pk_proceso+'">'+data[i].nombre+'(   Fase :'+data[i].fk_fase+')<br>');
    	        	}
	           }
	        return data;	
			}
   		});
	}
	
	$('#tipo-respuesta').on('change', function(e){
		recargartablarespuestas();
	});

    var listaCaracteristicas = function(e){
        $.ajax({
            url: '../Controlador/DOC_InstruEval_Controlador.php',
            type:  'post',
            async: false,
            dataType:'json',
            data:{
                operacion: "ListarCna"
            },
            success:  function (data) {
                var lista = '';
                var tabla = $('#tabla_caracteristicas tbody');
                if(data == 0){
                    tabla.append("");
                }else{
                    for(var i = 0; i < data.length; i++){
                        for (var j = 0; j < data[i]['caracteristicas'].length; j++) {
                            for (var k = 0; k < data[i]['caracteristicas'][j]['aspectos'].length; k++) {
                                for (var m = 0; m < data[i]['caracteristicas'][j]['aspectos'][k]['evidencias'].length; m++) {
                                    data_factor = data[i]['pk_factor'];
                                    data_factor_codigo = data[i]['codigo'];
                                    data_caracteristicas = data[i]['caracteristicas'][j]['pk_caracteristica'];
                                    data_caracteristicas_codigos = data[i]['caracteristicas'][j]['codigo'];
                                    data_aspectos = data[i]['caracteristicas'][j]['lista_aspectos'];
                                    data_evidencias = data[i]['caracteristicas'][j]['aspectos'][k]['lista_evidencias'];

                                }
                            }
                            lista += '<tr data-factor="'+data_factor+'" data-caracteristica="'+data_caracteristicas+'"  data-aspectos="'+data_aspectos+'"  data-evidencias="'+data_evidencias+'" data-factor_codigo="'+data_factor_codigo+'" data-caracteristica_codigo="'+data_caracteristicas_codigos+'"><td class="select-checkbox"></td><td>'+data[i]['codigo']+'</td><td>'+data[i]['caracteristicas'][j]['codigo']+'</td><td>'+data[i]['caracteristicas'][j]['codigo']+'- '+data[i]['caracteristicas'][j]['nombre']+'</td></tr>';
                        }
                    }
                    tabla.append(lista);
                    tabla.fadeIn(); 
                }
            }
        });
    }

    $sec = $('#seccion_doc').val();

    if($sec != "")
    {
        if($sec == "Crear_instrumento_caracteristica")
        {

            listaCaracteristicas();
            var table = $('#tabla_caracteristicas').DataTable({
                columnDefs: [{
                    'targets': 0,
                    'searchable': false,
                    'orderable': false,
                    'width': '1%',
                    'className': 'dt-body-center',
                    'render': function (data, type, full, meta){
                         return '<input type="checkbox" class="chk">';
                     }
                }],
                select: {
                    style:    'os',
                    selector: 'td:first-child'
                },
                order: [[ 1, 'asc' ]],
                rowCallback: function(row, data, dataIndex){
                     // Get row ID
                    var rowId = data[2];

                     // If row ID is in the list of selected row IDs
                    if($.inArray(rowId, rows_selected) !== -1){
                        $(row).find('input[type="checkbox"]').prop('checked', true);
                        $(row).addClass('selected');
                    }
                }
            });

        
            $('#tabla_caracteristicas').delegate('input[type="checkbox"]','click', function(e){

                  var datos = {};
                  var $row = $(this).closest('tr');
                  var factor = $row.data('factor');
                  var factor_codigo = $row.data('factor_codigo');
                  var aspecto = $row.data('aspectos');
                  var caracteristicas = $row.data('caracteristica');
                  var caracteristica_codigo = $row.data('caracteristica_codigo');
                  var evidencias = $row.data('evidencias');
                  datos['factor'] = factor;
                  datos['factor_codigo'] = factor_codigo;
                  datos['caracteristica'] = caracteristicas;
                  datos['caracteristica_codigo'] = caracteristica_codigo;
                  datos['aspectos'] = aspecto;
                  datos['evidencias'] = evidencias;

                  // Get row data
                  var data = table.row($row).data();
                  //console.log(data, data[2]);
                  // Get row ID
                  var rowId = data[2];

                  // alert(rowId);
                  // return false;


                  // Determine whether row ID is in the list of selected row IDs 
                  // var index = $.inArray(rowId, rows_selected);
                  // // If checkbox is checked and row ID is not in list of selected row IDs
                if(this.checked && !(rowId in rows_selected))
                {
                    rows_selected[rowId] = datos;
                } else if(!this.checked && (rowId in rows_selected)) {
                    delete rows_selected[rowId];
                }
                  // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
                  // } else if (!this.checked && index !== -1){
                  //    rows_selected.splice(index, 1);
                  // }

                  $('#id').val(JSON.stringify(rows_selected));

                  if(this.checked){
                     $row.addClass('selected');
                  } else {
                     $row.removeClass('selected');
                  }

                  // Update state of "Select all" control
                  updateDataTableSelectAllCtrl(table);

                  // Prevent click event from propagating to parent
                  e.stopPropagation();
            });

                        // Handle click on table cells with checkboxes
            $('#tabla_caracteristicas').on('click', 'tbody td, thead th:first-child', function(e){
                $(this).parent().find('input[type="checkbox"]').trigger('click');
            });

           // Handle click on "Select all" control
            $('thead input[name="select_all"]', table.table().container()).on('click', function(e){
                if(this.checked){
                    $('#tabla_caracteristicas tbody input[type="checkbox"]:not(:checked)').trigger('click');
                } else {
                    $('#tabla_caracteristicas tbody input[type="checkbox"]:checked').trigger('click');
                }

                // Prevent click event from propagating to parent
                e.stopPropagation();
            });

                // Handle table draw event
                table.on('draw', function(){
                // Update state of "Select all" control
                  updateDataTableSelectAllCtrl(table);
                });

               // Handle form submission event 

        }
    }

    // $('input[name="grupoInteres[]"]').change(function(e){
    //     alert($(this).val());
    //     if($(this).val() == 8){
    //         $('#selec_programa_2').css('display', 'none');
    //     }else{
    //         $('#selec_programa_2').css('display', 'block');
    //     }
    // });


    $('#B_guardarInstruCaracteristica').on('click', function(e){


        grupo_interes = $('input[name="grupoInteres[]"]').serializeArray();
        procesos = $('input[name="procesos[]"]').serializeArray();
        T_pregunta = $('textarea[name="T_pregunta"]').val();
        opc = $('input[name="opc"]').val();
        S_tipoRespuesta = $('select[name="S_tipoRespuesta"]').val();
        nuevo_tipo_respuesta = $('input[name="nuevo_tipo_respuesta"]').val();
        S_opcionesRespuesta = $('select[name="S_opcionesRespuesta"]').val();
        id = $('#id').val();

        $.ajax({
            url: '../Controlador/DOC_InstruEval_Controlador.php',
            type:  'post',
            async: false,
            dataType:'json',
            data:{
                operacion: "GuardarInstrumentoCaracteristica",
                grupo_interes : grupo_interes,
                instrumento : T_pregunta,
                tipo_respuesta: S_tipoRespuesta,
                porcentaje : nuevo_tipo_respuesta,
                opciones_respuesta: S_opcionesRespuesta,
                ids: id,
                procesos : procesos,
                opc : opc
            },
            success:  function (data) {
                $('#mensajes').html("");
                if(data == 2)
                {
                   window.scroll(0,0);
                   $('#mensajes').html("");
                    $('#mensajes').html("<h4 style='color:red'>Por favor ingrese todos los campos del formulario.</h4>");
                }else if(data == 1){
                    $('#mensajes').html("");
                    $('#mensajes').html("<h4 style='color:green'>Datos guardados satisfactoriamente.</h4>");
                    //div_emergente.find('.emergente > div[data-role="contenido"]').html('<p>El instrumento se guardo satisfactoriamente</p>');
                    //ocultar_emergente();
                    $('input[name="grupoInteres[]"]').attr('checked', false);
                    $('input[name="procesos[]"]').attr('checked', false);
                    $('textarea[name="T_pregunta"]').val('');
                    $('select[name="S_tipoRespuesta"]').val('');
                    $('input[name="nuevo_tipo_respuesta"]').val('');
                    $('select[name="S_opcionesRespuesta"]').val('');
                    $('.chk').attr('checked', false);
                    $('#tabla_caracteristicas tr').removeClass('selected');
                    $('#id').val('');
                    rows_selected = {};
                    


                }
            },
           
        });
        e.preventDefault();       
    });

        var cargarResultados = function(e){
        $.ajax({
            url: '../Controlador/DOC_Autoevaluacion_Controlador.php',
            type:  'post',
            async: false,
            dataType:'json',
            data:{
                operacion: "ResultadosPrograma",
                proceso : $('#procesos_resultados').val()
            },
            success:  function (data) {
                var row_caract = '';
                var row_fac = '';
                var descripcion = '';
                var calificacion = '';
                lista = '';
                $('#texto_total').html('');
                $('#texto_porcentaje').html('');
                $('#proceso_institucional').html('');
                var tabla_r = $('#tabla_resultados tbody');
                tabla_r.html('');
                $('#texto_total').append('<span>'+data.instrumentos+'</span>');
                $('#texto_porcentaje').append('<span>'+data.porcentaje_programa+'%</span>');
                $('#proceso_institucional').append('<span>'+data.institucional+'</span>');
                
               

                if(data.resultados.length != 0){
                $.each(data.resultados, function(i, e)
                {   

                    $.each(e, function(i2, e2)
                    {   
                        var car = new Array();
                        var fac = new Array();
                        var doc = new Array();
                        var calificacion = '';

                        $.each(e2.factores, function(i3, e3){
                            fac.push(e3.codigo);
                            
                            $.each(e3.caracteristicas, function(i4, e4){
                                car.push(e4.codigo);

                            });

                            row_caract = car.length;
                            

                        });
                        

                        $.each(e2.documentos, function(i8, e8){
                            doc.push(e8);
                        });

                        calificacion = e2.ponderacion == null ? 0 : e2.ponderacion;

                        row_fac = fac.length;

                        lista += '<tr>';
                            lista += '<td>'+e2.descripcion+'</td>';
                            
                            lista += '<td ><table class="inset-table" border="none" cellspacing="0" cellpadding="0">';
                            $.each(fac, function(i6, e6){
                                lista += '<tr><td>'+e6+'</td></tr>';
                            });
                            lista += '</table></td>';
                            
                            lista += '<td ><table class="inset-table" border="none" cellspacing="0" cellpadding="0">';
                            $.each(car, function(i7, e7){
                                lista += '<tr><td>'+e7+'</td></tr>';
                            });
                            lista += '</table></td>';

                            lista += '<td ><table class="inset-table" border="none" cellspacing="0" cellpadding="0">';
                                lista += '<tr><td>'+calificacion+'</td></tr>';
                            lista += '</table></td>';

                            lista += '<td ><table class="inset-table" border="none" cellspacing="0" cellpadding="0">';
                            $.each(doc, function(i9, e9){
                                lista += '<tr><td><a  href="'+e9.url+'" target="_blank">'+e9.nombre+'</a></td></tr>';
                            });
                            lista += '</table></td>';

                            
                        lista += '</tr>';

                        


                        
                                    
                            //         
                            //         // lista += '<td>'+descripcion+'</td>';
                            //         // lista += '<td>'+calificacion+'</td>';
                    });

                   

                    
                   


                });



                //             descripcion = e2.descripcion;
                //             calificacion = e2.ponderacion; 
                            
                //             lista_c = e2.fk_caracteristicas_codigo.split('|');
                //             lista_f = e2.fk_factor_codigo.split('|');

                //             //console.log(lista_c, lista_f);
                //             for(var j = 0; j < lista_c.length ; j++){
                //                 car = lista_c[j];
                                
                //                 for(var m = 0; m < lista_f.length; m++){
                //                     descripcion = data.resultados[i]['descripcion'];
                //                     calificacion = data.resultados[i]['ponderacion']; 
                //                     fac = lista_f[m];

                //                 }   
                //                 lista += '<tr>';
                //                         lista += '<td>'+fac+'</td>';
                //                         lista += '<td>'+car+'</td>';
                //                         lista += '<td>'+descripcion+'</td>';
                //                         lista += '<td>'+calificacion+'</td>';
                //                     lista += '</tr>';
                //             }
                    
                    

                    /*
                    for(var i = 0; i < data.resultados.length; i++){
                    
                        for(var k = 0; k < data.resultados[i].length; k++){
                    
                            $c = data.resultados[i][k]['fk_caracteristicas_codigo'];
                            console.log($c);

                            lista_c = $c.split('|');
                            // if(lista_c.length > 1){
                            //     tamaño = (lista_c.length)-1;
                            // }else{
                            //     tamaño = (lista_c.length);
                            // }

                            $f = data.resultados[i]['fk_factor_codigo'];

                            lista_f = $f.split('|');
                            // if(lista_f.length > 1){
                            //     tamaño_2 = (lista_f.length)-1;
                            // }else{
                            //     tamaño_2 = (lista_f.length);
                            // }

                            
                            for(var j = 0; j < lista_c.length ; j++){
                                car = lista_c[j];
                                
                                for(var m = 0; m < lista_f.length; m++){
                                    descripcion = data.resultados[i]['descripcion'];
                                    calificacion = data.resultados[i]['ponderacion']; 
                                    fac = lista_f[m];

                                }   
                                lista += '<tr>';
                                        lista += '<td>'+fac+'</td>';
                                        lista += '<td>'+car+'</td>';
                                        lista += '<td>'+descripcion+'</td>';
                                        lista += '<td>'+calificacion+'</td>';
                                    lista += '</tr>';
                            }
                        }
                    }
                    */
                    tabla_r.append(lista);
                    tabla_r.fadeIn(); 

                }else{
                    tabla_r.html('');
                }
            }
           
        });
        //e.preventDefault();      
    }

    $('#procesos_resultados').on('change', function(e){
        if($('#procesos_resultados').val != 0 ){
            cargarResultados();

        }
    });

    var cargarInstrumentos = function(e){
        $.ajax({
            url: '../Controlador/DOC_InstruEval_Controlador.php',
            type:  'post',
            async: false,
            dataType:'json',
            data:{
                operacion: "CargarInstrumentos",
                grupo : $('#lista_grupos').val()
            },
            success:  function (data) {
                lista = '';
                var tabla_r = $('#tabla_instrumentos tbody');
                tabla_r.html('');
                
                if(data.length != 0){
                    for(var i = 0; i < data.length; i++){ 
                        lista += '<tr data-id="'+data[i]['pk_instru_evaluacion']+'">';
                            lista += '<td>'+data[i]['descripcion']+'</td>';
                            lista += '<td  width="30px"><a href="#" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;<a href="#" style="color:red"><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
                        lista += '</tr>';
                        
                    }

                    tabla_r.append(lista);
                    tabla_r.fadeIn(); 

                }else{
                    tabla_r.html('');
                }
            }
           
        });
        //e.preventDefault();      
    }

    $('#lista_grupos').on('change', function(e){
        if($('#lista_grupos').val != 0 ){
            cargarInstrumentos();

        }
    });


    if( seccion == 'autoevaluacion_programa' || seccion == 'autoevaluacion_Institucional' ){
        //cargarInformacionFactor();
        cargarControlador(0 , $("input[name='grupoI']").val());
        cargarPaginador();
    }


    $('#GenerarInstrumentos').on('click', function(e){
        $.ajax({
            url: '../Controlador/DOC_Autoevaluacion_Controlador.php',
            type:  'post',
            async: false,
            dataType:'json',
            data:{
                operacion: "GenerarInstrumentos"
            },
            success:  function (data) {
                if(data == 1)
                {
                    alert('Instrumentos generados satisfactoriamente');
                }
            }
           
        });
    });


    $('#procesos_ponderacion').on('change', function(e){
        if($(this).val() != 0 ){
            $.ajax({
            url: '../Controlador/DOC_Autoevaluacion_Controlador.php',
            type:  'post',
            async: false,
            dataType:'json',
            data:{
                operacion: "Consolidado",
                proceso: $(this).val()
            },
            success:  function (data) {
                console.dir(data);
            }
           
        }); 
        }
    });




});

