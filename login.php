<?php
session_start();
if (isset($_SESSION["username"]) && isset($_SESSION["userId"])) {
    header("Location:index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Neo Cafe | Log in</title>
    <link rel="stylesheet" href="./dist/css/root.css" />
    <?php require_once "./layouts/head-link.php" ?>

</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="login-logo">
                <span class="header-text text-medium"><b>Neo</b> Cafe</span>
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Login to continue</p>
                    <form action="./functions/action-form.php?action=login" method="post" name="form" id="form">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Email" name="email" id="email" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Password" name="password" id="password" pattern="\w{8}" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <p class="">
                                <a href="forgot-password.html">I forgot my password</a>
                            </p>
                        </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-1"></div>
                            <div class="col-4">
                                <button id="submit-btn" class="btn btn-primary btn-block" name="btn-submit" value="sign-in">Sign In</button>
                            </div>
                            <div class="col-6">
                                <button id="guest" class="btn btn-outline-primary btn-block" name="btn-submit" value="guest">Login as Guest</button>
                            </div>
                            <div class="col-1"></div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <div class="mb-1 mt-2">
                        <p class="mb-0"> don't have account ?
                            <a href="register.php" class="text-center">Register</a>
                        </p>
                    </div>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    </div>
    <!-- /.login-box -->
    <?php require_once "./layouts/body-script.php" ?>
    <script src="./plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#submit-btn").click(function(btnEven) {
                const email = $("#email").val(),
                    password = $("#password").val(),
                    form = $("#form");

                if (email !== "" && password !== "") {
                    form.submit();
                } else {
                    Swal.fire({
                        title: "Error",
                        text: "Please enter email and password",
                        icon: "error"
                    })
                }
                // console.log(form);
            });
            $("#guest").click(function() {
                console.log("Login as guest");
            })
            // $(".form-control").on("change", (e) => {
            //     console.log("change", e.target.value, e.target.type);
            // })
        });
    </script>
</body>

</html>