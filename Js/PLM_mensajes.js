$(function(e){


	var div_emergente = $('#div_emergente');
	var diligencia = $('#B_guardar_plan');	
	
	
	
	var objetivo=$('#T_objetivo');
	var acciones=$('#T_acciones');
	var area1=$('select[name="S_area"]').val();
	var area2=$('select[name="S_area2"]').val();
	var metas=$('#T_metas');
	var indicador=$('#T_indicador');
	var fechainicio=$('#T_fechainicio');
	var fechafin=$('#T_fechafin');
	var recursos=$('select[name="S_recurso"]').val();
	var valor1=$('#T_valor1');
	var valor2=$('#T_valor2');
	var valor3=$('#T_valor3');
	var rubro=$('select[name="S_rubro"]').val();
	
	
	$("#T_valor1").keydown(function(event) {
   if(event.shiftKey)
   {
        event.preventDefault();
   }

   if (event.keyCode == 46 || event.keyCode == 8)    {
   }
   else {
        if (event.keyCode < 95) {
          if (event.keyCode < 48 || event.keyCode > 57) {
                event.preventDefault();
          }
        } 
        else {
              if (event.keyCode < 96 || event.keyCode > 105) {
                  event.preventDefault();
              }
        }
      }
   });
  
	
	$("#T_valor2").keydown(function(event) {
   if(event.shiftKey)
   {
        event.preventDefault();
   }

   if (event.keyCode == 46 || event.keyCode == 8)    {
   }
   else {
        if (event.keyCode < 95) {
          if (event.keyCode < 48 || event.keyCode > 57) {
                event.preventDefault();
          }
        } 
        else {
              if (event.keyCode < 96 || event.keyCode > 105) {
                  event.preventDefault();
              }
        }
      }
   });
   
   
	$("#T_valor3").keydown(function(event) {
   if(event.shiftKey)
   {
        event.preventDefault();
   }

   if (event.keyCode == 46 || event.keyCode == 8)    {
   }
   else {
        if (event.keyCode < 95) {
          if (event.keyCode < 48 || event.keyCode > 57) {
                event.preventDefault();
          }
        } 
        else {
              if (event.keyCode < 96 || event.keyCode > 105) {
                  event.preventDefault();
              }
        }
      }
   });
  
	var cerrarEmergente = function(e){
	div_emergente.css('display','none');
	e.preventDefault();
	}
	var ocultar_emergente = function(){
		setTimeout(function(){ div_emergente.fadeOut("slow"); },2000)
	}
	
	div_emergente.find('.emergente span[data-rol="cerrar"]').on('click', function(e){
		div_emergente.css('display','none');
		e.preventDefault();
	});
	
	diligencia.on('click', function(e){
    	
	
	if(objetivo.val().length < 1)   
    {
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h2>Objetivo del proyecto vacío!!!</h2></p>');
		div_emergente.css('display','block');	
    } 	
	else if(acciones.val().length < 1)   
    {
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h2>Acciones del proyecto vacías!!!</h2></p>');
		div_emergente.css('display','block');	
    }  
	else if(metas.val().length < 1)   
    {
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h2>Metas del proyecto vacías!!!</h2></p>');
		div_emergente.css('display','block');	
    }
	else if(indicador.val().length < 1)   
    {
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h2>Indicadores del proyecto vacíos!!!</h2></p>');
		div_emergente.css('display','block');	
    }
	else if(Date.parse(fechainicio.val()) >= Date.parse(fechafin.val()))
    {
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h2>La fecha inicial no puede ser mayor o igual a la final!!!</h2></p>');
		div_emergente.css('display','block');	
    }
	else if(_temp==0 )   
    {
		if(valor1.val().length < 1 )   
		{
			div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h2>Inversión 1 del proyecto vacía!!!</h2></p>');
			div_emergente.css('display','block');
		}
		else if(valor2.val().length < 1 )   
		{
			div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h2>Inversión 2 del proyecto vacía!!!</h2></p>');
			div_emergente.css('display','block');
		}
		else if(valor3.val().length < 1 )   
		{
			div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h2>Inversión 3 del proyecto vacía!!!</h2></p>');
			div_emergente.css('display','block');
		}	
		else
		{  
			if(rubro=="")
			{
				div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h2>El rubro esta vacío</h2></p>');
				div_emergente.css('display','block');	
			}
			else
			{
			 	
				$.ajax({
					url:   '../Controlador/PLM_LlenarPlan_Control.php',
					 type:  'post',
					dataType:'html',
					data: $('#guardar_plan').serialize(),
					success:  function (data) {
					   
							$('.principal-panel-contenido').html(data);    
							
					}   
			   });
			}		   
		}
    }
    else if(_temp==1 )   
    {
			if(rubro=="")
			{
				div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h2>El rubro esta vacío</h2></p>');
				div_emergente.css('display','block');	
			}
			else
			{		
				$.ajax({
					url:   '../Controlador/PLM_LlenarPlan_Control.php',
					 type:  'post',
					dataType:'html',
					data: $('#guardar_plan').serialize(),
					success:  function (data) {
					   
							$('.principal-panel-contenido').html(data);    
							
					}   
			   });
			}	
	}	   
    });   
   
});