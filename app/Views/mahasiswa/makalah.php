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
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="file_makalah" name="file_makalah">
                                            <label class="custom-file-label" for="file_makalah">Pilih File Makalah</label>
                                        </div>
                                    </div>
                                <?php elseif (count($makalah) == 1) : ?>
                                    <div class="form-group">
                                        <div class="embed-responsive embed-responsive-16by9" id="previewContainer">
                                            <iframe class="embed-responsive-item" src="<?= base_url("folderMakalah/".$makalah[0]['file_makalah']) ?>"></iframe>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="file_makalah" name="file_makalah">
                                            <label class="custom-file-label" for="file_makalah">Pilih File Makalah</label>
                                        </div>
                                    </div>
                                    <small>Unggah makalah baru jika ingin memperbarui file makalah</small>
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
<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
    <script src="<?= base_url("assets/js/mahasiswa/makalah.js");?>"></script>
<?= $this->endSection(); ?>