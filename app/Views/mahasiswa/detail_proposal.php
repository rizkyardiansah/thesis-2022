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
            <?php if ($detailProposal['status'] == 'TERTUNDA'): ?>
                <form action="<?= base_url("mahasiswa/updateProposal/".$detailProposal['id']) ?>" id="editProposal" method="post" enctype="multipart/form-data">
            <?php endif; ?>
                <div class="row">
                    <input type="hidden" id="id_proposal" name="id_proposal" value="<?= $detailProposal['id'] ?>">
                    <input type="hidden" id="npm" name="npm" value="<?= $detailProposal['npm'] ?>">

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <textarea name="judul" id="judul" rows="2" class="form-control" <?= $detailProposal['status'] != 'TERTUNDA' ? 'disabled': ''; ?>><?= $detailProposal['judul'] ?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="bidang">Bidang</label>
                            <select name="bidang" id="bidang" class="form-control" <?= $detailProposal['status'] != 'TERTUNDA' ? 'disabled': ''; ?>>
                                <?php foreach($bidang as $b) : ?>
                                    <?php if ($b['id'] == $detailProposal['id_bidang']) : ?>
                                        <option value="<?= $b['id'];?>" selected><?= $b['inisial'];?> | <?= $b['nama']; ?></option>
                                    <?php else: ?>
                                        <option value="<?= $b['id'];?>"><?= $b['inisial'];?> | <?= $b['nama']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="dosen_usulan1">Dosen Usulan 1</label>
                            <select name="dosen_usulan1" id="dosen_usulan1" class="form-control" <?= $detailProposal['status'] != 'TERTUNDA' ? 'disabled': ''; ?>>
                                <?php foreach($dosen as $d) : ?>
                                    <?php if ($d['id'] == $detailProposal['dosen_usulan1']) : ?>
                                        <option value="<?= $d['id'];?>" selected><?= $d['inisial'];?> | <?= $d['nama']; ?></option>
                                    <?php else: ?>
                                        <option value="<?= $d['id'];?>"><?= $d['inisial'];?> | <?= $d['nama']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="dosen_usulan2">Dosen Usulan 2</label>
                            <select name="dosen_usulan2" id="dosen_usulan2" class="form-control" <?= $detailProposal['status'] != 'TERTUNDA' ? 'disabled': ''; ?>>
                                <?php foreach($dosen as $d) : ?>
                                    <?php if ($d['id'] == $detailProposal['dosen_usulan2']) : ?>
                                        <option value="<?= $d['id'];?>" selected><?= $d['inisial'];?> | <?= $d['nama']; ?></option>
                                    <?php else: ?>
                                        <option value="<?= $d['id'];?>"><?= $d['inisial'];?> | <?= $d['nama']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="sifat">Sifat Penelitian</label>
                            <select class="form-control" id="sifat" name="sifat" <?= $detailProposal['status'] != 'TERTUNDA' ? 'disabled': ''; ?>>
                                <option value="Baru" <?= $detailProposal['sifat'] == 'Baru' ? 'selected' : ""; ?>>Baru</option>
                                <option value="Lanjutan" <?= $detailProposal['sifat'] == 'Lanjutan' ? 'selected' : ""; ?>>Lanjutan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="sumber">Sumber Penelitian</label>
                            <select class="form-control" id="sumber" name="sumber" <?= $detailProposal['status'] != 'TERTUNDA' ? 'disabled': ''; ?>>
                                <option value="Sendiri" <?= $detailProposal['sumber'] == 'Sendiri' ? "selected": "" ?>>Sendiri</option>
                                <option value="Dosen" <?= $detailProposal['sumber'] == 'Dosen' ? "selected": "" ?>>Dosen</option>
                                <option value="Teman" <?= $detailProposal['sumber'] == 'Teman' ? "selected": "" ?>>Teman</option>
                                <option value="Keluarga" <?= $detailProposal['sumber'] == 'Keluarga' ? "selected": "" ?>>Keluarga</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="status">Status Proposal</label>
                            <input type="text" class="form-control" id="status" name="status" value="<?= $detailProposal['status'] ?>" disabled>
                        </div>
                    </div>
                     <div class="col-lg-12">
                        <div class="form-group">
                            <label for="komentar">Komentar</label>
                            <textarea name="komentar" id="komentar" rows="2" class="form-control" disabled><?= $detailProposal['komentar'] == null ? "-": $detailProposal['komentar']; ?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12 my-1">
                        <label>File Proposal</label>
                        <?php if ($detailProposal['file_proposal'] == null) : ?>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file_proposal" name="file_proposal">
                                    <label class="custom-file-label" for="file_proposal">Pilih File Proposal</label>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="input-group">
                                <input type="text" class="form-control" value="<?= $detailProposal['file_proposal'] ?>" readonly>
                                <div class="input-group-append">
                                    <a role="button" class="btn btn-outline-primary" id="tinjauProposal" data-id="<?= $detailProposal['id'] ?>">Tinjau</a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-lg-12 my-2 d-flex justify-content-end">
                        <a class="btn btn-secondary mr-2" role="button" href="<?= base_url("mahasiswa/proposal") ?>">Kembali</a>
                        <?php if ($detailProposal['status'] == 'TERTUNDA'): ?>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        <?php endif; ?>
                    </div>
                </div>
        <?php if ($detailProposal['status'] == 'TERTUNDA'): ?>
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
                        <?php if ($detailProposal['status'] == 'TERTUNDA'): ?>
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
    <script src="<?= base_url("assets/js/mahasiswa/detailProposal.js");?>"></script>
<?= $this->endSection(); ?>