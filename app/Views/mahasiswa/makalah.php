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
            <?php if ($lastSkripsi == null || $lastSkripsi['status'] != 'Lulus' || $lastSkripsi['file_skripsi'] == null): ?>
                <div class="alert alert-danger" role="alert">
                    <small>
                        Fitur ini hanya dapat digunakan ketika anda sudah dinyatakan <strong>Lulus</strong> dan telah menggunggah <strong>Berkas Final Skripsi</strong>
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
            <?php if (count($makalah) == 0) : ?>
                <form action="<?= base_url("mahasiswa/insertMakalah") ?>" method="post" id="formUploadMakalah" enctype="multipart/form-data">
            <?php elseif (count($makalah) == 1): ?>
                <form action="<?= base_url("mahasiswa/updateMakalah/".$makalah[0]['id']) ?>" method="post" id="formUploadMakalah" enctype="multipart/form-data">
            <?php endif; ?>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="npm" name="npm" value="<?= $dataAkun['npm'] ?>">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <?php if ($lastSkripsi == null || $lastSkripsi['status'] != 'Lulus' || $lastSkripsi['file_skripsi'] == null): ?>
                                    <textarea class="form-control" id="judul" name="judul" rows="4" disabled></textarea>
                                <?php elseif (count($makalah) == 0) : ?>
                                    <textarea class="form-control" id="judul" name="judul" rows="4"></textarea>
                                <?php elseif (count($makalah) == 1): ?>
                                    <textarea class="form-control" id="judul" name="judul" rows="4"><?= $makalah[0]['judul'] ?></textarea>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi Singkat</label>
                                <?php if ($lastSkripsi == null || $lastSkripsi['status'] != 'Lulus'): ?>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" disabled></textarea>
                                <?php elseif (count($makalah) == 0) : ?>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"></textarea>
                                <?php elseif (count($makalah) == 1): ?>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"><?= $makalah[0]['deskripsi'] ?></textarea>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="kata_kunci">Kata Kunci</label>
                                <?php if ($lastSkripsi == null || $lastSkripsi['status'] != 'Lulus'): ?>
                                    <input type="text" class="form-control" id="kata_kunci" name="kata_kunci" disabled>
                                <?php elseif (count($makalah) == 0) : ?>
                                    <input type="text" class="form-control" id="kata_kunci" name="kata_kunci">
                                <?php elseif (count($makalah) == 1) : ?>
                                    <input type="text" class="form-control" id="kata_kunci" name="kata_kunci" value="<?= $makalah[0]['kata_kunci'] ?>">
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="bidang">Bidang</label>
                                <?php if ($lastSkripsi == null || $lastSkripsi['status'] != 'Lulus'): ?>
                                    <select class="form-control" id="bidang" name="bidang" disabled>
                                <?php elseif ($lastSkripsi != null && $lastSkripsi['status'] == 'Lulus'): ?>
                                    <select class="form-control" id="bidang" name="bidang">
                                <?php endif; ?>
                                    <option value="none" selected disabled> - Pilih Bidang - </option>
                                    <?php foreach($bidang as $b) : ?>
                                        <?php if (count($makalah) == 1 && $makalah[0]['id_bidang'] == $b['id']): ?>
                                            <option value="<?= $b['id'] ?>" selected><?= $b['inisial']. " | " .$b['nama'] ?></option>
                                        <?php else: ?>
                                            <option value="<?= $b['id'] ?>"><?= $b['inisial']. " | " .$b['nama'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <label>File Makalah</label>
                            <?php if ($lastSkripsi == null || $lastSkripsi['status'] != 'Lulus'): ?>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file_makalah" name="file_makalah" disabled>
                                        <label class="custom-file-label" for="file_makalah">Pilih File Makalah</label>
                                    </div>
                                </div>
                                <?php elseif (count($makalah) == 0) : ?>
                                    <small class="text-muted d-block">Unggah Makalah dalam format PDF dengan ukuran maksimal 10 MB</small>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="file_makalah" name="file_makalah">
                                            <label class="custom-file-label" for="file_makalah">Pilih File Makalah</label>
                                        </div>
                                    </div>
                                <?php elseif (count($makalah) == 1) : ?>
                                    <?php if ($makalah[0]['file_makalah'] == null) : ?>
                                        <small class="text-muted d-block">Unggah Makalah dalam format PDF dengan ukuran maksimal 10 MB</small>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="file_makalah" name="file_makalah">
                                                <label class="custom-file-label" for="file_makalah">Pilih File Makalah</label>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="<?= $makalah[0]['file_makalah'] ?>" readonly>
                                            <div class="input-group-append">
                                                <a role="button" class="btn btn-outline-primary" id="tinjauMakalah" data-id="<?= $makalah[0]['id'] ?>">Tinjau</a>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    
                                <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php if ($lastSkripsi != null && $lastSkripsi['status'] == 'Lulus' && $lastSkripsi['file_skripsi'] != null): ?>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <!-- modal untuk preview file -->
    <div class="modal fade" id="filePreview" tabindex="-1" role="dialog" aria-labelledby="filePreviewLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filePreviewLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="embed-responsive embed-responsive-16by9" id="previewContainer">
                                    <iframe class="embed-responsive-item" src=""></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <form action="" id="formUnduh" method="post">
                            <button class="btn btn-primary" type="submit">Unduh</button>
                        </form>
                        <?php if ($lastSkripsi != null && $lastSkripsi['status'] == 'Lulus'): ?>
                            <form action="" id="formHapus" method="post">
                                <button class="btn btn-danger" type="submit">Hapus</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
    <script src="<?= base_url("assets/js/mahasiswa/makalah.js");?>"></script>
<?= $this->endSection(); ?>