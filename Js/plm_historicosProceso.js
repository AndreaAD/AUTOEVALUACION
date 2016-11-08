
$(function(e){
	$('#H_opcion').val("ver_procesos_historico");
    $.ajax({
        url:   '../Controlador/PLM_ConsPlan_Control.php',
        type:  'post',
        dataType:'html',
        data: {
        	H_opcion : 'ver_procesos_historico',
        },
        success:  function (data) {
            $('.principal-panel-contenido').html(data);
        }
    });
});