function displayData() {
  $.ajax({
    url: "borrow_json.php?data=get_borrow",
    type: "GET",
    dataType: "json",
    success: function (alldata) {
      var columns = [
        {
          title: "ID",
        },
        {
          title: "BOOK TITLE",
        },
        {
          title: "STUDENT NAME",
        },
        {
          title: "BORROW DATE",
        },
        {
          title: "RETURN DATE",
        },
        {
          title: "STATUS",
        },
        {
          title: "REMARK",
        },
        {
          title: "CREATE DATE",
        },
        {
          title: "ACTION",
        },
      ];
      var data = [];
      var option = "";
      for (var i in alldata) {
        option =
          "<i class='fa fa-pencil-square-o' data-toggle='modal' data-target='#myModal' onclick='editData(" +
          alldata[i][0] +
          ")'></i> | <i class='fa fa-trash' onclick='deleteData(" +
          alldata[i][0] +
          ")'></i> | <i style='cursor: pointer;' class='fa fa-retweet' onclick='statusReturn(" +
          alldata[i][0] +
          ")'></i>";
        data.push([
          alldata[i][0],
          alldata[i][1],
          alldata[i][2],
          alldata[i][3],
          alldata[i][4],
          alldata[i][5],
          alldata[i][6],
          alldata[i][7],
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

//Filter Pending
$("#btnPending").click(function () {
  $.ajax({
    url: "borrow_json.php?data=get_pending",
    type: "Get",
    dataType: "json",
    success: function (alldata) {
        var columns = [
          {
            title: "ID",
          },
          {
            title: "BOOK TITLE",
          },
          {
            title: "STUDENT NAME",
          },
          {
            title: "BORROW DATE",
          },
          {
            title: "RETURN DATE",
          },
          {
            title: "STATUS",
          },
          {
            title: "REMARK",
          },
          {
            title: "CREATE DATE",
          },
          {
            title: "ACTION",
          },
        ];
        var data = [];
        var option = "";
        for (var i in alldata) {
          option =
            "<i class='fa fa-pencil-square-o' data-toggle='modal' data-target='#myModal' onclick='editData(" +
            alldata[i][0] +
            ")'></i> | <i class='fa fa-trash' onclick='deleteData(" +
            alldata[i][0] +
            ")'></i> | <i style='cursor: pointer;' class='fa fa-retweet' onclick='statusReturn(" +
            alldata[i][0] +
            ")'></i>";
          data.push([
            alldata[i][0],
            alldata[i][1],
            alldata[i][2],
            alldata[i][3],
            alldata[i][4],
            alldata[i][5],
            alldata[i][6],
            alldata[i][7],
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
});

//Filter Returned
$("#btnRetuurn").click(function () {
    $.ajax({
      url: "borrow_json.php?data=get_returned",
      type: "Get",
      dataType: "json",
      success: function (alldata) {
          var columns = [
            {
              title: "ID",
            },
            {
              title: "BOOK TITLE",
            },
            {
              title: "STUDENT NAME",
            },
            {
              title: "BORROW DATE",
            },
            {
              title: "RETURN DATE",
            },
            {
              title: "STATUS",
            },
            {
              title: "REMARK",
            },
            {
              title: "CREATE DATE",
            },
            {
              title: "ACTION",
            },
          ];
          var data = [];
          var option = "";
          for (var i in alldata) {
            option =
              "<i class='fa fa-pencil-square-o' data-toggle='modal' data-target='#myModal' onclick='editData(" +
              alldata[i][0] +
              ")'></i> | <i class='fa fa-trash' onclick='deleteData(" +
              alldata[i][0] +
              ")'></i>";
            data.push([
              alldata[i][0],
              alldata[i][1],
              alldata[i][2],
              alldata[i][3],
              alldata[i][4],
              alldata[i][5],
              alldata[i][6],
              alldata[i][7],
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
  });

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

function setStudent(myselect, myjson, caption) {
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
            '<option value="' +
              s[i][0] +
              '">' +
              s[i][1] +
              "-" +
              s[i][2] +
              "</option>"
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

$(document).ready(function () {
  displayData();
  setDataToSelect("#ddlBook", "borrow_json.php?data=get_book", "--Book--");
  setStudent("#ddlStudent", "borrow_json.php?data=get_student", "--Student--");
});

$("#btnAdd").click(function () {
  $("#ddlBook").val("");
  $("#ddlStudent").val("");
  $("#txtBorrowDate").val("");
  $("#txtReturnDate").val("");
  $("#txtRemark").val("");
  $("#btnSave").text("Insert");
});

var borrow_id;

function editData(id) {
  $("#btnSave").text("Update");
  borrow_id = id;

  $.ajax({
    url: "borrow_json.php?data=get_byid",
    data: "&id=" + id,
    type: "GET",
    dataType: "json",
    success: function (data) {
      $("#ddlBook").val(data[0][1]);
      $("#ddlStudent").val(data[0][2]);
      $("#txtBorrowDate").val(data[0][3]);
      $("#txtReturnDate").val(data[0][4]);
      $("#txtRemark").val(data[0][5]);
    },
    error: function (ex) {
      console.log(ex.responseText);
    },
  });
}

$("#btnSave").click(function () {
  var bookId = $("#ddlBook");
  var studentId = $("#ddlStudent");
  var borrow_date = $("#txtBorrowDate");
  var return_date = $("#txtReturnDate");

 
    if (
      bookId.val() == "" &&
      studentId.val() == "" &&
      borrow_date.val() == "" &&
      return_date.val() == ""
    ) {
      bookId.focus();
      return toastr.warning("Fields Require!").css("margin-top", "2rem");
    } else if (bookId.val() == "") {
      bookId.focus();
      return toastr.warning("Book Require!").css("margin-top", "2rem");
    } else if (studentId.val() == "") {
      studentId.focus();
      return toastr.warning("Student Require!").css("margin-top", "2rem");
    } else if (borrow_date.val() == "") {
      borrow_date.focus();
      return toastr.warning("Borrow Date Require!").css("margin-top", "2rem");
    } else if (return_date.val() == "") {
      return_date.focus();
      return toastr.warning("Return Date Require!").css("margin-top", "2rem");
    }

  var form_data = $("#form").serialize();
  if ($("#btnSave").text() == "Insert") {
    //Insert
    $.ajax({
      type: "POST",
      url: "borrow_json.php?data=add_borrow",
      data: form_data,
      dataType: "json",
      success: function (data) {
        toastr.success("Action completed").css("margin-top", "2rem");
        // alert(data);
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
      url: "borrow_json.php?data=update_borrow&id=" + borrow_id,
      data: form_data,
      dataType: "json",
      success: function (data) {
        // alert(data);
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

function deleteData(id) {
  if (confirm("Are you sure?")) {
    $.ajax({
      type: "GET",
      url: "borrow_json.php?data=delete_borrow&id=" + id,
      dataType: "json",
      success: function (data) {
        // alert(data);
        toastr.success("Action completed").css("margin-top", "2rem");
        displayData();
      },
      error: function (ex) {
        toastr.error("Action incomplete").css("margin-top", "2rem");
        console.log(ex.responseText);
      },
    });
  }
}

//return
function statusReturn(id) {
  if (confirm("Are you sure to return this transaction?")) {
    $.ajax({
      type: "GET",
      url: "borrow_json.php?data=return_borrow&id=" + id,
      dataType: "json",
      success: function (data) {
        toastr.success("Action completed").css("margin-top", "2rem");
        displayData();
      },
      error: function (ex) {
        toastr.error("Action incomplete").css("margin-top", "2rem");
        console.log(ex.responseText);
      },
    });
  }
}

$(function () {
  var dtToday = new Date();
  var month = dtToday.getMonth() + 1;
  var day = dtToday.getDate();
  var year = dtToday.getFullYear();
  if (month < 10) month = "0" + month.toString();
  if (day < 10) day = "0" + day.toString();
  var maxDate = year + "-" + month + "-" + day;
  
  // alert(maxDate);
  $("#txtBorrowDate").attr("min", maxDate);
  $("#txtReturnDate").attr("min", maxDate);
  $("#txtBorrowDate").attr("max", maxDate);
});
