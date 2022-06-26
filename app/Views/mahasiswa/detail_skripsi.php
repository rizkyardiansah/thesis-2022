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
            <?php if ($detailSkripsi['status'] == 'Dalam Pengerjaan' || $detailSkripsi['status'] == 'Lulus'): ?>
                <form action="<?= base_url("mahasiswa/updateSkripsi/".$detailSkripsi['id']) ?>" id="editSkripsi" method="post" enctype="multipart/form-data">
            <?php endif; ?>
                <div class="row">
                    <input type="hidden" id="id_skripsi" name="id_skripsi" value="<?= $detailSkripsi['id'] ?>">
                    <input type="hidden" id="npm" name="npm" value="<?= $detailSkripsi['npm'] ?>">

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <textarea name="judul" id="judul" rows="2" class="form-control" <?= $detailSkripsi['status'] != 'Dalam Pengerjaan' ? 'readonly': ''; ?>><?= $detailSkripsi['judul'] ?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="bidang">Bidang Ilmu</label>
                            <select name="bidang" id="bidang" class="form-control" <?= $detailSkripsi['status'] != 'Dalam Pengerjaan' ? 'readonly': ''; ?>>
                                <?php foreach($bidang as $b) : ?>
                                    <?php if ($b['id'] == $detailSkripsi['id_bidang']) : ?>
                                        <option value="<?= $b['id'];?>" selected><?= $b['inisial'];?> | <?= $b['nama']; ?></option>
                                    <?php else: ?>
                                        <option value="<?= $b['id'];?>"><?= $b['inisial'];?> | <?= $b['nama']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="sifat">Sifat Penelitian</label>
                            <select class="form-control" id="sifat" name="sifat" <?= $detailSkripsi['status'] != 'Dalam Pengerjaan' ? 'readonly': ''; ?>>
                                <option value="Baru" <?= $detailSkripsi['sifat'] == 'Baru' ? 'selected' : ""; ?>>Baru</option>
                                <option value="Lanjutan" <?= $detailSkripsi['sifat'] == 'Lanjutan' ? 'selected' : ""; ?>>Lanjutan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="sumber">Sumber Penelitian</label>
                            <select class="form-control" id="sumber" name="sumber" <?= $detailSkripsi['status'] != 'Dalam Pengerjaan' ? 'readonly': ''; ?>>
                                <option value="Sendiri" <?= $detailSkripsi['sumber'] == 'Sendiri' ? "selected": "" ?>>Sendiri</option>
                                <option value="Dosen" <?= $detailSkripsi['sumber'] == 'Dosen' ? "selected": "" ?>>Dosen</option>
                                <option value="Teman" <?= $detailSkripsi['sumber'] == 'Teman' ? "selected": "" ?>>Teman</option>
                                <option value="Keluarga" <?= $detailSkripsi['sumber'] == 'Keluarga' ? "selected": "" ?>>Keluarga</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="status">Status Skripsi</label>
                            <input type="text" class="form-control" id="status" name="status" value="<?= $detailSkripsi['status'] ?>" disabled>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="pembimbing1">Pembimbing Ilmu 1</label>
                            <input type="text" class="form-control" id="pembimbing1" name="pembimbing1" value="<?= $detailSkripsi['inisial_pembimbing1'] ?> | <?= $detailSkripsi['nama_pembimbing1'] ?>" disabled>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="pembimbing2">Pembimbing Ilmu 2</label>
                            <input type="text" class="form-control" id="pembimbing2" name="pembimbing2" value="<?= $detailSkripsi['inisial_pembimbing2'] ?> <?= $detailSkripsi['inisial_pembimbing2'] == null ? "-": "|" ?> <?= $detailSkripsi['nama_pembimbing2'] ?>" disabled>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="pembimbing3">Pembimbing Agama</label>
                            <input type="text" class="form-control" id="pembimbing3" name="pembimbing3" value="<?= $detailSkripsi['inisial_pembimbing3'] ?> | <?= $detailSkripsi['nama_pembimbing3'] ?>" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="total_bimbingan_ilmu">Total Bimbingan Ilmu yang Disetujui</label>
                            <input type="text" class="form-control" id="total_bimbingan_ilmu" name="total_bimbingan_ilmu" value="<?= $detailSkripsi['total_bimbingan1'] + $detailSkripsi['total_bimbingan2'] ?>" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="total_bimbingan_ilmu">Total Bimbingan Ilmu yang Disetujui</label>
                            <input type="text" class="form-control" id="total_bimbingan_ilmu" name="total_bimbingan_ilmu" value="<?= $detailSkripsi['total_bimbingan3']?>" disabled>
                        </div>
                    </div>
                    <div class="col-lg-12 my-1">
                        <label>File Final Skripsi</label>
                        <?php if ($detailSkripsi['file_skripsi'] == null && $detailSkripsi['status'] == 'Lulus') : ?>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file_skripsi" name="file_skripsi">
                                    <label class="custom-file-label" for="file_skripsi">Pilih File Final Skripsi</label>
                                </div>
                            </div>
                        <?php elseif ($detailSkripsi['file_skripsi'] != null && $detailSkripsi['status'] == 'Lulus'): ?>
                            <div class="input-group">
                                <input type="text" class="form-control" value="<?= $detailSkripsi['file_skripsi'] ?>" readonly>
                                <div class="input-group-append">
                                    <a role="button" class="btn btn-outline-primary" id="tinjauSkripsi" data-id="<?= $detailSkripsi['id'] ?>">Tinjau</a>
                                </div>
                            </div>
                        <?php elseif ($detailSkripsi['status'] == 'Dalam Pengerjaan' || $detailSkripsi['status'] == 'Tidak Lulus') : ?>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file_skripsi" name="file_skripsi" disabled>
                                    <label class="custom-file-label" for="file_skripsi">Pilih File Final Skripsi</label>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-lg-12 my-2 d-flex justify-content-end">
                        <a class="btn btn-secondary mr-2" role="button" href="<?= base_url("mahasiswa/skripsi") ?>">Kembali</a>
                        <?php if ($detailSkripsi['status'] == 'Dalam Pengerjaan' || $detailSkripsi['status'] == 'Lulus'): ?>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        <?php endif; ?>
                    </div>
                </div>
        <?php if ($detailSkripsi['status'] == 'Dalam Pengerjaan' || $detailSkripsi['status'] == 'Lulus'): ?>
            </form>
        <?php endif; ?>
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
                        <form action="" id="formUnduh">
                            <button class="btn btn-primary" type="submit">Unduh</button>
                        </form>
                        <?php if ($detailSkripsi['status'] == 'Lulus'): ?>
                            <form action="" id="formHapus">
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
    <script src="<?= base_url("assets/js/mahasiswa/detailSkripsi.js");?>"></script>
<?= $this->endSection(); ?>