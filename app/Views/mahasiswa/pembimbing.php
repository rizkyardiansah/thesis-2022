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
            <div class="row mb-3">
                <?php if (count($dosenPembimbing) != 0 ) : ?>
                    <div class="col-lg-3 d-flex align-items-center">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#catatBimbingan">Catat Hasil Bimbingan</button>
                    </div>
                <?php else: ?>
                    <div class="col-lg-3 d-flex align-items-center">
                        <button class="btn btn-primary" disabled>Catat Hasil Bimbingan</button>
                    </div>
                    <div class="col-lg-9 d-flex align-items-center">
                        <div class="alert alert-warning" role="alert">
                            <small>Anda <strong>Belum</strong> mempunyai pembimbing</small>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="tableBimbingan" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Bimbingan</th>
                            <th>Materi Konsultasi</th>
                            <th>Dosen Pembimbing</th>
                            <th>Peran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 1; ?>
                        <?php foreach ($hasilBimbingan as $hb) : ?>
                            <tr>
                                <td><?= $counter?></td>
                                <td class="tanggal"><?= date_format(date_create($hb['tanggal_bimbingan']), 'd-m-Y')?></td>
                                <td class="hasil"><?= $hb['hasil_bimbingan'] ?></td>
                                <td class="dosen" data-id="<?= $hb['id_pembimbing'] ?>"><?= $hb['nama_dosen'] ?></td>
                                <td><?= $hb['role'] ?></td>
                                <td><?= $hb['status'] ?></td>
                                <td>
                                    <button class="btn btn-primary ubah-catatan" data-toggle="tooltip" data-placement="top" title="Ubah" data-id="<?= $hb['id'] ?>" <?= $hb['status'] == 'DISETUJUI' ? 'disabled' : '' ?>><i class="fas fa-pencil-alt"></i></button>
                                    <form action="<?= base_url("mahasiswa/deleteHasilBimbingan/" . $hb['id']) ?>" method="post" class="d-inline" id="formHapusCatatan">
                                        <button type="submit" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus" <?= $hb['status'] == 'DISETUJUI' ? 'disabled' : '' ?>><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <?php $counter++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="catatBimbingan" tabindex="-1" role="dialog" aria-labelledby="catatBimbinganLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="catatBimbinganLabel">Catat Hasil Bimbingan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url("mahasiswa/insertHasilBimbingan") ?>" method="post" id="formTambahHasilBimbingan">
                    <div class="modal-body">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="pembimbing">Pembimbing</label>
                                <select name="pembimbing" id="pembimbing" class="form-control">
                                    <option value="none" selected disabled> - Pilih Dosen Pembimbing - </option>
                                        <?php foreach($dosenPembimbing as $dp): ?>
                                            <option value="<?= $dp['id_pembimbing'] ?>"><?= $dp['nama_dosen'] . " | " . $dp['role'] ?></option>
                                        <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="tanggalBimbingan">Tanggal Bimbingan</label>
                                <input type="text" class="form-control" id="tanggalBimbingan" name="tanggalBimbingan" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="materi">Materi Bimbimngan</label>
                                <textarea name="materi" id="materi" rows="2" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ubahCatatan" tabindex="-1" role="dialog" aria-labelledby="ubahCatatanLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahCatatanLabel">Ubah Catatan Hasil Bimbingan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="formUbahHasilBimbingan">
                    <div class="modal-body">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="pembimbing">Pembimbing</label>
                                <select name="pembimbing" id="pembimbing" class="form-control">
                                    <option value="none" selected disabled> - Pilih Dosen Pembimbing - </option>
                                    <?php if ($dosenPembimbing != null): ?>
                                        <?php foreach($dosenPembimbing as $dp): ?>
                                            <option value="<?= $dp['id_pembimbing'] ?>"><?= $dp['nama_dosen'] . " | " . $dp['role'] ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="tanggalBimbingan">Tanggal Bimbingan</label>
                                <input type="text" class="form-control" id="tanggalBimbingan" name="tanggalBimbingan" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="materi">Materi Bimbimngan</label>
                                <textarea name="materi" id="materi" rows="2" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
    <script src="<?= base_url("assets/vendor/daterangepicker/daterangepicker.js") ?>"></script>
    <script src="<?= base_url("assets/js/mahasiswa/pembimbing.js");?>"></script>
<?= $this->endSection(); ?>