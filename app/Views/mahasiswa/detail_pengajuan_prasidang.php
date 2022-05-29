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
            <?php if ($detailPengajuan['status'] == 'TERTUNDA'): ?>
                <form action="<?= base_url("mahasiswa/updatePengajuanPrasidang/".$detailPengajuan['id']) ?>" id="editPengajuan" method="post" enctype="multipart/form-data">
            <?php endif; ?>
                <div class="row">
                    <input type="hidden" id="id_skripsi" name="id_skripsi" value="<?= $detailPengajuan['id_skripsi'] ?>">
                    <input type="hidden" id="npm" name="npm" value="<?= $detailPengajuan['npm'] ?>">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value=<?= $detailPengajuan['nama_mahasiswa'] ?> disabled>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="npm">NPM</label>
                            <input type="text" class="form-control" id="npm" name="npm" value=<?= $detailPengajuan['npm'] ?> disabled>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <textarea name="judul" id="judul" rows="2" class="form-control" disabled><?= $detailPengajuan['judul'] ?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="pembimbing1">Pembimbing Ilmu 1</label>
                            <input type="text" class="form-control" id="pembimbing1" name="pembimbing1" value="<?= $detailPengajuan['nama_pembimbing1'] ?>" disabled>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="pembimbing2">Pembimbing Ilmu 2</label>
                            <input type="text" class="form-control" id="pembimbing2" name="pembimbing2" value="<?= $detailPengajuan['nama_pembimbing2'] == null ? "-" : $detailPengajuan['nama_pembimbing2'] ; ?>" disabled>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="pembimbing_agama">Pembimbing Agama</label>
                            <input type="text" class="form-control" id="pembimbing_agama" name="pembimbing_agama" value="<?= $detailPengajuan['nama_pembimbing_agama'] ?>" disabled>
                        </div>
                    </div>

                    <div class="col-lg-12 my-2">
                        <label>File Draft Skripsi</label>
                        <?php if ($detailPengajuan['file_draft'] == null) : ?>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file_draft" name="file_draft">
                                    <label class="custom-file-label" for="file_draft">Pilih File Draft Skripsi</label>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="input-group">
                                <input type="text" class="form-control" value="<?= $detailPengajuan['file_draft'] ?>" readonly>
                                <div class="input-group-append">
                                    <a role="button" class="btn btn-outline-primary" id="tinjauDraft" data-id="<?= $detailPengajuan['id'] ?>">Tinjau</a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-lg-12 my-2">
                        <label>Lembar Persetujuan Seminar Prasidang</label>
                        <?php if ($detailPengajuan['lembar_persetujuan'] == null) : ?>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="lembar_persetujuan" name="lembar_persetujuan">
                                    <label class="custom-file-label" for="lembar_persetujuan">Pilih File Lembar Persetujuan Seminar Prasidang</label>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="input-group">
                                <input type="text" class="form-control" value="<?= $detailPengajuan['lembar_persetujuan'] ?>" readonly>
                                <div class="input-group-append">
                                    <a role="button" class="btn btn-outline-primary" id="tinjauPersetujuan" data-id="<?= $detailPengajuan['id'] ?>">Tinjau</a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-lg-12 my-2 d-flex justify-content-end">
                        <a class="btn btn-secondary mr-2" role="button" href="<?= base_url("mahasiswa/pengajuanPraSidang") ?>">Kembali</a>
                        <?php if ($detailPengajuan['status'] == 'TERTUNDA'): ?>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        <?php endif; ?>
                    </div>
                </div>
        <?php if ($detailPengajuan['status'] == 'TERTUNDA'): ?>
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
                        <?php if ($detailPengajuan['status'] == 'TERTUNDA'): ?>
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
    <script src="<?= base_url("assets/js/mahasiswa/detailPengajuanPrasidang.js");?>"></script>
<?= $this->endSection(); ?>