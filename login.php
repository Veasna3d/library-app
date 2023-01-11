<?php include'./frontend/includes/register_header.php'  ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
    integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<?php
session_start();
require './frontend/config/db.php';

if (isset($_POST["login"])) {
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        $message = '<label>All fields are required</label>';
    } else {
        $sql = "SELECT * FROM User WHERE username = :username AND password = :password";
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

            $sql = "SELECT * FROM Student WHERE studentName = :studentName AND password = :password";
            $statement = $conn->prepare($sql);
            $statement->execute(
            array(
                'studentName' => $_POST["username"],
                'password' => $_POST["password"],
            )
            );
            $count = $statement->rowCount();
        if ($count > 0) {
            $_SESSION["studentName"] = $_POST["username"];
            header("location:./frontend/welcome.php");
        }else{
            $message = '<label>Invalid username or password</label>';
        } 
           
        }
    }
}
?>

<!-- ABOUT -->
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="about-info">
                    <h2>Start your journey to a better life with online practical courses</h2>

                    <figure>
                        <span><i class="fa fa-certificate"></i></span>
                        <figcaption>
                            <h3>International Certifications</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint ipsa
                                voluptatibus.</p>
                        </figcaption>
                    </figure>

                    <figure>
                        <span><i class="fa fa-bar-chart-o"></i></span>
                        <figcaption>
                            <h3>Free for 3 months</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint ipsa
                                voluptatibus.</p>
                        </figcaption>
                    </figure>
                </div>

            </div>

            <div class="col-md-offset-1 col-md-4 col-sm-12">
                <div class="entry-form">
                    <form action="#" method="post">
                        <h2>Login</h2>

                        <input type="text" name="username" style="color:white;" class="form-control"
                            placeholder="Your Username" required="">

                        <input type="password" style="color:white;" name="password" class="form-control"
                            placeholder="Your password" required="">

                        <?php
                                            if (isset($message)) {
                                                echo '<label class="text-danger">' . $message . ' <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></label>';
                                            }
                                        ?>

                        <div class="flex-container mt-3 pt-3">
                            <button type="submit" name="login" class="btn btn-primary btn-lg"
                                id="form-submit">Login</button>
                            <button type="button" data-toggle="modal" data-target="#myModal"
                                class="btn btn-warning btn-lg" id="btnAdd">Sign up</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!---Modal Sign Up-->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Sign Up Form</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fas fa-closes"></i></button>
                </div>

                <div class="modal-body">
                    <form method="post" id="form">
                        <div class="form-group">
                            <label for="name">Student ID</label>
                            <input type="text" name="txtStudentId" id="txtStudentId" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="name">Student Name</label>
                            <input type="text" name="txtStudentName" id="txtStudentName" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="name">Password</label>
                            <input type="password" name="txtPassword" id="txtPassword" class="form-control">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="btnSave">Save</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>


<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php include'./frontend/includes/register_footer.php'  ?>