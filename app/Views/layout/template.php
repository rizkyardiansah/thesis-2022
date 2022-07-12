<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-Equiv="Cache-Control" Content="no-cache" />
    <meta http-Equiv="Pragma" Content="no-cache" />
    <meta http-Equiv="Expires" Content="0" />


    <title><?= $title?> | TheSIS</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url("assets/vendor/fontawesome-free/css/all.min.css") ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url("assets/css/sb-admin-2.min.css") ?>" rel="stylesheet">
    <link href="<?= base_url("assets/css/style.css") ?>" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?= base_url("assets/vendor/datatables/DataTables-1.12.1/css/dataTables.bootstrap4.min.css") ?>" rel="stylesheet">
    <link href="<?= base_url("assets/vendor/datatables/Buttons-2.2.3/css/buttons.bootstrap4.min.css") ?>" rel="stylesheet">
    <link href="<?= base_url("assets/vendor/fullcalendar/main.css") ?>" rel="stylesheet" />
    <link href="<?= base_url("assets/vendor/daterangepicker/daterangepicker.css") ?>" rel="stylesheet" />

    <style>
        h1,h2,h3,h4,h5,h6 {
            color: #000;
        }
    </style>

</head>

<body id="page-top">
    
    <!-- Page Wrapper -->
    <div id="wrapper">

        <?= $this->include("layout/sidebar"); ?> 

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= session()->get("user_session")['nama'] ?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?= base_url("assets/img/undraw_profile.svg") ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                           
                                <!-- <a class="dropdown-item">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>
                                <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="<?= base_url("auth/logout")?>">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                <?= $this->renderSection('content'); ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span><strong class="text-dark">© TheSIS 2022</strong> Muhammad Rizky Ardiansah | 1402018149</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url("assets/vendor/jquery/jquery.min.js") ?>"></script>
    <script src="<?= base_url("assets/vendor/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url("assets/vendor/jquery-easing/jquery.easing.min.js") ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url("assets/js/sb-admin-2.min.js") ?>"></script>

    <!-- berisi semua konstanta seperti base_url -->
    <script src="<?= base_url("assets/js/constant.js") ?>"></script>

    <!-- Page level plugins -->
    <!-- <script src="vendor/chart.js/Chart.min.js"></script> -->
    <script src="<?= base_url("assets/vendor/datatables/DataTables-1.12.1/js/jquery.dataTables.min.js") ?>"></script>
    <script src="<?= base_url("assets/vendor/datatables/DataTables-1.12.1/js/dataTables.bootstrap4.min.js") ?>"></script>
    <script src="<?= base_url("assets/vendor/datatables/Buttons-2.2.3/js/dataTables.buttons.min.js") ?>"></script>
    <script src="<?= base_url("assets/vendor/datatables/Buttons-2.2.3/js/buttons.bootstrap4.min.js") ?>"></script>
    <script src="<?= base_url("assets/vendor/datatables/JSZip-2.5.0/jszip.min.js") ?>"></script>
    <script src="<?= base_url("assets/vendor/datatables/pdfmake-0.1.36/pdfmake.min.js") ?>"></script>
    <script src="<?= base_url("assets/vendor/datatables/pdfmake-0.1.36/vfs_fonts.js") ?>"></script>
    <script src="<?= base_url("assets/vendor/datatables/Buttons-2.2.3/js/buttons.html5.min.js") ?>"></script>
    <script src="<?= base_url("assets/vendor/datatables/Buttons-2.2.3/js/buttons.colVis.min.js") ?>"></script>

    <script src="<?= base_url("assets/vendor/moment/moment.min.js") ?>"></script>
    <script src="<?= base_url("assets/vendor/sweetalert2/sweetalert2.all.js") ?>"></script>
    <script src="<?= base_url("assets/vendor/jquery-validate/jquery.validate.min.js") ?>"></script>
    <script src="<?= base_url("assets/vendor/jquery-validate/additional-methods.min.js") ?>"></script>
    <script src="<?= base_url("assets/vendor/jquery-validate/localization/messages_id.js") ?>"></script>
    
    
   

    <!-- <script src="<?= base_url("assets/js/datatables.js");?>"></script> -->
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    
    
    <?= $this->renderSection('scripts'); ?>

    <!-- tooltips -->


</body>

</html>