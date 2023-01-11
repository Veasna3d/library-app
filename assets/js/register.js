
//btnSave
$('#btnSave').click(function () {
    var studentId = $('#txtStudentId');
    var studentName = $('#txtStudentName');
    var passoword = $('#txtPassword');
    if (studentId.val() == "" && studentName.val() == "" && passoword.val() == "") {
        studentId.focus();
        return toastr.warning("All Fields Require!").css("margin-top", "2rem");
    }
    var form_data = $('#form').serialize();
    if ($('#btnSave').text() == "Insert") {
        //Insert
        $.ajax({
            type: 'POST',
            url: 'register_json.php?data=add_student',
            data: form_data,
            dataType: 'json',
            success: function (data) {
                toastr.success("Action completed, Please login again").css("margin-top", "2rem");
              //  $('#myModal').modal('hide');
            },
            error: function (ex) {
                toastr.error("Action incomplete").css("margin-top", "2rem");
                console.log(ex.responseText);
            }
        });
    }
});

$('#btnAdd').click(function () {
    $('#txtStudentId').val("");
    $('#txtStudentName').val("");
    $('#txtPassword').val("");
    $('#btnSave').text("Insert");
});