function colorModulos(){
    $(".sub-menu-modulo").each(function(i){
        var color=$(this).find("#color-modulo").val();
        var contenedor=$("body").find("#prueba-color");
        var colorRojo=parseInt(color[0]+color[1],16);
        var colorVerde=parseInt(color[2]+color[3],16);
        var colorAzul=parseInt(color[4]+color[5],16);
        //contenedor.html(contenedor.html()+"<div style=\"Background-color:rgb("+colorRojo+","+colorVerde+","+colorAzul+");\">Color "+i+":"+color+"</div></br>");
        contenedor.html(contenedor.html()+"<div style=\"Background-color:rgb("+colorRojo+","+colorVerde+","+colorAzul+");\">Color "+i+":"+color+"</div>");
        var colorRojo1=colorRojo;
        var colorVerde1=colorVerde;
        var colorAzul1=colorAzul;
        //------------------
        var colorRojo1=colorRojo-40;
        var colorVerde1=colorVerde-40;
        var colorAzul1=colorAzul-40;
        if(colorRojo1<=0){colorRojo1=0;}
        if(colorVerde1<=0){colorVerde1=0;}
        if(colorAzul1<=0){colorAzul1=0;}
        contenedor.html(contenedor.html()+"<div style=\"Background-color:rgb("+colorRojo1+","+colorVerde1+","+colorAzul1+");\">Color :"+colorRojo1+","+colorVerde1+","+colorAzul1+"</div>");
        var colorRojo1=colorRojo-80;
        var colorVerde1=colorVerde-80;
        var colorAzul1=colorAzul-80;
        if(colorRojo1<=0){colorRojo1=0;}
        if(colorVerde1<=0){colorVerde1=0;}
        if(colorAzul1<=0){colorAzul1=0;}
        contenedor.html(contenedor.html()+"<div style=\"Background-color:rgb("+colorRojo1+","+colorVerde1+","+colorAzul1+");\">Color :"+colorRojo1+","+colorVerde1+","+colorAzul1+"</div>");
        var colorRojo1=colorRojo-100;
        var colorVerde1=colorVerde-100;
        var colorAzul1=colorAzul-100;
        if(colorRojo1<=0){colorRojo1=0;}
        if(colorVerde1<=0){colorVerde1=0;}
        if(colorAzul1<=0){colorAzul1=0;}
        contenedor.html(contenedor.html()+"<div style=\"Background-color:rgb("+colorRojo1+","+colorVerde1+","+colorAzul1+");\">Color :"+colorRojo1+","+colorVerde1+","+colorAzul1+"</div>");
        contenedor.html(contenedor.html()+"</br>");
        
        var titulo=$(this).parent().find(".modulo-base");
        r=colorRojo-80;
        g=colorVerde-80;
        b=colorAzul-80;
        $(this).css("background-color","rgb("+r+","+g+","+b+")");
        r=colorRojo;
        g=colorVerde;
        b=colorAzul;
        titulo.css("background-color","rgb("+r+","+g+","+b+")");
    });
}

function getStyleRule(name) {
	//alert("document.styleSheets.length="+document.styleSheets.length);
	//for(var i=0; i<document.styleSheets.length; i++) {
		var ix, sheet = document.styleSheets[2];
		if(sheet.cssRules){
			//alert("sheet.cssRules.length="+document.styleSheets[2].cssRules.length);
            //alert("Regla:"+document.styleSheets[2].cssRules[4].selectorText);
	        for (ix=0; ix<sheet.cssRules.length; ix++) {
	            if (sheet.cssRules[ix].selectorText === name)
	                return sheet.cssRules[ix].style;            	
	        }
		}
		if(sheet.rules){
			//alert("sheet.rules.length="+document.styleSheets[2].rules.length);
            //alert("Regla:"+document.styleSheets[2].rules[4].selectorText);
	        for (ix=0; ix<sheet.rules.length; ix++) {
	        	//alert(sheet.rules[ix]);
		        if(sheet.rules[ix]){
		            if (sheet.rules[ix].selectorText === name)
		               return sheet.rules[ix].style;
		        }
		    }
		}
	//}
    return null;
}
    
function colorElementos(_fuente){
    //boton>li>ul>sub-menu-modulo>
    var colorFuente=$(_fuente).parent().parent().parent().find("#color-modulo").val();
    //alert("color base :"+colorFuente); 
    var rojo=parseInt(colorFuente[0]+colorFuente[1],16)-30;
    var verde=parseInt(colorFuente[2]+colorFuente[3],16)-30;
    var azul=parseInt(colorFuente[4]+colorFuente[5],16)-30; 
    if(rojo<=0){rojo=0;}
    if(verde<=0){verde=0;}
    if(azul<=0){azul=0;} 
    var regla=getStyleRule(".bloque > .titulo-bloque");
    if(regla!=null){
        regla.backgroundColor="rgba("+rojo+","+verde+","+azul+",1)";
    }
    regla=getStyleRule(".boton-icono:hover");
    if(regla!=null){
        regla.backgroundColor="rgba("+rojo+","+verde+","+azul+",1)";
    }
    regla=getStyleRule(".control-checkbox > input[type=\""+"checkbox"+"\"]:checked + .checkbox-label");
    if(regla!=null){
        regla.backgroundColor="rgba("+rojo+","+verde+","+azul+",1)";
    }
    regla=getStyleRule(".control-radiobutton > input[type=\""+"radio"+"\"]:checked + .radiobutton-label");
    if(regla!=null){
        regla.backgroundColor="rgba("+rojo+","+verde+","+azul+",1)";
    }
    
    //alert(regla);
    $("#poly2").css("fill","rgb("+(rojo-50)+","+(verde-50)+","+(azul-50)+")");
    $("#poly6").css("fill","rgb("+(rojo-50)+","+(verde-50)+","+(azul-50)+")");
    
    $("#poly1").css("fill","rgba("+(rojo+20)+","+(verde+20)+","+(azul+20)+",1)");
    $("#poly4").css("fill","rgba("+(rojo+20)+","+(verde+20)+","+(azul+20)+",1)");
    
    $("#poly3").css("fill","rgb("+(rojo-70)+","+(verde-70)+","+(azul-70)+")");
    
    $("#poly5").css("fill","rgba("+(rojo+40)+","+(verde+40)+","+(azul+40)+",1)");
    
    $("#poly7").css("fill","rgb("+(rojo-15)+","+(verde-15)+","+(azul-15)+")");
    
    regla=getStyleRule("input[type=\"button\"], input[type=\"submit\"], input[type=\"reset\"], button[type=\"reset\"], button[type=\"button\"], button[type=\"submit\"], button, a.boton-normal");
    if(regla!=null){
        regla.backgroundImage="linear-gradient(to top,rgba("+(rojo+30)+","+(verde+30)+","+(azul+30)+",1),rgba("+(rojo-30)+","+(verde-30)+","+(azul-30)+",1))";
    }
    regla=getStyleRule("input[type=\"button\"]:hover, input[type=\"submit\"]:hover, input[type=\"reset\"]:hover, button[type=\"reset\"]:hover, button[type=\"button\"]:hover, button[type=\"submit\"]:hover, button:hover, a.boton-normal:hover");
    if(regla!=null){
        /*regla.backgroundImage="linear-gradient(to bottom,rgba("+(rojo+30)+","+(verde+30)+","+(azul+30)+",1),rgba("+(rojo-30)+","+(verde-30)+","+(azul-30)+",1))";
        */
        regla.backgroundColor="rgb("+(rojo+40)+","+(verde+40)+","+(azul+40)+")";
    }
    regla=getStyleRule(".boton-icono");
    if(regla!=null){
        regla.border="2px solid rgb("+(rojo+10)+","+(verde+10)+","+(azul+10)+")";
    }
    regla=getStyleRule(".grupo-controles-formulario .controles-formulario input[type=\"text\"] + .texto-ayuda i:hover, .grupo-controles-formulario .controles-formulario input[type=\"password\"] + .texto-ayuda i:hover, .grupo-controles-formulario .controles-formulario textarea + .texto-ayuda i:hover");
    if(regla!=null){
         regla.backgroundColor="rgba("+(rojo)+","+(verde)+","+(azul)+",1)";
    }
    regla=getStyleRule("form select option:nth-child(2n)");
    if(regla!=null){
         regla.backgroundColor="rgba("+(rojo+50)+","+(verde+50)+","+(azul+50)+",0.6)";
    }
}