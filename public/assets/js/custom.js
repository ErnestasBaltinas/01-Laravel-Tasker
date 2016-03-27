/**
 * Created by Ernestas on 2016-03-27.
 */

// A $( document ).ready() block.
$( document ).ready(function() {
    console.log( "ready!" );


    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var taskName = button.data('task-name');
        var taskDescription = button.data('task-description');
        var modal = $(this);
        var taskID =  button.data('task-id');
        var taskActionLink =  $('#editModal form').attr('action') + '/' + taskID;

        $('#editModal form').attr('action', taskActionLink);
        modal.find('.modal-body #task-name').val(taskName);
        modal.find('.modal-body #task-description').val(taskDescription);

    })
});
