/**
 * Created by anton on 25.08.16.
 */

$('#emailEditModalWindow').on('show.bs.modal', function(event){
    HandleItem($(this), event, '/emails/modal-add',
        '/emails/modal-edit', '#email_form', '.emails-table', function(response){
            $('tr#email_'+response.id+'>.email-url').html(response.email);
        });
});

$(document).on('click', '.btn-delete-email', function (event) {
    DeleteItem($(event.currentTarget), '/emails/delete', '#email_');
});