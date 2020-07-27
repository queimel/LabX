$(document).on('ajax:success', function(e, xhr){
    if(!$('#modal').length){
        $('body').append($('<div class="modal fade" id="modal"></div>'))
    }
   $('#modal').html(xhr).modal('show');
   $("#modal").on('click', '#closeBtn',function(){
        $("#modal").modal('hide');
    });

    

    $('#modal').on('hidden.bs.modal', function () {
        $("#modal").remove();
    });
});