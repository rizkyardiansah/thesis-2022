<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?= $title ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-5"></div>
                <div class="col-lg-7 d-flex justify-content-end align-items-center">
                    <form class="form-inline" action="<?= base_url("home/index") ?>" method="get">
                        <div class="form-group mr-2">
                            <label for="dari" class="form-control-label mr-1">Dari</label>
                            <input type="date" id="dari" name="dari" class="form-control" placeholder="dari">
                        </div>
                        <div class="form-group mr-2">
                            <label for="hingga" class="form-control-label mr-1">Hingga</label>
                            <input type="date" class="form-control" id="hingga" name="hingga" placeholder="hingga">
                        </div>
                        <button type="submit" class="btn btn-primary" data-toggle="tooltip" title="Filter Table" id="filterTable"><i class="fas fa-filter"></i></button>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="repositorySkripsi" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Deskripsi Singkat</th>
                            <th>Penulis</th>
                            <th>Prodi</th>
                            <th>Tanggal Unggah</th>
                            <th>Bidang</th>
                            <th>Kata Kunci</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($makalah as $m): ?>
                            <tr>
                                <td><?= $m['judul'] ?></td>
                                <td><?= $m['deskripsi'] ?></td>
                                <td><?= $m['nama_mahasiswa'] ?></td>
                                <td data-toggle="tooltip" title="<?= $m['nama_prodi'] ?>" data-placement="top"><?= $m['inisial_prodi'] ?></td>
                                <td style="min-width: 8vw"><?= date_format(date_create($m['tanggal_upload']), "d-m-Y") ?></td>
                                <td data-toggle="tooltip" title="<?= $m['nama_bidang'] ?>" data-placement="top"><?= $m['inisial_bidang'] ?></td>
                                <td><?= $m['kata_kunci'] ?></td>
                                <td>
                                    <form action="<?= base_url("home/downloadMakalah/".$m['id']) ?>" method="post">
                                        <button type="submit" class="btn btn-primary" data-toggle="tooltip" title="Unduh" data-placement="top"><i class="fas fa-download"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
    <script src="<?= base_url("assets/js/home/repositorySkripsi.js");?>"></script>
<?= $this->endSection(); ?>