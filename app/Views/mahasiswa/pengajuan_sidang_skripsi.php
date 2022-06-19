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
            <?php elseif ($seminarPrasidang == null || $seminarPrasidang['status'] != 'LAYAK SIDANG'): ?>
                <div class="alert alert-danger" role="alert">
                    <small>
                        Lakukan <strong>Seminar Prasidang</strong> terlebih dahulu dan pastikan Anda dinyatakan <strong>Layak Sidang</strong>.
                    </small>
                </div>
            <?php elseif ($lastSkripsi != null && count($pengajuanSidangSkripsi) > 0 && $pengajuanSidangSkripsi[count($pengajuanSidangSkripsi)-1]['id_skripsi'] == $lastSkripsi['id'] && $pengajuanSidangSkripsi[count($pengajuanSidangSkripsi)-1]['status'] == 'TERTUNDA'): ?>
                <div class="alert alert-info" role="alert">
                    <small>
                        <strong>Pengajuan Sidang Skripsi</strong> anda telah berhasil <strong>Terkirim</strong>.
                    </small>
                </div>
            <?php elseif ($lastSkripsi != null && count($pengajuanSidangSkripsi) > 0 && $pengajuanSidangSkripsi[count($pengajuanSidangSkripsi)-1]['id_skripsi'] == $lastSkripsi['id'] && $pengajuanSidangSkripsi[count($pengajuanSidangSkripsi)-1]['status'] == 'DISETUJUI'): ?>
                <div class="alert alert-success" role="alert">
                    <small>
                        <strong>Pengajuan Sidang Skripsi</strong> anda telah <strong>Disetujui</strong>.
                    </small>
                </div>
            <?php elseif ($lastSkripsi != null && count($pengajuanSidangSkripsi) > 0 && $pengajuanSidangSkripsi[count($pengajuanSidangSkripsi)-1]['id_skripsi'] == $lastSkripsi['id'] && $pengajuanSidangSkripsi[count($pengajuanSidangSkripsi)-1]['status'] == 'DITOLAK'): ?>
                <div class="alert alert-danger" role="alert">
                    <small>
                        <strong>Pengajuan Sidang Skripsi</strong> anda <strong>Ditolak</strong>. Silahkan <strong>Perbaiki Pengajuan Terakhir</strong> Anda.
                    </small>
                </div>
            <?php elseif ($seminarPrasidang != null && $seminarPrasidang['status'] == 'LAYAK SIDANG'): ?>
                <div class="alert alert-info" role="alert">
                    <small>
                        Silahkan buat <strong>Pengajuan Sidang Skripsi</strong> anda.
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
                    <?php if ($lastSkripsi == null || $seminarPrasidang == null || $seminarPrasidang['status'] != 'LAYAK SIDANG' || ($lastSkripsi != null && count($pengajuanSidangSkripsi) > 0 && $pengajuanSidangSkripsi[count($pengajuanSidangSkripsi)-1]['id_skripsi'] == $lastSkripsi['id'])): ?>
                        <button class="btn btn-primary" disabled>Tambahkan Pengajuan</button>
                    <?php elseif ($lastSkripsi != null && $seminarPrasidang != null && $seminarPrasidang['status'] == 'LAYAK SIDANG'): ?>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahPengajuan">Tambahkan Pengajuan</button>
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
                        foreach($pengajuanSidangSkripsi as $pss):
                        ?>
                            <tr>
                                <td><?= $counter ?></td>
                                <td><?= $pss['judul'] ?></td>
                                <td><?= $pss['nama_bidang'] ?></td>
                                <td><?= $pss['sifat'] ?></td>
                                <td><?= $pss['sumber'] ?></td>
                                <td><?= date_format(date_create(strval($pss['tanggal_pengajuan'])), 'd-m-Y') ?></td>
                                <td><?= $pss['status'] ?></td>
                                <td>
                                    <a role="button" class="btn btn-primary" href="<?= base_url("mahasiswa/detailPengajuanSidangSkripsi/".$pss['id']) ?>" data-toggle="tooltip" title="Detail"><i class="fas fa-info-circle"></i></a>
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

    <div class="modal fade" id="tambahPengajuan" tabindex="-1" role="dialog" aria-labelledby="tambahPengajuanLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPengajuanLabel">Tambah Pengajuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url("mahasiswa/insertPengajuanSidangSkripsi") ?>" method="post" id="formTambahPengajuan" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <?php if ($lastSkripsi != null) : ?>
                                <input type="hidden" id="id_skripsi" name="id_skripsi" value="<?= $lastSkripsi['id'] ?>">
                            <?php endif; ?>
                            <input type="hidden" id="npm" name="npm" value="<?= $dataAkun['npm'] ?>">
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
                            <div class="col-lg-12 mb-3">
                                <label>Draft Final Skripsi</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file_draft_final" name="file_draft_final">
                                        <label class="custom-file-label" for="file_draft_final">Pilih File Draft Final Skripsi</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label>Formulir Bimbingan Skripsi</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file_form_bimbingan" name="file_form_bimbingan">
                                        <label class="custom-file-label" for="file_form_bimbingan">Pilih File Formulir Bimbingan Skripsi</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label>Form Persyaratan Sidang Skripsi</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file_persyaratan_sidang" name="file_persyaratan_sidang">
                                        <label class="custom-file-label" for="file_persyaratan_sidang">Pilih File Form Persyaratan Sidang Skripsi</label>
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
    <script src="<?= base_url("assets/js/mahasiswa/pengajuanSidangSkripsi.js");?>"></script>
<?= $this->endSection(); ?>