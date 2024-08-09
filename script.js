
$(document).ready(function() {

    // Toggle form visibility
    $('#toggleFormBtn').click(function() {
        $('#formContainer').toggleClass('hidden');
    });

    // Handle form submission
    $('#insertForm').on('submit', function(e) {  //works on submit 
        e.preventDefault();
        var formData = $(this).serialize(); // it will fetch form data and encode it as string and store it in formData
        
        $.ajax({
            url: 'insert.php',
            type: 'POST',
            data: formData,    // data to be sent to the server 
            success: function(response) {
                alert(response);
                $('#formContainer').addClass('hidden'); // Hide the form after submission
                $('#insertForm')[0].reset(); // Reset the form fields
                // Optionally, reload the records table or handle as needed
            },
            error: function() {
                alert('Error inserting record.');
            }
        });
    });
    // Handle update button click event
    $(document).on('click', '.edit-btn', function() {
        var row = $(this).closest('tr');
        row.find('.editable').each(function() {
            var field = $(this).data('field');
            var value = $(this).text();
            $(this).html('<input type="text" class="edit-field" name="' + field + '" value="' + value + '">');
        });
        $(this).text('Save').removeClass('edit-btn').addClass('save-btn');
    });

    // Handle save button click event
    $(document).on('click', '.save-btn', function() {
        var row = $(this).closest('tr');
        var id = row.data('id');
        var data = {};
        row.find('.edit-field').each(function() {
            var field = $(this).attr('name');
            var value = $(this).val();
            data[field] = value;
        });

        $.ajax({
            url: 'update.php',
            type: 'POST',
            data: {
                id: id,
                fields: data
            },
            success: function(response) {
                row.find('.editable').each(function() {
                    var field = $(this).data('field');
                    $(this).text(data[field]);
                });
                alert(response);
            },
            error: function() {
                alert('Error updating record.');
            }
        });

        $(this).text('Update').removeClass('save-btn').addClass('edit-btn');
    });

    // Handle delete button click
    $(document).on('click', '.delete-btn', function() {     //click event 
        if (confirm('Are you sure you want to delete this record?')) { 
            var row = $(this).closest('tr');    //fetch the table row closest ancestor
            var id = row.data('id'); // fetch id 

            $.ajax({
                url: 'delete.php',
                type: 'POST',
                data: {
                    id: id  // sending id only to the server 
                },
                success: function(response) {
                    row.remove();       // the row will be removed after the execution of the query on server side
                    alert(response);    
                },
                error: function() {
                    alert('Error deleting record.');
                }
            });
        }
    });

    // Handle bulk insert form submission
    $('#bulkInsertForm').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: 'bulk_insert.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#recordsTable').html(data);      // it will fetch data from the serverside(Database)
            }
        });
    });
});
