
$(document).ready(function() {
    $('#btnSave').text("Insert");
})
//btnSave
$('#btnSave').click(function () {
    // var studentId = $('#txtStudentId');
    // var studentName = $('#txtStudentName');
    // var passoword = $('#txtPassword');
    // if (studentId.val() == "" && studentName.val() == "" && passoword.val() == "") {
    //     studentId.focus();
    //     return toastr.warning("All Fields Require!").css("margin-top", "2rem");
    // }
    var form_data = $('#contact-form').serialize();
    if ($('#btnSave').text() == "Insert") {
        //Insert
        $.ajax({
            type: 'POST',
            url: 'contact_json.php?data=add_contact',
            data: form_data,
            dataType: 'json',
            success: function (data) {
                $('#txtFullName').val("");
                $('#txtEmail').val("");
                $('#txtDescripton').val("");
                toastr.success("Thank For Your Contact Us😍").css("margin-top", "2rem");
                
            },
            error: function (ex) {
                toastr.error("Action incomplete").css("margin-top", "2rem");
                console.log(ex.responseText);
            }
        });
    }
});


 
   
