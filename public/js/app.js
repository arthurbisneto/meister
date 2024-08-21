$(document).ready(function() {
    loadTasks();

    // Load tasks
    function loadTasks() {
        $.ajax({
            url: '/tasks',
            method: 'GET',
            success: function(data) {
                $('#task-list').html(data);
            }
        });
    }

    // Show create/edit modal with pre-filled data
    $(document).on('click', '.edit-btn', function() {
        let id = $(this).data('id');
        $.ajax({
            url: '/tasks/' + id + '/edit',
            method: 'GET',
            success: function(data) {
                $('#taskId').val(data.id);
                $('#title').val(data.title);
                $('#description').val(data.description);
                $('#status').val(data.status);
                $('#taskModalLabel').text('Edit Task');
                $('#taskModal').modal('show');
            }
        });
    });

    // Create or update task
    $('#taskForm').on('submit', function(e) {
        e.preventDefault();
        let id = $('#taskId').val();
        let method = id ? 'PUT' : 'POST';
        let url = id ? '/tasks/' + id : '/tasks';

        $.ajax({
            url: url,
            method: method,
            data: $(this).serialize(),
            success: function(data) {
                $('#taskModal').modal('hide');
                loadTasks();
            }
        });
    });

    // Delete task
    $(document).on('click', '.delete-btn', function() {
        let id = $(this).data('id');
        if (confirm('Are you sure you want to delete this task?')) {
            $.ajax({
                url: '/tasks/' + id,
                method: 'DELETE',
                success: function(data) {
                    loadTasks();
                }
            });
        }
    });
});
