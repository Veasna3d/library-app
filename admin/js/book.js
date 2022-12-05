function displayData() {
  $.ajax({
    url: "book_json.php?data=get_book",
    type: "GET",
    dataType: "json",
    success: function (alldata) {
      var columns = [
        { title: "ID" },
        { title: "BOOK TITLE" },
        { title: "CATEGORY" },
        { title: "AUTHOR" },
        { title: "STATUS" },
        { title: "CREATE DATE" },
        { title: "ACTION" },
      ];
      var data = [];
      var option = "";
      for (var i in alldata) {
        option =
          "<i style='cursor: pointer;' class='fa fa-pencil-square-o' data-toggle='modal' data-target='#Mymodal' onclick='editData(" +
          alldata[i][0] +
          ")'></i> | <i style='cursor: pointer;' class='fa fa-trash' onclick='deleteData(" +
          alldata[i][0] +
          ")'></i> | <i style='cursor: pointer;' id='btnStatus' class='fa fa-refresh' onclick='getStatus(" +
          alldata[i][0] +
          ")'></i>";
        data.push([
          alldata[i][0],
          alldata[i][1],
          alldata[i][2],
          alldata[i][3],
          alldata[i][4],
          alldata[i][5],
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

//Available
$("#btnAvailable").click(function () {
  $.ajax({
    url: "book_json.php?data=get_available",
    type: "Get",
    dataType: "json",
    success: function (alldata) {
      var columns = [
        { title: "ID" },
        { title: "BOOK TITLE" },
        { title: "CATEGORY" },
        { title: "AUTHOR" },
        { title: "STATUS" },
        { title: "CREATE DATE" },
        { title: "ACTION" },
      ];
      var data = [];
      var option = "";
      for (var i in alldata) {
        option =
          "<i style='cursor: pointer;' class='fa fa-pencil-square-o' data-toggle='modal' data-target='#Mymodal' onclick='editData(" +
          alldata[i][0] +
          ")'></i> | <i style='cursor: pointer;' class='fa fa-trash' onclick='deleteData(" +
          alldata[i][0] +
          ")'></i> | <i style='cursor: pointer;' id='btnStatus' class='fa fa-refresh' onclick='getStatus(" +
          alldata[i][0] +
          ")'></i>";
        data.push([
          alldata[i][0],
          alldata[i][1],
          alldata[i][2],
          alldata[i][3],
          alldata[i][4],
          alldata[i][5],
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

//Filter UnAvailable
$("#btnUnAvailable").click(function () {
  $.ajax({
    url: "book_json.php?data=get_unavailable",
    type: "Get",
    dataType: "json",
    success: function (alldata) {
      var columns = [
        { title: "ID" },
        { title: "BOOK TITLE" },
        { title: "CATEGORY" },
        { title: "AUTHOR" },
        { title: "STATUS" },
        { title: "CREATE DATE" },
        { title: "ACTION" },
      ];
      var data = [];
      var option = "";
      for (var i in alldata) {
        option =
          "<i style='cursor: pointer;' class='fa fa-pencil-square-o' data-toggle='modal' data-target='#Mymodal' onclick='editData(" +
          alldata[i][0] +
          ")'></i> | <i style='cursor: pointer;' class='fa fa-trash' onclick='deleteData(" +
          alldata[i][0] +
          ")'></i> | <i style='cursor: pointer;' id='btnStatus' class='fa fa-refresh' onclick='refuseStatus(" +
          alldata[i][0] +
          ")'></i> ";
        data.push([
          alldata[i][0],
          alldata[i][1],
          alldata[i][2],
          alldata[i][3],
          alldata[i][4],
          alldata[i][5],
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

$(document).ready(function () {
  displayData();
  setDataToSelect(
    "#txtCategoryId",
    "book_json.php?data=get_category",
    "--Category--"
  );
});

$(document).ready(function () {
  displayData();
  setDataToSelect(
    "#txtAuthor",
    "book_json.php?data=get_author",
    "--Choose author--"
  );
});

$("#btnAdd").click(function () {
  $("#txtTitle").val("");
  $("#txtCategoryId").val("");
  $("#txtAuthor").val("");
  $("#btnSave").text("Insert");
});

var book_id;
function editData(id) {
  $("#btnSave").text("Update");
  book_id = id;

  $.ajax({
    url: "book_json.php?data=get_byid",
    data: "&id=" + id,
    type: "GET",
    dataType: "json",
    success: function (data) {
      $("#txtTitle").val(data[0][1]);
      $("#txtCategoryId").val(data[0][2]);
      $("#txtAuthor").val(data[0][3]);
    },
    error: function (ex) {
      console.log(ex.responseText);
    },
  });
}

$("#btnSave").click(function () {
  var title = $("#txtTitle");
    var categoryId = $("#txtCategoryId");
    var authorId =  $("#txtAuthor");
    if(title.val() == "" && categoryId.val() == "" && authorId.val() == ""){
        title.focus();
        return  toastr.warning("Field Require!").css("margin-top", "2rem");
    }else if(title.val() == ""){
        title.focus();
        return  toastr.warning("Book Title Require!").css("margin-top", "2rem");
    }else if(categoryId.val() == ""){
        categoryId.focus();
        return  toastr.warning("Category Require!").css("margin-top", "2rem");
    }else if(authorId.val() == ""){
        authorId.focus();
        return  toastr.warning("Author Require!").css("margin-top", "2rem");
    }
  var form_data = $("#form").serialize();
  if ($("#btnSave").text() == "Insert") {
    //Insert
    $.ajax({
      type: "POST",
      url: "book_json.php?data=add_book",
      data: form_data,
      dataType: "json",
      success: function (data) {
        toastr.success("Action completed").css("margin-top", "2rem");
        // alert(data);
        displayData();
        $("#Mymodal").modal("hide");
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
      url: "book_json.php?data=update_book&id=" + book_id,
      data: form_data,
      dataType: "json",
      success: function (data) {
        toastr.success("Action completed").css("margin-top", "2rem");
        // alert(data);
        displayData();
        $("#Mymodal").modal("hide");
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
      url: "book_json.php?data=delete_book&id=" + id,
      dataType: "json",
      success: function (data) {
        toastr.success("Action completed").css("margin-top", "2rem");
        // alert(data);
        displayData();
      },
      error: function (ex) {
        toastr.error("Action incomplete").css("margin-top", "2rem");
        console.log(ex.responseText);
      },
    });
  }
}

//unavailable
function getStatus(id) {
  if (confirm("This book is unavailable in the library !")) {
    $.ajax({
      type: "GET",
      url: "book_json.php?data=get_status&id=" + id,
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

//available
function refuseStatus(id) {
  if (confirm("This book is available in the library !")) {
    $.ajax({
      type: "GET",
      url: "book_json.php?data=refuse_status&id=" + id,
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

  // $("#btnAv").bind("click", function get_status(id) {
  //   if (confirm("This book is unavailable in the library !")) {
  //     $.ajax({
  //       type: "GET",
  //       url: "book_json.php?data=get_status&id=" + id,
  //       dataType: "json",
  //       success: function (data) {
          // alert(data);
  //         displayData();
  //       },
  //       error: function (ex) {
  //         console.log(ex.responseText);
  //       },
  //     });
  //   }
  // });
  // $("#btnUn").bind("dblclick", function status(id) {
  //   if (confirm("This book is available in the library !")) {
  //     $.ajax({
  //       type: "GET",
  //       url: "book_json.php?data=refuse_status&id=" + id,
  //       dataType: "json",
  //       success: function (data) {
          // alert(data);
  //         displayData();
  //       },
  //       error: function (ex) {
  //         console.log(ex.responseText);
  //       },
  //     });
  //   }
  // });
  $(document).ready(function(){  
    $('#upload_csv_form').on("submit", function(e){  
         e.preventDefault(); //form will not submitted  
         $.ajax({  
              url:"importBook.php",  
              method:"POST",  
              data:new FormData(this),  
              contentType:false,          // The content type used when sending data to the server.  
              cache:false,                // To unable request pages to be cached  
              processData:false,          // To send DOMDocument or non processed data file it is set to false  
              success: function(data){  
                   if(data=='Error1')  
                   {  
                    toastr.warning("Invalid File").css("margin-top", "2rem");
                        // alert("Invalid File");  
                   }  
                   else if(data == "Error2")  
                   {  
                    toastr.warning("Please Select File").css("margin-top", "2rem");
                        // alert("Please Select File");  
                   }                           
                   else if(data == "Success")  
                   {  
                    toastr.success("CSV file data has been imported").css("margin-top", "2rem");
                      // alert("CSV file data has been imported");  
                      $('#upload_csv_form')[0].reset();
                      alert(data);
                      $("#myImport").modal("hide");
                      displayData();
                     
                      //  $('#table_id').html(data); 
                   }  
                   else  
                   {  
                       // $('#employee_table').html(data);  
                   }  
              }  
         })  
    });  
});