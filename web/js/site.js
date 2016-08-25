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

$('#changeAvatarModalWindow').on('show.bs.modal', function(e){
    var id = $(e.relatedTarget).data('id');

    var result;

    $.get("/portfolio/get-avatar?id=" + id, function(avatar){
        if (avatar) {
            avatar = '/public/' + avatar;
        } else {
            avatar = '/public/no-image.png';
        }

        var avatarImg = $('#changeAvatarModalWindow').find('img.img-avatar');

        avatarImg.attr('src', avatar);

        $('#avatar-change').on('change', function(e){
            var file = e.target.files[0];

            if (file.type.match('image.*')) {

                var fr = new FileReader();
                fr.onload = (function(theFile) {
                    return function(e) {
                        result = e.target.result;
                        avatarImg.attr('src', result);
                    };
                })(file);

                fr.readAsDataURL(file);
            }
        })

    });

    $('.btn-save-avatar').on('click', function(){
        $('.portfolio-avatar').attr('src', result);
        $('input[name=avatarData').attr('value', result);
        $('#changeAvatarModalWindow').modal('hide');
    })
});

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

        $.get("/portfolio/modal-link-add?userId=" + userId + "&portfolioId=" + portfolioId, function(data){
            $('#linkEditModalWindow').find('.modal-body').html(data.body);

            $('#link_form').submit(function(e){
                e.preventDefault();

                var formData = $(e.target).serialize();

                $.post("/portfolio/modal-link-add?userId=" + userId + "&portfolioId=" + portfolioId, formData, function(response){
                    if(response.result) {
                        $('#linkEditModalWindow').modal('hide');

                        $('table.links-table>tbody').append(response.link_line);
                    }
                });
            });
        });
    }

    function editLink() {
        $.get("/portfolio/modal-link-edit?linkId=" + id, function(data){
            $('#linkEditModalWindow').find('.modal-body').html(data.body);

            $('#link_form').submit(function(e){
                e.preventDefault();

                var formData = $(e.target).serialize();

                $.post("/portfolio/modal-link-edit?linkId=" + id, formData, function(response){
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
                url: "/portfolio/delete-link",
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