<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
<?php if (session()->getFlashdata("message")) : ?>
    <div id="flashdata" data-open="true">
        <p id="icon" hidden><?= session()->getFlashdata("message")["icon"]; ?></p>
        <p id="title" hidden><?= session()->getFlashdata("message")["title"]; ?></p>
        <p id="text" hidden><?= session()->getFlashdata("message")["text"]; ?></p>
    </div>
<?php endif; ?>
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <?= $title ?>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-start mb-3">
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahKegiatan">Tambahkan Kegiatan</button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="kegiatanSkripsi" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kegiatan</th>
                            <th>Tanggal Kegiatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $counter = 1;
                        foreach($kegiatanSkripsi as $k):?>
                            <tr>
                                <td><?= $counter ?></td>
                                <td class="nama-kegiatan"><?= $k["nama_kegiatan"]?></td>
                                <td class="tanggal-kegiatan"><?= date_format(date_create($k["tanggal_mulai"]), "d/M/Y") . " - " . date_format(date_create($k["tanggal_selesai"]), "d/M/Y")?></td>
                                <td>
                                    <button class="btn btn-primary ubah-kegiatan" data-toggle="tooltip" data-placement="top" title="Ubah" data-id="<?= $k['id'] ?>"><i class="fas fa-pencil-alt"></i></button>
                                    <form action="<?= base_url("fakultas/deleteKalender/" . $k['id']) ?>" method="post" class="d-inline" id="formHapusKegiatan">
                                        <button type="submit" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>    
                        <?php 
                        $counter = $counter + 1;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- modal tambah kegiatan -->
    <div class="modal fade" id="tambahKegiatan" tabindex="-1" role="dialog" aria-labelledby="tambahKegiatanLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahKegiatanLabel">Tambah Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formTambahKegiatan" method="post" action="<?= base_url("fakultas/insertKalender")?>">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="namaKegiatan">Nama Kegiatan</label>
                            <input type="text" class="form-control" id="namaKegiatan" name="namaKegiatan" required>
                        </div>
                        <div class="form-group">
                            <label for="durasiKegiatan">Durasi Kegiatan</label>
                            <input type="text" class="form-control" id="durasiKegiatan" name="durasiKegiatan" required>
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

    <!-- modal ubah kegiatan -->
    <div class="modal fade" id="ubahKegiatan" tabindex="-1" role="dialog" aria-labelledby="ubahKegiatanLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahKegiatanLabel">Ubah Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formUbahKegiatan" method="post" action="<?= base_url("fakultas/updateKalender") ?>">
                    <?= csrf_field() ?>
                    <input type="hidden" id="id" name="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="namaKegiatan">Nama Kegiatan</label>
                            <input type="text" class="form-control" id="namaKegiatan" name="namaKegiatan" required>
                        </div>
                        <div class="form-group">
                            <label for="durasiKegiatan">Durasi Kegiatan</label>
                            <input type="text" class="form-control" id="durasiKegiatan" name="durasiKegiatan" required>
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
    <script src="<?= base_url("assets/vendor/daterangepicker/daterangepicker.js") ?>"></script>
    <script src="<?= base_url("assets/js/fakultas/kalender.js");?>"></script>
<?= $this->endSection(); ?>