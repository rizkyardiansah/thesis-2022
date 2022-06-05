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
    <div class="row">
        <div class="col-lg-12">
            <?php if ($lastSkripsi == null): ?>
                <div class="alert alert-danger" role="alert">
                    <small>
                        <strong>Tambahkan Skripsi</strong> terlebih dahulu pada <a href="<?= base_url("mahasiswa/skripsi") ?>">Menu Berikut</a>.
                    </small>
                </div>
            <?php elseif (($lastSkripsi != null && count($pengajuanPrasidang) == 0)  || ($lastSkripsi['id'] != $pengajuanPrasidang[0]['id_skripsi'])): ?>
                <div class="alert alert-info" role="alert">
                    <small>
                        Silahkan buat <strong>Pengajuan Seminar Prasidang</strong> pada halaman ini.
                    </small>
                </div>
            <?php elseif ($lastSkripsi != null && count($pengajuanPrasidang) > 0 && $lastSkripsi['id'] == $pengajuanPrasidang[0]['id_skripsi'] && $pengajuanPrasidang[0]['status'] == 'TERTUNDA'): ?>
                <div class="alert alert-info" role="alert">
                    <small>
                        <strong>Pengajuan Seminar Prasidang</strong> anda telah terkirim.
                    </small>
                </div>
            <?php elseif ($lastSkripsi != null && count($pengajuanPrasidang) > 0 && $lastSkripsi['id'] == $pengajuanPrasidang[0]['id_skripsi'] && $pengajuanPrasidang[0]['status'] == 'DISETUJUI'): ?>
                <div class="alert alert-success" role="alert">
                    <small>
                        <strong>Pengajuan Seminar Prasidang</strong> anda telah <strong>Disetujui</strong>. Kaprodi akan membagikan <strong>Jadwal Seminar Prasidang</strong> anda.
                    </small>
                </div>
            <?php elseif ($lastSkripsi != null && count($pengajuanPrasidang) > 0 && $lastSkripsi['id'] == $pengajuanPrasidang[0]['id_skripsi'] && $pengajuanPrasidang[0]['status'] == 'DITOLAK'): ?>
                <div class="alert alert-danger" role="alert">
                    <small>
                        <strong>Pengajuan Seminar Prasidang</strong> anda <strong>Ditolak</strong>.
                    </small>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?= $title ?>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-lg-3 d-flex align-items-center">
                    <?php if ($lastSkripsi == null || ($lastSkripsi != null && count($pengajuanPrasidang) > 0 && $lastSkripsi['id'] == $pengajuanPrasidang[0]['id_skripsi'])): ?>
                        <button class="btn btn-primary" disabled>Tambahkan Pengajuan</button>
                    <?php elseif ($lastSkripsi != null): ?>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#pengajuanPraSidang">Tambahkan Pengajuan</button>
                    <?php endif; ?>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="tablePengajuan" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Bidang</th>
                            <th>Sifat Penelitian</th>
                            <th>Sumber Penelitian</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 1;
                        foreach($pengajuanPrasidang as $pp):
                        ?>
                            <tr>
                                <td><?= $counter ?></td>
                                <td data-id="<?= $pp['id_skripsi'] ?>" class="skripsi"><?= $pp['judul'] ?></td>
                                <td class="bidang"><?= $pp['nama_bidang'] ?></td>
                                <td class="sifat"><?= $pp['sifat'] ?></td>
                                <td class="sumber"><?= $pp['sumber'] ?></td>
                                <td><?= date_format(date_create(strval($pp['tanggal_pengajuan'])), 'd-m-Y') ?></td>
                                <td class="status"><?= $pp['status'] ?></td>
                                <td>
                                    <a role="button" class="btn btn-primary" href="<?= base_url("mahasiswa/detailPengajuanPraSidang/".$pp['id']) ?>" data-toggle="tooltip" title="Detail"><i class="fas fa-info-circle"></i></a>
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

    <!-- modal tambah proposal -->
    <div class="modal fade" id="pengajuanPraSidang" tabindex="-1" role="dialog" aria-labelledby="pengajuanPraSidangLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pengajuanPraSidangLabel">Tambahkan Pengajuan Seminar Pra Sidang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url("mahasiswa/insertPengajuanPraSidang") ?>" method="post" id="formPengajuanPraSidang" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <?php if ($lastSkripsi != null) : ?>
                                <input type="hidden" id="id_skripsi" name="id_skripsi" value="<?= $lastSkripsi['id'] ?>">
                            <?php endif; ?>
                            <input type="hidden" id="npm" name="npm" value="<?= $mahasiswa['npm'] ?>">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="judul">Judul</label>
                                    <?php if ($lastSkripsi != null) : ?>
                                        <textarea class="form-control" id="judul" name="judul" rows="2" disabled><?= $lastSkripsi['judul'] ?></textarea>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="bidang">Bidang</label>
                                    <?php if ($lastSkripsi != null) : ?>
                                        <input type="text" class="form-control" id="bidang" name="bidang" value="<?= $lastSkripsi   ['nama_bidang'] ?>" disabled>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="sifat">Sifat</label>
                                    <?php if ($lastSkripsi != null) : ?>
                                        <input type="text" class="form-control" id="sifat" name="sifat" value="<?= $lastSkripsi['sifat'] ?>" disabled>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="sumber">Sumber</label>
                                    <?php if ($lastSkripsi != null) : ?>
                                        <input type="text" class="form-control" id="sumber" name="sumber" value="<?= $lastSkripsi['sumber'] ?>" disabled>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label>File Draft Skripsi</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file_draft" name="file_draft">
                                        <label class="custom-file-label" for="file_draft">Pilih File Draft Skripsi</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label>Lembar Persetujuan Seminar Pra Sidang</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="lembar_persetujuan" name="lembar_persetujuan">
                                        <label class="custom-file-label" for="lembar_persetujuan">Pilih File Lembar Persetujuan Seminar Pra Sidang</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
    <script src="<?= base_url("assets/js/mahasiswa/pengajuanPraSidang.js");?>"></script>
<?= $this->endSection(); ?>