<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?= $title ?>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="repositorySkripsi" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Tahun</th>
                            <th>Bidang</th>
                            <th>Kata Kunci</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Tahun</th>
                            <th>Bidang</th>
                            <th>Kata Kunci</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>Pengembangan Sistem Informasi Skripsi Fakultas Teknologi Informasi</td>
                            <td>Muhammad Rizky Ardiansah</td>
                            <td>2022</td>
                            <td>Multimedia</td>
                            <td>Sistem Informasi, Skripsi, CodeIgniter</td>
                            <td><button class="btn btn-primary">Unduh</button></td>
                        </tr>
                        <tr>
                            <td>Pengembangan Sistem Informasi Skripsi Fakultas Teknologi Informasi</td>
                            <td>Muhammad Rizky Ardiansah</td>
                            <td>2022</td>
                            <td>Multimedia</td>
                            <td>Sistem Informasi, Skripsi, CodeIgniter</td>
                            <td><button class="btn btn-primary">Unduh</button></td>
                        </tr>
                        <tr>
                            <td>Pengembangan Sistem Informasi Skripsi Fakultas Teknologi Informasi</td>
                            <td>Muhammad Rizky Ardiansah</td>
                            <td>2022</td>
                            <td>Multimedia</td>
                            <td>Sistem Informasi, Skripsi, CodeIgniter</td>
                            <td><button class="btn btn-primary">Unduh</button></td>
                        </tr>
                        <tr>
                            <td>Pengembangan Sistem Informasi Skripsi Fakultas Teknologi Informasi</td>
                            <td>Muhammad Rizky Ardiansah</td>
                            <td>2022</td>
                            <td>Multimedia</td>
                            <td>Sistem Informasi, Skripsi, CodeIgniter</td>
                            <td><button class="btn btn-primary">Unduh</button></td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>