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
                    <form class="form-inline" action="<?= base_url("TenagaKependidikan/pengajuanSidangSkripsi") ?>" method="get">
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
                <table class="table table-bordered" id="daftarPengajuan" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPM</th>
                            <th>Nama</th>
                            <th>Program Studi</th>
                            <th>Judul</th>
                            <th>Pemb. Ilmu 1</th>
                            <th>Pemb. Ilmu 2</th>
                            <th>Pemb. Agama</th>
                            <th>Tanggal Pengajuan</th>
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
                                <td><?= $counter ?></td>
                                <td><?= $pss['npm'] ?></td>
                                <td><?= $pss['nama_mahasiswa'] ?></td>
                                <td data-toggle="tooltip" data-placement="top" title="<?= $pss['nama_prodi'] ?>"><?= $pss['inisial_prodi'] ?></td>
                                <td><?= $pss['judul'] ?></td>
                                <td data-toggle="tooltip" data-placement="top" title="<?= $pss['nama_pembimbing1'] ?>"><?= $pss['inisial_pembimbing1'] ?></td>
                                <td data-toggle="tooltip" data-placement="top" title="<?= $pss['nama_pembimbing2'] ?>"><?= $pss['inisial_pembimbing2'] == null ? "-" : $pss['inisial_pembimbing2'] ?></td>
                                <td data-toggle="tooltip" data-placement="top" title="<?= $pss['nama_pembimbing_agama'] ?>"><?= $pss['inisial_pembimbing_agama'] ?></td>
                                <td><?= date_format(date_create($pss['tanggal_pengajuan']), "d-m-Y") ?></td>
                                <td class="status"><?= $pss['status'] ?></td>
                                <td class="aksi">
                                    <a role="button" href="<?= base_url("TenagaKependidikan/detailPengajuanSidangSkripsi/".$pss['id']) ?>" class="btn btn-primary" data-toggle="tooltip" title="Detail"><i class="fas fa-info-circle"></i></a>
                                </td>
                            </tr>
                            <?php $counter++; ?>
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