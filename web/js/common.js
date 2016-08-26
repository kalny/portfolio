/**
 * Created by anton on 26.08.16.
 */

function HandleItem(modalWindow, event, addRoute, editRoute, formId, tableClass, callback) {
    var btn = $(event.relatedTarget);

    var userId = btn.data('user-id');
    var portfolioId = btn.data('portfolio-id');

    var title = btn.data('title');
    var id = btn.data('id');

    modalWindow.find('.modal-title').html(title);

    if(userId == undefined) {
        editItem();
    } else {
        addItem();
    }

    function addItem() {

        $.get(addRoute + "?userId=" + userId + "&portfolioId=" + portfolioId, function(data){
            modalWindow.find('.modal-body').html(data.body);

            $(formId).submit(function(e){
                e.preventDefault();

                var formData = $(e.target).serialize();

                $.post(addRoute + "?userId=" + userId + "&portfolioId=" + portfolioId, formData, function(response){
                    if(response.result) {
                        modalWindow.modal('hide');

                        $('table' + tableClass + '>tbody').append(response.item_line);
                    }
                });
            });
        });
    }

    function editItem() {
        $.get(editRoute + "?itemId=" + id, function(data){
            modalWindow.find('.modal-body').html(data.body);

            $(formId).submit(function(e){
                e.preventDefault();

                var formData = $(e.target).serialize();

                $.post(editRoute + "?itemId=" + id, formData, function(response){
                    if(response.result) {
                        modalWindow.modal('hide');

                        callback(response);
                    }
                });
            });
        });
    }
}

function DeleteItem(button, route, rowId) {
    var message = button.data('msg');
    var id = button.data('id');

    bootbox.confirm(message, function (result) {
        if (result) {

            $.ajax({
                type: "POST",
                url: route,
                data: {'id': id},
                success: function(response) {
                    if (response) {
                        button.parents(rowId + id).hide(400);
                    }
                }
            });
        }
    })
}