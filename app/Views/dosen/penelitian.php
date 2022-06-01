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
                <div class="col-lg-3 d-flex align-items-center">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#tambahPenelitian">Tambahkan Penelitian</button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="daftarPenelitian" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Bidang</th>
                            <th>Jumlah Peneliti</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 1 ?>
                        <?php foreach($daftarPenelitian as $dp): ?>
                            <tr>
                                <td><?= $counter ?></td>
                                <td class="judul"><?= $dp['judul'] ?></td>
                                <td class="deskripsi"><?= $dp['deskripsi'] ?></td>
                                <td data-toggle="tooltip" title="<?= $dp['nama_bidang'] ?>" data-placement="top" class="bidang" data-id="<?= $dp['id_bidang'] ?>"><?= $dp['inisial_bidang'] ?></td>
                                <td class="jumlah_peneliti"><?= $dp['jumlah_peneliti'] ?> Orang</td>
                                <td class="status"><?= $dp['status'] ?></td>
                                <td>
                                    <button class="btn btn-primary ubah-penelitian" data-toggle="tooltip" title="Ubah" data-placement="top" data-id="<?= $dp['id'] ?>"><i class="fas fa-edit"></i></button>
                                    <form action="<?= base_url("dosen/deletePenelitian/".$dp['id']) ?>" method="post">
                                        <button class="btn btn-danger" data-toggle="tooltip" title="Hapus" data-placement="top" type="submit"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <?php $counter++ ?>
                        <?php endforeach; ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- modal tambah penelitian -->
    <div class="modal fade" id="tambahPenelitian" tabindex="-1" role="dialog" aria-labelledby="tambahPenelitianLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPenelitianLabel">Tambahkan Penelitian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url("dosen/insertPenelitian") ?>" method="post" id="formTambahPenelitian">
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" id="id_dosen" name="id_dosen" value="<?= $dataAkun['id'] ?>">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="judul">Judul</label>
                                    <textarea class="form-control" id="judul" name="judul" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="jumlah_peneliti">Jumlah Peneliti</label>
                                    <input type="text" class="form-control" id="jumlah_peneliti" name="jumlah_peneliti">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="bidang">Bidang</label>
                                    <select class="form-control" id="bidang" name="bidang">
                                        <option value="none" selected disabled> - Pilih Bidang - </option>
                                        <?php foreach($bidang as $b) : ?>
                                                <option value="<?= $b['id'] ?>"><?= $b['inisial']. " | " .$b['nama'] ?></option>
                                        <?php endforeach; ?>
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

    <!-- modal tambah penelitian -->
    <div class="modal fade" id="ubahPenelitian" tabindex="-1" role="dialog" aria-labelledby="ubahPenelitianLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahPenelitianLabel">Ubah Penelitian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="formUbahPenelitian">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="judul">Judul</label>
                                    <textarea class="form-control" id="judul" name="judul" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="jumlah_peneliti">Jumlah Peneliti</label>
                                    <input type="text" class="form-control" id="jumlah_peneliti" name="jumlah_peneliti">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="bidang">Bidang</label>
                                    <select class="form-control" id="bidang" name="bidang">
                                        <option value="none" selected disabled> - Pilih Bidang - </option>
                                        <?php foreach($bidang as $b) : ?>
                                                <option value="<?= $b['id'] ?>"><?= $b['inisial']. " | " .$b['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="none" selected disabled> - Pilih Status - </option>
                                        <option value="TERSEDIA">TERSEDIA</option>
                                        <option value="TIDAK TERSEDIA">TIDAK TERSEDIA</option>
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
    <script src="<?= base_url("assets/js/dosen/penelitian.js");?>"></script>
<?= $this->endSection(); ?>