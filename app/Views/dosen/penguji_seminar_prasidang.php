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
            <!-- table sempro -->
            <div class="table-responsive">
                <table class="table table-bordered" id="jadwalPengujiSempro" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NPM</th>
                            <th>Judul</th>
                            <th>Bidang</th>
                            <th>Tanggal Seminar</th>
                            <th>Ruangan</th>
                            <th>Penguji 1</th>
                            <th>Penguji 2</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($seminarPrasidang as $sp): ?>
                        <tr>
                            <td class="npm"><?= $sp['npm'] ?></td>
                            <td><?= $sp['judul'] ?></td>
                            <td data-toggle="tooltip" data-placement="top" title="<?= $sp['nama_bidang'] ?>"><?= $sp['inisial_bidang'] ?></td>

                            <td class="tanggal"><?= date_format(date_create($sp['tanggal']), 'd-m-Y H:i') ?></td>

                            <td class="ruangan"><?= $sp['ruangan'] ?></td>

                            <td data-toggle="tooltip" data-placement="top" title="<?= $sp['nama_penguji1'] ?>" class="dosen_penguji1"><?= $sp['inisial_penguji1'] ?></td>
                            
                            <?php if ($sp['dosen_penguji2'] != null) :?>
                                <td data-toggle="tooltip" data-placement="top" title="<?= $sp['nama_penguji2'] ?>" class="dosen_penguji2"><?= $sp['inisial_penguji2'] ?></td>
                            <?php else:?>
                                <td>-</td>
                            <?php endif; ?>

                            <td>
                                <a class="btn btn-primary" href="<?= base_url("dosen/reviewSeminarPrasidang/".$sp['id']) ?>">Review</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
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