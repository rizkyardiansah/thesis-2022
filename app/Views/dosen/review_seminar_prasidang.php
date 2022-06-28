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
            <form action="<?= base_url("dosen/komentariSeminarPrasidang/".$detailSeminarPrasidang['id']) ?>" method="post" id="formReviewSempra">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="nama">Nama Mahasiswa</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $detailSeminarPrasidang['nama_mahasiswa'] ?>" disabled>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="npm">NPM</label>
                            <input type="text" class="form-control" id="npm" name="npm" value="<?= $detailSeminarPrasidang['npm'] ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="bidang">Bidang</label>
                            <input class="form-control" id="bidang" name="bidang" value="<?= $detailSeminarPrasidang['nama_bidang'] ?>" disabled>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <textarea class="form-control" id="judul" name="judul" disabled><?= $detailSeminarPrasidang['judul'] ?></textarea>
                        </div>
                    </div>
                    
                    <?php if ($detailSeminarPrasidang['pembimbing2'] == null): ?>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="pembimbing1">Pembimbing Ilmu</label>
                                <input class="form-control" id="pembimbing1" name="pembimbing1" value="<?= $detailSeminarPrasidang['pembimbing1'] ?>" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="pembimbingAgama">Pembimbing Agama</label>
                                <input class="form-control" id="pembimbingAgama" name="pembimbingAgama" value="<?= $detailSeminarPrasidang['pembimbing_agama'] ?>" disabled>
                            </div>
                        </div>
                    <?php else: ?>
                         <div class="col-lg-4">
                            <div class="form-group">
                                <label for="pembimbing1">Pembimbing Ilmu 1</label>
                                <input class="form-control" id="pembimbing1" name="pembimbing1" value="<?= $detailSeminarPrasidang['pembimbing1'] ?>" disabled>
                            </div>
                        </div>
                         <div class="col-lg-4">
                            <div class="form-group">
                                <label for="pembimbing2">Pembimbing Ilmu 2</label>
                                <input class="form-control" id="pembimbing2" name="pembimbing2" value="<?= $detailSeminarPrasidang['pembimbing2'] ?>" disabled>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="pembimbingAgama">Pembimbing Agama</label>
                                <input class="form-control" id="pembimbingAgama" name="pembimbingAgama" value="<?= $detailSeminarPrasidang['pembimbing_agama'] ?>" disabled>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="komentar">Hasil Review</label>
                            <textarea class="form-control" id="komentar" name="komentar" rows="4" <?= $detailSeminarPrasidang['status'] != 'TERTUNDA' ? "disabled": "" ; ?>><?= $detailSeminarPrasidang['komentar_reviewer'] ?></textarea>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <label for="komentar">Status</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="layakSidang" value="LAYAK SIDANG" <?= $detailSeminarPrasidang['status'] == 'LAYAK SIDANG' ? 'checked' : '' ?> <?= $detailSeminarPrasidang['status'] != 'TERTUNDA' ? "disabled": "" ; ?>>
                            <label class="form-check-label" for="layakSidang">
                                Layak Sidang
                            </label>
                        </div>
                        <div class="form-check last">
                            <input class="form-check-input" type="radio" name="status" id="tidakLayakSidang" value="TIDAK LAYAK SIDANG" <?= $detailSeminarPrasidang['status'] == 'TIDAK LAYAK SIDANG' ? 'checked' : '' ?> <?= $detailSeminarPrasidang['status'] != 'TERTUNDA' ? "disabled": "" ; ?>>
                            <label class="form-check-label" for="tidakLayakSidang">
                                Tidak Layak Sidang
                            </label>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <label for="komentar">Rekomendasi Kluster Nilai</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="rekomendasi_nilai" id="rendah" value="RENDAH" <?= $detailSeminarPrasidang['rekomendasi_nilai'] == 'RENDAH' ? 'checked' : '' ?> <?= $detailSeminarPrasidang['rekomendasi_nilai'] != null ? "disabled": "" ; ?>>
                            <label class="form-check-label" for="rendah">
                                Rendah
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="rekomendasi_nilai" id="sedang" value="SEDANG" <?= $detailSeminarPrasidang['rekomendasi_nilai'] == 'SEDANG' ? 'checked' : '' ?> <?= $detailSeminarPrasidang['rekomendasi_nilai'] != null ? "disabled": "" ; ?>>
                            <label class="form-check-label" for="sedang">
                                Sedang
                            </label>
                        </div>
                        <div class="form-check last">
                            <input class="form-check-input" type="radio" name="rekomendasi_nilai" id="tinggi" value="TINGGI" <?= $detailSeminarPrasidang['rekomendasi_nilai'] == 'TINGGI' ? 'checked' : '' ?> <?= $detailSeminarPrasidang['rekomendasi_nilai'] != null ? "disabled": "" ; ?>>
                            <label class="form-check-label" for="tinggi">
                                Tinggi
                            </label>
                        </div>
                    </div>

                    <div class="col-lg-12 mb-3">
                        <div class="form-group">
                            <label for="file_draft">Draft Skripsi</label>
                            <div class="embed-responsive embed-responsive-16by9 mx-auto" id="file_draft" style="width: 90%">
                                <iframe class="embed-responsive-item" src="<?= base_url("folderDraft/".$detailSeminarPrasidang['file_draft']) ?>"></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <div class="form-group">
                            <label for="lembar_persetujuan">Lembar Persetujuan</label>
                            <div class="embed-responsive embed-responsive-16by9 mx-auto" id="lembar_persetujuan" style="width: 90%">
                                <iframe class="embed-responsive-item" src="<?= base_url("folderLembarPersetujuanPrasidang/".$detailSeminarPrasidang['lembar_persetujuan']) ?>"></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 d-flex justify-content-end">
                        <a role="button" class="btn btn-secondary mr-3" href="<?= base_url("dosen/pengujiSeminarPrasidang") ?>">Kembali</a>
                        <?php if ($detailSeminarPrasidang['status'] == 'TERTUNDA') : ?>
                            <button class="btn btn-primary ubah-proposal" type="submit">Simpan</button>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
    <script src="<?= base_url("assets/js/dosen/reviewSeminarPrasidang.js");?>" defer></script>
<?= $this->endSection(); ?>