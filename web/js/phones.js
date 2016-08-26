/**
 * Created by anton on 25.08.16.
 */

$('#phoneEditModalWindow').on('show.bs.modal', function(event){
    HandleItem($(this), event, '/phones/modal-add',
        '/phones/modal-edit', '#phone_form', '.phones-table', function(response){
            $('tr#phone_'+response.id+'>.phone-number').html(response.number);
            $('tr#phone_'+response.id+'>.phone-note').html(response.note);
        });
});

$(document).on('click', '.btn-delete-phone', function (event) {
    DeleteItem($(event.currentTarget), '/phones/delete', '#phone_');
});