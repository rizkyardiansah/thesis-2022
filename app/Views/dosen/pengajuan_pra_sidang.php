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
                <table class="table table-bordered" id="tablePengajuan" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NPM</th>
                            <th>Judul</th>
                            <th>Pembimbing Ilmu</th>
                            <th>Pembimbing Agama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 1;
                        foreach($daftarPengajuan as $dp):
                        ?>
                            <tr>
                                <td><?= $counter ?></td>
                                <td><?= $dp['nama_mahasiswa'] ?></td>
                                <td><?= $dp['npm'] ?></td>
                                <td><?= $dp['judul'] ?></td>
                                <td><?= $dp['nama_pembimbing1'] ?></td>
                                <td><?= $dp['nama_pembimbing_agama'] ?></td>
                                <td>
                                    <a role="button" class="btn btn-primary" href="<?= base_url("dosen/detailPengajuanPrasidang/".$dp['id']) ?>">Detail</a>
                                </td>
                            </tr>
                        <?php 
                        $counter++;
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

   

<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
    <script src="<?= base_url("assets/js/dosen/pengajuanPraSidang.js");?>"></script>
<?= $this->endSection(); ?>