$(document).ready(function(){

    $('#comentarios-table-wrap').on('click', '.pagination a, .showcoment', function()    {
        var url = $(this).attr('href');
        if( !url ) return false;
        $('#comentarios-table-wrap').load( url, function() {
        });
        return false;
    });

    $("#formFilds").on('submit', function(){
        var comentario = $("#comentario_texto").val();
        var erro = 0;

        if( comentario.length < 10 ) {
            $('.min_comment').show();
            erro++;
        }

        if( erro === 0 ) {
            $.ajax({
                method: "POST",
                url: "comentar",
                async: true,
                cache: false,
                data: {
                    comentario: comentario
                }
             })
             .done(function( msg ) {
                  $(".form-modal-com").hide();
                  $(".form-modal-sucesso").show(500);
                  $(".close").click(function(){
                      location.reload();
                  });
              });
        }
        return false;
    });

    $('.custom-file-input').on('change',function(){
        var fileName = document.getElementById("exampleInputFile").files[0].name;
        $( '.custom-file-label' ).html(fileName);
    });
});

function apagar_comentario( id )
{
    $.ajax({
        method: "POST",
        url: "deletar-comentario/" + id,
        async: true,
        cache: false,
     })
     .done(function() {
         location.reload();
     });
}

function editar_comentario( id )
{
    $.ajax({
        method: "POST",
        url: "editar-comentario/" + id,
        async: true,
        cache: false,
        data: {
            comentario: $("#comentario_texto").val()
        }
     })
     .done(function() {
        location.reload();
     });
}
