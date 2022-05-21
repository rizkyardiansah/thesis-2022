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
            <?php if ($lastSkripsi == null) : ?>
                <div class="alert alert-danger" role="alert">
                    <small>Kumpulkan <strong>Skripsi</strong> terlebih dahulu pada <a href="<?= base_url("mahasiswa/skripsi") ?>">Menu Berikut</a>.</small>
                </div>
            <?php elseif (count($lastSkripsi) > 0 && $lastSkripsi['status'] != 'Dalam Pengerjaan') : ?>
                <div class="alert alert-danger" role="alert">
                    <small>
                        Menu ini hanya dapat digunakan oleh mahasiswa yang <strong>Sedang Menulis Skripsi</strong>.
                    </small>
                </div>
            <?php elseif ($pengajuan == null) : ?>
                <div class="alert alert-danger" role="alert">
                    <small>Buat <strong>Pengajuan Seminar Prasidang</strong> terlebih dahulu pada <a href="<?= base_url("mahasiswa/pengajuanPraSidang") ?>">Menu Berikut</a>.</small>
                </div>
            <?php elseif ($pengajuan['status'] != 'DISETUJUI') : ?>
                <div class="alert alert-warning" role="alert">
                    <small>Pastikan <strong>Pengajuan Seminar Prasidang</strong> anda telah <strong>Disetujui</strong> oleh <strong>Kaprodi</strong>.</small>
                </div>
            <?php elseif ($pengajuan['status'] == 'DISETUJUI'): ?>
                <div class="alert alert-info" role="alert">
                    <small><strong>Jadwal Seminar Prasidang</strong> anda dapat dilihat pada tabel dibawah.</small>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?= $title ?>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="jadwalSeminarPrasidang" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Tanggal Seminar</th>
                            <th>Ruangan</th>
                            <th>Penguji 1</th>
                            <th>Penguji 2</th>
                            <th hidden>Masukan Penguji 1</th>
                            <th hidden>Masukan Penguji 2</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $counter = 1;
                    foreach($jadwalSeminarPrasidang as $jsp): ?>
                        <tr>
                            <td><?= $counter ?></td>
                            <td><?= $jsp['judul'] ?></td>
                            <td ><?= date_format(date_create($jsp['tanggal']), 'd-m-Y H:i') ?></td>
                            <td ><?= $jsp['ruangan'] ?></td>
                            <td data-toggle="tooltip" data-placement="top" title="<?= $jsp['nama_penguji1'] ?>"><?= $jsp['inisial_penguji1'] ?></td>
                        
                        <?php if ($jsp['dosen_penguji2'] != null) : ?>
                            <td data-toggle="tooltip" data-placement="top" title="<?= $jsp['nama_penguji2'] ?>"><?= $jsp['inisial_penguji2'] ?></td>
                        <?php else: ?>
                            <td>-</td>
                        <?php endif; ?>
                            <td hidden class="komentar1"><?= $jsp['komentar_penguji1'] ?></td>
                            <td hidden class="komentar2"><?= $jsp['komentar_penguji2'] ?></td>
                            <td>
                                <?php if ($jsp['komentar_penguji1'] == null): ?>
                                    <button class="btn btn-primary" disabled>Hasil</button>
                                <?php else: ?>
                                    <button class="btn btn-primary hasil-prasidang" data-toggle="modal" data-target="#hasilPrasidang">Hasil</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php
                    $counter++; 
                    endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="hasilPrasidang" tabindex="-1" role="dialog" aria-labelledby="hasilPrasidangLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hasilPrasidangLabel">Hasil Seminar Prasidang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="komentar1">Hasil Review Penguji 1</label>
                                <textarea name="komentar1" id="komentar1" rows="6" class="form-control" disabled></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="komentar2">Hasil Review Penguji 2</label>
                                <textarea name="komentar2" id="komentar2" rows="6" class="form-control" disabled></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
    <script src="<?= base_url("assets/js/mahasiswa/seminarPrasidang.js");?>"></script>
<?= $this->endSection(); ?>