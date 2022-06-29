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
            <div class="row">
                <div class="col-lg-5"></div>
                <div class="col-lg-7 d-flex justify-content-end align-items-center">
                    <form class="form-inline" action="<?= base_url("TenagaKependidikan/pengajuanPrasidang") ?>" method="get">
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
                <table class="table table-bordered" id="tablePengajuan" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPM</th>
                            <th>Nama</th>
                            <th>Program Studi</th>
                            <th>Judul</th>
                            <th>Pembimbing Ilmu 1</th>
                            <th>Pembimbing Ilmu 2</th>
                            <th>Pembimbing Agama</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 1;
                        foreach($daftarPengajuan as $dp):
                        ?>
                            <tr>
                                <td><?= $counter; ?></td>
                                <td><?= $dp['npm'] ?></td>
                                <td><?= $dp['nama_mahasiswa'] ?></td>
                                <td data-toggle="tooltip" data-placement="top" title="<?= $dp['nama_prodi'] ?>"><?= $dp['inisial_prodi'] ?></td>
                                <td><?= $dp['judul'] ?></td>
                                <td data-toggle="tooltip" data-placement="top" title="<?= $dp['nama_pembimbing1'] ?>"><?= $dp['inisial_pembimbing1'] ?></td>
                                <td data-toggle="tooltip" data-placement="top" title="<?= $dp['nama_pembimbing2'] ?>"><?= $dp['inisial_pembimbing2'] == null ? "-" : $dp['inisial_pembimbing2'] ?></td>
                                <td data-toggle="tooltip" data-placement="top" title="<?= $dp['nama_pembimbing_agama'] ?>"><?= $dp['inisial_pembimbing_agama'] ?></td>
                                <td><?= date_format(date_create($dp['tanggal_pengajuan']), "d-m-Y") ?></td>
                                <td class="status"><?= $dp['status'] ?></td>
                                <td>
                                    <a role="button" class="btn btn-primary" href="<?= base_url("TenagaKependidikan/detailPengajuanPrasidang/".$dp['id']) ?>" data-toggle="tooltip" title="Detail"><i class="fas fa-info-circle"></i></a>
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
    <script src="<?= base_url("assets/js/tenagakependidikan/pengajuanPraSidang.js");?>"></script>
<?= $this->endSection(); ?>