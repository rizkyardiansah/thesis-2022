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
                <table class="table table-bordered" id="daftarPengajuan" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NPM</th>
                            <th>Nama</th>
                            <th>Program Studi</th>
                            <th>Judul</th>
                            <th>Pembimbing Ilmu 1</th>
                            <th>Pembimbing Ilmu 2</th>
                            <th>Pembimbing Agama</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 1;
                        foreach($pengajuanSidangSkripsi as $pss) :
                        ?>
                            <tr>
                                <td><?= $pss['npm'] ?></td>
                                <td><?= $pss['nama_mahasiswa'] ?></td>
                                <td data-toggle="tooltip" data-placement="top" title="<?= $pss['nama_prodi'] ?>"><?= $pss['inisial_prodi'] ?></td>
                                <td><?= $pss['judul'] ?></td>
                                <td data-toggle="tooltip" data-placement="top" title="<?= $pss['nama_pembimbing1'] ?>"><?= $pss['inisial_pembimbing1'] ?></td>
                                <td data-toggle="tooltip" data-placement="top" title="<?= $pss['nama_pembimbing2'] ?>"><?= $pss['inisial_pembimbing2'] == null ? "-" : $pss['inisial_pembimbing2'] ?></td>
                                <td data-toggle="tooltip" data-placement="top" title="<?= $pss['nama_pembimbing_agama'] ?>"><?= $pss['inisial_pembimbing_agama'] ?></td>
                                <td class="status"><?= $pss['status'] ?></td>
                                <td class="aksi">
                                    <a role="button" href="<?= base_url("TenagaKependidikan/detailPengajuanSidangSkripsi/".$pss['id']) ?>" class="btn btn-primary">Detail</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
    <script src="<?= base_url("assets/js/tenagakependidikan/pengajuanSidangSkripsi.js");?>"></script>
<?= $this->endSection(); ?>