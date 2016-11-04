$(function(e){
	$('#H_opcion').val("ver_procesos");
    $.ajax({
        url:   '../Controlador/PLM_ConsPlan_Control.php',
        type:  'post',
        dataType:'html',
        data: {
        	H_opcion : 'ver_procesos',
        },
        success:  function (data) {
            $('.principal-panel-contenido').html(data);
        }
    });
});