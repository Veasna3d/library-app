<?php
session_start();
require './admin/config/db.php';

if (isset($_POST["login"])) {
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        $message = '<label>All fields are required</label>';
    } else {
        $sql = "SELECT * FROM tbl_user WHERE username = :username AND password = :password";
        $statement = $conn->prepare($sql);
        $statement->execute(
            array(
                'username' => $_POST["username"],
                'password' => $_POST["password"],
            )
        );
        $count = $statement->rowCount();
        if ($count > 0) {
            $_SESSION["username"] = $_POST["username"];
            header("location:./admin/home.php");
        } else {
            $message = '<label>Invalid username or password</label>';
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>POS System</title>
    <!-- <link rel="stylesheet" href="admin/js/bootstrap."> -->
    <link rel="stylesheet" href="./admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<style>
		 h1 {
			text-align: center;
			color: #5b6574;
			padding: 20px 0 20px 0;
			border-bottom: 1px solid #dee0e4;
		}
        .login {
			width: 400px;
			background-color: #ffffff;
			box-shadow: 0 0 9px 0 rgba(0, 0, 0, 0.3);
			margin: 100px auto;
		}
</style>

<body>

    <div class="container shadow-lg p-3 rounded login">
        <h1>Login</h1>
        <form method="post">
        <label for="validationDefaultUsername" class="form-label">Username</label>
            <div class="input-group">
            <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-user"></i></span>
            <input type="text" name="username" class="form-control" />
            </div>
            <br />
            <label for="validationDefault03" class="form-label">Password</label>
            <div class="input-group">
            <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-lock"></i></span>
            <input type="password" name="password" class="form-control" />
            </div>
          <?php
               if (isset($message)) {
                    echo '<label class="text-danger">' . $message . ' <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></label>';
               }
          ?>
          <br>
            <input type="submit" name="login" class="btn btn-primary" value="Login" />
        </form>
    </div>

</body>

</html>
