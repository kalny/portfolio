/**
 * Created by anton on 25.08.16.
 */

$('#linkEditModalWindow').on('show.bs.modal', function(e){

    var userId = $(e.relatedTarget).data('user-id');
    var portfolioId = $(e.relatedTarget).data('portfolio-id');

    var title = $(e.relatedTarget).data('title');
    var id = $(e.relatedTarget).data('id');

    $('#linkEditModalWindow').find('.modal-title').html(title);

    if(userId == undefined) {
        editLink();
    } else {

        addLink();
    }

    function addLink() {

        $.get("/links/modal-link-add?userId=" + userId + "&portfolioId=" + portfolioId, function(data){
            $('#linkEditModalWindow').find('.modal-body').html(data.body);

            $('#link_form').submit(function(e){
                e.preventDefault();

                var formData = $(e.target).serialize();

                $.post("/links/modal-link-add?userId=" + userId + "&portfolioId=" + portfolioId, formData, function(response){
                    if(response.result) {
                        $('#linkEditModalWindow').modal('hide');

                        $('table.links-table>tbody').append(response.link_line);
                    }
                });
            });
        });
    }

    function editLink() {
        $.get("/links/modal-link-edit?linkId=" + id, function(data){
            $('#linkEditModalWindow').find('.modal-body').html(data.body);

            $('#link_form').submit(function(e){
                e.preventDefault();

                var formData = $(e.target).serialize();

                $.post("/links/modal-link-edit?linkId=" + id, formData, function(response){
                    if(response.result) {
                        $('#linkEditModalWindow').modal('hide');

                        $('tr#link_'+response.id+'>.link-url').html(response.url);
                        $('tr#link_'+response.id+'>.link-description').html(response.description);
                    }
                });
            });
        });
    }
});

$(document).on('click', '.btn-delete-link', function (e) {

    var btn = $(e.currentTarget);
    var message = btn.data('msg');
    var id = btn.data('id');

    bootbox.confirm(message, function (result) {
        if (result) {

            $.ajax({
                type: "POST",
                url: "/links/delete-link",
                data: {'id': id},
                success: function(response) {
                    if (response) {
                        var portfolio = btn.parents('#link_' + id).hide(400);
                    }
                }
            });
        }
    })
});