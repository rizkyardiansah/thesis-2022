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
                <table class="table table-bordered" id="mahasiswaBimbingan" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPM</th>
                            <th>Nama</th>
                            <th>Judul</th>
                            <th>Bidang</th>
                            <th>Jumlah Bimbingan</th>
                            <th>Peran Pembimbing</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 1; ?>
                        <?php foreach ($mahasiswaBimbingan as $mb) : ?>
                            <tr>
                                <td><?= $counter ?></td>
                                <td><?= $mb['npm'] ?></td>
                                <td><?= $mb['nama_mahasiswa'] ?></td>
                                <td><?= $mb['judul'] ?></td>
                                <td><?= $mb['nama_bidang'] ?></td>
                                <td><?= $mb['jumlah_bimbingan'] ?></td>
                                <td><?= $mb['role'] ?></td>
                                <td>
                                    <a href="<?= base_url("dosen/detailBimbingan/".$mb['npm']."/".$mb['role']) ?>" role="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="detail"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            <?php $counter++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
    <script src="<?= base_url("assets/js/dosen/bimbingan.js");?>"></script>
<?= $this->endSection(); ?>