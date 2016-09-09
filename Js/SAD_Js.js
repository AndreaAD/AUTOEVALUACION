/* funcion para cerrar las ventanas emergente de inicio de sesion, cerrar sesion cambiar contraseña y restaurar contraseña*/
function CancelarDatosLoggin($url){
    
    window.location = $url;
    
}
/**************************************************************************************************************************/

/************************* funcion para cerrar la sesion donde se destrullen todas las variables de sesion ****************/
function CerrarLoggin($url){
    
    window.location = $url;
    
}
/**************************************************************************************************************************/

/****************** funciones para abrir los grupos, sub grupos y actividades seleccionadas *******************************/
function AbrirPagina($url, $pk_modulo, $pk_grupo, $pk_sub_grupo){
    
    $.ajax({
        url:   $url+'?pk_modulo='+$pk_modulo+'&pk_grupo='+$pk_grupo+'&pk_sub_grupo='+$pk_sub_grupo,
        type:  'get',
        dataType:'html',
        data: "",
        success:  function (data) {
                    $('.principal-panel-contenido').html(data);                 
        }
   });
                    
   AbrirSubPagina('../Vista/VIS_Vacio_Vista.php', '0', '0', '0');
   
    return false;
    
}

function AbrirSubPagina($url2, $pk_modulo, $pk_grupo, $pk_sub_grupo){
    
    $.ajax({
        url:   $url2+'?pk_modulo='+$pk_modulo+'&pk_grupo='+$pk_grupo+'&pk_sub_grupo='+$pk_sub_grupo,
        type:  'get',
        dataType:'html',
        data: "",
        success:  function (data) {
                    $('.principal-panel-sub-contenido').html(data);
        }
   });
    return false;
    
}

function Abrir($urlMenu, $urlPagina){
    $.ajax({
        url:   $urlMenu,
        type:  'get',
        dataType:'html',
        data: "",
        success:  function (data) {
                    $('.principal-panel-contenido').html(data);
        }
   });
    $.ajax({
        url:   $urlPagina,
        type:  'get',
        dataType:'html',
        data: "",
        success:  function (data) {
                    $('.principal-panel-sub-contenido').html(data);
        }
   }); 
   
    return false;
    
}
/**************************************************************************************************************************/

/************* finciones para validacion de campos como correo, de solo texto y solo numero *******************************/
function ValidarCorreo(){
    
    var email = $("#correo").val();
    
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{1,4})+$/;
    
    if ( !expr.test(email) )
        $('#parrafo').html("Estado del Correo : es incorrecta.");
    else
        $('#parrafo').html("");
        
}

function ValidarNumero(evt){
    
    var charCode = (evt.which) ? evt.which : event.keyCode
    
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    
    return true;

}

function ValidarTexto(evt){
    
    var charCode = (evt.which) ? evt.which : event.keyCode
    
    if (charCode > 31 && (charCode != 32) && (charCode < 65) || (charCode > 90) && (charCode < 97) || (charCode > 122))
        return false;
        
    return true;

}       
/**************************************************************************************************************************/

/******************************************** enpaginador de una tabla ****************************************************/
function tabla2 (){
    // Con estas 3 líneas sobreescribimos el Constains para que no sea case sensitive pues por default en jquery  viene con case sensitive. Si no lo pones, queda como Case sensitive
    $.expr[':'].Contains = function(x, y, z){
        return jQuery(x).text().toLowerCase().indexOf(z[3].toLowerCase())>=0;
    };
    /*$.expr[':'].icontains = function(obj, index, meta, stack){
    return (obj.textContent || obj.innerText || jQuery(obj).text() || '').toLowerCase().indexOf(meta[3].toLowerCase()) >= 0;
    };*/
    // cada que escribamos, vamos a revisar lo que hay escrito 
    $('#buscador').keyup(function()     {
        //tomamos el valor que tiene el input
        var search = $('#buscador').val();
        //mostramos todos los valores, para despues ir ocultando los que no coinciden
        $('#tabla_datos tr').show();        
        //esto es para revisar si tenemos algo que buscar, sino, que no lo haga.
        if(search.length>0)
        {
                $("#tabla_datos tr td.letras").not(":Contains('"+search+"')").parent().hide();
            
        }
    });
}

function paginador($comienzo){
    
    var pag = $('#s_paginador').val();
    var num_pag = 0;
    
    var estado = $('#estado').val();
    
    var capa = document.getElementById("num_pag");
    
    var filas = 0;
     
    document.getElementById("num_pag").innerHTML="";

    filas = document.getElementById('lista').rows.length;
    num_pag = Math.ceil((filas-1)/pag);

    $('#lista tr').show(); 
    
    var i = 0;
    var j = 0;
    var inicio = 0;
    
    for(i=1; i<$comienzo; i++){
        inicio=parseInt(inicio)+parseInt(pag);
    }
       
    /**/
    if(num_pag>1){
        if($comienzo==1){    
            var h1 = document.createElement('a');
            h1.setAttribute("href", '#');
            h1.setAttribute("onclick", 'paginador('+1+')');
            h1.innerHTML = "<font color='black'> Anterior. </font>";
        }
        else if($comienzo>1){
            var h1 = document.createElement('a');
            h1.setAttribute("href", '#');
            h1.setAttribute("onclick", 'paginador('+($comienzo-1)+')');
            h1.innerHTML = "<font color='black'> Anterior. </font>";        
        }
                
        capa.appendChild(h1);
    }
    /**/
    if(num_pag>1){
        for(j=1; j<=num_pag; j++){
            
            if(j!=$comienzo){
                var h1 = document.createElement('a');
                h1.setAttribute("href", '#');
                h1.setAttribute("onclick", 'paginador('+j+')');
                h1.innerHTML = "<font color='black'> "+j+". </font>";
            }
            else{
                var h1 = document.createElement('a');
                h1.setAttribute("href", '#');
                h1.setAttribute("onclick", 'paginador('+j+')');
                h1.innerHTML = "<font color='red'> "+j+". </font>";
            }
            
            capa.appendChild(h1);
            
        }
    }
    /**/
    if(num_pag>1){
        if($comienzo==1){
            var h1 = document.createElement('a');
            h1.setAttribute("href", '#');
            h1.setAttribute("onclick", 'paginador('+2+')');
            h1.innerHTML = "<font color='black'> Siguiente. </font>";        
        }
        else if($comienzo<(num_pag-1)){
            var h1 = document.createElement('a');
            h1.setAttribute("href", '#');
            h1.setAttribute("onclick", 'paginador('+($comienzo+1)+')');
            h1.innerHTML = "<font color='black'> Siguiente. </font>";        
        }
        else if($comienzo==(num_pag-1)){
            var h1 = document.createElement('a');
            h1.setAttribute("href", '#');
            h1.setAttribute("onclick", 'paginador('+(num_pag-1)+')');
            h1.innerHTML = "<font color='black'> Siguiente. </font>";        
        }
                
        capa.appendChild(h1);
    }
    
    /******************************************************************/
    
    /********* Se muestra los elementos segun sea la pagina ***********/
    
    for(i = 1; i <= inicio; i++){
        document.getElementById('lista').rows[i].style.display = 'none';
    }
    var fin=0;
    if(inicio > 0){
        inicio = parseInt(inicio)+1;
        fin=parseInt(inicio)+parseInt(pag)-1;
    }else{
        fin = parseInt(inicio)+parseInt(pag);
    }
    
    
    for(i = inicio; i < filas; i++){
        if(i <= fin){                     
            document.getElementById('lista').rows[i].style.display = 'true';
        }
        else{
            document.getElementById('lista').rows[i].style.display = 'none';
        }
    }
    /*******************************************************************/
        
}
/**************************************************************************************************************************/

function paginador_filtro($comienzo){
    
    var pag = parseInt($('#s_paginador').val());
    
    var estado = $('#estado').val();
    
    var inputRadio_EU=document.getElementsByName('radio'), inputCheck_EU=document.getElementsByName('check[]');
        
    var filas = 0, num_pag = 0, filas_total = 0;
    
    var array_check =  new Array();
    var array_no_check = new Array();
    
    var inici_array_check = 0;
    var inici_array_no_check = 0;
       
    var num_elementos = 0;    
    var num_interacciones = 1;
    
    var capa = document.getElementById("num_pag");
    
    document.getElementById("num_pag").innerHTML="";

    $('#lista tr').show(); 
    
    for(i=1; i<=$comienzo; i++){
        num_elementos +=pag;
    }
    
    if(estado == 'filtrar' || estado == 'filtrar_todo'){ 
        if(inputRadio_EU.length > 0){
            filas_total = inputRadio_EU.length;
            num_pag = Math.ceil(filas_total/pag);
        }
        else if(inputCheck_EU.length > 0){
            filas_total = inputCheck_EU.length;
            num_pag = Math.ceil(filas_total/pag);
        }
    }
    else if(estado == 'filtrar_check'){          
        if(inputCheck_EU.length > 0){
            filas_total = inputCheck_EU.length;
        }
        for(j=0; j<inputCheck_EU.length; j++) {
            if(inputCheck_EU.item(j).checked == false){  
                array_no_check[inici_array_no_check] = j;
                inici_array_no_check++;
            }
            else if(inputCheck_EU.item(j).checked == true){       
                filas++;
                array_check[inici_array_check] = j;
                inici_array_check++;
            }
        }             
          
        num_pag = Math.ceil((filas)/pag);
    }
    else if(estado == 'filtrar_no_check'){        
        if(inputCheck_EU.length > 0){
            filas_total = inputCheck_EU.length;
        }
        for(j=0; j<inputCheck_EU.length; j++) {
            if(inputCheck_EU.item(j).checked == false){      
                filas++;
                array_no_check[inici_array_no_check] = j;
                inici_array_no_check++;
            }
            else if(inputCheck_EU.item(j).checked == true){   
                array_check[inici_array_check] = j;
                inici_array_check++;
            }
        }             
          
        num_pag = Math.ceil((filas)/pag);
    }
    else{
        if(inputRadio_EU.length > 0){
            filas_total = inputRadio_EU.length;
            num_pag = Math.ceil(filas_total/pag);
        }
        if(inputCheck_EU.length > 0){
            filas_total = inputCheck_EU.length;
            num_pag = Math.ceil(filas_total/pag);
        }
    }
    
    /**/
    if(num_pag>1){
        if($comienzo==1){    
            var h1 = document.createElement('a');
            h1.setAttribute("href", '#');
            h1.setAttribute("onclick", "paginador_filtro("+1+")");
            h1.innerHTML = "<font color='black'> Anterior. </font>";
        }
        else if($comienzo>1){
            var h1 = document.createElement('a');
            h1.setAttribute("href", '#');
            h1.setAttribute("onclick", "paginador_filtro("+($comienzo-1)+")");
            h1.innerHTML = "<font color='black'> Anterior. </font>";        
        }
                
        capa.appendChild(h1);
    }
    /**/
    if(num_pag>1){
        for(j=1; j<=num_pag; j++){
            
            if(j!=$comienzo){
                var h1 = document.createElement('a');
                h1.setAttribute("style",'background: #000000;  border-radius: 0.8em;  -moz-border-radius: 0.8em;  -webkit-border-radius: 0.8em;  color: #ffffff;  display: inline-block;  font-weight: bold;  line-height: 1.2em;  margin-right: 6px;  text-align: center;  width: 1.2em;')
                h1.setAttribute("href", '#');
                h1.setAttribute("onclick", "paginador_filtro("+j+")");
                h1.innerHTML = "<font color='white' size='2px'>"+j+"</font>";                
            }
            else if(j==$comienzo){
                var h1 = document.createElement('a');
                h1.setAttribute("style",'background: #5EA226;  border-radius: 0.8em;  -moz-border-radius: 0.8em;  -webkit-border-radius: 0.8em;  color: #ffffff;  display: inline-block;  font-weight: bold;  line-height: 1.2em;  margin-right: 6px;  text-align: center;  width: 1.2em;')
                h1.setAttribute("href", '#');
                h1.setAttribute("onclick", "paginador_filtro("+j+")");
                h1.innerHTML = "<font color='white' size='2px'>"+j+"</font>";
            }
            
            capa.appendChild(h1);
            
        }
    }
    /**/
    if(num_pag>1){
        if($comienzo==1){
            var h1 = document.createElement('a');
            h1.setAttribute("href", '#');
            h1.setAttribute("onclick", "paginador_filtro("+2+")");
            h1.innerHTML = "<font color='black'> Siguiente. </font>";        
        }
        else if($comienzo<num_pag){
            var h1 = document.createElement('a');
            h1.setAttribute("href", '#');
            h1.setAttribute("onclick", "paginador_filtro("+($comienzo+1)+")");
            h1.innerHTML = "<font color='black'> Siguiente. </font>";        
        }
        else if($comienzo==num_pag){
            var h1 = document.createElement('a');
            h1.setAttribute("href", '#');
            h1.setAttribute("onclick", "paginador_filtro("+num_pag+")");
            h1.innerHTML = "<font color='black'> Siguiente. </font>";        
        }
                
        capa.appendChild(h1);
    }
    
    /******************************************************************/
        
    if(inputRadio_EU.length > 0){
        for(i=0; i<filas_total; i++){
            if(num_interacciones <= pag && i>=(num_elementos-pag)){
                document.getElementById('lista').rows[i+1].style.display = 'true';
                num_interacciones++;
            }
            else{
                document.getElementById('lista').rows[i+1].style.display = 'none';                    
            }
        }
    }    
    else if(inputCheck_EU.length > 0){
        if(estado == 'filtrar_check'){
            for(i=0; i<array_no_check.length; i++){
                document.getElementById('lista').rows[array_no_check[i]+1].style.display = 'none';
            }
            for(i=0; i<array_check.length; i++){
                if(num_interacciones <= pag && i>=(num_elementos-pag)){
                    document.getElementById('lista').rows[array_check[i]+1].style.display = 'true';
                    num_interacciones++;
                }
                else{
                    document.getElementById('lista').rows[array_check[i]+1].style.display = 'none';                    
                }
            }
        }
        else if(estado == 'filtrar_no_check'){  
            for(i=0; i<array_check.length; i++){
                document.getElementById('lista').rows[array_check[i]+1].style.display = 'none';
            }
            for(i=0; i<array_no_check.length; i++){
                if(num_interacciones <= pag && i>=(num_elementos-pag)){
                    document.getElementById('lista').rows[array_no_check[i]+1].style.display = 'true';
                    num_interacciones++;
                }
                else{
                    document.getElementById('lista').rows[array_no_check[i]+1].style.display = 'none';                    
                }
            }
        }
        else if(estado == 'filtrar_todo' || estado == 'filtrar'){  
            for(i=0; i<filas_total; i++){
                if(num_interacciones <= pag && i>=(num_elementos-pag)){
                    document.getElementById('lista').rows[i+1].style.display = 'true';
                    num_interacciones++;
                }
                else{
                    document.getElementById('lista').rows[i+1].style.display = 'none';                    
                }
            }
        }
        else{
           for(i=0; i<filas_total; i++){
                if(num_interacciones <= pag && i>=(num_elementos-pag)){
                    document.getElementById('lista').rows[i+1].style.display = 'true';
                    num_interacciones++;
                }
                else{
                    document.getElementById('lista').rows[i+1].style.display = 'none';                    
                }
            } 
        }
    }
    
}
/**************************************************************************************************************************/

/*  */
function Lista_Emergente(_this,url,idVentana){
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

function sad_seleccionarTabla(_this,url,fuente,idVentana){
    var id=$(_this).parent().find("#id").val();
    var texto=$(_this).parent().parent().find("#texto").html();
    texto=id+". "+texto;
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

/**************************************************************************************************************************/

/*************************** funcion para el guardado de los usuario nuevos ***********************************************/
function ValidarDatos($url){
    
    expreCorreo = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    
    /******************* Validacion de los campos para los Usuario al Ingresar ********************************/    
    if ( document.getElementById( "nombre" )) {
        if($("#nombre").val() == "" ) {        
            $('#obligatorio_nombre').html("Obligatorio");
            }
        else{
            $('#obligatorio_nombre').html("");
        }
    }
    
    if ( document.getElementById( "apellido" )) {
        if($("#apellido").val() == ""){        
            $('#obligatorio_apellido').html("Obligatorio");
        }
        else{
            $('#obligatorio_apellido').html("");
        }
    }
    
    if ( document.getElementById( "cedula" )) {
        if($("#cedula").val() == ""){        
            $('#obligatorio_cedula').html("Obligatorio");
        }
        else{
            $('#obligatorio_cedula').html("");
        }
    }
    
    if ( document.getElementById( "correo" )) {
        if($("#correo").val() == "" || !expreCorreo.test($("#correo").val())){        
            $('#obligatorio_correo').html("Obligatorio");
            $('#parrafo').html("Estado del Correo : es incorrecta.");
        }
        else{
            $('#obligatorio_correo').html("");
            $('#parrafo').html("");
        }
    }
    
    if ( document.getElementById( "rol" )) {
        if($("#rol").val() == "0"){        
            $('#obligatorio_rol').html("no ha escogido un rol");
        }
        else{
            $('#obligatorio_rol').html("");
        }
    }
    
    if ( document.getElementById( "programa" )) {
        if($("#programa").val() == "0"){        
            $('#obligatorio_programa').html("no ha escogido un programa");
        }
        else{
            $('#obligatorio_programa').html("");
        }
    }
    
    if ( document.getElementById( "obligatorio_tipo_usuario" )) {
        var variCheck = 0, inputCheck=document.getElementsByName("pk_tipo_usuario[]")
        
        for(j=0;j<inputCheck.length;j++) {
            if(inputCheck.item(j).checked == false) {
                variCheck++;
            }
        }
        
        if(variCheck == inputCheck.length) {
            $('#obligatorio_tipo_usuario').html("no ha escogido un tipo de usuario");
            //return false;
        } 
        else {
            $('#obligatorio_tipo_usuario').html("");
        }
    }
    
    /**********************************************************************************************************/
    if ( document.getElementById( "descripcion" )) {
        if($("#descripcion").val() == ""){        
            $('#obligatorio_descripcion').html("Obligatorio");
        }
        else{
            $('#obligatorio_descripcion').html("");
        }
    }
    /******************* Es la validacion para los campos del Usuario al Ingresarlo a la BD *******************/    
    if($("#nombre").val() != "" && $("#apellido").val() != "" && $("#cedula").val() != "" &&
        $("#correo").val() != "" && $("#rol").val() != "0" && $("#programa").val() != "0" && 
        expreCorreo.test($("#correo").val()) && inputCheck.length != variCheck){
        
        EnviarDatos($url);
        
    }    
    /**********************************************************************************************************/ 
}

function ValidarDatosRTO($url){
    /**********************************************************************************************************/
    if ( document.getElementById( "descripcion" )) {
        if($("#descripcion").val() == ""){        
            $('#obligatorio_descripcion').html("Obligatorio");
        }
        else{
            $('#obligatorio_descripcion').html("");
        }
    }
    if ( document.getElementById( "nombre" )) {
        if($("#nombre").val() == ""){        
            $('#obligatorio_nombre').html("Obligatorio");
        }
        else{
            $('#obligatorio_nombre').html("");
        }
    }
    /******************* Es la validacion para los campos del Usuario al Ingresarlo a la BD *******************/    
    
    /******* Es la validacion encargada para el filtrado de los roles, tipo usuario, entre otros **************/
    if($("#nombre").val() != "" && $("#descripcion").val() != ""){
        EnviarDatos($url);
    }
    /**********************************************************************************************************/ 

    /******************* validacion al momento de añadirle unas actividades a un usuario **********************/
    /***************** validacion para la tabal de tipo radio de los usuarios *********************************/
    if ( document.getElementById( "obligatorio_usuario" )) {
        var variRadio_UA = 0, inputRadio_UA=document.getElementsByName("pk_usuario")
        
        for(j=0;j<inputRadio_UA.length;j++) {
            if(inputRadio_UA.item(j).checked == false) {
                variRadio_UA++;
            }
        }
        
        if(variRadio_UA == inputRadio_UA.length) {
            $('#obligatorio_usuario').html("No ha seleccionado un usuario.");
            return false;
        } 
        else {
            $('#obligatorio_usuario').html("");
            FiltrarDato($url);
        }
    }    
    
    return false;
    
}
/**************************************************************************************************************************/

/**/
function ValidarDatosModulo($url){
    
    if ( document.getElementById( "nombre" )) {
        if($("#nombre").val() == "" ) {        
            $('#obligatorio_nombre').html("Obligatorio");
            }
        else{
            $('#obligatorio_nombre').html("");
        }
    }
    
    if ( document.getElementById( "descripcion" )) {
        if($("#descripcion").val() == ""){        
            $('#obligatorio_descripcion').html("Obligatorio");
        }
        else{
            $('#obligatorio_descripcion').html("");
        }
    }
    
    if ( document.getElementById( "url" )) {
        if($("#url").val() == "0"){        
            $('#obligatorio_url').html("no ha escogido una url");
        }
        else{
            $('#obligatorio_url').html("");
        }
    }
    
    /**** Es la validacion encargada para el filtrado de los modulos, grupos, sub grupos y actividades ********/
    if($("#nombre").val() != "" && $("#descripcion").val() != "" && $("#url").val() != "0"){
        EnviarDatos($url);
    }
    /**********************************************************************************************************/ 

}
/**************************************************************************************************************************/

/**/
function ValidarDatosGrupo($url){
    
    if ( document.getElementById( "nombre" )) {
        if($("#nombre").val() == "" ) {        
            $('#obligatorio_nombre').html("Obligatorio");
            }
        else{
            $('#obligatorio_nombre').html("");
        }
    }
    
    if ( document.getElementById( "descripcion" )) {
        if($("#descripcion").val() == ""){        
            $('#obligatorio_descripcion').html("Obligatorio");
        }
        else{
            $('#obligatorio_descripcion').html("");
        }
    }
    
    if ( document.getElementById( "url" )) {
        if($("#url").val() == "0"){        
            $('#obligatorio_url').html("no ha escogido una url");
        }
        else{
            $('#obligatorio_url').html("");
        }
    }
    
    if ( document.getElementById( "modulo" )) {
        if($("#modulo").val() == "0"){        
            $('#obligatorio_modulo').html("no ha escogido un modulo");
        }
        else{
            $('#obligatorio_modulo').html("");
        }
    }
    
    /**** Es la validacion encargada para el filtrado de los modulos, grupos, sub grupos y actividades ********/
    if($("#nombre").val() != "" && $("#descripcion").val() != "" && $("#url").val() != "0"
            && $("#modulo").val() != "0"){
        EnviarDatos($url);
    }
    /**********************************************************************************************************/ 

}
/**************************************************************************************************************************/

/**/
function ValidarDatosSubGrupo($url){
    
    if ( document.getElementById( "nombre" )) {
        if($("#nombre").val() == "" ) {        
            $('#obligatorio_nombre').html("Obligatorio");
            }
        else{
            $('#obligatorio_nombre').html("");
        }
    }
    
    if ( document.getElementById( "descripcion" )) {
        if($("#descripcion").val() == ""){        
            $('#obligatorio_descripcion').html("Obligatorio");
        }
        else{
            $('#obligatorio_descripcion').html("");
        }
    }
    
    if ( document.getElementById( "url" )) {
        if($("#url").val() == "0"){        
            $('#obligatorio_url').html("no ha escogido una url");
        }
        else{
            $('#obligatorio_url').html("");
        }
    }
    
    if ( document.getElementById( "grupo" )) {
        if($("#grupo").val() == "0"){        
            $('#obligatorio_grupo').html("no ha escogido un grupo");
        }
        else{
            $('#obligatorio_grupo').html("");
        }
    }
    
    /**** Es la validacion encargada para el filtrado de los modulos, grupos, sub grupos y actividades ********/
    if($("#nombre").val() != "" && $("#descripcion").val() != "" && $("#url").val() != "0"
            && $("#grupo").val() != "0"){
        EnviarDatos($url);
    }
    /**********************************************************************************************************/ 

}
/**************************************************************************************************************************/

/**/
function ValidarDatosActividad($url){
    
    if ( document.getElementById( "nombre" )) {
        if($("#nombre").val() == "" ) {        
            $('#obligatorio_nombre').html("Obligatorio");
            }
        else{
            $('#obligatorio_nombre').html("");
        }
    }
    
    if ( document.getElementById( "descripcion" )) {
        if($("#descripcion").val() == ""){        
            $('#obligatorio_descripcion').html("Obligatorio");
        }
        else{
            $('#obligatorio_descripcion').html("");
        }
    }
    
    if ( document.getElementById( "url" )) {
        if($("#url").val() == "0"){        
            $('#obligatorio_url').html("no ha escogido una url");
        }
        else{
            $('#obligatorio_url').html("");
        }
    }
    
    if ( document.getElementById( "fk_grupo" )) {
        if($("#fk_grupo").val() == "0"){        
            $('#obligatorio_grupo').html("no ha escogido un grupo");
        }
        else{
            $('#obligatorio_grupo').html("");
        }
    }
    
    if ( document.getElementById( "fk_sub_grupo" )) {
        if($("#fk_sub_grupo").val() == "0"){        
            $('#obligatorio_sub_grupo').html("no ha escogido un sub grupo");
        }
        else{
            $('#obligatorio_sub_grupo').html("");
        }
    }
    
    /**** Es la validacion encargada para el filtrado de los modulos, grupos, sub grupos y actividades ********/
    if($("#nombre").val() != "" && $("#descripcion").val() != "" && $("#url").val() != "0"
            && $("#fk_grupo").val() != "0"&& $("#fk_sub_grupo").val() != "0"){
        EnviarDatos($url);
    }
    /**********************************************************************************************************/ 

}
/**************************************************************************************************************************/

/*************************** funcion para el guardado de los usuario nuevos ***********************************************/
function ValidarDatosProceso($url){
    
    expreCorreo = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    
    /******************* Validacion de los campos para los Usuario al Ingresar ********************************/    
    if ( document.getElementById( "nombre" )) {
        if($("#nombre").val() == "" ) {        
            $('#obligatorio_nombre').html("Obligatorio");
            }
        else{
            $('#obligatorio_nombre').html("");
        }
    }
    
    if ( document.getElementById( "fase" )) {
        if($("#fase").val() == "0"){        
            $('#obligatorio_fase').html("no ha escogido una fase");
        }
        else{
            $('#obligatorio_fase').html("");
        }
    }
    
    if ( document.getElementById( "programa" )) {
        if($("#programa").val() == "0"){        
            $('#obligatorio_programa').html("no ha escogido un programa");
        }
        else{
            $('#obligatorio_programa').html("");
        }
    }
    
    /**********************************************************************************************************/
    if ( document.getElementById( "descripcion" )) {
        if($("#descripcion").val() == ""){        
            $('#obligatorio_descripcion').html("Obligatorio");
        }
        else{
            $('#obligatorio_descripcion').html("");
        }
    }
    /**********************************************************************************************************/
    if ( document.getElementById( "observacion" )) {
        if($("#observacion").val() == ""){        
            $('#obligatorio_observacion').html("Obligatorio");
        }
        else{
            $('#obligatorio_observacion').html("");
        }
    }
    /**********************************************************************************************************/
    if ( document.getElementById( "fechaI" )) {
        if($("#fechaI").val() == ""){        
            $('#obligatorio_fechaI').html("Obligatorio");
        }
        else{
            $('#obligatorio_fechaI').html("");
        }
    }
    /**********************************************************************************************************/
    if ( document.getElementById( "fechaF" )) {
        if($("#fechaF").val() == ""){        
            $('#obligatorio_fechaF').html("Obligatorio");
        }
        else{
            $('#obligatorio_fechaF').html("");
        }
    }
    /******************* Es la validacion para los campos del Usuario al Ingresarlo a la BD *******************/    
    if($("#nombre").val() != "" && $("#fechaI").val() != "" && $("#fechaF").val() != "" && $("#descripcion").val() != "" &&
        $("#observacion").val() != "" && $("#fase").val() != "0" && $("#programa").val() != "0" ){
        
        EnviarDatos($url);
        
    } 
    
    return false;
    
}
/**************************************************************************************************************************/

/****************************************** Validacion encargada para agregar programas ***********************************/
function ValidacionPrograma($url){
    
    if ( document.getElementById( "nombre" )) {
        if($("#nombre").val() == "" ) {        
            $('#obligatorio_nombre').html("Obligatorio");
            }
        else{
            $('#obligatorio_nombre').html("");
        }
    }
    
    if ( document.getElementById( "descripcion" )) {
        if($("#descripcion").val() == ""){        
            $('#obligatorio_descripcion').html("Obligatorio");
        }
        else{
            $('#obligatorio_descripcion').html("");
        }
    }
    
    if ( document.getElementById( "obligatorio_sede_prograna" )) {
        if($("#sede").val() == "0"){        
            $('#obligatorio_sede_prograna').html("no ha escogido una sede");
        }
        else{
            $('#obligatorio_sede_prograna').html("");
        }
    }
    
    if ( document.getElementById( "obligatorio_facultad_programa" )) {
        if($("#facultad").val() == "0"){        
            $('#obligatorio_facultad_programa').html("no ha escogido una facultad");
        }
        else{
            $('#obligatorio_facultad_programa').html("");
        }
    }
    
    /****************************** Es la validacion para agregar el programa *********************************/
    if($("#nombre").val() != "" && $("#descripcion").val() != "" && 
        $("#sede").val() != "0" && $("#facultad").val() != "0"){
        EnviarDatos($url);
    }
    /**********************************************************************************************************/ 
    
}
/**************************************************************************************************************************/
/****************************************** Validacion encargada para agregar programas ***********************************/
function ValidacionCaracteristica($url){
    
    if ( document.getElementById( "nombre" )) {
        if($("#nombre").val() == "" ) {        
            $('#obligatorio_nombre').html("Obligatorio");
            }
        else{
            $('#obligatorio_nombre').html("");
        }
    }
    
    if ( document.getElementById( "descripcion" )) {
        if($("#descripcion").val() == ""){        
            $('#obligatorio_descripcion').html("Obligatorio");
        }
        else{
            $('#obligatorio_descripcion').html("");
        }
    }
    
    if ( document.getElementById( "obligatorio_factor" )) {
        if($("#factor").val() == "0"){        
            $('#obligatorio_factor').html("no ha escogido un factor");
        }
        else{
            $('#obligatorio_factor').html("");
        }
    }
    
    /****************************** Es la validacion para agregar el programa *********************************/
    if($("#nombre").val() != "" && $("#descripcion").val() != "" && 
        $("#factor").val() != "0"){
        EnviarDatos($url);
    }
    /**********************************************************************************************************/ 
    
}
/**************************************************************************************************************************/

/************************************** Validacion para los Cambios de Estados ********************************************/
function ValidarEstado($url, $hidden){
    
    var variRadio_UA = 0, inputRadio_EU=document.getElementsByName('radio'), inputCheck_EU=document.getElementsByName('check[]')
    
    if(inputRadio_EU.length > 0){
        for(j=0;j<inputRadio_EU.length;j++) {
            if(inputRadio_EU.item(j).checked == false) {
                variRadio_UA++;
            }
        }
        
        if(variRadio_UA == inputRadio_EU.length) {
            $('#obligatorio').html("No ha seleccionado alguna opcion.");
            return false;
        } 
        else {
            $('#obligatorio').html("");
            EstadoDatos($url, $hidden);
        }  
    }
    if(inputCheck_EU.length > 0){
        for(j=0;j<inputCheck_EU.length;j++) {
            if(inputCheck_EU.item(j).checked == false) {
                variRadio_UA++;
            }
        }
        
        if(variRadio_UA == inputCheck_EU.length) {
            $('#obligatorio').html("No ha seleccionado alguna opcion.");
            return false;
        } 
        else {
            $('#obligatorio').html("");
            EstadoDatos($url, $hidden);
        }
    }
}
/**************************************************************************************************************************/

/************************************** Exportar a Excel ********************************************/
function ExportarExcel($url, $hidden){
    
    
    $("#T_Estado").val($hidden);
    
    var data = new FormData();
    
    $.ajax({
        url:$url, //Url a donde la enviaremos
		type:'POST', //Metodo que usaremos
		contentType:false, //Debe estar en false para que pase el objeto sin procesar
		data:data, //Le pasamos el objeto que creamos con los archivos
		processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
		cache:false, //Para que el formulario no guarde cache
   });
   
    return false;
    
            
}
/**************************************************************************************************************************/

/************************************** Validacion el ingreso de la ponderacion *******************************************/
function ValidarPonderacion($url, $hidden){
    
    var variRadio_UA = 0, inputCheck_EU=document.getElementsByName('check[]')
    var ponderacion = 0, nombre;
    
    if(inputCheck_EU.length > 0){
        for(j=0;j<inputCheck_EU.length;j++) {
            if(inputCheck_EU.item(j).checked == false) {
                variRadio_UA++;
            }
            nombre = "#ponderacion"+inputCheck_EU.item(j).value;
            if($(nombre).val() != ""){
                ponderacion = parseInt(ponderacion)+ parseInt($(nombre).val());
            }
        }
        
        if(ponderacion > 100) {
            $('#obligatorio').html("La ponderacion total debe ser menor : "+ponderacion);
            return false;
        } 
        else if(ponderacion < 100) {
            $('#obligatorio').html("La ponderacion total debe ser mayor : "+ponderacion);
            return false;
            
        }
        else {
            $('#obligatorio').html("");
            EnviarDatos($url, $hidden);
        }
    }            
       
}
/**************************************************************************************************************************/

/*************************************** funcion para serializar los formularios ******************************************/
function EnviarDatos($url){
    
    $("#T_Estado").val("guardar");
    
    $.ajax({
        url:   $url,
        type:  'post',
        dataType:'html',
        data: $('#formulario').serialize(),
            success:  function (data) {
                        $('.principal-panel-sub-contenido').html(data);
                        $("#ventana-error").fadeToggle();    
            } 
    });
    
}
/**************************************************************************************************************************/

/****************************** Cambiar el estado de Inhabilitado a Habilitado segun sea el caso **************************/

function EstadoDatos($url, $hidden){
    
    $("#T_Estado").val($hidden);
    
    $.ajax({
        url:   $url,
        type:  'post',
        dataType:'html',
        data: $('#formulario').serialize(),
            success: function (data) { 
                        $('.principal-panel-sub-contenido').html(data);
                        if($hidden == "cambiar_estado"){
                            $("#ventana-error").fadeToggle();   
                        }
                        if($hidden == "guardar_actividad"){
                            $("#ventana-error").fadeToggle();   
                        }
                        if($hidden == "guardar_usuario"){
                            $("#ventana-error").fadeToggle();   
                        }
            }
   });
   
    return false;
    
}
/**************************************************************************************************************************/

/************************************** fincion para el filtrado de las tablas ********************************************/
function FiltrarDato($url, $select){

    $("#T_Estado").val("filtrar");
    
    $.ajax({
        url:   $url,
        type:  'post',
        dataType:'html',
        data: $('#formulario').serialize(),
        success:  function (data) {
            if($select == "programa"){
                    $("#programa").html(data);
            }
            else if($select == "fase"){
                    $("#fase").html();
            }
            else if($select == "fk_sub_grupo"){
                    $("#fk_sub_grupo").html(data);
            }
            else if($select == "fk_grupo"){
                    $("#fk_grupo").html(data);
            }
            else{
                $('.principal-panel-sub-contenido').html(data);
            }
        } 
    }); 
      
}
/**************************************************************************************************************************/

/************************************** fincion para el filtrado de las tablas ********************************************/
function FiltrarDatoProceso($url, $select){

    $("#Estado_Session").val("filtrar");
    
    $.ajax({
        url:   $url,
        type:  'post',
        dataType:'html',
        data: $('#formulario_proceso').serialize(),
        success:  function (data) {
            if($select == "fase"){
                    $("#fase").html();
            }
        } 
    }); 
      
}
/**************************************************************************************************************************/
  
/************************************** fincion para el filtrado de las tablas ********************************************/
function FiltrarCheck($url, $select){

    $("#T_Estado").val($select);
    
    $.ajax({
        url:   $url,
        type:  'post',
        dataType:'html',
        data: $('#formulario').serialize(),
        success:  function (data) {
                $('.principal-panel-sub-contenido').html(data);
        } 
    }); 
      
}
/**************************************************************************************************************************/
  
function EnviarFile($url){
    
    $("#T_Estado").val("guardar");
    
	var archivos = document.getElementById("file");//Damos el valor del input tipo file
	var archivo = archivos.files; //Obtenemos el valor del input (los arcchivos) en modo de arreglo
	//obtener el valor del select pero con jquery selector es el id del select que necesitamos
	
    //El objeto FormData nos permite crear un formulario pasandole clave/valor para poder enviarlo 
	var data = new FormData();
	//Como no sabemos cuantos archivos subira el usuario, iteramos la variable y al 
	//objeto de FormData con el metodo "append" le pasamos calve/valor, usamos el indice "i" para
	//que no se repita, si no lo usamos solo tendra el valor de la ultima iteracion
	for(i=0; i<archivo.length; i++){
		data.append('archivo'+i,archivo[i]);	
	}
	
	$.ajax({
		url:$url, //Url a donde la enviaremos
		type:'POST', //Metodo que usaremos
		contentType:false, //Debe estar en false para que pase el objeto sin procesar
		data:data, //Le pasamos el objeto que creamos con los archivos
		processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
		cache:false, //Para que el formulario no guarde cache    
        success:  function (data) {
            $('.principal-panel-sub-contenido').html(data);
            $("#ventana-error").fadeToggle(); 
        } 
	}).done(function(msg){
		$("#cargados").append(msg); //Mostrara los archivos cargados en el div con el id "Cargados"
	});	
    
    return false;
    
}

/**/

function update_calendar(nombre){
	var month = $('#calendar_mes-'+nombre).attr('value');
	var year = $('#calendar_anio-'+nombre).attr('value');

	var valores='month='+month+'&year='+year+'&nombre='+nombre;

	$.ajax({
		url: '../Modelo/CNA_Set_Calendario_Modelo.php',
		type: "GET",
		data: valores,
		success: function(datos){
			$("#calendario_dias-"+nombre).html(datos);
		}
	});
}
	
function set_date(date, nombre, calendario_select){
	//input text donde debe aparecer la fecha
	$(nombre).attr('value',date);
	show_calendar('#calendario-'+calendario_select);
}

function show_calendar(nombre){
	//div donde se mostrará calendario
	//$('#calendario').toggle();
    $(nombre).fadeToggle();
}	