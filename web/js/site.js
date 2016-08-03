/**
 * Created by anton on 03.08.16.
 */

$('#workModalWindow').on('show.bs.modal', function(e){
    var id = $(e.relatedTarget).data('id');



    $.get("portfolio/modal-work-view?workId=" + id, function(data){
        $('#workModalWindow').find('.modal-title').html(data.title);
        $('#workModalWindow').find('.modal-body').html(data.body);
    })
})