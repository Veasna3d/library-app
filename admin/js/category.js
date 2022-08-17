
function displayData() {
    $.ajax({
        url: 'category_json.php?data=get_category',
        type: 'GET',
        dataType: 'json',
        success: function(alldata) {
            var columns = [{
                title: "Id"
            }, {
                title: "Category Name"
            }, {
                title: "Action"
            }];
            var data = [];
            var option = '';
            for (var i in alldata) {
                option =
                    "<i class='fa fa-pencil-square-o' data-toggle='modal' data-target='#myModal' onclick='editData(" +
                    alldata[i][0] +
                    ")'></i> | <i class='fa fa-trash' onclick='deleteData(" +
                    alldata[i][0] + ")'></i> ";
                data.push([alldata[i][0], alldata[i][1], option]);
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

//btnSave
$('#btnSave').click(function() {
    var form_data = $('#form').serialize();
    if ($('#btnSave').text() == "Insert") {
        //Insert
        $.ajax({
            type: 'POST',
            url: 'category_json.php?data=add_category',
            data: form_data,
            dataType: 'json',
            success: function(data) {
                alert(data);
                displayData();
                $('#myModal').modal('hide');
            },
            error: function(ex) {
                console.log(ex.responseText);
            }
        });
    } else {
        //Update
        $.ajax({
            type: 'POST',
            url: 'category_json.php?data=update_category&id=' + category_id,
            data: form_data,
            dataType: 'json',
            success: function(data) {
                alert(data);
                displayData();
                $('#myModal').modal('hide');
            },
            error: function(ex) {
                console.log(ex.responseText);
            }
        });
    }
});

$('#btnAdd').click(function() {
    $('#txtName').val();
    $('#btnSave').text("Insert");
});

var status_id;

function editData(id) {
    $('#btnSave').text("Update");
    status_id = id;
    $.ajax({
        url: 'category_json.php?data=get_byid',
        data: '&Id=' + id,
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
                alert(data);
                displayData();
            },
            error: function(ex) {
                console.log(ex.responseText);
            }
        });
    }
}