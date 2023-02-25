<?php include './frontend/includes/login_header.php'  ?>
<?php
session_start();
require './frontend/config/db.php';

if (isset($_POST["login"])) {
  if (empty($_POST["username"]) || empty($_POST["password"])) {
    $message = '<label>All fields are required</label>';
  } else {
    $role = 1;
    $sql = "SELECT * FROM User WHERE username = :username AND password = :password AND role = :role";
    $statement = $conn->prepare($sql);
    $statement->execute(
      array(
        'username' => $_POST["username"],
        'password' => md5($_POST["password"]),
        'role' => $role
      )
    );
    $count = $statement->rowCount();
    if ($count > 0) {
      $_SESSION["username"] = $_POST["username"];
      header("location:./admin/home.php");
    } else {

      $sql = "SELECT * FROM Student WHERE studentName = :studentName AND password = :password";
      $statement = $conn->prepare($sql);
      $statement->execute(
        array(
          'studentName' => $_POST["username"],
          'password' => md5($_POST["password"]),
        )
      );
      $count = $statement->rowCount();
      if ($count > 0) {
        $_SESSION["studentName"] = $_POST["username"];
        header("location:./frontend/welcome.php");
      } else {
        $message = '<label>Invalid username or password</label>';
      }
    }
  }
}
?>

<!--CDN-->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />

<div class="container w-50 py-5" data-wow-delay="0.1s">
    <div class="container">
        <!-- Pills navs -->
        <ul class="nav nav-pills nav-justified mb-3 mt-4" id="ex1" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="tab-login" data-bs-toggle="pill" href="#login" role="tab"
                    aria-controls="login" aria-selected="true">Login</a>
            </li>
        </ul>
        <!-- Pills navs -->

        <!-- Pills content -->
        <div class="tab-content">
            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="tab-login">
                <form method="post">
                    <!-- Text input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="loginName">Username</label>
                        <input type="text" id="loginName" name="username" class="form-control" />
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="loginPassword">Password</label>
                        <input type="password" id="loginPassword" name="password" class="form-control" />
                    </div>
                    <?php
          if (isset($message)) {
            echo '<label class="text-danger">' . $message . ' <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></label>';
          }
          ?>

                    <!-- 2 column grid layout -->
                    <div class="row mb-4">
                        <div class="col-md-6 d-flex justify-content-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-3 mb-md-0">
                                <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked />
                                <label class="form-check-label" for="loginCheck"> Remember me </label>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex justify-content-center">
                            <!-- Simple link -->
                            <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                                data-bs-target="#studentAddModal">Create New Account?</button>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <div class="text-center">
                        <button type="submit" name="login" class="btn btn-primary btn-block mb-4">Sign in</button>
                    </div>
                </form>
            </div>

        </div>
        <!-- Pills content -->
    </div>
</div>


<!-- Add Student -->
<div class="modal fade" id="studentAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Your Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="saveStudent">
                <div class="modal-body">

                    <div id="errorMessage" class="alert alert-warning d-none"></div>

                    <div class="mb-3">
                        <label for="">Student ID</label>
                        <input type="text" name="studentId" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" name="studentName" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control" />
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include './frontend/includes/footer.php'  ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script>
$(document).on('submit', '#saveStudent', function(e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("save_student", true);

    $.ajax({
        type: "POST",
        url: "register.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {

            var res = jQuery.parseJSON(response);
            if (res.status == 422) {
                $('#errorMessage').removeClass('d-none');
                $('#errorMessage').text(res.message);

            } else if (res.status == 420) {
                $('#errorMessage').removeClass('d-none');
                $('#errorMessage').text(res.message);

            }else if (res.status == 200) {

                $('#errorMessage').addClass('d-none');
                $('#studentAddModal').modal('hide');
                $('#saveStudent')[0].reset();

                alertify.set('notifier', 'position', 'top-right');
                alertify.success(res.message);

            } else if (res.status == 500) {
                alert(res.message);
            }
        }
    });

});
</script>