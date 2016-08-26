/**
 * Created by anton on 25.08.16.
 */

$('#linkEditModalWindow').on('show.bs.modal', function(event){
    HandleItem($(this), event, '/links/modal-link-add',
        '/links/modal-link-edit', '#link_form', '.links-table', function(response){
        $('tr#link_'+response.id+'>.link-url').html(response.url);
        $('tr#link_'+response.id+'>.link-description').html(response.description);
    });
});

$(document).on('click', '.btn-delete-link', function (event) {
    DeleteItem($(event.currentTarget), '/links/delete-link', '#link_');
});