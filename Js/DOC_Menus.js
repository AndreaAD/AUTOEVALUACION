function dirigir(_url){
    event.preventDefault();
    $.ajax({
        url:   _url,
        type:  'post',
        dataType:'html',
        data: {},
        success:  function (data) {
            $('.principal-panel-contenido').html(data);
        }
    });
}

function dirigir_subpanel(_url){
    event.preventDefault();
    $.ajax({
        url:   _url,
        type:  'post',
        dataType:'html',
        data: {},
        success:  function (data) {
            $('#sub-panel').html(data);
        }
    });
}

function enlazar_botones(){

    $('.sub-menu-modulo ul li').delegate('a', 'click', function(e){
        colorElementos($(this));
        $.ajax({
            url:   $(this).attr("href"),
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-contenido').html(data);
            }
        });
        e.preventDefault();
    });
}