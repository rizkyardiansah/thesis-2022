<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login | TheSIS</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url("assets/vendor/fontawesome-free/css/all.min.css") ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url("assets/css/sb-admin-2.min.css") ?>" rel="stylesheet">
    <style>
        .bg-login-image {
            background: url(<?= base_url("assets/img/hero_login.png"); ?>);
            background-position: center;
            background-size: unset;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body class="bg-gradient-dark">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
        <?php if (session()->getFlashdata("message")) : ?>
            <div id="flashdata" data-open="true">
                <p id="icon" hidden><?= session()->getFlashdata("message")["icon"]; ?></p>
                <p id="title" hidden><?= session()->getFlashdata("message")["title"]; ?></p>
                <p id="text" hidden><?= session()->getFlashdata("message")["text"]; ?></p>
            </div>
        <?php endif; ?>
            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image img-fluid"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                    </div>
                                    <form id="formLogin" method="post" action="<?= base_url("auth/signInAccount") ?>">
                                        <div class="form-group row">
                                            <div class="col-sm-12 ">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" class="form-control" id="username" name="username">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12 ">
                                                <label for="password" class="form-label">Kata Sandi</label>
                                                <input type="password" class="form-control" id="password" name="password">
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-block">
                                            Login
                                        </button>
                                        
                                    </form>
                                    <hr>
                                    
                                    <!-- <div class="text-center">
                                        <small>Belum mempunyai akun? <a href="">Register</a></small>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url("assets/vendor/jquery/jquery.min.js") ?>"></script>
    <script src="<?= base_url("assets/vendor/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url("assets/vendor/jquery-easing/jquery.easing.min.js") ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url("assets/js/sb-admin-2.min.js") ?>"></script>

    <script src="<?= base_url("assets/js/constant.js") ?>"></script>

    <script src="<?= base_url("assets/vendor/sweetalert2/sweetalert2.all.js") ?>"></script>
    <script src="<?= base_url("assets/vendor/jquery-validate/jquery.validate.min.js") ?>"></script>
    <script src="<?= base_url("assets/vendor/jquery-validate/localization/messages_id.js") ?>"></script>
    <script src="<?= base_url("assets/js/auth/login.js") ?>"></script>

</body>

</html>