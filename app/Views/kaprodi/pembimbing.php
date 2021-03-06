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
                            <th>Inisial</th>
                            <th class="text-center">Nama</th>
                            <th>Jumlah Mahasiswa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $counter = 1; ?>
                    <?php foreach($pembimbing as $mpp): ?>
                        <tr>
                            <td><?= $counter ?></td>
                            <td><?= $mpp['inisial_dosen'] ?></td>
                            <td><?= $mpp['nama_dosen'] ?></td>
                            <td><?= $mpp['jumlah_mahasiswa'] ?></td>
                            <td>
                                <a role="button" class="btn btn-primary" href="<?= base_url("kaprodi/detailPembimbing/".$mpp['id_dosen']) ?>" data-toggle="tooltip" title="Detail"><i class="fas fa-info-circle"></i></a>
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
    <script src="<?= base_url("assets/js/kaprodi/pembimbing.js");?>"></script>
<?= $this->endSection(); ?>