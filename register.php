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
    <title>Neo Cafe | Register</title>
    <link rel="stylesheet" href="./dist/css/root.css" />
    <?php require_once "./layouts/head-link.php" ?>

</head>

<body class="hold-transition login-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <span class="header-text text-medium"><b>Neo</b> Cafe</span>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Register a new account</p>
                <form action="./functions/action-form.php?action=register" method="post" id="form">
                    <!-- username -->
                    <div class="mb-2" id="username-section">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Full name" name="username" id="username">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <p class="sanitize ml-2 text-red" id="error-username" data-error="username">
                            <span>Lorem ipsum dolor sit.</span>
                        </p>
                    </div>
                    <!-- email -->
                    <div class="mb-2" id="email-section">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Email" name="email" id="email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <p class="sanitize ml-2 text-red" id="error-email">
                            <span>Lorem ipsum dolor sit.</span>
                        </p>
                    </div>
                    <!-- password -->
                    <div class="mb-2" id="password-section">
                        <div class="input-group">
                            <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <p class="sanitize ml-2 text-red" id="error-password">
                            <span>Lorem ipsum dolor sit.</span>
                        </p>
                    </div>
                    <!-- re-password -->
                    <div class="mb-2" id="re-password-section">
                        <div class="input-group">
                            <input type="password" class="form-control" placeholder="Retype password" id="re-password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <p class="sanitize ml-2 text-red" id="error-re-password">
                            <span>Lorem ipsum dolor sit.</span>
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-8">
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button id="btn-submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <a href="login.php" class="text-center">I already have a account</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.login-box -->
    <?php require_once "./layouts/body-script.php" ?>
    <script src="./plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script>
        function createErrorElement(message) {
            const p = document.createElement("p");
            const span = document.createElement("span");
            p.classList = "sanitize ml-2 text-red";
            span.innerText = message;
            p.append(span);
            return p;
        }
        $(document).ready(function() {
            const
                errorUsername = $("#error-username"),
                errorEmail = $("#error-email"),
                errorPasword = $("#error-password"),
                errorRePassword = $("#error-re-password");

            errorUsername.hide();
            errorEmail.hide();
            errorPasword.hide();
            errorRePassword.hide();

            $("#btn-submit").click(function(btnEven) {
                const form = $("#form");
                const username = $("#email").val(),
                    email = $("#email").val(),
                    password = $("#password").val(),
                    rePassword = $("#re-password").val();
            });
        });
    </script>
</body>

</html>