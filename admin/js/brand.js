$(document).ready(function() {
    $('#add_button').click(function() {
        $('#user_form')[0].reset();
        $('.modal-title').text("Add Brand");
        $('#action').val("Add");
        $('#operation').val("Add");
        $('#user_uploaded_image').html('');
    });

    var dataTable = $('#user_data').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "./brand/fetchAll.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0, 3, 4],
            "orderable": false,
        }, ],
    });
    $(document).on('submit', '#user_form', function(event) {

        event.preventDefault();

        var brandName = $('#brandName').val();
        var address = $('#address').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var description = $('#description').val();
        var facebook = $('#facebook').val();
        var telegram = $('#telegram').val();
        var instagram = $('#instagram').val();
        var twitter = $('#twitter').val();
        var youtube = $('#youtube').val();
        var extension = $('#user_image').val().split('.').pop().toLowerCase();

        if (extension != '') {
            if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                alert("Invalid Image File");
                $('#user_image').val('');
                return false;
            }
        }
        
        if (brandName != '' && address != '' && phone != '') {
            $.ajax({
                url: "./brand/insert.php",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#user_form')[0].reset();
                    $('#userModal').modal('hide');
                    dataTable.ajax.reload();
                    return  toastr.success("Action Completed").css("margin-top", "2rem");
                }
            });
        } else {
            return  toastr.warning("Field Require!").css("margin-top", "2rem");
        }
    });

    $(document).on('click', '.update', function() {
        var user_id = $(this).attr("id");
        $.ajax({
            url: "./brand/update.php",
            method: "POST",
            data: {
                user_id: user_id
            },
            dataType: "json",
            success: function(data) {
                $('#userModal').modal('show');

                $('#brandName').val(data.brandName);
                $('#address').val(data.address);
                $('#phone').val(data.phone);
                $('#email').val(data.email);
                $('#description').val(data.description);
                $('#facebook').val(data.facebook);
                $('#telegram').val(data.telegram);
                $('#instagram').val(data.instagram);
                $('#twitter').val(data.twitter);
                $('#youtube').val(data.youtube);


                $('.modal-title').text("Edit Brand");
                $('#user_id').val(user_id);
                $('#user_uploaded_image').html(data.user_image);
                $('#action').val("Edit");
                $('#operation').val("Edit");
            }
        })
    });

    $(document).on('click', '.delete', function() {
        var user_id = $(this).attr("id");
        if (confirm("Are you sure you want to delete this?")) {
            $.ajax({
                url: "./brand/delete.php",
                method: "POST",
                data: {
                    user_id: user_id
                },
                success: function(data) {
                   
                    dataTable.ajax.reload();
                    return  toastr.success("Action Completed").css("margin-top", "2rem");
                }
            });
        } else {
            return false;
        }
    });
});