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
                <table class="table table-bordered" id="pengajuanSkripsi" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPM</th>
                            <th>Nama</th>
                            <th>Program Studi</th>
                            <th>SKS Lulus</th>
                            <th>Pembimbing Akademik</th>
                            <th>Matakuliah sedang diambil</th>
                            <th>Matakuliah akan diambil</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 1;
                        foreach($pengajuanPenulisanSkripsi as $pps) :
                        ?>
                            <tr>
                                <td><?= $counter; ?></td>
                                <td class="npm"><?= $pps['npm'] ?></td>
                                <td><?= $pps['nama_mahasiswa'] ?></td>
                                <td data-toggle="tooltip" data-placement="top" title="<?= $pps['nama_prodi'] ?>"><?= $pps['inisial_prodi'] ?></td>
                                <td><?= $pps['sks_lulus'] ?></td>
                                <td data-toggle="tooltip" data-placement="top" title="<?= $pps['nama_pembimbing_akademik'] ?>"><?= $pps['inisial_pembimbing_akademik'] ?></td>
                                <td><?= $pps['mk_sedang_diambil'] ?></td>
                                <td><?= $pps['mk_akan_diambil'] ?></td>
                                <td class="status"><?= ($pps['status_persetujuan_skripsi'] == null) ? "-" : $pps['status_persetujuan_skripsi'] ?></td>
                                <td class="aksi">
                                    <a role="button" class="btn btn-primary" href="<?= base_url("TenagaKependidikan/detailPengajuanSkripsi/".$pps['npm']) ?>">Detail</a>
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
    <script src="<?= base_url("assets/js/tenagakependidikan/pengajuanSkripsi.js");?>"></script>
<?= $this->endSection(); ?>