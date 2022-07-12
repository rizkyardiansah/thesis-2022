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
            <?php if ($lastProposal == null): ?>
                <div class="alert alert-danger" role="alert">
                    <small>
                        Silahkan buat <strong>Proposal</strong> terlebih dahulu pada <a href="<?= base_url("mahasiswa/proposal") ?>">Menu Berikut</a>.
                    </small>
                </div>
            <?php elseif($lastProposal['status'] == "DITOLAK" || $lastProposal['status'] == 'TERTUNDA'): ?>
                <div class="alert alert-warning" role="alert">
                    <small>
                        Menu ini hanya dapat digunakan ketika <strong>Proposal</strong> anda telah <strong>Diterima</strong>.
                    </small>
                </div>
            <?php elseif(($lastProposal['status'] == 'DITERIMA' || $lastProposal['status'] == 'REVISI') && $lastSkripsi == null): ?>
                <div class="alert alert-info" role="alert">
                    <small>
                        Silahkan <strong>Tambahkan Skripsi</strong> anda.
                    </small>
                </div>
            <?php elseif ($lastSkripsi != null && $lastSkripsi['status'] == 'Lulus' ): ?>
                <div class="alert alert-success" role="alert">
                    <small>
                        Selamat anda dinyatakan <strong>Lulus</strong>. Silahkan unggah <strong>File Final Skripsi</strong> pada halaman ini dan unggah <strong>File Makalah</strong> anda pada <a href="<?= base_url("mahasiswa/makalah") ?>">Menu Berikut</a>.
                    </small>
                </div>
            <?php elseif ($lastSkripsi != null && $lastSkripsi['status'] == 'Tidak Lulus' ): ?>
                <div class="alert alert-danger" role="alert">
                    <small>
                        Maaf anda dinyatakan <strong>Tidak Lulus</strong>.
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
                    <?php if ($lastProposal == null || $lastProposal['status'] == 'DITOLAK' || $lastProposal['status'] == 'TERTUNDA' || ($lastSkripsi != null && $lastSkripsi['status'] != 'Tidak Lulus')) : ?>
                        <button class="btn btn-primary" disabled>Tambahkan Skripsi</button>
                    <?php elseif ($lastProposal['status'] == 'DITERIMA' || $lastProposal['status'] == 'REVISI' || $lastSkripsi == null || $lastSkripsi['status'] == 'Tidak Lulus'): ?>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahSkripsi">Tambahkan Skripsi</button>
                    <?php endif; ?>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="tableSkripsi" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Bidang</th>
                            <th>Sifat Penelitian</th>
                            <th>Sumber Penelitian</th>
                            <th>Pemb. Ilmu 1</th>
                            <th>Pemb. Ilmu 2</th>
                            <th>Pemb. Agama</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 1 ?>
                        <?php foreach($skripsi as $s): ?>
                            <tr>
                                <td><?= $counter ?></td>
                                <td class="judul" data-id="<?= $s['id'] ?>"><?= $s['judul'] ?></td>
                                <td class="bidang" data-toggle="tooltip" data-placement="top" title="<?= $s['nama_bidang'] ?>" data-id="<?= $s['id_bidang'] ?>"><?= $s['inisial_bidang'] ?></td>
                                <td class="sifat"><?= $s['sifat'] ?></td>
                                <td class="sumber"><?= $s['sumber'] ?></td>
                                <td data-toggle="tooltip" data-placement="top" title="<?= $s['nama_p1'] ?>"><?= ($s['inisial_p1'] == null) ? "-" : $s['inisial_p1'] ?></td>
                                <td data-toggle="tooltip" data-placement="top" title="<?= $s['nama_p2'] ?>"><?= ($s['inisial_p2'] == null) ? "-" : $s['inisial_p2'] ?></td>
                                <td data-toggle="tooltip" data-placement="top" title="<?= $s['nama_pagama'] ?>"><?= ($s['inisial_pagama'] == null) ? "-" : $s['inisial_pagama'] ?></td>
                                <td><?= $s['status'] ?></td>
                                <td>
                                    <a role="button" class="btn btn-primary" href="<?= base_url("mahasiswa/detailSkripsi/".$s['id']) ?>" data-toggle="tooltip" title="Detail"><i class="fas fa-info-circle"></i></a>
                                </td>
                            </tr>
                        <?php $counter++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- modal tambah skripsi -->
    <div class="modal fade" id="tambahSkripsi" tabindex="-1" role="dialog" aria-labelledby="tambahSkripsiLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahSkripsiLabel">Tambahkan Skripsi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url("mahasiswa/insertSkripsi") ?>" method="post" id="formTambahSkripsi">
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" id="npm" name="npm" value="<?= $mahasiswa['npm'] ?>">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="judul">Judul</label>
                                    <textarea class="form-control" id="judul" name="judul" rows="2"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="bidang">Bidang</label>
                                    <select class="form-control" name="bidang" id="bidang">
                                        <option value="none" selected disabled> - Pilih Bidang Penelitian - </option>
                                        <?php foreach($bidang as $b): ?>
                                            <option value="<?= $b['id'] ?>"><?= $b['inisial'] . ' | ' . $b['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="sifat">Sifat Penelitian</label>
                                    <select class="form-control" id="sifat" name="sifat">
                                        <option value="none" selected disabled> - Pilih Sifat Penelitian - </option>
                                        <option value="Baru">Baru</option>
                                        <option value="Lanjutan">Lanjutan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="sumber">Sumber Penelitian</label>
                                    <select class="form-control" id="sumber" name="sumber">
                                        <option value="none" selected disabled> - Pilih Sumber Penelitian - </option>
                                        <option value="Sendiri">Sendiri</option>
                                        <option value="Dosen">Dosen</option>
                                        <option value="Teman">Teman</option>
                                        <option value="Keluarga">Keluarga</option>
                                    </select>
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
    <script src="<?= base_url("assets/js/mahasiswa/skripsi.js");?>"></script>
<?= $this->endSection(); ?>