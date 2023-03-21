
function displayData() {
    $.ajax({
        url: 'category_json.php?data=get_category',
        type: 'GET',
        dataType: 'json',
        success: function(alldata) {
            var columns = [{
                title: "ID"
            }, {
                title: "CATEGORY NAME"
            },{
                title: "CREATE DATE"

            }, {
                title: "ACTION"
            }];
            var data = [];
            var option = '';
            for (var i in alldata) {
                option = "<button class='btn btn-success btn-sm edit btn-flat' data-toggle='modal' data-target='#myModal' onclick='editData(" +
                alldata[i][0] +
                ")'><i class='fa fa-edit'></i> </button> | <button class='btn btn-danger btn-sm delete btn-flat' onclick='deleteData(" +
                alldata[i][0] + ")'><i class='fa fa-trash'></i> </button> ";
                data.push([alldata[i][0], alldata[i][1],alldata[i][2], option]);
            }
            console.log(data);
            $('#table_id').DataTable({
                destroy: true,
                data: data,
                columns: columns
            });
        },
        error: function(e) {
            console.log(e.responseText);
        }
    });
}

//Load
$(document).ready(function() {
    displayData();
})


$('#btnSave').click(function() {
    var categoryName = $('#txtName');
    if(categoryName.val() == ""){
        categoryName.focus();
        return toastr.warning("Field Required!").css("margin-top", "2rem");
    }
    // Check if txtName already exists in database
    $.ajax({
        type: 'POST',
        url: 'category_json.php?data=check_category_name',
        data: {name: categoryName.val()},
        dataType: 'json',
        success: function(data) {
            if (data.exists) {
                categoryName.focus();
                toastr.warning("Name already exists in database!").css("margin-top", "2rem");
            } else {
                var form_data = $('#form').serialize();
                if ($('#btnSave').text() == "Insert") {
                    // Insert
                    $.ajax({
                        type: 'POST',
                        url: 'category_json.php?data=add_category',
                        data: form_data,
                        dataType: 'json',
                        success: function(data) {
                            toastr.success("Action completed").css("margin-top", "2rem");
                            displayData();
                            $('#myModal').modal('hide');
                        },
                        error: function(ex) {
                            toastr.error("Action incomplete").css("margin-top", "2rem");
                            console.log(ex.responseText);
                        }
                    });
                } else {
                    // Update
                    $.ajax({
                        type: 'POST',
                        url: 'category_json.php?data=update_category&id=' + category_id,
                        data: form_data,
                        dataType: 'json',
                        success: function(data) {
                            toastr.success("Action completed").css("margin-top", "2rem");
                            displayData();
                            $('#myModal').modal('hide');
                        },
                        error: function(ex) {
                            toastr.error("Action incomplete").css("margin-top", "2rem");
                            console.log(ex.responseText);
                        }
                    });
                }
            }
        },
        error: function(ex) {
            toastr.error("Error checking name in database").css("margin-top", "2rem");
            console.log(ex.responseText);
        }
    });
});

$('#btnAdd').click(function() {
    $('#txtName').val("");
    $('#btnSave').text("Insert");
});

var category_id;

function editData(id) {
    $('#btnSave').text("Update");
    category_id = id;
    $.ajax({
        url: 'category_json.php?data=get_byid',
        data: '&id=' + id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#txtName').val(data[0][1]);
        },
        error: function(ex) {
            console.log(ex.responseText);
        }
    });
}

function deleteData(id) {
    if (confirm('Are you sure')) {
        $.ajax({
            type: 'GET',
            url: 'category_json.php?data=delete_category&id=' + id,
            dataType: 'json',
            success: function(data) {
                // alert(data);
                toastr.success("Action completed").css("margin-top", "2rem");
                displayData();
            },
            error: function(ex) {
                toastr.error("Action incomplete").css("margin-top", "2rem");
                console.log(ex.responseText);
            }
        });
    }
}