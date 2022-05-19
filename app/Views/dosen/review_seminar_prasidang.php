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
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nama">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $detailSeminarPrasidang['nama_mahasiswa'] ?>" disabled>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="npm">NPM</label>
                        <input type="text" class="form-control" id="npm" name="npm" value="<?= $detailSeminarPrasidang['npm'] ?>" disabled>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <textarea class="form-control" id="judul" name="judul" disabled><?= $detailSeminarPrasidang['judul'] ?></textarea>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="bidang">Bidang</label>
                        <input class="form-control" id="bidang" name="bidang" value="<?= $detailSeminarPrasidang['nama_bidang'] ?>" disabled>
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
                        <label for="penguji1">Penguji 1</label>
                        <input class="form-control" id="penguji1" name="penguji1" value="<?= $detailSeminarPrasidang['nama_penguji1'] ?>" disabled>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="penguji2">Penguji 2</label>
                        <input class="form-control" id="penguji2" name="penguji2" value="<?= $detailSeminarPrasidang['nama_penguji2'] == null ? "-": $detailSeminarPrasidang['nama_penguji2'] ;  ?>" disabled>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="komentar1">Hasil Review Penguji 1</label>
                        <textarea class="form-control" id="komentar1" name="komentar1" <?= $detailSeminarPrasidang['dosen_penguji1'] != $dataAkun['id'] ? "disabled": "" ; ?>><?= $detailSeminarPrasidang['komentar_penguji1'] ?></textarea>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="komentar2">Hasil Review Penguji 2</label>
                        <textarea class="form-control" id="komentar2" name="komentar2" <?= $detailSeminarPrasidang['dosen_penguji2'] != $dataAkun['id'] ? "disabled": "" ; ?>><?= $detailSeminarPrasidang['komentar_penguji2'] ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal untuk menilai seminar proposal -->
    <div class="modal fade" id="penilaianSempro" tabindex="-1" role="dialog" aria-labelledby="penilaianSemproLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="penilaianSemproLabel">Penilaian Seminar Proposal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="formPenilaianSempro">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="komentar">Komentar</label>
                                    <textarea class="form-control" id="komentar" name="komentar" rows="8"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label>Status Proposal</label>
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="statusDiterima" value="DITERIMA">
                                        <label class="form-check-label" for="statusDiterima">Diterima</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="statusRevisi" value="REVISI">
                                        <label class="form-check-label" for="statusRevisi">Revisi</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="statusDitolak" value="DITOLAK">
                                        <label class="form-check-label" for="statusDitolak">Ditolak</label>
                                    </div>
                                </div>
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
    <script src="<?= base_url("assets/js/dosen/pengujiSeminarProposal.js");?>" defer></script>
<?= $this->endSection(); ?>