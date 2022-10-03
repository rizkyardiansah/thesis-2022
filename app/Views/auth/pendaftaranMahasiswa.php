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

    <link rel="icon" type="image/x-icon" href="<?= base_url("assets/img/logo-yarsi.png") ?>">
    
    <!-- Custom styles for this template-->
    <link href="<?= base_url("assets/css/sb-admin-2.min.css") ?>" rel="stylesheet">
    <style>
        .bg-login-image {
            background: url(<?= base_url("assets/img/hero_login.png"); ?>);
            background-position: center;
            background-size: unset;
            background-repeat: no-repeat;
        }

        .bg-register-image {
            background: url(<?= base_url("assets/img/hero_register.png"); ?>);
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
                            <div class="col-lg-6 d-none d-lg-block bg-register-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Lengkapi Data Berikut</h1>
                                    </div>
                                    <form id="pendaftaranMahasiswa" method="post" action="<?= base_url("auth/pendaftaranMahasiswa") ?>">
                                        <input type="hidden" name="npm" value="<?= $userData['id_nik'] ?>">
                                        <input type="hidden" name="nama" value="<?= $userData['displayname'] ?>">
                                        <input type="hidden" name="username" value="<?= $userData['username'] ?>">
                                        <input type="hidden" name="password" value="<?= $userData['password'] ?>">
                                        <div class="form-group row">
                                            <div class="col-sm-12 ">
                                                <label for="nama" class="form-label">Nama</label>
                                                <input type="text" class="form-control" id="nama" value="<?= $userData['displayname'] ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12 ">
                                                <label for="npm" class="form-label">NPM</label>
                                                <input type="text" class="form-control" id="npm" value="<?= $userData['id_nik'] ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12 ">
                                                <label for="prodi" class="form-label">Program Studi</label>
                                                <select name="prodi" id="prodi" class="form-control">
                                                    <option selected disabled> - Pilih Program Studi - </option>
                                                    <?php foreach ($prodi as $p) : ?>
                                                        <option value="<?= $p['id'] ?>" data-inisial="<?= $p['inisial'] ?>"><?= $p['inisial'] ?> | <?= $p['nama'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12 ">
                                                <label for="angkatan" class="form-label">Tahun Angkatan</label>
                                                <input type="text" class="form-control" id="angkatan" name="angkatan" value="<?= substr($userData['id_nik'], 3, 4) ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12 ">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email">
                                            </div>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="persetujuan" name="persetujuan">
                                            <label class="form-check-label" for="persetujuan">
                                                Saya menyatakan bahwa data yang saya isi adalah benar dan saya bertanggung jawab penuh atas data yang saya isi.
                                            </label>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-block mt-3">
                                            Kirim
                                        </button>
                                        
                                    </form>
                                    <hr>
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
    <script src="<?= base_url("assets/js/auth/pendaftaranMahasiswa.js") ?>"></script>

</body>

</html>