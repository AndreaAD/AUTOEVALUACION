$(function(e){
	$('#H_opcion').val("ver_factor");
    $.ajax({
        url:   '../Controlador/PLM_ConsPlan_Control.php',
        type:  'post',
        dataType:'html',
        data: {
        	H_opcion : 'ver_factor',
        },
        success:  function (data) {
            $('.principal-panel-contenido').html(data);
        }
    });
});