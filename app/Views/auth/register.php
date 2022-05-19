<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register | TheSIS</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url("assets/vendor/fontawesome-free/css/all.min.css") ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url("assets/css/sb-admin-2.min.css") ?>" rel="stylesheet">
    <style>
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
        <?php if (session()->getFlashdata("message")) : ?>
            <div id="flashdata" data-open="true">
                <p id="icon" hidden><?= session()->getFlashdata("message")["icon"]; ?></p>
                <p id="title" hidden><?= session()->getFlashdata("message")["title"]; ?></p>
                <p id="text" hidden><?= session()->getFlashdata("message")["text"]; ?></p>
            </div>
        <?php endif; ?>
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Register</h1>
                            </div>
                            <form id="formRegister" action="<?= base_url("auth/createAccount") ?>" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-12 ">
                                        <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="namaLengkap" name="namaLengkap" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="npm" class="form-label">NPM</label>
                                        <input type="text" class="form-control" id="npm" name="npm">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="angkatan" class="form-label">Tahun Angkatan</label>
                                        <select class="form-control" name="angkatan" id="angkatan">
                                            <option value="none" selected disabled> - Pilih Tahun Angkatan - </option>
                                            <?php 
                                                $startYear = (int)date("Y", strtotime("-3 years"));
                                                $endYear =  (int)date("Y", strtotime("-7 years"));
                                                for($startYear; $startYear >= $endYear; $startYear -= 1) : 
                                            ?>
                                                <option value="<?= $startYear ?>"><?= $startYear ?></option>

                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="fakultas" class="form-label">Fakultas</label>
                                        <select class="form-control" name="fakultas" id="fakultas">
                                            <option value="none" selected disabled> - Pilih Fakultas - </option>
                                            <?php foreach($fakultas as $f) : ?>
                                                <option value="<?= $f['id'] ?>"><?= $f['inisial']. " | ". $f["nama"] ?></option>
                                            <?php endforeach;?>
                                            </select>
                                        </div>
                                    <div class="col-sm-6">
                                        <label for="prodi" class="form-label">Program Studi</label>
                                        <select class="form-control" name="prodi" id="prodi" disabled>
                                            <option value="none" selected disabled> - Pilih Program Studi - </option>
                                            <?php foreach($prodi as $p) : ?>
                                                <option value="<?= $p['id'] ?>" data-fakultas="<?= $p['id_fakultas'] ?>"><?= $p['inisial']. " | ". $p["nama"] ?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 ">
                                        <label for="emailMhs" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="emailMhs" id="emailMhs">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="katasandi" class="form-label">Kata Sandi</label>
                                        <input type="password" class="form-control" name="katasandi" id="katasandi">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="katasandiUlangi" class="form-label">Ulangi Kata Sandi</label>
                                        <input type="password" class="form-control" name="katasandiUlangi" id="katasandiUlangi">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            Register
                                        </button>
                                    </div>
                                </div>
                                
                            </form>
                            <hr>
                            
                            <div class="text-center">
                                <small>Sudah punya akun? <a href="<?= base_url("auth/login") ?>">Login!</a></small>
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

    <!-- berisi semua konstanta seperti base_url -->
    <script src="<?= base_url("assets/js/constant.js") ?>"></script>

    <script src="<?= base_url("assets/vendor/sweetalert2/sweetalert2.all.js") ?>"></script>
    <script src="<?= base_url("assets/vendor/jquery-validate/jquery.validate.min.js") ?>"></script>
    <script src="<?= base_url("assets/vendor/jquery-validate/localization/messages_id.js") ?>"></script>
    <script src="<?= base_url("assets/js/auth/register.js") ?>"></script>

</body>

</html>