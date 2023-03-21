//Show Data
function displayData() {
    $.ajax({
      url: "news_json.php?data=get_news",
      type: "Get",
      dataType: "json",
      success: function (alldata) {
        var columns = [
          {
            title: "ID",
          },
          {
            title: "SUB TITLE",
          },
          {
            title: "DETAIL",
          },{
            title: "IMAGE",
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
            alldata[i][0] + ")'><i class='fa fa-trash'></i> </button> ";
            data.push([
              alldata[i][0],
              alldata[i][1],
              alldata[i][2],
              "<img style='width: 120px; height: 100px;' src='upload/" + alldata[i][3] + "'>",
              alldata[i][4],
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
  };
  
  
  //Load
  $(document).ready(function () {
    displayData();
    
  });
  
  //btnSave
  $("#btnSave").click(function () {
    var subTitle = $("#txtSubTitle");
      var detail = $("#txtDetail");
    
      
      if (subTitle.val() == "") {
          subTitle.focus();
          return toastr.warning("Field Require!").css("margin-top", "2rem");
      }else if (detail.val() == "") {
          detail.focus();
          return toastr.warning("Detail Require!").css("margin-top", "2rem");
      }
      
  
    var form_data = new FormData($("#form")[0]); // Use FormData object to include file data
    if ($("#btnSave").text() == "Insert") {
      //Insert
      $.ajax({
        type: "POST",
        url: "news_json.php?data=add_news",
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
        url: "news_json.php?data=update_news&id=" + news_id,
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
    $("#txtSubTitle").val("");
    $("#txtDetail").val("");
    
    $("#image").val("");
    $("#btnSave").text("Insert");
  });
  
  var news_id;
  
  function editData(id) {
    $("#btnSave").text("Update");
    news_id = id;
    $.ajax({
      url: "news_json.php?data=get_byid",
      data: "&id=" + id,
      type: "GET",
      dataType: "json",
      contentType: false,
      processData: false,
      success: function (data) {
        $("#txtSubTitle").val(data[0][1]);
        $("#txtDetail").val(data[0][2]);
       
        $("#image").val(data[0][3]);
      },
      error: function (ex) {
        console.log(ex.responseText);
      },
    });
  }
  
  //Delete
  function deleteData(id) {
    Swal.fire({
      title: "Are you sure to delete this news?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "GET",
          url: "news_json.php?data=delete_news&id=" + id,
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
  
  
  
  
  