<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<?php if (session()->getFlashdata("message")) : ?>
    <div id="flashdata" data-open="true">
        <p id="icon" hidden><?= session()->getFlashdata("message")["icon"]; ?></p>
        <p id="title" hidden><?= session()->getFlashdata("message")["title"]; ?></p>
        <p id="text" hidden><?= session()->getFlashdata("message")["text"]; ?></p>
    </div>
<?php endif; ?>
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?= $title ?>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tablePembimbing" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPM</th>
                            <th>Nama</th>
                            <th>Judul</th>
                            <th>Bidang</th>
                            <th>Peran</th>
                            <th>Jumlah Bimbingan Diterima</th>
                            <th>Status Skripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $counter = 1; ?>
                    <?php foreach($mahasiswaBimbingan as $mb): ?>
                        <tr>
                            <td><?= $counter ?></td>
                            <td><?= $mb['npm'] ?></td>
                            <td><?= $mb['nama_mahasiswa'] ?></td>
                            <td><?= $mb['judul'] ?></td>
                            <td data-toggle="tooltip" data-placement="top" title="<?= $mb['nama_bidang'] ?>"><?= $mb['inisial_bidang'] ?></td>
                            <td><?= $mb['peran_pembimbing'] ?></td>
                            <td><?= $mb['jumlah_bimbingan'] ?></td>
                            <td><?= $mb['status_skripsi'] ?></td>
                        </tr>
                        <?php $counter++; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-12 mt-2 mb-0 d-flex justify-content-end">
                <a class="btn btn-secondary mr-2" role="button" href="<?= base_url("kaprodi/pembimbing") ?>">Kembali</a>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
    <script src="<?= base_url("assets/js/kaprodi/detailPembimbing.js");?>"></script>
<?= $this->endSection(); ?>