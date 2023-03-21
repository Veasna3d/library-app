
function displayData() {
    $.ajax({
        url: "student_json.php?data=get_student",
        type: "GET",
        dataType: "json",
        success: function (alldata) {
            var columns = [
                {
                    title: "ID",
                },
                {
                    title: "STUDENT ID",
                },
                {
                    title: "STUDENT NAME",
                },
                {
                    title: "PASSWORD",
                },
                {
                    title: "IMAGE",
                },{
                    title: "CLASS",
                }, {
                    title: "PHONE",
                }, {
                    title: "EMAIL",
                },
                {
                    title: "CREATE DATE",
                },
                {
                    title: "ACTIONS",
                },
            ];
            var data = [];
            var option = "";
            for (var i in alldata) {
                option =
                    "<button class='btn btn-success btn-sm edit btn-flat' data-toggle='modal' data-target='#myModal' onclick='editData(" +
                    alldata[i][0] +
                    ")'><i class='fa fa-edit'></i> </button> | <button class='btn btn-danger btn-sm delete btn-flat' onclick='deleteData(" +
                    alldata[i][0] + ")'><i class='fa fa-trash'></i> </button>";
                data.push([
                    alldata[i][0],
                    alldata[i][1],
                    alldata[i][2],
                    alldata[i][3],
                    "<img style='width: 50px; height: 50px;' src='upload/" + alldata[i][4] + "'>",
                    alldata[i][5],
                    alldata[i][6],
                    alldata[i][7],
                    alldata[i][8],
                    option,
                ]);
            }
            console.log(data);
            $("#table_id").DataTable({
                destroy: true,
                data: data,
                columns: columns,
            });
        },
        error: function (e) {
            console.log(e.responseText);
        },
    });
}

function setDataToSelect(myselect, myjson, caption) {
    try {
        var sel = $(myselect);
        sel.empty();
        sel.append('<option value="">' + caption + "</option>");
        $.ajax({
            url: myjson,
            dataType: "json",
            success: function (s) {
                for (var i = 0; i < s.length; i++) {
                    sel.append(
                        '<option value="' + s[i][0] + '">' + s[i][1] + "</option>"
                    );
                }
            },
            error: function (e) {
                console.log(e.responseText);
            },
        });
    } catch (err) {
        console.log(err.message);
    }
}

//Load
$(document).ready(function () {
    displayData();
    setDataToSelect("#ddlClass", "student_json.php?data=get_class", "--Class--");
});

//btnSave
$("#btnSave").click(function () {

    var studentId = $("#txtStudentId");
    var studentName = $("#txtStudentName");
    var password = $("#txtPassword");
    var classId = $("#ddlClass");
    
    if (studentId.val() == "") {
        studentId.focus();
        return toastr.warning("Field Require!").css("margin-top", "2rem");
    }else if(studentId.val() == ""){
      studentId.focus();
      return toastr.warning("Student ID Require!").css("margin-top", "2rem");
    }else if(studentName.val() == ""){
        studentName.focus();
        return toastr.warning("Student Name Require!").css("margin-top", "2rem");
      }else if (password.val() == "") {
        password.focus();
        return toastr.warning("Password Require!").css("margin-top", "2rem");
    } else if (password.val().length > 4) {
        password.focus();
        return toastr.warning("Password must be less than 5 characters long!").css("margin-top", "2rem");
    } else if (classId.val() == "") {
        classId.focus();
        return toastr.warning("Class Require!").css("margin-top", "2rem");
    }


    var form_data = new FormData($("#form")[0]); // Use FormData object to include file data
    if ($("#btnSave").text() == "Insert") {
        //Insert
        $.ajax({
            type: "POST",
            url: "student_json.php?data=add_student",
            data: form_data,
            dataType: "json",
            contentType: false, // Set to false to let jQuery decide the content type
            processData: false, // Set to false to prevent jQuery from processing data (i.e. no stringifying)
            success: function (data) {
                toastr.success("Action completed").css("margin-top", "2rem");
                displayData();
                $("#myModal").modal("hide");
            },
            error: function (ex) {
                toastr.error("Action incomplete").css("margin-top", "2rem");
                console.log(ex.responseText);
            },
        });
    } else {
        //Update
        $.ajax({
            type: "POST",
            url: "student_json.php?data=update_student&id=" + student_id,
            data: form_data,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (data) {
                toastr.success("Action completed").css("margin-top", "2rem");
                displayData();
                $("#myModal").modal("hide");
            },
            error: function (ex) {
                toastr.error("Action incomplete").css("margin-top", "2rem");
                console.log(ex.responseText);
            },
        });
    }
});

$("#btnAdd").click(function () {
    $("#txtStudentId").val("");
    $("#txtStudentName").val("");
    $("#txtPassword").val("");
    $("#ddlClass").val("");
    $("#txtPhone").val("");
    $("#txtEmail").val("");
    $("#image").val("");
    $("#btnSave").text("Insert");
});

var student_id;

function editData(id) {
    $("#btnSave").text("Update");
    student_id = id;
    $.ajax({
        url: "student_json.php?data=get_byid",
        data: "&id=" + id,
        type: "GET",
        dataType: "json",
        contentType: false,
        processData: false,
        success: function (data) {
            $("#txtStudentId").val(data[0][1]);
            $("#txtstudentName").val(data[0][2]);
            $("#txtPassword").val(data[0][2]);
            $("#ddlClass").val(data[0][3]);
            $("#txtPhone").val(data[0][4]);
            $("#txtEmail").val(data[0][5]);
            $("#image").val(data[0][6]);
        },
        error: function (ex) {
            console.log(ex.responseText);
        },
    });
}

//Delete
function deleteData(id) {
    Swal.fire({
        title: "Are you sure to delete this student?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "GET",
                url: "student_json.php?data=delete_student&id=" + id,
                dataType: "json",
                success: function (data) {
                    Swal.fire({
                        title: "Action completed",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    displayData();
                },
                error: function (ex) {
                    Swal.fire({
                        title: "Action incomplete",
                        text: ex.responseText,
                        icon: "error",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    console.log(ex.responseText);
                },
            });
        }
    });
}









