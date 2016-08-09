/**
 * Created by anton on 03.08.16.
 */

$('#workModalWindow').on('show.bs.modal', function(e){
    var id = $(e.relatedTarget).data('id');



    $.get("/portfolio/modal-work-view?workId=" + id, function(data){
        $('#workModalWindow').find('.modal-title').html(data.title);
        $('#workModalWindow').find('.modal-body').html(data.body);
    })
});

$(document).on('click', '.btn-delete-portfolio', function (e) {

    var btn = $(e.currentTarget);
    var message = btn.data('msg');
    var id = btn.data('id');

    bootbox.confirm(message, function (result) {
        if (result) {

            $.ajax({
                type: "POST",
                url: "/portfolio/delete",
                data: {'id': id},
                success: function(response) {
                    if (response) {
                        var portfolio = btn.parents('.portfolio-item').hide(400);
                    }
                }
            });
        }
    })
});