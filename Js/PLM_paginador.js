function paginador($comienzo){
    
    var pag = $('#s_paginador').val();
    var num_pag = 0;
    
    
    var capa = document.getElementById("num_pag");
    
    var filas = 0;
     
    document.getElementById("num_pag").innerHTML="";

    filas = document.getElementById('T_tabla').rows.length;
    num_pag = Math.ceil((filas-1)/pag);

    $('#T_tabla tr').show(); 
    
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
				h1.setAttribute("style",'background: #000000;  border-radius: 0.8em;  -moz-border-radius: 0.8em;  -webkit-border-radius: 0.8em;  color: #ffffff;  display: inline-block;  font-weight: bold;  line-height: 1.2em;  margin-right: 6px;  text-align: center;  width: 1.2em;')           
                h1.setAttribute("href", '#');
                h1.setAttribute("onclick", 'paginador('+j+')');
                  h1.innerHTML = "<font color='white' size='2px'>"+j+"</font>";                
          }
            else{
                var h1 = document.createElement('a');
				h1.setAttribute("style",'background: #5EA226;  border-radius: 0.8em;  -moz-border-radius: 0.8em;  -webkit-border-radius: 0.8em;  color: #ffffff;  display: inline-block;  font-weight: bold;  line-height: 1.2em;  margin-right: 6px;  text-align: center;  width: 1.2em;')
                h1.setAttribute("href", '#');
                h1.setAttribute("onclick", 'paginador('+j+')');
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
        document.getElementById('T_tabla').rows[i].style.display = 'none';
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
            document.getElementById('T_tabla').rows[i].style.display = 'true';
        }
        else{
            document.getElementById('T_tabla').rows[i].style.display = 'none';
        }
    }
    /*******************************************************************/
        
}